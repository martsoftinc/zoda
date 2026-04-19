<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\campaignModel;
use App\Models\AdgroupModel;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendEmailJob;

class advertiserController extends Controller
{
    //


    public function createCampaign()
    {
        $adGroups = AdgroupModel::where('user_id', Auth::id())->get();
        return view('advertiser.campaign.create',compact('adGroups'));
    }

    public function CampaignList()
    {
        $user = Auth::user()->id;
        $campaigns = DB::table('campaigns')
                    ->where('user_id',$user)
                    ->get();
        return view('advertiser.campaign.list',compact('campaigns'));
    }

    public function Analytics()
    {
        return view('advertiser.campaign.analytics');
    }

    public function userdata()
    {
        return view('advertiser.users');
    }
    public function userlist(Request $request)
    {

        $total_users = DB::table('users')
                    ->where('role','publisher')
                    ->count();
         // find all users credit also know as liability  

        $user_balance = DB::table('credit') 
                        ->sum('credit') ;

        $paid = DB::table('payment_requests')
                        ->where('status','paid') 
                        ->sum('amount') ;
        /*
        $list = DB::table('users')
                    ->where('role','publisher')
                    ->join('payment_requests', 'users.id', '=', 'payment_requests.user_id')
                    ->where('payment_requests.status', 'paid')
                     ->select('users.id', 'users.name', 'users.account_id', DB::raw('SUM(payment_requests.amount) as total_amount'))
                    ->groupBy('users.id', 'users.name', 'users.email', 'users.account_id') // Include all necessary columns in GROUP BY
                    ->paginate(100);
        */
    $sort = $request->get('sort', '');

     $list = DB::table('users')
    ->where('users.role', 'publisher')
    ->leftJoin(DB::raw('(SELECT user_id, SUM(amount) as total_amount FROM payment_requests WHERE status = "paid" GROUP BY user_id) as pr'), 'users.id', '=', 'pr.user_id') // Subquery for correct sum of payment requests
    ->leftJoin('credit', 'users.id', '=', 'credit.user_id')
    ->leftJoin(DB::raw('(SELECT user_id, 
                                COUNT(CASE WHEN DATE(created_at) = CURDATE() THEN 1 END) as today_clicks,
                                COUNT(CASE WHEN DATE(created_at) = CURDATE() - INTERVAL 1 DAY THEN 1 END) as yesterday_clicks,
                                COUNT(CASE WHEN MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE()) THEN 1 END) as month_clicks,
                                COUNT(CASE WHEN MONTH(created_at) = MONTH(CURDATE() - INTERVAL 1 MONTH) AND YEAR(created_at) = YEAR(CURDATE() - INTERVAL 1 MONTH) THEN 1 END) as last_month_clicks
                         FROM clicks
                         GROUP BY user_id) as cl'), 'users.id', '=', 'cl.user_id') // Subquery to count distinct clicks by user
    ->select(
        'users.id', 
        'users.name', 
        'users.email', 
        'users.account_id', 
        'pr.total_amount',  // Correctly calculated total amount from the subquery
        'credit.credit as user_credit',  // Fetch the credit column directly
        'cl.today_clicks',   // Correctly calculated today clicks
        'cl.yesterday_clicks', // Yesterday's clicks
        'cl.month_clicks',  // This month's clicks
        'cl.last_month_clicks' // Last month's clicks
    )
    ->groupBy('total_amount','users.id', 'users.name', 'users.email', 'users.account_id', 'credit.credit', 'cl.today_clicks', 'cl.yesterday_clicks', 'cl.month_clicks', 'cl.last_month_clicks'); // Group by necessary columns
    
     // Apply sorting based on the request
    if ($sort == 'clicks') {
        $list = $list->orderBy('cl.month_clicks', 'desc');  // Sort by clicks (descending)
    } 
    
    elseif ($sort == 'paid') {
        $list = $list->orderBy('total_amount', 'desc');   // Sort by user balance (descending)
    }
    
    elseif ($sort == 'balance') {
        $list = $list->orderBy('credit.credit', 'desc');   // Sort by user balance (descending)
    }
    
    
    
    
    $list = $list->paginate(100);


        return view('advertiser.userlist',compact('total_users','user_balance','paid','list'));
    }


    public function Support()
    {
        return view('advertiser.support');
    }

    //Show list of ad groups
    public function Adgroup()
    {
       // Get the authenticated user's ID
    $userId = Auth::id();

    // Fetch ad groups for the user with the count of associated campaigns
    $adgroup_list = AdgroupModel::where('user_id', $userId)
        ->withCount(['campaigns' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }])
        ->get();

        return view('advertiser.campaign.adgroup',compact('adgroup_list'));
    }


    // show adgroup create page
    public function createAdgroup()
    {
       
        return view('advertiser.campaign.create-adgroup');
    }


    // Store new agroup
    public function storeAdgroup(Request $request)
    {
         $request->validate([
            'adgroup_name' => 'required|string|max:255',
            ]);


        $adgroup = new AdgroupModel([
            'adgroup_name' => $request->input('adgroup_name'),
            'user_id' => Auth::id(),
            'adgroup_id' => $request->input('adgroup_id'),          
        ]);

        $adgroup->save(); 
        return redirect()->back()->with('success', 'Campaign created successfully!');       
        return view('advertiser.campaign.create-adgroup');
    }



    public function Transaction()
    {
        $payment_requests = DB::table('payment_requests')
                        ->join('users', 'payment_requests.user_id', '=', 'users.id')
                        ->where('status','pending')
                        ->select('payment_requests.*', 'users.name')
                        ->paginate(10);

        $total = DB::table('payment_requests')
                        ->where('status','pending')
                        ->sum('amount'); 
        return view('advertiser.transaction.list',compact('payment_requests','total'));
    }

    public function store(Request $request)
    {
        // Validate the form inputs
        $request->validate([
            'campaign_name' => 'required|string|max:255',
            'interest1' => 'required|string|max:255',
            'landing_page' => 'required|url',
            'final_url' => 'required|url',
            'end_date' => 'required|date',
            'country' => 'required|string|max:100',
            
        ]);

        
        
        // Create a new campaign record
        $status = 'Under Review';
        $campaign = new campaignModel([
            'campaign_name' => $request->input('campaign_name'),
            
            'landing_page' => $request->input('landing_page'),
            
            'final_url' => $request->input('final_url'),
            'end_date' => $request->input('end_date'),
            'daily_budget' => $request->input('daily_budget'),
            'country' => $request->input('country'), 
            'user_id' => Auth::id(),
            'status' => $status,
            'interest1' => $request->input('interest1'),
            'interest2' => $request->input('interest2'),
            'interest3' => $request->input('interest3'),
            'adgroup_id' => $request->input('adgroup_id'),          
        ]);

      
        

        $campaign->save(); 
        
        return redirect()->back()->with('success', 'Campaign created successfully!');              
    }

    public function advertiserDashboard()
    {
        $user = Auth::user()->id;
        /*
        $balance  = DB::table('balance')
                    ->where('user_id',$user)
                    ->value('balance'); */

        $today_liability = DB::table('clicks')   
                     ->whereDate('created_at', Carbon::today())
                    ->sum('cost');

        $yesterday_liability = DB::table('clicks')   
                     ->whereDate('created_at', Carbon::yesterday())
                    ->sum('cost');

        $this_month = DB::table('clicks')   
                     ->whereMonth('created_at', Carbon::now()->month)
                     ->whereYear('created_at', Carbon::now()->year)
                    ->sum('cost'); 

        $last_month = DB::table('clicks')   
                     ->whereBetween('created_at', [
                    Carbon::now()->startOfMonth()->subMonth(), 
                    Carbon::now()->subMonth()->endOfMonth()  
                ])
                    ->sum('cost');                                   


        $today_clicks = DB::table('clicks')   
                     ->whereDate('created_at', Carbon::today())
                    ->count();

        $yesterday_clicks = DB::table('clicks')   
                     ->whereDate('created_at', Carbon::yesterday())
                    ->count();

        $this_month_clicks = DB::table('clicks')   
                      ->whereMonth('created_at', Carbon::now()->month)
                     ->whereYear('created_at', Carbon::now()->year)
                    ->count();                                                  
                    
        return view('advertiser.dashboard',compact('this_month_clicks','yesterday_clicks','today_clicks','today_liability','yesterday_liability','this_month','last_month'));
    }

    // delete campaign
    public function deletecampaign($id) 
    {
       $item = campaignModel::find($id);

        if ($item) {
            $item->delete();
            return redirect()->route('campaign-list')->with('success', 'Item deleted successfully.');
        }

        return redirect()->route('dashboard')->with('error', 'Item not found.');
    }

    public function EmailCampagnShow(){
        return view('advertiser.emailcampaigns');
    }

    public function SendCampaignEmails(Request $request){
       {
        // Validate the form inputs
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Retrieve all users with the 'publisher' role
        $publishers = User::where('role', 'publisher')->get();
        
        // Dispatch a job for each publisher to send the email asynchronously
        foreach ($publishers as $publisher) {
            SendEmailJob::dispatch($publisher->email, $request->title, $request->message);
        }

        // Redirect back with success message
        return redirect()->back()->with('success', 'Emails are being sent to all publishers.');
    }
    }

   
}

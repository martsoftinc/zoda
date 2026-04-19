@extends('user.layout')
@section('content')
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container">
                <!-- ============================================================== -->
                <!-- Three charts -->
                <!-- ============================================================== -->

                    @if (session()->has('success'))
  <div class="alert alert-success">
    {{ session()->get('success') }}
  </div>
@endif

      @if (session()->has('error'))
  <div class="alert alert-danger">
    {{ session()->get('error') }}
  </div>
@endif
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-12">
                        
                        <div class="white-box analytics-info">
                            
                        <h3 class="box-title">Earnings</h3>
                        <ul class="list-inline two-part d-flex align-items-center mb-0">
                            <li>
                             <!-- Replace sparklinedash3 with a dollar sign -->
                                <span style="font-size: 24px; color: #4CAF50;">$</span>
                            </li>
                            @if($credit)
                            <li class="ms-auto"><span class="counter text-info">{{$credit->credit}}</span></li>
                            @else
                            <li class="ms-auto"><span class="counter text-info">0</span></li>
                            @endif
                        </ul>
                    </div>
                </div>
                
                    

                    
                <div class="col-lg-4 col-md-12">
    <div class="white-box analytics-info">
        <h3 class="box-title">Referral Bonus</h3>
        <ul class="list-inline two-part d-flex align-items-center mb-0">
            <li>
                <!-- Replace sparklinedash3 with a dollar sign -->
                <span style="font-size: 24px; color: #4CAF50;">$</span>
            </li>
            <li class="ms-auto"><span class="counter text-info">{{$bonus}}</span></li>
        </ul>
    </div>


    
    </div>

       <div class="col-lg-4 col-md-12">
    <div class="white-box analytics-info">
        <h3 class="box-title">Paid</h3>
        <ul class="list-inline two-part d-flex align-items-center mb-0">
            <li>
                <!-- Replace sparklinedash3 with a dollar sign -->
                <span style="font-size: 24px; color: #4CAF50;">$</span>
            </li>
            <li class="ms-auto"><span class="counter text-info">{{$paid}}</span></li>
        </ul>
    </div>


    
    </div>
                    
     <!-- referral code -->
    
                            
                              
               
                <!-- ============================================================== -->
                <!-- survey list -->
                <!-- ============================================================== -->
             

                <div class="row">
                    
                        <div class="white-box">
                            
                            <div class="table-responsive">
                                <table class="table no-wrap">
                                    <thead>
                                        <tr>
                                           
                                           <span style="white-space: normal; overflow-wrap: break-word; display: inline-block; max-width: 100%;">
                                            <th class="border-top-0">Articles (Watch tutorial <a href="https://youtu.be/2NRJ2OuE4nM" target="_blank">here</a>)</th>
                                            </span>
                                            
                                            @if(session()->has('open_task'))
                                                    <div class="mb-3">
                                                        <a href="{{ route('refreshTaskList') }}" class="btn btn-primary">
                                                            Refresh Task List
                                                        </a>
                                                    </div>
                                            @endif
                                         
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
            @if(count($tasks) > 0)
            @foreach($tasks as $task)                                                    
                <tr>
                                         
                    <td class="txt-oflo">
                        @if(session()->has('open_task') && session('open_task') != $task->id)
                            <!-- Disable link when another task is open -->
                            <span class="text-muted" title="Complete your current task first" style="white-space: normal; overflow-wrap: break-word; display: inline-block; max-width: 100%; ">
                                {{ $task->campaign_name }}
                            </span>
                        @else
                            <a href="{{ route('show', ['id' => $task->id, 'token' => $task->token]) }}">
                                <!-- <a href="{{ route('show', ['id' => $task->campaign_id, 'token' => $task->token]) }}">-->
                                <span style="white-space: normal; overflow-wrap: break-word; display: inline-block; max-width: 100%;">{{ $task->campaign_name }}
                                    </span>
                            </a>
                        @endif
                     </td>
                </tr> 

            @endforeach                                       
            @else
    <tr>
        <td colspan="12" class="text-center" style="white-space: normal; overflow-wrap: break-word; display: inline-block; max-width: 100%;">
            <div class="alert alert-info">
                Sorry, no articles available in your country right now. Please check back later or use a VPN to change your country to either USA, CANADA, UK or AUSTRALIA.
            </div>
        </td>
    </tr>
@endif   
                                        
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                          
                        </div>
                    </div>
                </div>
<!-- 
<h1 align="center">Your Surveys below </h1>
                <div class="container">
  <div class="row">
    @foreach($tasks as $task)
      <div class="col-md-4 col-sm-6 mb-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title txt-oflo">
              <a href="{{route('show',['id'=>$task->id,'token' => $task->token])}}">
                {{$task->campaign_name}}
              </a>
            </h5>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div> -->
            <!-- 
                <div class="row">
                    
                        <div class="white-box" align="center">
                            <h3> Watch the video tutorial </h3>
                            <iframe class="youtube-video" src="https://www.youtube.com/embed/xrSVkI3tDy0?si=_w5Kg_10EYeajEKM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                            </div>
                </div>
            -->
                <div class="container mt-5">
                           <div class="referral-container">
        <h3>Earn 1$ for every referral</h3>
        <p>Publish your unique referral URL on your social profiles</p>
        
       <div class="social-buttons">
    <!-- Facebook Share Button -->
    <a href="https://www.facebook.com/sharer/sharer.php?u=https://paidreader.app/signup-publisher?referral={{ Auth::user()->account_id }}" class="btn btn-primary" target="_blank">Facebook</a>

    <!-- WhatsApp Share Button -->
    <a href="https://api.whatsapp.com/send?text=Make%20%24100-%24500%20per%20month%20from%20reading%20articles,%20signup%20today:%20https://paidreader.app/signup-publisher?referral={{ Auth::user()->account_id }}" class="btn btn-success" target="_blank">WhatsApp</a>

    <!-- Twitter Share Button -->
    <a href="https://twitter.com/intent/tweet?url=https://paidreader.app/signup-publisher?referral={{ Auth::user()->account_id }}&text=Make%20%24100-%24500%20per%20month%20from%20reading%20articles,%20signup%20today!" class="btn btn-info" target="_blank">Twitter</a>

    <!-- Telegram Share Button -->
    <a href="https://t.me/share/url?url=https://paidreader.app/signup-publisher?referral={{ Auth::user()->account_id }}&text=Make%20%24100-%24500%20per%20month%20from%20reading%20articles,%20signup%20today!" class="btn btn-primary" target="_blank">Telegram</a>
</div>
        
        <p>- OR -</p>
        <p>Copy your unique link and send it to your friends 

        <div class="referral-link-container">
    <input type="text" id="referralLink" value="https://paidreader.app/signup-publisher?referral={{ Auth::user()->account_id }}" readonly>
    <button class="copy-btn" onclick="copyLink()">Copy</button>
</div>

    </div>
                            </div>
                            

               

                            <script>
    function copyLink() {
        const link = document.getElementById("referralLink");
        link.select();
        document.execCommand("copy");
        alert("Referral link copied to clipboard!");
    }
</script>


<div class="row">
                    
                        <div class="white-box">
     <h1 style="text-align:center">How does it work </h1>
     <p style="font-size: larger;">
    <strong>Earn $1 Every Time Your Referral Withdraws – Forever!</strong><br><br>
   Our Referral Program offers ongoing passive income—share your link, refer users (e.g., 100 users withdrawing 5 times monthly will earn you $500, or 1,000 referrals withdrawing 5 times monthly will earn you $5,000 monthly), and earn commissions indefinitely with no extra effort.
</p>
<p style="font-size: larger;">
    <strong>How to Earn:</strong><br>
    1. Share your unique referral link on social media or with friends.<br>
    2. When someone signs up using your link, they become your referral.<br>
    3. You earn $1 every time they withdraw funds, for life!

<p style="text-align: center; font-size: 24px;">
    <a href="/referrals">View your referrals here</a>
</p>
       
      </div>
        </div>   

@endsection
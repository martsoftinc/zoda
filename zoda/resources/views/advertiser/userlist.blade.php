@extends('advertiser.layout')
@section('content')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
            
           
            <div class="row">
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Total Users</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0">{{$total_users}}</h2>
                         
                        </div>
                        
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-codepen text-primary ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Users Balance</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0">${{$user_balance}}</h2>
                        
                        </div>
                       
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-wallet-travel text-danger ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5>Paid</h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0">${{$paid}}</h2>
                        
                        </div>
                       
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-monitor text-success ml-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              

            </div>
            

            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Users</h4>
                    <div class="table-responsive">

                      <form method="GET" action="{{ route('userlist') }}" class="mb-4">
    <label for="sort">Sort by:</label>
    <select name="sort" id="sort" onchange="this.form.submit()">
        <option value="" disabled>Select...</option>
        <option value="clicks" {{ request('sort') == 'clicks' ? 'selected' : '' }}>Highest Clicks This Month</option>
        <option value="paid" {{ request('sort') == 'paid' ? 'selected' : '' }}>Highest Paid</option>
        <option value="balance" {{ request('sort') == 'balance' ? 'selected' : '' }}>Highest Balance</option>
    </select>
</form>
                      
                      <table class="table">
                        <thead>
                          <tr>
                            
                            <th> Name </th>
                            <th> Today(clicks)</th>
                            <th> Yesterday(clicks)</th>
                            <th> This Month(clicks)</th>
                            <th> Last Month(clicks)</th>
                            <th> Paid</th>
                            <th> Balance</th>
                            
                         
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($list as $users)
                          <tr>
                            
                            <td>
                              
                              <span class="pl-2">{{$users->name}} </span>
                            </td>
                            <td> {{$users->today_clicks ?? 0}} </td>
                            <td>{{$users->yesterday_clicks ?? 0}} </td>
                            <td> {{$users->month_clicks ?? 0}}  </td>
                            <td>{{$users->last_month_clicks ?? 0}}  </td>
                            <td>  {{$users->total_amount ?? 0}} </td>
                            <td> {{$users->user_credit ?? 0}} </td>
                           
                          </tr>
                          
                          
                          @endforeach
                          
                        </tbody>
                       
                      </table>
                 
                    </div>
                   
                  </div>
                </div>
              </div>
            </div>
             <div class="d-flex justify-content-end">
                 {{ $list->links('pagination::bootstrap-4') }}
            </div>
          <!-- content-wrapper ends -->
          @endsection
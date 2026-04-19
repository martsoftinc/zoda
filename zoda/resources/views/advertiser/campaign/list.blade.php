@extends('advertiser.layout')
@section('content')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
           
            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Campaigns 
                        <br><br><a href="/create-campaign"><button type="button" class="btn btn-outline-success btn-fw">Create New Campaign</button></a></h4> 
                    
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            
                            <th> ID</th>
                            <th> Name</th>
                            
                           
                            <th> End Date </th>
                            <th> Daily Budget </th>
                            <th> Country </th>
                            <th> Status</th>
                            <th> Edit</th>
                          
                     
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($campaigns as $campaign)
                          <tr>
                            
                            <td> {{$campaign->campaign_id}}</td>
                            <td> {{$campaign->campaign_name}}</td>
                           
                          
                            <td> {{$campaign->end_date}}</td>
                            <td> {{$campaign->daily_budget}}</td>
                            <td> {{$campaign->country}}</td>
                            
                            
                            <td>
                              <div class="badge badge-outline-success">Active</div>
                            </td>
                           <td><a href="{{ route('delete-campaign', ['id' => $campaign->id]) }}"><button type="button"
                              class="btn btn-danger">Delete</button></a>
                              </td>
                          </tr>
                          
                          @endforeach
                          
                          
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
              
            </div>
           
          <!-- content-wrapper ends -->
          @endsection
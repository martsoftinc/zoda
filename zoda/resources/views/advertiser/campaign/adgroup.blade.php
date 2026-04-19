@extends('advertiser.layout')
@section('content')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
           
            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Adgroups
                        <br><br><a href="/create-adgroup"><button type="button" class="btn btn-outline-success btn-fw">Create New Adgroup</button></a></h4> 
                    
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            
                            <th> ID</th>
                            <th> Name</th>
                            <th> Campaigns</th>
                            <th> Action</th>
                            
                     
                          </tr>
                        </thead>
                        <tbody>
                             @foreach($adgroup_list as $group)
                          <tr>
                            
                            <td> {{$group->adgroup_id}}</td>
                            <td> {{$group->adgroup_name}}</td>
                            <td>{{ $group->campaigns_count }}</td>
                            <td> Edit / View</td>
                            
                            
                          
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
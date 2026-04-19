@extends('advertiser.layout')
@section('content')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
           
            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Create New Adgroup
                        <br><br>
                    <form action="{{route('storeAdgroup')}}" method="post">
                        @csrf
                      <div class="form-group">
                        <label for="exampleInputName1">Adgroup Name</label>
                        <input type="text" class="form-control" name="adgroup_name" placeholder="eg Nairaland.com">
                      </div>
                     
                      
                      
                      
                      
                      
                      <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    
    <button class="btn btn-dark"><a href="/adgroup">Go Back </a></button>

                    </form>
                    
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
              
           

            
           
          <!-- content-wrapper ends -->
          @endsection
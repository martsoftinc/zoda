@extends('advertiser.layout')
@section('content')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
           
            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Email Campaigns</h4>
                       
                    <form action="{{route('SendEmails')}}" method="post">
                      @csrf
                    <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Title</label>
                          <input type="text" class="form-control" name="title" >
                    </div>
                    <div class="mb-3">
                          <label for="exampleFormControlTextarea1" class="form-label">Message</label>
                          <textarea class="form-control" name="message" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary mb-3">Send</button>
                    </div>
                 </form>
                  </div>
                </div>
              </div>
            </div>
            
              
            </div>
           
          <!-- content-wrapper ends -->
          @endsection
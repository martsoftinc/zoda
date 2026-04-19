@extends('advertiser.layout')
@section('content')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            
           
            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Payment Request <button type="button" class="btn btn-success">Total ${{$total}}</button></h4> 
                    
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            
                            <th> User</th>
                            <th> Amount</th>
                            <th> Date</th>
                            <th> Payment Status </th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($payment_requests as $request)
                          <tr>
                            <td> {{$request ->name}}</td>
                            <td>{{date("d M Y", strtotime($request->created_at))}}</td>
                            <td> {{$request ->status}}</td>
                        
                          
                            
                            <td>
                              <div class="badge badge-outline-success">{{$request ->status}}</div>
                            </td>
                          </tr>
                          @endforeach
                          
                          
                          
                        </tbody>
                      </table>
                       <div class="d-flex justify-content-end">
    {{ $payment_requests->links('pagination::bootstrap-4') }}
</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
              
            </div>
           
          <!-- content-wrapper ends -->
          @endsection
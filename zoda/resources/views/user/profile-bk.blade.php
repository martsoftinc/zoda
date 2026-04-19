
@extends('user.layout')
@section('content')

<div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="white-box">
                            <h3 class="box-title">Profile</h3>
                            <form id="updatePasswordForm" method="POST" action="{{ route('profile.updatePassword')}}">
                                @csrf
                            <!-- First Name -->
                            <div class="form-group">
                                <label for="first_name">Full Name</label>
                                <input type="text" class="form-control" value="{{Auth::user()->name}}" disabled>
                            </div>



                            <div class="form-group">
                                <label for="first_name">Account Number</label>
                                <input type="text" class="form-control" value="{{Auth::user()->account_id}}" disabled>
                            </div>

                           
                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" value="{{Auth::user()->email}}" disabled>
                            </div>

                            <!-- Country -->
                            <div class="form-group">
                                <label for="country">Country</label>
                                <input type="text" class="form-control" value="{{Auth::user()->country}}" disabled>
                            </div>

                            <!-- Change Password -->
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password">
                            </div>

                            <!-- Confirm New Password
                            <div class="form-group">
                                <label for="password_confirmation">Confirm New Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password">
                            </div>  -->

                            <!-- Submit Button -->
                            <button type="button" class="btn btn-primary" onclick="showSendCodeModal()">Update Profile</button>
                        </form>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
               
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->


<!-- Modal 1: Send Access Code Modal -->
<div class="modal fade" id="sendCodeModal" tabindex="-1" role="dialog" aria-labelledby="sendCodeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="sendCodeModalLabel">Send Access Code</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Click the button below to send an access code to your email.</p>
        <button type="button" class="btn btn-primary" onclick="sendVerificationCode()">Send Access Code</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal 2: Enter Access Code Modal -->
<div class="modal fade" id="codeModal" tabindex="-1" role="dialog" aria-labelledby="codeModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="codeModalLabel">Enter Verification Code</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Enter the code sent to your email:</p>
        <input type="text" id="verificationCode" class="form-control" placeholder="Enter Code">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="verifyCode()">Submit</button>
      </div>
    </div>
  </div>
</div>



<script>
function showSendCodeModal() {
    // Show the first modal to ask the user to send the access code
    $('#sendCodeModal').modal('show');
}

function sendVerificationCode() {
    // Send the code via AJAX
    fetch('{{ route('profile.sendCode') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({})
    }).then(response => response.json())
      .then(data => {
          if (data.message) {
              alert(data.message);
              // Hide the send code modal
              $('#sendCodeModal').modal('hide');
              // Show the code input modal
              $('#codeModal').modal('show');
          }
      });
}

function verifyCode() {
    const code = document.getElementById('verificationCode').value;
    
    fetch('{{ route('profile.verifyCode') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ code: code })
    }).then(response => response.json())
      .then(data => {
          if (data.status) {
              alert('Code verified! You can now change your password.');
              // Hide the code modal
              $('#codeModal').modal('hide');
              // Submit the password update form
              document.getElementById('updatePasswordForm').submit();
          } else {
              alert('Invalid code. Please try again.');
          }
      });
}
</script>




@endsection

@extends('user.layout')
@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="white-box">
                <input type="hidden" name="id" value='{{$task->id}}'>
                <div class="row gy-4 gy-xl-5 p-4 p-xl-5">
                    <div class="col-12 text-center">
                        <section class="instructions">
  <h2>Instructions</h2>
            <ol>
                <li>
                Click on the <strong>"Click to Visit Site"</strong> button.
                </li>
                <li>
                Open the site and read the article. Click <strong>"Continue Reading"</strong> at the bottom to go to the next page
                (you will typically read up to 5 pages).
                </li>
                <li>
                On the last page, click <strong>"Generate Verification Code"</strong>.
                </li>
                <li>
                Come back here, paste the code, and then click <strong>"Submit"</strong> to verify.
                </li>
            </ol>

            <p>
                If you don’t understand, watch the video tutorial here:
                <a href="https://youtu.be/2NRJ2OuE4nM" target="_blank" rel="noopener">https://youtu.be/2NRJ2OuE4nM</a>
            </p>
</section>
                        <hr>
                        <a href="/redirect/{{ $task->id }}" target="_blank" rel="noopener noreferrer"class="btn btn-primary btn-lg">Click to visit site</a>
                    </div>
                    <div class="col-12">
                        <form action="{{ route('verifyCode') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value='{{$task->id}}'>
                            <label for="verificationCode" class="form-label">
                                Enter Verification Code <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" id="verificationCode" name="verificationCode" required>
                            <div class="d-grid mt-3">
                                <button id="delayedButton" class="btn btn-primary btn-lg" type="submit" style="display: none;">Submit</button>
                            </div>
                            <p class="text-danger mt-2" id="timer">
                                Please wait for 5 seconds to submit verification code: <span id="countdown">5</span> seconds
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Countdown Timer
var timeLeft = 5;
var countdownTimer = setInterval(function() {
    document.getElementById('countdown').textContent = timeLeft;
    timeLeft--;
    if (timeLeft < 0) {
        clearInterval(countdownTimer);
        document.getElementById('timer').style.display = 'none';
        document.getElementById('delayedButton').style.display = 'block';
    }
}, 1000);
</script>
  



          
<script>
    // When user closes or navigates away from the page
    window.addEventListener('beforeunload', function() {
        // Make an AJAX request to clear the session
        fetch('{{ route("clear.task.session") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            // Using keepalive to ensure the request completes even if page is closed
            keepalive: true
        });
    });
</script>

<script>
// On page load, check if there's a saved task ID
document.addEventListener('DOMContentLoaded', function() {
    const savedTaskId = localStorage.getItem('taskId');
    if (savedTaskId) {
        // Restore task ID to the hidden input
        document.querySelector('input[name="id"]').value = savedTaskId;
    }
});

// Save task ID to localStorage when the user clicks the link
document.querySelector('.btn-primary').addEventListener('click', function() {
    const taskId = document.querySelector('input[name="id"]').value;
    localStorage.setItem('taskId', taskId);
});
</script>                      
          

@endsection
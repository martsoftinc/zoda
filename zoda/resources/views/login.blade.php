<!doctype html>
<html lang="en">
  <head>
     <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <!-- Apple Touch Icon (for iOS devices) -->
    <link rel="apple-touch-icon" href="{{ asset('assets/img/favicon-180x180.png') }}">
    <!-- Microsoft Windows Tiles -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon-32x32.png') }}" sizes="32x32">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon-16x16.png') }}" sizes="16x16">
    <!-- Tailwind CSS CDN -->
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="PaidReader.app">
    <meta name="twitter:title" content="Make Money Online Reading Articles">
    <meta name="twitter:description" content="Join PaidReader.app to earn money by reading articles. It's the easiest way to make passive income online.">
    <meta name="twitter:image" content="{{ asset('assets/img/banner.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="paidreader.app">
    <meta property="og:title" content="Make Money Online Reading Articles">
    <meta property="og:description" content="Join PaidReader.app to earn money by reading articles. It's the easiest way to make passive income online.">
    <meta property="og:image" content="{{ asset('assets/img/banner.png') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @turnstileScripts()
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Login / Register Click4rand.com</title>
  </head>
<!-- Login 1 - Bootstrap Brain Component -->
<div class="bg-light py-3 py-md-5">
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-12 col-md-11 col-lg-8 col-xl-7 col-xxl-6">
        <div class="bg-white p-4 p-md-5 rounded shadow-sm">
          <div class="row">
            <div class="col-12">
              <div class="text-center mb-5">
                <a href="#!">
                  <img src="{{asset('assets/img/logo.png')}}" alt="click4rand Logo" class="img-fluid" style="max-width: 300px;">
                </a>
              </div>
            </div>
          </div>
         


          <form action="{{route('userlogin')}}" method="post">
            @csrf
            <div class="row gy-3 gy-md-4 overflow-hidden">
              <div class="col-12">

                @if (session()->has('success'))
  <div class="alert alert-success">
    {{ session()->get('success') }}
  </div>
@endif

  @if (session()->has('loginError'))
  <div class="alert alert-danger">
    {{ session()->get('loginError') }}
  </div>
@endif
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <div class="input-group">
                  <span class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                      <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                    </svg>
                  </span>
                  <input type="email" class="form-control" name="email" id="email" required>
                </div>
              </div>

              <div class="col-12">
  <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
  <div class="input-group">
    <span class="input-group-text">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
        <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z" />
        <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
      </svg>
    </span>
    <input type="password" class="form-control" name="password" id="password" value="" required>
    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM8 13c-2.5 0-4.5-2-4.5-5S5.5 3 8 3s4.5 2 4.5 5-2 5-4.5 5z"/>
        <path d="M8 5a3 3 0 0 0-3 3 3 3 0 1 0 6 0 3 3 0 0 0-3-3z"/>
      </svg>
    </button>
  </div>
</div>

              <!-- old password form
              <div class="col-12">
                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                <div class="input-group">
                  <span class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                      <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z" />
                      <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                    </svg>
                  </span>
                  <input type="password" class="form-control" name="password" id="password" value="" required>
                </div>
              </div>
              -->

              <div class="mt-4">
        <!--<x-turnstile />
        @error('cf-turnstile-response')
            <span class="text-red-500">{{ $message }}</span>
        @enderror  -->
    </div>

              <div class="col-12">
                  <div class="d-grid">
                      <button 
                          class="btn btn-primary btn-lg" 
                          type="submit" 
                          onclick="this.disabled=true; this.innerText='Logging in...'; this.form.submit();">
                          Log In
                      </button>
                  </div>
              </div>
            </div>
          </form>
          <div class="row">
            <div class="col-12">
              <hr class="mt-5 mb-4 border-secondary-subtle">
              <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-center">
                <a href="/signup-publisher" class="link-secondary text-decoration-none">Create new account</a>
                <a href="/resetpassword" class="link-secondary text-decoration-none">Forgot password</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#password');

  togglePassword.addEventListener('click', function () {
    // Toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    
    // Toggle the eye icon
    this.querySelector('svg').classList.toggle('bi-eye');
    this.querySelector('svg').classList.toggle('bi-eye-slash');
  });
</script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
   

 
  </body>
</html>
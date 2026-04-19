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

           @if (session()->has('success'))
  <div class="alert alert-success">
    {{ session()->get('success') }}
  </div>
@endif

     @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.3/components/password-resets/password-reset-7/assets/css/password-reset-7.css">
<!-- Password Reset 7 - Bootstrap Brain Component -->
<section class="bg-light p-3 p-md-4 p-xl-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
        <div class="card border border-light-subtle rounded-4">
          <div class="card-body p-3 p-md-4 p-xl-5">
            <div class="row">
              <div class="col-12">
                <div class="mb-5">
                  
                  <h2 class="h4 text-center">Reset your password</h2>
                  <h3 class="fs-6 fw-normal text-secondary text-center m-0">Enter new password</h3>
                </div>
              </div>
            </div>

            
            <form action="{{route('reset')}}" method="post">
             @csrf

             <input type="hidden" name="token" value="{{$token}}">
           <!--
              <div class="row gy-3 overflow-hidden">
                <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="email" class="form-control" name="email"   required>
                    <label for="email" class="form-label">Email</label>
                  </div>
            -->
                  <div class="col-12">
                  <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="password"  required>
                    <label for="password" class="form-label">New Password</label>
                  </div>
                </div>

                
                <div class="col-12">
                  <div class="d-grid">
                    <button class="btn bsb-btn-xl btn-primary" type="submit">Update Password</button>
                  </div>
                </div>
              </div>
            </form>



            <div class="row">
              <div class="col-12">
                <hr class="mt-5 mb-4 border-secondary-subtle">
                <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end">
                  <a href="/" class="link-secondary text-decoration-none">Login</a>
                  <a href="/registration" class="link-secondary text-decoration-none">Register</a>
                </div>
              </div>
            </div>
            
                 
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>
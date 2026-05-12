<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PaidReader.app - Make money online reading articles</title>
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="PaidReader.app">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="twitter:title" content="Make Money Online Reading Articles">
    <meta name="twitter:description" content="Join PaidReader.app to earn money by reading articles. It's the easiest way to make passive income online.">
    <meta name="twitter:image" content="{{ asset('assets/img/banner.png') }}">

    <!-- Open Graph Meta Tags -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="paidreader.app">
    <meta property="og:title" content="Make Money Online Reading Articles">
    <meta property="og:description" content="Join PaidReader.app to earn money by reading articles. It's the easiest way to make passive income online.">
    <meta property="og:image" content="{{ asset('assets/img/banner.png') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @turnstileScripts()

  </head>
  <body>
    <!-- Registration 1 - Bootstrap Brain Component -->
<div class="bg-light py-3 py-md-5">
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-12 col-md-11 col-lg-8 col-xl-7 col-xxl-6">
        <div class="bg-white p-4 p-md-5 rounded shadow-sm">
          <div class="row">
            <div class="col-12">
              <div class="text-center mb-5">
                <a href="/">
                <img src="{{asset('assets/img/logo.png')}}" alt="click4rand Logo" class="img-fluid" style="max-width: 250px;">                </a>
              </div>
            </div>
          </div>

          <!-- display errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

          <!-- form fields-->
          <form action="{{route('createUser')}}" method="post">
            @csrf 

            <div class="row gy-3 gy-md-4 overflow-hidden">
              <div class="col-12">
                <label for="firstName" class="form-label">Full Name <span class="text-danger">*</span></label>
                <div class="input-group">
                  <span class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
                      <path d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4m4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5M9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8m1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5" />
                      <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2zM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12z" />
                    </svg>
                  </span>
                  <input type="text" class="form-control" name="name" id="firstName" required>
                </div>
              </div>
              <!-- 
              <div class="col-12">
                <label for="lastName" class="form-label">Whatsapp/Telegram Number <span class="text-danger">*</span></label>
                <div class="input-group">
                  <span class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                      <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                      <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0" />
                    </svg>
                  </span>
                  <input type="text" class="form-control" name="phone" id="lastName" >
                </div>
              </div> -->
              <div class="col-12">
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
                <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                <div class="input-group">
                  <span class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
</svg>
                  </span>
                   <select class="form-select" name="gender"  required>
                        <option value="" disabled selected>Select Your Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                       
                    </select>
                </div>
              </div>



            <div class="col-12">
                <label for="gender" class="form-label">Age <span class="text-danger">*</span></label>
                <div class="input-group">
                  <span class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
</svg>
                  </span>
                   <select class="form-select" name="age_group"  required>
                        <option value="" disabled selected>Select age group</option>
                        <option value="18-25">18-25</option>
                        <option value="26-35">26-35</option>
                        <option value="36-45">36-45</option>
                        <option value="46-55">46-55</option>
                        <option value="56+">56+</option>
                       
                    </select>
                </div>
              </div>




              <div class="col-12">
                <label for="phone" class="form-label">Whatsapp/Telegram <span class="text-danger"></span></label>
                <div class="input-group">
                  <span class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
  <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
</svg> 
                  </span>
                  <input type="text" class="form-control" name="phone" id="email"  placeholder ="" >
                </div>
              </div>

              <!-- Hidden referral input field -->
            <input type="hidden" name="referral_code" value="{{ request('referral') }}">
             
            
              <div class="col-12">
                 <label for="mobileMoney" class="form-label">Country <span class="text-danger">*</span></label>
                 <div class="input-group">
                 <span class="input-group-text">
                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
                    <path d="M3 0c-1.105 0-2 .895-2 2v12c0 1.105.895 2 2 2h10c1.105 0 2-.895 2-2V4a2 2 0 0 0-2-2H8.828l-1-1H3zm0 1h4.586l1 1H13c.552 0 1 .448 1 1v2H2V2c0-.552.448-1 1-1zm0 5h12v8a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6zm1 1v6h10V7H4z"/>
                    </svg>
                 </span>
                              <select name="country" id="country" class="form-control" required>
                                  <option value="">Select your country</option>
                                  @foreach(\App\Models\Country::all() as $country)
                                     @if(in_array($country->code, ['NG', 'ZA', 'GH', 'KE']))
                                          <option value="{{ $country->code }}">{{ $country->name }}</option>
                                      @endif
                                  @endforeach
                              </select>
                    </div>
                  </div>


                <!--
                  <div class="col-12">
                 <label for="mobileMoney" class="form-label">Interest 2<span class="text-danger">*</span></label>
                 <div class="input-group">
                 <span class="input-group-text">
                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
                    <path d="M3 0c-1.105 0-2 .895-2 2v12c0 1.105.895 2 2 2h10c1.105 0 2-.895 2-2V4a2 2 0 0 0-2-2H8.828l-1-1H3zm0 1h4.586l1 1H13c.552 0 1 .448 1 1v2H2V2c0-.552.448-1 1-1zm0 5h12v8a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6zm1 1v6h10V7H4z"/>
                    </svg>
                 </span>
                      <select class="form-select" name="interest2"  required>
                        <option value="" disabled selected>Select Your Interest</option>
                        <option value="Arts">Arts and Entertainment</option>
                        <option value="Business">Business and Finance</option>
                        <option value="Tech">Technology and Science</option>
                        <option value="Health">Health and Wellness</option>
                        <option value="Travel">Travel and Adventure</option>
                        <option value="Sports">Sports and Recreation</option>
                        <option value="Fashion">Fashion and Lifestyle</option>
                        <option value="Food">Food and Drink</option>
                        <option value="Education">Education and Learning</option>
                        <option value="Auto">Automotive and Transportation</option>
                        <option value="Religion">Religion and Spirituality</option>
                        <option value="DIY">DIY and Crafts</option>
                    </select>
                    </div>
                  </div>

                  <div class="col-12">
                 <label for="mobileMoney" class="form-label">Interest 3<span class="text-danger">*</span></label>
                 <div class="input-group">
                 <span class="input-group-text">
                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
                    <path d="M3 0c-1.105 0-2 .895-2 2v12c0 1.105.895 2 2 2h10c1.105 0 2-.895 2-2V4a2 2 0 0 0-2-2H8.828l-1-1H3zm0 1h4.586l1 1H13c.552 0 1 .448 1 1v2H2V2c0-.552.448-1 1-1zm0 5h12v8a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6zm1 1v6h10V7H4z"/>
                    </svg>
                 </span>
                      <select class="form-select" name="interest3"  required>
                        <option value="" disabled selected>Select Your Interest</option>
                        <option value="Arts">Arts and Entertainment</option>
                        <option value="Business">Business and Finance</option>
                        <option value="Tech">Technology and Science</option>
                        <option value="Health">Health and Wellness</option>
                        <option value="Travel">Travel and Adventure</option>
                        <option value="Sports">Sports and Recreation</option>
                        <option value="Fashion">Fashion and Lifestyle</option>
                        <option value="Food">Food and Drink</option>
                        <option value="Education">Education and Learning</option>
                        <option value="Auto">Automotive and Transportation</option>
                        <option value="Religion">Religion and Spirituality</option>
                        <option value="DIY">DIY and Crafts</option>
                    </select>
                    </div>
                  </div>



              -->


                







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

              <div class="col-12">
                <label for="password" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                <div class="input-group">
                  <span class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                      <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z" />
                      <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                    </svg>
                  </span>
                  <input type="password" class="form-control" name="password_confirmation" id="password" value="" required>
                </div>
              </div>

             
              

              



              <div class="col-12">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" name="iAgree" id="iAgree" required>
                  <label class="form-check-label text-secondary" for="iAgree">
                    I agree to the <a href="terms" class="link-primary text-decoration-none" target="_bank">terms and conditions</a>
                  </label>
                </div>
              </div>
              <div class="mt-4">
         <!--<x-turnstile />  -->
       
    </div>

              <div class="col-12">
                <div class="d-grid">
                  <button class="btn btn-primary btn-lg" type="submit">Sign Up</button>
                </div>
              </div>
            </div>
          </form>
          <div class="row">
            <div class="col-12">
              <hr class="mt-5 mb-4 border-secondary-subtle">
              <p class="m-0 text-secondary text-center">Already have an account? <a href="/login" class="link-primary text-decoration-none">Sign in</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
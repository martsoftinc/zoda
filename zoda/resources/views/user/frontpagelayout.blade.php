@include('modals')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:image" content="https://click4rand.com/assets/img/banner2.jpg" />
    <meta property="og:title" content="Click4Rand.Com" />
    <meta property="og:description" content="Make money online in south africa" />
    <meta property="og:url" content="https://click4rand.com/assets/img/banner2.jpg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .main-section {
            background-color: #F9F9F9;
            padding: 60px 0;
        }
        .youtube-video {
         aspect-ratio: 16 / 9;
         width: 100%;
        }

        .main-section h1 {
            color: #1A5F3D;
            font-weight: bold;
        }

        .main-section a.btn-primary {
            background-color: #1A5F3D;
            border-color: #1A5F3D;
        }

        .content-section h2 {
            color: #1A5F3D;
        }

        .footer {
            background-color: #0B4836;
            color: white;
            padding: 40px 0;
        }

        .footer a {
            color: white;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .footer p {
            font-size: 0.9rem;
        }

        .disclaimer {
            font-size: 0.85rem;
            color: #ccc;
        }

        /* Custom CSS for text justification */
        p {
            text-align: justify;
        }

        /* Remove underline from navigation links */
        .navbar-nav .nav-link {
            text-decoration: none;
        }

        .navbar-nav .nav-link:hover {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <!-- Header Section with Collapsible Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{asset('assets/img/logo.png')}}" alt="Pursico Logo" class="img-fluid" style="max-width: 250px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-dark mx-2" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark mx-2" href="https://forms.gle/GcSNq1ddS83d6bWs5" target="_blank">Advertise</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark mx-2" href="#">About Us</a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link text-dark mx-2" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-success" href="signup-publisher">Sign up</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Section -->
    <section class="main-section text-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4">
                    <h1>Get Paid To Read Websites</h1>
                    <p>Earn money while you read! Our platform allows South Africans to get paid for reading engaging articles, stories, and news. Whether you're looking to earn extra cash or simply enjoy informative content, join us today and turn your reading time into income.</p>
                    <a href="signup-publisher" class="btn btn-primary">Register &rarr;</a> <a href="login" class="btn btn-primary">Login &rarr;</a>
                </div>
                <div class="col-lg-6">
                    <img src="{{asset('assets/img/banner2.jpg')}}" alt="Couple on the beach" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>

    <!-- Tips and Tricks Section -->
    <section class="content-section text-center py-5">
        <div class="container">
            @yield('content')
        </div>
    </section>

    

    <!-- Footer Section -->
    <footer class="footer text-center">
        <div class="container">
            <img src="{{asset('assets/img/logo.png')}}" alt="Pursico Logo" class="img-fluid" style="max-width: 120px;">
            <nav class="mb-4">
                <a href="https://web.facebook.com/click4rand" class="text-light mx-3" target="_blank">Contact Us</a>
                <a href="#" class="text-light mx-3">Privacy Policy</a>
                <a href="#" class="text-light mx-3">Our mission</a>
                <a href="#" class="text-light mx-3" data-bs-toggle="modal" data-bs-target="#infoModal">About us</a>
                <a href="signup-publisher" class="text-light mx-3">Sign up</a>
                <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contactModal">
  Contact Us
</button> -->

            </nav>
            <!-- <p class="disclaimer">The content on our site is free to use. Any financial results are not implied or guaranteed. Any results depend solely on the action taken by the individual. We monetize our service with advertisement, but no content will be prioritized based on other things than editorial relevance. For further questions we refer to our <a href="#">privacy policy</a>.</p> -->
            <p>&copy; 2024 Click4Rand.Com</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

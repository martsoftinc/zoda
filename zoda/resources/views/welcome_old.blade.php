@include('modals')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:image" content="https://read2earn.cash/assets/img/banner2.jpg" />
    <meta property="og:title" content="Read2earn.cash" />
    <meta property="og:description" content="Make money online in reading articles" />
    <meta property="og:url" content="https://read2earn.cash/assets/img/banner2.jpg" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-VKD4F45DCK"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-VKD4F45DCK');
</script>
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
            <a class="navbar-brand" href="/">
                <img src="{{asset('assets/img/logo.png')}}" alt="read2earn.cash logo" class="img-fluid" style="max-width: 250px;">
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
                        <a class="nav-link text-dark mx-2" href="#" data-bs-toggle="modal" data-bs-target="#infoModal">About Us</a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link text-dark mx-2" href="https://web.facebook.com/read2earn.cash">Contact</a>
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
                    <h1>#1 Website To Earn From Reading</h1>
                    <p>Earn money while you read! Our platform allows anyone to get paid for reading engaging articles, stories, and news. Whether you're looking to earn extra cash or simply enjoy informative content, join us today and turn your reading time into income.</p>
                    <a href="signup-publisher" class="btn btn-primary">Register &rarr;</a> <a href="login" class="btn btn-primary">Login &rarr;</a>
                </div>
                <div class="col-lg-6">
                    <img src="{{asset('assets/img/banner2.jpg')}}" alt="read2earn.cash logo" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>

    <!-- Tips and Tricks Section -->
    <section class="content-section text-center py-2">
        <div class="container">
            <h2>How Does It Work</h2>
            <p>Sign up easily and get access to a list of articles to read. Simply select the article you want to read, visit the link, read through all the pages, and then click the verification button to generate a unique code. Enter the code on read2earn.cash to confirm you've completed reading. Once your code is accepted, you’ll earn rewards! The more articles you read, the more you can earn—there’s no limit. For further details, watch the video below.</p>
            <iframe class="youtube-video" src="https://www.youtube.com/embed/xrSVkI3tDy0?si=_w5Kg_10EYeajEKM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
    </section>

    <section class="content-section text-center py-2">
        <div class="container">
            <h2>Where does the money come from?</h2>
            
            <p>Great question! Read2Earn.cash is a platform that connects website owners, PR firms, and bloggers with genuine readers. While approximately 50% of traffic generated through Google and Facebook advertisements comes from bots, Read2Earn.cash provides businesses with real human engagement.</p>



<!-- The Process Section -->
<div class="container py-5">
  <h3 class="text-center mb-4"> The Process</h3>

  <div class="row g-4">

    <!-- Step 1 -->
    <div class="col-md-6 col-lg-3">
      <div class="border rounded p-4 h-100 shadow-sm text-center">
        <div class="mb-3">
          <i class="bi bi-megaphone-fill fs-1 text-primary"></i>
        </div>
        <h5><strong>1-Businesses Create Campaigns</strong></h5>
        <p class="small text-muted">Website owners decide how much to pay readers for engaging with their content.</p>
      </div>
    </div>

    <!-- Step 2 -->
    <div class="col-md-6 col-lg-3">
      <div class="border rounded p-4 h-100 shadow-sm text-center">
        <div class="mb-3">
          <i class="bi bi-journal-text fs-1 text-success"></i>
        </div>
        <h5><strong>2-Readers Engage With Content</strong></h5>
        <p class="small text-muted">You browse and read articles that interest you.</p>
      </div>
    </div>

    <!-- Step 3 -->
    <div class="col-md-6 col-lg-3">
      <div class="border rounded p-4 h-100 shadow-sm text-center">
        <div class="mb-3">
          <i class="bi bi-cash-coin fs-1 text-warning"></i>
        </div>
        <h5><strong>3-Automatic Payment</strong></h5>
        <p class="small text-muted">Once you confirm reading, the payment is instantly transferred to your wallet.</p>
      </div>
    </div>

    <!-- Step 4 -->
    <div class="col-md-6 col-lg-3">
      <div class="border rounded p-4 h-100 shadow-sm text-center">
        <div class="mb-3">
          <i class="bi bi-graph-up-arrow fs-1 text-danger"></i>
        </div>
        <h5><strong>4-Revenue Split</strong></h5>
        <p class="small text-muted">You get 80% of the payout. Read2Earn.cash retains 20% as a service fee.</p>
      </div>
    </div>

  </div>
</div>

<p>This creates a win-win situation: businesses get guaranteed human traffic and engagement with their content, while you earn money for reading articles that interest you.</p>
            
        </div>
    </section>

    <section class="content-section text-center py-2">
        <div class="container">
            <h2>How much can I make</h2>
            <p>Your earning potential is limitless—it depends on how many articles you read and the reward assigned to each. Advertisers determine the reward based on the article's niche and your country. The more you read, the more you earn, with no limits on the number of articles you can access. Whether you choose to read a few or many, your earnings are entirely in your hands. On average, our users earn $1,000 per month. Some even make over $5000 per month with referrals, the opportunities are endless</p>
            
        </div>
    </section>

    

    <section class="content-section text-center py-2">
        <div class="container">
            <h2>How Will I Get Paid</h2>
            <p>We pay you in USDT through Binance. You can add your Binance Pay ID either during signup or once you've reached the payment threshold of $15. After reaching the threshold, simply request your payment, and we'll transfer your earnings directly to your Binance account. From there, you can easily withdraw the funds to your local wallet or bank account.</p>
            
        </div>
    </section>

    <section class="content-section text-center py-2">
        <div class="container">
            <h2>When Will I Get Paid</h2>
            <p>You'll get paid once your balance reaches $15. As soon as you hit the $15 threshold, you can request a payment, and we'll promptly transfer the funds to your Binance wallet.</p>
           <!-- <img src="{{asset('assets/img/logo.png')}}" alt="Couple planning finances" class="img-fluid rounded mb-4"> -->
        </div>
    </section>

    <!-- How We Help Section -->
    <section class="content-section py-2">
        <div class="container text-center">
            <h2>What is Read2earn.cash</h2>
            <p>Read2earn.cash is the #1 and simplest way to earn money online, with no investment or skills required. All you need is a phone, internet connection, and some time. Just sign up and start reading to begin earning—it's that easy!</p>
            <p>Advertisers pay us to drive traffic to their websites, similar to how they pay platforms like Facebook or Google. In return, we give you a share of what the advertisers pay us. It’s a win-win for everyone: advertisers get visitors to their sites, you earn money, and we also profit.</p>
            
            
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="footer text-center">
        <div class="container">
            <img src="{{asset('assets/img/logo.png')}}" alt="Pursico Logo" class="img-fluid" style="max-width: 120px;">
            <nav class="mb-4">
                <a href="https://web.facebook.com/read2earn.cash" class="text-light mx-3" target="_blank">Contact Us</a>
                <a href="/terms" class="text-light mx-3">Privacy Policy</a>
        
                <a href="#" class="text-light mx-3" data-bs-toggle="modal" data-bs-target="#infoModal">About us</a>
                <a href="signup-publisher" class="text-light mx-3">Sign up</a>
                <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#contactModal">
  Contact Us
</button> -->

            </nav>
            <!-- <p class="disclaimer">The content on our site is free to use. Any financial results are not implied or guaranteed. Any results depend solely on the action taken by the individual. We monetize our service with advertisement, but no content will be prioritized based on other things than editorial relevance. For further questions we refer to our <a href="#">privacy policy</a>.</p> -->
            <p>&copy; 2025 Read2earn.cash</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>BeWell Square</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link href="{{ $faviconUrl }}" rel="icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assetses/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assetses/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assetses/vendor/aos/aos.css" rel="stylesheet">
    <link href="assetses/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assetses/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="assetses/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Append
  * Template URL: https://bootstrapmade.com/append-bootstrap-website-template/
  * Updated: May 18 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

            <a href="#hero" class="logo d-flex align-items-center me-auto me-xl-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assetses/img/logo.png" alt=""> -->
                <h1 class="sitename">BeWell Square</h1><span>.</span>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#portfolio">Product</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            {{-- <a class="btn-getstarted" href="index.html#about">Get Started</a> --}}
            {{-- <button id="addRow" class="btn-getstarted" data-bs-toggle="modal" id="create-btn" data-bs-target="#createRecordModal">Get Started</button> --}}
            <button type="button" class="btn-getstarted" data-bs-toggle="modal"
                data-bs-target=".bs-example-modal-lg">Get Started</button>


        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <img src="{{ $image }}" alt="" data-aos="fade-in">

            <div class="container">
                <div class="row">
                    <div class="col-lg-10">
                        <h2 data-aos="fade-up" data-aos-delay="100">{{ isset($banner->title) ? $banner->title : 'N/A' }}
                        </h2>
                        <p data-aos="fade-up" data-aos-delay="200">
                            {{ isset($banner->description) ? $banner->description : 'N/A' }}</p>
                    </div>
                </div>
            </div>



        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">
                <div class="">

                    <div class="content">
                        <h3 class="text-center">About Us</h3>
                        <h2>Crafting Timeless Spaces for 13 Years</h2>
                        <p><span class="fw-bold">BeWell Square</span> has been a pioneer in the interior design industry
                            for over a decade,
                            specializing in creating timeless and transformative spaces that enrich lives. With a
                            passion for innovation and a commitment to excellence, we continue to redefine the standards
                            of design craftsmanship. At BeWell Square, we believe in crafting more than just spaces; we
                            create experiences that inspire and endure.</p>
                        <h4>Our Vision</h4>
                        <p>Our vision is to be the leading provider of
                            innovative, high-quality interior design solutions that not only meet but exceed our
                            clients' expectations. We aim to create environments that blend aesthetics, functionality,
                            and sustainability, ensuring that each space is as unique as its occupants.</p>
                        {{-- <a href="#" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a> --}}
                    </div>

                </div>
            </div>

        </section><!-- /About Section -->

        <!-- Stats Section -->
        <section id="stats" class="stats section">

            <img src="{{ $stats_image }}" alt="" data-aos="fade-in">

            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0"
                                data-purecounter-end="{{ isset($stats->experience) ? $stats->experience : 'N/A' }}"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Years of Certified Experts</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0"
                                data-purecounter-end="{{ isset($stats->projects) ? $stats->projects : 'N/A' }}"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Finished Projects</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0"
                                data-purecounter-end="{{ isset($stats->client_satisfaction) ? $stats->client_satisfaction : 'N/A' }}"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Percent Client Satisfaction</p>
                        </div>
                    </div><!-- End Stats Item -->

                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item text-center w-100 h-100">
                            <span data-purecounter-start="0"
                                data-purecounter-end="{{ isset($stats->worker) ? $stats->worker : 'N/A' }}"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Workers</p>
                        </div>
                    </div><!-- End Stats Item -->

                </div>

            </div>

        </section><!-- /Stats Section -->

        <!-- Services Section -->
        <section id="services" class="services section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Services</h2>
                <p>Discover how our comprehensive design solutions can transform your spaces</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    @foreach ($services as $service)
                        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="service-item d-flex">
                                <div class="icon flex-shrink-0">
                                    @if ($service->icon)
                                        <img src="{{ $service->icon }}" alt="Service Icon"
                                            style="width: 50px; height: 50px;">
                                    @else
                                        <i class="bi bi-briefcase"></i>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="title">
                                        <p class="stretched-link">{{ $service->title }}</p>
                                    </h4>
                                    <p class="description">{{ $service->description }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

            </div>

        </section><!-- /Services Section -->

        <!-- Features Section -->
        <section id="features" class="features section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Features</h2>
                <p>Experience Unique Design Innovations</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4 align-items-center features-item">
                    <div class="col-lg-5 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                        <h3>{{ isset($feature->title) ? $feature->title : 'N/A' }}</h3>
                        <p>
                            {{ isset($feature->description) ? $feature->description : 'N/A' }}
                        </p>
                        <button type="button" class="btn btn-get-started" data-bs-toggle="modal"
                            data-bs-target=".bs-example-modal-lg">Get Started</button>
                    </div>
                    <div class="col-lg-7 order-1 order-lg-2 d-flex align-items-center" data-aos="zoom-out"
                        data-aos-delay="100">
                        <div class="image-stack">
                            <img src="{{ $image_one }}" alt="" class="stack-front">
                            <img src="{{ $image_two }}" alt="" class="stack-back">
                        </div>
                    </div>
                </div><!-- Features Item -->

                <div class="row gy-4 align-items-stretch justify-content-between features-item ">
                    <div class="col-lg-6 d-flex align-items-center features-img-bg" data-aos="zoom-out">
                        <img src="{{ $image_three }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-5 d-flex justify-content-center flex-column" data-aos="fade-up">
                        <h3>{{ isset($feature->title2) ? $feature->title2 : 'N/A' }}</h3>
                        <p>{{ isset($feature->description2) ? $feature->description2 : 'N/A' }}</p>
                        <ul>
                            <li><i class="bi bi-check"></i>
                                <span>{{ isset($feature->describe_one) ? $feature->describe_one : 'N/A' }}</span>
                            </li>
                            <li><i class="bi bi-check"></i><span>
                                    {{ isset($feature->describe_two) ? $feature->describe_two : 'N/A' }}</span></li>
                            <li><i class="bi bi-check"></i>
                                <span>{{ isset($feature->describe_three) ? $feature->describe_three : 'N/A' }}</span>.
                            </li>
                        </ul>
                        <button type="button" class="btn btn-get-started align-self-start" data-bs-toggle="modal"
                            data-bs-target=".bs-example-modal-lg">Get Started</button>
                    </div>
                </div><!-- Features Item -->

            </div>

        </section><!-- /Features Section -->

        <!-- Portfolio Section -->
        <section id="portfolio" class="portfolio section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Our Products</h2>
                <p>Discover our range of high-quality products designed to enhance your living spaces.</p>
            </div><!-- End Section Title -->


            <div class="container">

                <div class="isotope-layout" data-default-filter="*" data-layout="masonry"
                    data-sort="original-order">
                    <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                        <li data-filter="*" class="filter-active">All</li>
                        @php
                            $uniqueCategories = [];
                        @endphp
                        @foreach ($categories as $category)
                            @php
                                $formattedCategory = ucwords(
                                    str_replace('filter_', ' ', strtolower($category->category)),
                                );
                                $lowerCaseCategory = strtolower($category->category);
                            @endphp
                            @if (!in_array($lowerCaseCategory, $uniqueCategories))
                                @php
                                    $uniqueCategories[] = $lowerCaseCategory;
                                @endphp
                                <li data-filter=".{{ $lowerCaseCategory }}">{{ $formattedCategory }}</li>
                            @endif
                        @endforeach
                    </ul>


                    <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                        @php
                            $randomProducts = $products->shuffle()->take(12);
                        @endphp
                        @foreach ($randomProducts as $product)
                            @php
                                $categoryClass = strtolower($product->category);
                            @endphp
                            <div class="col-lg-4 col-md-6 portfolio-item isotope-item {{ $categoryClass }}">
                                <img src="{{ $product->image }}" class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <h4>{{ $product->title }}</h4>
                                    <p>{{ $product->description }}</p>
                                    <a href="{{ $product->image }}" title="{{ $product->title }}"
                                        data-gallery="portfolio-gallery-app" class="glightbox preview-link">
                                        <i class="bi bi-zoom-in"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>


            </div>

        </section>


        <!-- Faq Section -->
        <section id="faq" class="faq section">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="content px-xl-5">
                            <h3><span>Frequently Asked </span><strong>Questions</strong></h3>
                            <p>
                                Explore answers to common queries about our services and how we can assist you in
                                creating the perfect space. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                                do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in
                                reprehenderit.
                            </p>
                        </div>
                    </div>


                    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">

                        <div class="faq-container">
                            @foreach ($faqs as $key => $faq)
                                <div class="faq-item {{ $key == 0 ? 'faq-active' : '' }}">
                                    <h3><span
                                            class="num">{{ $key + 1 }}.</span><span>{{ $faq->title }}</span>
                                    </h3>
                                    <div class="faq-content">
                                        <p>{{ $faq->description }}</p>
                                    </div>
                                    <i class="faq-toggle bi bi-chevron-right"></i>
                                </div><!-- End Faq item-->
                            @endforeach
                        </div>


                    </div>
                </div>

            </div>

        </section><!-- /Faq Section -->

        <!-- Testimonials Section -->
        <section id="testimonials" class="testimonials section">

            <div class="container">

                <div class="row align-items-center">

                    <div class="col-lg-5 info" data-aos="fade-up" data-aos-delay="100">
                        <h3>Testimonials</h3>
                        <p>
                            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                            reprehenderit in voluptate
                            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                            proident.
                        </p>
                    </div>

                    <div class="col-lg-7" data-aos="fade-up" data-aos-delay="200">

                        <div class="swiper">
                            <script type="application/json" class="swiper-config">
                {
                  "loop": true,
                  "speed": 600,
                  "autoplay": {
                    "delay": 5000
                  },
                  "slidesPerView": "auto",
                  "pagination": {
                    "el": ".swiper-pagination",
                    "type": "bullets",
                    "clickable": true
                  }
                }
              </script>
                            <div class="swiper-wrapper">

                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="d-flex">
                                            <img src="assetses/img/testimonials/testimonials-1.jpg"
                                                class="testimonial-img flex-shrink-0" alt="">
                                            <div>
                                                <h3>Saul Goodman</h3>
                                                <h4>Ceo &amp; Founder</h4>
                                                <div class="stars">
                                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                        class="bi bi-star-fill"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p>
                                            <i class="bi bi-quote quote-icon-left"></i>
                                            <span>Proin iaculis purus consequat sem cure digni ssim donec porttitora
                                                entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam
                                                eget nibh et. Maecen aliquam, risus at semper.</span>
                                            <i class="bi bi-quote quote-icon-right"></i>
                                        </p>
                                    </div>
                                </div><!-- End testimonial item -->

                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="d-flex">
                                            <img src="assetses/img/testimonials/testimonials-2.jpg"
                                                class="testimonial-img flex-shrink-0" alt="">
                                            <div>
                                                <h3>Sara Wilsson</h3>
                                                <h4>Designer</h4>
                                                <div class="stars">
                                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                        class="bi bi-star-fill"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p>
                                            <i class="bi bi-quote quote-icon-left"></i>
                                            <span>Export tempor illum tamen malis malis eram quae irure esse labore quem
                                                cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua
                                                noster fugiat irure amet legam anim culpa.</span>
                                            <i class="bi bi-quote quote-icon-right"></i>
                                        </p>
                                    </div>
                                </div><!-- End testimonial item -->

                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="d-flex">
                                            <img src="assetses/img/testimonials/testimonials-3.jpg"
                                                class="testimonial-img flex-shrink-0" alt="">
                                            <div>
                                                <h3>Jena Karlis</h3>
                                                <h4>Store Owner</h4>
                                                <div class="stars">
                                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                        class="bi bi-star-fill"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p>
                                            <i class="bi bi-quote quote-icon-left"></i>
                                            <span>Enim nisi quem export duis labore cillum quae magna enim sint quorum
                                                nulla quem veniam duis minim tempor labore quem eram duis noster aute
                                                amet eram fore quis sint minim.</span>
                                            <i class="bi bi-quote quote-icon-right"></i>
                                        </p>
                                    </div>
                                </div><!-- End testimonial item -->

                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="d-flex">
                                            <img src="assetses/img/testimonials/testimonials-4.jpg"
                                                class="testimonial-img flex-shrink-0" alt="">
                                            <div>
                                                <h3>Matt Brandon</h3>
                                                <h4>Freelancer</h4>
                                                <div class="stars">
                                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                        class="bi bi-star-fill"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p>
                                            <i class="bi bi-quote quote-icon-left"></i>
                                            <span>Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos
                                                export minim fugiat minim velit minim dolor enim duis veniam ipsum anim
                                                magna sunt elit fore quem dolore labore illum veniam.</span>
                                            <i class="bi bi-quote quote-icon-right"></i>
                                        </p>
                                    </div>
                                </div><!-- End testimonial item -->

                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="d-flex">
                                            <img src="assetses/img/testimonials/testimonials-5.jpg"
                                                class="testimonial-img flex-shrink-0" alt="">
                                            <div>
                                                <h3>John Larson</h3>
                                                <h4>Entrepreneur</h4>
                                                <div class="stars">
                                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                        class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                                        class="bi bi-star-fill"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <p>
                                            <i class="bi bi-quote quote-icon-left"></i>
                                            <span>Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam
                                                tempor noster veniam enim culpa labore duis sunt culpa nulla illum
                                                cillum fugiat legam esse veniam culpa fore nisi cillum quid.</span>
                                            <i class="bi bi-quote quote-icon-right"></i>
                                        </p>
                                    </div>
                                </div><!-- End testimonial item -->

                            </div>
                            <div class="swiper-pagination"></div>
                        </div>

                    </div>

                </div>

            </div>

        </section><!-- /Testimonials Section -->

        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Contact</h2>
                <p>pursue your needs with us. Experience seamless connectivity and expert advice for all your interior
                    design inquiries.</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-6">

                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="info-item" data-aos="fade" data-aos-delay="200">
                                    <i class="bi bi-geo-alt"></i>
                                    <h3>Address</h3>
                                    <p>{{ $contact->address }}</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="col-md-6">
                                <div class="info-item" data-aos="fade" data-aos-delay="300">
                                    <i class="bi bi-telephone"></i>
                                    <h3>Call Us</h3>
                                    <p><span>+91 </span><a href="https://wa.me/91{{ $contact->phone1 }}"
                                            target="_blank">{{ $contact->phone2 }}</a> <span
                                            class="whats">WhatsApp</span></p>
                                    <p><span>+91</span> {{ $contact->phone2 }}</p>

                                </div>
                            </div>
                            <!-- End Info Item -->
                        </div>

                    </div>
                    <div class="col-lg-6">

                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="info-item" data-aos="fade" data-aos-delay="400">
                                    <i class="bi bi-envelope"></i>
                                    <h3>Email Us</h3>
                                    <p>{{ $contact->email1 }}</p>
                                    <p>{{ $contact->email2 }}</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="col-md-6">
                                <div class="info-item" data-aos="fade" data-aos-delay="500">
                                    <i class="bi bi-clock"></i>
                                    <h3>Open Hours</h3>
                                    <p>{{ $contact->opening_day }} - {{ $contact->closing_day }}</p>
                                    <p>{{ $contact->opening_time }} - {{ $contact->closing_time }}</p>
                                </div>
                            </div><!-- End Info Item -->

                        </div>

                    </div>

                </div>

            </div>

        </section><!-- /Contact Section -->

    </main>

    <footer id="footer" class="footer position-relative">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-5 col-md-12 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">BeWell Square</span>
                    </a>
                    <p>BeWellSquare specializes in transforming spaces through innovative interior design and renovation
                        solutions. Our expert team crafts bespoke environments tailored to your lifestyle and business
                        needs, ensuring quality and satisfaction every step of the way.</p>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Terms of service</a></li>
                        <li><a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-6 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><a href="#">Interior Design Solutions</a></li>
                        <li><a href="#">Home Renovation</a></li>
                        <li><a href="#">Custom Furniture</a></li>
                        <li><a href="#">Office Space Planning</a></li>
                        <li><a href="#">Lighting Design</a></li>
                    </ul>
                </div>


                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    <h4>Contact Us</h4>
                    <p>{{ $contact->address }}</p>
                    <p class="mt-4"><strong>Phone:</strong> +91 <span>{{ $contact->phone1 }}</span></p>
                    <p><strong>Email:</strong> <span>{{ $contact->email1 }}</span></p>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="sitename">Append</strong> <span>All Rights Reserved</span></p>
            <div class="credits">
            </div>
        </div>

    </footer>


    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    @include('Frontend.form_quote')

    <script>
        const preloaders = document.querySelector('#preloaders');
        if (preloaders) {
            window.addEventListener('load', () => {
                preloaders.remove();
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        window.spinner = '<div class="spinner-border" role="status">' +
            '<span class="visually-hidden">Loading...</span>' +
            '</div>';
        window.small_spinner = '<div class="spinner-border spinner-small" role="status">' +
            '<span class="visually-hidden">Loading...</span>' +
            '</div>';

        function preloaderEnable() {
            $('#preloader').css('visibility', 'visible');
            $('#preloader').css('opacity', '1');

        }

        function preloaderDisable() {
            $('#preloader').css('visibility', 'hidden');
            $('#preloader').css('opacity', '0');
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // SET GLOBAL VARIABLE
        window.startDate = "{{ date('Y-m-d', strtotime('-1 days')) }}";
        window.endDate = "{{ date('Y-m-d') }}";

        // reset select2 select box
        $('[type=reset]').click(function() {
            $('.form-control').val("").change();
        });

        function capitalizeFirstLetter(string) {
            return string.replace(/\b\w/g, function(match) {
                return match.toUpperCase();
            });
        }
    </script>
    <!-- Vendor JS Files -->
    <script src="assetses/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assetses/vendor/php-email-form/validate.js"></script>
    <script src="assetses/vendor/aos/aos.js"></script>
    <script src="assetses/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assetses/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assetses/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assetses/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assetses/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assetses/js/main.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('a[href^="#"]');

            links.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();

                    const targetId = this.getAttribute('href');
                    const targetElement = document.querySelector(targetId);

                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>


    @stack('scripts')

</body>

</html>

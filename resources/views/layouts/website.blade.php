<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Primary Meta Tags -->
    @hasSection('meta_content')
        @yield('meta_content')
    @else
        <!-- Fallback meta tags -->
        <title>TechnoxIt - IT Solutions & Business Services Template</title>
        <meta name="description" content="IT Solutions & Business Services Multipurpose Responsive Website Template">
        <meta name="keywords" content="IT solutions, Business Services, TechnoxIt, Bootstrap Template">

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="TechnoxIt - IT Solutions & Business Services Template">
        <meta property="og:description" content="IT Solutions & Business Services Multipurpose Responsive Website Template">
        <meta property="og:image" content="{{ asset('assets/website/images/og-image.jpg') }}">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ url()->current() }}">
        <meta property="twitter:title" content="TechnoxIt - IT Solutions & Business Services Template">
        <meta property="twitter:description" content="IT Solutions & Business Services Multipurpose Responsive Website Template">
        <meta property="twitter:image" content="{{ asset('assets/website/images/og-image.jpg') }}">
    @endif

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ $contact->fav_image ? asset('storage/' . $contact->fav_image) : asset('assets/default-favicon.ico') }}" type="image/x-icon">


    <!-- CSS Dependencies -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <!-- AOS Animation -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

    <!-- Phosphor Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.0.3/src/regular/style.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/website/css/style.css') }}">
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"
  />

@yield('style')

<style>
 /* Add to your CSS file */

 @media (max-width: 767.98px) {
    .mobile-center-button {
      justify-content: center;
    }
  }

/* #subscription-message {
    transition: all 0.3s ease;
} */
.text-black {
    color: black;
}

/* Success message container */
#subscription-message {
    margin-top: 1rem;

    display: none;
}

/* Alert styling with better contrast */
.alert-success {
    background-color: #d1fae5; /* Light green background */
    border-left: 4px solid #10b981; /* Darker green border */
    padding: 12px 16px;
    border-radius: 6px;
    color: black; /* Dark green text for better contrast */
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    transition: all 0.2s ease;

    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

/* Check icon styling */
.ph-check-circle {
    color: rgb(72 72 143) !important; /* Matching the border color */
    margin-right: 10px;
    font-size: 1.2rem;
}
/* Submit button styling */
.btn-link {
    background: none;
    border: none;
    padding: 0;
    cursor: pointer;
}

/* Paper plane icon - white with dark background */
.btn-link .ph-paper-plane-tilt {
    color: white !important;
    /* background-color: #10b981; Dark green background */
    border-radius: 50%;
    transition: all 0.2s ease;
}

/* Hover effect for submit button */
.btn-link:hover .ph-paper-plane-tilt {

    transform: scale(1.1);
}

/* Email input field */
.subscription-form input[type="email"] {
    border: 2px solid;
   background-color: transparent;
    outline: #d1fae5;
    width: 350px;
    color: white; /* Dark text for better contrast */
}

/* Loading spinner */
.ph-circle-notch.animate-spin {
    color: white;
}

.header-section .navbar .navbar-nav .dropdown-menu, .header-section .navbar .navbar-nav .sub-menu {
    background-color: #37b147;
   color: #ffffff !important;
}
.hover-green {
    color: #113877; /* default color */
    transition: color 0.3s ease; /* smooth transition */
}

.hover-green:hover {
    color: #37b147; /* your green-text color */
    cursor: pointer; /* optional, makes it look clickable */
}
/* Default (home page – transparent / slider background) */
.header-section {
    position: fixed;
    top: 0;
    z-index: 999;
}

.inner-page .header-section {
    background-color: #ffffff;
}

/* Mobile header background */
@media (max-width: 991.98px) {
    .header-section.header-menu {
        background-color: #ffffff !important; /* Blue background */
    }

    /* Optional: make the dropdown menu match the blue */
    .header-section.header-menu .navbar-collapse {
        background-color: #ffffff; /* ensures menu area is blue when expanded */
    }

    /* Dropdown links on mobile */
    .header-section.header-menu .navbar-nav .dropdown-menu {
        background-color: #41a83e;
    }

    /* Dropdown link text color */
    .header-section.header-menu .navbar-nav .dropdown-menu a {
        color: #113877; /* readable on blue */
    }
}
/* Minimized header for mobile */
@media (max-width: 991.98px) {
    .header-section.header-menu {
        padding: 4px 0 !important;
        background-color: #ffffff !important;
    }

    .header-section .navbar {
        min-height: 48px;
        padding: 0;
    }

    .header-section .navbar-toggler {
        padding: 4px;
        margin: 0;
    }
    .header-section .navbar .navbar-toggler span{
        margin-left: 120px;
        margin-top: -20px;

    }
}

/* MOBILE: force logo resize */
@media (max-width: 991.98px) {
    .header-section .navbar-brand img,
    .header-section .navbar-brand .logo {
        max-height: 50px !important;
        width: auto !important;
    }
}
.header-section .navbar-brand img,
    .header-section .navbar-brand .logo {
        max-height: 50px !important;
        width: auto !important;
    }

/* MOBILE ONLY */
@media (max-width: 991.98px) {

.mobile-service-item {
    width: 100%;
}

.mobile-service-item > div {
    padding: 10px 0;
}

/* Plus button */
.service-toggle {
    background: none;
    border: none;
    font-size: 22px;
    font-weight: bold;
    color: #113877;
    line-height: 1;
    padding: 0 8px;
    cursor: pointer;
}

/* Dropdown hidden by default */
.mobile-service-dropdown {
    display: none;
    list-style: none;
    padding-left: 15px;
    margin-top: 8px;
}

.mobile-service-dropdown li a {
    display: block;
    padding: 6px 0;
    color: #113877;
    font-size: 14px;
}

/* Active state */
.mobile-service-dropdown.show {
    display: block;
}
}
/* VISIBILITY CONTROL */
.desktop-only { display: block; }
.mobile-only { display: none; }

/* MOBILE ONLY */
@media (max-width: 991.98px) {
    .desktop-only { display: none !important; }
    .mobile-only { display: block !important; }

    .mobile-service-item {
        width: 100%;
    }

    .service-toggle {
        background: none;
        border: none;
        font-size: 22px;
        font-weight: bold;
        color: #113877;
        cursor: pointer;
        padding: 0 8px;
    }

    .mobile-service-dropdown {
        display: none;
        padding-left: 15px;
        margin-top: 8px;
        list-style: none;
    }

    .mobile-service-dropdown li a {
        display: block;
        padding: 6px 0;
        color: #113877;
        font-size: 14px;
    }

    .mobile-service-dropdown.show {
        display: block;
    }
}


/* ================= HEADER LINK COLOR RULE ================= */

@media (min-width: 992px) {
    body.inner-page .header-section a {
        color: #113877 !important;
    }
}

@media (max-width: 991.98px) {
    .header-section a {
        color: #113877 !important;
    }
}

/* Optional: caret / icons consistency */
@media (max-width: 991.98px) {
    .header-section i {
        color: #113877 !important;
    }
}


/* ================= FOOTER LOGO VISIBILITY FIX ================= */

.footer-logo-wrapper {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    background-color: #ffffff;   /* neutral contrast */
    padding: 10px 14px;
    border-radius: 8px;

    /* subtle professional separation */
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.footer-logo {
    max-height: 80px;
    width: auto;
    object-fit: contain; /* preserves original ratio */
}

/* Mobile adjustment */
@media (max-width: 576px) {
    .footer-logo {
        max-height: 65px;
    }
}
/* ================= HOME PAGE DESKTOP LOGO VISIBILITY FIX ================= */

/* Apply ONLY on home page & desktop */
@media (min-width: 992px) {
    body.home-page .home-logo-wrapper {
        background-color: #ffffff;      /* contrast layer */
        padding: 8px 14px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
    }

    body.home-page .home-logo {
        max-height: 60px;
        width: auto;
        object-fit: contain; /* keep original ratio */
    }
}
/* Desktop Services Dropdown - always white text */
@media (min-width: 992px) {
    /* Dropdown menu background (green) */
    .header-section .navbar-nav .dropdown-menu.drop_menu {
        background-color: #37b147 !important; /* keep green background */
    }

    /* Dropdown items text color */
    .header-section .navbar-nav .dropdown-menu.drop_menu li a {
        color: #ffffff !important; /* force white text */
    }

    /* Optional: hover effect */
    .header-section .navbar-nav .dropdown-menu.drop_menu li a:hover {
        color: #d1fae5 !important; /* light green on hover */
        background-color: transparent; /* keep transparent hover bg */
    }
}
/* Ensure dropdown caret is visible on fixed header */
/* .header-section.header-menu .dropdown-toggle i.ph-caret-down {
    color: #113877 !important;
    font-size: 0.8rem;         }
*/


</style>

    <!-- ICON  -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
  </head>
  <body class="{{ request()->routeIs('index') ? 'home-page' : 'inner-page' }}">
    <!-- <button id="rtlBtn">rtl</button> -->

    <div class="social-card">
  <a href="{{ $contact->facebook_link?? '#'}}" class="social-icon" target="_blank" style="padding-top:5px">
    <img src="https://cdn-icons-png.flaticon.com/512/124/124010.png" alt="Facebook" />
  </a>

  <a href="{{ $contact->whatsapp_link?? '#' }}" class="social-icon" target="_blank">
  <img src="https://cdn-icons-png.flaticon.com/512/733/733585.png" alt="WhatsApp" />
</a>
  <a href="{{ $contact->twitter_link?? '#' }}" class="social-icon" target="_blank">
  <img src="https://cdn-icons-png.flaticon.com/512/5969/5969020.png" alt="Twitter (X)" />
</a>

  <a href="{{ $contact->Linkedin_link?? '#'}}" class="social-icon" target="_blank">
    <img src="https://cdn-icons-png.flaticon.com/512/145/145807.png" alt="LinkedIn" />
  </a>
</div>


    <!-- header-section start -->
 <!-- header-section start -->
<header class="header-section header-menu w-100 pt-1 pt-lg-0 pb-3 pb-lg-0">
    <div class="navbar_mainhead header-fixed w-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg position-relative d-flex align-items-center">

                        <!-- LOGO -->
                        <div>
                            <!-- Desktop logo -->
                            <a href="{{ route('index') }}" class="navbar-brand d-none d-sm-flex align-items-center gap-2 home-logo-wrapper">
                                @if(isset($contact) && $contact->company_logo)
                                    <img src="{{ asset('storage/' . $contact->company_logo) }}" class="logo home-logo" alt="Company Logo">
                                @else
                                    <img src="{{ asset('assets/website/images/logo.png') }}" class="logo home-logo" alt="Fallback Logo">
                                @endif
                            </a>

                            <!-- Mobile logo -->
                            <a href="{{ route('index') }}" class="navbar-brand d-sm-none d-flex align-items-center gap-2">
                                @if(isset($contact) && $contact->company_logo)
                                    <img src="{{ asset('storage/' . $contact->company_logo) }}" class="logo" alt="Company Logo">
                                @else
                                    <img src="{{ asset('assets/website/images/fav.png') }}" class="logo" alt="Fallback Logo">
                                @endif
                            </a>
                        </div>

                        <!-- NAVIGATION -->
                        <div class="collapse navbar-collapse" id="navbar-content">
                            <ul class="navbar-nav d-flex align-items-lg-center gap-5 gap-lg-1 gap-xl-4 gap-xxl-5 py-2 py-lg-0 ms-2 ms-xl-10 ms-xxl-20 ps-0 ps-xxl-10 align-self-center">

                                <li class="dropdown"><a href="{{ route('index') }}" class="fs-ten">Home</a></li>
                                <li class="dropdown"><a href="{{ route('aboutUs') }}" class="fs-ten">About</a></li>

                                <!-- Desktop Services dropdown -->
                                <li class="dropdown show-dropdown dropdown_btn desktop-only">
                                    <a href="{{ route('allservices') }}" class="dropdown-toggle dropdown-nav dropdown-item d-flex gap-1 align-items-center fs-ten">
                                        Services <i class="ph-bold ph-caret-down"></i>
                                    </a>
                                    <ul class="dropdown-menu drop_menu">
                                        @foreach($publishedServices as $service)
                                            <li>
                                                <a class="dropdown-item fs-ten service-dropdown"  href="{{ route('service.details', $service->slug) }}">
                                                    {{ $service->title }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>

                                <!-- Mobile Services dropdown -->
                                <li class="mobile-only mobile-service-item">
                                    <div class="d-flex justify-content-between align-items-center w-100">
                                        <a href="{{ route('allservices') }}" class="fs-ten">Services</a>
                                        <button type="button" class="service-toggle" aria-label="Toggle Services">+</button>
                                    </div>
                                    <ul class="mobile-service-dropdown">
                                        @foreach($publishedServices as $service)
                                            <li>
                                                <a href="{{ route('service.details', $service->slug) }}">{{ $service->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>

                                <li class="dropdown show-dropdown"><a href="{{ route('allportfolio') }}" class="fs-ten">Gallery</a></li>
                                <li class="dropdown show-dropdown"><a href="{{ route('allcareer') }}" class="fs-ten">Career</a></li>
                            </ul>
                        </div>

                        <!-- CONTACT BUTTON + TOGGLER -->
                        <div class="right-area custom-pos position-relative d-flex gap-0 gap-xl-5 align-items-center">
                            <a href="{{ route('contact') }}" class="btn p6-color d-none d-xl-block">
                                <span class="btn-text-one">Contact Us</span>
                                <span class="btn-text-two">Contact Us</span>
                            </a>

                            <button class="navbar-toggler mt-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-content" aria-expanded="false" aria-label="Navbar Toggler" id="nav-icon3">
                                <span></span><span></span><span></span><span></span>
                            </button>
                        </div>

                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header-section end -->



@yield('content')






    <!-- Footer section start -->
<section class="bg11-color footer_section">
    <div class="pt-8 pb-8">
        <div class="container">
            <div class="row g-6">
            <div class="col-12 col-xl-3">  <!-- Changed from col-xl-4 to col-xl-3 -->
            <div class="mb-3 mb-lg-4">  <!-- Reduced mb-lg-6 to mb-lg-4 -->
                <div class="footer-logo-wrapper">
                    @if($contact->company_logo)
                        <img
                            src="{{ asset('storage/' . $contact->company_logo) }}"
                            alt="Company Logo"
                            class="footer-logo"
                        />
                    @else
                        <img
                            src="{{ asset('assets/website/images/logo.png') }}"
                            alt="Company Logo"
                            class="footer-logo"
                        />
                    @endif
                </div>

                    </div>
                    <p class="p6-color fs-ten">
                        {{ $contact->company_description ?? 'We have 14+ years experience. Helping you overcome technology challenges. Join the thriving technox it solution agency.' }}
                    </p>
                    <div class="my-3 my-sm-5 my-md-10">
                        <button class="btn2" href="{{ route('contact') }}">
                            <span class="btn-text-one">Contact Us</span>
                            <span class="btn-text-two">Contact Us</span>
                        </button>
                    </div>
                    <div>
                        <h4 class="fs-five p6-color mb-2 mb-md-4">Our Social info</h4>
                        <div class="d-flex flex-wrap gap-3">
    <a href="{{ $contact->facebook_link ?? '#' }}" class="footer_icon d-flex justify-content-center align-items-center" target="_blank">
        <i class="ph ph-facebook-logo fs-six"></i>
    </a>

    <a href="{{ $contact->twitter_link ?? '#' }}" class="footer_icon d-flex justify-content-center align-items-center" target="_blank">
        <i class="ph ph-x-logo fs-six"></i>
    </a>

    <a href="{{ $contact->Linkedin_link ?? '#' }}" class="footer_icon d-flex justify-content-center align-items-center" target="_blank">
        <i class="ph ph-linkedin-logo fs-six"></i>
    </a>

    <a href="{{ $contact->instagram_link ?? '#' }}" class="footer_icon d-flex justify-content-center align-items-center" target="_blank">
        <i class="ph ph-instagram-logo fs-six"></i>
    </a>

    <a href="{{ $contact->whatsapp_link ?? '#' }}" class="footer_icon d-flex justify-content-center align-items-center" target="_blank">
        <i class="ph ph-whatsapp-logo fs-six"></i>
    </a>
</div>

                    </div>
                </div>


<div class="col-sm-6 col-xl-4">
    <h4 class="fs-five p6-color mb-3 mb-md-4">Our Services</h4>
    <div class="service-list-single">  <!-- Single column layout -->
        @if(isset($publishedServices) && $publishedServices->count() > 0)
            @foreach($publishedServices as $service)
                @if($service->slug)
                    <a href="{{ route('service.details', $service->slug) }}"
                       class="d-flex align-items-center gap-2 mb-2">
                        <img src="{{ asset('assets/website/images/point.png') }}"
                             alt="point"
                             style="width:12px;">
                        <span class="fs-ten p6-color fw-medium footer_tag text-wrap">
                            {{ $service->title }}
                        </span>
                    </a>
                @endif
            @endforeach
        @else
            <div class="d-flex align-items-center gap-2">
                <img src="{{ asset('assets/website/images/point.png') }}"
                     alt="point"
                     style="width:12px;">
                <span class="fs-ten p6-color fw-medium footer_tag">
                    No Services Available
                </span>
            </div>
        @endif
    </div>
</div>



                <div class="col-sm-6 col-xl-2">
              <h4 class="fs-five p6-color mb-3 mb-md-5">Quick links </h4>
              <a
                href="{{route('index')}}"
                class="d-flex align-items-center flex-shrink-0 gap-2 mb-2 mb-md-3"
              >
                <div>
                  <img src="{{ asset('assets/website/images/point.png') }}" alt="point" />
                </div>
                <span class="fs-ten p6-color fw-medium footer_tag">Home</span>
              </a>
              <a
                href="{{ route('aboutUs') }}"
                class="d-flex align-items-center flex-shrink-0 gap-2 mb-2 mb-md-3"
              >
                <div>
                  <img src="{{ asset('assets/website/images/point.png') }}" alt="point" />
                </div>
                <span class="fs-ten p6-color fw-medium footer_tag"
                  >About</span
                >
              </a>


              <a
                href="{{ route('allteam') }}"
                class="d-flex align-items-center flex-shrink-0 gap-2 mb-2 mb-md-3"
              >
                <div>
                  <img src="{{ asset('assets/website/images/point.png') }}" alt="point" />
                </div>
                <span class="fs-ten p6-color fw-medium footer_tag"
                  >Our Team</span
                >
              </a>
              <a
              href="{{ route('allportfolio') }}"
              class="d-flex align-items-center flex-shrink-0 gap-2 mb-2 mb-md-3"
            >
              <div>
                <img src="{{ asset('assets/website/images/point.png') }}" alt="point" />
              </div>
              <span class="fs-ten p6-color fw-medium footer_tag">Gallery</span>
            </a>
              <a
                href="{{ route('allcareer') }}"
                class="d-flex align-items-center flex-shrink-0 gap-2 mb-2 mb-md-3"
              >
                <div>
                  <img src="{{ asset('assets/website/images/point.png') }}" alt="point" />
                </div>
                <span class="fs-ten p6-color fw-medium footer_tag"
                  >Career</span
                >
              </a>



            </div>

            <div class="col-12 col-xl-3">
            <h4 class="fs-five p6-color mb-3 mb-md-5">Contacts</h4>
                    <div class="d-flex gap-2 gap-md-4 align-items-center mb-3 mb-md-5">
                        <i class="ph-fill ph-map-pin fs-six p6-color"></i>
                        <span>{{ $contact->address_info ?? '2 Embarcadero Center, San Francisco, CA 94111 USA' }}</span>
                    </div>
                    <div class="d-flex gap-2 gap-md-4 align-items-center mb-3 mb-md-5">
                        <i class="ph-fill ph-phone-incoming fs-six p6-color"></i>
                        <a href="tel:{{ $contact->phone ?? '+1-800-555-1212' }}">{{ $contact->phone ?? '+1 (800) 555-1212' }}</a>
                    </div>
                    <div class="d-flex gap-2 gap-md-4 align-items-center">
                        <i class="ph-fill ph-envelope fs-six p6-color"></i>
                        <a href="mailto:{{ $contact->email ?? 'support@domain.com' }}">{{ $contact->email ?? 'support@domain.com' }}</a>
                    </div>

                    <div class="mt-5 mt-md-9 mt-md-18">
                            <h4 class="fs-four fw-semibold p6-color mb-2 mb-md-4">
                                Subscribe Now
                            </h4>
                            <p class="fs-ten p6-color">
                                {{ $contact->subscription ?? "Don't miss to subscribe to our new feeds, kindly fill the form below." }}
                            </p>


                                            <!-- Success message container with better visibility -->
                                            <div id="subscription-message" class="mb-4">
                                                <div class="alert-success">
                                                    <i class="ph ph-check-circle"></i>
                                                    <span id="message-text" class="text-black"></span>
                                                </div>
                                            </div>


                            <form action="{{ route('backend.subscriptions.store') }}" method="POST" class="subscription-form">
                                @csrf
                                <div class="d-flex gap-2 align-items-center border-bottom mt-5 mt-md-10 pb-3 pb-md-6">
                                    <input
                                        type="email"
                                        name="email"
                                        class="p6-color fs-ten px-2"
                                        placeholder="YourEmail@example.com"
                                        required
                                    />
                                    <button type="submit" class="btn btn-link p-0">
                                    <i class="ph-fill ph-paper-plane-tilt fs-three text-white hover:text-white"></i>
                                </button>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="border cus-border border-four my-0" />
    <div class="container d-flex sm:gap-3 flex-wrap justify-content-md-between justify-content-center py-3 py-md-6">
        <span class="p6-color sm:fs-ten">{{$contact->company_name}} © {{ date('Y') }} </span>
        <div class="d-flex gap-4">
            <a href="#" class="p6-color sm:fs-ten">Terms & Conditions</a>
            <span class="p6-color sm:fs-ten">|</span>
            <a href="#" class="p6-color sm:fs-ten">Privacy Policy</a>
        </div>
    </div>
</section>
<!-- Footer section end -->

 <script src="{{ asset('assets/website/cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js') }}"></script>

<script src="{{ asset('assets/website/js/main.js') }}"></script>
<script src="{{ asset('assets/website/js/plugins/plugins.js') }}"></script>

<script src="{{ asset('assets/website/js/custom-plugin.js') }}"></script>

<script src="{{ asset('assets/website/cdn.jsdelivr.net/npm/aos@3.0.0-beta.6/dist/aos.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script>
 document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('.subscription-form');

    forms.forEach(form => {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(form);
            const submitButton = form.querySelector('button[type="submit"]');
            const messageContainer = document.getElementById('subscription-message');
            const messageText = document.getElementById('message-text');
            const icon = submitButton.querySelector('i');

            // Store original icon HTML
            const originalIcon = icon.outerHTML;

            // Show loading state
            icon.className = 'ph ph-circle-notch fs-three animate-spin';

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (response.ok) {
                    // Show success message
                    messageText.textContent = data.success || 'Thank you for subscribing!';
                    messageContainer.style.display = 'flex';
                    form.reset();

                    // Hide message after 5 seconds
                    setTimeout(() => {
                        messageContainer.style.display = 'none';
                    }, 5000);
                } else {
                    // Show error message
                    messageText.textContent = data.message || 'Error: Please try again.';
                    messageContainer.style.display = 'flex';
                }
            } catch (error) {
                messageText.textContent = 'Network error. Please try again';
                messageContainer.style.display = 'flex';
            } finally {
                // Reset button icon
                submitButton.querySelector('i').outerHTML = originalIcon;
            }
        });
    });
});
  </script>
    <script>
      AOS.init({
        offset: 120,
        duration: 700,
        easing: "ease-in-out",
      });
    </script>
    <script>
  $(document).ready(function(){
    $(".owl-carousel").owlCarousel({
      loop:true,
      margin:10,
      nav:true,
      autoplay:true,
      autoplayTimeout:3000,
      responsive:{
        0:{ items:1 },
        600:{ items:2 },
        1000:{ items:3 }
      }
    });
  });
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const allProductsLink = document.getElementById('all-products-link');

    function checkDevice() {
        if (window.innerWidth <= 991) { // Mobile and Tablet
            allProductsLink.removeAttribute('href');
            allProductsLink.style.pointerEvents = "none"; // Just to be extra safe
            allProductsLink.style.color = "#8baacf"; // optional: style adjustment
        } else {
            allProductsLink.setAttribute('href', "#");
            allProductsLink.style.pointerEvents = "auto";
        }
    }

    checkDevice(); // run once
    window.addEventListener('resize', checkDevice); // run on resize
});
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".service-toggle").forEach(btn => {
            btn.addEventListener("click", function () {
                const dropdown = this.closest(".mobile-service-item")
                    .querySelector(".mobile-service-dropdown");

                dropdown.classList.toggle("show");
                this.textContent = dropdown.classList.contains("show") ? "−" : "+";
            });
        });
    });
    </script>


  </body>

<!-- Mirrored from softivuspro.com/html/Technoxit/TechnoX1/services.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 23 Mar 2025 07:02:16 GMT -->
</html>

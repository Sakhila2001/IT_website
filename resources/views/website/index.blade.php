@extends('layouts.website')

@section('meta_content')
    <!-- HTML Meta Tags -->
    <title>{{ $home->heading ?? 'Our Services' }}</title>
    <meta name="description" content="{{ $seoData['seo_description'] ?? '' }}">
@php
    $keywords = '';
    if (!empty($seoData['seo_keyword'])) {
        $decoded = json_decode($seoData['seo_keyword'], true);
        if (is_array($decoded)) {
            $keywords = collect($decoded)->pluck('value')->implode(', ');
        } else {
            $keywords = $seoData['seo_keyword']; // fallback if it's already plain text
        }
    }
@endphp

<meta name="keywords" content="{{ $keywords }}">

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="{{ str_replace('http://', 'https://', url()->current()) }}">
        <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $seoData['title'] ?? 'Our Services' }} - {{ App\Helpers\Helper::getInfoValue('name') ?? '' }}">
    <meta property="og:description" content="{{ $seoData['seo_description'] ?? '' }}">
    @if(!empty($seoData['seo_image']))
    <meta property="og:image" content="{{ asset($seoData['seo_image'], true) }}">
    <meta property="og:image:alt" content="{{ $seoData['title'] ?? 'Our Services' }} - {{ App\Helpers\Helper::getInfoValue('name') ?? '' }}">
    @endif

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="{{ str_replace('http://', 'https://', url()->current()) }}">
    <meta property="twitter:url" content="{{ str_replace('http://', 'https://', url()->current()) }}">
    <meta name="twitter:title" content="{{ $seoData['title'] ?? 'Our Services' }} - {{ App\Helpers\Helper::getInfoValue('name') ?? '' }}">
    <meta name="twitter:description" content="{{ $seoData['seo_description'] ?? '' }}">
    @if(!empty($seoData['seo_image']))
    <meta name="twitter:image" content="{{ asset($seoData['seo_image'], true) }}">
    @endif
    <!-- SEO by Susan Paudel -->
@endsection

@section('style')
<style>
.desc-section p,
.desc-section h1,
.desc-section h2,
.desc-section h3,
.desc-section h4,
.desc-section h5,
.desc-section h6,
.desc-section li,
.desc-section ul,
.desc-section ol,
.desc-section div,
.desc-section b,
.desc-section strong,
.desc-section em,
.desc-section i,
.desc-section span {
  color: #3871b6 !important;
  font-size: 18px;
    line-height: 130%;
}
.desc-section{
  color: #3871b6 !important;
  font-size: 18px;
    line-height: 130%;
}

.desc-section ul {
  list-style-type: disc;
  padding-left: 1.5rem;
  margin-left: 0;
  color: #3871b6;
}

.desc-section ol {
  list-style-type: decimal;
  padding-left: 1.5rem;
  margin-left: 0;
  color: #3871b6;
}
.team-img {
        height: 320px;
        object-fit: cover;
        width: 100%;
        border-radius: 8px;
    }

    /* Mobile view (screens <= 576px) */
    @media (max-width: 576px) {
        .team-img {
            height: 150px; /* Uniform height for all rows in mobile view */
            width: 100%;
        }

        .team-content {
            padding: 1rem !important; /* Override p-3 for mobile */
        }

        .team-content h4 {
            font-size: 1rem; /* Smaller font for name */
        }

        .team-content span.fs-ten {
            font-size: 0.8rem; /* Smaller font for designation */
        }
    }
    .hero-slider {
    transition: background-image 1s ease-in-out;
}
.service-card {
    height: 100%;
    display: flex;
    flex-direction: column;
    border-radius: 12px;
    background: #fff;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1); /* subtle shadow */
    overflow: hidden;
}

.service-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 24px rgba(0,0,0,0.15); /* pop-out shadow on hover */
}
.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.3);
    z-index: 1;
}

.hero-content {
    position: relative;
    z-index: 2;
    width: 100%;
    height: 100%;
}


</style>
@endsection

@section('content')
@php
    $heroImages = [];

    if (!empty($home->hero_background_image)) {
        $heroImages = is_array($home->hero_background_image)
            ? $home->hero_background_image
            : json_decode($home->hero_background_image, true);
    }

    if (empty($heroImages)) {
        $heroImages = ['assets/website/images/hero.jpg'];
    }
@endphp

    <!-- Hero section start -->
    <section class="particial-bg hero-slider"
    data-images='@json(array_map(fn($img) => asset("storage/".$img), $heroImages))'
    style="background-size: cover; background-position: center; background-attachment: fixed; position: relative;">

<!-- Overlay -->
<div class="hero-overlay"></div>

<!-- Hero Content -->
<div class="hero-content d-flex align-items-center justify-content-center h-100">
   <div>
       <div data-aos="fade-up" data-aos-duration="800"
            class="w-100 d-flex gap-3 align-items-center px-3 px-lg-5 py-2 py-lg-3 border cus-border second rounded-pill hero_hot mb-3 mb-lg-6">
           <button class="px-3 px-lg-5 py-2 rounded-pill p5-color bg3-color">Hot</button>
           <span class="p6-color">{{ $home->hot_heading_section ?? 'Delivering Superior Services IT Solutions' }}</span>
       </div>

       <h2 class="fs-one p6-color fw-bold mb-3 mb-lg-5" data-aos="fade-up" data-aos-duration="800">
           {{ $home->heading ?? 'Providing The Best Services & IT Solutions' }}
       </h2>

       <p class="p6-color fs-ten" data-aos="fade-down" data-aos-duration="800">
           {{ $home->heading_description ?? 'Easily customize this template to your preferences...' }}
       </p>

       <div data-aos="fade-down" data-aos-duration="800">
           <div class="d-flex flex-wrap gap-3 gap-md-6 my-5 my-md-10">
               <a href="{{ route('contact') }}" class="btn p6-color">
                   <span class="btn-text-one">Contact Us</span>
                   <span class="btn-text-two">Contact Us</span>
               </a>
           </div>

           <div class="d-flex flex-wrap gap-3">
               @isset($contactDetails)
                   <a href="{{ $contactDetails->facebook_link ?? '#' }}" class="footer_icon d-flex justify-content-center align-items-center" target="_blank">
                       <i class="ph ph-facebook-logo fs-six"></i>
                   </a>
                   <a href="{{ $contactDetails->twitter_link ?? '#' }}" class="footer_icon d-flex justify-content-center align-items-center" target="_blank">
                       <i class="ph ph-x-logo fs-six"></i>
                   </a>
                   <a href="{{ $contactDetails->linkedin_link ?? '#' }}" class="footer_icon d-flex justify-content-center align-items-center" target="_blank">
                       <i class="ph ph-linkedin-logo fs-six"></i>
                   </a>
                   <a href="{{ $contactDetails->instagram_link ?? '#' }}" class="footer_icon d-flex justify-content-center align-items-center" target="_blank">
                       <i class="ph ph-instagram-logo fs-six"></i>
                   </a>
                   <a href="{{ $contactDetails->whatsapp_link ?? '#' }}" class="footer_icon d-flex justify-content-center align-items-center" target="_blank">
                       <i class="ph ph-whatsapp-logo fs-six"></i>
                   </a>
               @else
                   <p>No social links available.</p>
               @endisset
           </div>
       </div>
   </div>
</div>
</section>

    <!-- Hero section end -->

    <!-- service section start  -->
    <section class="pt-120 pb-120" style="margin-bottom:80px; margin-top:80px;">
        <div class="container">

            <!-- Heading Row -->
            <div class="row g-5 align-items-center mb-6">

                <!-- Heading Content (left aligned like Choose Us) -->
                <div class="col-xl-7">
                    <div class="service_heading" data-aos="fade-down" data-aos-duration="800">
                        <span class="fs-ten fw-semibold p2-color mb-2 d-block">
                            {{ $serviceHeading->small_heading ?? '' }}
                        </span>

                        <h2 class="fs-two fw-semibold p8-color mb-6 w-100">
                            {{ $serviceHeading->heading ?? 'Our Services' }}
                        </h2>

                        <p class="fs-ten p4-color">
                            {!! $serviceHeading->heading_description ?? '' !!}
                        </p>
                    </div>
                </div>

                <!-- See Services Button (right side column) -->
                <div class="col-xl-5 d-flex justify-content-xl-end justify-content-start">
                    <a href="{{ route('allservices') }}" class="btn p6-color mt-4 mt-xl-0">
                        <span class="btn-text-one">See Services</span>
                        <span class="btn-text-two">See Services</span>
                    </a>
                </div>

            </div>

            <!-- Services Grid -->
            <div class="row g-4 mt-7 mt-lg-15">
                @foreach ($services as $service)
                    <div class="col-12 col-sm-6 col-xl-4" data-aos="fade-up" data-aos-duration="700">
                        <a href="{{ route('service.details', $service->slug) }}" class="text-decoration-none h-100 d-block">
                            <div class="service-card shadow-card" style="padding: 20px;">

                                <!-- Image -->
                                <div class="service-image">
                                    <img
                                        src="{{ !empty($service->image) ? asset('storage/' . $service->image) : asset('default-icon.png') }}"
                                        alt="{{ $service->title }}"
                                        loading="lazy"
                                    >
                                </div>

                                <!-- Content -->
                                <div class="service-content text-center pt-3">
                                    <h4 class="fs-five fw-semibold p8-color mb-3">{{ $service->title }}</h4>

                                    <p class="p4-color fs-ten service-desc">
                                        {!! Str::limit(strip_tags($service->description), 100) !!}
                                    </p>

                                    @if(strlen(strip_tags($service->description)) > 100)
                                        <span class="see-more">See more →</span>
                                    @endif
                                </div>

                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

        </div>
    </section>





    <!-- service section end  -->



    <!-- Choose us section Start -->
<section class="pt-120 pb-120">
  <div class="container">
    <div class="row g-5">
      <div class="col-xl-7">
        <div class="h-100">
          <div class="service_heading" data-aos="fade-down" data-aos-duration="800">
            <span class="fs-ten fw-semibold p2-color mb-2">
              {{ $chooseHeading->small_heading ?? 'Why Choose Us' }}
            </span>
            <h2 class="fs-two fw-semibold p8-color mb-6 w-100">
              {{ $chooseHeading->heading ?? 'We provide perfect IT solutions & technology for any startups.' }}
            </h2>
            <p class="fs-ten p4-color">
              {{ $chooseHeading->heading_description ?? 'Start work with Technox. Build responsive, mobile-first projects on the web with the world\'s most popular front-end component library.' }}
            </p>
          </div>

          @if($choose->count() > 0)
          <div class="mt-8 mt-lg-15">
            <div class="row g-4 g-lg-8">
              @foreach($choose as $chose)
              <div class="col-md-6" data-aos="fade-up" data-aos-duration="{{ $loop->index % 2 == 0 ? '800' : '900' }}">
                @if($chose->icon_image)
                  <img src="{{ asset('storage/' . $chose->icon_image) }}" alt="{{ $chose->title?? ' '  }}" width="60" height="60">
                @else
                  <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:60px;height:60px;">
                    <i class="fas fa-check fs-4"></i>
                  </div>
                @endif
                <h5 class="fs-five p8-color mt-3 mt-lg-6 mb-2 mb-lg-4">
                  {{ $chose->title?? ' ' }}
                </h5>
                <p class="fs-ten p4-color">
                  {{ $chose->description ?? 'Technox provides excellent services with professional team.' }}
                </p>
              </div>
              @endforeach
            </div>
          </div>
          @else
          <div class="alert alert-info mt-5">
            No "Why Choose Us" items available
          </div>
          @endif

          <div class="mt-6 mt-lg-12 d-flex flex-wrap gap-4 gap-lg-8 d-flex align-items-center" data-aos="fade-up" data-aos-duration="800">
            <a href="{{ route('contact') }}" class="btn p6-color">
              <span class="btn-text-one">Contact Us</span>
              <span class="btn-text-two">Contact Us</span>
            </a>
            <div class="d-flex align-items-center gap-lg-5">
              <div class="d-flex">
                <div class="choose_icon_width bg1-color d-flex flex-shrink-0 justify-content-center align-items-center">
                  <i class="ph ph-phone-call text-white fs-three"></i>
                </div>

              </div>
              <a href="tel:{{ $contact->phone }}" class="p4-color fw-semibold fs-six">
                  {{ $contact->phone }}
                </a>

            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-5" data-aos="zoom-in" data-aos-duration="800">
        <div class="">
            <img class="choose_us object-fit-cover"
                 src="{{ !empty($chooseHeading->banner_image) ? asset('storage/' . $chooseHeading->banner_image) : asset('assets/website/images/choose_us.png') }}"
                 alt="Why Choose Us">
        </div>
    </div>
    </div>
  </div>
</section>
<!-- Choose us section End -->

 <!-- Portfolio section start -->
{{-- <section class="pt-120 bg7-color">
  <div class="container">
    <div class="process_heading w-100 text-center" data-aos="fade-down" data-aos-duration="800">
      <span class="fs-ten fw-semibold p2-color mb-2 text-center">
        {{ optional($portfolioHeading)->small_heading ?? 'Our Portfolios' }}
      </span>
      <h2 class="fs-two fw-semibold p8-color mb-3 mb-lg-6">
        {{ optional($portfolioHeading)->heading ?? 'Work & Project' }}
      </h2>
      <p class="fs-ten p4-color">
        {{ optional($portfolioHeading)->heading_description ?? 'Build responsive, mobile-first projects on the web with the worlds most popular front-end component library.' }}
      </p>
    </div>

    @if(!empty($portfolios) && $portfolios->count() > 0)
      <div>
        <ul data-aos="zoom-in" data-aos-duration="800" class="tabs d-flex justify-content-center flex-wrap gap-2 gap-md-3 p-2 mt-8 mt-lg-15 mb-4 md:mb-8">
          <li data-tab-target="#all" class="active cursor-pointer p4-color border cus-border border-six rounded-pill px-3 px-md-6 py-2 py-md-3 tab">
            All
          </li>
          @if(!empty($portfoliocategories) && $portfoliocategories->count() > 0)
            @foreach ($portfoliocategories as $category)
              <li
                data-tab-target="#{{ Str::slug($category->name ?? 'uncategorized') }}"
                class="cursor-pointer p4-color border cus-border border-six rounded-pill px-3 px-md-6 py-2 py-md-3 tab"
              >
                {{ $category->name ?? 'Uncategorized' }}
              </li>
            @endforeach
          @endif
        </ul>

        <div class="tab-content position-relative">
          <div id="all" data-tab-content class="active">
            <div class="row g-3">
              @foreach ($portfolios as $portfolio)
                <div class="col-sm-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-duration="700">
                  <div class="single_project position-relative z-1">
                    <div>
                      @if($portfolio->image)
                        <img src="{{ asset('storage/' . $portfolio->image) }}" class="w-full" alt="{{ e($portfolio->title ?? 'Portfolio Item') }}" />
                      @else
                        <img src="{{ asset('images/placeholder.jpg') }}" class="w-full" alt="{{ e($portfolio->title ?? 'Portfolio Item') }}" />
                      @endif
                    </div>
                    <div class="p-3 p-md-5 position-absolute bottom-0 bg6-color w-100 project-content z-2">
                      <h4 class="p1-color fs-five mb-2 mb-md-4">{{ $portfolio->title ?? 'Untitled Project' }}</h4>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>

          @if(!empty($portfoliocategories) && $portfoliocategories->count() > 0)
            @foreach ($portfoliocategories as $category)
              <div id="{{ Str::slug($category->name ?? 'uncategorized') }}" data-tab-content>
                <div class="row g-3">
                  @foreach ($portfolios->where('portfolio_category_id', $category->id) as $portfolio)
                    <div class="col-sm-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-duration="700">
                      <div class="single_project position-relative z-1">
                        <div>
                          @if($portfolio->image)
                            <img src="{{ asset('storage/' . $portfolio->image) }}" class="w-full" alt="{{ e($portfolio->title ?? 'Portfolio Item') }}" />
                          @else
                            <img src="{{ asset('images/placeholder.jpg') }}" class="w-full" alt="{{ e($portfolio->title ?? 'Portfolio Item') }}" />
                          @endif
                        </div>
                        <div class="p-3 p-md-5 position-absolute bottom-0 bg6-color w-100 project-content z-2">
                          <h4 class="p1-color fs-five mb-2 mb-md-4">{{ $portfolio->title ?? 'Untitled Project' }}</h4>
                          <span class="p9-color fs-seven">{{ $category->name ?? 'Uncategorized' }}</span>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            @endforeach
          @endif
        </div>
      </div>
    @else
      <div class="alert alert-info text-center mt-5">
        No portfolio items available
      </div>
    @endif
  </div>
</section> --}}
<!-- Portfolio section end -->

     <!-- Counter section start  -->

<section class="pt-120" >
  <div class="parallax bg4-color" style="padding-bottom: 50px; padding-top: 40px;">
    <div class="container">
      <div class="row align-items-center g-5">

        <div class="col-lg-6">
            <img
                src="{{ $about && $about->counter_image ? asset('storage/' . $about->counter_image) : asset('assets/website/images/blog3.png') }}"
                alt="Team Celebration"
                class="img-fluid rounded shadow-lg"
                style="max-height: 550px; object-fit: cover; width: 100%;"
            >
        </div>


        <!-- Right Side: Stats and Heading -->
        <div class="col-lg-6">
          <div class="mb-5">
            <!-- <h6 class="text-uppercase">Our Success</h6> -->
            <h2 class="fw-bold" style="padding-left: 30px;">We Have a Proven Track Record of Success</h2>
          </div>

          <!-- 4 Stat Cards -->
          <div class="row g-4" style="padding-left: 30px;">
            <!-- Employees -->
            <div class="col-6">
              <div class="text-center p-4 bg-white rounded shadow-sm h-100">
                <div class="mb-3">
                  <i class="fas fa-users fa-2x blue-text"></i>
                </div>
                <h2 class="display-6 fw-bold mb-0 green-text">
                  <span class="counter">{{ $about->no_of_employees?? ' ' }}</span>+
                </h2>
                <p class="blue-text fw-bold mb-0">Employees</p>
              </div>
            </div>

            <!-- Products -->
            <div class="col-6">
              <div class="text-center p-4 bg-white rounded shadow-sm h-100">
                <div class="mb-3">
                  <i class="fas fa-user fa-2x blue-text"></i>
                </div>
                <h2 class="display-6 fw-bold mb-0 green-text">
                  <span class="counter">{{ $about->no_of_users?? ' ' }}</span>+
                </h2>
                <p class="blue-text fw-bold mb-0">Users</p>
              </div>
            </div>

            <!-- Happy Clients -->
            <div class="col-6">
              <div class="text-center p-4 bg-white rounded shadow-sm h-100">
                <div class="mb-3">
                  <i class="fas fa-smile-beam fa-2x blue-text"></i>
                </div>
                <h2 class="display-6 fw-bold mb-0 green-text">
                  <span class="counter">{{ $about->no_of_satisfied_clients?? ' ' }}</span>+
                </h2>
                <p class="blue-text fw-bold mb-0">Happy Clients</p>
              </div>
            </div>

            <!-- Years of Experience -->
            <div class="col-6">
              <div class="text-center p-4 bg-white rounded shadow-sm h-100">
                <div class="mb-3">
                  <i class="fas fa-briefcase fa-2x blue-text"></i>
                </div>
                <h2 class="display-6 fw-bold mb-0 green-text">
                  <span class="counter">{{ $about->years_of_experience?? ' ' }}</span>+
                </h2>
                <p class="blue-text fw-bold mb-0">Years of Experience</p>
              </div>
            </div>

          </div>
        </div>
        <!-- End of Right Side -->

      </div>
    </div>
  </div>
</section>

    <!-- Counter section end -->



<style>
  /* Custom column for 5 items in a row */
  @media (min-width: 1200px) {
      .col-xl-2-4 {
          flex: 0 0 auto;
          width: 20%;
      }
  }
</style>

<!-- Our Team Section End -->





  <!-- Our clients section start -->
 <section class="pt-120 pb-120 our_clients">
  <div class="container">
    <div class="process_heading w-100 text-center" data-aos="fade-down" data-aos-duration="800">
      <span class="fs-ten fw-semibold p2-color mb-2 text-center">
        {{ optional($partnerHeading)->small_heading ?? 'Some of our dearest clients' }}
      </span>
      <h2 class="fs-two fw-semibold p8-color mb-3 mb-lg-6">
        {{ optional($partnerHeading)->heading ?? 'Our partners' }}
      </h2>
      <p class="fs-ten p4-color">
        {{ optional($partnerHeading)->heading_description ?? 'Build responsive, mobile-first projects on the web with the world\'s most popular front-end component library.' }}
      </p>
    </div>

    @if(!empty($partners) && $partners->count() > 0)
      <div class="mt-8 mt-md-15" data-aos="zoom-out-up" data-aos-duration="800">
        <div class="swiper clients_slider">
          <div class="swiper-wrapper d-flex align-items-center">
            @foreach($partners as $partner)
              <div class="swiper-slide">
                <div class="px-4 px-md-8 py-5 py-md-10 d-flex align-items-center justify-content-center">
                  @if($partner->image)
                    <img src="{{ asset('storage/' . $partner->image) }}" alt="{{ e($partner->name ?? 'Partner Logo') }}" style="max-height: 80px; width: auto;">
                  @else
                    <span>{{ $partner->name ?? 'Unnamed Partner' }}</span>
                  @endif
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    @else
      <div class="alert alert-info text-center mt-5">
        No partners available
      </div>
    @endif
  </div>
</section>
<!-- Our clients section end -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const hero = document.querySelector(".hero-slider");
        if (!hero) return;

        const images = JSON.parse(hero.dataset.images);
        let index = 0;

        hero.style.backgroundImage = `url('${images[0]}')`;

        setInterval(() => {
            index = (index + 1) % images.length;
            hero.style.backgroundImage = `url('${images[index]}')`;
        }, 5000); // change image every 5 seconds
    });
    </script>


@endsection

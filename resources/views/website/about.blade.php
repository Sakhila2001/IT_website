@extends('layouts.website')

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



.image-container {
    position: relative;
    max-width: 100%;
}

.main-image {
    width: 600px;
    height: auto;
    /* box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15); */
}

/* Small Image with Bigger Size and White Border */
.inset-image {
    position: absolute;
    bottom: -50px; /* Moves small image downward */
    left: -50px; /* Positions it towards the left */
    width: 320px; /* Increased size */
    height: auto;
    z-index: 2;
    border: 8px solid white; /* Thick white border */

}

/* Balance spacing for content */
.pe-xl-5 {
    padding-right: 3rem;
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
    .box-shadow-custom {
    background: #fff;
    border-radius: 14px;
    box-shadow:
        0 8px 20px rgba(0, 0, 0, 0.12),
        0 0 0 1px rgba(0, 0, 0, 0.02); /* subtle edge balance */
}


</style>
@endsection
@section('meta_content')
    <!-- HTML Meta Tags -->
    <title>{{ $about->heading ?? 'About' }}</title>
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
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $seoData['title'] ?? 'Our Services' }} - {{ App\Helpers\Helper::getInfoValue('name') ?? '' }}">
    <meta property="og:description" content="{{ $seoData['seo_description'] ?? '' }}">
    @if(!empty($seoData['seo_image']))
    <meta property="og:image" content="{{ asset($seoData['seo_image']) }}">
    <meta property="og:image:alt" content="{{ $seoData['title'] ?? 'Our Services' }} - {{ App\Helpers\Helper::getInfoValue('name') ?? '' }}">
    @endif

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="{{ url()->current() }}">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="{{ $seoData['title'] ?? 'Our Services' }} - {{ App\Helpers\Helper::getInfoValue('name') ?? '' }}">
    <meta name="twitter:description" content="{{ $seoData['seo_description'] ?? '' }}">
    @if(!empty($seoData['seo_image']))
    <meta name="twitter:image" content="{{ asset($seoData['seo_image']) }}">
    @endif
@endsection

@section('content')
    <!-- banner section start -->


    <!-- banner section end -->
    <!-- Choose us section Start  -->
    <section class="pt-120 pb-120" style="margin-top: 80px;">
    <div class="container">
        <div class="row g-5 align-items-center">

            <div class="col-xl-6 d-flex justify-content-center" data-aos="zoom-in" data-aos-duration="800">
            <div class="image-container">
            @if ($about)

        <!-- Large Image -->
        @if ($about->image1)
            <img class="main-image" src="{{ asset('storage/' . $about->image1) }}" alt="Blog Image 1" />
        @endif
        <!-- Small Image Positioned Lower with White Border -->
        @if ($about->image2)
            <img class="inset-image" src="{{ asset('storage/' . $about->image2) }}" alt="Blog Image 2" />
        @endif

@endif
</div>
            </div>

            <!-- Right Side: Content -->
            <div class="col-xl-6 pe-xl-5">
                <div class="service_heading" data-aos="fade-down" data-aos-duration="800">
                    <span class="fs-ten fw-semibold p2-color mb-2">{{$about->small_heading??' '}}</span>
                    <h2 class="fs-two fw-semibold p8-color mb-6 w-100" style="font-size: xx-large;">
                       {{$about->heading?? ' '}}
                    </h2>
                    <div class="desc-section" >
                      {!! $about->description?? ' ' !!}
                    </div>
                </div>

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
    </div>
</section>

<!-- CSS -->


   <section class="pt-50 mb-5 position-relative" style="z-index: 2;">
    <div class="container">

        <div class="row g-4 mt-7 mt-lg-15">

            <!-- Our Core Values -->
            <div class="col-md-6 d-flex align-items-center"
                 data-aos="fade-up"
                 data-aos-duration="700">

                <div class="d-flex align-items-center p-5 box-shadow-custom w-100">
                    <img src="{{ asset('assets/website/images/value.png') }}"
                         alt="Our Core Values"
                         width="80"
                         height="80"
                         class="me-4"/>

                    <div>
                        <h4 class="fs-five fw-semibold p8-color mb-3">Our Core Values</h4>
                        <div class="desc-section">
                            {!! $about->core_description ?? '' !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Our Mission -->
            <div class="col-md-6 d-flex align-items-center"
                 data-aos="fade-up"
                 data-aos-duration="700">

                <div class="d-flex align-items-center p-5 box-shadow-custom w-100">
                    <img src="{{ asset('assets/website/images/mission.png') }}"
                         alt="Our Mission"
                         width="80"
                         height="80"
                         class="me-4"/>

                    <div>
                        <h4 class="fs-five fw-semibold p8-color mb-3">Our Mission</h4>
                        <div class="desc-section">
                            {!! $about->mission_description ?? '' !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Our Vision (Centered + Bottom Padding) -->
            <div class="col-md-6 offset-md-3 d-flex align-items-center mb-5"
                 data-aos="fade-up"
                 data-aos-duration="700">

                <div class="d-flex align-items-center p-5 box-shadow-custom w-100">
                    <img src="{{ asset('assets/website/images/vision.png') }}"
                         alt="Our Vision"
                         width="80"
                         height="80"
                         class="me-4"/>

                    <div>
                        <h4 class="fs-five fw-semibold p8-color mb-3">Our Vision</h4>
                        <div class="desc-section">
                            {!! $about->vision_description ?? '' !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>



  <!-- Success Section Start -->
  <section class="pt-120 position-relative">
    <div class="parallax bg4-color" style="padding-bottom: 50px; padding-top: 40px;">
    <div class="container">
      <div class="row align-items-center g-5">

      <!-- Left Side: Big Image -->
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
                  <span class="counter">{{ $about->no_of_employees?? '' }}</span>+
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
<!-- Success Section End -->


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
                  <img src="{{ asset('storage/' . $chose->icon_image) }}" alt="{{ $chose->title }}" width="60" height="60">
                @else
                  <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width:60px;height:60px;">
                    <i class="fas fa-check fs-4"></i>
                  </div>
                @endif
                <h5 class="fs-five p8-color mt-3 mt-lg-6 mb-2 mb-lg-4">
                  {{ $chose->title }}
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
  </div>
</section>
<!-- Choose us section End -->







@endsection

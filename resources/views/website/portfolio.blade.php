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
  color: rgba(var(--p4), 1) !important;
  font-size: 18px;
    line-height: 130%;
}
.desc-section{
  color: rgba(var(--p4), 1) !important;
  font-size: 18px;
    line-height: 130%;
}

.desc-section ul {
  list-style-type: disc;
  padding-left: 1.5rem;
  margin-left: 0;
  color: rgba(var(--p4), 1);
}

.desc-section ol {
  list-style-type: decimal;
  padding-left: 1.5rem;
  margin-left: 0;
  color: rgba(var(--p4), 1);
}

/* Force all images to center */
.single_project img,
.image-container img,
.main-image {
    display: block;
    margin: 0 auto;
    object-fit: cover;
}

/* Portfolio image wrapper */
.single_project > div:first-child {
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

/* Consistent portfolio image size */
.single_project img {
    width: 100%;
    height: 260px;
    object-fit: cover;
    object-position: center;
    margin: auto;
    display: block;
}

.single_project {
    overflow: hidden;
}

.single_project::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(
        to top,
        rgba(0, 0, 0, 0.65),
        rgba(0, 0, 0, 0.15),
        transparent
    );
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 1;
}

.single_project:hover::after {
    opacity: 1;
}

/* Title content */
.project-content {
    transform: translateY(20px);
    transition: all 0.3s ease;
    background: transparent !important;
}

.single_project:hover .project-content {
    transform: translateY(0);
}

/* Title text */
.project-content h4 {
    font-weight: 600;
    letter-spacing: 0.3px;
}
/* Force portfolio title to white */
.project-content h4,
.project-content .color-white {
    color: #ffffff !important;
}

</style>
@endsection
@section('meta_content')
    <!-- HTML Meta Tags -->
    <title>{{ $portfolioHeading->heading ?? 'Our Services' }}</title>
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

    <!-- Protfolio section start -->
    <section class="pt-120 bg7-color" style="margin-bottom:80px; margin-top:80px;">
      <div
        class="process_heading w-100 text-center"
        data-aos="fade-down"
        data-aos-duration="800"
      >
        <span class="fs-ten fw-semibold p2-color mb-2 text-center"
          >Our Portfolio</span
        >
        <h2 class="fs-two fw-semibold p8-color mb-3 mb-lg-6"> {{ $portfolioHeading->heading?? ' Work & Project'}}</h2>
        <p class="fs-ten p4-color">
        {{ $portfolioHeading->heading_description ?? 'Build responsive, mobile-first projects on the web with the worlds
          most popular front-end component library.'}}
        </p>
      </div>
      <!-- tab  -->
      <div>

      <ul
    data-aos="zoom-in"
    data-aos-duration="800"
    class="tabs d-flex justify-content-center flex-wrap gap-2 gap-md-3 p-2 mt-8 mt-lg-15 mb-4 md:mb-8"
>
    <!-- All Category -->
    <li
        data-tab-target="#all"
        class="active cursor-pointer p4-color border cus-border border-six rounded-pill px-3 px-md-6 py-2 py-md-3 tab"
    >
        All
    </li>

    <!-- Loop through Portfolio Categories -->
    @foreach ($portfoliocategories as $category)
        <li
            data-tab-target="#{{ Str::slug($category->name?? ' ') }}"
            class="cursor-pointer p4-color border cus-border border-six rounded-pill px-3 px-md-6 py-2 py-md-3 tab"
        >
            {{ $category->name?? ' ' }}
        </li>
    @endforeach
</ul>

<div class="tab-content position-relative">
    <!-- All Tab -->
    <div id="all" data-tab-content class="active">
        <div class="row g-3">
            @foreach ($portfolios as $portfolio)
                <div class="col-sm-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-duration="700">
                    <div class="single_project position-relative z-1">
                        <div>
                            <img
                                src="{{ asset('storage/' . $portfolio->image) }}"
                                class="w-full"
                                alt="{{ $portfolio->title?? ' ' }}"
                            />
                        </div>
                        <div class="p-3 p-md-5 position-absolute bottom-0 bg6-color w-100 project-content z-2">
                            <h4 class="p1-color fs-five mb-2 mb-md-4">{{ $portfolio->title }}</h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Loop Through Portfolio Categories -->
    @foreach ($portfoliocategories as $category)
        <div id="{{ Str::slug($category->name) }}" data-tab-content>
            <div class="row g-3">
                @foreach ($portfolios->where('portfolio_category_id', $category->id) as $portfolio)
                    <div class="col-sm-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-duration="700">
                        <div class="single_project position-relative z-1">
                            <div>
                                <img
                                    src="{{ asset('storage/' . $portfolio->image) }}"
                                    class="w-full"
                                    alt="{{ $portfolio->title }}"
                                />
                            </div>
                            <div class="p-3 p-md-5 position-absolute bottom-0 w-100 project-content z-2">

                                <h4 class="fs-five mb-2 mb-md-4">{{ $portfolio->title }}</h4>

                                <span class="p9-color fs-seven">{{ $category->name }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>

      </div>
    </section>
    <!-- Protfolio section end  -->
@endsection
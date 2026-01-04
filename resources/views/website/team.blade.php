@extends('layouts.website')
@section('meta_content')
    <!-- HTML Meta Tags -->
    <title>{{ $teamsHeading->small_heading ?? 'Our Services' }}</title>
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
    color: rgba(var(--p4), 1) !important;
    font-size: 18px;
    line-height: 130%;
}

.desc-section {
    color: rgba(var(--p4), 1) !important;
    font-size: 18px;
    line-height: 130%;
    margin-top: 1.5rem; /* Add some spacing */
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
.image-container {
    position: relative;
    max-width: 100%;
}

.main-image {
    width: 600px;
    height: auto;
}

/* Small Image with Bigger Size and White Border */
.inset-image {
    position: absolute;
    bottom: -50px;
    left: -50px;
    width: 320px;
    height: auto;
    z-index: 2;
    border: 8px solid white;
}

/* Balance spacing for content */
.pe-xl-5 {
    padding-right: 3rem;
}
.pt-120{
  margin-top: 80px;
}

.team-img {
    height: 320px;
    object-fit: cover;
    width: 100%;
    border-radius: 8px;
}

/* Team Content at Bottom */
.single_team {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
}

.team-content {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding-top: 11rem;
    background: rgba(195, 218, 224, 0.9);
    color: #fff;
}

/* Mobile view */
@media (max-width: 576px) {
    .team-img {
        height: 150px;
        width: 100%;
    }

    .team-content {
        padding: 0.5rem !important;
    }

    .team-content h4 {
        font-size: 1rem;
    }

    .team-content span.fs-ten {
        font-size: 0.8rem;
    }
}
</style>
@endsection

@section('content')
<!-- Our Team Section start -->
<section class="pt-120 pb-120 bg7-color">
    <div class="process_heading w-100 text-center" data-aos="fade-up" data-aos-duration="800">
        <span class="fs-ten fw-semibold p2-color mb-2 text-center">{{ $teamsHeading->small_heading ?? '' }}</span>
        <h2 class="fs-two fw-semibold p8-color mb-3 mb-lg-6">
            {{ $teamsHeading->heading ?? 'Meet the Masterminds' }}
        </h2>
        <div class="desc-section">
            {!! $teamsHeading->heading_description ?? 'Build responsive, mobile-first projects on the web with the world\'s most popular front-end component library.' !!}
        </div>
    </div>

    <div class="mt-8 mt-md-15">
        @php
            $teams = $teams->sortBy('order'); // sort ascending by order
        @endphp

        <div class="row justify-content-center g-4 mb-8">
            @foreach ($teams as $team)
                <div class="col-4 col-sm-4 col-md-3 col-lg-2 col-xl-2-4" data-aos="fade-up">
                    <div class="single_team position-relative z-1 h-100 mx-auto">
                        <div class="team-img-container">
                            @if ($team->image)
                                <img src="{{ asset('storage/' . $team->image) }}" alt="team" class="team-img w-100" />
                            @else
                                <img src="{{ asset('assets/website/images/default person.jpg') }}" alt="team" class="team-img w-100" />
                            @endif
                        </div>

                        <div class="team-content text-center">
                            <span class="p3-color fs-ten fw-semibold mb-1 d-block">
                                {{ $team->designation ?? 'Not Specified' }}
                            </span>
                            <h4 class="p4-color fs-six mb-1 mb-md-2">{{ $team->name }}</h4>
                            <span class="d-flex gap-2 mt-1 justify-content-center">
                                <a href="{{ $team->facebook_link ?? '#' }}" target="_blank" class="{{ $team->facebook_link ? '' : 'disabled' }}">
                                    <i class="ph ph-facebook-logo fs-six p4-color"></i>
                                </a>
                                <a href="{{ $team->linkedin_link ?? '#' }}" target="_blank" class="{{ $team->linkedin_link ? '' : 'disabled' }}">
                                    <i class="ph ph-linkedin-logo fs-six p4-color"></i>
                                </a>
                                <a href="{{ $team->instagram_link ?? '#' }}" target="_blank" class="{{ $team->instagram_link ? '' : 'disabled' }}">
                                    <i class="ph ph-instagram-logo fs-six p4-color"></i>
                                </a>
                                <a href="{{ $team->twitter_link ?? '#' }}" target="_blank" class="{{ $team->twitter_link ? '' : 'disabled' }}">
                                    <i class="ph ph-x-logo fs-six p4-color"></i>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<style>
/* Custom column for 5 items in a row */
@media (min-width: 1200px) {
    .col-xl-2-4 {
        flex: 0 0 auto;
        width: 20%;
    }
}
</style>
<!-- Our Team Section end -->
@endsection

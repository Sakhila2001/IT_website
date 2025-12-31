@extends('layouts.website')
@section('meta_content')
    <!-- HTML Meta Tags -->
    <title>{{ $careerHeading->heading ?? 'Our Services' }}</title>
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
/* Center the description section */
.process_heading {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    max-width: 1500px; /* Limit the width for better readability */
    margin: 0 auto; /* Center the container */
}
.desc-section a{
    color: red !important;
    font-size: 18px;
}
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

.inset-image {
    position: absolute;
    bottom: -50px;
    left: -50px;
    width: 320px;
    height: auto;
    z-index: 2;
    border: 8px solid white;
}

.pe-xl-5 {
    padding-right: 3rem;
}

/* Custom column for 5 items in a row */
@media (min-width: 1200px) {
    .col-xl-2-4 {
        flex: 0 0 auto;
        width: 20%;
    }
}

/* Accordion Styles */
.accordion-container {
    display: flex;
    justify-content: center;
    margin-top: 35px;
    width: 100%;
}

.accordion-wrapper {
    width: 100%;
    max-width: 1200px; /* Increased width */
}


.accordion {
    margin-bottom: 10px;
    border: 1px solid rgb(231 241 232);
    border-radius: 4px;
}

.accordion-header {
    padding: 15px;
    background-color: rgb(231 241 232);
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: background-color 0.3s;
}

.accordion-header:hover {
    background-color: #e9ecef;
}

.accordion-header h4 {
    margin: 0;
}

.accordion-body {
    padding: 15px;
    background-color: white;
}

/* Ensure proper collapse behavior */
.accordion-body.collapse:not(.show) {
    display: none;
}

.accordion-body.collapse.show {
    display: block;
}
.red-text{
    color: brown;
}
.pt-120{
  margin-top: 80px;
}

.accordion-header small {
    font-size: 0.85rem;
    color: #6c757d;
}
.career-dates small {
    margin-right: 30px; /* Adjust this value as needed */
}


</style>
@endsection

@section('content')
<!-- Our Team Section start -->
<section class="pt-120 pb-120" style="margin-bottom:80px; margin-top:80px;">
    <div class="container">
        <div class="process_heading w-100" data-aos="fade-up" data-aos-duration="800">
            <span class="fs-ten fw-semibold p2-color mb-2 d-block">
                {{ $careerHeading->small_heading ?? '' }}
            </span>

            <h2 class="fs-two fw-semibold p8-color mb-3 mb-lg-6">
                {{ $careerHeading->heading ?? 'Meet the Masterminds' }}
            </h2>

            <div class="desc-section">
                {!! $careerHeading->description ?? 'Build responsive, mobile-first projects on the web with the world\'s most popular front-end component library.' !!}
                <p class="mt-3">
                    Please email your resume to
                    <a href="mailto:{{ $contact->email ?? '' }}">
                        {{ $contact->email ?? '' }}
                    </a>,
                    including the Job Code in the subject line, e.g., <strong>Job Code: TT012</strong>.
                </p>
            </div>
        </div>
    </div>


    <div class="accordion-container">
        <div class="accordion-wrapper">
            <div class="card">
                <div class="card-header">
                    <h6 class="p8-color">Our current openings are: </h6>
                </div>
                <div class="card-body">
    <div id="accordion">
        @foreach($careers as $career)
        @php
            $startDate = $career->start_date ? \Carbon\Carbon::parse($career->start_date)->format('d M Y') : 'N/A';
            $endDate = $career->end_date ? \Carbon\Carbon::parse($career->end_date)->format('d M Y') : 'N/A';
            $remainingDays = $career->end_date ? (int) \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($career->end_date), false) : null;
        @endphp
        <div class="accordion mb-2">
            <div class="accordion-header d-flex justify-content-between align-items-start" role="button" data-toggle="collapse" data-target="#panel-body-{{ $loop->index }}" aria-expanded="false">
                <div>
                    <h6 class="p8-color mb-1">{{ $career->title }}</h6>
                    <div class="mt-2 d-flex justify-content-between career-dates">
                    <small><strong>Starting Date:</strong> {{ $startDate }}</small>
                    <small><strong>Deadline:</strong> {{ $endDate }}</small>
                    @if(!is_null($remainingDays))
                        @if($remainingDays >= 0)
                            <small class="text-success"><strong>Remaining Days:</strong> {{ $remainingDays }}</small>
                        @else
                            <small class="text-danger"><strong>Deadline passed {{ abs($remainingDays) }}</strong></small>
                        @endif
                    @endif
                </div>

                </div>
                <span class="accordion-icon p8-color">+</span>
            </div>
            <div class="accordion-body collapse" id="panel-body-{{ $loop->index }}" data-parent="#accordion">
                <div class="desc-section text-black">
                    {!! $career->job_descriptions !!}
                    <p class="red-text mb-0">{!! $career->job_details !!}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>



            </div>
        </div>
    </div>
</section>
<!-- Our Team Section end -->

<!-- Add jQuery and Bootstrap JS if not already included -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    // Add click handler for accordion headers
    $('.accordion-header').click(function() {
        // Toggle the icon
        const icon = $(this).find('.accordion-icon');
        const isExpanded = $(this).attr('aria-expanded') === 'true';

        icon.text(isExpanded ? '+' : '-');

        // Close all other accordions
        if (!isExpanded) {
            $('.accordion-header').not(this).each(function() {
                $(this).attr('aria-expanded', 'false');
                $(this).find('.accordion-icon').text('+');
                const target = $(this).data('target');
                $(target).collapse('hide');
            });
        }
    });

    // Initialize first accordion as closed
    $('.accordion-header').first().attr('aria-expanded', 'false').find('.accordion-icon').text('+');
    $('.accordion-body').first().removeClass('show');
});
</script>
@endsection

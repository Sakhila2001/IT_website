@extends('layouts.website')

@section('style')
<style>
/* ===============================
   Description Styling
================================ */
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
}

.desc-section ul,
.desc-section ol {
    padding-left: 1.5rem;
    margin-left: 0;
}

/* ===============================
   Section Spacing
================================ */
.pt-120 {
    margin-top: 80px;
}

/* ===============================
   Service Card
================================ */
.service-card {
    height: 100%;
    display: flex;
    flex-direction: column;
    border-radius: 14px;
    background: #fff;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 6px 18px rgba(0,0,0,0.06);
}

.service-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 28px rgba(0,0,0,0.12);
}

/* ===============================
   4:3 Image Ratio (IMPORTANT)
================================ */
.service-image {
    width: 100%;
    aspect-ratio: 4 / 3; /* ✅ Enforced 4:3 ratio */
    overflow: hidden;
    background: #f4f6f8;
}

.service-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

/* ===============================
   Content
================================ */
.service-content {
    padding: 22px 20px;
    flex-grow: 1;
    text-align: center;
}

.service-content h4 {
    margin-bottom: 12px;
}

/* Description clamp */
.service-desc {
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* See more */
.see-more {
    font-size: 14px;
    font-weight: 600;
    color: var(--p6);
    margin-top: 6px;
    display: inline-block;
}

.see-more:hover {
    text-decoration: underline;
}
</style>
@endsection

@section('content')
<section class="container pt-120 pb-120">

    <!-- ===============================
         Heading
    ================================ -->
    <div class="d-flex justify-content-center text-center mb-5"
         data-aos="fade-down"
         data-aos-duration="800">

        <div class="service_heading" style="max-width: 820px;">
            <span class="fs-ten fw-semibold p2-color mb-2 d-block">
                {{ $serviceHeading->small_heading ?? '' }}
            </span>

            <h2 class="fs-two fw-semibold p8-color mb-4">
                {{ $serviceHeading->heading ?? 'Our Services' }}
            </h2>

            <p class="fs-ten p4-color">
                {!! $serviceHeading->heading_description ?? '' !!}
            </p>
        </div>
    </div>

    <!-- ===============================
         Services Grid
    ================================ -->
    <div class="row g-4 mt-7 mt-lg-15">
        @foreach ($services as $service)
        <div class="col-12 col-sm-6 col-xl-4"
             data-aos="fade-up"
             data-aos-duration="700">

            <a href="{{ route('service.details', $service->slug) }}"
               class="text-decoration-none h-100 d-block">

                <div class="service-card" style="padding: 20px;">

                    <!-- Image (4:3 enforced) -->
                    <div class="service-image">
                        <img
                            src="{{ !empty($service->image)
                                ? asset('storage/' . $service->image)
                                : asset('assets/website/images/default-service.jpg') }}"
                            alt="{{ $service->title }}"
                            loading="lazy"
                        >
                    </div>

                    <!-- Content -->
                    <div class="service-content">
                        <h4 class="fs-five fw-semibold p8-color">
                            {{ $service->title }}
                        </h4>

                        <p class="p4-color fs-ten service-desc">
                            {!! strip_tags($service->description) !!}
                        </p>

                        @if(strlen(strip_tags($service->description)) > 150)
                            <span class="see-more">See more →</span>
                        @endif
                    </div>

                </div>
            </a>
        </div>
        @endforeach
    </div>

    <!-- ===============================
         Contact CTA
    ================================ -->
    <div class="d-flex justify-content-center mt-6 mt-lg-12">
        <div class="d-flex flex-wrap gap-4 gap-lg-8 align-items-center"
             data-aos="fade-up"
             data-aos-duration="800">

            <a href="{{ route('contact') }}" class="btn p6-color">
                <span class="btn-text-one">Contact Us</span>
                <span class="btn-text-two">Contact Us</span>
            </a>

            <div class="d-flex align-items-center gap-4">
                <div class="choose_icon_width bg1-color d-flex justify-content-center align-items-center">
                    <i class="ph ph-phone-call text-white fs-three"></i>
                </div>
                <a href="tel:{{ $contact->phone ?? '' }}"
                   class="p4-color fw-semibold fs-six">
                    {{ $contact->phone ?? '' }}
                </a>
            </div>

        </div>
    </div>

</section>
@endsection

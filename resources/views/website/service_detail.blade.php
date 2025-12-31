@extends('layouts.website')

@section('meta_content')
<title>{{ $service->seo_title ?? $service->title }}</title>

<meta name="description" content="{{ $service->seo_description }}">
<meta name="keywords" content="{{ $service->seo_keywords }}">

<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $service->seo_title ?? $service->title }}">
<meta property="og:description" content="{{ $service->seo_description }}">
@if($service->seo_image)
<meta property="og:image" content="{{ asset('storage/'.$service->seo_image) }}">
@endif
@endsection

@section('style')
<style>
.service-sidebar {
    background: #f9f9f9;
    border-radius: 8px;
    overflow: hidden;
}
.service-sidebar h4 {
    background: #37b147;
    color: #fff;
    padding: 15px;
    margin: 0;
    font-size: 18px;
}
.service-sidebar ul {
    list-style: none;
    margin: 0;
    padding: 0;
}
.service-sidebar ul li a {
    display: block;
    padding: 14px 18px;
    border-bottom: 1px solid #e5e5e5;
    color: #3871b6;
    font-weight: 400;
    transition: all 0.3s;
}
.service-sidebar ul li a:hover,
.service-sidebar ul li a.active {
    background: #fff;
    color: #37b147;
}

.desc-section * {
    color: #3871b6;
    font-family: var(--body-font);
    font-size: 16px;
}
.service-detail-image {
    width: 100%;
    max-height: 80%;        /* controls height */
    object-fit: cover;        /* crops nicely */
    border-radius: 8px;
}
.topgap{
    margin-top: 100px;
}
.service-title {
    color: #1f3c88;
}

</style>
@endsection

@section('content')

<section class="pt-120 pb-120 topgap">
<div class="container">
<div class="row g-5">

    {{-- LEFT SIDEBAR --}}
    <div class="col-lg-4">
        <div class="service-sidebar">
            <h4>Services</h4>
            <ul>
                @foreach($publishedServices as $item)
                    <li>
                        <a href="{{ route('service.details', $item->slug) }}"
                            class="{{ $item->id == $service->id ? 'active' : '' }}">
                            {{ $item->title }}
                         </a>

                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- RIGHT CONTENT --}}
    <div class="col-lg-8">
        @if($service->image)
        <img src="{{ asset('storage/'.$service->image) }}"
        class="service-detail-image mb-4"
        alt="{{ $service->title }}">

        @endif

        <h2 class="fw-bold mb-3 service-title">{{ $service->title }}</h2>


        <div class="desc-section">
            {!! $service->description !!}
        </div>


    </div>

</div>
</div>
</section>

@endsection

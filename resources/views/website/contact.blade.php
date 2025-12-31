@extends('layouts.website')
@section('meta_content')
    <!-- HTML Meta Tags -->
    <title>{{ $contact->heading ?? 'Contact' }}</title>
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
@section('style')

<style>
.map-container iframe {
    width: 100% !important;
    height: 500px !important;
    max-width: 100%;
    border: none;
}

.bg7-color {
  background-color: #ffffff;
}
</style>
@endsection
@section('content')


    <!-- Contact section start -->
    <section class="pt-120 pb-120 bg7-color" style="margin-top: 80px;">


@if($contact->map)
    <div class="map-section my-5">
        <div class="container">
            <h4 class="fs-four p3-color mb-4 text-center"  >Our Location</h4>
            <!-- Displaying the map embed code from the database -->
            <div class="map-container">
{!! $contact->map ?? '<div style="overflow:hidden;resize:none;max-width:100%;width:1500px;height:500px;">
    <div id="canvas-for-googlemap" style="height:100%; width:100%; max-width:100%;">
        <iframe style="height:100%; width:100%; border:0;" frameborder="0"
            src="https://www.google.com/maps/embed/v1/place?q=353G+QWH+Purvi+Gate&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8">
        </iframe>
    </div>
    <a class="embed-map-html" href="https://www.bootstrapskins.com/themes" id="grab-map-data">premium bootstrap themes</a>
    <style>#canvas-for-googlemap img { max-height:none; max-width:none!important; background:none!important; }</style>
</div>' !!}
            </div>
        </div>
    </div>
@endif
      <div class="container" style="margin-top:80px;">
        <div class="process_heading w-100 text-center" data-aos="fade-down">
          <span class="fs-ten fw-semibold p2-color mb-2 text-center"
            >Get in Touch</span
          >
          <h2 class="fs-two fw-semibold p8-color mb-3 mb-lg-6">
          {{ $contact->heading	 ?? 'Default Sub Heading' }}
          </h2>
          <p class="fs-ten p4-color">
          {{ $contact->heading_description	 ?? 'Default Sub Heading Description' }}
          </p>
        </div>





        <div class="row g-3 g-md-6 mt-5 mt-md-10">


          <div class="col-lg-8">
          @if(session('success'))
            <div class="alert alert-success mt-3" id="success-message">
              {{ session('success') }}
            </div>
          @endif

          <form
                id="contact-form"
                method="POST"
                action="{{ route('contact.send') }}"
                class="bg14-color py-5 py-md-10 px-4 px-md-8 border cus-border border-six rounded-4"
              >
                @csrf
              <div class="d-sm-flex gap-3 gap-lg-6 mb-4 mb-md-8" style="margin-top: 20px;">
                <div class="w-100">
                  <label class="p4-color fs-ten mb-1">Name:</label>
                  <input
                    type="text"
                    class="p4-color border cus-border border-six px-3 px-md-6 py-2 py-md-4 rounded"
                    placeholder="Your name"
                    id="name"
                    name="name"
                    required
                  />
                </div>
                <div class="w-100 mt-3 mt-sm-0">
                  <label class="p4-color fs-ten mb-1">Email address:</label>
                  <input
                    type="email"
                    class="p4-color border cus-border border-six px-3 px-md-6 py-2 py-md-4 rounded"
                    placeholder="Name@ examples"
                    id="email"
                    name="email"
                    required
                  />
                </div>
              </div>
              <div class="mb-4 mb-md-8">
                <label class="p4-color fs-ten mb-1">Subject:</label>
                <input
                  type="text"
                  class="p4-color border cus-border border-six px-3 px-md-6 py-2 py-md-4 rounded"
                  placeholder="Write your Subject"
                  id="subject"
                  name="subject"
                  required
                />
              </div>
              <div class="mb-5 mb-md-10">
                <label class="p4-color fs-ten mb-1">Message:</label>
                <textarea
                  class="h-135 p4-color border cus-border border-six px-3 px-md-6 py-2 py-md-4 rounded"
                  placeholder="Write your message..."
                  id="message"
                  name="message"
                  required
                ></textarea>
              </div>
              <button class="btn2 p6-color" id="contact-submit-btn" style="margin-top: 20px  20px  0px  0px;">
                <span class="btn-text-one">Send Message</span>
                <span class="btn-text-two">Send Message</span>
              </button>
            </form>
          </div>
          <div class="col-lg-4">
            <div class="bg1-color px-5 px-lg-10 py-8 py-md-15 rounded-4">
              <div class="mb-5 mb-md-6 mb-xxl-11">
                <h4 class="fs-five p6-color mb-2">Head Office Info</h4>
                <span class="p11-color fs-eleven"
                  >{{ $contact->head_office	 ?? 'Default Address' }}</span
                >
              </div> <div class="mb-5 mb-md-6 mb-xxl-11">
                <h4 class="fs-five p6-color mb-2">Branch Office Info</h4>
                <span class="p11-color fs-eleven"
                  >{{ $contact->branch_office	 ?? 'Default Address' }}</span
                >
              </div>
              <div class="mb-5 mb-md-6 mb-xxl-11">
                <h4 class="fs-five p6-color mb-2">Phone:</h4>
                <span class="p11-color fs-eleven d-block mb-2"
                  >{{ $contact->phone	 ?? 'Default Phone' }}	</span
                >
                @if($contact->phone2)

                <span class="p11-color fs-eleven d-block"
                  >{{ $contact->phone2 }}</span
                >
                @endif
              </div>
              <div class="mb-5 mb-md-6 mb-xxl-11">
                <h4 class="fs-five p6-color mb-2">Email:</h4>
                <span class="p11-color fs-eleven d-block mb-2"
                  >{{ $contact->email	 ?? 'Default Email' }}</span
                >
                @if($contact->email2)

                <span class="p11-color fs-eleven d-block"
                  >{{ $contact->email2 }}</span
                >
                @endif
              </div>
              <div class="social_info">
    <h4 class="fs-five p6-color mb-2 mb-md-4">Our Social info</h4>
    <div class="d-flex flex-wrap gap-3">
        <a href="{{ $contact->facebook_link ?? '#' }}" class="contact_icon d-flex justify-content-center align-items-center" target="_blank">
            <i class="ph ph-facebook-logo fs-six p6-color"></i>
        </a>

        <a href="{{ $contact->twitter_link ?? '#' }}" class="contact_icon d-flex justify-content-center align-items-center" target="_blank">
            <i class="ph ph-x-logo fs-six p6-color"></i>
        </a>

        <a href="{{ $contact->Linkedin_link ?? '#' }}" class="contact_icon d-flex justify-content-center align-items-center" target="_blank">
            <i class="ph ph-linkedin-logo fs-six p6-color"></i>
        </a>

        <a href="{{ $contact->instagram_link ?? '#' }}" class="contact_icon d-flex justify-content-center align-items-center" target="_blank">
            <i class="ph ph-instagram-logo fs-six p6-color"></i>
        </a>

        <a href="{{ $contact->whatsapp_link ?? '#' }}" class="contact_icon d-flex justify-content-center align-items-center" target="_blank">
            <i class="ph ph-whatsapp-logo fs-six p6-color"></i>
        </a>
    </div>
</div>


            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Contact section end -->

    @endsection

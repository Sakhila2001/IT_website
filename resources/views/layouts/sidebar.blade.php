<style>
.main-sidebar .sidebar-menu li ul.dropdown-menu li a:before {
    content: "•"; /* Unicode bullet */
    font-family: inherit; /* No need for Font Awesome unless using icons */
    font-weight: normal;
    font-size: 14px;
    position: absolute;
    transition: 0.5s;
    left: 30px;
    color: #6c757d; /* Set to a visible color */
}
</style>

<div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
   <div class="main-sidebar sidebar-style-2 " style="padding-bottom: 100px;">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
          <header style="font-weight:bold; font-size:15px;">
          @php
    $contact = App\Models\ContactDetailModel::first();
    $companyName = optional($contact)->company_name ?? 'CMS';
    $companyLogo = optional($contact)->company_logo;
@endphp

@if($companyLogo)
    <img src="{{ asset('storage/' . $companyLogo) }}" alt="{{ $companyName }}" style="max-height: 50px; margin: 30px 0px 50px 30px;">
@else
    <span class="company-name" style="margin: 30px 0px 50px 30px;">{{ $companyName }}</span>
@endif


</header>



          </div>
          <ul class="sidebar-menu" >
            <li class="menu-header">Main</li>
            <li class="{{ Request::is('dashboard*') ? 'active' : '' }}">
    <a href="{{ route('dashboard') }}" class="nav-link">
        <i data-feather="monitor"></i><span>Dashboard</span>
    </a>
</li>
@php
    $ContentActive = Request::is('admin/partners*') || Request::is('admin/home*') ||
                     Request::is('admin/why-choose-us*') || Request::is('admin/process-flow*') ||
                     Request::is('admin/about*') || Request::is('admin/testimonials*') ||
                     Request::is('admin/faqs*') ? 'active' : '';

    $ContentMenuOpen = $ContentActive ? 'show' : '';
@endphp

<li class="dropdown {{ $ContentActive }}" id="content-dropdown">
    <a href="#" class="menu-toggle nav-link has-dropdown {{ $ContentActive }}">
        <i data-feather="home"></i><span>Content Manager</span>
    </a>
    <ul class="dropdown-menu {{ $ContentMenuOpen }}">
        {{-- Home Manager Items --}}
        <li class="{{ Request::is('admin/home*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('backend.home.index') }}">Home</a>
        </li>
          {{-- About Manager Items --}}
          <li class="{{ Request::is('admin/about*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('backend.about.index') }}">About</a>
        </li>
        <li class="{{ Request::is('admin/why-choose-us*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('backend.why_choose_us.index') }}">Why Choose Us</a>
        </li>

        <li class="{{ Request::is('admin/partners*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('backend.partners.index') }}">Partners</a>
        </li>




    </ul>
</li>


<li class="{{ Request::is('admin/services*') || Request::is('admin/service_heading*') ? 'active' : '' }}">
                                <a href="{{ route('backend.services.index') }}" class="nav-link">
                                <i data-feather="monitor"></i> <span>Services</span>
                                </a>
                            </li>


<li class="{{ Request::is('admin/careers*') || Request::is('admin/career-heading*') ? 'active' : '' }}">
                                <a href="{{ route('backend.careers.index') }}" class="nav-link">
                                <i data-feather="target"></i> <span>Career</span>
                                </a>
                            </li>







@php
    $portfolioActive = Request::is('admin/portfolioCategories*') || Request::is('admin/portfolios*') ? 'active' : '';
    $portfolioMenuOpen = Request::is('admin/portfolioCategories*') || Request::is('admin/portfolios*') ? 'show' : '';
@endphp
<li class="dropdown {{ $portfolioActive }}" id="portfolio-dropdown">
    <a href="#" class="menu-toggle nav-link has-dropdown {{ $portfolioActive }}">
        <i data-feather="image"></i><span>Portfolio</span>
    </a>
    <ul class="dropdown-menu {{ $portfolioMenuOpen }}">
        <li class="{{ Request::is('admin/portfolioCategories*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('backend.portfolioCategories.index') }}">Portfolio Category</a>
        </li>
        <li class="{{ Request::is('admin/portfolios*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('backend.portfolios.index') }}">Portfolio</a>
        </li>
    </ul>
</li>



@php
    $contactActive = Request::is('admin/contact_details*') || Request::is('admin/contact_list*') ? 'active' : '';
    $contactMenuOpen = Request::is('admin/contact_details*') || Request::is('admin/contact_list*') ? 'show' : '';
@endphp
<li class="dropdown {{ $contactActive }}" id="portfolio-dropdown">
    <a href="#" class="menu-toggle nav-link has-dropdown {{ $contactMenuOpen }}">
        <i data-feather="phone"></i><span>Contact</span>
    </a>
    <ul class="dropdown-menu {{ $contactMenuOpen }}">
        <li class="{{ Request::is('admin/contact_details*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('backend.contact_details.index') }}">Contact Details</a>
        </li>
        <li class="{{ Request::is('admin/contact_list*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('backend.contact_list.index') }}">Contact Submissions</a>
        </li>

    </ul>
</li>

<!--
@php
    $subscriptionsActive =  Request::is('subscriptions*') ? 'active' : '';
    $subscriptionsMenuOpen = Request::is('admin/subscriptions*') ? 'show' : '';
@endphp -->
<!-- <li class="dropdown {{ $subscriptionsActive }}" id="portfolio-dropdown">
    <a href="#" class="menu-toggle nav-link has-dropdown {{ $subscriptionsMenuOpen }}">
        <i data-feather="mail"></i><span>NewsLetter</span>
    </a>
    <ul class="dropdown-menu {{ $subscriptionsMenuOpen }}">

        <li class="{{ Request::is('admin/subscriptions*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('backend.subscriptions.index') }}"> Subscriptions</a>
        </li>
    </ul>
</li> -->


<li class="{{ Request::is('admin/subscriptions*') ? 'active' : '' }}">
                                <a href="{{ route('backend.subscriptions.index') }}" class="nav-link">
                                <i data-feather="mail"></i> <span>Subscriptions</span>
                                </a>
                            </li>


          </ul>
        </aside>
      </div>

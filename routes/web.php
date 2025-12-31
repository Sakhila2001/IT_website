<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\CareerHeadingController;
use App\Http\Controllers\ContactDetailController;
use App\Http\Controllers\ContactListController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioCategoryController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PortfolioHeadingController;
use App\Http\Controllers\ServiceHeadingController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PartnerHeadingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TeamsHeadingController;
use App\Http\Controllers\WhyChooseUsController;
use App\Http\Controllers\WhyChooseUsHeadingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DashboardController;



Route::get('/contact', [ContactDetailController::class, 'websiteContact'])->name('contact');

Route::get('/phpinfo', function () {
    phpinfo();
});



Route::get('/dashboard', [DashboardController::class, 'index'])
     ->middleware(['auth', 'verified'])
     ->name('dashboard');


Route::post('/contact', [ContactDetailController::class, 'send'])->name('contact.send');

Route::get('/services', [ServiceHeadingController::class, 'websiteContact'])->name('allservices');

Route::get('/portfolio', [PortfolioController::class, 'websiteContact'])->name('allportfolio');

Route::get('/team', [TeamController::class, 'websiteContact'])->name('allteam');
Route::get('/career', [CareerHeadingController::class, 'websiteContact'])->name('allcareer');
Route::get('/about-us', [AboutController::class, 'websiteContact'])->name('aboutUs');
Route::get('/', [HomeController::class, 'websiteContact'])->name('index');
Route::get('/service/{slug}', [ServiceController::class, 'show'])
->name('service.details');
// Route::get('/', [ContactDetailController::class, 'home']);

Route::post('subscriptions', [SubscriptionController::class, 'store'])
    ->name('backend.subscriptions.store');


Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/home/index', [HomeController::class, 'index'])->name('backend.home.index');
    Route::get('/home/edit', [HomeController::class, 'edit'])->name('backend.home.edit');
    Route::put('/home/update', [HomeController::class, 'update'])->name('backend.home.update');
    Route::put('/home/details', [HomeController::class, 'details'])->name('backend.home.details');
    Route::resource('careers', CareerController::class)->names([
        'index' => 'backend.careers.index',
        'create' => 'backend.careers.create',
        'store' => 'backend.careers.store',
        'edit' => 'backend.careers.edit',
        'update' => 'backend.careers.update',
        'destroy' => 'backend.careers.destroy',
    ]);
    Route::get('career-heading/edit', [CareerHeadingController::class, 'edit'])->name('backend.career_heading.edit');
    Route::put('career-heading', [CareerHeadingController::class, 'update'])->name('backend.career_heading.update');
    Route::get('career-heading', [CareerHeadingController::class, 'index'])->name('backend.career_heading.index');

    Route::resource('portfolios', PortfolioController::class)->names([
        'index' => 'backend.portfolios.index',
        'create' => 'backend.portfolios.create',
        'store' => 'backend.portfolios.store',
        'edit' => 'backend.portfolios.edit',
        'update' => 'backend.portfolios.update',
        'destroy' => 'backend.portfolios.destroy',
    ]);
    Route::resource('portfolioCategories', PortfolioCategoryController::class)->names([
        'index' => 'backend.portfolioCategories.index',
        'create' => 'backend.portfolioCategories.create',
        'store' => 'backend.portfolioCategories.store',
        'edit' => 'backend.portfolioCategories.edit',
        'update' => 'backend.portfolioCategories.update',
        'destroy' => 'backend.portfolioCategories.destroy',
    ]);

    Route::resource('services', ServiceController::class)->names([
        'index' => 'backend.services.index',
        'create' => 'backend.services.create',
        'store' => 'backend.services.store',
        'edit' => 'backend.services.edit',
        'update' => 'backend.services.update',
        'destroy' => 'backend.services.destroy',
    ]);




    Route::resource(('teams'), TeamController::class)->names([
        'index' => 'backend.teams.index',
        'create' => 'backend.teams.create',
        'store' => 'backend.teams.store',
        'edit' => 'backend.teams.edit',
        'update' => 'backend.teams.update',
        'destroy' => 'backend.teams.destroy',
    ]);




    Route::resource('partners', PartnerController::class)->names([
        'index' => 'backend.partners.index',
        'create' => 'backend.partners.create',
        'store' => 'backend.partners.store',
        'edit' => 'backend.partners.edit',
        'update' => 'backend.partners.update',
        'destroy' => 'backend.partners.destroy',
    ]);
    Route::resource('banner', BannerController::class)->names([
        'index' => 'backend.banner.index',
        'create' => 'backend.banner.create',
        'store' => 'backend.banner.store',
        'edit' => 'backend.banner.edit',
        'update' => 'backend.banner.update',
        'destroy' => 'backend.banner.destroy',
    ]);
    Route::resource('partners-heading', PartnerHeadingController::class)->names([
        'index' => 'backend.partners_heading.index',
        'edit' => 'backend.partners_heading.edit',
        'update' => 'backend.partners_heading.update',
    ]);
    Route::resource('why-choose-us', WhyChooseUsController::class)->names([
        'index' => 'backend.why_choose_us.index',
        'create' => 'backend.why_choose_us.create',
        'store' => 'backend.why_choose_us.store',
        'edit' => 'backend.why_choose_us.edit',
        'update' => 'backend.why_choose_us.update',
        'destroy' => 'backend.why_choose_us.destroy',
    ]);
    Route::resource('why-choose-us-heading', WhyChooseUsHeadingController::class)->names([
        'index' => 'backend.why_choose_us_heading.index',
        'edit' => 'backend.why_choose_us_heading.edit',
        'update' => 'backend.why_choose_us_heading.update',
    ]);




    Route::resource('teams-heading', TeamsHeadingController::class)->names([
        'index' => 'backend.teams_heading.index',
        'edit' => 'backend.teams_heading.edit',
        'update' => 'backend.teams_heading.update',
    ]);






    Route::resource('subscriptions', SubscriptionController::class)
    ->names([
        'index' => 'backend.subscriptions.index',
        'store' => 'backend.subscriptions.store',
        'destroy' => 'backend.subscriptions.destroy'
    ])
    ->except(['store']); // Exclude store from auth middleware


    Route::get('/contact_details/index', [ContactDetailController::class, 'index'])->name('backend.contact_details.index');
    Route::get('/contact_details/edit', [ContactDetailController::class, 'edit'])->name('backend.contact_details.edit');
    Route::put('contact_details/update', [ContactDetailController::class, 'update'])->name('backend.contact_details.update');
    // Route::resource('/contact_list', 'ContactListController')->except(['create', 'store', 'edit', 'update']);
    Route::get('/contact_list/index', [ContactListController::class, 'index'])
    ->name('backend.contact_list.index');
    Route::get('/contact_list/{contact_submission}', [ContactListController::class, 'show'])
    ->name('backend.contact_list.show');
    Route::delete('/contact_list', [ContactListController::class, 'destroy'])->name('backend.contact_list.destroy');



    Route::get('/about/index', [AboutController::class, 'index'])->name('backend.about.index');
    Route::get('/about/edit', [AboutController::class, 'edit'])->name('backend.about.edit');
    Route::post('/about/update', [AboutController::class, 'update'])->name('backend.about.update');
    Route::get('/home/edit', [HomeController::class, 'edit'])->name('backend.home.edit');


    // Service Heading Routes for Admin
    Route::get('/service_heading/index', [ServiceHeadingController::class, 'index'])->name('backend.service_heading.index');
    Route::get('/service_heading/edit', [ServiceHeadingController::class, 'edit'])->name('backend.service_heading.edit');
    Route::post('/service_heading/update', [ServiceHeadingController::class, 'update'])->name('backend.service_heading.update');

    // Porfolio Heading Routes for Admin
    Route::get('/portfolio_heading/index', [PortfolioHeadingController::class, 'index'])->name('backend.portfolio_heading.index');
    Route::get('/portfolio_heading/edit', [PortfolioHeadingController::class, 'edit'])->name('backend.portfolio_heading.edit');
    Route::post('/portfolio_heading/update', [PortfolioHeadingController::class, 'update'])->name('backend.portfolio_heading.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



  });



require __DIR__.'/auth.php';

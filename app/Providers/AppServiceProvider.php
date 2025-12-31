<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

use App\Models\ContactDetailModel;
use App\Models\ServiceModel;
use App\Models\ServiceHeadingModel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->sharePublishedServices();
        $this->shareServiceSlug();
        $this->shareContactDetails();
    }

    /**
     * Share published services with all views (for navbar dropdown)
     */
    protected function sharePublishedServices(): void
    {
        try {
            if (Schema::hasTable('services')) {
                $publishedServices = Cache::remember(
                    'published_services',
                    now()->addHours(12),
                    function () {
                        return ServiceModel::where('is_publish', 'Publish')
                            ->where('is_delete', false)
                            ->orderBy('created_at', 'asc')
                            ->get();
                    }
                );

                View::share('publishedServices', $publishedServices);
            }
        } catch (\Exception $e) {
            Log::error('Failed to share published services: ' . $e->getMessage());
            View::share('publishedServices', collect()); // fallback
        }
    }

    /**
     * Share service heading slug (fallback safe)
     */
    protected function shareServiceSlug(): void
    {
        view()->composer('*', function ($view) {
            try {
                $serviceSlug = ServiceHeadingModel::first()->slug ?? 'services';
            } catch (\Exception $e) {
                $serviceSlug = 'services';
            }

            $view->with('defaultServiceSlug', $serviceSlug);
        });
    }

    /**
     * Share contact details with all views
     */
    protected function shareContactDetails(): void
    {
        view()->composer('*', function ($view) {
            try {
                $contact = Cache::remember(
                    'contact_details',
                    now()->addHours(12),
                    function () {
                        return ContactDetailModel::firstOrNew(['id' => 1]);
                    }
                );

                $view->with('contact', $contact);
            } catch (\Exception $e) {
                Log::error('Failed to share contact details: ' . $e->getMessage());

                $emptyContact = new ContactDetailModel();
                $emptyContact->fill([
                    'phone' => '+1 (800) 555-1212',
                    'email' => 'support@example.com',
                    'address_info' => 'Default address',
                ]);

                $view->with('contact', $emptyContact);
            }
        });
    }
}

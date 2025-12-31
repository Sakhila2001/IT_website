<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AboutModel;
use App\Models\BannerModel;
use App\Models\ContactDetailModel;
use App\Models\FAQModel;
use App\Models\FaqsHeadingHModel;
use App\Models\HomeModel;
use App\Models\PartnerHeadingModel;
use App\Models\PartnerModel;
use App\Models\PortfolioCategoryModel;
use App\Models\PortfolioHeadingModel;
use App\Models\PortfolioModel;
use App\Models\ProcessFlowModel;
use App\Models\ServiceHeadingModel;
use App\Models\ServiceModel;
use App\Models\TeamModel;
use App\Models\TeamsHeadingHModel;
use App\Models\WhyChooseUsHeadingModel;
use App\Models\WhyChooseUsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Drivers\Gd\Driver;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Always fetch or create the record with id = 1
        $home = HomeModel::firstOrNew(['id' => 1]);
        $banners = BannerModel::where('is_delete', false)->orderBy('created_at', 'desc')->paginate(10);

        return view('backend.home.index', compact('home', 'banners'));
    }

    public function websiteContact()
    {
        $seoData = $this->getSeoData();
        $pageData = $this->getPageData();

        return view('website.index', array_merge($seoData, $pageData));
    }

    /**
     * Fetch SEO data and home model.
     *
     * @return array
     */
    private function getSeoData()
    {
        $home = HomeModel::firstOrNew(['id' => 1]);

        return [
            'seoData' => [
                'title' => $home->seo_title ?? $home->heading ?? 'Our Services',
                'seo_description' => $home->seo_description ?? $home->heading_description ?? '',
                'seo_keyword' => $home->seo_keywords ?? '',
                'seo_image' => $home->seo_image ? 'storage/' . $home->seo_image : '',
            ],
            'home' => $home
        ];
    }

    /**
     * Fetch all page data.
     *
     * @return array
     */
    private function getPageData()
    {
        return [
            'contactDetails' => $this->getContactDetails(),
            'services' => $this->getPublishedServices(),
            'serviceHeading' => $this->getServiceHeading(),
            'portfolios' => $this->getPortfolios(),
            'portfolioHeading' => $this->getPortfolioHeading(),
            'portfoliocategories' => $this->getPortfolioCategories(),
            'about' => $this->getAbout(),
            'teams' => $this->getTeams(),
            'teamsHeading' => $this->getTeamsHeading(),

            'partners' => $this->getPartners(),
            'partnerHeading' => $this->getPartnerHeading(),
            'choose' => $this->getWhyChooseUs(),
            'chooseHeading' => $this->getWhyChooseUsHeading(),
            'banners' => $this->getBanners(),
        ];
    }

    /**
     * Fetch contact details.
     *
     * @return ContactDetailModel
     */
    private function getContactDetails()
    {
        return ContactDetailModel::firstOrNew([]);
    }

    /**
     * Fetch published services.
     *
     * @return \Illuminate\Support\Collection
     */
    private function getPublishedServices()
    {
        return ServiceModel::where('is_publish', 'Publish')
            ->where('is_delete', 0)
            ->get() ?? collect([]);
    }

    /**
     * Fetch service heading.
     *
     * @return ServiceHeadingModel
     */
    private function getServiceHeading()
    {
        return ServiceHeadingModel::firstOrNew([]);
    }

    /**
     * Fetch published portfolios.
     *
     * @return \Illuminate\Support\Collection
     */
    private function getPortfolios()
    {
        return PortfolioModel::where('is_publish', 'Publish')
            ->where('is_delete', 0)
            ->get() ?? collect([]);
    }

    /**
     * Fetch portfolio heading.
     *
     * @return PortfolioHeadingModel
     */
    private function getPortfolioHeading()
    {
        return PortfolioHeadingModel::firstOrNew([]);
    }

    /**
     * Fetch portfolio categories with published portfolios.
     *
     * @return \Illuminate\Support\Collection
     */
    private function getPortfolioCategories()
    {
        return PortfolioCategoryModel::where('is_delete', false)
            ->whereHas('portfolios', function ($query) {
                $query->where('is_publish', 'Publish')->where('is_delete', 0);
            })
            ->orderBy('created_at', 'desc')
            ->get() ?? collect([]);
    }

    /**
     * Fetch about data.
     *
     * @return AboutModel
     */
    private function getAbout()
    {
        return AboutModel::firstOrNew([]);
    }



    /**
     * Fetch published teams.
     *
     * @return \Illuminate\Support\Collection
     */
    private function getTeams()
    {
        return TeamModel::where('is_delete', false)
            ->where('is_publish', 'Publish')
            ->orderBy('created_at', 'desc')
            ->get() ?? collect([]);
    }

    /**
     * Fetch teams heading.
     *
     * @return TeamsHeadingHModel
     */
    private function getTeamsHeading()
    {
        return TeamsHeadingHModel::firstOrNew([]);
    }




    /**
     * Fetch paginated partners.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    private function getPartners()
    {
        return PartnerModel::where('is_delete', false)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    /**
     * Fetch partner heading.
     *
     * @return PartnerHeadingModel
     */
    private function getPartnerHeading()
    {
        return PartnerHeadingModel::firstOrNew([]);
    }

    /**
     * Fetch paginated Why Choose Us items.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    private function getWhyChooseUs()
    {
        return WhyChooseUsModel::where('is_delete', false)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    /**
     * Fetch Why Choose Us heading.
     *
     * @return WhyChooseUsHeadingModel
     */
    private function getWhyChooseUsHeading()
    {
        return WhyChooseUsHeadingModel::firstOrNew([]);
    }

    /**
     * Fetch paginated process flow items.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */



    /**
     * Fetch paginated banners.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    private function getBanners()
    {
        return BannerModel::where('is_delete', false)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        // Always fetch or create the record with id = 1
        $home = HomeModel::firstOrNew(['id' => 1]);
        return view('backend.home.edit', compact('home'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'hot_heading_section' => 'nullable|string|max:255',
            'heading' => 'required|string|max:255',
            'heading_description' => 'nullable|string',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'sometimes|string',
            'seo_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:10048',
            'remove_seo_image' => 'nullable|boolean',
            'hero_background_image.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'remove_hero_background_image' => 'nullable|string', // comma-separated indices or names
        ]);

        try {
            $data = HomeModel::firstOrNew(['id' => 1]);
            $manager = new ImageManager(new Driver());

            // Handle SEO keywords
            if ($request->filled('seo_keywords')) {
                $validated['seo_keywords'] = collect(explode(',', $request->seo_keywords))
                    ->map(fn($item) => trim($item))
                    ->filter()
                    ->unique()
                    ->implode(', ');
            }

            // ---------------- SEO IMAGE ----------------
            if ($request->remove_seo_image && $data->seo_image) {
                Storage::delete('public/' . $data->seo_image);
                $validated['seo_image'] = null;
            } elseif ($request->hasFile('seo_image')) {
                if ($data->seo_image) {
                    Storage::delete('public/' . $data->seo_image);
                }

                $seoImageName = 'seo_' . time() . '.webp';
                $seoPath = 'home/seo/' . $seoImageName;
                $seoFullPath = storage_path('app/public/' . $seoPath);

                if (!file_exists(dirname($seoFullPath))) {
                    mkdir(dirname($seoFullPath), 0755, true);
                }

                $manager->read($request->file('seo_image'))
                    ->resize(1200, 630)
                    ->toWebp(75)
                    ->save($seoFullPath);

                $validated['seo_image'] = $seoPath;
            }

            // ---------------- HERO BACKGROUND ----------------
            $existingHeroImages = $data->hero_background_image ? json_decode($data->hero_background_image, true) : [];

            // Remove specified images
            if ($request->remove_hero_background_image) {
                $toRemove = array_filter(explode(',', $request->remove_hero_background_image));
                foreach ($toRemove as $img) {
                    if (in_array($img, $existingHeroImages)) {
                        Storage::delete('public/' . $img);
                        $existingHeroImages = array_diff($existingHeroImages, [$img]);
                    }
                }
                $existingHeroImages = array_values($existingHeroImages);
            }

            // Add new uploaded hero images
            if ($request->hasFile('hero_background_image')) {
                foreach ($request->file('hero_background_image') as $file) {
                    $bgImageName = 'hero_bg_' . time() . '_' . Str::random(8) . '.webp';
                    $bgPath = 'home/hero/' . $bgImageName;
                    $bgFullPath = storage_path('app/public/' . $bgPath);

                    if (!file_exists(dirname($bgFullPath))) {
                        mkdir(dirname($bgFullPath), 0755, true);
                    }

                    $manager->read($file)
                        ->resize(2029, 1080)
                        ->toWebp(80)
                        ->save($bgFullPath);

                    $existingHeroImages[] = $bgPath;
                }
            }

            $validated['hero_background_image'] = !empty($existingHeroImages) ? json_encode($existingHeroImages) : null;

            // ---------------- SAVE ALL ----------------
            $data->fill($validated)->save();

            return redirect()->route('backend.home.index')
                ->with('success', 'Home page updated successfully');

        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Something went wrong! Please try again. ' . $e->getMessage());
        }
    }


    public function details()
    {
        // Always fetch the record with id = 1
        $home = HomeModel::firstOrNew(['id' => 1]);
        return view('backend.home.index', compact('home'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}


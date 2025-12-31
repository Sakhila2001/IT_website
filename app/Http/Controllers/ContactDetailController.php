<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\AdminContactMail;
use App\Mail\UserConfirmationMail;
use App\Models\ContactDetailModel;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Cache;
class ContactDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $contact = ContactDetailModel::first();
        return view('backend.contact_details.index', compact('contact')); // For admin
    }




    public function websiteContact()
    {
        $contact = ContactDetailModel::first();
        $seoData = [
            'title' => $contact->seo_title ?? $contact->heading ?? 'Our Services',
            'seo_description' => $contact->seo_description ?? $contact->heading_description ?? '',
            'seo_keyword' => $contact->seo_keywords ?? '',
            'seo_image' => ($contact && $contact->seo_image) ? 'storage/' . $contact->seo_image : '',

        ];
        return view('website.contact', compact('contact', 'seoData')); // For website
    }

    public function edit()
    {
        $contact = ContactDetailModel::firstOrNew(['id' => 1]);
        return view('backend.contact_details.edit', compact('contact'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'heading' => 'required|string|max:255',
            'heading_description' => 'nullable|string',
            'address_info' => 'nullable|string',
            'branch_office' => 'nullable|string',
            'head_office' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'phone2' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'email2' => 'nullable|email|max:255',
            'facebook_link' => 'nullable|url',
            'instagram_link' => 'nullable|url',
            'Linkedin_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'whatsapp_link' => 'nullable|url',
            'map' => 'nullable|string',
            'subscription' => 'nullable|string',
            'company_description' => 'nullable|string',
            'company_name' => 'nullable|string|max:255',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'sometimes|string',
            'company_logo' => 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:10048',
            'fav_image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,webp|max:10048',
            'seo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'remove_company_logo' => 'nullable|boolean',
            'remove_fav_image' => 'nullable|boolean',
            'remove_seo_image' => 'nullable|boolean',
            'remove_banner_image' => 'nullable|boolean'
        ]);

        try {
            $manager = new ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
            $contact = ContactDetailModel::firstOrNew(['id' => 1]);

            // Assign simple fillable fields
            $contact->fill($request->only([
                'heading',
                'heading_description',
                'address_info',
                'branch_office',
                'head_office',
                'phone',
                'phone2',
                'email',
                'email2',
                'facebook_link',
                'instagram_link',
                'Linkedin_link',
                'twitter_link',
                'whatsapp_link',
                'map',
                'subscription',
                'company_description',
                'seo_title',
                'seo_description',
                'company_name'
            ]));

            // Format SEO keywords
            if ($request->filled('seo_keywords')) {
                $validated['seo_keywords'] = collect(explode(',', $request->seo_keywords))
                    ->map(fn($item) => trim($item))
                    ->filter()
                    ->unique()
                    ->implode(', ');
                $contact->seo_keywords = $validated['seo_keywords'];
            }

            // Handle company logo
            if ($request->hasFile('company_logo')) {
                if ($contact->company_logo && Storage::exists('public/' . $contact->company_logo)) {
                    Storage::delete('public/' . $contact->company_logo);
                }

                $logo = $request->file('company_logo');
                $logoName = 'logo_' . Str::slug($request->heading) . '_' . uniqid() . '_' . time() . '.webp';
                $logoPath = storage_path('app/public/companylogos');

                if (!File::exists($logoPath)) {
                    File::makeDirectory($logoPath, 0755, true);
                }

                $manager->read($logo->getRealPath())
                    ->scale(700, 200)
                    ->cover(700, 200)
                    ->toWebp(75)
                    ->save($logoPath . '/' . $logoName);

                $contact->company_logo = 'companylogos/' . $logoName;
            } elseif ($request->remove_company_logo) {
                if ($contact->company_logo && Storage::exists('public/' . $contact->company_logo)) {
                    Storage::delete('public/' . $contact->company_logo);
                }
                $contact->company_logo = null;
            }

            // Handle favicon image
            if ($request->hasFile('fav_image')) {
                if ($contact->fav_image && Storage::exists('public/' . $contact->fav_image)) {
                    Storage::delete('public/' . $contact->fav_image);
                }

                $favicon = $request->file('fav_image');
                $faviconName = 'favicon_' . uniqid() . '_' . time() . '.webp';
                $faviconPath = storage_path('app/public/contact_details/favicons');

                if (!File::exists($faviconPath)) {
                    File::makeDirectory($faviconPath, 0755, true);
                }

                $manager->read($favicon->getRealPath())
                    ->resize(32, 32)
                    ->toWebp(75)
                    ->save($faviconPath . '/' . $faviconName);

                $contact->fav_image = 'contact_details/favicons/' . $faviconName;
            } elseif ($request->remove_fav_image) {
                if ($contact->fav_image && Storage::exists('public/' . $contact->fav_image)) {
                    Storage::delete('public/' . $contact->fav_image);
                }
                $contact->fav_image = null;
            }

            // Handle SEO image
            if ($request->remove_seo_image) {
                if ($contact->seo_image && Storage::exists('public/' . $contact->seo_image)) {
                    Storage::delete('public/' . $contact->seo_image);
                }
                $contact->seo_image = null;
            } elseif ($request->hasFile('seo_image')) {
                if ($contact->seo_image && Storage::exists('public/' . $contact->seo_image)) {
                    Storage::delete('public/' . $contact->seo_image);
                }

                $imageName = 'seo_' . time() . '.webp';
                $relativePath = 'contact_details/seo/' . $imageName;
                $fullPath = storage_path('app/public/' . $relativePath);

                if (!file_exists(dirname($fullPath))) {
                    mkdir(dirname($fullPath), 0755, true);
                }

                $manager->read($request->file('seo_image'))
                    ->resize(1200, 630)
                    ->toWebp(75)
                    ->save($fullPath);

                $contact->seo_image = $relativePath;
            }

            // Handle banner image
            if ($request->remove_banner_image) {
                if ($contact->banner_image && Storage::exists('public/' . $contact->banner_image)) {
                    Storage::delete('public/' . $contact->banner_image);
                }
                $contact->banner_image = null;
            } elseif ($request->hasFile('banner_image')) {
                if ($contact->banner_image && Storage::exists('public/' . $contact->banner_image)) {
                    Storage::delete('public/' . $contact->banner_image);
                }

                $banner = $request->file('banner_image');
                $bannerName = 'banner_' . Str::slug($request->heading) . '_' . uniqid() . '_' . time() . '.webp';
                $bannerPath = storage_path('app/public/contact_details/banners');

                if (!File::exists($bannerPath)) {
                    File::makeDirectory($bannerPath, 0755, true);
                }

                $manager->read($banner->getRealPath())
                    ->scale(1920, 1080)
                    ->toWebp(75)
                    ->save($bannerPath . '/' . $bannerName);

                $contact->banner_image = 'contact_details/banners/' . $bannerName;
            }

            $contact->save();
            Cache::forget('contact_details');

            return redirect()->route('backend.contact_details.index')
                ->with('success', 'Contact Details updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Something went wrong! Please Try again.');
        }
    }

    // Add this method to your ContactDetailController
    public function getContactDetails()
    {
        $contact = ContactDetailModel::firstOrNew(['id' => 1]);
        return $contact;
    }



    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        // Sanitize input by removing script tags
        $data = [
            'name' => strip_tags($request->input('name')),
            'email' => strip_tags($request->input('email')),
            'subject' => strip_tags($request->input('subject')),
            'message' => strip_tags($request->input('message')),
        ];

        // Store the sanitized submission in database
        $submission = ContactSubmission::create($data);

        // Get admin email from the contact_details table
        $adminEmail = ContactDetailModel::find(1)?->email ?? 'admin@example.com';

        // Send email to admin with sanitized data
        Mail::to($adminEmail)->send(new AdminContactMail($data));

        // Send confirmation email to the user with sanitized data
        Mail::to($data['email'])->send(new UserConfirmationMail($data));

        return back()->with('success', 'Your message has been sent!');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }


}

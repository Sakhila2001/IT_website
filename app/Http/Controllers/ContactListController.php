<?php

namespace App\Http\Controllers;
use App\Models\ContactSubmission;
use App\Models\PortfolioModel;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ContactListController extends Controller
{
    public function index()
    {
        $submissions = ContactSubmission::latest()->paginate(10);
        return view('backend.contact_list.index', compact('submissions'));
    }

    public function show(ContactSubmission $contact_submission)
    {
        return view('backend.contact_list.show', compact('contact_submission'));
    }

    public function destroy(ContactSubmission $contact_submission)
    {
        $contact_submission->delete();
        return redirect()->route('backend.contact_list.index')
            ->with('success', 'Submission deleted successfully');
    }
   
}

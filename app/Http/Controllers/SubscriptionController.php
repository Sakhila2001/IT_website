<?php
namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Mail\SubscriptionConfirmation;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{
    public function index()
    {
        $subscriptions = Subscription::where('is_delete', 0)
        ->latest()
        ->paginate(10);
return view('backend.subscriptions.index', compact('subscriptions'));
}

    public function store(Request $request)
{
    $request->validate([
        'email' => 'required|email|unique:subscriptions,email'
    ]);

    $subscription = Subscription::create([
        'email' => $request->email
    ]);

    Mail::to($request->email)->send(new SubscriptionConfirmation($subscription));

    if ($request->ajax()) {
        return response()->json(['success' => 'Thank you for subscribing!']);
    }

    return back()->with('success', 'Thank you for subscribing!');
}
public function destroy(Subscription $subscription)
{
    $subscription->update(['is_delete' => 1]);
    
    return back()->with('success', 'Subscription deleted successfully');
}

}

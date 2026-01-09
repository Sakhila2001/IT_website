<?php
namespace App\Http\Controllers;

use App\Models\CareerModel;
use App\Models\PartnerModel;
use App\Models\ServiceModel;
use App\Models\TeamModel;
use App\Models\BlogModel;

class DashboardController extends Controller
{
    public function index()
    {
        $services = ServiceModel::where('is_publish', 'Publish')
                    ->where('is_delete', 0)
                    ->get();

        $teams = TeamModel::where('is_delete', false)
                ->where('is_publish', 'Publish')
                ->orderBy('created_at', 'desc')
                ->get();
       $careers =CareerModel::where('is_delete', false)
                ->where('is_publish', 'Publish')
                ->orderBy('created_at', 'desc')
                ->get();
    $partners =PartnerModel::where('is_delete', false)
    ->where('is_publish', 'Publish')
    ->orderBy('created_at', 'desc')
    ->get();





        return view('dashboard', compact('services', 'teams', 'careers', 'partners'));
    }
}

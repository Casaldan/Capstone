<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $totalUsers = User::count();
            $activeVolunteers = User::where('role', 'volunteer')
                                   ->where('status', 'active')
                                   ->count();
            $recentUsers = User::latest()->take(5)->get();
            
            // Default values if no data exists
            $userIncrease = 0;
            $volunteerIncrease = 0;

            return view('admin.dashboard', compact(
                'totalUsers',
                'activeVolunteers',
                'recentUsers',
                'userIncrease',
                'volunteerIncrease'
            ));
        } catch (\Exception $e) {
            // Fallback if database isn't ready
            return view('admin.dashboard', [
                'totalUsers' => 0,
                'activeVolunteers' => 0,
                'recentUsers' => collect([]),
                'userIncrease' => 0,
                'volunteerIncrease' => 0
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total' => Appointment::count(),
            'pending' => Appointment::where('status', 'pending')->count(),
            'confirmed' => Appointment::where('status', 'confirmed')->count(),
            'cancelled' => Appointment::where('status', 'cancelled')->count(),
        ];

        return Inertia::render('Auth/Dashboard', [
            'stats' => $stats
        ]);
    }
}

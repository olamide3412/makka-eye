<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource for Admin/Staff.
     */
    public function index(Request $request)
    {
        $query = Appointment::latest();
        
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('tracking_number', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
        }

        return Inertia::render('Auth/Appointments/Index', [
            'appointments' => $query->get(),
            'filters' => $request->only(['search'])
        ]);
    }

    /**
     * Display a specific appointment details.
     */
    public function show(Appointment $appointment)
    {
        return Inertia::render('Auth/Appointments/Show', [
            'appointment' => $appointment
        ]);
    }

    /**
     * Show tracking page and handle tracking lookup.
     */
    public function monitor(Request $request)
    {
        $appointment = null;
        if ($request->filled('tracking_number')) {
            $appointment = Appointment::where('tracking_number', $request->input('tracking_number'))->first();
            
            if (!$appointment) {
                return redirect()->back()->with('error', 'No appointment found with that tracking number.');
            }
        }
        
        return Inertia::render('TrackAppointment', [
            'appointment' => $appointment,
            'searched' => $request->filled('tracking_number')
        ]);
    }

    /**
     * Store a newly created resource in storage (public facing booking).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'dob' => 'required|date',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
            'service_needed' => 'required|string|max:255',
            'is_existing_patient' => 'required|boolean',
            'file_number' => 'required_if:is_existing_patient,true|nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        // Generate tracking number
        $validated['tracking_number'] = 'MEH-' . strtoupper(substr(uniqid(), -4)) . '-' . date('Y');

        $appointment = Appointment::create($validated);

        return redirect()->back()->with('success_tracking', $appointment->tracking_number);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:pending,confirmed,completed,cancelled',
        ]);

        $appointment->update($validated);

        return redirect()->back()->with('message', 'Appointment status updated successfully!');
    }
}

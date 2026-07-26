<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    /**
     * Show settings panel (Admin Only).
     */
    public function index()
    {
        $heroSlides = json_decode(Setting::get('hero_slides', '[]'), true);
        $cleaned = false;
        if (is_array($heroSlides)) {
            foreach ($heroSlides as &$slide) {
                if (isset($slide['value'])) {
                    // Normalize absolute localhost paths to root-relative paths
                    if (str_starts_with($slide['value'], 'http://localhost/storage/')) {
                        $slide['value'] = str_replace('http://localhost/storage/', '/storage/', $slide['value']);
                        $cleaned = true;
                    } elseif (str_starts_with($slide['value'], 'http://127.0.0.1:8000/storage/')) {
                        $slide['value'] = str_replace('http://127.0.0.1:8000/storage/', '/storage/', $slide['value']);
                        $cleaned = true;
                    }
                }
            }
            if ($cleaned) {
                Setting::set('hero_slides', json_encode($heroSlides));
            }
        }

        return Inertia::render('Auth/Settings', [
            'settings' => [
                'enable_appointments' => filter_var(Setting::get('enable_appointments', 'true'), FILTER_VALIDATE_BOOLEAN),
                'hero_slides' => $heroSlides,
            ]
        ]);
    }

    /**
     * Update settings keys.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'enable_appointments' => 'required|boolean',
            'hero_slides' => 'nullable|array',
        ]);

        Setting::set('enable_appointments', $validated['enable_appointments'] ? 'true' : 'false');

        $heroSlides = [];
        if (isset($validated['hero_slides']) && is_array($validated['hero_slides'])) {
            foreach ($validated['hero_slides'] as $slide) {
                if (!empty($slide['value']) && in_array($slide['type'] ?? '', ['link', 'upload'])) {
                    $heroSlides[] = [
                        'type' => $slide['type'],
                        'value' => $slide['value'],
                    ];
                }
            }
        }
        Setting::set('hero_slides', json_encode($heroSlides));

        return redirect()->back()->with('message', 'Settings updated successfully!');
    }
}

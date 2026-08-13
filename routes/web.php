<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TestimonyController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Public Pages
Route::get('/', function () {
    $testimonials = \App\Models\Testimony::approved()->take(8)->get(['name', 'occupation', 'rating', 'message']);
    $partners = \App\Models\Partner::active()->get(['id', 'name', 'logo_url', 'website_url', 'description']);

    // Media Center: top 4 articles per category for homepage tabs (no pagination needed)
    $mediaCenterArticles = [
        'news'  => \App\Models\News::published()->where('category', 'news')->latest('published_at')->take(4)->get(['id','title','slug','excerpt','cover_image','media_gallery','published_at','category']),
        'event' => \App\Models\News::published()->where('category', 'event')->latest('published_at')->take(4)->get(['id','title','slug','excerpt','cover_image','media_gallery','published_at','category']),
        'media' => \App\Models\News::published()->where('category', 'media')->latest('published_at')->take(4)->get(['id','title','slug','excerpt','cover_image','media_gallery','published_at','category']),
    ];

    return Inertia::render('Home', [
        'testimonials'        => $testimonials,
        'partners'            => $partners,
        'mediaCenterArticles' => $mediaCenterArticles,
    ])->withViewData([
        'meta' => [
            'title' => 'Makkah Specialist Eye Hospital | Premier Eye Care Services',
            'description' => 'Makkah Specialist Eye Hospital is a leading eye care facility providing comprehensive eye exams, cataract surgery, LASIK, and 24/7 emergency care.'
        ]
    ]);
})->name('home');


Route::get('/about-us', function () {
    return Inertia::render('About', [
        'about_mission'       => \App\Models\Setting::get('about_mission', '<p>To eradicate preventable blindness and provide accessible, world-class ophthalmic care across Africa and Asia through clinical excellence, advanced diagnostics, and compassionate service.</p>'),
        'about_vision'        => \App\Models\Setting::get('about_vision', '<p>To create a world where quality eye care is accessible to every individual, ensuring a future free of preventable visual impairment and blindness.</p>'),
        'about_founder_name'  => \App\Models\Setting::get('about_founder_name', 'His Highness Prince Abdul-Aziz bin Ahmed Al-Saud'),
        'about_founder_title' => \App\Models\Setting::get('about_founder_title', 'Founder & Chairman, Al-Basar International Foundation'),
        'about_founder_bio'   => \App\Models\Setting::get('about_founder_bio', '<p>Founded in 1989, Al-Basar International Foundation has established specialized eye hospitals and mobile eye clinics across Africa and Asia, treating millions of patients and preventing avoidable blindness.</p>'),
        'about_founder_image' => \App\Models\Setting::get('about_founder_image', ''),
    ])->withViewData([
        'meta' => [
            'title' => 'About Us | Makkah Specialist Eye Hospital',
            'description' => 'Learn more about Makkah Specialist Eye Hospital, our team of dedicated professionals, state-of-the-art facilities, and mission to deliver exceptional eye care.'
        ]
    ]);
})->name('about');

Route::get('/services', function () {
    return Inertia::render('Services')->withViewData([
        'meta' => [
            'title' => 'Our Services | Makkah Specialist Eye Hospital',
            'description' => 'Explore our wide range of eye care services, including cataract surgery, glaucoma management, LASIK, and pediatric ophthalmology.'
        ]
    ]);
})->name('services');

Route::get('/services/{slug}', function ($slug) {
    $serviceNames = [
        'glaucoma' => 'Adult & Paediatric Glaucoma',
        'squint' => 'Adult & Paediatric Squint',
        'cataracts' => 'Adult & Paediatric Cataracts',
        'prosthetic' => 'Artificial Eye Creation & Fitting',
        'examination' => 'Comprehensive Eye Examinations',
        'lasik' => 'LASIK & Refractive Surgery',
        'retina' => 'Retinal Disorders Treatment',
        'cornea' => 'Corneal Transplantation',
        'diabetic' => 'Diabetic Eye Care',
        'emergency' => 'Emergency Eye Care',
    ];

    $serviceName = $serviceNames[$slug] ?? 'Eye Care Service';

    return Inertia::render('Services/Show', ['slug' => $slug])->withViewData([
        'meta' => [
            'title' => $serviceName . ' | Makkah Specialist Eye Hospital',
            'description' => 'Learn more about ' . $serviceName . ' at Makkah Specialist Eye Hospital. Dedicated specialists, state-of-the-art technology, and world-class patient care.'
        ]
    ]);
})->name('services.show');

Route::get('/contact', function () {
    return Inertia::render('Contact')->withViewData([
        'meta' => [
            'title' => 'Contact Us | Makkah Specialist Eye Hospital',
            'description' => 'Get in touch with us for inquiries, directions, or booking assistance. We are located at Elebu Junction, Alao-Akala Express, Ibadan.'
        ]
    ]);
})->name('contact');

// Public Department Routes
Route::get('/departments', function () {
    return Inertia::render('Departments/Index')->withViewData([
        'meta' => [
            'title' => 'Our Departments | Makkah Specialist Eye Hospital',
            'description' => 'Explore the specialized medical departments at Makkah Specialist Eye Hospital including Diagnostics, Pharmacy, Optical Shop, and Optical Workshop.'
        ]
    ]);
})->name('departments.index');

Route::get('/departments/{slug}', function ($slug) {
    $departments = [
        'diagnostic' => 'Diagnostic Department',
        'pharmacy' => 'Pharmacy Department',
        'optical-shop' => 'Optical Shop',
        'optical-workshop' => 'Optical Workshop',
    ];

    $title = $departments[$slug] ?? 'Department';

    return Inertia::render('Departments/Show', ['slug' => $slug])->withViewData([
        'meta' => [
            'title' => $title . ' | Makkah Specialist Eye Hospital',
            'description' => 'Learn more about the ' . $title . ' at Makkah Specialist Eye Hospital. State-of-the-art facilities and dedicated healthcare specialists.'
        ]
    ]);
})->name('departments.show');

Route::get('/faq', function () {
    return Inertia::render('FAQ')->withViewData([
        'meta' => [
            'title' => 'Frequently Asked Questions | Makkah Specialist Eye Hospital',
            'description' => 'Find answers to common questions about eye health, treatments, appointment scheduling, and hospital services.'
        ]
    ]);
})->name('faq');

// Public Appointment Booking
Route::get('/book-appointment', function () {
    return Inertia::render('BookAppointment')->withViewData([
        'meta' => [
            'title' => 'Book Appointment | Makkah Specialist Eye Hospital',
            'description' => 'Schedule your eye exam or medical consultation online at Makkah Specialist Eye Hospital.'
        ]
    ]);
})->name('book-appointment');

Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('/track-appointment', [AppointmentController::class, 'monitor'])->name('track-appointment');

// ── Public Blog ─────────────────────────────────────────────────────────────
Route::get('/blog', [BlogController::class, 'publicIndex'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'publicShow'])->name('blog.show');

// ── Public Testimonials ──────────────────────────────────────────────────────
Route::get('/testimonials', [TestimonyController::class, 'publicIndex'])->name('testimonials.index');
Route::post('/testimonials', [TestimonyController::class, 'publicStore'])->name('testimonials.store');

// ── Public News & Media ──────────────────────────────────────────────────────
Route::get('/news', [NewsController::class, 'publicIndex'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'publicShow'])->name('news.show');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLinkRequestForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Dashboard & Staff Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // Manage specific Appointments
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])->name('appointments.show');
    Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update');

    // ── Image Upload ─────────────────────────────────────────────────────────
    Route::post('/admin/upload-image', [ImageUploadController::class, 'store'])->name('admin.upload-image');
    Route::post('/admin/upload-media', [ImageUploadController::class, 'uploadMedia'])->name('admin.upload-media');

    // ── Admin Blog ───────────────────────────────────────────────────────────
    Route::get('/admin/blog', [BlogController::class, 'index'])->name('admin.blog.index');
    Route::get('/admin/blog/create', [BlogController::class, 'create'])->name('admin.blog.create');
    Route::post('/admin/blog', [BlogController::class, 'store'])->name('admin.blog.store');
    Route::get('/admin/blog/{blog}/edit', [BlogController::class, 'edit'])->name('admin.blog.edit');
    Route::put('/admin/blog/{blog}', [BlogController::class, 'update'])->name('admin.blog.update');
    Route::delete('/admin/blog/{blog}', [BlogController::class, 'destroy'])->name('admin.blog.destroy');

    // ── Admin Testimonials ───────────────────────────────────────────────────
    Route::get('/admin/testimonials', [TestimonyController::class, 'index'])->name('admin.testimonials.index');
    Route::patch('/admin/testimonials/{testimony}/approve', [TestimonyController::class, 'approve'])->name('admin.testimonials.approve');
    Route::patch('/admin/testimonials/{testimony}/reject', [TestimonyController::class, 'reject'])->name('admin.testimonials.reject');
    Route::delete('/admin/testimonials/{testimony}', [TestimonyController::class, 'destroy'])->name('admin.testimonials.destroy');

    // ── Admin News & Media ───────────────────────────────────────────────────
    Route::get('/admin/news', [NewsController::class, 'index'])->name('admin.news.index');
    Route::get('/admin/news/create', [NewsController::class, 'create'])->name('admin.news.create');
    Route::post('/admin/news', [NewsController::class, 'store'])->name('admin.news.store');
    Route::get('/admin/news/{news}/edit', [NewsController::class, 'edit'])->name('admin.news.edit');
    Route::put('/admin/news/{news}', [NewsController::class, 'update'])->name('admin.news.update');
    Route::delete('/admin/news/{news}', [NewsController::class, 'destroy'])->name('admin.news.destroy');

    // ── Admin Partners ───────────────────────────────────────────────────────
    Route::get('/admin/partners', [\App\Http\Controllers\PartnerController::class, 'index'])->name('admin.partners.index');
    Route::post('/admin/partners', [\App\Http\Controllers\PartnerController::class, 'store'])->name('admin.partners.store');
    Route::put('/admin/partners/{partner}', [\App\Http\Controllers\PartnerController::class, 'update'])->name('admin.partners.update');
    Route::delete('/admin/partners/{partner}', [\App\Http\Controllers\PartnerController::class, 'destroy'])->name('admin.partners.destroy');

    // ── Admin Settings ───────────────────────────────────────────────────────
    Route::get('/admin/settings', [SettingController::class, 'index'])->name('admin.settings.index');
    Route::post('/admin/settings', [SettingController::class, 'update'])->name('admin.settings.update');

    // ── Admin Profile ────────────────────────────────────────────────────────
    Route::get('/admin/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/admin/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
});


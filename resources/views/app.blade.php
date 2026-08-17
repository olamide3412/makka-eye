<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $meta['title'] ?? config('app.name', 'Makkah Specialist Eye Hospital') }}</title>

    <meta name="description"
        content="{{ $meta['description'] ?? 'Makkah Specialist Eye Hospital is a leading eye care facility dedicated to providing world-class ophthalmology services. Comprehensive eye exams, cataract surgery, glaucoma treatment, and 24/7 emergency eye care.' }}">
    <meta name="keywords"
        content="Makkah Eye Hospital, Makkah Eye Hospital Ibadan, ophthalmology, eye care, cataract surgery, glaucoma treatment, retinal disorders, pediatric ophthalmology, corneal transplantation, diabetic eye care, emergency eye care, Makkah Saudi Arabia, Ibadan, Nigeria">
    <meta name="robots" content="index, follow">

    <!-- ── SEO: Open Graph (Facebook / LinkedIn) ──────────────────────── -->
    @if(isset($meta))
        <meta property="og:title" content="{{ $meta['title'] }}">
        <meta property="og:description" content="{{ $meta['description'] }}">
        <meta property="og:image" content="{{ $meta['image'] ?? asset('images/logo.png') }}">
        <meta property="og:type" content="{{ $meta['type'] ?? 'website' }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="Makkah Specialist Eye Hospital">
        <meta property="og:locale" content="{{ app()->getLocale() === 'ar' ? 'ar_SA' : 'en_GB' }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">

        <!-- ── SEO: Twitter / X Card ──────────────────────────────────── -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $meta['title'] }}">
        <meta name="twitter:description" content="{{ $meta['description'] }}">
        <meta name="twitter:image" content="{{ $meta['image'] ?? asset('images/logo.png') }}">
        <meta name="twitter:site" content="@MakkahIbadan">
    @else
        <meta property="og:title" content="Makkah Specialist Eye Hospital | Premier Eye Care Services">
        <meta property="og:description"
            content="Makkah Specialist Eye Hospital is a leading eye care facility providing comprehensive eye exams, cataract surgery, glaucoma management, and 24/7 emergency care.">
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="Makkah Specialist Eye Hospital">
        <meta property="og:locale" content="{{ app()->getLocale() === 'ar' ? 'ar_SA' : 'en_GB' }}">
        <meta property="og:image" content="{{ asset('images/logo.png') }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:url" content="{{ url()->current() }}">

        <!-- ── SEO: Twitter / X Card ──────────────────────────────────── -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Makkah Specialist Eye Hospital | Premier Eye Care Services">
        <meta name="twitter:description"
            content="Makkah Specialist Eye Hospital provides comprehensive eye exams, cataract surgery, glaucoma management, and 24/7 emergency eye care.">
        <meta name="twitter:image" content="{{ asset('images/logo.png') }}">
        <meta name="twitter:site" content="@MakkahIbadan">
    @endif

    <!-- ── SEO: JSON-LD Structured Data (Organization) ───────────────── -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "MedicalOrganization",
        "name": "Makkah Specialist Eye Hospital",
        "alternateName": "MSEH Ibadan",
        "description": "A leading eye care facility providing world-class ophthalmology services including comprehensive eye exams, cataract surgery, glaucoma treatment, and emergency eye care.",
        "url": "{{ config('app.url') }}",
        "logo": "{{ asset('images/logo.png') }}",
        "foundingDate": "2023",
        "legalName": "Makkah Specialist Eye Hospital",
        "sameAs": [
            "https://www.facebook.com/p/Makkah-specialist-eye-hospital-Ibadan-61578301984579/",
            "https://www.instagram.com/mseh_ibdan",
            "https://www.tiktok.com/@mseh_ibadan",
            "https://x.com/MakkahIbadan",
            "https://wa.me/2349166661264"
        ],
        "address": {
            "@@type": "PostalAddress",
            "streetAddress": "Ark07 Elebu Junction, Alao-Akala express",
            "addressLocality": "Ibadan",
            "addressRegion": "Oyo State",
            "addressCountry": "NG"
        },
        "contactPoint": {
            "@@type": "ContactPoint",
            "telephone": "+2349166661264",
            "contactType": "Customer Support",
            "areaServed": "NG",
            "availableLanguage": ["English", "Yoruba"],
            "email": "makkah.ibadan@albasar.com"
        },
        "hasOfferCatalog": {
            "@@type": "OfferCatalog",
            "name": "Makkah Specialist Eye Hospital Services",
            "itemListElement": [
                { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Comprehensive Eye Examinations" } },
                { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Cataract Surgery & Lens Implantation" } },
                { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Glaucoma Diagnostic & Surgical Care" } },
                { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Pediatric Ophthalmology" } },
                { "@type": "Offer", "itemOffered": { "@type": "Service", "name": "Retinal Disorders & Vitreous Treatment" } }
            ]
        }
    }
    </script>

    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <!-- Poppins — Primary font (matches moorfields.ae reference site) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @inertiaHead
    @routes
</head>

<body>
    @inertia
</body>

</html>
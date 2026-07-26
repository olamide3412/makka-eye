<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogAndNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get an admin or default user ID
        $admin = User::first();
        $userId = $admin ? $admin->id : 1;

        $blogCategories = ['Eye Care Tips', 'Medical News', 'Patient Stories', 'Hospital Updates', 'Surgical Advances'];
        $newsCategories = ['news', 'event', 'announcement', 'media'];

        // ── 20 Dummy Blog Posts ───────────────────────────────────────────────
        $blogTopics = [
            [
                'title' => '10 Essential Tips for Maintaining Healthy Eyes in the Digital Age',
                'excerpt' => 'With screen times at an all-time high, eye strain is becoming a major public health concern. Learn how to protect your vision with these simple daily adjustments.',
                'body' => '<h3>Introduction</h3><p>In today\'s hyper-connected world, we spend most of our waking hours looking at screens: smartphones, laptops, tablets, and televisions. This constant exposure has led to a significant rise in digital eye strain, also known as Computer Vision Syndrome (CVS).</p><h3>1. Follow the 20-20-20 Rule</h3><p>To reduce eye strain, look away from your screen every 20 minutes and focus on an object at least 20 feet away for at least 20 seconds. This simple exercise helps relax the focusing muscles inside your eyes.</p><h3>2. Adjust Your Screen Settings</h3><p>Ensure your screen brightness matches the ambient lighting in your room. High contrast and larger text sizes can also prevent unnecessary squinting and fatigue.</p><h3>3. Maintain Proper Posture</h3><p>Position your screen about arm\'s length away (20 to 28 inches) and ensure the top of the screen is at or slightly below eye level. This prevents neck and eye muscles from overworking.</p><h3>Conclusion</h3><p>By implementing these easy daily adjustments, you can significantly reduce fatigue and maintain healthy eyesight. Remember to schedule regular eye examinations to monitor your visual health.</p>',
            ],
            [
                'title' => 'Understanding Cataracts: Causes, Symptoms, and Advanced Treatments',
                'excerpt' => 'Cataracts are the leading cause of vision loss worldwide, but they are fully treatable. Learn about the causes, common warning signs, and modern surgical options.',
                'body' => '<h3>What is a Cataract?</h3><p>A cataract is a gradual clouding of the eye\'s natural crystalline lens. Over time, it blocks light from reaching the retina, resulting in blurry, dim, or distorted vision.</p><h3>Common Causes</h3><p>While aging is the most frequent cause of cataracts, other factors include prolonged exposure to ultraviolet (UV) light, diabetes, smoking, obesity, and previous eye injuries.</p><h3>Key Symptoms</h3><ul><li>Progressively blurry or cloudy vision</li><li>Difficulty seeing clearly at night</li><li>Increased sensitivity to glare and light halos</li><li>Fading or yellowing of colors</li></ul><h3>Modern Surgical Solutions</h3><p>With advanced ophthalmology, cataract surgery is now a highly safe, outpatient procedure. Using phacoemulsification, the clouded lens is broken up with ultrasound and replaced with a premium Intraocular Lens (IOL) that can correct pre-existing vision problems.</p>',
            ],
            [
                'title' => 'The Ultimate Guide to LASIK Laser Eye Surgery: What to Expect',
                'excerpt' => 'Thinking about saying goodbye to glasses or contact lenses? Here is a comprehensive guide to LASIK surgery, eligibility criteria, and recovery expectations.',
                'body' => '<h3>What is LASIK?</h3><p>LASIK (Laser-Assisted In Situ Keratomileusis) is a popular refractive surgery designed to correct vision problems such as nearsightedness, farsightedness, and astigmatism.</p><h3>Who is a Good Candidate?</h3><p>To qualify for LASIK, candidates must be at least 18 years old, have a stable eye prescription for at least one year, and possess healthy corneas with adequate thickness.</p><h3>The LASIK Procedure</h3><p>The surgery is quick, usually taking less than 10 minutes per eye. An ophthalmologist uses a laser to create a thin flap in the cornea, reshapes the underlying corneal tissue with another laser, and carefully repositions the flap.</p><h3>Post-Operative Recovery</h3><p>Most patients experience significantly improved vision within 24 hours. Normal activities can be resumed quickly, though swimming, heavy contact sports, and rubbing the eyes must be avoided for several weeks.</p>',
            ],
            [
                'title' => 'Glaucoma: The Silent Thief of Sight and How to Prevent It',
                'excerpt' => 'Glaucoma often develops silently without early symptoms, making regular checkups crucial. Learn about intraocular pressure, risk groups, and management options.',
                'body' => '<h3>Why is it called the "Silent Thief"?</h3><p>Glaucoma is a group of eye conditions that damage the optic nerve, typically due to elevated pressure inside the eye. It is called the silent thief of sight because it rarely causes pain or early warning signs, gradually taking peripheral vision first.</p><h3>Who is at Risk?</h3><p>People over age 60, individuals with a family history of glaucoma, diabetics, and those with highly elevated intraocular pressure are at a higher risk of developing the condition.</p><h3>Treatment and Management</h3><p>Although vision lost to glaucoma cannot be restored, the progression of the disease can be halted. Treatments include prescription eye drops to lower eye pressure, oral medications, laser therapy, and surgical procedures.</p>',
            ]
        ];

        // Let's generate 20 blog posts by cycling and modifying titles
        for ($i = 1; $i <= 20; $i++) {
            $topic = $blogTopics[($i - 1) % count($blogTopics)];
            $title = $topic['title'] . ' (Part ' . ceil($i / 4) . ')';
            if ($i <= 4) {
                $title = $topic['title']; // keep original titles for first 4
            }

            BlogPost::create([
                'user_id' => $userId,
                'title' => $title,
                'slug' => Str::slug($title) . '-' . time() . '-' . rand(10,99),
                'excerpt' => $topic['excerpt'],
                'body' => $topic['body'],
                'cover_image' => null, // defaults to placeholder SVG in the frontend
                'status' => 'published',
                'category' => $blogCategories[($i - 1) % count($blogCategories)],
                'read_time' => rand(4, 10),
                'published_at' => now()->subDays(20 - $i)->subHours(rand(1, 23)),
            ]);
        }

        // ── 20 Dummy News Items ───────────────────────────────────────────────
        $newsTopics = [
            [
                'title' => 'Makkah Specialist Eye Hospital Acquires State-of-the-Art Diagnostic Laser Equipment',
                'excerpt' => 'Our commitment to providing world-class optical care continues with the acquisition of the latest diagnostic laser machinery, allowing faster and more precise screens.',
                'body' => '<h3>New Diagnostic Milestone</h3><p>Makkah Specialist Eye Hospital is proud to announce the acquisition of the latest high-precision diagnostic laser equipment. This advanced machinery will facilitate detailed retina and cornea scans, enabling our specialists to detect anomalies with unparalleled accuracy.</p><h3>Benefits to Patients</h3><p>Patients will benefit from shorter screening sessions, non-invasive imaging, and more accurate diagnostic reports. This technology is particularly beneficial for early-stage glaucoma and macular degeneration monitoring.</p>',
                'category' => 'news'
            ],
            [
                'title' => 'Free Community Eye Screening Outreach and Medical Camp Next Saturday',
                'excerpt' => 'Join our outreach team next Saturday for a free community eye screening medical camp, offering eye tests, consults, and free basic prescription medications.',
                'body' => '<h3>Reaching Out to the Community</h3><p>In line with our mission of preventing avoidable blindness, Makkah Specialist Eye Hospital is hosting a free medical outreach camp next Saturday. Our specialized doctors and clinical nurses will offer complimentary optical consultations, visual acuity assessments, and vital health checks.</p><h3>Event Details</h3><ul><li>Date: Next Saturday</li><li>Time: 8:00 AM - 4:00 PM</li><li>Location: Hospital Main Parking Arena</li></ul>',
                'category' => 'event'
            ],
            [
                'title' => 'Notice: Holiday Operating Hours and Emergency Services Coverage',
                'excerpt' => 'Please note our revised operating hours for the upcoming holidays. Emergency optical services remain fully active 24/7 during this period.',
                'body' => '<h3>Important Announcement</h3><p>Please be advised that the outpatient department and administrative offices will be closed for the upcoming national holiday. However, Makkah Specialist Eye Hospital is dedicated to patient care and will maintain full 24/7 coverage for emergency optical cases.</p><p>For urgent care, please proceed directly to the Emergency Wing or call our emergency hotline at +234 806695 0049.</p>',
                'category' => 'announcement'
            ],
            [
                'title' => 'Special Video Feature: Inside the Modern Ophthalmology Operations Wing',
                'excerpt' => 'Take an exclusive behind-the-scenes virtual tour of our modern surgical theatre and learn about our ultra-clean safety protocols and procedures.',
                'body' => '<h3>A Look Behind the Scenes</h3><p>We are excited to share a new video feature showcasing our surgical facilities. Our medical director guides you through our state-of-the-art sterile operating theatres, highlighting our air filtration systems, patient preparation areas, and robotic surgical interfaces.</p><p>We believe in absolute transparency and patient comfort. Watch the video to learn more about how we safeguard your vision.</p>',
                'category' => 'media'
            ]
        ];

        // Let's generate 20 news items by cycling and modifying titles
        for ($i = 1; $i <= 20; $i++) {
            $topic = $newsTopics[($i - 1) % count($newsTopics)];
            $title = $topic['title'] . ' - Update ' . ceil($i / 4);
            if ($i <= 4) {
                $title = $topic['title']; // keep original titles for first 4
            }

            News::create([
                'user_id' => $userId,
                'title' => $title,
                'slug' => Str::slug($title) . '-' . time() . '-' . rand(10,99),
                'excerpt' => $topic['excerpt'],
                'body' => $topic['body'],
                'cover_image' => null,
                'category' => $topic['category'],
                'status' => 'published',
                'published_at' => now()->subDays(20 - $i)->subHours(rand(1, 23)),
            ]);
        }
    }
}

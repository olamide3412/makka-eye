<?php

namespace Database\Seeders;

use App\Models\Testimony;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arabicNames = [
            'Fatima Al-Harbi',
            'Youssef Al-Otaibi',
            'Aisha Bin Laden',
            'Ahmed Al-Ghamdi',
            'Mariam Al-Dossari',
            'Omar Al-Shehri',
            'Khadija Al-Fahad',
            'Zainab Al-Mansoori',
            'Ali Al-Qahtani',
            'Mustafa Al-Zahrani',
            'Layla Al-Saeed',
            'Tariq Al-Shammari',
            'Salma Al-Nasser',
            'Khalid Al-Malki',
            'Hana Al-Mutairi',
            'Hamza Al-Amri',
            'Amira Al-Suwaidi',
            'Ibrahim Al-Dosari',
            'Noor Al-Otaibi',
            'Bilal Al-Harbi'
        ];

        $occupations = [
            'Teacher',
            'Software Engineer',
            'Retired Civil Servant',
            'Business Owner',
            'University Professor',
            'Graphic Designer',
            'Nurse',
            'Pharmacist',
            'Homemaker',
            'Accountant',
            'Architect',
            'Journalist',
            'Chef',
            'Student',
            'Photographer'
        ];

        $messages = [
            'Excellent service! The cataract surgery was quick and completely painless. I can see clearly now after years of struggling.',
            'The medical staff at Makkah Eye Hospital are highly professional. The laser consultation was very detailed and gave me great confidence.',
            'Highly recommended! I came for a routine checkup and the team diagnosed my early-stage glaucoma. Exceptional care.',
            'Very clean environment and modern equipment. Dr. Al-Rashid was very kind and patient with my elderly mother.',
            'The pediatric eye clinic is amazing. My son was so comfortable during his examination, and the staff was extremely friendly.',
            'I am very pleased with my LASIK surgery results. The recovery was fast and the follow-up care was excellent.',
            'Compassionate team, short waiting times, and very organized booking process. A truly world-class eye specialist clinic.',
            'Their diagnostic procedures are top-notch. They explained my optical test results clearly and helped me choose the best options.',
            'Wonderful experience. The receptionists were very welcoming, and the doctors explained everything in detail. Five stars!',
            'Clean facilities and very professional eye surgeons. I had my dry eye treatment here and the results have been life-changing.',
            'Very grateful to the entire team at Makkah Specialist Eye Hospital. The cornea treatment was successful and handled with great expertise.',
            'Amazing level of patient care. They check on you constantly post-surgery and make sure you have all the recovery instructions.',
            'The best eye hospital in the region. Highly advanced equipment and very experienced consultants. I felt very safe.',
            'Excellent service from booking to discharge. The medical staff are exceptionally polite and knowledgeable.',
            'Quick appointment check-in, polite nursing staff, and very clean diagnostic rooms. Excellent experience overall.',
            'Very satisfied with the treatment. The staff took their time to explain the procedure and allayed all my fears.',
            'Great hospital with friendly atmosphere. The ophthalmology consultants are highly qualified and very thorough.',
            'Excellent follow-up care. They don\'t just perform the surgery; they guide you all through the healing process.',
            'The facility is incredibly clean and sanitised. The doctors are very professional and patient.',
            'Top-tier medical service. They treated my retinal issue immediately and with high precision. Thank you so much.'
        ];

        // Seed 20 testimonials
        for ($i = 0; $i < 20; $i++) {
            Testimony::create([
                'name' => $arabicNames[$i % count($arabicNames)],
                'occupation' => $occupations[$i % count($occupations)],
                'rating' => rand(4, 5), // 4 or 5 star ratings for realistic high reviews
                'message' => $messages[$i % count($messages)],
                'status' => 'approved',
                'created_at' => now()->subDays(rand(1, 30))->subHours(rand(1, 23)),
                'updated_at' => now()
            ]);
        }
    }
}

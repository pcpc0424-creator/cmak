<?php

namespace Database\Seeders;

use App\Models\EnglishContent;
use Illuminate\Database\Seeder;

class EnglishContentSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            // Home
            ['slug' => 'home', 'section' => 'home', 'sort_order' => 0,
             'title' => 'CMAK - Construction Management Association of Korea',
             'description' => 'Leading Korea\'s Construction Management since 1996.',
             'eyebrow' => 'CMAK · Since 1996',
             'hero_image' => '/cmak/images/eng/eng1.jpg'],

            // About CMAK
            ['slug' => 'about/greeting', 'section' => 'about', 'sort_order' => 1,
             'title' => "Chairman's Message",
             'description' => "A welcome message from the Chairman of the Construction Management Association of Korea."],
            ['slug' => 'about/purpose', 'section' => 'about', 'sort_order' => 2,
             'title' => 'Purpose of Establishment',
             'description' => 'Our mission, vision and the founding purpose of CMAK.'],
            ['slug' => 'about/history', 'section' => 'about', 'sort_order' => 3,
             'title' => 'History',
             'description' => 'Nearly three decades of milestones and growth.'],
            ['slug' => 'about/organization', 'section' => 'about', 'sort_order' => 4,
             'title' => 'Organization',
             'description' => "CMAK's leadership and organizational structure."],
            ['slug' => 'about/scheme', 'section' => 'about', 'sort_order' => 5,
             'title' => 'Scheme of Work',
             'description' => "CMAK's core programs and how we serve the construction management profession."],
            ['slug' => 'about/contact', 'section' => 'about', 'sort_order' => 6,
             'title' => 'Contact Us',
             'description' => 'Get in touch with the CMAK secretariat in Seoul, Korea.'],

            // International CM Day
            ['slug' => 'cmday/introduction', 'section' => 'cmday', 'sort_order' => 1,
             'title' => 'Introduction to International CM Day',
             'description' => 'A global celebration of construction management.'],
            ['slug' => 'cmday/members', 'section' => 'cmday', 'sort_order' => 2,
             'title' => 'Participating Members',
             'description' => 'Global CM associations and partner organizations participating in International CM Day.'],
            ['slug' => 'cmday/celebrations', 'section' => 'cmday', 'sort_order' => 3,
             'title' => 'International CM Day Celebrations',
             'description' => 'Highlights of past and upcoming CM Day events.'],
            ['slug' => 'cmday/registration', 'section' => 'cmday', 'sort_order' => 4,
             'title' => 'Registration',
             'description' => 'Register to attend International CM Day in Korea.'],

            // IPMA Korea
            ['slug' => 'ipma/about', 'section' => 'ipma', 'sort_order' => 1,
             'title' => 'About IPMA Korea',
             'description' => 'The Korean chapter of the International Project Management Association.'],
            ['slug' => 'ipma/certification', 'section' => 'ipma', 'sort_order' => 2,
             'title' => 'IPMA Certification',
             'description' => 'Globally recognized, competence-based project management certification.'],
            ['slug' => 'ipma/education', 'section' => 'ipma', 'sort_order' => 3,
             'title' => 'IPMA Korea Education',
             'description' => 'Training programs to build project management competence.'],
            ['slug' => 'ipma/news', 'section' => 'ipma', 'sort_order' => 4,
             'title' => 'News & Events',
             'description' => 'Latest news and upcoming events from IPMA Korea.'],
            ['slug' => 'ipma/membership', 'section' => 'ipma', 'sort_order' => 5,
             'title' => 'IPMA Korea Membership',
             'description' => 'Join the IPMA Korea community of project management professionals.'],
            ['slug' => 'ipma/resources', 'section' => 'ipma', 'sort_order' => 6,
             'title' => 'Resources',
             'description' => 'Tools, guides and references for the IPMA Korea community.'],

            // CMAK News
            ['slug' => 'news/publications', 'section' => 'news', 'sort_order' => 1,
             'title' => 'Publications',
             'description' => 'Magazines, reports and resources from CMAK.'],
            ['slug' => 'news/seminars', 'section' => 'news', 'sort_order' => 2,
             'title' => 'Educations & Seminars',
             'description' => 'Professional development opportunities for the CM community.'],
            ['slug' => 'news/conferences', 'section' => 'news', 'sort_order' => 3,
             'title' => 'Conferences & Events',
             'description' => 'Major conferences, forums and events organized by CMAK.'],

            // Membership
            ['slug' => 'membership', 'section' => 'membership', 'sort_order' => 1,
             'title' => 'CMAK Membership',
             'description' => 'Join the premier association for construction management professionals in Korea.'],
        ];

        foreach ($pages as $page) {
            EnglishContent::updateOrCreate(
                ['slug' => $page['slug']],
                array_merge($page, ['is_published' => true])
            );
        }
    }
}

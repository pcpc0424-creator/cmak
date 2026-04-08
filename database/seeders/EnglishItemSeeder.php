<?php

namespace Database\Seeders;

use App\Models\EnglishContent;
use App\Models\EnglishItem;
use Illuminate\Database\Seeder;

class EnglishItemSeeder extends Seeder
{
    public function run(): void
    {
        // ===========================================================
        // Home page slides
        // ===========================================================
        $this->seed('home', [
            ['type' => 'slide', 'image_path' => '/cmak/images/eng/eng1.jpg', 'tag' => 'CMAK · Since 1996',
             'title' => "Leading Korea's Construction Management",
             'description' => "For nearly three decades, the Construction Management Association of Korea has been at the forefront of advancing CM practice and shaping the future of the construction industry."],
            ['type' => 'slide', 'image_path' => '/cmak/images/eng/eng2.jpg', 'tag' => 'Professional Excellence',
             'title' => 'Building Trust Through Expertise',
             'description' => 'CMAK promotes best practices, standards, and qualifications that empower CM professionals to deliver excellence on every project.'],
            ['type' => 'slide', 'image_path' => '/cmak/images/eng/eng3.jpg', 'tag' => 'Global Network',
             'title' => 'Connecting CM Worldwide',
             'description' => 'Through international partnerships and the IPMA Korea chapter, we connect Korean CM professionals to a global community of practice.'],
            ['type' => 'slide', 'image_path' => '/cmak/images/eng/eng4.jpg', 'tag' => 'International CM Day',
             'title' => 'Celebrating Construction Management',
             'description' => 'Join CM professionals from around the world to celebrate the value, achievements and future of construction management.'],
            ['type' => 'slide', 'image_path' => '/cmak/images/eng/eng5.jpg', 'tag' => 'Innovation & Smart City',
             'title' => 'Advancing Smart Construction',
             'description' => 'CMAK champions digital transformation, BIM, and smart construction to lead the industry into the next era.'],
            ['type' => 'slide', 'image_path' => '/cmak/images/eng/eng6.jpg', 'tag' => 'Sustainability',
             'title' => 'Building a Sustainable Future',
             'description' => 'We promote sustainable construction management practices that balance the built environment with the world we share.'],
        ]);

        // ===========================================================
        // About / History
        // ===========================================================
        $this->seed('about/history', [
            ['type' => 'history', 'date_text' => '1996', 'description' => 'Construction Management Association of Korea (CMAK) founded with approval from the Ministry of Construction & Transportation'],
            ['type' => 'history', 'date_text' => '2001', 'description' => 'Construction Manager qualification examination introduced; CM educational programs launched'],
            ['type' => 'history', 'date_text' => '2005', 'description' => 'CM Capability Evaluation and Disclosure system implemented in cooperation with the government'],
            ['type' => 'history', 'date_text' => '2010', 'description' => 'CMAK established international cooperation programs with major global CM associations'],
            ['type' => 'history', 'date_text' => '2015', 'description' => 'Hosted the first International CM Day celebration in Korea; expanded global outreach'],
            ['type' => 'history', 'date_text' => '2018', 'description' => 'IPMA Korea chapter formally established under CMAK; launched IPMA project management certification in Korea'],
            ['type' => 'history', 'date_text' => '2022', 'description' => 'Launched CMAK digital initiatives including BIM and smart construction working groups'],
            ['type' => 'history', 'date_text' => '2026', 'description' => 'CMAK celebrates 30 years of advancing construction management in Korea'],
        ]);

        // ===========================================================
        // CM Day / Participating Members
        // ===========================================================
        $this->seed('cmday/members', [
            ['type' => 'member', 'subtitle' => 'Republic of Korea', 'title' => 'Construction Management Association of Korea (CMAK)'],
            ['type' => 'member', 'subtitle' => 'United States', 'title' => 'Construction Management Association of America (CMAA)'],
            ['type' => 'member', 'subtitle' => 'United Kingdom', 'title' => 'Chartered Institute of Building (CIOB)'],
            ['type' => 'member', 'subtitle' => 'Japan', 'title' => 'Construction Management Association of Japan (CMAJ)'],
            ['type' => 'member', 'subtitle' => 'China', 'title' => 'China Construction Industry Association (CCIA)'],
            ['type' => 'member', 'subtitle' => 'Hong Kong', 'title' => 'Hong Kong Institute of Construction Managers (HKICM)'],
            ['type' => 'member', 'subtitle' => 'Australia', 'title' => 'Australian Institute of Building (AIB)'],
            ['type' => 'member', 'subtitle' => 'South Africa', 'title' => 'South African Council for the Project and Construction Management Professions'],
            ['type' => 'member', 'subtitle' => 'Europe', 'title' => 'International Project Management Association (IPMA)'],
        ]);

        // ===========================================================
        // CM Day / Celebrations - gallery
        // ===========================================================
        $this->seed('cmday/celebrations', [
            ['type' => 'gallery', 'image_path' => '/cmak/images/eng/eng5.jpg', 'title' => 'Opening Ceremony'],
            ['type' => 'gallery', 'image_path' => '/cmak/images/eng/eng3.jpg', 'title' => 'International Guests'],
            ['type' => 'gallery', 'image_path' => '/cmak/images/eng/eng2.jpg', 'title' => 'Technical Session'],
            ['type' => 'gallery', 'image_path' => '/cmak/images/eng/eng6.jpg', 'title' => 'Sustainability Forum'],
            ['type' => 'gallery', 'image_path' => '/cmak/images/eng/eng1.jpg', 'title' => 'Cultural Programme'],
            ['type' => 'gallery', 'image_path' => '/cmak/images/eng/eng4.jpg', 'title' => 'Networking Reception'],
        ]);

        // ===========================================================
        // IPMA News & Events
        // ===========================================================
        $this->seed('ipma/news', [
            ['type' => 'news', 'date_text' => '15 APR 2026', 'tag' => 'EVENT',
             'title' => 'IPMA Korea Spring Certification Exam — Level D & C',
             'description' => 'Registration is now open for the Spring 2026 IPMA Level D and Level C certification examinations to be held in Seoul.'],
            ['type' => 'news', 'date_text' => '02 APR 2026', 'tag' => 'NEWS',
             'title' => 'IPMA Korea Welcomes New Certified Project Managers',
             'description' => 'Congratulations to the latest cohort of professionals who successfully achieved IPMA certification in Korea.'],
            ['type' => 'news', 'date_text' => '20 MAR 2026', 'tag' => 'SEMINAR',
             'title' => 'Project Risk Management Seminar — Spring Series',
             'description' => 'Join leading PM experts for a half-day seminar on managing project risk in complex construction and infrastructure projects.'],
            ['type' => 'news', 'date_text' => '10 MAR 2026', 'tag' => 'NEWS',
             'title' => 'IPMA Global World Congress — Korean Delegation',
             'description' => 'IPMA Korea will lead the Korean delegation to the upcoming IPMA Global World Congress, featuring keynote presentations from Korean CM leaders.'],
            ['type' => 'news', 'date_text' => '25 FEB 2026', 'tag' => 'EVENT',
             'title' => 'IPMA Korea Annual General Meeting',
             'description' => 'The annual general meeting was held with members of IPMA Korea, reviewing the past year and setting priorities for the year ahead.'],
        ]);

        // ===========================================================
        // CMAK News / Publications
        // ===========================================================
        $this->seed('news/publications', [
            ['type' => 'publication', 'image_path' => '/cmak/images/eng/eng2.jpg', 'tag' => 'MAGAZINE',
             'title' => 'CM Herald',
             'description' => "CMAK's flagship magazine covering CM industry trends, member news, technical articles and policy insights."],
            ['type' => 'publication', 'image_path' => '/cmak/images/eng/eng3.jpg', 'tag' => 'ANNUAL',
             'title' => 'CMAK Annual Report',
             'description' => 'Comprehensive review of CMAK activities, financial highlights and strategic priorities for the year.'],
            ['type' => 'publication', 'image_path' => '/cmak/images/eng/eng5.jpg', 'tag' => 'RESEARCH',
             'title' => 'CM Industry White Paper',
             'description' => 'Annual analysis of the Korean CM industry, market trends, performance indicators and policy recommendations.'],
            ['type' => 'publication', 'image_path' => '/cmak/images/eng/eng4.jpg', 'tag' => 'GUIDE',
             'title' => 'CM Practice Guidelines',
             'description' => 'Reference guidelines on CM best practices, contract forms, deliverables and standard procedures.'],
            ['type' => 'publication', 'image_path' => '/cmak/images/eng/eng6.jpg', 'tag' => 'CASE STUDY',
             'title' => 'CM Case Study Collection',
             'description' => 'Selected case studies of successful CM projects in Korea and abroad, with lessons learned and best practices.'],
            ['type' => 'publication', 'image_path' => '/cmak/images/eng/eng1.jpg', 'tag' => 'DIRECTORY',
             'title' => 'Member Firm Directory',
             'description' => 'Annual directory of CMAK member firms with company profiles, capabilities and contact information.'],
        ]);

        // ===========================================================
        // CMAK News / Educations & Seminars - programs
        // ===========================================================
        $this->seed('news/seminars', [
            ['type' => 'program', 'title' => 'Construction Manager Qualification Preparation', 'subtitle' => 'Aspiring CMs',
             'date_text' => '40 hours', 'description' => 'Twice yearly'],
            ['type' => 'program', 'title' => 'CM Practice Workshop', 'subtitle' => 'Junior CM staff',
             'date_text' => '16 hours', 'description' => 'Quarterly'],
            ['type' => 'program', 'title' => 'BIM for Construction Management', 'subtitle' => 'CM staff',
             'date_text' => '24 hours', 'description' => '3 times yearly'],
            ['type' => 'program', 'title' => 'Smart Construction & Digital Tools', 'subtitle' => 'All CM levels',
             'date_text' => '16 hours', 'description' => 'Twice yearly'],
            ['type' => 'program', 'title' => 'CM Contract Management', 'subtitle' => 'Senior CM staff',
             'date_text' => '16 hours', 'description' => 'Twice yearly'],
            ['type' => 'program', 'title' => 'Sustainable Construction & ESG', 'subtitle' => 'All CM levels',
             'date_text' => '8 hours', 'description' => 'Quarterly'],
        ]);

        // ===========================================================
        // CMAK News / Conferences & Events
        // ===========================================================
        $this->seed('news/conferences', [
            ['type' => 'event', 'image_path' => '/cmak/images/eng/eng4.jpg',
             'title' => 'International CM Day — Korea Celebration',
             'date_text' => 'Annual (Spring)', 'subtitle' => 'Seoul, Korea · 500+ attendees',
             'description' => 'The Korean celebration of International CM Day, featuring keynote lectures, panel discussions, awards and networking with CM leaders from Korea and abroad.'],
            ['type' => 'event', 'image_path' => '/cmak/images/eng/eng5.jpg',
             'title' => 'CMAK Annual Conference',
             'date_text' => 'Annual (Autumn)', 'subtitle' => 'Seoul, Korea · 800+ attendees',
             'description' => "CMAK's flagship annual conference covering CM industry outlook, policy, technology, smart construction, BIM, and sustainable practices."],
            ['type' => 'event', 'image_path' => '/cmak/images/eng/eng3.jpg',
             'title' => 'Korea CM Forum',
             'date_text' => 'Twice yearly', 'subtitle' => 'Seoul, Korea · 300+ attendees',
             'description' => 'A high-level forum bringing together CM industry leaders, government officials and academia to discuss policy, regulation and the future of CM in Korea.'],
            ['type' => 'event', 'image_path' => '/cmak/images/eng/eng2.jpg',
             'title' => 'CM Capability Awards',
             'date_text' => 'Annual', 'subtitle' => 'Seoul, Korea',
             'description' => 'Annual recognition of outstanding CM firms, projects and individuals, based on the CM capability evaluation and disclosure system.'],
            ['type' => 'event', 'image_path' => '/cmak/images/eng/eng6.jpg',
             'title' => 'Sustainability & Smart Construction Symposium',
             'date_text' => 'Annual', 'subtitle' => 'Seoul, Korea',
             'description' => 'A focused symposium exploring sustainable construction, ESG, BIM, smart sites and digital transformation in the construction industry.'],
        ]);
    }

    protected function seed(string $slug, array $items): void
    {
        $page = EnglishContent::where('slug', $slug)->first();
        if (!$page) {
            $this->command->warn("Page not found: $slug");
            return;
        }

        // Skip if items already exist (idempotent)
        if ($page->items()->count() > 0) {
            return;
        }

        foreach ($items as $i => $item) {
            EnglishItem::create(array_merge($item, [
                'english_content_id' => $page->id,
                'sort_order' => $i + 1,
                'is_active' => true,
            ]));
        }
    }
}

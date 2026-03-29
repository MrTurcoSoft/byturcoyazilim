<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use App\Models\Service;
use App\Models\Reference;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
            ]
        );

        // Create default settings
        $settings = [
            ['key' => 'site_name', 'value' => 'DigiAgency', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Profesyonel web tasarım, yazılım ve dijital pazarlama çözümleri sunuyoruz.', 'group' => 'general'],
            ['key' => 'theme_mode', 'value' => 'dark', 'group' => 'appearance'],
            ['key' => 'contact_phone', 'value' => '+90 212 123 45 67', 'group' => 'contact'],
            ['key' => 'contact_email', 'value' => 'info@digiagency.com', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => 'İstanbul, Türkiye', 'group' => 'contact'],
            ['key' => 'social_facebook', 'value' => 'https://facebook.com', 'group' => 'social'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com', 'group' => 'social'],
            ['key' => 'social_linkedin', 'value' => 'https://linkedin.com', 'group' => 'social'],
            ['key' => 'about_text', 'value' => 'Dijital dünyada fark yaratmak isteyen işletmelere, yaratıcı web tasarım ve akıllı yazılım çözümleri sunuyoruz. 10 yılı aşkın deneyimimizle fikirden hayata, her adımda yanınızdayız.', 'group' => 'about'],
            ['key' => 'vision_text', 'value' => 'Dijital dünyada lider bir ajans olarak, müşterilerimizin başarılarını en üst düzeye çıkarmak için yenilikçi çözümler sunmak.', 'group' => 'about'],
            ['key' => 'mission_text', 'value' => 'En son teknolojileri kullanarak, müşterilerimize kaliteli, yenilikçi ve sürdürülebilir dijital çözümler sunmak.', 'group' => 'about'],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(['key' => $setting['key']], $setting);
        }

        // Create sample services
        $services = [
            [
                'title' => ['tr' => 'Web Tasarım', 'en' => 'Web Design'],
                'description' => ['tr' => 'Modern ve kullanıcı dostu web siteleri tasarlıyoruz. UI/UX odaklı, responsive ve SEO uyumlu tasarımlar.', 'en' => 'We design modern and user-friendly websites. UI/UX focused, responsive and SEO friendly designs.'],
                'features' => ['tr' => ['Özgün Tasarım', 'Responsive Tasarım', 'UI/UX Odaklı', 'SEO Uyumlu', 'Hız Optimizasyonu'], 'en' => ['Custom Design', 'Responsive Design', 'UI/UX Focused', 'SEO Friendly', 'Speed Optimization']],
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => ['tr' => 'Web Yazılım', 'en' => 'Web Development'],
                'description' => ['tr' => 'Özel yazılım çözümleri ile işletmenizi dijitalleştirin. Güvenli, ölçeklenebilir ve performanslı uygulamalar.', 'en' => 'Digitize your business with custom software solutions. Secure, scalable and performant applications.'],
                'features' => ['tr' => ['Özel Yazılım', 'API Entegrasyonu', 'Veritabanı Yönetimi', 'Admin Panel', 'Güvenlik'], 'en' => ['Custom Software', 'API Integration', 'Database Management', 'Admin Panel', 'Security']],
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => ['tr' => 'E-Ticaret', 'en' => 'E-Commerce'],
                'description' => ['tr' => 'Online satışlarınızı artıracak e-ticaret çözümleri. Ödeme entegrasyonu, stok yönetimi ve daha fazlası.', 'en' => 'E-commerce solutions to increase your online sales. Payment integration, inventory management and more.'],
                'features' => ['tr' => ['Ödeme Entegrasyonu', 'Stok Yönetimi', 'Kargo Takibi', 'Müşteri Paneli', 'Raporlama'], 'en' => ['Payment Integration', 'Inventory Management', 'Shipping Tracking', 'Customer Panel', 'Reporting']],
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => ['tr' => 'Mobil Uygulama', 'en' => 'Mobile App'],
                'description' => ['tr' => 'iOS ve Android platformları için native ve hybrid mobil uygulamalar geliştiriyoruz.', 'en' => 'We develop native and hybrid mobile applications for iOS and Android platforms.'],
                'features' => ['tr' => ['iOS Uygulama', 'Android Uygulama', 'Cross Platform', 'Push Notification', 'Offline Destek'], 'en' => ['iOS App', 'Android App', 'Cross Platform', 'Push Notification', 'Offline Support']],
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => ['tr' => 'SEO & Dijital Pazarlama', 'en' => 'SEO & Digital Marketing'],
                'description' => ['tr' => 'Arama motorlarında üst sıralarda yer alın. Google Ads, sosyal medya yönetimi ve içerik pazarlama.', 'en' => 'Rank higher in search engines. Google Ads, social media management and content marketing.'],
                'features' => ['tr' => ['SEO Optimizasyonu', 'Google Ads', 'Sosyal Medya', 'İçerik Pazarlama', 'Analytics'], 'en' => ['SEO Optimization', 'Google Ads', 'Social Media', 'Content Marketing', 'Analytics']],
                'order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::firstOrCreate(['title->tr' => $service['title']['tr']], $service);
        }

        // Create sample references
        $references = [
            [
                'title' => ['tr' => 'E-Ticaret Platformu', 'en' => 'E-Commerce Platform'],
                'description' => ['tr' => 'Modern bir e-ticaret platformu geliştirdik.', 'en' => 'We developed a modern e-commerce platform.'],
                'client_name' => 'ABC Mağazası',
                'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800',
                'category' => 'E-Ticaret',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => ['tr' => 'Kurumsal Web Sitesi', 'en' => 'Corporate Website'],
                'description' => ['tr' => 'Kurumsal kimliğe uygun web sitesi tasarladık.', 'en' => 'We designed a website suitable for corporate identity.'],
                'client_name' => 'XYZ Holding',
                'image' => 'https://images.unsplash.com/photo-1467232004584-a241de8bcf5d?w=800',
                'category' => 'Kurumsal',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => ['tr' => 'Mobil Uygulama', 'en' => 'Mobile Application'],
                'description' => ['tr' => 'Kullanıcı dostu mobil uygulama geliştirdik.', 'en' => 'We developed a user-friendly mobile application.'],
                'client_name' => 'Tech Startup',
                'image' => 'https://images.unsplash.com/photo-1551650975-87deedd944c3?w=800',
                'category' => 'Mobil',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($references as $reference) {
            Reference::firstOrCreate(['client_name' => $reference['client_name']], $reference);
        }
    }
}

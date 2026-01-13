<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FacilitySettings;
use App\Models\FacilityBox;
use App\Models\SubFacility;
use App\Models\SubFacilitySettings;
use App\Models\SubFacilityBox;
use App\Models\SubFacilityPhoto;
use App\Models\FacilityContent;
use App\Models\FacilityPhoto;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Facility Settings
        FacilitySettings::create([
            'title' => 'Fasilitas di Sekolah',
            'subtitle' => 'Terdapat beragam fasilitas yang tersebar di seluruh sekolah. Kami berkomitmen untuk menciptakan lingkungan belajar yang nyaman untuk seluruh siswa.',
            'title_panel_bg_color' => 'bg-green-400',
            'subtitle_panel_bg_color' => 'bg-blue-600',
            'is_active' => true,
        ]);

        // Create Facility Content
        FacilityContent::create([
            'section_title' => 'Fasilitas Unggulan Sekolah Kami',
            'content' => '<p>Sekolah kami berkomitmen untuk menyediakan fasilitas terbaik guna mendukung proses pembelajaran yang berkualitas. Kami memiliki berbagai fasilitas modern yang dirancang khusus untuk menciptakan lingkungan belajar yang nyaman, aman, dan inspiratif bagi seluruh siswa.</p>

<p>Fasilitas-fasilitas unggulan kami meliputi ruang kelas berteknologi tinggi, laboratorium komputer dengan perangkat terkini, perpustakaan digital dengan koleksi lengkap, serta berbagai fasilitas olahraga dan rekreasi. Setiap fasilitas dirawat dengan baik dan terus diperbarui untuk memastikan kualitas terbaik.</p>

<p>Kami percaya bahwa lingkungan belajar yang baik akan mendukung prestasi akademik dan pengembangan karakter siswa. Oleh karena itu, investasi pada fasilitas pendidikan menjadi prioritas utama dalam upaya menciptakan generasi yang unggul dan berdaya saing tinggi.</p>',
            'display_type' => 'wysiwyg',
            'show_photo_collage' => true,
            'order_index' => 1,
            'is_active' => true,
        ]);

        // Create Facility Boxes
        $facilityBoxes = [
            [
                'title' => 'Bookstore',
                'description' => 'Temukan berbagai buku terbaik sebagai sumber belajarmu dengan harga termurah.',
                'link_slug' => 'bookstore',
                'bg_color' => 'bg-blue-600',
                'hover_bg_color' => 'bg-blue-700',
                'order_index' => 1,
                'is_active' => true,
                'creates_sub_facility' => true,
            ],
            [
                'title' => 'Kantin',
                'description' => 'Nikmati berbagai kuliner di setiap kampus dengan harga terjangkau.',
                'link_slug' => 'kantin',
                'bg_color' => 'bg-blue-600',
                'hover_bg_color' => 'bg-blue-700',
                'order_index' => 2,
                'is_active' => true,
                'creates_sub_facility' => true,
            ],
            [
                'title' => 'Ruang Terbuka',
                'description' => 'Setiap sudut di sekolah adalah ruang sosial yang nyaman untuk belajar. Jelajahi berbagai tempat belajar nyaman di sekolah.',
                'link_slug' => 'ruang-sosial',
                'bg_color' => 'bg-green-500',
                'hover_bg_color' => 'bg-yellow-500',
                'order_index' => 3,
                'is_active' => true,
                'creates_sub_facility' => true,
            ],
        ];

        foreach ($facilityBoxes as $box) {
            FacilityBox::create($box);
        }

        // Create Sub-Facility Settings for Ruang Kelas
        SubFacilitySettings::create([
            'parent_slug' => 'ruang-sosial',
            'title' => 'Ruang Kelas di Sekolah',
            'subtitle' => 'Terdapat beragam ruang kelas yang tersebar di seluruh sekolah. Kami berkomitmen untuk menciptakan lingkungan belajar yang nyaman untuk seluruh siswa.',
            'title_panel_bg_color' => 'bg-yellow-400',
            'subtitle_panel_bg_color' => 'bg-blue-600',
            'content_section_title' => 'Setiap Sudut di Sekolah Adalah Ruang Sosial yang Nyaman',
            'content_section_text' => '<p>Sekolah peduli dengan kenyamanan siswanya. Oleh karena itu, sekolah memiliki berbagai ruang sosial yang indah dan nyaman. Di sini, kamu dapat menikmati suasana alam yang segar dan menenangkan, berkumpul bersama teman atau guru untuk berdiskusi, dan belajar dengan nyaman. Ruang sosial dapat ditemui di berbagai sudut di sekolah. Setiap sudutnya memiliki keunikannya masing-masing. Sekolah percaya dengan adanya ruangan terbuka seperti ini dapat memantik inspirasi dan membantumu dalam proses belajar. Sekolah mendorong kamu untuk menggunakan fasilitas bersama dengan bijaksana, menjaga kebersihan, dan saling menghormati.</p>',
            'display_type' => 'grid',
            'show_photo_collage' => true,
            'is_active' => true,
        ]);

        // Create Sub-Facility Boxes for Ruang Kelas
        $subFacilityBoxes = [
            [
                'parent_slug' => 'ruang-sosial',
                'title' => 'Teknologi Digital',
                'description' => 'Ruang kelas dilengkapi dengan teknologi digital terdepan untuk pembelajaran interaktif dan modern.',
                'bg_color' => 'bg-blue-600',
                'hover_bg_color' => 'bg-blue-700',
                'order_index' => 1,
                'is_active' => true,
            ],
            [
                'parent_slug' => 'ruang-sosial',
                'title' => 'Smart Classroom',
                'description' => 'Sistem pembelajaran pintar dengan proyektor interaktif, Wi-Fi berkecepatan tinggi, dan perangkat multimedia.',
                'bg_color' => 'bg-blue-600',
                'hover_bg_color' => 'bg-blue-700',
                'order_index' => 2,
                'is_active' => true,
            ],
            [
                'parent_slug' => 'ruang-sosial',
                'title' => 'Fasilitas Modern',
                'description' => 'AC, pencahayaan LED, meja ergonomis, dan peralatan pembelajaran digital untuk kenyamanan maksimal siswa.',
                'bg_color' => 'bg-green-500',
                'hover_bg_color' => 'bg-green-600',
                'order_index' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($subFacilityBoxes as $box) {
            SubFacilityBox::create($box);
        }

        // Create Sub-Facilities for Ruang Kelas
        $subFacilities = [
            [
                'name' => 'Ruang Kelas A1',
                'description' => 'Ruang kelas modern dengan fasilitas AC dan proyektor untuk mendukung pembelajaran yang nyaman.',
                'category' => 'Ruang Kelas',
                'capacity' => 30,
                'location' => 'Lantai 1, Gedung A',
                'specifications' => [
                    'ac' => '2 unit',
                    'proyektor' => '1 unit',
                    'papan_tulis' => '1 unit',
                    'meja_siswa' => '30 unit',
                    'kursi_siswa' => '30 unit',
                ],
                'order_index' => 1,
                'is_active' => true,
                'parent_slug' => 'ruang-sosial',
            ],
            [
                'name' => 'Ruang Kelas B2',
                'description' => 'Ruang kelas dengan pencahayaan alami yang baik dan ventilasi udara yang optimal.',
                'category' => 'Ruang Kelas',
                'capacity' => 35,
                'location' => 'Lantai 2, Gedung B',
                'specifications' => [
                    'ac' => '2 unit',
                    'proyektor' => '1 unit',
                    'papan_tulis' => '1 unit',
                    'meja_siswa' => '35 unit',
                    'kursi_siswa' => '35 unit',
                    'ventilasi' => 'Optimal',
                ],
                'order_index' => 2,
                'is_active' => true,
                'parent_slug' => 'ruang-sosial',
            ],
            [
                'name' => 'Ruang Kelas C3',
                'description' => 'Ruang kelas multimedia dengan peralatan audio visual lengkap untuk presentasi.',
                'category' => 'Ruang Kelas',
                'capacity' => 25,
                'location' => 'Lantai 3, Gedung C',
                'specifications' => [
                    'ac' => '2 unit',
                    'proyektor' => '1 unit',
                    'papan_tulis' => '1 unit',
                    'meja_siswa' => '25 unit',
                    'kursi_siswa' => '25 unit',
                    'audio_system' => '1 unit',
                    'speaker' => '4 unit',
                ],
                'order_index' => 3,
                'is_active' => true,
                'parent_slug' => 'ruang-sosial',
            ],
        ];

        foreach ($subFacilities as $facility) {
            SubFacility::create($facility);
        }

        // Create Sub-Facility Photos for Photo Collage
        $subFacilityPhotos = [
            [
                'parent_slug' => 'ruang-sosial',
                'title' => 'Ruang Kelas Modern 1',
                'description' => 'Ruang kelas dengan fasilitas modern dan teknologi terdepan',
                'image' => 'sub-facilities/photos/ruang_kelas_1.jpg',
                'alt_text' => 'Ruang kelas modern dengan proyektor dan AC',
                'order_index' => 1,
                'is_active' => true,
            ],
            [
                'parent_slug' => 'ruang-sosial',
                'title' => 'Ruang Kelas Modern 2',
                'description' => 'Ruang kelas dengan pencahayaan alami yang optimal',
                'image' => 'sub-facilities/photos/ruang_kelas_2.jpg',
                'alt_text' => 'Ruang kelas dengan pencahayaan alami',
                'order_index' => 2,
                'is_active' => true,
            ],
            [
                'parent_slug' => 'ruang-sosial',
                'title' => 'Ruang Multimedia',
                'description' => 'Ruang kelas multimedia dengan peralatan audio visual lengkap',
                'image' => 'sub-facilities/photos/ruang_multimedia.jpg',
                'alt_text' => 'Ruang multimedia dengan peralatan audio visual',
                'order_index' => 3,
                'is_active' => true,
            ],
            [
                'parent_slug' => 'ruang-sosial',
                'title' => 'Laboratorium Digital',
                'description' => 'Laboratorium digital untuk pembelajaran teknologi',
                'image' => 'sub-facilities/photos/lab_digital.jpg',
                'alt_text' => 'Laboratorium digital dengan komputer modern',
                'order_index' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($subFacilityPhotos as $photo) {
            SubFacilityPhoto::create($photo);
        }

        // Create Facility Photos for Main Page Photo Collage
        $facilityPhotos = [
            [
                'title' => 'Ruang Kelas Modern',
                'description' => 'Ruang kelas dengan fasilitas teknologi terdepan',
                'image' => 'facilities/photos/main_classroom.jpg',
                'alt_text' => 'Ruang kelas modern dengan proyektor dan AC',
                'order_index' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Laboratorium Komputer',
                'description' => 'Lab komputer dengan perangkat terkini untuk pembelajaran IT',
                'image' => 'facilities/photos/computer_lab.jpg',
                'alt_text' => 'Laboratorium komputer dengan PC modern',
                'order_index' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Perpustakaan Digital',
                'description' => 'Perpustakaan modern dengan koleksi buku digital dan fisik',
                'image' => 'facilities/photos/library.jpg',
                'alt_text' => 'Perpustakaan digital dengan koleksi lengkap',
                'order_index' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Lapangan Olahraga',
                'description' => 'Lapangan serbaguna untuk berbagai aktivitas olahraga',
                'image' => 'facilities/photos/sports_field.jpg',
                'alt_text' => 'Lapangan olahraga outdoor',
                'order_index' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($facilityPhotos as $photo) {
            FacilityPhoto::create($photo);
        }
    }
} 
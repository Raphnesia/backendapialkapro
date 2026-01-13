<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomeSectionResource\Pages;
use App\Models\HomeSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Radio;
use Filament\Forms\Get;
use Filament\Forms\Components\ColorPicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;

class HomeSectionResource extends Resource
{
    protected static ?string $model = HomeSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Section Home';
    protected static ?string $modelLabel = 'Section Home';
    protected static ?string $pluralModelLabel = 'Section Home';
    protected static ?string $navigationGroup = 'Home';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Konten Section')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Section')
                            ->required()
                            ->maxLength(255),
                        Select::make('section_type')
                            ->label('Tipe Section')
                            ->required()
                            ->options([
                                'hero' => 'Hero/Banner',
                                'principal_welcome' => 'Sambutan Kepala Sekolah',
                                'why_choose_us' => 'Why Choose Us',
                                'facilities' => 'Fasilitas',
                                'alkapro_ecosystem' => 'Alkapro Smart School Ecosystem',

                                'achievements_modern' => 'Prestasi Siswa (Modern)',
                                'activities_section' => 'Kegiatan Sekolah',
                                'testimonials' => 'Testimoni',
                                'youtube' => 'YouTube',
                                 'social_media_feed' => 'Social Media Feed',
                                'news' => 'Berita Terbaru',
                                'about' => 'Tentang Kami',
                                'cta' => 'Call to Action',
                                'partners' => 'Mitra',
                                'footer' => 'Footer',
                                'custom' => 'Custom',
                            ])
                            ->default('custom')
                            ->live(),
                        RichEditor::make('content')
                            ->label('Konten')
                            ->columnSpanFull()
                            ->fileAttachmentsDirectory('home-sections'),
                        FileUpload::make('image')
                            ->label('Gambar')
                            ->image()
                            ->directory('home-sections')
                            ->maxSize(2048),
                    ])->columns(2),

                Section::make('Status & Urutan')
                    ->schema([
                        TextInput::make('order_index')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0)
                            ->required(),
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                    ]),

                // Konfigurasi Khusus per Section (tersimpan dalam kolom JSON config_data)
                Section::make('Konfigurasi Khusus Section')
                    ->statePath('config_data')
                    ->schema([
                        // 1) HERO SECTION
                        Radio::make('background_mode')
                            ->label('Mode Latar Belakang')
                            ->options([
                                'video' => 'Video',
                                'image' => 'Gambar',
                            ])
                            ->default('video')
                            ->visible(fn (Get $get) => $get('../section_type') === 'hero')
                            ->inline(),
                        // Video settings
                        Select::make('video_source_type')
                            ->label('Sumber Video')
                            ->options([
                                'upload' => 'Upload File',
                                'url' => 'URL (MP4)'
                            ])
                            ->default('upload')
                            ->visible(fn (Get $get) => $get('../section_type') === 'hero' && ($get('background_mode') ?? 'video') === 'video'),
                        FileUpload::make('video_file_desktop')
                            ->label('Video Desktop (MP4)')
                            ->disk('public')
                            ->directory('home/hero')
                            ->acceptedFileTypes(['video/mp4'])
                            ->visible(fn (Get $get) => $get('../section_type') === 'hero' && ($get('background_mode') ?? 'video') === 'video' && ($get('video_source_type') ?? 'upload') === 'upload'),
                        FileUpload::make('video_file_mobile')
                            ->label('Video Mobile (MP4)')
                            ->disk('public')
                            ->directory('home/hero')
                            ->acceptedFileTypes(['video/mp4'])
                            ->visible(fn (Get $get) => $get('../section_type') === 'hero' && ($get('background_mode') ?? 'video') === 'video' && ($get('video_source_type') ?? 'upload') === 'upload'),
                        TextInput::make('video_url_desktop')
                            ->label('URL Video Desktop (MP4)')
                            ->visible(fn (Get $get) => $get('../section_type') === 'hero' && ($get('background_mode') ?? 'video') === 'video' && ($get('video_source_type') ?? 'upload') === 'url'),
                        TextInput::make('video_url_mobile')
                            ->label('URL Video Mobile (MP4)')
                            ->visible(fn (Get $get) => $get('../section_type') === 'hero' && ($get('background_mode') ?? 'video') === 'video' && ($get('video_source_type') ?? 'upload') === 'url'),
                        FileUpload::make('poster_image')
                            ->label('Poster Image (opsional)')
                            ->disk('public')
                            ->directory('home/hero/posters')
                            ->acceptedFileTypes(['image/*'])
                            ->visible(fn (Get $get) => $get('../section_type') === 'hero' && ($get('background_mode') ?? 'video') === 'video'),
                        // Image background
                        FileUpload::make('background_image')
                            ->label('Gambar Latar (Desktop/Mobile)')
                            ->disk('public')
                            ->directory('home/hero/images')
                            ->acceptedFileTypes(['image/*'])
                            ->visible(fn (Get $get) => $get('../section_type') === 'hero' && ($get('background_mode') ?? 'video') === 'image'),
                        TextInput::make('typing_text')
                            ->label('Typing Text (Welcome)')
                            ->visible(fn (Get $get) => $get('../section_type') === 'hero'),
                        TextInput::make('flip_text')
                            ->label('Flip Text (Nama Sekolah)')
                            ->visible(fn (Get $get) => $get('../section_type') === 'hero'),
                        Repeater::make('buttons')
                            ->label('Button Group')
                            ->schema([
                                TextInput::make('label')->label('Label')->required(),
                                TextInput::make('url')->label('URL')->required(),
                                Select::make('variant')->label('Gaya')
                                    ->options([
                                        'primary' => 'Primary (biru)',
                                        'secondary' => 'Secondary (outline putih)'
                                    ])->default('primary'),
                            ])
                            ->addActionLabel('Tambah Button')
                            ->reorderable()
                            ->default([])
                            ->visible(fn (Get $get) => $get('../section_type') === 'hero'),

                        // 2) SAMBUTAN KEPALA SEKOLAH
                        TextInput::make('principal_name')
                            ->label('Nama Kepala Sekolah')
                            ->visible(fn (Get $get) => $get('../section_type') === 'principal_welcome'),
                        TextInput::make('principal_position')
                            ->label('Jabatan')
                            ->visible(fn (Get $get) => $get('../section_type') === 'principal_welcome'),
                        FileUpload::make('principal_photo')
                            ->label('Foto Kepala Sekolah')
                            ->disk('public')
                            ->directory('home/principal')
                            ->acceptedFileTypes(['image/*'])
                            ->visible(fn (Get $get) => $get('../section_type') === 'principal_welcome'),
                        Textarea::make('greeting_arabic')->label('Salam (Arab)')->rows(2)
                            ->visible(fn (Get $get) => $get('../section_type') === 'principal_welcome'),
                        Textarea::make('greeting_message')->label('Paragraf 1')->rows(3)
                            ->visible(fn (Get $get) => $get('../section_type') === 'principal_welcome'),
                        Textarea::make('greeting_we_say')->label('Paragraf 2')->rows(3)
                            ->visible(fn (Get $get) => $get('../section_type') === 'principal_welcome'),
                        Textarea::make('greeting_welcome')->label('Paragraf 3 (Italic)')->rows(2)
                            ->visible(fn (Get $get) => $get('../section_type') === 'principal_welcome'),
                        Textarea::make('greeting_closing')->label('Penutup')->rows(2)
                            ->visible(fn (Get $get) => $get('section_type') === 'principal_welcome'),

                        // 3) WHY CHOOSE US
                        Repeater::make('features')
                            ->label('Daftar Keunggulan')
                            ->schema([
                                TextInput::make('number')->label('Nomor (contoh: [01])')->maxLength(10),
                                TextInput::make('title')->label('Judul')->required(),
                                FileUpload::make('image')->label('Gambar')->disk('public')->directory('home/why')->acceptedFileTypes(['image/*']),
                                Textarea::make('description')->label('Deskripsi')->rows(3),
                            ])
                            ->addActionLabel('Tambah Keunggulan')
                            ->reorderable()
                            ->default([])
                            ->visible(fn (Get $get) => $get('../section_type') === 'why_choose_us'),

                        // 4) FASILITAS (Carousel / Bento)
                        Select::make('display_mode')
                            ->label('Mode Tampilan Fasilitas')
                            ->options([
                                'carousel' => 'Carousel (Swiper)',
                                'bento' => 'Bento Grid',
                            ])->default('carousel')
                            ->visible(fn (Get $get) => $get('../section_type') === 'facilities')
                            ->live(),

                        // Items untuk Carousel (gambar saja)
                        Repeater::make('carousel_items')
                            ->label('Item Fasilitas (Carousel)')
                            ->schema([
                                TextInput::make('name')->label('Nama')->required(),
                                Textarea::make('description')->label('Deskripsi')->rows(2),
                                FileUpload::make('image')
                                    ->label('Gambar')
                                    ->disk('public')
                                    ->directory('home/facilities')
                                    ->acceptedFileTypes(['image/*'])
                                    ->required(),
                                TextInput::make('cta')->label('CTA Label')->maxLength(100),
                                TextInput::make('cta_url')->label('CTA URL')->maxLength(255),
                            ])
                            ->addActionLabel('Tambah Item')
                            ->reorderable()
                            ->default([])
                            ->visible(fn (Get $get) => $get('../section_type') === 'facilities' && ($get('../display_mode') ?? 'carousel') === 'carousel'),

                        // Items untuk Bento (kompatibilitas lama)
                        Repeater::make('bento_items')
                            ->label('Item Fasilitas (Bento)')
                            ->schema([
                                TextInput::make('name')->label('Nama')->required(),
                                Textarea::make('description')->label('Deskripsi')->rows(2),
                                Radio::make('media_type')->label('Media')->options([
                                    'video' => 'Video',
                                    'image' => 'Gambar',
                                ])->default('video')->inline(),
                                Select::make('video_source')->label('Sumber Video')->options([
                                    'upload' => 'Upload',
                                    'url' => 'URL (MP4)'
                                ])->default('upload')
                                  ->visible(fn (Get $get) => ($get('../../section_type') === 'facilities') && (($get('media_type') ?? 'video') === 'video')),
                                FileUpload::make('video_file')
                                    ->label('File Video (MP4)')
                                    ->disk('public')
                                    ->directory('home/facilities')
                                    ->acceptedFileTypes(['video/mp4'])
                                    ->visible(fn (Get $get) => ($get('../../section_type') === 'facilities') && (($get('media_type') ?? 'video') === 'video') && (($get('video_source') ?? 'upload') === 'upload')),
                                TextInput::make('video_url')->label('URL Video (MP4)')
                                    ->visible(fn (Get $get) => ($get('../../section_type') === 'facilities') && (($get('media_type') ?? 'video') === 'video') && (($get('video_source') ?? 'upload') === 'url')),
                                FileUpload::make('image')
                                    ->label('Gambar')
                                    ->disk('public')
                                    ->directory('home/facilities')
                                    ->acceptedFileTypes(['image/*'])
                                    ->visible(fn (Get $get) => ($get('../../section_type') === 'facilities') && (($get('media_type') ?? 'video') === 'image')),
                                TextInput::make('className')->label('ClassName (opsional, mis. lg:col-span-2)')->maxLength(100),
                                TextInput::make('cta')->label('CTA Label')->maxLength(100),
                            ])
                            ->addActionLabel('Tambah Item')
                            ->reorderable()
                            ->default([])
                            ->visible(fn (Get $get) => $get('../section_type') === 'facilities' && ($get('../display_mode') ?? 'carousel') === 'bento'),

                        // 5) ALKAPRO ECOSYSTEM
                        Repeater::make('apps')
                            ->label('Daftar Aplikasi Ekosistem')
                            ->schema([
                                TextInput::make('name')->label('Nama')->required(),
                                Textarea::make('description')->label('Deskripsi')->rows(2),
                                TextInput::make('icon')->label('Icon URL (atau upload di bawah)'),
                                FileUpload::make('icon_upload')->label('Upload Icon (opsional)')->disk('public')->directory('home/alkapro')->acceptedFileTypes(['image/*']),
                                TextInput::make('url')->label('URL')->required(),
                                Select::make('card_theme')
                                    ->label('Tema Kartu (mudah)')
                                    ->options([
                                        'slate' => 'Gelap Slate (default)',
                                        'blue' => 'Biru/Indigo',
                                        'emerald' => 'Emerald/Teal',
                                        'amber' => 'Amber/Orange',
                                        'purple' => 'Ungu/Violet',
                                        'cyan' => 'Cyan/Blue',
                                        'indigo' => 'Indigo/Purple',
                                        'teal' => 'Teal/Cyan',
                                    ])
                                    ->default('slate')
                                    ->helperText('Pilih tema saja. Opsi lanjutan di bawah biasanya tidak perlu diubah.')
                                    ->live()
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        $map = [
                                            'slate' => [
                                                'gradient' => 'bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900',
                                                'accent' => 'from-emerald-400 to-teal-500',
                                            ],
                                            'blue' => [
                                                'gradient' => 'bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-900',
                                                'accent' => 'from-blue-400 to-indigo-500',
                                            ],
                                            'emerald' => [
                                                'gradient' => 'bg-gradient-to-br from-emerald-900 via-emerald-800 to-green-900',
                                                'accent' => 'from-emerald-400 to-green-500',
                                            ],
                                            'amber' => [
                                                'gradient' => 'bg-gradient-to-br from-amber-900 via-amber-800 to-orange-900',
                                                'accent' => 'from-amber-400 to-orange-500',
                                            ],
                                            'purple' => [
                                                'gradient' => 'bg-gradient-to-br from-purple-900 via-purple-800 to-violet-900',
                                                'accent' => 'from-purple-400 to-violet-500',
                                            ],
                                            'cyan' => [
                                                'gradient' => 'bg-gradient-to-br from-cyan-900 via-cyan-800 to-blue-900',
                                                'accent' => 'from-cyan-400 to-blue-500',
                                            ],
                                            'indigo' => [
                                                'gradient' => 'bg-gradient-to-br from-indigo-900 via-indigo-800 to-purple-900',
                                                'accent' => 'from-indigo-400 to-purple-500',
                                            ],
                                            'teal' => [
                                                'gradient' => 'bg-gradient-to-br from-teal-900 via-teal-800 to-cyan-900',
                                                'accent' => 'from-teal-400 to-cyan-500',
                                            ],
                                        ];
                                        $preset = $map[$state] ?? $map['slate'];
                                        $set('gradient', $preset['gradient']);
                                        $set('accent', $preset['accent']);
                                    }),
                                Toggle::make('advanced_style')
                                    ->label('Atur style lanjutan (opsional)')
                                    ->default(false)
                                    ->live(),
                                TextInput::make('gradient')
                                    ->label('Kelas Gradient Kartu (lanjutan)')
                                    ->default('bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900')
                                    ->visible(fn (Get $get) => (bool) $get('advanced_style'))
                                    ->helperText('Khusus pengelola teknis. Umumnya cukup pilih Tema Kartu.'),
                                TextInput::make('accent')
                                    ->label('Accent Gradient (lanjutan)')
                                    ->default('from-emerald-400 to-teal-500')
                                    ->visible(fn (Get $get) => (bool) $get('advanced_style'))
                                    ->helperText('Khusus pengelola teknis. Umumnya cukup pilih Tema Kartu.'),
                            ])
                            ->addActionLabel('Tambah Aplikasi')
                            ->reorderable()
                            ->default([])
                            ->visible(fn (Get $get) => $get('../section_type') === 'alkapro_ecosystem'),

                        // 6) PRESTASI (kutipan Islami saja)
                        Textarea::make('islamic_quote_arabic')->label('Kutipan Arab')->rows(2)
                            ->visible(fn (Get $get) => $get('../section_type') === 'achievements_modern'),
                        Textarea::make('islamic_quote_translation')->label('Terjemahan/Deskripsi')->rows(3)
                            ->visible(fn (Get $get) => $get('../section_type') === 'achievements_modern'),

                        // 7) TESTIMONI
                        Repeater::make('testimonials')
                            ->label('Testimoni')
                            ->schema([
                                TextInput::make('nama')->label('Nama')->required(),
                                TextInput::make('tahun')->label('Keterangan (contoh: Orang Tua Siswa Kelas 8)'),
                                Textarea::make('testimoni')->label('Testimoni')->rows(3)->required(),
                                TextInput::make('avatar')->label('Avatar (emoji atau teks, mis. 👨‍💼)')->maxLength(10),
                            ])
                            ->addActionLabel('Tambah Testimoni')
                            ->reorderable()
                            ->default([])
                            ->visible(fn (Get $get) => $get('../section_type') === 'testimonials'),

                        // 8) SOCIAL MEDIA FEED (Instagram/TikTok)
                        TextInput::make('instagram_user_id')->label('Instagram User ID')
                            ->visible(fn (Get $get) => $get('../section_type') === 'social_media_feed'),
                        TextInput::make('instagram_access_token')->label('Instagram Access Token')->password()
                            ->revealable()
                            ->visible(fn (Get $get) => $get('../section_type') === 'social_media_feed'),
                        TextInput::make('tiktok_user_id')->label('TikTok User ID')
                            ->visible(fn (Get $get) => $get('../section_type') === 'social_media_feed'),
                        TextInput::make('tiktok_access_token')->label('TikTok Access Token')->password()
                            ->revealable()
                            ->visible(fn (Get $get) => $get('../section_type') === 'social_media_feed'),
                        TextInput::make('instagram_follow_url')->label('Instagram Follow URL')
                            ->placeholder('https://instagram.com/your_instagram_username')
                            ->visible(fn (Get $get) => $get('../section_type') === 'social_media_feed'),
                        TextInput::make('tiktok_follow_url')->label('TikTok Follow URL')
                            ->placeholder('https://tiktok.com/@your_tiktok_username')
                            ->visible(fn (Get $get) => $get('../section_type') === 'social_media_feed'),

                        // 9) YOUTUBE
                        TextInput::make('channel_id')->label('YouTube Channel ID')
                            ->placeholder('Mis: UC4pZd4s01MOQrTDvxNc1QlA')
                            ->visible(fn (Get $get) => $get('../section_type') === 'youtube'),
                        TextInput::make('playlist_id')->label('Playlist ID (opsional)')
                            ->visible(fn (Get $get) => $get('../section_type') === 'youtube'),
                    ])
                    ->collapsible()
                    ->collapsed(false),

                // Pengaturan Layout Spesifik per Section (disimpan di config_data.layout)
                Section::make('Pengaturan Layout (Spesifik Section)')
                    ->statePath('config_data.layout')
                    ->schema([
                        // HERO
                        TextInput::make('min_height')
                            ->label('Min Height (contoh: min-h-[80vh])')
                            ->default('min-h-[80vh]')
                            ->visible(fn (Get $get) => $get('section_type') === 'hero'),
                        Toggle::make('overlay')
                            ->label('Tampilkan Overlay Gelap')
                            ->default(true)
                            ->visible(fn (Get $get) => $get('section_type') === 'hero'),
                        ColorPicker::make('overlay_from')
                            ->label('Overlay From')
                            ->default('#000000')
                            ->visible(fn (Get $get) => $get('section_type') === 'hero'),
                        ColorPicker::make('overlay_to')
                            ->label('Overlay To')
                            ->default('#000000')
                            ->visible(fn (Get $get) => $get('section_type') === 'hero'),

                        // SAMBUTAN KEPALA SEKOLAH
                        TextInput::make('container_max_width')
                            ->label('Max Width Container (mis. max-w-7xl)')
                            ->default('max-w-7xl')
                            ->visible(fn (Get $get) => $get('section_type') === 'principal_welcome'),
                        Select::make('photo_shape')
                            ->label('Bentuk Foto')
                            ->options([
                                'rounded-2xl' => 'Rounded 2XL',
                                'rounded-full' => 'Circle',
                            ])->default('rounded-2xl')
                            ->visible(fn (Get $get) => $get('section_type') === 'principal_welcome'),
                        TextInput::make('grid_gap')
                            ->label('Grid Gap (mis. gap-12)')
                            ->default('gap-12')
                            ->visible(fn (Get $get) => $get('section_type') === 'principal_welcome'),

                        // WHY CHOOSE US
                        Toggle::make('pin_on_scroll')
                            ->label('Pin saat Scroll (Horizontal Scroll)')
                            ->default(true)
                            ->visible(fn (Get $get) => $get('section_type') === 'why_choose_us'),
                        TextInput::make('card_width')
                            ->label('Lebar Kartu (mis. w-80)')
                            ->default('w-80')
                            ->visible(fn (Get $get) => $get('section_type') === 'why_choose_us'),

                        // FASILITAS (Bento)
                        Select::make('grid_cols_lg')
                            ->label('Grid Cols LG')
                            ->options([
                                '3' => '3 Kolom',
                                '4' => '4 Kolom',
                            ])->default('3')
                            ->visible(fn (Get $get) => $get('section_type') === 'facilities'),
                        TextInput::make('grid_gap_facilities')
                            ->label('Grid Gap (mis. gap-6)')
                            ->default('gap-6')
                            ->visible(fn (Get $get) => $get('section_type') === 'facilities'),
                        Toggle::make('use_grid_pattern')
                            ->label('Tampilkan Background Grid Pattern')
                            ->default(true)
                            ->visible(fn (Get $get) => $get('section_type') === 'facilities'),

                        // ALKAPRO ECOSYSTEM
                        Select::make('apps_cols_lg')
                            ->label('Kolom Grid (LG)')
                            ->options([
                                '2' => '2',
                                '4' => '4',
                            ])->default('4')
                            ->visible(fn (Get $get) => $get('section_type') === 'alkapro_ecosystem'),
                        Toggle::make('hover_raise')
                            ->label('Naik saat hover')
                            ->default(true)
                            ->visible(fn (Get $get) => $get('section_type') === 'alkapro_ecosystem'),

                        // PRESTASI (Modern)
                        Select::make('gradient_preset')
                            ->label('Preset Gradient')
                            ->options([
                                'blue_purple_pink' => 'Blue → Purple → Pink',
                                'green_teal_cyan' => 'Green → Teal → Cyan',
                                'orange_red_pink' => 'Orange → Red → Pink',
                            ])->default('blue_purple_pink')
                            ->visible(fn (Get $get) => $get('section_type') === 'achievements_modern'),
                        TextInput::make('gradient_switch_interval_ms')
                            ->label('Interval Ganti Gradient (ms)')
                            ->default('4000')
                            ->visible(fn (Get $get) => $get('section_type') === 'achievements_modern'),
                        Toggle::make('show_particles')
                            ->label('Tampilkan Partikel Animasi')
                            ->default(true)
                            ->visible(fn (Get $get) => $get('section_type') === 'achievements_modern'),

                        // TESTIMONIALS
                        TextInput::make('marquee_speed')
                            ->label('Kecepatan Marquee (1-10)')
                            ->default('5')
                            ->visible(fn (Get $get) => $get('section_type') === 'testimonials'),
                        Select::make('card_background')
                            ->label('Latar Kartu')
                            ->options([
                                'glass' => 'Glass (transparan)',
                                'white' => 'Putih',
                            ])->default('glass')
                            ->visible(fn (Get $get) => $get('section_type') === 'testimonials'),

                        // SOCIAL MEDIA FEED
                        Toggle::make('show_orbs')
                            ->label('Tampilkan Orbs Gradient')
                            ->default(true)
                            ->visible(fn (Get $get) => $get('section_type') === 'social_media_feed'),
                        TextInput::make('items_per_row_lg')
                            ->label('Jumlah Kartu per Baris (LG)')
                            ->default('4')
                            ->visible(fn (Get $get) => $get('section_type') === 'social_media_feed'),
                        TextInput::make('instagram_limit')
                            ->label('Limit Post Instagram')
                            ->default('8')
                            ->visible(fn (Get $get) => $get('section_type') === 'social_media_feed'),

                        // YOUTUBE
                        Select::make('player_aspect')
                            ->label('Rasio Player')
                            ->options([
                                'aspect-video' => '16:9 (default)',
                                'aspect-[4/3]' => '4:3',
                            ])->default('aspect-video')
                            ->visible(fn (Get $get) => $get('section_type') === 'youtube'),
                        TextInput::make('list_max_height_px')
                            ->label('Max Height List Video (px)')
                            ->default('600')
                            ->visible(fn (Get $get) => $get('section_type') === 'youtube'),
                        Toggle::make('auto_rotate_featured')
                            ->label('Auto-rotate Featured Video')
                            ->default(true)
                            ->visible(fn (Get $get) => $get('section_type') === 'youtube'),
                    ])
                    ->collapsible()
                    ->collapsed(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_index')
                    ->label('Urutan')
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->limit(50),
                TextColumn::make('section_type')
                    ->label('Tipe Section')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'hero' => 'danger',
                        'principal_welcome' => 'success',
                        'why_choose_us' => 'primary',
                        'facilities' => 'primary',
                        'alkapro_ecosystem' => 'warning',

                        'achievements_modern' => 'success',
                        'activities_section' => 'secondary',
                        'testimonials' => 'info',
                        'youtube' => 'danger',
                        'news' => 'warning',
                        'about' => 'info',
                        'cta' => 'danger',
                        'partners' => 'warning',
                        'footer' => 'gray',
                        default => 'gray',
                    }),
                ImageColumn::make('image')
                    ->label('Gambar')
                    ->circular(),
                ToggleColumn::make('is_active')
                    ->label('Status'),
            ])
            ->filters([
                SelectFilter::make('section_type')
                    ->label('Tipe Section')
                    ->options([
                        'hero' => 'Hero/Banner',
                        'principal_welcome' => 'Sambutan Kepala Sekolah',
                        'why_choose_us' => 'Why Choose Us',
                        'facilities' => 'Fasilitas',
                        'alkapro_ecosystem' => 'Alkapro Smart School Ecosystem',

                        'achievements_modern' => 'Prestasi Siswa (Modern)',
                        'activities_section' => 'Kegiatan Sekolah',
                        'testimonials' => 'Testimoni',
                        'youtube' => 'YouTube',
                        'social_media_feed' => 'Social Media Feed',
                        'news' => 'Berita Terbaru',
                        'about' => 'Tentang Kami',
                        'cta' => 'Call to Action',
                        'partners' => 'Mitra',
                        'footer' => 'Footer',
                        'custom' => 'Custom',
                    ]),
                SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([
                        1 => 'Aktif',
                        0 => 'Tidak Aktif',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order_index');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHomeSections::route('/'),
            'create' => Pages\CreateHomeSection::route('/create'),
            'edit' => Pages\EditHomeSection::route('/{record}/edit'),
        ];
    }
}
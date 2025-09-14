<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AlkaproLibrarySettingsResource\Pages;
use App\Models\AlkaproLibrarySettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AlkaproLibrarySettingsResource extends Resource
{
    protected static ?string $model = AlkaproLibrarySettings::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Perpustakaan';

    protected static ?string $navigationLabel = 'Pengaturan Alkapro Library';

    protected static ?string $modelLabel = 'Pengaturan Alkapro Library';

    protected static ?string $pluralModelLabel = 'Pengaturan Alkapro Library';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Settings')
                    ->tabs([
                        // Tab 1: Basic Settings
                        Forms\Components\Tabs\Tab::make('Pengaturan Dasar')
                            ->icon('heroicon-o-cog-6-tooth')
                            ->schema([
                                Forms\Components\Section::make('Informasi Halaman')
                                    ->schema([
                                        Forms\Components\TextInput::make('title')
                                            ->label('Judul Halaman')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('Alkapro Library')
                                            ->placeholder('Masukkan judul halaman'),

                                        Forms\Components\TextInput::make('subtitle')
                                            ->label('Subtitle')
                                            ->maxLength(500)
                                            ->default('Perpustakaan Modern SMP Muhammadiyah Al Kautsar PK Kartasura')
                                            ->placeholder('Masukkan subtitle halaman'),

                                        Forms\Components\FileUpload::make('banner_desktop')
                                            ->label('Banner Desktop')
                                            ->image()
                                            ->imageEditor()
                                            ->imageCropAspectRatio('16:9')
                                            ->disk('public')
                                            ->directory('alkapro-library')
                                            ->helperText('Rasio 16:9, ukuran disarankan 1920x1080px'),

                                        Forms\Components\FileUpload::make('banner_mobile')
                                            ->label('Banner Mobile')
                                            ->image()
                                            ->imageEditor()
                                            ->imageCropAspectRatio('16:9')
                                            ->disk('public')
                                            ->directory('alkapro-library')
                                            ->helperText('Rasio 16:9, ukuran disarankan 1920x1080px'),
                                    ]),

                                Forms\Components\Section::make('Hero Section')
                                    ->schema([
                                        Forms\Components\TextInput::make('hero_title')
                                            ->label('Judul Hero')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('Alkapro Library'),

                                        Forms\Components\TextInput::make('hero_subtitle')
                                            ->label('Subtitle Hero')
                                            ->maxLength(500)
                                            ->default('Perpustakaan Modern SMP Muhammadiyah Al Kautsar PK Kartasura'),

                                        Forms\Components\FileUpload::make('hero_image')
                                            ->label('Gambar Hero')
                                            ->image()
                                            ->imageEditor()
                                            ->disk('public')
                                            ->directory('alkapro-library/hero')
                                            ->helperText('Gambar utama untuk section hero'),
                                    ]),

                                Forms\Components\Section::make('Status')
                                    ->schema([
                                        Forms\Components\Toggle::make('is_active')
                                            ->label('Aktif')
                                            ->default(true)
                                            ->helperText('Aktifkan untuk menampilkan pengaturan ini'),
                                    ]),
                            ]),

                        // Tab 2: Content Settings
                        Forms\Components\Tabs\Tab::make('Konten')
                            ->icon('heroicon-o-document-text')
                            ->schema([
                                Forms\Components\Section::make('Introduction Section')
                                    ->schema([
                                        Forms\Components\TextInput::make('intro_badge_text')
                                            ->label('Badge Text')
                                            ->maxLength(100)
                                            ->default('Perpustakaan Sekolah'),

                                        Forms\Components\TextInput::make('intro_title')
                                            ->label('Judul Introduction')
                                            ->required()
                                            ->maxLength(255)
                                            ->default('Selamat Datang di Alkapro Library'),

                                        Forms\Components\Textarea::make('intro_description')
                                            ->label('Deskripsi Introduction')
                                            ->rows(4)
                                            ->maxLength(1000)
                                            ->placeholder('Masukkan deskripsi tentang perpustakaan'),

                                        Forms\Components\FileUpload::make('intro_featured_image')
                                            ->label('Gambar Featured')
                                            ->image()
                                            ->imageEditor()
                                            ->disk('public')
                                            ->directory('alkapro-library/intro')
                                            ->helperText('Gambar untuk section introduction'),
                                    ]),

                                Forms\Components\Section::make('Features Section')
                                    ->schema([
                                        Forms\Components\TextInput::make('features_title')
                                            ->label('Judul Features')
                                            ->maxLength(255)
                                            ->default('Koleksi Lengkap & Fasilitas Modern'),

                                        Forms\Components\Repeater::make('collection_features')
                                            ->label('Fitur Koleksi')
                                            ->simple(
                                                Forms\Components\TextInput::make('feature')
                                                    ->label('Fitur')
                                                    ->required()
                                                    ->maxLength(255)
                                            )
                                            ->defaultItems(4)
                                            ->default(AlkaproLibrarySettings::getDefaultCollectionFeatures())
                                            ->helperText('Daftar fitur koleksi perpustakaan'),

                                        Forms\Components\Repeater::make('facility_features')
                                            ->label('Fitur Fasilitas')
                                            ->simple(
                                                Forms\Components\TextInput::make('feature')
                                                    ->label('Fitur')
                                                    ->required()
                                                    ->maxLength(255)
                                            )
                                            ->defaultItems(4)
                                            ->default(AlkaproLibrarySettings::getDefaultFacilityFeatures())
                                            ->helperText('Daftar fitur fasilitas perpustakaan'),
                                    ]),
                            ]),

                        // Tab 3: Gallery & Media
                        Forms\Components\Tabs\Tab::make('Galeri & Media')
                            ->icon('heroicon-o-photo')
                            ->schema([
                                Forms\Components\Section::make('Library Gallery')
                                    ->schema([
                                        Forms\Components\FileUpload::make('library_gallery')
                                            ->label('Galeri Perpustakaan')
                                            ->image()
                                            ->multiple()
                                            ->reorderable()
                                            ->disk('public')
                                            ->directory('alkapro-library/gallery')
                                            ->helperText('Upload multiple gambar untuk galeri perpustakaan'),

                                        Forms\Components\Toggle::make('gallery_auto_slide')
                                            ->label('Auto Slide Gallery')
                                            ->default(true)
                                            ->helperText('Aktifkan untuk auto slide galeri'),

                                        Forms\Components\TextInput::make('gallery_slide_interval')
                                            ->label('Interval Slide Gallery (ms)')
                                            ->numeric()
                                            ->default(4000)
                                            ->suffix('ms')
                                            ->helperText('Interval waktu auto slide dalam milidetik'),

                                        Forms\Components\Toggle::make('show_gallery')
                                            ->label('Tampilkan Gallery')
                                            ->default(true),
                                    ]),

                                Forms\Components\Section::make('Library Pamphlets')
                                    ->schema([
                                        Forms\Components\FileUpload::make('library_pamphlets')
                                            ->label('Pamflet Perpustakaan')
                                            ->image()
                                            ->multiple()
                                            ->reorderable()
                                            ->disk('public')
                                            ->directory('alkapro-library/pamphlets')
                                            ->helperText('Upload multiple pamflet perpustakaan'),

                                        Forms\Components\Toggle::make('pamphlet_auto_slide')
                                            ->label('Auto Slide Pamphlet')
                                            ->default(true)
                                            ->helperText('Aktifkan untuk auto slide pamflet'),

                                        Forms\Components\TextInput::make('pamphlet_slide_interval')
                                            ->label('Interval Slide Pamphlet (ms)')
                                            ->numeric()
                                            ->default(5000)
                                            ->suffix('ms')
                                            ->helperText('Interval waktu auto slide dalam milidetik'),

                                        Forms\Components\Toggle::make('show_pamphlets')
                                            ->label('Tampilkan Pamphlets')
                                            ->default(true),
                                    ]),
                            ]),

                        // Tab 4: Programs & Services
                        Forms\Components\Tabs\Tab::make('Program & Layanan')
                            ->icon('heroicon-o-academic-cap')
                            ->schema([
                                Forms\Components\Section::make('Programs Section')
                                    ->schema([
                                        Forms\Components\TextInput::make('programs_title')
                                            ->label('Judul Program')
                                            ->maxLength(255)
                                            ->default('Program Unggulan Perpustakaan'),

                                        Forms\Components\Textarea::make('programs_description')
                                            ->label('Deskripsi Program')
                                            ->rows(3)
                                            ->maxLength(500),

                                        Forms\Components\Toggle::make('show_programs')
                                            ->label('Tampilkan Programs')
                                            ->default(true),
                                    ]),

                                Forms\Components\Section::make('Reading Club')
                                    ->schema([
                                        Forms\Components\TextInput::make('reading_club_title')
                                            ->label('Judul Reading Club')
                                            ->maxLength(255)
                                            ->default('Reading Club Alkapro'),

                                        Forms\Components\Textarea::make('reading_club_description')
                                            ->label('Deskripsi Reading Club')
                                            ->rows(3)
                                            ->maxLength(500),

                                        Forms\Components\FileUpload::make('reading_club_image')
                                            ->label('Gambar Reading Club')
                                            ->image()
                                            ->imageEditor()
                                            ->disk('public')
                                            ->directory('alkapro-library/programs'),
                                    ]),

                                Forms\Components\Section::make('Digital Library')
                                    ->schema([
                                        Forms\Components\TextInput::make('digital_library_title')
                                            ->label('Judul Digital Library')
                                            ->maxLength(255)
                                            ->default('Perpustakaan Digital'),

                                        Forms\Components\Textarea::make('digital_library_description')
                                            ->label('Deskripsi Digital Library')
                                            ->rows(3)
                                            ->maxLength(500),

                                        Forms\Components\FileUpload::make('digital_library_image')
                                            ->label('Gambar Digital Library')
                                            ->image()
                                            ->imageEditor()
                                            ->disk('public')
                                            ->directory('alkapro-library/programs'),
                                    ]),

                                Forms\Components\Section::make('Additional Services')
                                    ->schema([
                                        Forms\Components\TextInput::make('services_title')
                                            ->label('Judul Layanan')
                                            ->maxLength(255)
                                            ->default('Layanan Tambahan'),

                                        Forms\Components\Textarea::make('services_description')
                                            ->label('Deskripsi Layanan')
                                            ->rows(3)
                                            ->maxLength(500),

                                        Forms\Components\Repeater::make('additional_services')
                                            ->label('Layanan Tambahan')
                                            ->schema([
                                                Forms\Components\TextInput::make('title')
                                                    ->label('Judul Layanan')
                                                    ->required()
                                                    ->maxLength(255),

                                                Forms\Components\Textarea::make('description')
                                                    ->label('Deskripsi')
                                                    ->required()
                                                    ->rows(2)
                                                    ->maxLength(500),

                                                Forms\Components\Select::make('icon')
                                                    ->label('Icon')
                                                    ->options([
                                                        'search' => 'Search',
                                                        'monitor' => 'Monitor',
                                                        'users' => 'Users',
                                                        'file-text' => 'File Text',
                                                        'book-open' => 'Book Open',
                                                        'wifi' => 'Wifi',
                                                        'coffee' => 'Coffee',
                                                        'clock' => 'Clock',
                                                    ])
                                                    ->default('search')
                                                    ->required(),
                                            ])
                                            ->defaultItems(4)
                                            ->default(AlkaproLibrarySettings::getDefaultAdditionalServices())
                                            ->collapsible()
                                            ->helperText('Daftar layanan tambahan perpustakaan'),

                                        Forms\Components\Toggle::make('show_additional_services')
                                            ->label('Tampilkan Additional Services')
                                            ->default(true),
                                    ]),
                            ]),

                        // Tab 5: Service Hours & Contact
                        Forms\Components\Tabs\Tab::make('Jam Layanan & Kontak')
                            ->icon('heroicon-o-clock')
                            ->schema([
                                Forms\Components\Section::make('Service Hours')
                                    ->schema([
                                        Forms\Components\TextInput::make('service_hours_title')
                                            ->label('Judul Jam Layanan')
                                            ->maxLength(255)
                                            ->default('Jam Layanan Perpustakaan Sekolah'),

                                        Forms\Components\TextInput::make('weekday_hours')
                                            ->label('Jam Hari Kerja')
                                            ->maxLength(100)
                                            ->default('07.30 - 14.30 WIB')
                                            ->placeholder('Senin - Kamis'),

                                        Forms\Components\TextInput::make('weekend_hours')
                                            ->label('Jam Akhir Pekan')
                                            ->maxLength(100)
                                            ->default('07.30 - 11.00 WIB')
                                            ->placeholder('Jumat & Sabtu'),

                                        Forms\Components\Textarea::make('service_hours_note')
                                            ->label('Catatan Jam Layanan')
                                            ->rows(2)
                                            ->maxLength(255)
                                            ->placeholder('Catatan tambahan tentang jam layanan'),

                                        Forms\Components\Toggle::make('show_service_hours')
                                            ->label('Tampilkan Service Hours')
                                            ->default(true),
                                    ]),

                                Forms\Components\Section::make('Social Media')
                                    ->schema([
                                        Forms\Components\TextInput::make('instagram_username')
                                            ->label('Instagram Username')
                                            ->maxLength(100)
                                            ->placeholder('@alkapro.library')
                                            ->prefix('@'),

                                        Forms\Components\TextInput::make('instagram_url')
                                            ->label('Instagram URL')
                                            ->url()
                                            ->maxLength(255)
                                            ->placeholder('https://instagram.com/alkapro.library'),

                                        Forms\Components\TextInput::make('facebook_url')
                                            ->label('Facebook URL')
                                            ->url()
                                            ->maxLength(255)
                                            ->placeholder('https://facebook.com/alkapro.library'),

                                        Forms\Components\TextInput::make('twitter_url')
                                            ->label('Twitter URL')
                                            ->url()
                                            ->maxLength(255)
                                            ->placeholder('https://twitter.com/alkapro_library'),

                                        Forms\Components\TextInput::make('youtube_url')
                                            ->label('YouTube URL')
                                            ->url()
                                            ->maxLength(255)
                                            ->placeholder('https://youtube.com/@alkapro-library'),

                                        Forms\Components\Toggle::make('show_social_media')
                                            ->label('Tampilkan Social Media')
                                            ->default(true),
                                    ]),
                            ]),

                        // Tab 6: Call to Action & SEO
                        Forms\Components\Tabs\Tab::make('CTA & SEO')
                            ->icon('heroicon-o-megaphone')
                            ->schema([
                                Forms\Components\Section::make('Call to Action')
                                    ->schema([
                                        Forms\Components\TextInput::make('cta_title')
                                            ->label('Judul CTA')
                                            ->maxLength(255)
                                            ->default('Siap Menjelajahi Dunia Pengetahuan di Alkapro Library?'),

                                        Forms\Components\Textarea::make('cta_description')
                                            ->label('Deskripsi CTA')
                                            ->rows(3)
                                            ->maxLength(500),

                                        Forms\Components\FileUpload::make('cta_background_image')
                                            ->label('Background CTA')
                                            ->image()
                                            ->imageEditor()
                                            ->disk('public')
                                            ->directory('alkapro-library/cta')
                                            ->helperText('Gambar background untuk section CTA'),

                                        Forms\Components\TextInput::make('cta_primary_button_text')
                                            ->label('Text Button Utama')
                                            ->maxLength(100)
                                            ->default('Tentang Sekolah'),

                                        Forms\Components\TextInput::make('cta_primary_button_url')
                                            ->label('URL Button Utama')
                                            ->maxLength(255)
                                            ->default('/profil'),

                                        Forms\Components\TextInput::make('cta_secondary_button_text')
                                            ->label('Text Button Kedua')
                                            ->maxLength(100)
                                            ->default('Lihat Fasilitas Lain'),

                                        Forms\Components\TextInput::make('cta_secondary_button_url')
                                            ->label('URL Button Kedua')
                                            ->maxLength(255)
                                            ->default('/fasilitas'),

                                        Forms\Components\Toggle::make('show_cta_section')
                                            ->label('Tampilkan CTA Section')
                                            ->default(true),
                                    ]),

                                Forms\Components\Section::make('SEO Settings')
                                    ->schema([
                                        Forms\Components\TextInput::make('meta_title')
                                            ->label('Meta Title')
                                            ->maxLength(60)
                                            ->helperText('Judul untuk SEO (maksimal 60 karakter)'),

                                        Forms\Components\Textarea::make('meta_description')
                                            ->label('Meta Description')
                                            ->rows(3)
                                            ->maxLength(160)
                                            ->helperText('Deskripsi untuk SEO (maksimal 160 karakter)'),

                                        Forms\Components\TextInput::make('meta_keywords')
                                            ->label('Meta Keywords')
                                            ->maxLength(255)
                                            ->helperText('Keywords dipisahkan dengan koma'),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('subtitle')
                    ->label('Subtitle')
                    ->limit(50)
                    ->searchable(),

                Tables\Columns\IconColumn::make('show_gallery')
                    ->label('Gallery')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\IconColumn::make('show_programs')
                    ->label('Programs')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListAlkaproLibrarySettings::route('/'),
            'create' => Pages\CreateAlkaproLibrarySettings::route('/create'),
            'edit' => Pages\EditAlkaproLibrarySettings::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InfoPPDBSettingsResource\Pages;
use App\Models\InfoPPDBSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InfoPPDBSettingsResource extends Resource
{
    protected static ?string $model = InfoPPDBSettings::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Info PPDB Settings';
    protected static ?string $navigationGroup = 'PPDB Management';
    protected static ?string $modelLabel = 'Info PPDB Settings';
    protected static ?string $pluralModelLabel = 'Info PPDB Settings';

    public static function canCreate(): bool
    {
        return InfoPPDBSettings::query()->count() === 0;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Banner Settings')
                    ->description('Pengaturan banner utama untuk halaman Info PPDB')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Banner')
                            ->default('Info PPDB')
                            ->required(),
                        Forms\Components\Textarea::make('subtitle')
                            ->label('Subtitle Banner')
                            ->default('Alur Pendaftaran SMP Muhammadiyah Al Kautsar PK Kartasura')
                            ->required(),
                        Forms\Components\FileUpload::make('banner_desktop')
                            ->label('Banner Desktop')
                            ->image()
                            ->imageEditor()
                            ->directory('ppdb/banners')
                            ->visibility('public')
                            ->maxSize(10240) // 10MB - SAMA DENGAN PROGRAM KHUSUS TYPE
                            ->required(),
                        Forms\Components\FileUpload::make('banner_mobile')
                            ->label('Banner Mobile')
                            ->image()
                            ->imageEditor()
                            ->directory('ppdb/banners')
                            ->visibility('public')
                            ->maxSize(10240) // 10MB - SAMA DENGAN PROGRAM KHUSUS TYPE
                            ->required(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Introduction Section')
                    ->description('Bagian pengenalan dan deskripsi utama')
                    ->schema([
                        Forms\Components\TextInput::make('intro_badge')
                            ->label('Badge Introduction')
                            ->default('Penerimaan Peserta Didik Baru'),
                        Forms\Components\TextInput::make('intro_title')
                            ->label('Judul Introduction')
                            ->default('Mari Daftarkan Putra Putri Anda Sekolah ke SMP Muhammadiyah Al Kautsar PK Kartasura'),
                        Forms\Components\Textarea::make('intro_subtitle')
                            ->label('Subtitle Introduction')
                            ->default('Informasi lengkap mengenai alur pendaftaran dan persyaratan untuk menjadi bagian dari keluarga besar SMP Muhammadiyah Al Kautsar PK Kartasura dengan berbagai program unggulan yang tersedia.'),
                        Forms\Components\FileUpload::make('featured_image')
                            ->label('Featured Image')
                            ->image()
                            ->imageEditor()
                            ->directory('ppdb/featured')
                            ->visibility('public')
                            ->maxSize(10240) // 10MB - SAMA DENGAN PROGRAM KHUSUS TYPE
                            ->required(),
                        Forms\Components\TextInput::make('featured_overlay_title')
                            ->label('Overlay Title')
                            ->default('Digital School'),
                        Forms\Components\TextInput::make('featured_overlay_desc')
                            ->label('Overlay Description')
                            ->default('Sekolahku Surgaku'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Key Points')
                    ->description('Poin-poin penting yang ditampilkan')
                    ->schema([
                        Forms\Components\Repeater::make('key_points')
                            ->schema([
                                Forms\Components\TextInput::make('icon')
                                    ->label('Icon (opsional)')
                                    ->placeholder('heroicon-o-star'),
                                Forms\Components\TextInput::make('title')
                                    ->label('Judul')
                                    ->required(),
                                Forms\Components\Textarea::make('description')
                                    ->label('Deskripsi')
                                    ->required(),
                            ])
                            ->defaultItems(3)
                            ->columns(3),
                    ]),

                Forms\Components\Section::make('Alur Pendaftaran')
                    ->description('Bagian alur dan langkah pendaftaran')
                    ->schema([
                        Forms\Components\TextInput::make('alur_title')
                            ->label('Judul Alur')
                            ->default('Pendaftaran Online'),
                        Forms\Components\Textarea::make('alur_subtitle')
                            ->label('Subtitle Alur')
                            ->default('Langkah-langkah mudah untuk mendaftar di SMP Muhammadiyah Al Kautsar PK Kartasura'),
                        Forms\Components\FileUpload::make('alur_image')
                            ->label('Alur Image')
                            ->image()
                            ->imageEditor()
                            ->directory('ppdb/alur')
                            ->visibility('public')
                            ->maxSize(10240) // 10MB - SAMA DENGAN PROGRAM KHUSUS TYPE
                            ->required(),
                        Forms\Components\Repeater::make('steps')
                            ->schema([
                                Forms\Components\TextInput::make('icon')
                                    ->label('Icon (opsional)')
                                    ->placeholder('heroicon-o-arrow-right'),
                                Forms\Components\TextInput::make('title')
                                    ->label('Judul Step')
                                    ->required(),
                                Forms\Components\Textarea::make('description')
                                    ->label('Deskripsi Step')
                                    ->required(),
                            ])
                            ->defaultItems(4)
                            ->columns(3),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Program Options')
                    ->description('Bagian program-program yang tersedia')
                    ->schema([
                        Forms\Components\TextInput::make('program_section_badge')
                            ->label('Badge Program Section')
                            ->default('Program Khusus'),
                        Forms\Components\TextInput::make('program_section_title')
                            ->label('Judul Program Section')
                            ->default('Pilihan Program Khusus Tersedia'),
                        Forms\Components\Textarea::make('program_section_subtitle')
                            ->label('Subtitle Program Section')
                            ->default('Berbagai program unggulan yang dapat dipilih sesuai dengan minat dan bakat calon siswa'),
                        Forms\Components\Repeater::make('program_rows')
                            ->schema([
                                Forms\Components\Toggle::make('reverse')
                                    ->label('Reverse Layout (Image Kiri, Text Kanan)'),
                                Forms\Components\TextInput::make('badge')
                                    ->label('Badge Program')
                                    ->required(),
                                Forms\Components\TextInput::make('title')
                                    ->label('Judul Program')
                                    ->required(),
                                Forms\Components\Textarea::make('description')
                                    ->label('Deskripsi Program')
                                    ->required(),
                                Forms\Components\FileUpload::make('image')
                                    ->label('Image Program')
                                    ->image()
                                    ->imageEditor()
                                    ->directory('ppdb/programs')
                                    ->visibility('public')
                                    ->maxSize(10240) // 10MB - SAMA DENGAN PROGRAM KHUSUS TYPE
                                    ->required(),
                            ])
                            ->defaultItems(2)
                            ->columns(2),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Call to Action')
                    ->description('Bagian ajakan untuk bertindak')
                    ->schema([
                        Forms\Components\FileUpload::make('cta_background')
                            ->label('Background CTA')
                            ->image()
                            ->imageEditor()
                            ->directory('ppdb/cta')
                            ->visibility('public')
                            ->maxSize(10240) // 10MB - SAMA DENGAN PROGRAM KHUSUS TYPE
                            ->required(),
                        Forms\Components\TextInput::make('cta_badge')
                            ->label('Badge CTA')
                            ->default('PPDB INDEN 2025 / 2026'),
                        Forms\Components\TextInput::make('cta_title')
                            ->label('Judul CTA')
                            ->default('Siap Menjadi Bagian dari SMP Muhammadiyah AL Kautsar PK Kartasura'),
                        Forms\Components\Textarea::make('cta_description')
                            ->label('Deskripsi CTA')
                            ->default('Siap Menjadi Bagian dari SMP Muhammadiyah AL Kautsar PK Kartasura'),
                        Forms\Components\TextInput::make('cta_primary_label')
                            ->label('Label Button Primary')
                            ->default('PPDB Inden 2025 / 2026'),
                        Forms\Components\TextInput::make('cta_primary_url')
                            ->label('URL Button Primary')
                            ->default('#'),
                        Forms\Components\TextInput::make('cta_secondary_label')
                            ->label('Label Button Secondary')
                            ->default('Tentang ALKAPRO'),
                        Forms\Components\TextInput::make('cta_secondary_url')
                            ->label('URL Button Secondary')
                            ->default('#'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Additional Settings')
                    ->description('Pengaturan tambahan untuk PPDB')
                    ->schema([
                        Forms\Components\DatePicker::make('registration_deadline')
                            ->label('Deadline Pendaftaran'),
                        Forms\Components\TextInput::make('academic_year')
                            ->label('Tahun Ajaran')
                            ->default('2025 / 2026'),
                        Forms\Components\Toggle::make('is_registration_open')
                            ->label('Pendaftaran Dibuka')
                            ->default(true),
                        Forms\Components\Textarea::make('contact_info')
                            ->label('Informasi Kontak')
                            ->placeholder('Email: ppdb@smpsite.com\nWhatsApp: +62 812-3456-7890'),
                        Forms\Components\Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->placeholder('Deskripsi untuk SEO'),
                        Forms\Components\TextInput::make('meta_keywords')
                            ->label('Meta Keywords')
                            ->placeholder('ppdb, smp, muhammadiyah, kartasura'),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable(),
                Tables\Columns\TextColumn::make('academic_year')
                    ->label('Tahun Ajaran'),
                Tables\Columns\IconColumn::make('is_registration_open')
                    ->label('Pendaftaran Dibuka')
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Update')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
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
            'index' => Pages\ListInfoPPDBSettings::route('/'),
            'create' => Pages\CreateInfoPPDBSettings::route('/create'),
            'edit' => Pages\EditInfoPPDBSettings::route('/{record}/edit'),
        ];
    }
}

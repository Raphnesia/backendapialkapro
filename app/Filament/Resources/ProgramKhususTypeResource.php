<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramKhususTypeResource\Pages;
use App\Models\ProgramKhususType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProgramKhususTypeResource extends Resource
{
    protected static ?string $model = ProgramKhususType::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Program Khusus';
    protected static ?string $navigationLabel = 'Detail Program (ICT/Tahfidz)';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Dasar')->schema([
                Forms\Components\Select::make('slug')
                    ->label('Slug Program')
                    ->options([
                        'ict' => 'ICT (Information and Communication Technology)',
                        'tahfidz' => 'Tahfidz Al-Quran',
                    ])
                    ->required()
                    ->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('title')
                    ->label('Judul Program')
                    ->required(),
                Forms\Components\Textarea::make('subtitle')
                    ->label('Subtitle Program')
                    ->rows(2)
                    ->required(),
                Forms\Components\FileUpload::make('banner_desktop')
                    ->label('Banner Desktop')
                    ->image()
                    ->imageEditor()
                    ->directory('program-khusus')
                    ->visibility('public')
                    ->maxSize(10240) // 10MB
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->helperText('Format: JPG, PNG, WebP. Maksimal 10MB')
                    ->required(),
                Forms\Components\FileUpload::make('banner_mobile')
                    ->label('Banner Mobile')
                    ->image()
                    ->imageEditor()
                    ->directory('program-khusus')
                    ->visibility('public')
                    ->maxSize(10240) // 10MB
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->helperText('Format: JPG, PNG, WebP. Maksimal 10MB')
                    ->required(),
            ])->columns(2),

            Forms\Components\Section::make('Introduction Section')->schema([
                Forms\Components\TextInput::make('intro_badge')
                    ->label('Badge Label')
                    ->default('Pendidikan Digital')
                    ->required(),
                Forms\Components\TextInput::make('intro_title')
                    ->label('Judul Introduction')
                    ->default('Menggabungkan Akademik & Digital')
                    ->required(),
                Forms\Components\Textarea::make('intro_subtitle')
                    ->label('Subtitle Introduction')
                    ->rows(3)
                    ->required(),
            ])->columns(1),

            Forms\Components\Section::make('Featured Image Section')->schema([
                Forms\Components\FileUpload::make('featured_image')
                    ->label('Gambar Featured')
                    ->image()
                    ->imageEditor()
                    ->directory('program-khusus')
                    ->visibility('public')
                    ->required(),
                Forms\Components\TextInput::make('featured_overlay_title')
                    ->label('Judul Overlay')
                    ->default('Suasana Pembelajaran')
                    ->required(),
                Forms\Components\Textarea::make('featured_overlay_desc')
                    ->label('Deskripsi Overlay')
                    ->rows(2)
                    ->required(),
                Forms\Components\TextInput::make('featured_badge')
                    ->label('Badge Corner')
                    ->default('Program Unggulan')
                    ->required(),
            ])->columns(2),

            Forms\Components\Section::make('Key Points Section')->schema([
                Forms\Components\Repeater::make('key_points')->schema([
                    Forms\Components\TextInput::make('icon')
                        ->label('Icon')
                        ->default('🖥️')
                        ->maxLength(4)
                        ->required(),
                    Forms\Components\TextInput::make('title')
                        ->label('Judul')
                        ->required(),
                    Forms\Components\Textarea::make('description')
                        ->label('Deskripsi')
                        ->rows(2)
                        ->required(),
                ])
                ->defaultItems(2)
                ->minItems(1)
                ->maxItems(5)
                ->collapsible()
                ->grid(1),
            ]),

            Forms\Components\Section::make('Features Grid Section')->schema([
                Forms\Components\TextInput::make('features_title')
                    ->label('Judul Features')
                    ->default('Mengapa Memilih Program Kami')
                    ->required(),
                Forms\Components\Textarea::make('features_subtitle')
                    ->label('Subtitle Features')
                    ->rows(2)
                    ->required(),
                Forms\Components\FileUpload::make('features_image')
                    ->label('Gambar Features')
                    ->image()
                    ->imageEditor()
                    ->directory('program-khusus')
                    ->visibility('public')
                    ->required(),
                Forms\Components\Repeater::make('features_items')->schema([
                    Forms\Components\TextInput::make('icon')
                        ->label('Icon')
                        ->default('📚')
                        ->maxLength(4)
                        ->required(),
                    Forms\Components\TextInput::make('title')
                        ->label('Judul')
                        ->required(),
                    Forms\Components\Textarea::make('description')
                        ->label('Deskripsi')
                        ->rows(2)
                        ->required(),
                ])
                ->defaultItems(4)
                ->minItems(1)
                ->maxItems(10)
                ->collapsible()
                ->grid(1),
            ]),

            Forms\Components\Section::make('Benefits Section')->schema([
                Forms\Components\TextInput::make('benefits_badge')
                    ->label('Badge Benefits')
                    ->default('Tiga Kompetensi Utama')
                    ->required(),
                Forms\Components\TextInput::make('benefits_title')
                    ->label('Judul Benefits')
                    ->default('Dampak Positif Program')
                    ->required(),
                Forms\Components\Textarea::make('benefits_subtitle')
                    ->label('Subtitle Benefits')
                    ->rows(2)
                    ->required(),
                Forms\Components\Repeater::make('benefits_items')->schema([
                    Forms\Components\TextInput::make('badge_label')
                        ->label('Label Badge')
                        ->required(),
                    Forms\Components\TextInput::make('title')
                        ->label('Judul')
                        ->required(),
                    Forms\Components\Textarea::make('description')
                        ->label('Deskripsi')
                        ->rows(3)
                        ->required(),
                    Forms\Components\FileUpload::make('image')
                        ->label('Gambar')
                        ->image()
                        ->imageEditor()
                        ->directory('program-khusus')
                        ->visibility('public')
                        ->required(),
                    Forms\Components\Select::make('layout')
                        ->label('Layout')
                        ->options([
                            'imageLeft' => 'Gambar Kiri, Teks Kanan',
                            'imageRight' => 'Teks Kiri, Gambar Kanan',
                        ])
                        ->default('imageLeft')
                        ->required(),
                ])
                ->defaultItems(3)
                ->minItems(1)
                ->maxItems(5)
                ->collapsible()
                ->grid(1),
            ]),

            Forms\Components\Section::make('Gallery Section')->schema([
                Forms\Components\TextInput::make('gallery_title')
                    ->label('Judul Gallery')
                    ->default('Galeri Pembelajaran')
                    ->required(),
                Forms\Components\Textarea::make('gallery_subtitle')
                    ->label('Subtitle Gallery')
                    ->rows(2)
                    ->required(),
                Forms\Components\Repeater::make('gallery_items')->schema([
                    Forms\Components\FileUpload::make('src')
                        ->label('Gambar')
                        ->image()
                        ->imageEditor()
                        ->directory('program-khusus')
                        ->visibility('public')
                        ->required(),
                    Forms\Components\TextInput::make('title')
                        ->label('Judul')
                        ->required(),
                    Forms\Components\TextInput::make('desc')
                        ->label('Deskripsi')
                        ->required(),
                    Forms\Components\TextInput::make('color_gradient')
                        ->label('Gradient Warna')
                        ->default('from-blue-500 to-cyan-500')
                        ->required(),
                ])
                ->defaultItems(3)
                ->minItems(1)
                ->maxItems(10)
                ->collapsible()
                ->grid(1),
            ]),

            Forms\Components\Section::make('CTA Section')->schema([
                Forms\Components\FileUpload::make('cta_background')
                    ->label('Background CTA')
                    ->image()
                    ->imageEditor()
                    ->directory('program-khusus')
                    ->visibility('public')
                    ->required(),
                Forms\Components\TextInput::make('cta_badge')
                    ->label('Badge CTA')
                    ->default('Bergabung Sekarang')
                    ->required(),
                Forms\Components\TextInput::make('cta_title')
                    ->label('Judul CTA')
                    ->required(),
                Forms\Components\Textarea::make('cta_description')
                    ->label('Deskripsi CTA')
                    ->rows(3)
                    ->required(),
                Forms\Components\TextInput::make('cta_primary_label')
                    ->label('Label Tombol Primary')
                    ->default('Lihat Program Lainnya')
                    ->required(),
                Forms\Components\TextInput::make('cta_primary_url')
                    ->label('URL Tombol Primary')
                    ->default('/program-khusus')
                    ->required(),
                Forms\Components\TextInput::make('cta_secondary_label')
                    ->label('Label Tombol Secondary')
                    ->default('Tentang Sekolah')
                    ->required(),
                Forms\Components\TextInput::make('cta_secondary_url')
                    ->label('URL Tombol Secondary')
                    ->default('/profil')
                    ->required(),
            ])->columns(2),

            Forms\Components\Toggle::make('is_active')
                ->label('Aktif')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('slug')
                ->label('Slug')
                ->searchable(),
            Tables\Columns\TextColumn::make('title')
                ->label('Judul')
                ->searchable(),
            Tables\Columns\ImageColumn::make('banner_desktop')
                ->label('Banner')
                ->circular(),
            Tables\Columns\IconColumn::make('is_active')
                ->label('Status')
                ->boolean(),
            Tables\Columns\TextColumn::make('updated_at')
                ->label('Terakhir Diupdate')
                ->dateTime('d/m/Y H:i'),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->defaultSort('updated_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProgramKhususTypes::route('/'),
            'create' => Pages\CreateProgramKhususType::route('/create'),
            'edit' => Pages\EditProgramKhususType::route('/{record}/edit'),
        ];
    }
}



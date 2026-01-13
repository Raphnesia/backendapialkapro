<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProgramKhususPageResource\Pages;
use App\Models\ProgramKhususPage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProgramKhususPageResource extends Resource
{
    protected static ?string $model = ProgramKhususPage::class;
    protected static ?string $navigationIcon = 'heroicon-o-sparkles';
    protected static ?string $navigationGroup = 'Program Khusus';
    protected static ?string $navigationLabel = 'Halaman Utama Program Khusus';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Hero Section')->schema([
                Forms\Components\TextInput::make('hero_title')
                    ->label('Judul Hero')
                    ->default('Program Khusus')
                    ->required(),
                Forms\Components\Textarea::make('hero_subtitle')
                    ->label('Subtitle Hero')
                    ->default('Program unggulan SMP Muhammadiyah Al Kautsar PK Kartasura yang dirancang untuk mengembangkan potensi siswa secara optimal')
                    ->rows(3)
                    ->required(),
                Forms\Components\FileUpload::make('hero_image_desktop')
                    ->label('Gambar Hero Desktop')
                    ->image()
                    ->imageEditor()
                    ->directory('program-khusus')
                    ->visibility('public')
                    ->maxSize(10240) // 10MB
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->helperText('Format: JPG, PNG, WebP. Maksimal 10MB')
                    ->required(),
                Forms\Components\FileUpload::make('hero_image_mobile')
                    ->label('Gambar Hero Mobile')
                    ->image()
                    ->imageEditor()
                    ->directory('program-khusus')
                    ->visibility('public')
                    ->maxSize(10240) // 10MB
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->helperText('Format: JPG, PNG, WebP. Maksimal 10MB')
                    ->required(),
            ])->columns(2),

            Forms\Components\Section::make('Overview Section')->schema([
                Forms\Components\TextInput::make('overview_title')
                    ->label('Judul Overview')
                    ->default('Program Unggulan Kami')
                    ->required(),
                Forms\Components\Textarea::make('overview_subtitle')
                    ->label('Subtitle Overview')
                    ->default('Kami menawarkan dua program khusus yang dirancang untuk mengembangkan potensi akademik dan spiritual siswa')
                    ->rows(2)
                    ->required(),
            ])->columns(2),

            Forms\Components\Section::make('Program Cards (Halaman Utama)')->schema([
                Forms\Components\Repeater::make('programs')->schema([
                    Forms\Components\TextInput::make('id')
                        ->label('ID Program')
                        ->default('tahfidz')
                        ->required()
                        ->helperText('Contoh: tahfidz, ict'),
                    Forms\Components\TextInput::make('title')
                        ->label('Judul Program')
                        ->required(),
                    Forms\Components\Textarea::make('subtitle')
                        ->label('Subtitle Program')
                        ->rows(2)
                        ->required(),
                    Forms\Components\Textarea::make('description')
                        ->label('Deskripsi Program')
                        ->rows(3)
                        ->required(),
                    Forms\Components\FileUpload::make('image')
                        ->label('Gambar Program')
                        ->image()
                        ->imageEditor()
                        ->directory('program-khusus')
                        ->visibility('public')
                        ->maxSize(10240) // 10MB
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                        ->helperText('Format: JPG, PNG, WebP. Maksimal 10MB')
                        ->required(),
                    Forms\Components\Select::make('color')
                        ->label('Warna Program')
                        ->options([
                            'green' => 'Hijau',
                            'blue' => 'Biru',
                            'red' => 'Merah',
                            'purple' => 'Ungu',
                        ])
                        ->default('green')
                        ->required(),
                    Forms\Components\TextInput::make('href')
                        ->label('Link Program')
                        ->required(),
                    Forms\Components\Repeater::make('features')
                        ->label('Fitur Program')
                        ->schema([
                            Forms\Components\TextInput::make('feature')
                                ->label('Fitur')
                                ->required(),
                        ])
                        ->defaultItems(4)
                        ->minItems(1)
                        ->maxItems(10)
                        ->collapsible(),
                ])
                ->defaultItems(2)
                ->minItems(1)
                ->maxItems(5)
                ->collapsible()
                ->grid(1),
            ]),

            Forms\Components\Section::make('Program Khusus Section')->schema([
                Forms\Components\Repeater::make('section_programs')->schema([
                    Forms\Components\TextInput::make('id')
                        ->label('ID Program')
                        ->default('tahfidz')
                        ->required()
                        ->helperText('Contoh: tahfidz, ict'),
                    Forms\Components\TextInput::make('title')
                        ->label('Judul Program')
                        ->required(),
                    Forms\Components\Textarea::make('subtitle')
                        ->label('Subtitle Program')
                        ->rows(2)
                        ->required(),
                    Forms\Components\FileUpload::make('image')
                        ->label('Gambar Program')
                        ->image()
                        ->imageEditor()
                        ->directory('program-khusus')
                        ->visibility('public')
                        ->maxSize(10240) // 10MB
                        ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                        ->helperText('Format: JPG, PNG, WebP. Maksimal 10MB')
                        ->required(),
                    Forms\Components\Select::make('color')
                        ->label('Warna Program')
                        ->options([
                            'green' => 'Hijau',
                            'blue' => 'Biru',
                            'red' => 'Merah',
                            'purple' => 'Ungu',
                        ])
                        ->default('green')
                        ->required(),
                    Forms\Components\TextInput::make('href')
                        ->label('Link Program')
                        ->required(),
                ])
                ->defaultItems(2)
                ->minItems(1)
                ->maxItems(15)
                ->collapsible()
                ->grid(1),
            ]),

            Forms\Components\Section::make('Reasons Section')->schema([
                Forms\Components\TextInput::make('reasons_title')
                    ->label('Judul Reasons')
                    ->default('Mengapa Memilih Program Khusus Kami?')
                    ->required(),
                Forms\Components\Textarea::make('reasons_subtitle')
                    ->label('Subtitle Reasons')
                    ->default('Program khusus kami dirancang dengan pendekatan holistik untuk mengembangkan potensi siswa secara optimal, menggabungkan keahlian akademik dengan pembentukan karakter')
                    ->rows(3)
                    ->required(),
                Forms\Components\Repeater::make('reasons')->schema([
                    Forms\Components\TextInput::make('icon')
                        ->label('Icon Emoji')
                        ->default('🎯')
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
                ->defaultItems(3)
                ->minItems(1)
                ->maxItems(5)
                ->collapsible()
                ->grid(1),
            ]),

            Forms\Components\Section::make('CTA Section')->schema([
                Forms\Components\TextInput::make('cta_title')
                    ->label('Judul CTA')
                    ->default('Siap Bergabung dengan Program Khusus Kami?')
                    ->required(),
                Forms\Components\Textarea::make('cta_subtitle')
                    ->label('Subtitle CTA')
                    ->default('Pilih program yang sesuai dengan minat dan bakat Anda untuk mengembangkan potensi secara optimal')
                    ->rows(2)
                    ->required(),
                Forms\Components\TextInput::make('cta_primary_label')
                    ->label('Label Tombol Primary')
                    ->default('Program Tahfidz')
                    ->required(),
                Forms\Components\TextInput::make('cta_primary_url')
                    ->label('URL Tombol Primary')
                    ->default('/program-khusus/tahfidz')
                    ->required(),
                Forms\Components\TextInput::make('cta_secondary_label')
                    ->label('Label Tombol Secondary')
                    ->default('Program ICT')
                    ->required(),
                Forms\Components\TextInput::make('cta_secondary_url')
                    ->label('URL Tombol Secondary')
                    ->default('/program-khusus/ict')
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
            Tables\Columns\TextColumn::make('hero_title')
                ->label('Judul')
                ->searchable(),
            Tables\Columns\ImageColumn::make('hero_image_desktop')
                ->label('Gambar Hero')
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
            'index' => Pages\ListProgramKhususPages::route('/'),
            'create' => Pages\CreateProgramKhususPage::route('/create'),
            'edit' => Pages\EditProgramKhususPage::route('/{record}/edit'),
        ];
    }
}



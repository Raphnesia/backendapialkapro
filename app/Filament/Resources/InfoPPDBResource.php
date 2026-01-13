<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InfoPPDBResource\Pages;
use App\Models\InfoPPDBSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InfoPPDBResource extends Resource
{
    protected static ?string $model = InfoPPDBSettings::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'PPDB';
    protected static ?string $navigationLabel = 'Info PPDB (Semua Bagian)';
    protected static ?int $navigationSort = 1;

    public static function canCreate(): bool
    {
        // Hanya satu record settings; batasi create jika sudah ada
        return InfoPPDBSettings::query()->count() === 0;
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Hero & Banner')->schema([
                Forms\Components\TextInput::make('title')->label('Judul')->required(),
                Forms\Components\Textarea::make('subtitle')->label('Subtitle')->rows(2)->required(),
                Forms\Components\FileUpload::make('banner_desktop')->label('Banner Desktop')->image()->imageEditor()->disk('public')->directory('ppdb/banners')->visibility('public')->maxSize(8192),
                Forms\Components\FileUpload::make('banner_mobile')->label('Banner Mobile')->image()->imageEditor()->disk('public')->directory('ppdb/banners')->visibility('public')->maxSize(8192),
                Forms\Components\Textarea::make('hero_description')->label('Deskripsi Hero')->rows(3),
            ])->columns(2),

            Forms\Components\Section::make('Intro')->schema([
                Forms\Components\TextInput::make('intro_badge')->label('Badge'),
                Forms\Components\TextInput::make('intro_title')->label('Judul'),
                Forms\Components\Textarea::make('intro_subtitle')->label('Subjudul')->rows(3),
            ]),

            Forms\Components\Section::make('Featured Image')->schema([
                Forms\Components\FileUpload::make('featured_image')->label('Gambar')->image()->disk('public')->directory('ppdb/featured')->visibility('public')->maxSize(8192),
                Forms\Components\TextInput::make('featured_overlay_title')->label('Judul Overlay'),
                Forms\Components\Textarea::make('featured_overlay_desc')->label('Deskripsi Overlay')->rows(2),
                Forms\Components\TextInput::make('featured_badge')->label('Badge'),
            ])->columns(2),

            Forms\Components\Section::make('Key Points')->schema([
                Forms\Components\Repeater::make('key_points')->schema([
                    Forms\Components\TextInput::make('icon')->label('Icon'),
                    Forms\Components\TextInput::make('title')->label('Judul'),
                    Forms\Components\Textarea::make('description')->label('Deskripsi')->rows(2),
                ])->collapsible()->grid(1),
            ]),

            Forms\Components\Section::make('Alur Pendaftaran')->schema([
                Forms\Components\TextInput::make('alur_title')->label('Judul'),
                Forms\Components\Textarea::make('alur_subtitle')->label('Subtitle')->rows(2),
                Forms\Components\FileUpload::make('alur_image')->label('Gambar')->image()->disk('public')->directory('ppdb/alur')->visibility('public')->maxSize(8192),
                Forms\Components\Repeater::make('steps')->schema([
                    Forms\Components\TextInput::make('icon')->label('Icon'),
                    Forms\Components\TextInput::make('title')->label('Judul'),
                    Forms\Components\Textarea::make('description')->label('Deskripsi')->rows(2),
                ])->defaultItems(4)->collapsible()->grid(1),
            ]),

            Forms\Components\Section::make('Program Options')->schema([
                Forms\Components\TextInput::make('program_section_badge')->label('Badge'),
                Forms\Components\TextInput::make('program_section_title')->label('Judul'),
                Forms\Components\Textarea::make('program_section_subtitle')->label('Subtitle')->rows(2),
                Forms\Components\Repeater::make('program_rows')->schema([
                    Forms\Components\Fieldset::make('Row')->schema([
                        Forms\Components\Toggle::make('reverse')->label('Gambar Kanan?')->default(false),
                        Forms\Components\TextInput::make('badge')->label('Badge'),
                        Forms\Components\TextInput::make('title')->label('Judul'),
                        Forms\Components\Textarea::make('description')->label('Deskripsi')->rows(3),
                        Forms\Components\FileUpload::make('image')->label('Gambar')->image()->disk('public')->directory('ppdb/programs')->visibility('public')->maxSize(8192),
                    ])->columns(2),
                ])->defaultItems(2)->collapsible()->grid(1),
            ]),

            Forms\Components\Section::make('CTA')->schema([
                Forms\Components\TextInput::make('cta_text')->label('Teks CTA (Header)'),
                Forms\Components\TextInput::make('cta_link')->label('Link CTA (Header)'),
                Forms\Components\FileUpload::make('cta_background')->label('Background CTA')->image()->disk('public')->directory('ppdb/cta')->visibility('public')->maxSize(8192),
                Forms\Components\TextInput::make('cta_badge')->label('Badge CTA'),
                Forms\Components\TextInput::make('cta_title')->label('Judul CTA'),
                Forms\Components\Textarea::make('cta_description')->label('Deskripsi CTA')->rows(3),
                Forms\Components\TextInput::make('cta_primary_label')->label('Label Tombol Primary'),
                Forms\Components\TextInput::make('cta_primary_url')->label('URL Tombol Primary'),
                Forms\Components\TextInput::make('cta_secondary_label')->label('Label Tombol Secondary'),
                Forms\Components\TextInput::make('cta_secondary_url')->label('URL Tombol Secondary'),
            ])->columns(2),

            Forms\Components\Section::make('Informasi')->schema([
                Forms\Components\DatePicker::make('registration_deadline')->label('Deadline Pendaftaran'),
                Forms\Components\TextInput::make('academic_year')->label('Tahun Akademik'),
                Forms\Components\Toggle::make('is_registration_open')->label('Pendaftaran Dibuka'),
                Forms\Components\Textarea::make('contact_info')->label('Informasi Kontak')->rows(2),
            ])->columns(2),

            Forms\Components\Section::make('SEO')->schema([
                Forms\Components\Textarea::make('meta_description')->label('Meta Description')->rows(2),
                Forms\Components\Textarea::make('meta_keywords')->label('Meta Keywords')->rows(2),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')->label('Judul'),
            Tables\Columns\ImageColumn::make('banner_desktop')->label('Banner'),
            Tables\Columns\IconColumn::make('is_registration_open')->label('Pendaftaran')->boolean(),
            Tables\Columns\TextColumn::make('updated_at')->label('Diupdate')->dateTime('d/m/Y H:i'),
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInfoPPDBs::route('/'),
            'create' => Pages\CreateInfoPPDB::route('/create'),
            'edit' => Pages\EditInfoPPDB::route('/{record}/edit'),
        ];
    }
}




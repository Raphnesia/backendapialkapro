<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubFacilitySettingsResource\Pages;
use App\Models\SubFacilitySettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SubFacilitySettingsResource extends Resource
{
    protected static ?string $model = SubFacilitySettings::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Fasilitas';

    protected static ?string $navigationLabel = 'Pengaturan Sub Fasilitas';

    protected static ?string $modelLabel = 'Pengaturan Sub Fasilitas';

    protected static ?string $pluralModelLabel = 'Pengaturan Sub Fasilitas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('parent_slug')
                    ->label('Parent Slug')
                    ->required()
                    ->helperText('Slug dari facility box yang terkait')
                    ->placeholder('Masukkan parent slug'),

                Forms\Components\TextInput::make('title')
                    ->label('Judul Halaman')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Masukkan judul halaman sub-fasilitas'),

                Forms\Components\Textarea::make('subtitle')
                    ->label('Subtitle')
                    ->rows(3)
                    ->maxLength(500)
                    ->placeholder('Masukkan subtitle halaman'),

                Forms\Components\FileUpload::make('banner_desktop')
                    ->label('Banner Desktop')
                    ->image()
                    ->imageEditor()
                    ->imageCropAspectRatio('16:9')
                    ->disk('public')
                    ->directory('sub-facilities/banners')
                    ->helperText('Rasio 16:9, ukuran disarankan 1920x1080px')
                    ->placeholder('Upload banner untuk desktop'),

                Forms\Components\FileUpload::make('banner_mobile')
                    ->label('Banner Mobile')
                    ->image()
                    ->imageEditor()
                    ->imageCropAspectRatio('16:9')
                    ->disk('public')
                    ->directory('sub-facilities/banners')
                    ->helperText('Rasio 16:9, ukuran disarankan 1920x1080px')
                    ->placeholder('Upload banner untuk mobile'),

                Forms\Components\Select::make('title_panel_bg_color')
                    ->label('Warna Background Title Panel')
                    ->options([
                        'bg-yellow-400' => 'Kuning',
                        'bg-green-400' => 'Hijau',
                        'bg-blue-400' => 'Biru',
                        'bg-red-400' => 'Merah',
                        'bg-purple-400' => 'Ungu',
                        'bg-gray-400' => 'Abu-abu',
                    ])
                    ->default('bg-yellow-400')
                    ->required(),

                Forms\Components\Select::make('subtitle_panel_bg_color')
                    ->label('Warna Background Subtitle Panel')
                    ->options([
                        'bg-blue-600' => 'Biru',
                        'bg-green-600' => 'Hijau',
                        'bg-red-600' => 'Merah',
                        'bg-yellow-600' => 'Kuning',
                        'bg-purple-600' => 'Ungu',
                        'bg-gray-600' => 'Abu-abu',
                    ])
                    ->default('bg-blue-600')
                    ->required(),

                Forms\Components\TextInput::make('content_section_title')
                    ->label('Judul Section Content')
                    ->maxLength(255)
                    ->placeholder('Masukkan judul section content'),

                Forms\Components\RichEditor::make('content_section_text')
                    ->label('Text Content Section')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'link',
                        'bulletList',
                        'orderedList',
                        'h2',
                        'h3',
                        'h4',
                        'blockquote',
                    ])
                    ->placeholder('Masukkan text content section'),

                Forms\Components\Select::make('display_type')
                    ->label('Tipe Tampilan')
                    ->options([
                        'grid' => 'Grid',
                        'list' => 'List',
                        'gallery' => 'Gallery',
                    ])
                    ->default('grid')
                    ->required(),

                Forms\Components\Toggle::make('show_photo_collage')
                    ->label('Tampilkan Photo Collage')
                    ->default(true)
                    ->helperText('Aktifkan untuk menampilkan photo collage'),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->helperText('Aktifkan untuk menampilkan pengaturan ini'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('parent_slug')
                    ->label('Parent Slug')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('subtitle')
                    ->label('Subtitle')
                    ->limit(50)
                    ->searchable(),

                Tables\Columns\TextColumn::make('display_type')
                    ->label('Tipe Tampilan')
                    ->sortable(),

                Tables\Columns\IconColumn::make('show_photo_collage')
                    ->label('Photo Collage')
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
                Tables\Filters\SelectFilter::make('parent_slug')
                    ->label('Parent Slug')
                    ->options(function () {
                        return \App\Models\FacilityBox::active()
                            ->where('creates_sub_facility', true)
                            ->pluck('link_slug', 'link_slug')
                            ->toArray();
                    }),
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
            'index' => Pages\ListSubFacilitySettings::route('/'),
            'create' => Pages\CreateSubFacilitySettings::route('/create'),
            'edit' => Pages\EditSubFacilitySettings::route('/{record}/edit'),
        ];
    }
} 
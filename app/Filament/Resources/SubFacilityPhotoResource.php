<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubFacilityPhotoResource\Pages;
use App\Models\SubFacilityPhoto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SubFacilityPhotoResource extends Resource
{
    protected static ?string $model = SubFacilityPhoto::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Fasilitas';

    protected static ?string $navigationLabel = 'Photo Collage Sub Fasilitas';

    protected static ?string $modelLabel = 'Photo Collage Sub Fasilitas';

    protected static ?string $pluralModelLabel = 'Photo Collage Sub Fasilitas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('parent_slug')
                    ->label('Parent Slug')
                    ->required()
                    ->options(function () {
                        return \App\Models\FacilityBox::active()
                            ->where('creates_sub_facility', true)
                            ->pluck('title', 'link_slug')
                            ->toArray();
                    })
                    ->helperText('Pilih sub-fasilitas untuk photo collage'),

                Forms\Components\TextInput::make('title')
                    ->label('Judul Foto')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Masukkan judul foto'),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(3)
                    ->maxLength(500)
                    ->placeholder('Masukkan deskripsi foto (opsional)'),

                Forms\Components\FileUpload::make('image')
                    ->label('Foto')
                    ->image()
                    ->imageEditor()
                    ->imageCropAspectRatio('16:9')
                    ->disk('public')
                    ->directory('sub-facilities/photos')
                    ->required()
                    ->helperText('Upload foto untuk photo collage')
                    ->placeholder('Upload foto'),

                Forms\Components\TextInput::make('alt_text')
                    ->label('Alt Text')
                    ->maxLength(255)
                    ->placeholder('Masukkan alt text untuk SEO')
                    ->helperText('Text alternatif untuk accessibility dan SEO'),

                Forms\Components\TextInput::make('order_index')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0)
                    ->helperText('Angka untuk mengatur urutan tampilan'),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->helperText('Aktifkan untuk menampilkan foto ini'),
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

                Tables\Columns\ImageColumn::make('image')
                    ->label('Foto')
                    ->circular()
                    ->size(60),

                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->searchable(),

                Tables\Columns\TextColumn::make('order_index')
                    ->label('Urutan')
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
                            ->pluck('title', 'link_slug')
                            ->toArray();
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order_index', 'asc');
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
            'index' => Pages\ListSubFacilityPhotos::route('/'),
            'create' => Pages\CreateSubFacilityPhoto::route('/create'),
            'edit' => Pages\EditSubFacilityPhoto::route('/{record}/edit'),
        ];
    }
} 
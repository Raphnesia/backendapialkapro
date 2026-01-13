<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubFacilityBoxResource\Pages;
use App\Models\SubFacilityBox;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SubFacilityBoxResource extends Resource
{
    protected static ?string $model = SubFacilityBox::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    protected static ?string $navigationGroup = 'Fasilitas';

    protected static ?string $navigationLabel = 'Sub Fasilitas Box';

    protected static ?string $modelLabel = 'Sub Fasilitas Box';

    protected static ?string $pluralModelLabel = 'Sub Fasilitas Box';

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
                    ->label('Judul Box')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Masukkan judul box'),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(3)
                    ->maxLength(500)
                    ->placeholder('Masukkan deskripsi box'),

                Forms\Components\FileUpload::make('icon')
                    ->label('Icon')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory('sub-facilities/icons')
                    ->helperText('Upload icon untuk box')
                    ->placeholder('Upload icon'),

                Forms\Components\FileUpload::make('background_image')
                    ->label('Gambar Background')
                    ->image()
                    ->imageEditor()
                    ->imageCropAspectRatio('16:9')
                    ->disk('public')
                    ->directory('sub-facilities/backgrounds')
                    ->helperText('Gambar background untuk box')
                    ->placeholder('Upload gambar background'),

                Forms\Components\Select::make('bg_color')
                    ->label('Warna Background')
                    ->options([
                        'bg-blue-600' => 'Biru',
                        'bg-green-500' => 'Hijau',
                        'bg-red-600' => 'Merah',
                        'bg-yellow-500' => 'Kuning',
                        'bg-purple-600' => 'Ungu',
                        'bg-gray-600' => 'Abu-abu',
                    ])
                    ->default('bg-blue-600')
                    ->required(),

                Forms\Components\Select::make('hover_bg_color')
                    ->label('Warna Background Hover')
                    ->options([
                        'bg-blue-700' => 'Biru Gelap',
                        'bg-green-600' => 'Hijau Gelap',
                        'bg-red-700' => 'Merah Gelap',
                        'bg-yellow-600' => 'Kuning Gelap',
                        'bg-purple-700' => 'Ungu Gelap',
                        'bg-gray-700' => 'Abu-abu Gelap',
                    ])
                    ->default('bg-blue-700')
                    ->required(),

                Forms\Components\TextInput::make('order_index')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0)
                    ->helperText('Angka untuk mengatur urutan tampilan'),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->helperText('Aktifkan untuk menampilkan box ini'),
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
            'index' => Pages\ListSubFacilityBoxes::route('/'),
            'create' => Pages\CreateSubFacilityBox::route('/create'),
            'edit' => Pages\EditSubFacilityBox::route('/{record}/edit'),
        ];
    }
} 
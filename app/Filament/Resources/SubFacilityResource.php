<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubFacilityResource\Pages;
use App\Models\SubFacility;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SubFacilityResource extends Resource
{
    protected static ?string $model = SubFacility::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationGroup = 'Fasilitas';

    protected static ?string $navigationLabel = 'Sub Fasilitas';

    protected static ?string $modelLabel = 'Sub Fasilitas';

    protected static ?string $pluralModelLabel = 'Sub Fasilitas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Fasilitas')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Masukkan nama fasilitas'),

                Forms\Components\TextInput::make('slug')
                    ->label('Slug')
                    ->helperText('Akan dibuat otomatis dari nama')
                    ->disabled()
                    ->dehydrated(false),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(4)
                    ->required()
                    ->placeholder('Masukkan deskripsi fasilitas'),

                Forms\Components\FileUpload::make('image')
                    ->label('Gambar')
                    ->image()
                    ->imageEditor()
                    ->imageCropAspectRatio('16:9')
                    ->disk('public')
                    ->directory('sub-facilities')
                    ->helperText('Upload gambar fasilitas')
                    ->placeholder('Upload gambar'),

                Forms\Components\TextInput::make('category')
                    ->label('Kategori')
                    ->maxLength(255)
                    ->placeholder('Masukkan kategori fasilitas'),

                Forms\Components\TextInput::make('capacity')
                    ->label('Kapasitas')
                    ->numeric()
                    ->placeholder('Masukkan kapasitas fasilitas'),

                Forms\Components\TextInput::make('location')
                    ->label('Lokasi')
                    ->maxLength(255)
                    ->placeholder('Masukkan lokasi fasilitas'),

                Forms\Components\Repeater::make('specifications')
                    ->label('Spesifikasi')
                    ->schema([
                        Forms\Components\TextInput::make('key')
                            ->label('Kunci')
                            ->required(),
                        Forms\Components\TextInput::make('value')
                            ->label('Nilai')
                            ->required(),
                    ])
                    ->columns(2)
                    ->defaultItems(0)
                    ->reorderable(false)
                    ->collapsible(),

                Forms\Components\TextInput::make('parent_slug')
                    ->label('Parent Slug')
                    ->required()
                    ->helperText('Slug dari facility box yang terkait')
                    ->placeholder('Masukkan parent slug'),

                Forms\Components\TextInput::make('order_index')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0)
                    ->helperText('Angka untuk mengatur urutan tampilan'),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->helperText('Aktifkan untuk menampilkan fasilitas ini'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('location')
                    ->label('Lokasi')
                    ->searchable()
                    ->limit(30),

                Tables\Columns\TextColumn::make('capacity')
                    ->label('Kapasitas')
                    ->sortable(),

                Tables\Columns\TextColumn::make('parent_slug')
                    ->label('Parent Slug')
                    ->searchable()
                    ->sortable(),

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
            'index' => Pages\ListSubFacilities::route('/'),
            'create' => Pages\CreateSubFacility::route('/create'),
            'edit' => Pages\EditSubFacility::route('/{record}/edit'),
        ];
    }
} 
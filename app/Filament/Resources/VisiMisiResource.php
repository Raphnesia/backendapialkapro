<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisiMisiResource\Pages;
use App\Models\VisiMisi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VisiMisiResource extends Resource
{
    protected static ?string $model = VisiMisi::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Profil Sekolah';

    protected static ?string $navigationLabel = 'Visi Misi';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Contoh: Visi Sekolah, Misi Sekolah, dll.'),

                Forms\Components\RichEditor::make('content')
                    ->label('Konten')
                    ->required()
                    ->columnSpanFull()
                    ->placeholder('Masukkan konten visi misi...'),

                Forms\Components\Select::make('grid_type')
                    ->label('Tipe Grid')
                    ->options([
                        'grid-cols-1' => 'Grid 1 Kolom',
                        'grid-cols-2' => 'Grid 2 Kolom',
                        'grid-cols-3' => 'Grid 3 Kolom',
                        'grid-cols-4' => 'Grid 4 Kolom',
                    ])
                    ->default('grid-cols-1')
                    ->required(),

                Forms\Components\Toggle::make('use_list_disc')
                    ->label('Gunakan List Bullet')
                    ->default(false)
                    ->helperText('Aktifkan jika ingin menampilkan list bullet points')
                    ->live(),

                Forms\Components\Repeater::make('list_items')
                    ->label('Item List')
                    ->schema([
                        Forms\Components\TextInput::make('item')
                            ->label('Item')
                            ->required()
                            ->placeholder('Masukkan item list'),
                    ])
                    ->visible(fn (Forms\Get $get): bool => $get('use_list_disc') === true)
                    ->helperText('Tambahkan item-item untuk list bullet points')
                    ->defaultItems(0)
                    ->addActionLabel('Tambah Item')
                    ->reorderable()
                    ->collapsible(),

                Forms\Components\Select::make('background_color')
                    ->label('Warna Background')
                    ->options([
                        'bg-white' => 'Putih',
                        'bg-gray-50' => 'Abu-abu Muda',
                        'bg-blue-50' => 'Biru Muda',
                        'bg-green-50' => 'Hijau Muda',
                        'bg-yellow-50' => 'Kuning Muda',
                        'bg-purple-50' => 'Ungu Muda',
                        'bg-red-50' => 'Merah Muda',
                    ])
                    ->default('bg-white')
                    ->required(),

                Forms\Components\Select::make('border_color')
                    ->label('Warna Border')
                    ->options([
                        'border-gray-200' => 'Abu-abu',
                        'border-blue-200' => 'Biru',
                        'border-green-200' => 'Hijau',
                        'border-yellow-200' => 'Kuning',
                        'border-purple-200' => 'Ungu',
                        'border-red-200' => 'Merah',
                        'border-transparent' => 'Transparan',
                    ])
                    ->default('border-gray-200')
                    ->required(),

                Forms\Components\TextInput::make('order_index')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0)
                    ->required()
                    ->helperText('Angka kecil akan ditampilkan terlebih dahulu'),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->helperText('Nonaktifkan untuk menyembunyikan dari frontend'),
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

                Tables\Columns\TextColumn::make('grid_type')
                    ->label('Grid')
                    ->badge()
                    ->color('info'),

                Tables\Columns\IconColumn::make('use_list_disc')
                    ->label('List Bullet')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),

                Tables\Columns\TextColumn::make('order_index')
                    ->label('Urutan')
                    ->sortable()
                    ->numeric(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

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
                Tables\Filters\SelectFilter::make('grid_type')
                    ->label('Tipe Grid')
                    ->options([
                        'grid-cols-1' => 'Grid 1 Kolom',
                        'grid-cols-2' => 'Grid 2 Kolom',
                        'grid-cols-3' => 'Grid 3 Kolom',
                        'grid-cols-4' => 'Grid 4 Kolom',
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
            'index' => Pages\ListVisiMisis::route('/'),
            'create' => Pages\CreateVisiMisi::route('/create'),
            'edit' => Pages\EditVisiMisi::route('/{record}/edit'),
        ];
    }
}

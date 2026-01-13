<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SejarahSingkatResource\Pages;
use App\Models\SejarahSingkat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SejarahSingkatResource extends Resource
{
    protected static ?string $model = SejarahSingkat::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Profil Sekolah';

    protected static ?string $navigationLabel = 'Konten Sejarah Singkat';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Dasar')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Section')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Sejarah Pendirian SMP Muhammadiyah Al Kautsar PK Kartasura'),

                        Forms\Components\RichEditor::make('content')
                            ->label('Konten Utama')
                            ->required()
                            ->columnSpanFull()
                            ->placeholder('Tulis konten sejarah singkat di sini...'),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Layout & Tampilan')
                    ->schema([
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
                            ->label('Gunakan List Disc')
                            ->helperText('Aktifkan jika ingin menampilkan list dengan bullet points')
                            ->default(false)
                            ->live(),

                        Forms\Components\Repeater::make('list_items')
                            ->label('Item List')
                            ->schema([
                                Forms\Components\TextInput::make('item')
                                    ->label('Item')
                                    ->required()
                                    ->placeholder('Masukkan item list...'),
                            ])
                            ->visible(fn (Forms\Get $get): bool => $get('use_list_disc') === true)
                            ->defaultItems(0)
                            ->addActionLabel('Tambah Item')
                            ->reorderable()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['item'] ?? null)
                            ->helperText('Tambahkan item-item untuk list bullet points'),

                        Forms\Components\Select::make('background_color')
                            ->label('Warna Background')
                            ->options([
                                'bg-white' => 'Putih',
                                'bg-gray-50' => 'Abu-abu Muda',
                                'bg-blue-50' => 'Biru Muda',
                                'bg-green-50' => 'Hijau Muda',
                                'bg-yellow-50' => 'Kuning Muda',
                                'bg-red-50' => 'Merah Muda',
                            ])
                            ->default('bg-white')
                            ->required(),

                        Forms\Components\Select::make('border_color')
                            ->label('Warna Border')
                            ->options([
                                'border-gray-100' => 'Abu-abu Muda',
                                'border-gray-200' => 'Abu-abu',
                                'border-blue-200' => 'Biru',
                                'border-green-200' => 'Hijau',
                                'border-yellow-200' => 'Kuning',
                                'border-red-200' => 'Merah',
                            ])
                            ->default('border-gray-100')
                            ->required(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Pengaturan')
                    ->schema([
                        Forms\Components\TextInput::make('order_index')
                            ->label('Urutan Tampilan')
                            ->numeric()
                            ->default(0)
                            ->helperText('Angka kecil akan ditampilkan terlebih dahulu'),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true)
                            ->helperText('Nonaktifkan untuk menyembunyikan dari tampilan'),
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
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('grid_type')
                    ->label('Grid')
                    ->badge()
                    ->color('success'),

                Tables\Columns\IconColumn::make('use_list_disc')
                    ->label('List Disc')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),

                Tables\Columns\TextColumn::make('order_index')
                    ->label('Urutan')
                    ->sortable()
                    ->badge(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime('d M Y H:i')
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
            'index' => Pages\ListSejarahSingkats::route('/'),
            'create' => Pages\CreateSejarahSingkat::route('/create'),
            'edit' => Pages\EditSejarahSingkat::route('/{record}/edit'),
        ];
    }
}

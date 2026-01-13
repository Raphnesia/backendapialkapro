<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IPMContentResource\Pages;
use App\Models\IPMContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class IPMContentResource extends Resource
{
    protected static ?string $model = IPMContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Profil Sekolah';

    protected static ?string $navigationLabel = 'IPM Content';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul Section')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Contoh: Visi IPM, Misi IPM, Program Kerja IPM'),

                Forms\Components\RichEditor::make('content')
                    ->label('Konten')
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
                    ->placeholder('Masukkan konten section ini'),

                Forms\Components\Select::make('grid_type')
                    ->label('Tipe Grid Layout')
                    ->options([
                        'grid-cols-1' => '1 Kolom',
                        'grid-cols-2' => '2 Kolom',
                        'grid-cols-3' => '3 Kolom',
                        'grid-cols-4' => '4 Kolom',
                    ])
                    ->default('grid-cols-1')
                    ->required()
                    ->helperText('Pilih layout grid untuk konten ini'),

                Forms\Components\Toggle::make('use_list_disc')
                    ->label('Gunakan Struktur Bidang')
                    ->default(false)
                    ->helperText('Aktifkan untuk membuat struktur bidang dengan anggota')
                    ->live(),

                // Struktur Bidang Kompleks
                Forms\Components\Repeater::make('bidang_structure')
                    ->label('Struktur Bidang')
                    ->schema([
                        Forms\Components\TextInput::make('bidang_name')
                            ->label('Nama Bidang')
                            ->required()
                            ->placeholder('Contoh: Bidang Organisasi'),
                        
                        Forms\Components\Repeater::make('members')
                            ->label('Anggota Bidang')
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Nama Anggota')
                                    ->required()
                                    ->placeholder('Masukkan nama anggota...'),
                                
                                Forms\Components\TextInput::make('position')
                                    ->label('Jabatan (Opsional)')
                                    ->placeholder('Contoh: Ketua Bidang, Anggota, dll'),
                            ])
                            ->defaultItems(1)
                            ->reorderable()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
                    ])
                    ->visible(fn (Forms\Get $get): bool => $get('use_list_disc') === true)
                    ->defaultItems(0)
                    ->reorderable()
                    ->collapsible()
                    ->itemLabel(fn (array $state): ?string => $state['bidang_name'] ?? null)
                    ->helperText('Buat struktur bidang dengan daftar anggota'),

                Forms\Components\Repeater::make('list_items')
                    ->label('Item List (Legacy)')
                    ->schema([
                        Forms\Components\TextInput::make('item')
                            ->label('Item')
                            ->required()
                            ->placeholder('Masukkan item list'),
                    ])
                    ->visible(fn (Forms\Get $get): bool => $get('use_list_disc') === false)
                    ->helperText('Tambahkan item-item untuk list bullet points (legacy)')
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
                    ->label('Grid Layout')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'grid-cols-1' => '1 Kolom',
                        'grid-cols-2' => '2 Kolom',
                        'grid-cols-3' => '3 Kolom',
                        'grid-cols-4' => '4 Kolom',
                        default => $state,
                    })
                    ->color('info')
                    ->sortable(),

                Tables\Columns\IconColumn::make('use_list_disc')
                    ->label('List Bullet')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('background_color')
                    ->label('Background')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'bg-white' => 'Putih',
                        'bg-gray-50' => 'Abu-abu Muda',
                        'bg-blue-50' => 'Biru Muda',
                        'bg-green-50' => 'Hijau Muda',
                        'bg-yellow-50' => 'Kuning Muda',
                        'bg-purple-50' => 'Ungu Muda',
                        'bg-red-50' => 'Merah Muda',
                        default => $state,
                    })
                    ->sortable(),

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
                Tables\Filters\SelectFilter::make('grid_type')
                    ->label('Grid Layout')
                    ->options([
                        'grid-cols-1' => '1 Kolom',
                        'grid-cols-2' => '2 Kolom',
                        'grid-cols-3' => '3 Kolom',
                        'grid-cols-4' => '4 Kolom',
                    ]),
                Tables\Filters\TernaryFilter::make('use_list_disc')
                    ->label('Menggunakan List Bullet'),
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
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
            'index' => Pages\ListIPMContents::route('/'),
            'create' => Pages\CreateIPMContent::route('/create'),
            'edit' => Pages\EditIPMContent::route('/{record}/edit'),
        ];
    }
}

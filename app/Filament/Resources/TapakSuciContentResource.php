<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TapakSuciContentResource\Pages;
use App\Models\TapakSuciContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TapakSuciContentResource extends Resource
{
    protected static ?string $model = TapakSuciContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    protected static ?string $navigationGroup = 'Profil Sekolah';

    protected static ?string $navigationLabel = 'Tapak Suci Konten';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->label('Judul')->required()->maxLength(255),
                Forms\Components\RichEditor::make('content')->label('Konten')->columnSpanFull()
                    ->fileAttachmentsDirectory('tapak-suci/content')
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsVisibility('public'),
                Forms\Components\Select::make('grid_type')
                    ->label('Tipe Grid')
                    ->options([
                        'grid-cols-1' => '1 Kolom',
                        'grid-cols-2' => '2 Kolom',
                        'grid-cols-3' => '3 Kolom',
                    ])->default('grid-cols-1'),
                Forms\Components\Toggle::make('use_list_disc')
                    ->label('Gunakan Struktur Bidang')
                    ->default(false)
                    ->helperText('Aktifkan untuk membuat struktur bidang dengan anggota')
                    ->live(),
                Forms\Components\Repeater::make('bidang_structure')
                    ->label('Struktur Bidang Kompleks')
                    ->schema([
                        Forms\Components\TextInput::make('bidang_name')->label('Nama Bidang')->required(),
                        Forms\Components\Repeater::make('members')
                            ->label('Anggota')
                            ->schema([
                                Forms\Components\TextInput::make('name')->label('Nama')->required(),
                                Forms\Components\TextInput::make('position')->label('Jabatan')->nullable(),
                            ])->defaultItems(0)->columns(2),
                    ])->defaultItems(0)->columns(1)
                    ->visible(fn (callable $get) => (bool) $get('use_list_disc')),
                Forms\Components\Repeater::make('list_items')
                    ->label('List Items (Legacy)')
                    ->schema([
                        Forms\Components\TextInput::make('item')->label('Item')->required(),
                    ])->defaultItems(0)->columns(1)
                    ->visible(fn (callable $get) => (bool) $get('use_list_disc')),
                Forms\Components\TextInput::make('background_color')->label('Warna Latar')->default('bg-white'),
                Forms\Components\TextInput::make('border_color')->label('Warna Border')->default('border-gray-200'),
                Forms\Components\TextInput::make('order_index')->label('Urutan')->numeric()->default(0)->required(),
                Forms\Components\Toggle::make('is_active')->label('Aktif')->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Judul')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('grid_type')->label('Grid'),
                Tables\Columns\TextColumn::make('order_index')->label('Urutan')->sortable(),
                Tables\Columns\IconColumn::make('is_active')->label('Status')->boolean(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')->label('Status Aktif'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTapakSuciContents::route('/'),
            'create' => Pages\CreateTapakSuciContent::route('/create'),
            'edit' => Pages\EditTapakSuciContent::route('/{record}/edit'),
        ];
    }
}
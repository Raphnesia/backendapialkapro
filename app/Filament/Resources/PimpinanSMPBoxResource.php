<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PimpinanSMPBoxResource\Pages;
use App\Models\PimpinanSMPBox;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;

class PimpinanSMPBoxResource extends Resource
{
    protected static ?string $model = PimpinanSMPBox::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $navigationLabel = 'Box Keunggulan Kepemimpinan';
    protected static ?string $modelLabel = 'Box Keunggulan';
    protected static ?string $pluralModelLabel = 'Box Keunggulan';
    protected static ?string $navigationGroup = 'Profil Sekolah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Box')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->required()
                            ->rows(3)
                            ->maxLength(500),
                        TextInput::make('icon')
                            ->label('Icon (Emoji)')
                            ->required()
                            ->maxLength(10)
                            ->helperText('Contoh: 👨‍💼, 🎓, 🤝'),
                        FileUpload::make('image')
                            ->label('Gambar')
                            ->image()
                            ->directory('pimpinan-smp-boxes')
                            ->maxSize(2048),
                    ])->columns(2),

                Section::make('Pengaturan')
                    ->schema([
                        Select::make('background_color')
                            ->label('Warna Background')
                            ->options([
                                'green-600' => 'Hijau (green-600)',
                                'green-700' => 'Hijau Tua (green-700)',
                                'blue-600' => 'Biru (blue-600)',
                                'blue-700' => 'Biru Tua (blue-700)',
                                'purple-600' => 'Ungu (purple-600)',
                                'purple-700' => 'Ungu Tua (purple-700)',
                            ])
                            ->default('green-600'),
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                        TextInput::make('order_index')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('icon')
                    ->label('Icon')
                    ->size('lg'),
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->searchable(),
                ImageColumn::make('image')
                    ->label('Gambar')
                    ->circular(),
                TextColumn::make('background_color')
                    ->label('Warna Background')
                    ->badge(),
                TextColumn::make('order_index')
                    ->label('Urutan')
                    ->sortable(),
                ToggleColumn::make('is_active')
                    ->label('Status'),
            ])
            ->filters([
                SelectFilter::make('background_color')
                    ->label('Warna Background')
                    ->options([
                        'green-600' => 'Hijau (green-600)',
                        'green-700' => 'Hijau Tua (green-700)',
                        'blue-600' => 'Biru (blue-600)',
                        'blue-700' => 'Biru Tua (blue-700)',
                        'purple-600' => 'Ungu (purple-600)',
                        'purple-700' => 'Ungu Tua (purple-700)',
                    ]),
                SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([
                        1 => 'Aktif',
                        0 => 'Tidak Aktif',
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
            ->defaultSort('order_index')
            ->defaultSort('title');
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
            'index' => Pages\ListPimpinanSMPBoxes::route('/'),
            'create' => Pages\CreatePimpinanSMPBox::route('/create'),
            'edit' => Pages\EditPimpinanSMPBox::route('/{record}/edit'),
        ];
    }
}

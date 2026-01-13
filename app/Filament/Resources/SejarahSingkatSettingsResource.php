<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SejarahSingkatSettingsResource\Pages;
use App\Models\SejarahSingkatSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SejarahSingkatSettingsResource extends Resource
{
    protected static ?string $model = SejarahSingkatSettings::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Profil Sekolah';

    protected static ?string $navigationLabel = 'Pengaturan Sejarah Singkat';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Halaman')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Halaman')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: Sejarah SMP Muhammadiyah Al Kautsar PK Kartasura'),

                        Forms\Components\Textarea::make('subtitle')
                            ->label('Subtitle Halaman')
                            ->required()
                            ->rows(3)
                            ->placeholder('Contoh: Perjalanan panjang sekolah dalam membentuk generasi Islam berkualitas'),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Banner Images')
                    ->schema([
                        Forms\Components\FileUpload::make('banner_desktop')
                            ->label('Banner Desktop')
                            ->image()
                            ->imageEditor()
                            ->imageCropAspectRatio('16:9')
                            ->disk('public')
                            ->directory('sejarah-singkat')
                            ->helperText('Rasio 16:9, ukuran disarankan 1920x1080px')
                            ->placeholder('Upload banner untuk desktop'),

                        Forms\Components\FileUpload::make('banner_mobile')
                            ->label('Banner Mobile')
                            ->image()
                            ->imageEditor()
                            ->imageCropAspectRatio('16:9')
                            ->disk('public')
                            ->directory('sejarah-singkat')
                            ->helperText('Rasio 16:9, ukuran disarankan 800x450px')
                            ->placeholder('Upload banner untuk mobile'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Warna Panel')
                    ->schema([
                        Forms\Components\Select::make('title_panel_bg_color')
                            ->label('Warna Background Title Panel')
                            ->options([
                                'bg-green-500' => 'Hijau (Default)',
                                'bg-blue-500' => 'Biru',
                                'bg-red-500' => 'Merah',
                                'bg-yellow-500' => 'Kuning',
                                'bg-purple-500' => 'Ungu',
                                'bg-indigo-500' => 'Indigo',
                            ])
                            ->default('bg-green-500')
                            ->required(),

                        Forms\Components\Select::make('subtitle_panel_bg_color')
                            ->label('Warna Background Subtitle Panel')
                            ->options([
                                'bg-green-700' => 'Hijau Tua (Default)',
                                'bg-blue-700' => 'Biru Tua',
                                'bg-red-700' => 'Merah Tua',
                                'bg-yellow-700' => 'Kuning Tua',
                                'bg-purple-700' => 'Ungu Tua',
                                'bg-indigo-700' => 'Indigo Tua',
                            ])
                            ->default('bg-green-700')
                            ->required(),

                        Forms\Components\Select::make('mobile_panel_bg_color')
                            ->label('Warna Background Mobile Panel')
                            ->options([
                                'bg-green-600' => 'Hijau (Default)',
                                'bg-blue-600' => 'Biru',
                                'bg-red-600' => 'Merah',
                                'bg-yellow-600' => 'Kuning',
                                'bg-purple-600' => 'Ungu',
                                'bg-indigo-600' => 'Indigo',
                            ])
                            ->default('bg-green-600')
                            ->required(),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Status')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true)
                            ->helperText('Nonaktifkan untuk menyembunyikan dari tampilan'),
                    ])
                    ->columns(1),
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

                Tables\Columns\TextColumn::make('subtitle')
                    ->label('Subtitle')
                    ->limit(50)
                    ->searchable(),

                Tables\Columns\ImageColumn::make('banner_desktop')
                    ->label('Banner Desktop')
                    ->circular()
                    ->size(40),

                Tables\Columns\ImageColumn::make('banner_mobile')
                    ->label('Banner Mobile')
                    ->circular()
                    ->size(40),

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
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListSejarahSingkatSettings::route('/'),
            'create' => Pages\CreateSejarahSingkatSettings::route('/create'),
            'edit' => Pages\EditSejarahSingkatSettings::route('/{record}/edit'),
        ];
    }
}

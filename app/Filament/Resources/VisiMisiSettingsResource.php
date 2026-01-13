<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisiMisiSettingsResource\Pages;
use App\Models\VisiMisiSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VisiMisiSettingsResource extends Resource
{
    protected static ?string $model = VisiMisiSettings::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Profil Sekolah';

    protected static ?string $navigationLabel = 'Pengaturan Visi Misi';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul Halaman')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Contoh: Visi & Misi SMP Muhammadiyah Al Kautsar PK Kartasura'),

                Forms\Components\Textarea::make('subtitle')
                    ->label('Subtitle')
                    ->required()
                    ->maxLength(500)
                    ->placeholder('Contoh: Arah dan tujuan pendidikan Islam berkualitas'),

                Forms\Components\Section::make('Banner Images')
                    ->schema([
                        Forms\Components\FileUpload::make('banner_desktop')
                            ->label('Banner Desktop')
                            ->image()
                            ->imageEditor()
                            ->imageCropAspectRatio('16:9')
                            ->disk('public')
                            ->directory('visi-misi')
                            ->helperText('Rasio 16:9, ukuran disarankan 1920x1080px')
                            ->placeholder('Upload banner untuk desktop'),

                        Forms\Components\FileUpload::make('banner_mobile')
                            ->label('Banner Mobile')
                            ->image()
                            ->imageEditor()
                            ->imageCropAspectRatio('16:9')
                            ->disk('public')
                            ->directory('visi-misi')
                            ->helperText('Rasio 16:9, ukuran disarankan 800x450px')
                            ->placeholder('Upload banner untuk mobile'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Panel Colors')
                    ->schema([
                        Forms\Components\Select::make('title_panel_bg_color')
                            ->label('Warna Background Title Panel')
                            ->options([
                                'bg-green-500' => 'Hijau',
                                'bg-blue-500' => 'Biru',
                                'bg-red-500' => 'Merah',
                                'bg-yellow-500' => 'Kuning',
                                'bg-purple-500' => 'Ungu',
                                'bg-gray-500' => 'Abu-abu',
                            ])
                            ->default('bg-green-500')
                            ->required(),

                        Forms\Components\Select::make('subtitle_panel_bg_color')
                            ->label('Warna Background Subtitle Panel')
                            ->options([
                                'bg-green-700' => 'Hijau Gelap',
                                'bg-blue-700' => 'Biru Gelap',
                                'bg-red-700' => 'Merah Gelap',
                                'bg-yellow-700' => 'Kuning Gelap',
                                'bg-purple-700' => 'Ungu Gelap',
                                'bg-gray-700' => 'Abu-abu Gelap',
                            ])
                            ->default('bg-green-700')
                            ->required(),

                        Forms\Components\Select::make('mobile_panel_bg_color')
                            ->label('Warna Background Mobile Panel')
                            ->options([
                                'bg-green-700' => 'Hijau Gelap',
                                'bg-blue-700' => 'Biru Gelap',
                                'bg-red-700' => 'Merah Gelap',
                                'bg-yellow-700' => 'Kuning Gelap',
                                'bg-purple-700' => 'Ungu Gelap',
                                'bg-gray-700' => 'Abu-abu Gelap',
                            ])
                            ->default('bg-green-700')
                            ->required(),
                    ])
                    ->columns(3),

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
                    ->sortable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('subtitle')
                    ->label('Subtitle')
                    ->searchable()
                    ->limit(50),

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
            'index' => Pages\ListVisiMisiSettings::route('/'),
            'create' => Pages\CreateVisiMisiSettings::route('/create'),
            'edit' => Pages\EditVisiMisiSettings::route('/{record}/edit'),
        ];
    }
}

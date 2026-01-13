<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StrukturOrganisasiSettingsResource\Pages;
use App\Filament\Resources\StrukturOrganisasiSettingsResource\RelationManagers;
use App\Models\StrukturOrganisasiSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StrukturOrganisasiSettingsResource extends Resource
{
    protected static ?string $model = StrukturOrganisasiSettings::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationGroup = 'Profil Sekolah';

    protected static ?string $navigationLabel = 'Pengaturan Struktur Organisasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul Halaman')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Masukkan judul halaman struktur organisasi'),

                Forms\Components\Textarea::make('subtitle')
                    ->label('Subtitle')
                    ->rows(3)
                    ->maxLength(500)
                    ->placeholder('Masukkan subtitle halaman'),

                Forms\Components\FileUpload::make('banner_desktop')
                    ->label('Banner Desktop')
                    ->image()
                    ->imageEditor()
                    ->imageCropAspectRatio('16:9')
                    ->disk('public')
                    ->directory('struktur-organisasi')
                    ->helperText('Rasio 16:9, ukuran disarankan 1920x1080px')
                    ->placeholder('Upload banner untuk desktop'),

                Forms\Components\FileUpload::make('banner_mobile')
                    ->label('Banner Mobile')
                    ->image()
                    ->imageEditor()
                    ->imageCropAspectRatio('16:9')
                    ->disk('public')
                    ->directory('struktur-organisasi')
                    ->helperText('Rasio 16:9, ukuran disarankan 1920x1080px')
                    ->placeholder('Upload banner untuk mobile'),

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

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->helperText('Aktifkan untuk menampilkan pengaturan ini'),
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

                Tables\Columns\TextColumn::make('subtitle')
                    ->label('Subtitle')
                    ->limit(50)
                    ->searchable(),

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
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListStrukturOrganisasiSettings::route('/'),
            'create' => Pages\CreateStrukturOrganisasiSettings::route('/create'),
            'edit' => Pages\EditStrukturOrganisasiSettings::route('/{record}/edit'),
        ];
    }
}

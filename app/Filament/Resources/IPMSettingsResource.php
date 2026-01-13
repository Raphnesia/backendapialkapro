<?php

namespace App\Filament\Resources;

use App\Filament\Resources\IPMSettingsResource\Pages;
use App\Filament\Resources\IPMSettingsResource\RelationManagers;
use App\Models\IPMSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IPMSettingsResource extends Resource
{
    protected static ?string $model = IPMSettings::class;

    protected static ?string $navigationIcon = 'heroicon-o-flag';

    protected static ?string $navigationGroup = 'Profil Sekolah';

    protected static ?string $navigationLabel = 'Pengaturan IPM';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul Halaman')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Masukkan judul halaman IPM'),

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
                    ->directory('ipm')
                    ->helperText('Rasio 16:9, ukuran disarankan 1920x1080px')
                    ->placeholder('Upload banner untuk desktop'),

                Forms\Components\FileUpload::make('banner_mobile')
                    ->label('Banner Mobile')
                    ->image()
                    ->imageEditor()
                    ->imageCropAspectRatio('16:9')
                    ->disk('public')
                    ->directory('ipm')
                    ->helperText('Rasio 16:9, ukuran disarankan 1920x1080px')
                    ->placeholder('Upload banner untuk mobile'),

                Forms\Components\Select::make('title_panel_bg_color')
                    ->label('Warna Background Title Panel')
                    ->options([
                        'bg-gradient-to-r from-red-600 to-red-800' => 'Merah Gradient',
                        'bg-gradient-to-r from-blue-600 to-blue-800' => 'Biru Gradient',
                        'bg-gradient-to-r from-green-600 to-green-800' => 'Hijau Gradient',
                        'bg-gradient-to-r from-purple-600 to-purple-800' => 'Ungu Gradient',
                        'bg-gradient-to-r from-yellow-600 to-yellow-800' => 'Kuning Gradient',
                        'bg-gradient-to-r from-gray-600 to-gray-800' => 'Abu-abu Gradient',
                    ])
                    ->default('bg-gradient-to-r from-red-600 to-red-800')
                    ->required(),

                Forms\Components\Select::make('subtitle_panel_bg_color')
                    ->label('Warna Background Subtitle Panel')
                    ->options([
                        'bg-gradient-to-r from-red-700 to-red-900' => 'Merah Gelap Gradient',
                        'bg-gradient-to-r from-blue-700 to-blue-900' => 'Biru Gelap Gradient',
                        'bg-gradient-to-r from-green-700 to-green-900' => 'Hijau Gelap Gradient',
                        'bg-gradient-to-r from-purple-700 to-purple-900' => 'Ungu Gelap Gradient',
                        'bg-gradient-to-r from-yellow-700 to-yellow-900' => 'Kuning Gelap Gradient',
                        'bg-gradient-to-r from-gray-700 to-gray-900' => 'Abu-abu Gelap Gradient',
                    ])
                    ->default('bg-gradient-to-r from-red-700 to-red-900')
                    ->required(),

                Forms\Components\Select::make('mobile_panel_bg_color')
                    ->label('Warna Background Mobile Panel')
                    ->options([
                        'bg-gradient-to-r from-red-700 to-red-800' => 'Merah Medium Gradient',
                        'bg-gradient-to-r from-blue-700 to-blue-800' => 'Biru Medium Gradient',
                        'bg-gradient-to-r from-green-700 to-green-800' => 'Hijau Medium Gradient',
                        'bg-gradient-to-r from-purple-700 to-purple-800' => 'Ungu Medium Gradient',
                        'bg-gradient-to-r from-yellow-700 to-yellow-800' => 'Kuning Medium Gradient',
                        'bg-gradient-to-r from-gray-700 to-gray-800' => 'Abu-abu Medium Gradient',
                    ])
                    ->default('bg-gradient-to-r from-red-700 to-red-800')
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
            'index' => Pages\ListIPMSettings::route('/'),
            'create' => Pages\CreateIPMSettings::route('/create'),
            'edit' => Pages\EditIPMSettings::route('/{record}/edit'),
        ];
    }
}

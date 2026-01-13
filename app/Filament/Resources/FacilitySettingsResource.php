<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FacilitySettingsResource\Pages;
use App\Models\FacilitySettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FacilitySettingsResource extends Resource
{
    protected static ?string $model = FacilitySettings::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Fasilitas';

    protected static ?string $navigationLabel = 'Pengaturan Fasilitas';

    protected static ?string $modelLabel = 'Pengaturan Fasilitas';

    protected static ?string $pluralModelLabel = 'Pengaturan Fasilitas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul Halaman')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Masukkan judul halaman fasilitas'),

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
                    ->directory('facilities')
                    ->helperText('Rasio 16:9, ukuran disarankan 1920x1080px')
                    ->placeholder('Upload banner untuk desktop'),

                Forms\Components\FileUpload::make('banner_mobile')
                    ->label('Banner Mobile')
                    ->image()
                    ->imageEditor()
                    ->imageCropAspectRatio('16:9')
                    ->disk('public')
                    ->directory('facilities')
                    ->helperText('Rasio 16:9, ukuran disarankan 1920x1080px')
                    ->placeholder('Upload banner untuk mobile'),

                Forms\Components\Select::make('title_panel_bg_color')
                    ->label('Warna Background Title Panel')
                    ->options([
                        'bg-green-400' => 'Hijau',
                        'bg-blue-400' => 'Biru',
                        'bg-red-400' => 'Merah',
                        'bg-yellow-400' => 'Kuning',
                        'bg-purple-400' => 'Ungu',
                        'bg-gray-400' => 'Abu-abu',
                    ])
                    ->default('bg-green-400')
                    ->required(),

                Forms\Components\Select::make('subtitle_panel_bg_color')
                    ->label('Warna Background Subtitle Panel')
                    ->options([
                        'bg-blue-600' => 'Biru',
                        'bg-green-600' => 'Hijau',
                        'bg-red-600' => 'Merah',
                        'bg-yellow-600' => 'Kuning',
                        'bg-purple-600' => 'Ungu',
                        'bg-gray-600' => 'Abu-abu',
                    ])
                    ->default('bg-blue-600')
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
            'index' => Pages\ListFacilitySettings::route('/'),
            'create' => Pages\CreateFacilitySettings::route('/create'),
            'edit' => Pages\EditFacilitySettings::route('/{record}/edit'),
        ];
    }
} 
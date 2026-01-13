<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HisbulWathanSettingsResource\Pages;
use App\Models\HisbulWathanSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HisbulWathanSettingsResource extends Resource
{
    protected static ?string $model = HisbulWathanSettings::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationGroup = 'Profil Sekolah';

    protected static ?string $navigationLabel = 'Pengaturan Hisbul Wathan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->label('Judul Halaman')->required()->maxLength(255),
                Forms\Components\Textarea::make('subtitle')->label('Subtitle')->rows(3)->maxLength(500),
                Forms\Components\FileUpload::make('banner_desktop')
                    ->label('Banner Desktop')
                    ->image()->imageEditor()->imageCropAspectRatio('16:9')
                    ->disk('public')->directory('hisbul-wathan'),
                Forms\Components\FileUpload::make('banner_mobile')
                    ->label('Banner Mobile')
                    ->image()->imageEditor()->imageCropAspectRatio('16:9')
                    ->disk('public')->directory('hisbul-wathan'),
                Forms\Components\Select::make('title_panel_bg_color')
                    ->label('Warna Background Title Panel')
                    ->options([
                        'bg-gradient-to-r from-green-600 to-green-800' => 'Hijau',
                        'bg-gradient-to-r from-blue-600 to-blue-800' => 'Biru',
                        'bg-gradient-to-r from-gray-600 to-gray-800' => 'Abu-abu',
                    ])->default('bg-gradient-to-r from-green-600 to-green-800')->required(),
                Forms\Components\Select::make('subtitle_panel_bg_color')
                    ->label('Warna Background Subtitle Panel')
                    ->options([
                        'bg-gradient-to-r from-green-700 to-green-900' => 'Hijau Gelap',
                        'bg-gradient-to-r from-blue-700 to-blue-900' => 'Biru Gelap',
                        'bg-gradient-to-r from-gray-700 to-gray-900' => 'Abu-abu Gelap',
                    ])->default('bg-gradient-to-r from-green-700 to-green-900')->required(),
                Forms\Components\Select::make('mobile_panel_bg_color')
                    ->label('Warna Background Mobile Panel')
                    ->options([
                        'bg-gradient-to-r from-green-700 to-green-800' => 'Hijau',
                        'bg-gradient-to-r from-blue-700 to-blue-800' => 'Biru',
                        'bg-gradient-to-r from-gray-700 to-gray-800' => 'Abu-abu',
                    ])->default('bg-gradient-to-r from-green-700 to-green-800')->required(),
                Forms\Components\Toggle::make('is_active')->label('Aktif')->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Judul')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('subtitle')->label('Subtitle')->limit(50)->searchable(),
                Tables\Columns\IconColumn::make('is_active')->label('Status')->boolean()->sortable(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')->label('Status Aktif'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHisbulWathanSettings::route('/'),
            'create' => Pages\CreateHisbulWathanSettings::route('/create'),
            'edit' => Pages\EditHisbulWathanSettings::route('/{record}/edit'),
        ];
    }
} 
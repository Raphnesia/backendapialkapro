<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrestasiSettingsResource\Pages;
use App\Models\PrestasiSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PrestasiSettingsResource extends Resource
{
    protected static ?string $model = PrestasiSettings::class;

    protected static ?string $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $navigationGroup = 'Profil Sekolah';

    protected static ?string $navigationLabel = 'Pengaturan Prestasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\ColorPicker::make('hero_bg_from')->label('Hero BG From')->default('#d1fae5'),
                Forms\Components\ColorPicker::make('hero_bg_via')->label('Hero BG Via')->default('#eff6ff'),
                Forms\Components\ColorPicker::make('hero_bg_to')->label('Hero BG To')->default('#bbf7d0'),
                Forms\Components\TextInput::make('badge_text')->label('Badge Text')->default('SMP Muhammadiyah Al Kautsar')->required(),
                Forms\Components\Toggle::make('is_active')->label('Aktif')->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('badge_text')->label('Badge Text')->searchable(),
                Tables\Columns\IconColumn::make('is_active')->label('Status')->boolean()->sortable(),
                Tables\Columns\TextColumn::make('updated_at')->label('Diperbarui')->dateTime()->sortable(),
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
            'index' => Pages\ListPrestasiSettings::route('/'),
            'create' => Pages\CreatePrestasiSettings::route('/create'),
            'edit' => Pages\EditPrestasiSettings::route('/{record}/edit'),
        ];
    }
} 
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

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Pengaturan Prestasi';

    protected static ?string $modelLabel = 'Pengaturan Prestasi';

    protected static ?string $pluralModelLabel = 'Pengaturan Prestasi';

    protected static ?string $navigationGroup = 'Pengaturan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('main_heading')
                    ->label('Judul Utama')
                    ->default('Prestasi Sekolah')
                    ->required(),
                Forms\Components\ColorPicker::make('hero_background_color')
                    ->label('Warna Background Hero')
                    ->default('#1e40af'),
                Forms\Components\ColorPicker::make('hero_text_color')
                    ->label('Warna Teks Hero')
                    ->default('#ffffff'),
                Forms\Components\ColorPicker::make('floating_elements_bg_color')
                    ->label('Warna Background Floating Elements')
                    ->default('#fbbf24'),
                Forms\Components\ColorPicker::make('floating_elements_text_color')
                    ->label('Warna Teks Floating Elements')
                    ->default('#ffffff'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('main_heading')
                    ->label('Judul Utama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('hero_background_color')
                    ->label('Warna Background')
                    ->badge(),
                Tables\Columns\TextColumn::make('hero_text_color')
                    ->label('Warna Teks')
                    ->badge(),
                Tables\Columns\TextColumn::make('floating_elements_bg_color')
                    ->label('Warna Background Floating')
                    ->badge(),
                Tables\Columns\TextColumn::make('floating_elements_text_color')
                    ->label('Warna Teks Floating')
                    ->badge(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Update')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
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
            'index' => Pages\ListPrestasiSettings::route('/'),
            'create' => Pages\CreatePrestasiSettings::route('/create'),
            'edit' => Pages\EditPrestasiSettings::route('/{record}/edit'),
        ];
    }
} 
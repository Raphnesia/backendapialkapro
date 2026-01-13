<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PimpinanSMPSettingsResource\Pages;
use App\Models\PimpinanSMPSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;

class PimpinanSMPSettingsResource extends Resource
{
    protected static ?string $model = PimpinanSMPSettings::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Pengaturan Pimpinan SMP';
    protected static ?string $modelLabel = 'Pengaturan Pimpinan SMP';
    protected static ?string $pluralModelLabel = 'Pengaturan Pimpinan SMP';
    protected static ?string $navigationGroup = 'Profil Sekolah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Halaman')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Halaman')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('subtitle')
                            ->label('Subtitle Halaman')
                            ->required()
                            ->rows(3)
                            ->maxLength(500),
                    ])->columns(2),

                Section::make('Banner Images')
                    ->schema([
                        FileUpload::make('banner_desktop')
                            ->label('Banner Desktop')
                            ->image()
                            ->directory('pimpinan-smp-settings')
                            ->maxSize(2048),
                        FileUpload::make('banner_mobile')
                            ->label('Banner Mobile')
                            ->image()
                            ->directory('pimpinan-smp-settings')
                            ->maxSize(2048),
                    ])->columns(2),

                Section::make('Keunggulan Kepemimpinan')
                    ->schema([
                        TextInput::make('keunggulan_title')
                            ->label('Judul Section Keunggulan')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('keunggulan_subtitle')
                            ->label('Subtitle Section Keunggulan')
                            ->required()
                            ->rows(3)
                            ->maxLength(500),
                    ])->columns(2),

                Section::make('Status')
                    ->schema([
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul Halaman')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('subtitle')
                    ->label('Subtitle Halaman')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('keunggulan_title')
                    ->label('Judul Keunggulan')
                    ->searchable(),
                ImageColumn::make('banner_desktop')
                    ->label('Banner Desktop'),
                ImageColumn::make('banner_mobile')
                    ->label('Banner Mobile'),
                ToggleColumn::make('is_active')
                    ->label('Status'),
            ])
            ->filters([
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
            ->defaultSort('id');
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
            'index' => Pages\ListPimpinanSMPSettings::route('/'),
            'create' => Pages\CreatePimpinanSMPSettings::route('/create'),
            'edit' => Pages\EditPimpinanSMPSettings::route('/{record}/edit'),
        ];
    }
}

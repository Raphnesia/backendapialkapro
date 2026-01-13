<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolActivitySettingsResource\Pages;
use App\Models\SchoolActivitySettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SchoolActivitySettingsResource extends Resource
{
    protected static ?string $model = SchoolActivitySettings::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationGroup = 'Kegiatan';

    protected static ?string $navigationLabel = 'Pengaturan Kegiatan';

    protected static ?string $modelLabel = 'Pengaturan Kegiatan';

    protected static ?string $pluralModelLabel = 'Pengaturan Kegiatan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul Halaman')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Masukkan judul halaman Kegiatan Sekolah'),

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
                    ->directory('activities')
                    ->helperText('Rasio 16:9, disarankan 1920x1080px'),

                Forms\Components\FileUpload::make('banner_mobile')
                    ->label('Banner Mobile')
                    ->image()
                    ->imageEditor()
                    ->imageCropAspectRatio('9:16')
                    ->disk('public')
                    ->directory('activities')
                    ->helperText('Rasio 9:16, disarankan 1080x1920px'),

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
            'index' => Pages\ListSchoolActivitySettings::route('/'),
            'create' => Pages\CreateSchoolActivitySettings::route('/create'),
            'edit' => Pages\EditSchoolActivitySettings::route('/{record}/edit'),
        ];
    }
} 
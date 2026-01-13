<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfileSectionResource\Pages;
use App\Models\ProfileSection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;

class ProfileSectionResource extends Resource
{
    protected static ?string $model = ProfileSection::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';
    protected static ?string $navigationLabel = 'Profil Sekolah';
    protected static ?string $modelLabel = 'Profil';
    protected static ?string $pluralModelLabel = 'Profil Sekolah';
    protected static ?string $navigationGroup = 'Profil';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Konten Profil')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Profil')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('subtitle')
                            ->label('Sub Judul')
                            ->maxLength(255),
                        Select::make('icon')
                            ->label('Ikon')
                            ->options([
                                'academic-cap' => 'Guru & Staff',
                                'building-office' => 'Sejarah',
                                'eye' => 'Visi & Misi',
                                'chart-bar' => 'Struktur Organisasi',
                                'document-text' => 'IPM',
                                'puzzle-piece' => 'Ekstrakurikuler',
                                'user-group' => 'Pimpinan',
                                'book-open' => 'Kurikulum',
                                'cog' => 'Sistem',
                                'star' => 'Prestasi',
                            ])
                            ->default('academic-cap'),
                        FileUpload::make('image')
                            ->label('Gambar Profil')
                            ->image()
                            ->directory('profile-sections')
                            ->maxSize(2048),
                        RichEditor::make('content')
                            ->label('Konten Profil')
                            ->required()
                            ->columnSpanFull()
                            ->fileAttachmentsDirectory('profile-sections'),
                    ])->columns(2),

                Section::make('Pengaturan')
                    ->schema([
                        TextInput::make('order_index')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0)
                            ->required(),
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
                TextColumn::make('order_index')
                    ->label('Urutan')
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->limit(50),
                TextColumn::make('subtitle')
                    ->label('Sub Judul')
                    ->searchable()
                    ->limit(30),
                TextColumn::make('icon')
                    ->label('Ikon')
                    ->badge(),
                ImageColumn::make('image')
                    ->label('Gambar')
                    ->circular(),
                ToggleColumn::make('is_active')
                    ->label('Status'),
            ])
            ->filters([
                SelectFilter::make('icon')
                    ->label('Ikon')
                    ->options([
                        'academic-cap' => 'Guru & Staff',
                        'building-office' => 'Sejarah',
                        'eye' => 'Visi & Misi',
                        'chart-bar' => 'Struktur Organisasi',
                        'document-text' => 'IPM',
                        'puzzle-piece' => 'Ekstrakurikuler',
                        'user-group' => 'Pimpinan',
                        'book-open' => 'Kurikulum',
                        'cog' => 'Sistem',
                        'star' => 'Prestasi',
                    ]),
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
            ->defaultSort('order_index');
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
            'index' => Pages\ListProfileSections::route('/'),
            'create' => Pages\CreateProfileSection::route('/create'),
            'edit' => Pages\EditProfileSection::route('/{record}/edit'),
        ];
    }
}
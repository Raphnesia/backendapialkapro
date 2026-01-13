<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfilSettingsResource\Pages;
use App\Models\ProfilSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProfilSettingsResource extends Resource
{
    protected static ?string $model = ProfilSettings::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationLabel = 'Profil Settings';
    protected static ?string $navigationGroup = 'Profile Management';
    protected static ?string $modelLabel = 'Profil Settings';
    protected static ?string $pluralModelLabel = 'Profil Settings';

    public static function canCreate(): bool
    {
        return ProfilSettings::query()->count() === 0;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Banner Settings')
                    ->description('Pengaturan banner utama untuk halaman Profil')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul Banner')
                            ->default('Profil SMP Muhammadiyah Al Kautsar PK Kartasura')
                            ->required(),
                        Forms\Components\Textarea::make('subtitle')
                            ->label('Subtitle Banner')
                            ->default('Informasi lengkap tentang sekolah kami')
                            ->required(),
                        Forms\Components\FileUpload::make('banner_desktop')
                            ->label('Banner Desktop')
                            ->image()
                            ->imageEditor()
                            ->directory('profil/banners')
                            ->visibility('public')
                            ->maxSize(10240) // 10MB
                            ->required(),
                        Forms\Components\FileUpload::make('banner_mobile')
                            ->label('Banner Mobile')
                            ->image()
                            ->imageEditor()
                            ->directory('profil/banners')
                            ->visibility('public')
                            ->maxSize(10240) // 10MB
                            ->required(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Content Settings')
                    ->description('Pengaturan konten halaman profil')
                    ->schema([
                        Forms\Components\Textarea::make('description')
                            ->label('Deskripsi Profil')
                            ->default('SMP Muhammadiyah Al Kautsar PK Kartasura merupakan lembaga pendidikan yang berkomitmen untuk mengembangkan potensi peserta didik secara holistik, menggabungkan keunggulan akademik dengan nilai-nilai keislaman dan karakter yang kuat.')
                            ->rows(4),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('SEO Settings')
                    ->description('Pengaturan untuk Search Engine Optimization')
                    ->schema([
                        Forms\Components\Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->placeholder('Deskripsi untuk SEO - maksimal 160 karakter')
                            ->maxLength(160)
                            ->rows(2),
                        Forms\Components\TextInput::make('meta_keywords')
                            ->label('Meta Keywords')
                            ->placeholder('profil, smp, muhammadiyah, kartasura, sekolah')
                            ->helperText('Pisahkan dengan koma'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Status')
                    ->description('Pengaturan status aktif')
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->helperText('Jika tidak aktif, halaman profil akan menggunakan pengaturan default'),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('subtitle')
                    ->label('Subtitle')
                    ->limit(50),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Update')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                //
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
            'index' => Pages\ListProfilSettings::route('/'),
            'create' => Pages\CreateProfilSettings::route('/create'),
            'edit' => Pages\EditProfilSettings::route('/{record}/edit'),
        ];
    }
}

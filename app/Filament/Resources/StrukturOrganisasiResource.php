<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StrukturOrganisasiResource\Pages;
use App\Models\StrukturOrganisasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StrukturOrganisasiResource extends Resource
{
    protected static ?string $model = StrukturOrganisasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Profil Sekolah';

    protected static ?string $navigationLabel = 'Struktur Organisasi';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('position')
                    ->label('Jabatan')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Contoh: Kepala Sekolah, Wakil Kepala Sekolah, dll.'),

                Forms\Components\TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Masukkan nama lengkap'),

                Forms\Components\FileUpload::make('photo')
                    ->label('Foto')
                    ->image()
                    ->imageEditor()
                    ->imageCropAspectRatio('3:4')
                    ->disk('public')
                    ->directory('struktur-organisasi')
                    ->helperText('Rasio 3:4, ukuran disarankan 300x400px')
                    ->placeholder('Upload foto'),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->required()
                    ->maxLength(500)
                    ->placeholder('Masukkan deskripsi jabatan dan tanggung jawab'),

                Forms\Components\TextInput::make('order_index')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0)
                    ->required()
                    ->helperText('Angka kecil akan ditampilkan terlebih dahulu'),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->helperText('Nonaktifkan untuk menyembunyikan dari frontend'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('position')
                    ->label('Jabatan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular()
                    ->size(40),

                Tables\Columns\TextColumn::make('order_index')
                    ->label('Urutan')
                    ->sortable()
                    ->numeric(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

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
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('order_index', 'asc');
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
            'index' => Pages\ListStrukturOrganisasis::route('/'),
            'create' => Pages\CreateStrukturOrganisasi::route('/create'),
            'edit' => Pages\EditStrukturOrganisasi::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PimpinanSMPResource\Pages;
use App\Models\PimpinanSMP;
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
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;

class PimpinanSMPResource extends Resource
{
    protected static ?string $model = PimpinanSMP::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationLabel = 'Pimpinan SMP';
    protected static ?string $modelLabel = 'Pimpinan SMP';
    protected static ?string $pluralModelLabel = 'Pimpinan SMP';
    protected static ?string $navigationGroup = 'Profil Sekolah';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Dasar')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('type')
                            ->label('Jabatan (Tulis Sendiri)')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Contoh: Kepala Sekolah, Wakil Kepala Sekolah Kurikulum, Wakil Kepala Sekolah Kesiswaan, dll.')
                            ->placeholder('Masukkan jabatan sesuai keinginan'),
                        TextInput::make('position')
                            ->label('Jabatan Lengkap')
                            ->maxLength(255),
                        FileUpload::make('photo')
                            ->label('Foto')
                            ->image()
                            ->directory('pimpinan-smp')
                            ->maxSize(2048),
                    ])->columns(2),

                Section::make('Detail Informasi')
                    ->schema([
                        Textarea::make('bio')
                            ->label('Biografi')
                            ->rows(4)
                            ->maxLength(1000),
                        TextInput::make('education')
                            ->label('Pendidikan Terakhir')
                            ->maxLength(255),
                        Textarea::make('experience')
                            ->label('Pengalaman')
                            ->rows(3)
                            ->maxLength(1000),
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                        TextInput::make('order_index')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0),
                    ])->columns(2),

                Section::make('Banner Images')
                    ->schema([
                        FileUpload::make('banner_desktop')
                            ->label('Banner Desktop')
                            ->image()
                            ->directory('pimpinan-smp/banners')
                            ->maxSize(2048),
                        FileUpload::make('banner_mobile')
                            ->label('Banner Mobile')
                            ->image()
                            ->directory('pimpinan-smp/banners')
                            ->maxSize(2048),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular(),
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('type')
                    ->label('Jabatan')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('position')
                    ->label('Jabatan Lengkap')
                    ->searchable(),
                TextColumn::make('order_index')
                    ->label('Urutan')
                    ->sortable(),
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
            ->defaultSort('order_index')
            ->defaultSort('name');
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
            'index' => Pages\ListPimpinanSMPs::route('/'),
            'create' => Pages\CreatePimpinanSMP::route('/create'),
            'edit' => Pages\EditPimpinanSMP::route('/{record}/edit'),
        ];
    }
}

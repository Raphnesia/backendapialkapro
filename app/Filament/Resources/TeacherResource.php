<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherResource\Pages;
use App\Models\Teacher;
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

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationLabel = 'Daftar Guru & Staff';
    protected static ?string $modelLabel = 'Guru/Staff';
    protected static ?string $pluralModelLabel = 'Guru & Staff';
    protected static ?string $navigationGroup = 'Guru & Staff';

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
                        Select::make('type')
                            ->label('Tipe')
                            ->required()
                            ->options([
                                'teacher' => 'Guru',
                                'staff' => 'Staff/Tendik',
                                'principal' => 'Kepala Sekolah',
                                'vice_principal' => 'Wakil Kepala Sekolah',
                            ])
                            ->default('teacher'),
                        TextInput::make('position')
                            ->label('Jabatan')
                            ->maxLength(255),
                        TextInput::make('subject')
                            ->label('Mata Pelajaran')
                            ->maxLength(255)
                            ->nullable(),
                        FileUpload::make('photo')
                            ->label('Foto')
                            ->image()
                            ->directory('teachers')
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
                    ]),



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
                TextColumn::make('position')
                    ->label('Jabatan')
                    ->searchable(),
                TextColumn::make('subject')
                    ->label('Mata Pelajaran')
                    ->searchable(),
                TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'teacher' => 'info',
                        'staff' => 'warning',
                        'principal' => 'success',
                        'vice_principal' => 'primary',
                        default => 'gray',
                    }),
                TextColumn::make('order_index')
                    ->label('Urutan')
                    ->sortable(),
                ToggleColumn::make('is_active')
                    ->label('Status'),

            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Tipe')
                    ->options([
                        'teacher' => 'Guru',
                        'staff' => 'Staff/Tendik',
                        'principal' => 'Kepala Sekolah',
                        'vice_principal' => 'Wakil Kepala Sekolah',
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
            'index' => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'edit' => Pages\EditTeacher::route('/{record}/edit'),
        ];
    }
}
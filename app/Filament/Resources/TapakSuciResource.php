<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TapakSuciResource\Pages;
use App\Models\TapakSuci;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TapakSuciResource extends Resource
{
    protected static ?string $model = TapakSuci::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Profil Sekolah';

    protected static ?string $navigationLabel = 'Tapak Suci Pengurus';

    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('position')
                    ->label('Jabatan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('photo')
                    ->label('Foto')
                    ->disk('public')
                    ->directory('tapak-suci')
                    ->image()
                    ->imageEditor()
                    ->imageCropAspectRatio('3:4'),
                Forms\Components\TextInput::make('kelas')
                    ->label('Kelas')
                    ->required()
                    ->maxLength(50),
                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(3)
                    ->maxLength(500),
                Forms\Components\TextInput::make('order_index')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0)
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('position')->label('Jabatan')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('name')->label('Nama')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('kelas')->label('Kelas')->searchable()->sortable(),
                Tables\Columns\ImageColumn::make('photo')->label('Foto')->circular()->size(40),
                Tables\Columns\TextColumn::make('order_index')->label('Urutan')->sortable()->numeric(),
                Tables\Columns\IconColumn::make('is_active')->label('Status')->boolean(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')->label('Status Aktif'),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTapakSucis::route('/'),
            'create' => Pages\CreateTapakSuci::route('/create'),
            'edit' => Pages\EditTapakSuci::route('/{record}/edit'),
        ];
    }
} 
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EkstrakurikulerResource\Pages;
use App\Filament\Resources\EkstrakurikulerResource\RelationManagers;
use App\Models\Ekstrakurikuler;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EkstrakurikulerResource extends Resource
{
    protected static ?string $model = Ekstrakurikuler::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationGroup = 'Profil Sekolah';

    protected static ?string $navigationLabel = 'Ekstrakurikuler';

    protected static ?int $navigationSort = 9;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul Ekstrakurikuler')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Contoh: Sepak Bola, Tari Tradisional, Robotika'),

                Forms\Components\Textarea::make('excerpt')
                    ->label('Ringkasan')
                    ->rows(3)
                    ->maxLength(500)
                    ->placeholder('Ringkasan singkat tentang ekstrakurikuler ini'),

                Forms\Components\FileUpload::make('image')
                    ->label('Gambar')
                    ->image()
                    ->imageEditor()
                    ->imageCropAspectRatio('16:9')
                    ->disk('public')
                    ->directory('ekstrakurikuler')
                    ->helperText('Rasio 16:9, ukuran disarankan 800x450px')
                    ->placeholder('Upload gambar ekstrakurikuler'),

                Forms\Components\Select::make('category')
                    ->label('Kategori')
                    ->options([
                        'Olahraga' => 'Olahraga',
                        'Seni Budaya' => 'Seni Budaya',
                        'Teknologi' => 'Teknologi',
                    ])
                    ->required()
                    ->default('Olahraga'),

                Forms\Components\TextInput::make('jadwal')
                    ->label('Jadwal')
                    ->maxLength(255)
                    ->placeholder('Contoh: Jumat 13.00-15.00'),

                Forms\Components\TextInput::make('location')
                    ->label('Lokasi')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Contoh: Lapangan Sekolah, Aula, Lab Komputer'),

                Forms\Components\TextInput::make('pembina')
                    ->label('Pembina')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Nama pembina ekstrakurikuler'),

                Forms\Components\RichEditor::make('description')
                    ->label('Deskripsi')
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'strike',
                        'link',
                        'bulletList',
                        'orderedList',
                        'h2',
                        'h3',
                    ])
                    ->placeholder('Deskripsi lengkap ekstrakurikuler (opsional)'),

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
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Olahraga' => 'success',
                        'Seni Budaya' => 'warning',
                        'Teknologi' => 'info',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('jadwal')
                    ->label('Jadwal')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('location')
                    ->label('Lokasi')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('pembina')
                    ->label('Pembina')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\ImageColumn::make('image')
                    ->label('Gambar')
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
                Tables\Filters\SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'Olahraga' => 'Olahraga',
                        'Seni Budaya' => 'Seni Budaya',
                        'Teknologi' => 'Teknologi',
                    ]),
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
            'index' => Pages\ListEkstrakurikulers::route('/'),
            'create' => Pages\CreateEkstrakurikuler::route('/create'),
            'edit' => Pages\EditEkstrakurikuler::route('/{record}/edit'),
        ];
    }
}

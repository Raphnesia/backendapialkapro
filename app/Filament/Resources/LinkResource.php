<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LinkResource\Pages;
use App\Models\Link;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;

class LinkResource extends Resource
{
    protected static ?string $model = Link::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';
    protected static ?string $navigationLabel = 'Fitur & Tautan';
    protected static ?string $modelLabel = 'Tautan';
    protected static ?string $pluralModelLabel = 'Fitur & Tautan';
    protected static ?string $navigationGroup = 'Pengaturan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Tautan')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('url')
                            ->label('URL')
                            ->required()
                            ->url()
                            ->maxLength(500),
                        Select::make('category')
                            ->label('Kategori')
                            ->required()
                            ->options([
                                'social' => 'Media Sosial',
                                'external' => 'Tautan Eksternal',
                                'internal' => 'Tautan Internal',
                                'document' => 'Dokumen',
                                'app' => 'Aplikasi',
                                'other' => 'Lainnya',
                            ])
                            ->default('external'),
                        TextInput::make('icon')
                            ->label('Icon')
                            ->helperText('Contoh: heroicon-o-home, fab-facebook, fas-book')
                            ->maxLength(100),
                    ])->columns(2),

                Section::make('Pengaturan Tautan')
                    ->schema([
                        Select::make('target')
                            ->label('Target')
                            ->options([
                                '_blank' => 'Buka di Tab Baru',
                                '_self' => 'Buka di Tab Saat Ini',
                                '_parent' => 'Buka di Frame Induk',
                                '_top' => 'Buka di Jendela Penuh',
                            ])
                            ->default('_blank'),
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true),
                        TextInput::make('order_index')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0),
                        Textarea::make('description')
                            ->label('Deskripsi')
                            ->rows(3)
                            ->maxLength(500),
                    ])->columns(2),
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
                    ->limit(40),
                TextColumn::make('url')
                    ->label('URL')
                    ->limit(50)
                    ->url(fn (Link $record) => $record->url)
                    ->openUrlInNewTab(),
                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'social' => 'info',
                        'external' => 'warning',
                        'internal' => 'primary',
                        'document' => 'success',
                        'app' => 'purple',
                        default => 'gray',
                    }),
                TextColumn::make('target')
                    ->label('Target')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        '_blank' => 'success',
                        '_self' => 'info',
                        '_parent' => 'warning',
                        '_top' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('icon')
                    ->label('Icon')
                    ->limit(20),
                ToggleColumn::make('is_active')
                    ->label('Status'),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'social' => 'Media Sosial',
                        'external' => 'Tautan Eksternal',
                        'internal' => 'Tautan Internal',
                        'document' => 'Dokumen',
                        'app' => 'Aplikasi',
                        'other' => 'Lainnya',
                    ]),
                SelectFilter::make('target')
                    ->label('Target')
                    ->options([
                        '_blank' => 'Buka di Tab Baru',
                        '_self' => 'Buka di Tab Saat Ini',
                        '_parent' => 'Buka di Frame Induk',
                        '_top' => 'Buka di Jendela Penuh',
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
            'index' => Pages\ListLinks::route('/'),
            'create' => Pages\CreateLink::route('/create'),
            'edit' => Pages\EditLink::route('/{record}/edit'),
        ];
    }
}
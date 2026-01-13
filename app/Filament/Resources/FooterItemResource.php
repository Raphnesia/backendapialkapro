<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FooterItemResource\Pages;
use App\Models\FooterItem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Model;

class FooterItemResource extends Resource
{
    protected static ?string $model = FooterItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $navigationLabel = 'Footer';
    protected static ?string $modelLabel = 'Item Footer';
    protected static ?string $pluralModelLabel = 'Footer Items';
    protected static ?string $navigationGroup = 'Pengaturan';

    public static function canCreate(): bool
    {
        return true;
    }

    public static function canDelete(Model $record): bool
    {
        return true;
    }

    public static function canEdit(Model $record): bool
    {
        return true;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Item Footer')
                    ->schema([
                        TextInput::make('name')->label('Nama')->required()->maxLength(255),
                        TextInput::make('href')->label('URL')->required()->maxLength(500)->default('#'),
                        Select::make('target')->label('Target')
                            ->options([
                                '_self' => 'Tab Saat Ini',
                                '_blank' => 'Tab Baru',
                            ])->default('_self'),
                        Select::make('category')->label('Kategori')
                            ->options([
                                'menu-utama' => 'Menu Utama',
                                'informasi-akademik' => 'Informasi Akademik',
                                'sosial' => 'Media Sosial',
                                'lainnya' => 'Lainnya',
                            ])->default('menu-utama'),
                        TextInput::make('order_index')->label('Urutan')->numeric()->default(0),
                        Toggle::make('is_active')->label('Aktif')->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_index')->label('Urutan')->sortable(),
                TextColumn::make('name')->label('Nama')->searchable(),
                TextColumn::make('href')->label('URL')->limit(50)->url(fn (FooterItem $r) => $r->href)->openUrlInNewTab(),
                TextColumn::make('category')->label('Kategori')->badge(),
                ToggleColumn::make('is_active')->label('Aktif'),
            ])
            ->filters([
                SelectFilter::make('category')->label('Kategori')->options([
                    'menu-utama' => 'Menu Utama',
                    'informasi-akademik' => 'Informasi Akademik',
                    'sosial' => 'Media Sosial',
                    'lainnya' => 'Lainnya',
                ]),
                SelectFilter::make('is_active')->label('Status')->options([1=>'Aktif',0=>'Tidak Aktif']),
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
            ->defaultSort('order_index','asc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFooterItems::route('/'),
            'create' => Pages\CreateFooterItem::route('/create'),
            'edit' => Pages\EditFooterItem::route('/{record}/edit'),
        ];
    }
} 
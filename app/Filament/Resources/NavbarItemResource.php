<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NavbarItemResource\Pages;
use App\Models\NavbarItem;
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

class NavbarItemResource extends Resource
{
    protected static ?string $model = NavbarItem::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3';
    protected static ?string $navigationLabel = 'Navbar/Header';
    protected static ?string $modelLabel = 'Item Navbar';
    protected static ?string $pluralModelLabel = 'Navbar & Dropdown';
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
                Section::make('Item Navbar')
                    ->schema([
                        TextInput::make('name')->label('Nama')->required()->maxLength(255),
                        TextInput::make('href')->label('URL')->required()->maxLength(500)->default('#'),
                        Select::make('target')->label('Target')
                            ->options([
                                '_self' => 'Tab Saat Ini',
                                '_blank' => 'Tab Baru',
                            ])->default('_self'),
                        Select::make('parent_id')
                            ->label('Parent (Dropdown)')
                            ->relationship('parent', 'name')
                            ->searchable()
                            ->preload()
                            ->native(false),
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
                TextColumn::make('href')->label('URL')->limit(50)->url(fn (NavbarItem $r) => $r->href)->openUrlInNewTab(),
                TextColumn::make('parent.name')->label('Parent')->toggleable(isToggledHiddenByDefault: true),
                ToggleColumn::make('is_active')->label('Aktif'),
            ])
            ->filters([
                SelectFilter::make('parent_id')->label('Parent')
                    ->relationship('parent', 'name'),
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
            'index' => Pages\ListNavbarItems::route('/'),
            'create' => Pages\CreateNavbarItem::route('/create'),
            'edit' => Pages\EditNavbarItem::route('/{record}/edit'),
        ];
    }
} 
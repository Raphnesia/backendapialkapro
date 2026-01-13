<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MarqueeTextResource\Pages;
use App\Models\MarqueeText;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ColorPicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Filters\SelectFilter;

class MarqueeTextResource extends Resource
{
    protected static ?string $model = MarqueeText::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path';
    protected static ?string $navigationLabel = 'Marquee Header';
    protected static ?string $modelLabel = 'Teks Marquee';
    protected static ?string $pluralModelLabel = 'Teks Marquee Header';
    protected static ?string $navigationGroup = 'Pengaturan';

    public static function canCreate(): bool
    {
        return true;
    }

    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return true;
    }

    public static function canEdit(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return true;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Teks Marquee')
                    ->schema([
                        Textarea::make('text')
                            ->label('Teks')
                            ->required()
                            ->maxLength(500)
                            ->rows(3)
                            ->placeholder('Contoh: Mendidik dengan Hati, Membentuk Karakter Islami'),
                        TextInput::make('order_index')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0)
                            ->helperText('Urutan tampil teks marquee (0, 1, 2, ...)'),
                        ColorPicker::make('color')
                            ->label('Warna Teks')
                            ->default('#ffffff')
                            ->helperText('Warna teks marquee'),
                        Select::make('speed')
                            ->label('Kecepatan')
                            ->options([
                                'slow' => 'Lambat',
                                'normal' => 'Normal',
                                'fast' => 'Cepat',
                            ])
                            ->default('normal'),
                        Toggle::make('is_active')
                            ->label('Aktif')
                            ->default(true)
                            ->helperText('Aktifkan/nonaktifkan teks ini'),
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
                TextColumn::make('text')
                    ->label('Teks')
                    ->limit(50)
                    ->searchable(),
                ColorColumn::make('color')
                    ->label('Warna'),
                TextColumn::make('speed')
                    ->label('Kecepatan')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'slow' => 'gray',
                        'normal' => 'blue',
                        'fast' => 'green',
                    }),
                ToggleColumn::make('is_active')
                    ->label('Aktif'),
            ])
            ->filters([
                SelectFilter::make('speed')
                    ->label('Kecepatan')
                    ->options([
                        'slow' => 'Lambat',
                        'normal' => 'Normal',
                        'fast' => 'Cepat',
                    ]),
                SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([1 => 'Aktif', 0 => 'Tidak Aktif']),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMarqueeTexts::route('/'),
            'create' => Pages\CreateMarqueeText::route('/create'),
            'edit' => Pages\EditMarqueeText::route('/{record}/edit'),
        ];
    }
} 
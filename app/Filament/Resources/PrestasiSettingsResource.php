<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PrestasiSettingsResource\Pages;
use App\Models\PrestasiSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PrestasiSettingsResource extends Resource
{
    protected static ?string $model = PrestasiSettings::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?string $navigationLabel = 'Pengaturan Prestasi';

    protected static ?string $modelLabel = 'Pengaturan Prestasi';

    protected static ?string $pluralModelLabel = 'Pengaturan Prestasi';

    protected static ?string $navigationGroup = 'Pengaturan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('main_heading')
                    ->label('Judul Utama')
                    ->default('Prestasi Sekolah')
                    ->required(),
                Forms\Components\Textarea::make('hero_subtitle')
                    ->label('Subtitle Hero')
                    ->default('Siswa berprestasi dengan pencapaian luar biasa dan aktivasi instan bikin prestasi akademik dan non-akademik siap jalan bebas hambatan')
                    ->rows(3),
                Forms\Components\TextInput::make('badge_text')
                    ->label('Badge Text')
                    ->default('SMP Muhammadiyah Al Kautsar')
                    ->required(),
                Forms\Components\ColorPicker::make('hero_background_color')
                    ->label('Warna Background Hero')
                    ->default('#1e40af'),
                Forms\Components\ColorPicker::make('hero_text_color')
                    ->label('Warna Teks Hero')
                    ->default('#ffffff'),
                Forms\Components\ColorPicker::make('floating_elements_bg_color')
                    ->label('Warna Background Floating Elements')
                    ->default('#fbbf24'),
                Forms\Components\ColorPicker::make('floating_elements_text_color')
                    ->label('Warna Teks Floating Elements')
                    ->default('#ffffff'),
                Forms\Components\TagsInput::make('feature_lists')
                    ->label('Feature Lists (4 Item)')
                    ->default(['Prestasi Akademik Tinggi', 'Juara Olimpiade Nasional', 'Prestasi up to 150+ Penghargaan', 'Pengembangan Bakat Terpadu'])
                    ->placeholder('Tambah feature list')
                    ->helperText('Masukkan 4 fitur untuk ditampilkan di hero section'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('main_heading')
                    ->label('Judul Utama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('hero_subtitle')
                    ->label('Subtitle Hero')
                    ->limit(50)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 50) {
                            return null;
                        }
                        return $state;
                    }),
                Tables\Columns\TextColumn::make('badge_text')
                    ->label('Badge Text')
                    ->searchable(),
                Tables\Columns\TextColumn::make('hero_background_color')
                    ->label('Warna Background')
                    ->badge(),
                Tables\Columns\TextColumn::make('hero_text_color')
                    ->label('Warna Teks')
                    ->badge(),
                Tables\Columns\TextColumn::make('floating_elements_bg_color')
                    ->label('Warna Background Floating')
                    ->badge(),
                Tables\Columns\TextColumn::make('floating_elements_text_color')
                    ->label('Warna Teks Floating')
                    ->badge(),
                Tables\Columns\TextColumn::make('feature_lists')
    ->label('Feature Lists')
    ->formatStateUsing(function ($state): string {
        return is_array($state) ? count($state) . ' item(s)' : '1 item(s)';
    })
    ->tooltip(function ($column): ?string {
        $state = $column->getState();
        return is_array($state) ? implode(', ', $state) : (string) $state;
    }),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Update')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListPrestasiSettings::route('/'),
            'create' => Pages\CreatePrestasiSettings::route('/create'),
            'edit' => Pages\EditPrestasiSettings::route('/{record}/edit'),
        ];
    }
} 
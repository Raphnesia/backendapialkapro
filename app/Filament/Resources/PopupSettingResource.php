<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PopupSettingResource\Pages;
use App\Models\PopupSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PopupSettingResource extends Resource
{
    protected static ?string $model = PopupSetting::class;
    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Popup Settings';
    protected static ?int $navigationSort = 10;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Pengaturan Popup')->schema([
                Forms\Components\Toggle::make('is_active')
                    ->label('Aktifkan Popup')
                    ->default(true)
                    ->required(),
                
                Forms\Components\FileUpload::make('image_url')
                    ->label('Gambar Popup')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory('popup')
                    ->visibility('public')
                    ->maxSize(10240) // 10MB
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->helperText('Format: JPG, PNG, WebP. Maksimal 10MB')
                    ->required()
                    ->columnSpanFull(),
                
                Forms\Components\TextInput::make('image_alt')
                    ->label('Teks Alternatif Gambar')
                    ->helperText('Teks yang muncul jika gambar tidak dapat dimuat (untuk aksesibilitas)')
                    ->maxLength(255),
                
                Forms\Components\TextInput::make('link_url')
                    ->label('URL Link (Opsional)')
                    ->url()
                    ->helperText('URL yang akan dibuka ketika popup diklik. Kosongkan jika popup hanya untuk ditutup.')
                    ->maxLength(255),
                
                Forms\Components\Toggle::make('open_in_new_tab')
                    ->label('Buka Link di Tab Baru')
                    ->default(false)
                    ->helperText('Jika aktif, link akan dibuka di tab baru'),
                
                Forms\Components\Toggle::make('show_on_first_visit_only')
                    ->label('Tampilkan Hanya pada Kunjungan Pertama')
                    ->default(false)
                    ->helperText('Jika aktif, popup hanya akan muncul sekali per user (menggunakan localStorage)'),
                
                Forms\Components\TextInput::make('delay_before_show')
                    ->label('Delay Sebelum Muncul (ms)')
                    ->numeric()
                    ->default(0)
                    ->helperText('Delay dalam milliseconds sebelum popup muncul. Contoh: 1000 = 1 detik')
                    ->minValue(0),
                
                Forms\Components\DateTimePicker::make('expires_at')
                    ->label('Tanggal Kadaluarsa')
                    ->helperText('Tanggal dan waktu kapan popup akan berhenti ditampilkan. Kosongkan jika tidak ada batas waktu.')
                    ->timezone('Asia/Jakarta'),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('image_url')
                ->label('Gambar')
                ->circular()
                ->size(50),
            Tables\Columns\TextColumn::make('image_alt')
                ->label('Teks Alternatif')
                ->searchable()
                ->limit(30),
            Tables\Columns\IconColumn::make('is_active')
                ->label('Status')
                ->boolean(),
            Tables\Columns\TextColumn::make('link_url')
                ->label('Link')
                ->limit(30)
                ->default('-'),
            Tables\Columns\IconColumn::make('show_on_first_visit_only')
                ->label('Hanya Kunjungan Pertama')
                ->boolean(),
            Tables\Columns\TextColumn::make('delay_before_show')
                ->label('Delay (ms)')
                ->default(0),
            Tables\Columns\TextColumn::make('expires_at')
                ->label('Kadaluarsa')
                ->dateTime('d/m/Y H:i')
                ->default('-'),
            Tables\Columns\TextColumn::make('updated_at')
                ->label('Terakhir Diupdate')
                ->dateTime('d/m/Y H:i')
                ->sortable(),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->defaultSort('updated_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPopupSettings::route('/'),
            'create' => Pages\CreatePopupSetting::route('/create'),
            'edit' => Pages\EditPopupSetting::route('/{record}/edit'),
        ];
    }
}

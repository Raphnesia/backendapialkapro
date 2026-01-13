<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolActivityResource\Pages;
use App\Models\SchoolActivity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\RichEditor;

class SchoolActivityResource extends Resource
{
    protected static ?string $model = SchoolActivity::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Kegiatan Sekolah';
    protected static ?string $modelLabel = 'Kegiatan';
    protected static ?string $pluralModelLabel = 'Kegiatan Sekolah';
    protected static ?string $navigationGroup = 'Kegiatan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Kegiatan')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Kegiatan')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('excerpt')
                            ->label('Ringkasan')
                            ->rows(2)
                            ->maxLength(500)
                            ->helperText('Ringkasan singkat untuk ditampilkan di card'),
                        Select::make('category')
                            ->label('Kategori')
                            ->required()
                            ->options([
                                'Prestasi Akademik' => 'Prestasi Akademik',
                                'Ekstrakurikuler' => 'Ekstrakurikuler',
                                'Kegiatan Sosial' => 'Kegiatan Sosial',
                                'Kompetisi' => 'Kompetisi',
                            ])
                            ->default('Prestasi Akademik'),
                        Select::make('type')
                            ->label('Tipe Kegiatan')
                            ->required()
                            ->options([
                                'prestasi' => 'Prestasi',
                                'ekstrakurikuler' => 'Ekstrakurikuler',
                                'akademik' => 'Akademik',
                                'sosial' => 'Sosial',
                            ])
                            ->default('akademik'),
                        FileUpload::make('image')
                            ->label('Gambar Kegiatan')
                            ->image()
                            ->directory('activities')
                            ->maxSize(2048),
                        // Textarea::make('description')
                        //     ->label('Deskripsi')
                        //     ->rows(4)
                        //     ->maxLength(2000),
                        RichEditor::make('description')
                            ->label('Deskripsi')
                            ->columnSpanFull()
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('activities/descriptions'),
                    ])->columns(2),

                Section::make('Waktu & Lokasi')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                DatePicker::make('activity_date')
                                    ->label('Tanggal Kegiatan')
                                    ->required()
                                    ->default(now()),
                                DatePicker::make('date')
                                    ->label('Tanggal Publikasi')
                                    ->required()
                                    ->default(now())
                                    ->helperText('Tanggal yang ditampilkan di frontend'),
                                TimePicker::make('activity_time')
                                    ->label('Waktu Kegiatan')
                                    ->required()
                                    ->default('08:00'),
                                TextInput::make('location')
                                    ->label('Lokasi')
                                    ->maxLength(255)
                                    ->default('Sekolah'),
                                TextInput::make('author')
                                    ->label('Penulis')
                                    ->required()
                                    ->default('Tim Redaksi')
                                    ->maxLength(255),
                                TagsInput::make('participants')
                                    ->label('Peserta')
                                    ->placeholder('Tambahkan peserta'),
                            ]),
                    ]),

                Section::make('Pengaturan')
                    ->schema([
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
                ImageColumn::make('image')
                    ->label('Gambar')
                    ->circular(),
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Prestasi Akademik' => 'success',
                        'Ekstrakurikuler' => 'info',
                        'Kompetisi' => 'warning',
                        'Kegiatan Sosial' => 'primary',
                        default => 'gray',
                    }),
                TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'prestasi' => 'success',
                        'ekstrakurikuler' => 'info',
                        'akademik' => 'warning',
                        'sosial' => 'primary',
                        default => 'gray',
                    }),
                TextColumn::make('date')
                    ->label('Tanggal Publikasi')
                    ->date()
                    ->sortable(),
                TextColumn::make('activity_date')
                    ->label('Tanggal Kegiatan')
                    ->date()
                    ->sortable(),
                TextColumn::make('author')
                    ->label('Penulis')
                    ->searchable(),
                TextColumn::make('activity_time')
                    ->label('Waktu')
                    ->time('H:i'),
                TextColumn::make('location')
                    ->label('Lokasi')
                    ->searchable(),
                TextColumn::make('order_index')
                    ->label('Urutan')
                    ->sortable(),
                ToggleColumn::make('is_active')
                    ->label('Status'),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'academic' => 'Akademik',
                        'extracurricular' => 'Ekstrakurikuler',
                        'competition' => 'Kompetisi',
                        'workshop' => 'Workshop',
                        'seminar' => 'Seminar',
                        'ceremony' => 'Upacara',
                        'social' => 'Sosial',
                        'sports' => 'Olahraga',
                        'arts' => 'Seni',
                        'other' => 'Lainnya',
                    ]),
                SelectFilter::make('activity_date')
                    ->label('Tanggal')
                    ->form([
                        Forms\Components\DatePicker::make('from'),
                        Forms\Components\DatePicker::make('until'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['from'], fn ($query) => $query->whereDate('activity_date', '>=', $data['from']))
                            ->when($data['until'], fn ($query) => $query->whereDate('activity_date', '<=', $data['until']));
                    }),
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
            ->defaultSort('activity_date', 'desc');
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
            'index' => Pages\ListSchoolActivities::route('/'),
            'create' => Pages\CreateSchoolActivity::route('/create'),
            'edit' => Pages\EditSchoolActivity::route('/{record}/edit'),
        ];
    }
}
<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Actions\Action;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Berita & Artikel';
    protected static ?string $modelLabel = 'Berita/Artikel';
    protected static ?string $pluralModelLabel = 'Berita & Artikel';
    protected static ?string $navigationGroup = 'Konten';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Konten Utama')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255),
                        RichEditor::make('subtitle')
                            ->label('Subtitle')
                            ->required()
                            ->columnSpanFull()
                            ->fileAttachmentsDirectory('posts')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsVisibility('public'),
                        FileUpload::make('image')
                            ->label('Gambar Utama')
                            ->image()
                            ->directory('posts')
                            ->maxSize(2048),
                        FileUpload::make('author_image')
                            ->label('Gambar Author')
                            ->disk('public') // Gunakan public disk
                            ->directory('posts/author_images')
                            ->image()
                            ->maxSize(2048) // 2MB max
                            ->required()
                            ->columnSpanFull()
                            ->directory('posts/authors')
                            ->maxSize(1024)
                            ->helperText('Foto penulis artikel (opsional)'),
                    ])->columns(1),
                
                Section::make('Navigation Sections')
                    ->schema([
                        Repeater::make('navigation_sections')
                            ->label('Daftar Isi / Navigation')
                            ->helperText('Tambahkan judul-judul dalam berita untuk navigation sidebar. ID akan otomatis dibuat dari judul.')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Judul Section')
                                    ->required()
                                    ->placeholder('contoh: Apa itu Berbakti?')
                                    ->helperText('ID akan otomatis dibuat dari judul ini (contoh: "Apa itu Berbakti?" → "apa-itu-berbakti")'),
                                // Pada bagian navigation_sections, tambahkan ke RichEditor content
                                RichEditor::make('content')
                                    ->label('Isi Section')
                                    ->fileAttachmentsDirectory('posts/navigation')
                                    ->fileAttachmentsDisk('public')
                                    ->fileAttachmentsVisibility('public')
                                    ->columnSpanFull(),
                            ])
                            ->columns(1)
                            ->defaultItems(0)
                            ->collapsible()
                            ->reorderable()
                            ->cloneable()
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? 'Section baru'),
                    ])->columns(1),

                Section::make('Pengaturan')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Select::make('type')
                                    ->label('Tipe')
                                    ->required()
                                    ->options([
                                        'news' => 'Berita',
                                        'article' => 'Artikel',
                                        'announcement' => 'Pengumuman',
                                        'event' => 'Acara',
                                    ])
                                    ->default('news')
                                    ->live(), // tambahkan live agar bisa reactive
                                Select::make('category')
                                    ->label('Kategori')
                                    ->options([
                                        'academic' => 'Akademik',
                                        'achievement' => 'Prestasi',
                                        'activity' => 'Kegiatan',
                                        'announcement' => 'Pengumuman',
                                        'other' => 'Lainnya',
                                    ])
                                    ->searchable()
                                    ->visible(fn (callable $get) => $get('type') === 'article')
                                    ->default('other'),
                                DateTimePicker::make('published_at')
                                    ->label('Tanggal Terbit')
                                    ->required()
                                    ->default(now()),
                                TextInput::make('author')
                                    ->label('Penulis')
                                    ->required()
                                    ->default('Admin'),
                            ]),
                        Toggle::make('is_published')
                            ->label('Terbitkan')
                            ->default(true),
                        TagsInput::make('tags')
                            ->label('Tagar')
                            ->suggestions(['prestasi', 'ujian tahfidz', 'akademik', 'olahraga', 'seni'])
                            ->reorderable()
                            ->separator(','),
                        TextInput::make('meta_description')
                            ->label('Deskripsi Meta')
                            ->maxLength(160),
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
                ImageColumn::make('author_image')
                    ->label('Foto Penulis')
                    ->circular()
                    ->size(40),
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->limit(50),
                TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'news' => 'warning',
                        'article' => 'info',
                        'announcement' => 'danger',
                        'event' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'academic' => 'primary',
                        'achievement' => 'success',
                        'activity' => 'info',
                        'announcement' => 'warning',
                        'history' => 'seconday',
                        default => 'gray',
                    }),
                TextColumn::make('author')
                    ->label('Penulis')
                    ->searchable(),
                TextColumn::make('published_at')
                    ->label('Tanggal Terbit')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                ToggleColumn::make('is_published')
                    ->label('Status'),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('Tipe')
                    ->options([
                        'news' => 'Berita',
                        'article' => 'Artikel',
                        'announcement' => 'Pengumuman',
                        'event' => 'Acara',
                    ]),
                SelectFilter::make('category')
                    ->label('Kategori')
                    ->options([
                        'academic' => 'Akademik',
                        'achievement' => 'Prestasi',
                        'activity' => 'Kegiatan',
                        'announcement' => 'Pengumuman',
                        'history' => 'Sejarah',
                        'other' => 'Lainnya',
                    ]),
                Tables\Filters\Filter::make('published')
                    ->label('Terbit')
                    ->query(fn ($query) => $query->where('is_published', true)),
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
            ->defaultSort('published_at', 'desc');
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
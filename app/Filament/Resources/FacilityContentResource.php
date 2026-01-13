<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FacilityContentResource\Pages;
use App\Models\FacilityContent;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FacilityContentResource extends Resource
{
    protected static ?string $model = FacilityContent::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Fasilitas';

    protected static ?string $navigationLabel = 'Fasilitas Content';

    protected static ?string $modelLabel = 'Fasilitas Content';

    protected static ?string $pluralModelLabel = 'Fasilitas Content';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('section_title')
                    ->label('Judul Section')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Masukkan judul section'),

                Forms\Components\RichEditor::make('content')
                    ->label('Konten')
                    ->required()
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
                        'h4',
                        'blockquote',
                        'codeBlock',
                    ])
                    ->placeholder('Masukkan konten deskripsi fasilitas'),

                Forms\Components\Select::make('display_type')
                    ->label('Tipe Tampilan')
                    ->options([
                        'wysiwyg' => 'Rich Text (WYSIWYG)',
                        'simple_text' => 'Teks Sederhana',
                        'grid' => 'Grid Layout',
                    ])
                    ->default('wysiwyg')
                    ->required()
                    ->helperText('Pilih cara tampilan konten di frontend'),

                Forms\Components\Toggle::make('show_photo_collage')
                    ->label('Tampilkan Photo Collage')
                    ->default(true)
                    ->helperText('Aktifkan untuk menampilkan photo collage setelah konten ini'),

                Forms\Components\TextInput::make('order_index')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0)
                    ->helperText('Angka untuk mengatur urutan tampilan'),

                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->helperText('Aktifkan untuk menampilkan konten ini'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('section_title')
                    ->label('Judul Section')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('content')
                    ->label('Konten')
                    ->limit(100)
                    ->html()
                    ->searchable(),

                Tables\Columns\TextColumn::make('display_type')
                    ->label('Tipe Tampilan')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'wysiwyg' => 'success',
                        'simple_text' => 'warning',
                        'grid' => 'info',
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('order_index')
                    ->label('Urutan')
                    ->sortable(),

                Tables\Columns\IconColumn::make('show_photo_collage')
                    ->label('Photo Collage')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean()
                    ->sortable(),

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
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Status Aktif'),
                Tables\Filters\SelectFilter::make('display_type')
                    ->label('Tipe Tampilan')
                    ->options([
                        'wysiwyg' => 'Rich Text (WYSIWYG)',
                        'simple_text' => 'Teks Sederhana',
                        'grid' => 'Grid Layout',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListFacilityContents::route('/'),
            'create' => Pages\CreateFacilityContent::route('/create'),
            'edit' => Pages\EditFacilityContent::route('/{record}/edit'),
        ];
    }
} 
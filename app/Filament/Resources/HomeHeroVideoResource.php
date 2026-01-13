<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomeHeroVideoResource\Pages;
use App\Models\HomeHeroVideo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select as FormSelect;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class HomeHeroVideoResource extends Resource
{
    protected static ?string $model = HomeHeroVideo::class;

    protected static ?string $navigationIcon = 'heroicon-o-video-camera';
    protected static ?string $navigationGroup = 'Home';
    protected static ?string $navigationLabel = 'Hero Videos';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Hero Video')->schema([
                TextInput::make('title')->label('Judul')->required(),
                FormSelect::make('source_type')->label('Sumber Video')->options([
                    'upload' => 'Upload File',
                    'url' => 'URL (MP4)',
                ])->default('upload')->live(),
                FileUpload::make('video_file')->label('Video Desktop (MP4)')->disk('public')->directory('hero-videos')->acceptedFileTypes(['video/mp4'])->visible(fn (callable $get) => $get('source_type') === 'upload'),
                FileUpload::make('mobile_video_file')->label('Video Mobile (MP4)')->disk('public')->directory('hero-videos')->acceptedFileTypes(['video/mp4'])->visible(fn (callable $get) => $get('source_type') === 'upload'),
                TextInput::make('video_url')->label('URL Video Desktop (MP4)')->visible(fn (callable $get) => $get('source_type') === 'url'),
                TextInput::make('mobile_video_url')->label('URL Video Mobile (MP4)')->visible(fn (callable $get) => $get('source_type') === 'url'),
                FileUpload::make('poster_image')->label('Poster Image')->image()->disk('public')->directory('hero-videos/posters'),
                TextInput::make('order_index')->numeric()->default(0),
                Toggle::make('is_active')->label('Aktif')->default(true),
            ])->columns(2)
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_index')->label('Urut')->sortable(),
                TextColumn::make('title')->label('Judul')->searchable(),
                TextColumn::make('source_type')->label('Sumber'),
                ToggleColumn::make('is_active')->label('Aktif'),
            ])
            ->defaultSort('order_index')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHomeHeroVideos::route('/'),
            'create' => Pages\CreateHomeHeroVideo::route('/create'),
            'edit' => Pages\EditHomeHeroVideo::route('/{record}/edit'),
        ];
    }
} 
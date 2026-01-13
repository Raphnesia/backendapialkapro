<?php

namespace App\Filament\Pages;

use App\Models\SiteBranding;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class SiteBrandingSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-swatch';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?string $navigationLabel = 'Branding Situs';
    protected static ?string $title = 'Pengaturan Branding Situs';
    protected static string $view = 'filament.pages.site-branding-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $branding = SiteBranding::first();
        if (!$branding) {
            $branding = new SiteBranding();
            $branding->footer_brand_type = 'text';
            $branding->save();
        }

        $this->data = [
            'header_logo' => $branding->header_logo ? [$branding->header_logo] : [],
            'footer_brand_type' => $branding->footer_brand_type ?? 'text',
            'footer_brand_text' => $branding->footer_brand_text ?? 'SMP Muhammadiyah Al Kautsar PK Kartasura',
            'footer_brand_image' => $branding->footer_brand_image ? [$branding->footer_brand_image] : [],
        ];

        $this->form->fill($this->data);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Logo Header')
                    ->schema([
                        FileUpload::make('header_logo')
                            ->label('Logo Header')
                            ->image()
                            ->disk('public')
                            ->directory('branding')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->maxFiles(1)
                            ->acceptedFileTypes(['image/*'])
                            ->preserveFilenames()
                            ->helperText('Upload logo untuk navbar/header (max 5MB)'),
                    ])->columns(1),
                Section::make('Brand Footer')
                    ->schema([
                        Radio::make('footer_brand_type')
                            ->label('Tipe Brand Footer')
                            ->options([
                                'text' => 'Teks',
                                'image' => 'Gambar',
                            ])->default('text')->inline(),
                        TextInput::make('footer_brand_text')
                            ->label('Teks Brand Footer')
                            ->visible(fn ($get) => $get('footer_brand_type') === 'text')
                            ->maxLength(255),
                        FileUpload::make('footer_brand_image')
                            ->label('Gambar Brand Footer')
                            ->image()
                            ->disk('public')
                            ->directory('branding')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->maxFiles(1)
                            ->acceptedFileTypes(['image/*'])
                            ->visible(fn ($get) => $get('footer_brand_type') === 'image')
                            ->preserveFilenames()
                            ->helperText('Upload logo untuk footer (max 5MB)'),
                    ])->columns(1),
            ])
            ->statePath('data');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Pengaturan')
                ->action('saveSettings')
                ->color('success'),
        ];
    }

    public function saveSettings(): void
    {
        try {
            $formData = $this->form->getState();

            $branding = SiteBranding::first();
            if (!$branding) {
                $branding = new SiteBranding();
            }

            $branding->footer_brand_type = $formData['footer_brand_type'] ?? 'text';
            $branding->footer_brand_text = $formData['footer_brand_text'] ?? null;

            if (!empty($formData['header_logo'])) {
                $branding->header_logo = is_array($formData['header_logo']) ? $formData['header_logo'][0] : $formData['header_logo'];
            }
            if (!empty($formData['footer_brand_image'])) {
                $branding->footer_brand_image = is_array($formData['footer_brand_image']) ? $formData['footer_brand_image'][0] : $formData['footer_brand_image'];
            }

            $branding->save();

            $this->mount();

            Notification::make()->title('Pengaturan berhasil disimpan')->success()->send();
        } catch (\Exception $e) {
            Notification::make()->title('Error: ' . $e->getMessage())->danger()->send();
        }
    }
} 
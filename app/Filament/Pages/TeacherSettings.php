<?php

namespace App\Filament\Pages;

use App\Models\Teacher;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

class TeacherSettings extends Page implements HasForms
{
    use InteractsWithForms;
    
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'Guru & Staff';
    protected static ?string $navigationLabel = 'Pengaturan Halaman';
    protected static ?string $title = 'Pengaturan Halaman Guru';
    protected static ?int $navigationSort = 2;
    protected static string $view = 'filament.pages.teacher-settings';
    
    public ?array $data = [];
    
    public function mount(): void
    {
        $teacher = Teacher::whereJsonContains('guruData->active', true)->first();
        
        if ($teacher && isset($teacher->guruData)) {
            $this->data = [
                'title' => $teacher->guruData['title'] ?? '',
                'subtitle' => $teacher->guruData['subtitle'] ?? '',
                'date' => $teacher->guruData['date'] ?? '',
                'read_time' => $teacher->guruData['read_time'] ?? '',
                'author' => $teacher->guruData['author'] ?? '',
                'active' => $teacher->guruData['active'] ?? false,
                'banner_desktop' => !empty($teacher->guruData['banner_desktop']) ? 
                    [$teacher->guruData['banner_desktop']] : [],
                'banner_mobile' => !empty($teacher->guruData['banner_mobile']) ? 
                    [$teacher->guruData['banner_mobile']] : [],
            ];
        } else {
            $this->data = [
                'title' => 'Guru & Staff',
                'subtitle' => 'Mengenal lebih dekat dengan para pengajar dan staf kami',
                'date' => 'Terbaru',
                'read_time' => '3 min',
                'author' => 'Admin',
                'active' => false,
                'banner_desktop' => [],
                'banner_mobile' => [],
            ];
        }
        
        $this->form->fill($this->data);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Pengaturan Banner & Header')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Banner')
                            ->maxLength(255)
                            ->required(),
                        TextInput::make('subtitle')
                            ->label('Sub Judul')
                            ->maxLength(255)
                            ->required(),
                        FileUpload::make('banner_desktop')
                            ->label('Banner Desktop')
                            ->image()
                            ->disk('public')
                            ->directory('guru-banners')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->maxFiles(1)
                            ->acceptedFileTypes(['image/*'])
                            ->helperText('Upload gambar banner untuk desktop (max 5MB)'),
                        FileUpload::make('banner_mobile')
                            ->label('Banner Mobile')
                            ->image()
                            ->disk('public')
                            ->directory('guru-banners')
                            ->visibility('public')
                            ->maxSize(5120)
                            ->maxFiles(1)
                            ->acceptedFileTypes(['image/*'])
                            ->helperText('Upload gambar banner untuk mobile (max 5MB)'),
                    ])->columns(2),
                
                Section::make('Informasi Tambahan')
                    ->schema([
                        TextInput::make('date')
                            ->label('Tanggal')
                            ->maxLength(50),
                        TextInput::make('read_time')
                            ->label('Waktu Baca')
                            ->maxLength(20),
                        TextInput::make('author')
                            ->label('Penulis')
                            ->maxLength(100),
                        Toggle::make('active')
                            ->label('Aktifkan Pengaturan Ini')
                            ->helperText('Hanya satu pengaturan yang boleh aktif'),
                    ])->columns(2),
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
            
            // Nonaktifkan semua pengaturan yang ada
            Teacher::query()->update([
                'guruData->active' => false
            ]);
            
            $teacher = Teacher::first();
            if (!$teacher) {
                $teacher = new Teacher();
                $teacher->name = 'Default Teacher';
                $teacher->position = 'Default Position';
                $teacher->type = 'teacher';
                $teacher->is_active = true;
                $teacher->save();
            }
            
            // Ambil data guru yang ada
            $currentGuruData = $teacher->guruData ?? [];
            
            // Siapkan data baru
            $guruData = [
                'title' => $formData['title'] ?? '',
                'subtitle' => $formData['subtitle'] ?? '',
                'date' => $formData['date'] ?? '',
                'read_time' => $formData['read_time'] ?? '',
                'author' => $formData['author'] ?? '',
                'active' => $formData['active'] ?? false,
            ];
            
            // Proses banner desktop
            if (isset($formData['banner_desktop']) && !empty($formData['banner_desktop'])) {
                if (is_array($formData['banner_desktop']) && count($formData['banner_desktop']) > 0) {
                    $guruData['banner_desktop'] = $formData['banner_desktop'][0];
                } elseif (is_string($formData['banner_desktop'])) {
                    $guruData['banner_desktop'] = $formData['banner_desktop'];
                }
            } else {
                // Pertahankan banner yang sudah ada
                if (isset($currentGuruData['banner_desktop'])) {
                    $guruData['banner_desktop'] = $currentGuruData['banner_desktop'];
                }
            }
            
            // Proses banner mobile
            if (isset($formData['banner_mobile']) && !empty($formData['banner_mobile'])) {
                if (is_array($formData['banner_mobile']) && count($formData['banner_mobile']) > 0) {
                    $guruData['banner_mobile'] = $formData['banner_mobile'][0];
                } elseif (is_string($formData['banner_mobile'])) {
                    $guruData['banner_mobile'] = $formData['banner_mobile'];
                }
            } else {
                // Pertahankan banner yang sudah ada
                if (isset($currentGuruData['banner_mobile'])) {
                    $guruData['banner_mobile'] = $currentGuruData['banner_mobile'];
                }
            }
            
            // Simpan ke database
            $teacher->guruData = $guruData;
            $teacher->save();
            
            // Refresh data form
            $this->mount();
            
            Notification::make()
                ->title('Pengaturan berhasil disimpan')
                ->success()
                ->send();
                
        } catch (\Exception $e) {
            Notification::make()
                ->title('Error: ' . $e->getMessage())
                ->danger()
                ->send();
        }
    }
}
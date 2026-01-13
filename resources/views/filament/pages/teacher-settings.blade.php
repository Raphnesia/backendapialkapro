<x-filament-panels::page>
    <div class="space-y-6">
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <h3 class="text-lg font-medium text-blue-900 mb-2">Pengaturan Halaman Guru</h3>
            <p class="text-sm text-blue-700">Kelola banner, judul, subtitle, dan informasi header untuk halaman guru & staff</p>
        </div>

        <form wire:submit="saveSettings">
            {{ $this->form }}
            
            <div class="flex justify-end mt-6">
                <x-filament::button type="submit" color="success">
                    <x-heroicon-m-check class="w-4 h-4 mr-2" />
                    Simpan Pengaturan
                </x-filament::button>
            </div>
        </form>
    </div>
</x-filament-panels::page> 
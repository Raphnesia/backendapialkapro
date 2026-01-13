# 🕌 IPM COMPLEX STRUCTURE - BIDANG & ANGGOTA

## 🎯 **Konsep Baru:**
Struktur data IPM yang lebih kompleks dengan **bidang-bidang** yang memiliki **nama bidang** dan **daftar anggota** di bawahnya.

---

## 📊 **Struktur Data yang Diinginkan:**

### **1. Pengurus Inti:**
```
Ketua: Azka
Wakil Ketua: Nafisah
Sekretaris 1: Lovely
Sekretaris 2: Belva
Bendahara: Danesha
```

### **2. Bidang-bidang:**
```
BIDANG ORGANISASI:
1. Yazid
2. Natania
3. Zifana Nur
4. Nazneen
5. Alya Hafidzah

BIDANG PENGKADERAN:
1. Hanif
2. Aya
3. Shakila
4. Khanza Dzakia
5. Zifara
6. Feyza

BIDANG ASBO:
1. Arvel
2. Elsa
3. Ghafa
4. Yasmin Putri
5. Husna
6. Innara

BIDANG PIP:
1. Nada
2. Sima
3. Khansa Arsyla
4. Valiqa
5. Zifana
6. Hafidzh Rafie

BIDANG KDI:
1. Farros
2. Yasmin
3. Nikeila
4. Farhan
```

---

## 🗄️ **Database Structure:**

### **1. Migration untuk IPM Content:**
```php
// database/migrations/xxxx_create_ipm_content_table.php
public function up()
{
    Schema::create('ipm_content', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('content')->nullable();
        $table->string('grid_type')->default('grid-cols-1');
        $table->boolean('use_list_disc')->default(false);
        $table->json('list_items')->nullable(); // Untuk struktur kompleks
        $table->json('bidang_structure')->nullable(); // Struktur bidang baru
        $table->integer('order_index')->default(0);
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
}
```

### **2. Model IPMContent:**
```php
// app/Models/IPMContent.php
class IPMContent extends Model
{
    protected $fillable = [
        'title',
        'content',
        'grid_type',
        'use_list_disc',
        'list_items',
        'bidang_structure',
        'order_index',
        'is_active'
    ];

    protected $casts = [
        'list_items' => 'array',
        'bidang_structure' => 'array',
        'use_list_disc' => 'boolean',
        'is_active' => 'boolean'
    ];

    // Accessor untuk bidang_structure
    public function getBidangStructureAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    // Mutator untuk bidang_structure
    public function setBidangStructureAttribute($value)
    {
        $this->attributes['bidang_structure'] = json_encode($value);
    }
}
```

---

## 🎨 **Filament Form Structure:**

### **1. IPMContentResource Form:**
```php
// app/Filament/Resources/IPMContentResource.php
public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\TextInput::make('title')
                ->label('Judul Section')
                ->required()
                ->maxLength(255)
                ->placeholder('Contoh: Struktur Organisasi IPM'),

            Forms\Components\Textarea::make('content')
                ->label('Konten Utama')
                ->rows(4)
                ->placeholder('Deskripsi singkat tentang section ini...'),

            Forms\Components\Select::make('grid_type')
                ->label('Tipe Grid')
                ->options([
                    'grid-cols-1' => '1 Kolom',
                    'grid-cols-2' => '2 Kolom',
                    'grid-cols-3' => '3 Kolom',
                    'grid-cols-4' => '4 Kolom',
                ])
                ->default('grid-cols-1'),

            Forms\Components\Toggle::make('use_list_disc')
                ->label('Gunakan Struktur Bidang')
                ->helperText('Aktifkan untuk membuat struktur bidang dengan anggota')
                ->live(),

            // Struktur Bidang Kompleks
            Forms\Components\Repeater::make('bidang_structure')
                ->label('Struktur Bidang')
                ->schema([
                    Forms\Components\TextInput::make('bidang_name')
                        ->label('Nama Bidang')
                        ->required()
                        ->placeholder('Contoh: Bidang Organisasi'),
                    
                    Forms\Components\Repeater::make('members')
                        ->label('Anggota Bidang')
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('Nama Anggota')
                                ->required()
                                ->placeholder('Masukkan nama anggota...'),
                            
                            Forms\Components\TextInput::make('position')
                                ->label('Jabatan (Opsional)')
                                ->placeholder('Contoh: Ketua Bidang, Anggota, dll'),
                        ])
                        ->defaultItems(1)
                        ->reorderable()
                        ->collapsible()
                        ->itemLabel(fn (array $state): ?string => $state['name'] ?? null),
                ])
                ->visible(fn (Forms\Get $get): bool => $get('use_list_disc') === true)
                ->defaultItems(0)
                ->reorderable()
                ->collapsible()
                ->itemLabel(fn (array $state): ?string => $state['bidang_name'] ?? null),

            Forms\Components\TextInput::make('order_index')
                ->label('Urutan')
                ->numeric()
                ->default(0),

            Forms\Components\Toggle::make('is_active')
                ->label('Aktif')
                ->default(true),
        ]);
}
```

---

## 🎨 **Frontend Implementation:**

### **1. React/Next.js Component:**
```jsx
import { useState, useEffect } from 'react';

function IPMPage() {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch('http://localhost:8000/api/v1/ipm/complete')
      .then(response => response.json())
      .then(result => {
        if (result.success) {
          setData(result.data);
        }
        setLoading(false);
      });
  }, []);

  if (loading) return <div>Loading...</div>;
  if (!data) return <div>No data</div>;

  return (
    <div className="min-h-screen flex flex-col">
      {/* Banner Section */}
      <div className="relative h-[70vh] mx-auto flex items-center justify-center overflow-hidden">
        <div 
          className="absolute inset-0 bg-cover bg-center z-0"
          style={{
            backgroundImage: `url('${data.settings.banner_desktop}')`
          }}
        >
          <div className="absolute inset-0 bg-gradient-to-r from-red-900/80 via-red-800/60 to-transparent"></div>
        </div>
        <div className="relative z-10 text-center px-4">
          <div className="max-w-4xl mx-auto">
            <h1 className="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
              {data.settings.title}
              <span className="block text-yellow-400">Sekolah Kami</span>
            </h1>
            <p className="text-lg md:text-xl text-gray-200 max-w-2xl mx-auto">
              {data.settings.subtitle}
            </p>
          </div>
        </div>
      </div>

      {/* IPM Content */}
      <main className="flex-grow container mx-auto px-4 py-8 bg-white">
        <h1 className="text-3xl font-bold text-primary mb-6">Ikatan Pelajar Muhammadiyah (IPM)</h1>
        
        <div className="prose prose-black max-w-none">
          {/* Pengurus Inti */}
          <div className="bg-white rounded-lg shadow-md p-6 mb-8">
            <h2 className="text-2xl font-semibold text-black mb-4">Pengurus Inti IPM</h2>
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
              {data.pengurus.map((pengurus, index) => (
                <div key={index} className="bg-gray-50 p-4 rounded-lg border border-gray-200">
                  <h3 className="font-semibold text-red-600 mb-1">{pengurus.position}</h3>
                  <p className="text-black font-medium">{pengurus.name}</p>
                  <p className="text-sm text-gray-600">Kelas: {pengurus.kelas}</p>
                </div>
              ))}
            </div>
          </div>
          
          {/* Struktur Bidang */}
          {data.content.map((section, index) => (
            <div key={index} className="bg-white rounded-lg shadow-md p-6 mb-8">
              <h2 className="text-2xl font-semibold text-black mb-6">{section.title}</h2>
              
              {section.content && (
                <div className="mb-6 text-black" dangerouslySetInnerHTML={{ __html: section.content }} />
              )}
              
              {/* Struktur Bidang Kompleks */}
              {section.use_list_disc && section.bidang_structure && (
                <div className={`grid ${section.grid_type} gap-6`}>
                  {section.bidang_structure.map((bidang, bidangIndex) => (
                    <div key={bidangIndex} className="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                      {/* Header Bidang */}
                      <div className="bg-red-600 text-white px-4 py-3">
                        <h3 className="font-semibold text-lg">{bidang.bidang_name}</h3>
                      </div>
                      
                      {/* Daftar Anggota */}
                      <div className="p-4">
                        <div className="space-y-2">
                          {bidang.members.map((member, memberIndex) => (
                            <div key={memberIndex} className="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0">
                              <div className="flex items-center">
                                <span className="w-6 h-6 bg-red-100 text-red-600 rounded-full flex items-center justify-center text-xs font-bold mr-3">
                                  {memberIndex + 1}
                                </span>
                                <span className="font-medium text-black">{member.name}</span>
                              </div>
                              {member.position && (
                                <span className="text-sm text-gray-600 bg-gray-100 px-2 py-1 rounded">
                                  {member.position}
                                </span>
                              )}
                            </div>
                          ))}
                        </div>
                      </div>
                    </div>
                  ))}
                </div>
              )}
            </div>
          ))}
        </div>
      </main>
    </div>
  );
}

export default IPMPage;
```

---

## 📝 **Contoh Data JSON:**

### **1. Struktur Bidang Kompleks:**
```json
{
  "bidang_structure": [
    {
      "bidang_name": "Bidang Organisasi",
      "members": [
        {"name": "Yazid", "position": "Ketua Bidang"},
        {"name": "Natania", "position": "Anggota"},
        {"name": "Zifana Nur", "position": "Anggota"},
        {"name": "Nazneen", "position": "Anggota"},
        {"name": "Alya Hafidzah", "position": "Anggota"}
      ]
    },
    {
      "bidang_name": "Bidang Pengkaderan",
      "members": [
        {"name": "Hanif", "position": "Ketua Bidang"},
        {"name": "Aya", "position": "Anggota"},
        {"name": "Shakila", "position": "Anggota"},
        {"name": "Khanza Dzakia", "position": "Anggota"},
        {"name": "Zifara", "position": "Anggota"},
        {"name": "Feyza", "position": "Anggota"}
      ]
    },
    {
      "bidang_name": "Bidang ASBO",
      "members": [
        {"name": "Arvel", "position": "Ketua Bidang"},
        {"name": "Elsa", "position": "Anggota"},
        {"name": "Ghafa", "position": "Anggota"},
        {"name": "Yasmin Putri", "position": "Anggota"},
        {"name": "Husna", "position": "Anggota"},
        {"name": "Innara", "position": "Anggota"}
      ]
    },
    {
      "bidang_name": "Bidang PIP",
      "members": [
        {"name": "Nada", "position": "Ketua Bidang"},
        {"name": "Sima", "position": "Anggota"},
        {"name": "Khansa Arsyla", "position": "Anggota"},
        {"name": "Valiqa", "position": "Anggota"},
        {"name": "Zifana", "position": "Anggota"},
        {"name": "Hafidzh Rafie", "position": "Anggota"}
      ]
    },
    {
      "bidang_name": "Bidang KDI",
      "members": [
        {"name": "Farros", "position": "Ketua Bidang"},
        {"name": "Yasmin", "position": "Anggota"},
        {"name": "Nikeila", "position": "Anggota"},
        {"name": "Farhan", "position": "Anggota"}
      ]
    }
  ]
}
```

---

## 🎨 **Styling Variations:**

### **1. Card Style:**
```jsx
{section.bidang_structure.map((bidang, bidangIndex) => (
  <div key={bidangIndex} className="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
    <div className="bg-gradient-to-r from-red-600 to-red-700 text-white px-4 py-3">
      <h3 className="font-semibold text-lg">{bidang.bidang_name}</h3>
    </div>
    <div className="p-4">
      <div className="grid grid-cols-1 md:grid-cols-2 gap-2">
        {bidang.members.map((member, memberIndex) => (
          <div key={memberIndex} className="flex items-center bg-gray-50 p-2 rounded">
            <span className="w-6 h-6 bg-red-100 text-red-600 rounded-full flex items-center justify-center text-xs font-bold mr-2">
              {memberIndex + 1}
            </span>
            <span className="font-medium text-black">{member.name}</span>
          </div>
        ))}
      </div>
    </div>
  </div>
))}
```

### **2. Table Style:**
```jsx
{section.bidang_structure.map((bidang, bidangIndex) => (
  <div key={bidangIndex} className="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm mb-6">
    <div className="bg-red-600 text-white px-4 py-3">
      <h3 className="font-semibold text-lg">{bidang.bidang_name}</h3>
    </div>
    <div className="overflow-x-auto">
      <table className="w-full">
        <thead className="bg-gray-50">
          <tr>
            <th className="px-4 py-2 text-left text-sm font-medium text-gray-700">No</th>
            <th className="px-4 py-2 text-left text-sm font-medium text-gray-700">Nama</th>
            <th className="px-4 py-2 text-left text-sm font-medium text-gray-700">Jabatan</th>
          </tr>
        </thead>
        <tbody className="divide-y divide-gray-200">
          {bidang.members.map((member, memberIndex) => (
            <tr key={memberIndex} className="hover:bg-gray-50">
              <td className="px-4 py-2 text-sm text-gray-900">{memberIndex + 1}</td>
              <td className="px-4 py-2 text-sm font-medium text-black">{member.name}</td>
              <td className="px-4 py-2 text-sm text-gray-600">{member.position || '-'}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  </div>
))}
```

---

## 🚀 **Implementation Steps:**

### **1. Update Migration:**
```bash
php artisan make:migration add_bidang_structure_to_ipm_content_table
```

### **2. Update Model:**
```php
// app/Models/IPMContent.php
protected $fillable = [
    'title',
    'content',
    'grid_type',
    'use_list_disc',
    'list_items',
    'bidang_structure', // Tambahkan ini
    'order_index',
    'is_active'
];

protected $casts = [
    'list_items' => 'array',
    'bidang_structure' => 'array', // Tambahkan ini
    'use_list_disc' => 'boolean',
    'is_active' => 'boolean'
];
```

### **3. Update Filament Resource:**
```php
// app/Filament/Resources/IPMContentResource.php
// Ganti Repeater list_items dengan Repeater bidang_structure
```

### **4. Update API Controller:**
```php
// app/Http/Controllers/Api/IPMContentController.php
// Pastikan bidang_structure ter-include dalam response
```

---

**Sekarang struktur data IPM akan lebih fleksibel dan bisa menampung struktur bidang yang kompleks!** 🎯 
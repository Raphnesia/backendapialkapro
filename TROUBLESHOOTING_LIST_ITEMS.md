# 🔧 TROUBLESHOOTING: LIST ITEMS TIDAK MUNCUL

## 🚨 **Masalah:**
Item list tidak muncul ketika checkbox "Gunakan List Bullet" diaktifkan di form Sejarah Singkat, Visi Misi, dan IPM Content.

## ✅ **Solusi yang Telah Diterapkan:**

### **1. Perbaikan Reactive Form**

**SEBELUM (Tidak Berfungsi):**
```php
Forms\Components\Toggle::make('use_list_disc')
    ->label('Gunakan List Bullet')
    ->default(false)
    ->helperText('Aktifkan jika ingin menampilkan list bullet points')
    ->reactive(), // ❌ DEPRECATED

Forms\Components\Repeater::make('list_items')
    ->visible(fn ($get) => $get('use_list_disc')) // ❌ TIDAK BERFUNGSI
```

**SESUDAH (Berfungsi):**
```php
Forms\Components\Toggle::make('use_list_disc')
    ->label('Gunakan List Bullet')
    ->default(false)
    ->helperText('Aktifkan jika ingin menampilkan list bullet points')
    ->live(), // ✅ GANTI DENGAN live()

Forms\Components\Repeater::make('list_items')
    ->visible(fn (Forms\Get $get): bool => $get('use_list_disc') === true) // ✅ PERBAIKI
```

### **2. File yang Diperbaiki:**

#### **SejarahSingkatResource.php:**
- ✅ Toggle `use_list_disc` menggunakan `->live()`
- ✅ Repeater `list_items` menggunakan `visible()` dengan type hint yang benar

#### **VisiMisiResource.php:**
- ✅ Toggle `use_list_disc` menggunakan `->live()`
- ✅ Repeater `list_items` menggunakan `visible()` dengan type hint yang benar

#### **IPMContentResource.php:**
- ✅ Toggle `use_list_disc` menggunakan `->live()`
- ✅ Repeater `list_items` menggunakan `visible()` dengan type hint yang benar

---

## 🎯 **Cara Menggunakan List Items:**

### **1. Tambah Konten Baru:**
1. Buka admin panel: `http://localhost:8000/admin`
2. Login dengan: `admin@admin.com` / `admin123`
3. Pilih menu sesuai section:
   - **Sejarah Singkat**: Profil Sekolah → Konten Sejarah Singkat
   - **Visi Misi**: Profil Sekolah → Visi Misi
   - **IPM Content**: Profil Sekolah → IPM Content

### **2. Aktifkan List Bullet:**
1. Klik "Create" untuk tambah konten baru
2. Isi "Judul Section" (contoh: "Sejarah Pendirian")
3. Isi "Konten Utama" dengan rich text editor
4. **PENTING**: Aktifkan toggle "Gunakan List Bullet"
5. **Item List akan muncul otomatis** setelah toggle diaktifkan

### **3. Tambah Item List:**
1. Setelah toggle "Gunakan List Bullet" diaktifkan
2. Section "Item List" akan muncul
3. Klik "Tambah Item" untuk menambah item baru
4. Isi field "Item" dengan teks yang diinginkan
5. Ulangi untuk menambah item lainnya
6. Item bisa di-reorder dengan drag & drop

### **4. Contoh Item List:**
```
Item 1: SMP Muhammadiyah Al Kautsar PK Kartasura didirikan pada tahun 1995
Item 2: Berawal dari keinginan masyarakat untuk memiliki sekolah Islam berkualitas
Item 3: Menggunakan kurikulum nasional yang dipadukan dengan nilai-nilai Islam
Item 4: Memiliki visi menjadi sekolah unggulan di wilayah Kartasura
```

---

## 🔍 **Test List Items:**

### **1. Test API:**
```bash
# Test Sejarah Singkat dengan list items
curl http://localhost:8000/api/v1/sejarah-singkat/with-list-items

# Test Visi Misi dengan list items
curl http://localhost:8000/api/v1/visi-misi/with-list-items

# Test IPM Content dengan list items
curl http://localhost:8000/api/v1/ipm-content/with-list-items
```

### **2. Response Format:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Sejarah Pendirian",
      "content": "<p>Sejarah berdirinya sekolah...</p>",
      "grid_type": "grid-cols-1",
      "use_list_disc": true,
      "list_items": [
        {"item": "SMP Muhammadiyah Al Kautsar PK Kartasura didirikan pada tahun 1995"},
        {"item": "Berawal dari keinginan masyarakat untuk memiliki sekolah Islam berkualitas"},
        {"item": "Menggunakan kurikulum nasional yang dipadukan dengan nilai-nilai Islam"}
      ],
      "background_color": "bg-white",
      "border_color": "border-gray-200",
      "order_index": 1,
      "is_active": true
    }
  ]
}
```

---

## 🎨 **Frontend Integration:**

### **React/Next.js Example:**
```javascript
// Get content with list items
fetch('http://localhost:8000/api/v1/sejarah-singkat/with-list-items')
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      data.data.forEach(section => {
        if (section.use_list_disc && section.list_items) {
          console.log('Section:', section.title);
          console.log('List Items:', section.list_items);
          
          // Render list items
          section.list_items.forEach(item => {
            console.log('-', item.item);
          });
        }
      });
    }
  });
```

### **HTML Rendering:**
```html
<div class="grid grid-cols-1 gap-6">
  <div dangerouslySetInnerHTML={{ __html: section.content }} />
  
  {section.use_list_disc && section.list_items && (
    <ul className="list-disc pl-5 space-y-2 text-black">
      {section.list_items.map((item, idx) => (
        <li key={idx}>{item.item}</li>
      ))}
    </ul>
  )}
</div>
```

---

## 🚨 **Jika Masih Bermasalah:**

### **1. Clear Cache:**
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

### **2. Check Browser Console:**
- Buka Developer Tools (F12)
- Lihat Console untuk error JavaScript
- Pastikan tidak ada error pada form

### **3. Check Network Tab:**
- Lihat apakah ada request yang gagal
- Pastikan semua asset Filament ter-load dengan benar

### **4. Alternative Solution:**
Jika masih bermasalah, gunakan approach manual:
```php
Forms\Components\Repeater::make('list_items')
    ->label('Item List')
    ->schema([
        Forms\Components\TextInput::make('item')
            ->label('Item')
            ->required()
            ->placeholder('Masukkan item list'),
    ])
    ->visible(fn (Forms\Get $get): bool => $get('use_list_disc'))
    ->helperText('Tambahkan item-item untuk list bullet points')
    ->defaultItems(0)
    ->addActionLabel('Tambah Item')
    ->reorderable()
    ->collapsible()
    ->live() // Tambahkan live() di repeater juga
```

---

## 📝 **Notes:**

1. **Live Updates**: Toggle menggunakan `->live()` untuk real-time updates
2. **Type Hinting**: Gunakan `Forms\Get $get` untuk type safety
3. **Strict Comparison**: Gunakan `=== true` untuk boolean comparison
4. **Default Items**: Set `->defaultItems(0)` agar tidak ada item default
5. **Helper Text**: Tambahkan helper text untuk user guidance

---

**Sekarang list items sudah berfungsi dengan baik!** 🎉

Silakan coba tambah konten baru dan aktifkan "Gunakan List Bullet", item list akan muncul otomatis. 
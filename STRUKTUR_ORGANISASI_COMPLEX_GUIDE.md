# STRUKTUR ORGANISASI COMPLEX GUIDE

## Overview
Fitur Struktur Organisasi yang kompleks memungkinkan Anda membuat struktur organisasi dengan **bidang-bidang** dan **opsi tampilan** (list biasa atau bagan/diagram).

## Database Structure

### Tabel: `struktur_organisasi_contents`
```sql
- id (primary key)
- title (string) - Judul section
- content (longText) - Konten rich text
- grid_type (string) - Layout grid (grid-cols-1, grid-cols-2, dll)
- use_list_disc (boolean) - Toggle untuk struktur bidang
- list_items (json) - Item list legacy
- bidang_structure (json) - Struktur bidang kompleks
- display_type (enum: 'list', 'bagan') - Tipe tampilan
- background_color (string) - Warna background
- border_color (string) - Warna border
- order_index (integer) - Urutan tampilan
- is_active (boolean) - Status aktif
- created_at, updated_at
```

## Admin Panel (Filament)

### Menu Location
- **Navigation Group**: "Profil Sekolah"
- **Menu Label**: "Struktur Organisasi Content"
- **Navigation Sort**: 7

### Form Fields

#### 1. **Judul Section**
- Field: `title`
- Type: TextInput
- Required: Yes
- Placeholder: "Contoh: Struktur Organisasi Sekolah, Bagian Administrasi, dll"

#### 2. **Konten**
- Field: `content`
- Type: RichEditor
- Toolbar: Bold, Italic, Underline, Strike, Link, BulletList, OrderedList, H2, H3, H4, Blockquote

#### 3. **Tipe Grid Layout**
- Field: `grid_type`
- Type: Select
- Options:
  - `grid-cols-1` → "1 Kolom"
  - `grid-cols-2` → "2 Kolom"
  - `grid-cols-3` → "3 Kolom"
  - `grid-cols-4` → "4 Kolom"
- Default: `grid-cols-1`

#### 4. **Gunakan Struktur Bidang**
- Field: `use_list_disc`
- Type: Toggle
- Default: false
- **Live**: Yes (untuk reactive form)

#### 5. **Struktur Bidang** (Muncul jika toggle aktif)
- Field: `bidang_structure`
- Type: Repeater (Nested)
- Schema:
  ```php
  [
      'bidang_name' => TextInput (required),
      'members' => Repeater [
          'name' => TextInput (required),
          'position' => TextInput (optional)
      ]
  ]
  ```
- Features: Reorderable, Collapsible
- Item Labels: `bidang_name` untuk bidang, `name` untuk anggota

#### 6. **Tipe Tampilan** (Muncul jika toggle aktif)
- Field: `display_type`
- Type: Select
- Options:
  - `list` → "List Biasa"
  - `bagan` → "Bagan/Diagram"
- Default: `list`

#### 7. **Item List (Legacy)** (Muncul jika toggle tidak aktif)
- Field: `list_items`
- Type: Repeater
- Schema: `['item' => TextInput]`
- Features: Reorderable, Collapsible

#### 8. **Warna Background**
- Field: `background_color`
- Type: Select
- Options:
  - `bg-white` → "Putih"
  - `bg-gray-50` → "Abu-abu Muda"
  - `bg-blue-50` → "Biru Muda"
  - `bg-green-50` → "Hijau Muda"
  - `bg-yellow-50` → "Kuning Muda"
  - `bg-purple-50` → "Ungu Muda"
  - `bg-red-50` → "Merah Muda"
- Default: `bg-white`

#### 9. **Warna Border**
- Field: `border_color`
- Type: Select
- Options:
  - `border-gray-200` → "Abu-abu"
  - `border-blue-200` → "Biru"
  - `border-green-200` → "Hijau"
  - `border-yellow-200` → "Kuning"
  - `border-purple-200` → "Ungu"
  - `border-red-200` → "Merah"
  - `border-transparent` → "Transparan"
- Default: `border-gray-200`

#### 10. **Urutan**
- Field: `order_index`
- Type: TextInput (numeric)
- Default: 0
- Helper: "Angka kecil akan ditampilkan terlebih dahulu"

#### 11. **Aktif**
- Field: `is_active`
- Type: Toggle
- Default: true
- Helper: "Nonaktifkan untuk menyembunyikan dari frontend"

## API Endpoints

### 1. **Get All Content**
```http
GET /api/v1/struktur-organisasi-content
```

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Struktur Organisasi Sekolah",
      "content": "<p>Deskripsi struktur organisasi...</p>",
      "grid_type": "grid-cols-2",
      "use_list_disc": true,
      "bidang_structure": [
        {
          "bidang_name": "Bagian Administrasi",
          "members": [
            {"name": "Pak Ahmad", "position": "Kepala Bagian"},
            {"name": "Bu Siti", "position": "Anggota"}
          ]
        }
      ],
      "display_type": "bagan",
      "background_color": "bg-white",
      "border_color": "border-gray-200",
      "order_index": 0,
      "is_active": true
    }
  ]
}
```

### 2. **Get Content by ID**
```http
GET /api/v1/struktur-organisasi-content/{id}
```

### 3. **Get Content by Grid Type**
```http
GET /api/v1/struktur-organisasi-content/grid/{gridType}
```

**Example:**
```http
GET /api/v1/struktur-organisasi-content/grid/grid-cols-2
```

### 4. **Get Content with Bidang Structure**
```http
GET /api/v1/struktur-organisasi-content/with-bidang-structure
```

**Response:** Hanya content yang menggunakan `bidang_structure`

### 5. **Get Content by Display Type**
```http
GET /api/v1/struktur-organisasi-content/display/{displayType}
```

**Examples:**
```http
GET /api/v1/struktur-organisasi-content/display/list
GET /api/v1/struktur-organisasi-content/display/bagan
```

### 6. **Get Complete Struktur Organisasi Data**
```http
GET /api/v1/struktur-organisasi/complete
```

**Response:**
```json
{
  "success": true,
  "data": {
    "settings": {
      "title": "Struktur Organisasi",
      "subtitle": "Organisasi Sekolah",
      "banner_desktop": "path/to/banner.jpg",
      "banner_mobile": "path/to/banner-mobile.jpg",
      "is_active": true
    },
    "struktur_organisasi": [
      {
        "id": 1,
        "position": "Kepala Sekolah",
        "name": "Dr. Ahmad",
        "photo": "path/to/photo.jpg",
        "description": "Deskripsi kepala sekolah",
        "order_index": 0,
        "is_active": true
      }
    ],
    "content": [
      {
        "id": 1,
        "title": "Struktur Organisasi Sekolah",
        "bidang_structure": [...],
        "display_type": "bagan"
      }
    ]
  }
}
```

## Frontend Implementation

### React/Next.js Example

#### 1. **Fetch Data**
```javascript
// Get complete data
const fetchStrukturOrganisasi = async () => {
  try {
    const response = await fetch('/api/v1/struktur-organisasi/complete');
    const result = await response.json();
    
    if (result.success) {
      const { settings, struktur_organisasi, content } = result.data;
      // Process data
    }
  } catch (error) {
    console.error('Error fetching struktur organisasi:', error);
  }
};

// Get content with bidang structure only
const fetchBidangStructure = async () => {
  try {
    const response = await fetch('/api/v1/struktur-organisasi-content/with-bidang-structure');
    const result = await response.json();
    
    if (result.success) {
      return result.data;
    }
  } catch (error) {
    console.error('Error fetching bidang structure:', error);
  }
};
```

#### 2. **Render Bidang Structure**
```jsx
const renderBidangStructure = (content) => {
  if (!content.bidang_structure) return null;

  return (
    <div className={`grid ${content.grid_type} gap-6`}>
      {content.bidang_structure.map((bidang, index) => (
        <div key={index} className={`${content.background_color} ${content.border_color} border rounded-lg p-6`}>
          <h3 className="text-lg font-semibold mb-4 text-gray-800">
            {bidang.bidang_name}
          </h3>
          
          {content.display_type === 'list' ? (
            // List biasa
            <ul className="list-disc list-inside space-y-2">
              {bidang.members.map((member, memberIndex) => (
                <li key={memberIndex} className="text-gray-700">
                  {member.name}
                  {member.position && (
                    <span className="text-gray-500 ml-2">({member.position})</span>
                  )}
                </li>
              ))}
            </ul>
          ) : (
            // Bagan/Diagram
            <div className="space-y-3">
              {bidang.members.map((member, memberIndex) => (
                <div key={memberIndex} className="flex items-center justify-between p-3 bg-gray-50 rounded">
                  <span className="font-medium text-gray-800">
                    {member.name}
                  </span>
                  {member.position && (
                    <span className="text-sm text-gray-600 bg-white px-2 py-1 rounded">
                      {member.position}
                    </span>
                  )}
                </div>
              ))}
            </div>
          )}
        </div>
      ))}
    </div>
  );
};
```

#### 3. **Complete Component Example**
```jsx
const StrukturOrganisasiSection = () => {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetchStrukturOrganisasi()
      .then(result => {
        setData(result);
        setLoading(false);
      });
  }, []);

  if (loading) return <div>Loading...</div>;
  if (!data) return <div>No data available</div>;

  const { settings, content } = data;

  return (
    <section className="py-16 bg-gray-50">
      <div className="container mx-auto px-4">
        {/* Banner */}
        <div className="relative mb-12">
          <img 
            src={settings.banner_desktop} 
            alt="Struktur Organisasi"
            className="w-full h-64 object-cover rounded-lg hidden md:block"
          />
          <img 
            src={settings.banner_mobile} 
            alt="Struktur Organisasi"
            className="w-full h-32 object-cover rounded-lg md:hidden"
          />
          <div className="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-lg">
            <div className="text-center text-white">
              <h1 className="text-4xl font-bold mb-2">{settings.title}</h1>
              <p className="text-xl">{settings.subtitle}</p>
            </div>
          </div>
        </div>

        {/* Content */}
        <div className="space-y-8">
          {content.map((item) => (
            <div key={item.id}>
              <h2 className="text-2xl font-bold mb-6 text-gray-800">
                {item.title}
              </h2>
              
              {item.content && (
                <div 
                  className="prose prose-lg max-w-none mb-6 prose-black"
                  dangerouslySetInnerHTML={{ __html: item.content }}
                />
              )}
              
              {item.use_list_disc && item.bidang_structure && (
                renderBidangStructure(item)
              )}
              
              {!item.use_list_disc && item.list_items && (
                <ul className="list-disc list-inside space-y-2">
                  {item.list_items.map((listItem, index) => (
                    <li key={index} className="text-gray-700">
                      {listItem.item}
                    </li>
                  ))}
                </ul>
              )}
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};
```

## Usage Examples

### Example 1: Struktur Organisasi Sekolah
```json
{
  "title": "Struktur Organisasi SMP Muhammadiyah",
  "use_list_disc": true,
  "display_type": "bagan",
  "bidang_structure": [
    {
      "bidang_name": "Kepemimpinan",
      "members": [
        {"name": "Dr. Ahmad Supriyadi", "position": "Kepala Sekolah"},
        {"name": "Siti Nurhaliza", "position": "Wakil Kepala Sekolah"},
        {"name": "Budi Santoso", "position": "Wakil Kepala Sekolah"}
      ]
    },
    {
      "bidang_name": "Bagian Administrasi",
      "members": [
        {"name": "Rina Marlina", "position": "Kepala Bagian"},
        {"name": "Dewi Sartika", "position": "Anggota"},
        {"name": "Maya Indah", "position": "Anggota"}
      ]
    },
    {
      "bidang_name": "Bagian Kurikulum",
      "members": [
        {"name": "Pak Guru", "position": "Kepala Bagian"},
        {"name": "Bu Guru", "position": "Anggota"}
      ]
    }
  ]
}
```

### Example 2: Struktur Organisasi dengan List Biasa
```json
{
  "title": "Struktur Organisasi Sederhana",
  "use_list_disc": true,
  "display_type": "list",
  "bidang_structure": [
    {
      "bidang_name": "Bidang Akademik",
      "members": [
        {"name": "Guru Matematika"},
        {"name": "Guru IPA"},
        {"name": "Guru Bahasa"}
      ]
    }
  ]
}
```

## Troubleshooting

### 1. **Bidang Structure Tidak Muncul**
- Pastikan toggle "Gunakan Struktur Bidang" aktif
- Refresh halaman admin
- Cek apakah ada error di console browser

### 2. **API 404 Error**
- Pastikan routes sudah terdaftar di `routes/api.php`
- Jalankan `php artisan route:clear`
- Cek apakah controller sudah dibuat dengan benar

### 3. **Data Tidak Tersimpan**
- Pastikan semua field required sudah diisi
- Cek apakah ada validation error
- Pastikan database migration sudah dijalankan

### 4. **Frontend Tidak Menampilkan Data**
- Cek network tab di browser developer tools
- Pastikan API endpoint benar
- Cek apakah response format sesuai dengan yang diharapkan

## Migration Commands

```bash
# Run migration
php artisan migrate

# Rollback migration
php artisan migrate:rollback

# Refresh migration
php artisan migrate:refresh

# Check migration status
php artisan migrate:status
```

## File Locations

- **Model**: `app/Models/StrukturOrganisasiContent.php`
- **Migration**: `database/migrations/2025_08_05_053653_create_struktur_organisasi_contents_table.php`
- **Controller**: `app/Http/Controllers/Api/StrukturOrganisasiContentController.php`
- **Resource**: `app/Filament/Resources/StrukturOrganisasiContentResource.php`
- **Routes**: `routes/api.php` 
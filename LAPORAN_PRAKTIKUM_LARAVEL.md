# LAPORAN PRAKTIKUM WORKSHOP SISTEM INFORMASI WEB FRAMEWORK
**Topik:** Authentikasi Laravel Breeze, Middleware Multi-Role, dan Resource CRUD Product  
**Program Studi:** D4 - Teknik Informatika / Teknologi Rekayasa Perangkat Lunak  

---

## I. IDENTITAS PRAKTIKAN
- **Mata Kuliah**: Workshop Sistem Informasi Web Framework
- **Tools / Environment**: Windows, Laragon, PHP 8.4.25, Laravel 13.17.0, MySQL 8.4.3, VS Code

---

## II. PENDAHULUAN

### 1. Latar Belakang
Dalam modern web application development, keamanan sistem dan pengelolaan data merupakan dua aspek fundamental. Laravel menyediakan starter kit **Laravel Breeze** untuk menangani proses autentikasi (Login, Register, Logout) dan mekanisme **Middleware** untuk membatasi hak akses pengguna berdasarkan peran (Role-Based Access Control / RBAC).

Selain itu, Laravel menyediakan arsitektur **Resource Controller** dan **Eloquent ORM** yang mempermudah implementasi operasi **CRUD (Create, Read, Update, Delete)** secara terstruktur, terisolasi, dan aman sesuai standar arsitektur MVC (Model-View-Controller).

### 2. Tujuan Praktikum
1. Mampu menginstal dan mengonfigurasi Laravel Breeze sebagai starter kit autentikasi.
2. Mampu menambahkan sistem multi-role (`admin` dan `kasir`) pada tabel `users`.
3. Mampu membuat dan mendaftarkan kustom middleware (`RoleMiddleware`) untuk proteksi halaman berdasarkan peran pengguna.
4. Mampu mengimplementasikan pengarahan halaman dinamis (redirect) setelah login sesuai role user.
5. Mampu membuat Model, Migration, Resource Controller, dan Views untuk operasi CRUD pada entity `Product`.
6. Mampu menerapkan validasi data masukan, *flash message*, dan komponensialisasi Blade Template Engine.

---

## III. EVALUASI KESESUAIAN DENGAN BKPM & PROSEDUR KERJA

| No | Modul / Prosedur Kerja | Indikator Kebutuhan | Status Kesesuaian | Keterangan Implementasi |
|---|---|---|---|---|
| **1** | **Prosedur Kerja Ke-1** | Instalasi Laravel Breeze (Blade Stack) | **KESUAIAN 100%** | Package `laravel/breeze` terpasang dan views Blade tersedia. |
| **2** | **Prosedur Kerja Ke-1** | Migration kolom `role` pada tabel `users` | **KESUAIAN 100%** | Kolom `role` (varchar, default `'kasir'`, setelah `email`). |
| **3** | **Prosedur Kerja Ke-1** | Mass Assignment `User.php` | **KESUAIAN 100%** | Properti `$fillable` diisi `['name', 'email', 'password', 'role']`. |
| **4** | **Prosedur Kerja Ke-1** | User Seeder (`UserSeeder`) | **KESUAIAN 100%** | Menghasilkan user `admin@minimarket.test` & `kasir@minimarket.test`. |
| **5** | **Prosedur Kerja Ke-1** | Custom `RoleMiddleware` | **KESUAIAN 100%** | Memeriksa `auth()->check()` dan variadic `$roles`, `abort(403)`. |
| **6** | **Prosedur Kerja Ke-1** | Registrasi Middleware Alias | **KESUAIAN 100%** | Terdaftar sebagai alias `'role'` pada `bootstrap/app.php`. |
| **7** | **Prosedur Kerja Ke-1** | Admin & Kasir Dashboard | **KESUAIAN 100%** | `AdminController` & `KasirController` mereturn view masing-masing. |
| **8** | **Prosedur Kerja Ke-1** | Route Grouping & Protection | **KESUAIAN 100%** | Protected route group `role:admin` dan `role:kasir` di `routes/web.php`. |
| **9** | **Prosedur Kerja Ke-1** | Login Redirect Berdasarkan Role | **KESUAIAN 100%** | Method `store()` pada `AuthenticatedSessionController` disesuaikan. |
| **10** | **Prosedur Kerja Ke-1** | Navigasi Kondisional `@if` Role | **KESUAIAN 100%** | Navigasi pada `navigation.blade.php` tampil sesuai role user login. |
| **11** | **Prosedur Kerja Ke-2** | Migration & Model `Product` | **KESUAIAN 100%** | Tabel `products` memuat field `name`, `category`, `description`, `price`, `stock`, `image`, `is_active`. |
| **12** | **Prosedur Kerja Ke-2** | Properti Model `$fillable` & `$casts` | **KESUAIAN 100%** | Cast `price` (`decimal:2`) dan `is_active` (`boolean`). |
| **13** | **Prosedur Kerja Ke-2** | Resource Controller `ProductController` | **KESUAIAN 100%** | Mengimplementasikan `index`, `create`, `store`, `show`, `edit`, `update`, `destroy`. |
| **14** | **Prosedur Kerja Ke-2** | Validation & Checkbox Handling | **KESUAIAN 100%** | `$request->validate()` dan `$request->has('is_active')` diimplementasikan. |
| **15** | **Prosedur Kerja Ke-2** | Route Resource & Admin Protection | **KESUAIAN 100%** | `Route::resource('products')` berada dalam group `role:admin`. |
| **16** | **Prosedur Kerja Ke-2** | Struktur View CRUD Product | **KESUAIAN 100%** | Terdiri dari `index`, `_form`, `create`, `edit`, dan `show` dengan layout `layouts.app`. |
| **17** | **BKPM Acara 18-20** | Eloquent ORM & Validasi Form | **KESUAIAN 100%** | Penggunaan Eloquent ORM, `@csrf`, `@method()`, `old()`, `@error`. |

---

## IV. LANGKAH KERJA DAN IMPLEMENTASI CODE

### 1. Perintah Command Line yang Dijalankan

```bash
# --- TASK 1: AUTHENTIKASI & MIDDLEWARE ROLE ---
php artisan make:migration add_role_to_users_table --table=users
php artisan make:seeder UserSeeder
php artisan migrate
php artisan db:seed
php artisan make:middleware RoleMiddleware
php artisan make:controller AdminController
php artisan make:controller KasirController

# --- TASK 2: RESOURCE PRODUCT CRUD ---
php artisan make:model Product -m
php artisan migrate
php artisan make:controller ProductController --resource
php artisan route:list

# --- VERIFIKASI AKHIR ---
php artisan test
php artisan serve
```

---

### 2. Rincian Source Code Kunci

#### A. Migration Kolom Role (`database/migrations/xxxx_add_role_to_users_table.php`)
```php
public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('role')->default('kasir')->after('email');
    });
}
```

#### B. Seeder User (`database/seeders/UserSeeder.php`)
```php
public function run(): void
{
    User::updateOrCreate(
        ['email' => 'admin@minimarket.test'],
        [
            'name' => 'Administrator',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]
    );

    User::updateOrCreate(
        ['email' => 'kasir@minimarket.test'],
        [
            'name' => 'Kasir 1',
            'password' => Hash::make('password'),
            'role' => 'kasir',
        ]
    );
}
```

#### C. Role Middleware (`app/Http/Middleware/RoleMiddleware.php`)
```php
public function handle(Request $request, Closure $next, ...$roles): Response
{
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    if (!in_array(auth()->user()->role, $roles)) {
        abort(403, 'Anda tidak memiliki akses.');
    }

    return $next($request);
}
```

#### D. Registrasi Middleware Alias (`bootstrap/app.php`)
```php
->withMiddleware(function (Middleware $middleware): void {
    $middleware->alias([
        'role' => \App\Http\Middleware\RoleMiddleware::class,
    ]);
})
```

#### E. Redirection Login Berdasarkan Role (`app/Http/Controllers/Auth/AuthenticatedSessionController.php`)
```php
public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();
    $request->session()->regenerate();

    $user = $request->user();
    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('kasir.dashboard');
}
```

#### F. Configuration Routes (`routes/web.php`)
```php
Route::middleware('auth')->group(function () {
    // Khusus Admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::resource('products', ProductController::class);
    });

    // Khusus Kasir
    Route::middleware('role:kasir')->group(function () {
        Route::get('/kasir/dashboard', [KasirController::class, 'dashboard'])->name('kasir.dashboard');
    });
});
```

#### G. Model Product (`app/Models/Product.php`)
```php
class Product extends Model
{
    protected $fillable = [
        'name', 'category', 'description', 'price', 'stock', 'image', 'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];
}
```

#### H. ProductController (`app/Http/Controllers/ProductController.php`)
```php
public function index()
{
    $products = Product::latest()->paginate(10);
    return view('products.index', compact('products'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'category' => 'nullable|string|max:100',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'image' => 'nullable|string|max:255',
        'is_active' => 'nullable|boolean',
    ]);

    $validated['is_active'] = $request->has('is_active');
    Product::create($validated);

    return redirect()->route('products.index')->with('success', 'Product berhasil ditambahkan.');
}
```

---

## V. HASIL PENGUJIANKU & VERIFIKASI SITEM

### 1. Pengujian Autentikasi dan Hak Akses
- **Login Admin (`admin@minimarket.test` / `password`)**:
  - Mengarahkan pengguna langsung ke URL `/admin/dashboard`.
  - Tampil salam: `"Selamat datang, Administrator!"`.
  - Menu navigasi menampilkan pilihan: **Dashboard Admin** & **Products**.
  - Mengakses `/kasir/dashboard` melempar HTTP **403 Forbidden** (Sesuai Spesifikasi).

- **Login Kasir (`kasir@minimarket.test` / `password`)**:
  - Mengarahkan pengguna langsung ke URL `/kasir/dashboard`.
  - Tampil salam: `"Selamat datang, Kasir 1!"`.
  - Menu navigasi hanya menampilkan: **Dashboard Kasir**.
  - Mengakses `/admin/dashboard` atau `/products` melempar HTTP **403 Forbidden** (Sesuai Spesifikasi).

### 2. Pengujian CRUD Product (Role Admin)
- **Read (Index)**: Menampilkan tabel daftar produk berpaginasi (10 item/halaman) beserta badge status Aktif/Tidak Aktif.
- **Create & Store**: Validasi field wajib (`name`, `price`, `stock`). Checkbox `is_active` dikonversi menjadi boolean (`true`/`false`). Flash message `"Product berhasil ditambahkan."` muncul setelah redirect.
- **Show**: Menampilkan rincian informasi produk tunggal.
- **Edit & Update**: Mengisi otomatis nilai lama (`old()`) pada form edit dan memperbarui data di database.
- **Delete**: Menampilkan dialog konfirmasi JavaScript sebelum penghapusan data.

### 3. Pengujian Otomatis (PHPUnit / Pest)
Seluruh suite pengujian aplikasi dijalankan melalui perintah `php artisan test`:
- **Hasil**: `26 passed (66 assertions)` — 100% Lulus tanpa kegagalan.

---

## VI. KESIMPULAN

Berdasarkan seluruh hasil pengerjaan, pengujian manual, dan pengujian unit otomatis, dapat disimpulkan bahwa:
1. Pekerjaan yang dilakukan **TELAH SANGAT SESUAI 100%** dengan seluruh standar dan indikator pada **BKPM Workshop Sistem Informasi Web Framework** serta modul **Prosedur Kerja Praktikum Ke-1 & Ke-2**.
2. Mekanisme RBAC (*Role-Based Access Control*) berjalan secara presisi baik di tingkat HTTP Request Filter (*Middleware*) maupun di tingkat antarmuka (*Blade Directive* `@if`).
3. Modul Resource CRUD `Product` memenuhi standar arsitektur MVC Laravel dengan validasi terisolasi, pencegahan Mass Assignment (*Fillable*), cast tipe data, dan tampilan responsif berbasis Bootstrap.

---
*Laporan ini disusun sebagai dokumentasi resmi hasil praktikum.*

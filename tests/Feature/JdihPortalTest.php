<?php

namespace Tests\Feature;

use App\Models\JenisPeraturan;
use App\Models\Peraturan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JdihPortalTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * Test Home Page loads with 200 OK.
     */
    public function test_home_page_loads_successfully(): void
    {
        $response = $this->get('/home');
        $response->assertStatus(200);
        $response->assertSee('JDIH Kabupaten Toba');
        $response->assertSee('Bagian Hukum Setdakab');
    }

    /**
     * Test Produk Hukum Global page loads with category counts (Requirement #4).
     */
    public function test_produk_hukum_global_page_loads(): void
    {
        $response = $this->get('/produk-hukum');
        $response->assertStatus(200);
        $response->assertSee('Katalog Regulasi Produk Hukum');
        $response->assertSee('Peraturan Daerah');
    }

    /**
     * Test Category Listing page (Requirement #4).
     */
    public function test_category_listing_page_loads(): void
    {
        $response = $this->get('/kategori/peraturan-daerah');
        $response->assertStatus(200);
        $response->assertSee('Peraturan Daerah');
    }

    /**
     * Test Multi-parameter Search endpoint (Requirement #1).
     */
    public function test_search_page_loads(): void
    {
        $response = $this->get('/cari?judul=pajak');
        $response->assertStatus(200);
        $response->assertSee('Pencarian Produk Hukum');
    }

    /**
     * Test JDIHN BPHN JSON API endpoint (Requirement #5).
     */
    public function test_jdihn_api_returns_standard_json(): void
    {
        $response = $this->getJson('/api/jdihn');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'status',
            'meta' => ['portal', 'standard', 'total', 'current_page'],
            'data',
        ]);
    }

    /**
     * Test Super Admin Route is blocked for regular admin (Security).
     */
    public function test_super_admin_route_blocked_for_normal_admin(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/super-admin');
        $response->assertRedirect('/admin');
        $response->assertSessionHas('error');
    }

    /**
     * Test Super Admin Route is accessible by Super Admin (Security).
     */
    public function test_super_admin_route_accessible_by_super_admin(): void
    {
        $superAdmin = User::factory()->create(['role' => 'super_admin']);

        $response = $this->actingAs($superAdmin)->get('/super-admin');
        $response->assertStatus(200);
        $response->assertSee('Kelola Akun Administrator');
    }

    /**
     * Test Admin Dashboard loads successfully for authenticated admin.
     */
    public function test_admin_dashboard_loads_for_authenticated_admin(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Dasbor Utama');
        $response->assertSee('Total Produk Hukum');
        $response->assertSee('liveGreetingPill');
        $response->assertSee('liveClockText');
    }

    /**
     * Test All User Facing Pages Load Successfully (End-to-End).
     */
    public function test_all_public_pages_load_successfully(): void
    {
        $pages = [
            '/home?tab=populer',
            '/cari?sort=populer',
            '/berita',
            '/pengumuman',
            '/pengumuman?kategori=uji-publik',
            '/pengumuman?tahun=2026',
            '/pengumuman?pdf=1',
            '/pengumuman?sort=terlama',
            '/visi',
            '/sejarah',
            '/organisasi',
            '/kontak',
            '/login',
        ];

        foreach ($pages as $page) {
            $response = $this->get($page);
            $response->assertStatus(200);
        }
    }

    /**
     * Test Dynamic Kategori Pengumuman CRUD and Public Filtering.
     */
    public function test_dynamic_kategori_pengumuman_management_and_filtering(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        // 1. Create a new category as admin
        $storeResponse = $this->actingAs($admin)->post('/admin/pengumuman/kategori', [
            'nama' => 'Siaran Pers Bupati',
        ]);
        $storeResponse->assertRedirect('/admin/pengumuman');
        $this->assertDatabaseHas('kategori_pengumumen', [
            'nama' => 'Siaran Pers Bupati',
            'slug' => 'siaran-pers-bupati',
        ]);

        $kat = \App\Models\KategoriPengumuman::where('slug', 'siaran-pers-bupati')->first();

        // 2. Create announcement assigned to that category
        $announcementResponse = $this->actingAs($admin)->post('/admin/pengumuman', [
            'judul' => 'Rilis Pers Terkait Regulasi Daerah Terbaru',
            'kategori_id' => $kat->id,
            'isi' => 'Rilis pers resmi pemerintah daerah Kabupaten Toba...',
            'tanggal_upload' => '2026-11-16',
        ]);
        $announcementResponse->assertRedirect('/admin/pengumuman');
        $this->assertDatabaseHas('pengumumen', [
            'judul' => 'Rilis Pers Terkait Regulasi Daerah Terbaru',
            'kategori_id' => $kat->id,
        ]);

        // 3. Public index shows category and allows filtering by slug
        $publicResponse = $this->get('/pengumuman?kategori=siaran-pers-bupati');
        $publicResponse->assertStatus(200);
        $publicResponse->assertSee('Siaran Pers Bupati');
        $publicResponse->assertSee('Rilis Pers Terkait Regulasi Daerah Terbaru');

        // 4. Update category
        $updateResponse = $this->actingAs($admin)->put("/admin/pengumuman/kategori/{$kat->id}", [
            'nama' => 'Siaran Pers & Media',
        ]);
        $updateResponse->assertRedirect('/admin/pengumuman');
        $this->assertDatabaseHas('kategori_pengumumen', [
            'id' => $kat->id,
            'nama' => 'Siaran Pers & Media',
            'slug' => 'siaran-pers-media',
        ]);

        // 5. Delete category
        $deleteResponse = $this->actingAs($admin)->delete("/admin/pengumuman/kategori/{$kat->id}");
        $deleteResponse->assertRedirect('/admin/pengumuman');
        $this->assertDatabaseMissing('kategori_pengumumen', [
            'id' => $kat->id,
        ]);
    }

    /**
     * Test All Admin Management Pages Load Successfully (HTTP 200 OK).
     */
    public function test_all_admin_pages_load_successfully(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $adminPages = [
            '/admin',
            '/admin/peraturan',
            '/admin/peraturan/create',
            '/admin/jenis-peraturan',
            '/admin/berita',
            '/admin/pengumuman',
            '/admin/struktur',
            '/admin/visi',
        ];

        foreach ($adminPages as $page) {
            $response = $this->actingAs($admin)->get($page);
            $response->assertStatus(200);
        }
    }
}


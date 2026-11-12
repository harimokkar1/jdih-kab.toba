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
}


<?php

namespace Tests\Feature;

use App\Models\Borrowing;
use App\Models\Equipment;
use App\Models\User;
use Tests\TestCase;

/**
 * Sementara: verifikasi refactor sidebar komponen + CSS external.
 */
class ViewRefactorSmokeTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // @vite butuh hasil build (manifest) atau server dev (hot file).
        if (!file_exists(public_path('build/manifest.json')) && !file_exists(public_path('hot'))) {
            $this->markTestSkipped('Belum ada build Vite. Jalankan: npm run build');
        }
    }

    public function test_guest_pages_render(): void
    {
        foreach (['login', 'register'] as $route) {
            $this->get(route($route))
                ->assertOk()
                ->assertDontSee('<style', false)
                ->assertSee('build/assets', false);
        }
    }

    public function test_admin_pages_render_without_inline_style(): void
    {
        $admin = User::where('role', 'admin')->firstOrFail();
        $equipmentId = Equipment::value('id');
        $borrowingId = Borrowing::value('id');

        $routes = [
            'dashboard',
            'equipment.index',
            'equipment.create',
            'categories.index',
            'categories.create',
            'borrowings.index',
            'borrowings.create',
            'profile.show',
        ];
        if ($equipmentId) {
            $routes[] = ['equipment.show', ['equipment' => $equipmentId]];
            $routes[] = ['equipment.edit', ['equipment' => $equipmentId]];
        }
        if ($borrowingId) {
            $routes[] = ['borrowings.show', ['borrowing' => $borrowingId]];
        }

        foreach ($routes as $item) {
            [$name, $params] = is_array($item) ? $item : [$item, []];
            $response = $this->actingAs($admin)->get(route($name, $params));
            $response->assertOk();
            $response->assertDontSee('<style', false);
            $response->assertSee('build/assets', false);
            $response->assertSee('<aside class="sidebar">', false);
        }

        // Nav aktif mengikuti route (profile.show sengaja tidak menandai nav apapun).
        $this->actingAs($admin)->get(route('dashboard'))
            ->assertSee('nav-link active', false);
        $this->actingAs($admin)->get(route('equipment.index'))
            ->assertSee('nav-link active', false);
    }

    public function test_athlete_sidebar_hides_categories(): void
    {
        $athlete = User::where('role', '!=', 'admin')->firstOrFail();

        $response = $this->actingAs($athlete)->get(route('dashboard'));
        $response->assertOk();
        $response->assertSee('<aside class="sidebar">', false);
        $response->assertSee('nav-link active', false);
        $response->assertDontSee('Categories', false);

        $this->actingAs($athlete)->get(route('borrowings.index'))
            ->assertOk()
            ->assertSee('nav-link active', false)
            ->assertDontSee('Categories', false);
    }

    public function test_welcome_page_renders(): void
    {
        // welcome.blade.php tidak direferensikan route (view sisa skeleton) ->
        // render langsung untuk verifikasi kompilasi + CSS external.
        $html = view('welcome')->render();
        $this->assertStringNotContainsString('<style', $html);
        $this->assertStringContainsString('build/assets', $html);
    }
}

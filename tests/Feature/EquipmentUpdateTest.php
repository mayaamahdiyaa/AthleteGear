<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Equipment;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/**
 * Pengujian alur Edit Equipment: update data + alur foto
 * (placeholder, foto lama, ganti foto, hapus foto, validasi).
 *
 * Test berjalan terhadap database asli dengan transaksi otomatis
 * (rollback di akhir) sehingga data asli tidak pernah berubah.
 *
 * Jalankan: php artisan test --filter=EquipmentUpdateTest
 */
class EquipmentUpdateTest extends TestCase
{
    use DatabaseTransactions;

    private User $admin;

    private Category $category;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create(['role' => 'admin']);
        $this->category = Category::create(['name' => 'Category For Update Test']);
    }

    private function makeEquipment(array $attributes = []): Equipment
    {
        return Equipment::create(array_merge([
            'category_id' => $this->category->id,
            'name' => 'Hurdles',
            'quantity' => 10,
            'minimum_stock' => 1,
            'condition' => 'Good',
        ], $attributes));
    }

    /**
     * PNG valid berukuran lebih dari 2 MB untuk menguji batas ukuran.
     */
    private function oversizedPng(): UploadedFile
    {
        $image = imagecreatetruecolor(4, 4);
        ob_start();
        imagepng($image);
        $png = ob_get_clean();
        imagedestroy($image);

        $path = tempnam(sys_get_temp_dir(), 'bigpng') . '.png';
        file_put_contents($path, $png . str_repeat("\0", 2049 * 1024));

        return new UploadedFile($path, 'huge.png', 'image/png', null, true);
    }

    // ------------------------------------------------------------------
    // Update data
    // ------------------------------------------------------------------

    public function test_update_persists_all_fields_and_shows_success(): void
    {
        $secondCategory = Category::create(['name' => 'Second Category For Update Test']);
        $equipment = $this->makeEquipment();

        $response = $this->actingAs($this->admin)->put(route('equipment.update', $equipment), [
            'category_id' => $secondCategory->id,
            'name' => 'Updated Hurdles Pro',
            'description' => 'Updated description for testing.',
            'quantity' => 42,
            'minimum_stock' => 7,
            'condition' => 'Damaged',
        ]);

        $response->assertRedirect(route('equipment.index'));
        $response->assertSessionHas('success', 'Equipment updated successfully.');

        $equipment->refresh();

        $this->assertSame($secondCategory->id, $equipment->category_id);
        $this->assertSame('Updated Hurdles Pro', $equipment->name);
        $this->assertSame('Updated description for testing.', $equipment->description);
        $this->assertSame(42, $equipment->quantity);
        $this->assertSame(7, $equipment->minimum_stock);
        $this->assertSame('Damaged', $equipment->condition);
    }

    public function test_equipment_index_shows_latest_data_after_update(): void
    {
        $equipment = $this->makeEquipment();

        $this->actingAs($this->admin)
            ->put(route('equipment.update', $equipment), [
                'category_id' => $this->category->id,
                'name' => 'Latest Name On Index',
                'description' => 'desc',
                'quantity' => 55,
                'minimum_stock' => 9,
                'condition' => 'Fair',
            ])
            ->assertSessionHas('success');

        $this->actingAs($this->admin)
            ->get(route('equipment.index'))
            ->assertOk()
            ->assertSee('Latest Name On Index')
            ->assertSee('55')
            ->assertSee('9');
    }

    public function test_edit_page_shows_latest_data_after_update(): void
    {
        $equipment = $this->makeEquipment();

        $this->actingAs($this->admin)
            ->put(route('equipment.update', $equipment), [
                'category_id' => $this->category->id,
                'name' => 'Latest Name On Edit Form',
                'description' => 'Latest description.',
                'quantity' => 31,
                'minimum_stock' => 4,
                'condition' => 'Fair',
            ])
            ->assertSessionHas('success');

        $this->actingAs($this->admin)
            ->get(route('equipment.edit', $equipment))
            ->assertOk()
            ->assertSee('Latest Name On Edit Form')
            ->assertSee('Latest description.')
            ->assertSee('value="31"', false)
            ->assertSee('value="4"', false);
    }

    public function test_validation_failure_shows_no_success_and_keeps_data(): void
    {
        $equipment = $this->makeEquipment();

        $response = $this->actingAs($this->admin)->put(route('equipment.update', $equipment), [
            'category_id' => $this->category->id,
            'name' => '',
            'description' => 'x',
            'quantity' => -5,
            'minimum_stock' => -1,
            'condition' => 'Good',
        ]);

        $response->assertSessionHasErrors(['name', 'quantity', 'minimum_stock']);
        $response->assertSessionMissing('success');

        $equipment->refresh();
        $this->assertSame('Hurdles', $equipment->name);
        $this->assertSame(10, $equipment->quantity);
        $this->assertSame(1, $equipment->minimum_stock);
    }

    public function test_invalid_condition_poor_is_rejected(): void
    {
        $equipment = $this->makeEquipment();

        $response = $this->actingAs($this->admin)->put(route('equipment.update', $equipment), [
            'category_id' => $this->category->id,
            'name' => 'Hurdles',
            'quantity' => 10,
            'minimum_stock' => 1,
            'condition' => 'Poor',
        ]);

        $response->assertSessionHasErrors('condition');
        $response->assertSessionMissing('success');
        $this->assertSame('Good', $equipment->refresh()->condition);
    }

    public function test_success_message_only_shown_when_database_save_succeeds(): void
    {
        $equipment = $this->makeEquipment();

        // Simulasi penyimpanan gagal (listener model mengembalikan false).
        Equipment::updating(fn () => false);

        $response = $this->actingAs($this->admin)->put(route('equipment.update', $equipment), [
            'category_id' => $this->category->id,
            'name' => 'Never Saved Name',
            'description' => 'Never saved.',
            'quantity' => 99,
            'minimum_stock' => 5,
            'condition' => 'Fair',
        ]);

        $response->assertSessionMissing('success');
        $response->assertSessionHas('error');

        $equipment->refresh();
        $this->assertSame('Hurdles', $equipment->name);
        $this->assertSame(10, $equipment->quantity);
    }

    // ------------------------------------------------------------------
    // Form edit: opsi condition harus cocok dengan validasi controller
    // ------------------------------------------------------------------

    public function test_edit_form_condition_options_match_validation_rules(): void
    {
        $equipment = $this->makeEquipment(['condition' => 'Damaged']);

        $response = $this->actingAs($this->admin)->get(route('equipment.edit', $equipment));

        $response->assertOk();
        $response->assertSee('value="Damaged"', false);
        $response->assertDontSee('value="Poor"', false);
    }

    // ------------------------------------------------------------------
    // Foto: placeholder, foto lama, preview controls
    // ------------------------------------------------------------------

    public function test_edit_shows_placeholder_when_no_photo(): void
    {
        $equipment = $this->makeEquipment();

        $response = $this->actingAs($this->admin)->get(route('equipment.edit', $equipment));

        $response->assertOk();
        $response->assertSee('No photo yet');
        $response->assertSee('id="equipmentImagePreview"', false);
        $response->assertSee('id="equipmentImagePlaceholder"', false);
        $response->assertSee('data-current-name=""', false);
        $response->assertDontSee('id="removeImageCheckbox"', false);
    }

    public function test_edit_shows_current_photo_and_remove_option(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('equipment/existing.jpg', 'EXISTING-CONTENT');

        $equipment = $this->makeEquipment(['image' => 'equipment/existing.jpg']);

        $response = $this->actingAs($this->admin)->get(route('equipment.edit', $equipment));

        $response->assertOk();
        $response->assertSee('/storage/equipment/existing.jpg', false);
        $response->assertSee('data-current-src="/storage/equipment/existing.jpg"', false);
        $response->assertSee('Current: existing.jpg', false);
        $response->assertSee('data-current-name="Current: existing.jpg"', false);
        $response->assertSee('id="removeImageCheckbox"', false);
        // Placeholder tetap ada di DOM (fallback onerror) tetapi tersembunyi.
        $response->assertSee('id="equipmentImagePlaceholder" style="display:none;"', false);
    }

    public function test_edit_page_renders_photo_preview_controls(): void
    {
        $equipment = $this->makeEquipment();

        $response = $this->actingAs($this->admin)->get(route('equipment.edit', $equipment));

        $response->assertOk();
        $response->assertSee('id="equipmentImageName"', false);
        $response->assertSee('id="imageInput"', false);
        $response->assertSee('id="imageInputCamera"', false);
        $response->assertSee('id="imageInputGallery"', false);
        $response->assertSee('id="imageInputFile"', false);
        $response->assertSee('accept="image/*"', false);
        $response->assertSee('Take Photo');
        $response->assertSee('From Gallery');
        $response->assertSee('From File');
        $response->assertSee('JPG, JPEG, PNG, WEBP or GIF');
        $response->assertSee('data-current-src', false);
    }

    // ------------------------------------------------------------------
    // Foto: alur simpan (keep / ganti / hapus)
    // ------------------------------------------------------------------

    public function test_update_keeps_existing_photo_when_untouched(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('equipment/keep-me.jpg', 'KEEP');

        $equipment = $this->makeEquipment(['image' => 'equipment/keep-me.jpg']);

        $response = $this->actingAs($this->admin)->put(route('equipment.update', $equipment), [
            'category_id' => $this->category->id,
            'name' => 'Renamed Without Photo Change',
            'quantity' => 15,
            'minimum_stock' => 2,
            'condition' => 'Good',
        ]);

        $response->assertSessionHas('success', 'Equipment updated successfully.');

        $equipment->refresh();
        $this->assertSame('equipment/keep-me.jpg', $equipment->image);
        Storage::disk('public')->assertExists('equipment/keep-me.jpg');
    }

    public function test_update_replaces_photo_and_deletes_old_file_after_save(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('equipment/old-photo.jpg', 'OLD');

        $equipment = $this->makeEquipment(['image' => 'equipment/old-photo.jpg']);

        $response = $this->actingAs($this->admin)->put(route('equipment.update', $equipment), [
            'category_id' => $this->category->id,
            'name' => 'Hurdles',
            'quantity' => 10,
            'minimum_stock' => 1,
            'condition' => 'Good',
            'image' => UploadedFile::fake()->image('brand-new.jpg', 10, 10),
        ]);

        $response->assertSessionHas('success', 'Equipment updated successfully.');

        $equipment->refresh();
        $this->assertNotNull($equipment->image);
        $this->assertStringStartsWith('equipment/', $equipment->image);
        $this->assertNotSame('equipment/old-photo.jpg', $equipment->image);

        Storage::disk('public')->assertExists($equipment->image);
        Storage::disk('public')->assertMissing('equipment/old-photo.jpg');
    }

    public function test_update_removes_photo_file_only_after_successful_save(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('equipment/to-remove.jpg', 'REMOVE-ME');

        $equipment = $this->makeEquipment(['image' => 'equipment/to-remove.jpg']);

        $response = $this->actingAs($this->admin)->put(route('equipment.update', $equipment), [
            'category_id' => $this->category->id,
            'name' => 'Hurdles',
            'quantity' => 10,
            'minimum_stock' => 1,
            'condition' => 'Good',
            'remove_image' => '1',
        ]);

        $response->assertSessionHas('success', 'Equipment updated successfully.');

        $equipment->refresh();
        $this->assertNull($equipment->image);
        Storage::disk('public')->assertMissing('equipment/to-remove.jpg');
    }

    public function test_old_photo_file_stays_when_database_save_fails(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('equipment/still-needed.jpg', 'STILL-NEEDED');

        $equipment = $this->makeEquipment(['image' => 'equipment/still-needed.jpg']);

        // Simulasi penyimpanan gagal.
        Equipment::updating(fn () => false);

        $response = $this->actingAs($this->admin)->put(route('equipment.update', $equipment), [
            'category_id' => $this->category->id,
            'name' => 'Hurdles',
            'quantity' => 10,
            'minimum_stock' => 1,
            'condition' => 'Good',
            'remove_image' => '1',
        ]);

        $response->assertSessionMissing('success');
        $response->assertSessionHas('error');

        // Foto lama tidak boleh hilang sebelum perubahan berhasil disimpan.
        $this->assertSame('equipment/still-needed.jpg', $equipment->refresh()->image);
        Storage::disk('public')->assertExists('equipment/still-needed.jpg');
    }

    public function test_new_photo_takes_precedence_when_remove_checkbox_also_checked(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('equipment/replaced.jpg', 'REPLACED');

        $equipment = $this->makeEquipment(['image' => 'equipment/replaced.jpg']);

        $response = $this->actingAs($this->admin)->put(route('equipment.update', $equipment), [
            'category_id' => $this->category->id,
            'name' => 'Hurdles',
            'quantity' => 10,
            'minimum_stock' => 1,
            'condition' => 'Good',
            'image' => UploadedFile::fake()->image('winner.jpg', 8, 8),
            'remove_image' => '1',
        ]);

        $response->assertSessionHas('success', 'Equipment updated successfully.');

        $equipment->refresh();
        $this->assertNotNull($equipment->image);
        Storage::disk('public')->assertExists($equipment->image);
        Storage::disk('public')->assertMissing('equipment/replaced.jpg');
    }

    // ------------------------------------------------------------------
    // Foto: validasi format dan ukuran
    // ------------------------------------------------------------------

    public function test_image_with_invalid_format_is_rejected_and_old_photo_kept(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('equipment/original.jpg', 'ORIGINAL');

        $equipment = $this->makeEquipment(['image' => 'equipment/original.jpg']);

        $response = $this->actingAs($this->admin)->put(route('equipment.update', $equipment), [
            'category_id' => $this->category->id,
            'name' => 'Hurdles',
            'quantity' => 10,
            'minimum_stock' => 1,
            'condition' => 'Good',
            'image' => UploadedFile::fake()->create('notes.txt', 4, 'text/plain'),
        ]);

        $response->assertSessionHasErrors('image');
        $response->assertSessionMissing('success');

        $this->assertSame('equipment/original.jpg', $equipment->refresh()->image);
        Storage::disk('public')->assertExists('equipment/original.jpg');
    }

    public function test_image_larger_than_2mb_is_rejected(): void
    {
        Storage::fake('public');
        $equipment = $this->makeEquipment();

        $response = $this->actingAs($this->admin)->put(route('equipment.update', $equipment), [
            'category_id' => $this->category->id,
            'name' => 'Hurdles',
            'quantity' => 10,
            'minimum_stock' => 1,
            'condition' => 'Good',
            'image' => $this->oversizedPng(),
        ]);

        $response->assertSessionHasErrors('image');
        $response->assertSessionMissing('success');

        $message = $response->getSession()->get('errors')->first('image');
        $this->assertStringContainsString('2048', $message);

        $this->assertNull($equipment->refresh()->image);
        $this->assertEmpty(Storage::disk('public')->allFiles('equipment'));
    }
}

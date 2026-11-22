<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\PortfolioContent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PortfolioBackendTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_portfolio_endpoint_returns_persisted_content(): void
    {
        $response = $this->getJson('/api/portfolio');

        $response->assertOk()
            ->assertJsonPath('data.profile.name', 'Fiqtoril Oyun')
            ->assertJsonPath('data.projects.0.id', 'batik-catalog')
            ->assertJsonPath('data.skills.0.skills.0.name', 'Vue.js')
            ->assertJsonPath('data.services.0.name', 'Landing Page UMKM');

        $this->assertModelExists(PortfolioContent::query()->findOrFail('main'));
    }

    public function test_admin_login_and_content_update_persist_changes(): void
    {
        config(['portfolio.admin.email' => 'admin@example.com']);
        $admin = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => 'correct-password',
        ]);

        $this->postJson('/api/admin/login', [
            'email' => 'admin@example.com',
            'password' => 'correct-password',
        ])->assertOk()
            ->assertJsonPath('authenticated', true);

        $content = $this->validPortfolioContent('Updated profile');
        $content['profile']['studentId'] = '12345678';
        $content['profile']['birthInfo'] = 'Bandung, 1 Januari 2000';
        $content['profile']['address'] = 'Jl. Contoh No. 1';

        $response = $this->putJson('/api/admin/portfolio', ['content' => $content]);

        $response->assertOk()
            ->assertJsonPath('data.profile.name', 'Updated profile')
            ->assertJsonPath('data.profile.studentId', '12345678')
            ->assertJsonPath('data.profile.birthInfo', 'Bandung, 1 Januari 2000')
            ->assertJsonPath('data.profile.address', 'Jl. Contoh No. 1');
        $this->assertAuthenticatedAs($admin);
        $this->assertSame(
            'Updated profile',
            PortfolioContent::query()->findOrFail('main')->content['profile']['name'],
        );
        $this->assertSame(
            '12345678',
            PortfolioContent::query()->findOrFail('main')->content['profile']['studentId'],
        );
    }

    public function test_admin_login_rejects_invalid_credentials(): void
    {
        config(['portfolio.admin.email' => 'admin@example.com']);
        User::factory()->create([
            'email' => 'admin@example.com',
            'password' => 'correct-password',
        ]);

        $this->postJson('/api/admin/login', [
            'email' => 'admin@example.com',
            'password' => 'wrong-password',
        ])->assertUnprocessable()
            ->assertJsonPath('message', 'Email atau kata sandi tidak sesuai.');
    }

    public function test_admin_login_and_logout_update_public_availability(): void
    {
        config(['portfolio.admin.email' => 'admin@example.com']);
        User::factory()->create([
            'email' => 'admin@example.com',
            'password' => 'correct-password',
        ]);

        $this->postJson('/api/admin/login', [
            'email' => 'admin@example.com',
            'password' => 'correct-password',
        ])->assertOk();

        $this->getJson('/api/portfolio')->assertJsonPath('data.profile.online', true);

        $this->postJson('/api/admin/logout')->assertOk();

        $this->getJson('/api/portfolio')->assertJsonPath('data.profile.online', false);
    }

    public function test_protected_content_update_returns_401_without_admin_session(): void
    {
        $this->putJson('/api/admin/portfolio', [])
            ->assertUnauthorized()
            ->assertJsonPath('message', 'Silakan masuk sebagai admin.');
    }

    public function test_non_admin_user_cannot_update_portfolio(): void
    {
        config(['portfolio.admin.email' => 'admin@example.com']);
        $this->actingAs(User::factory()->create(['email' => 'other@example.com']))
            ->putJson('/api/admin/portfolio', [])
            ->assertForbidden()
            ->assertJsonPath('message', 'Akses khusus admin.');
    }

    public function test_portfolio_update_rejects_javascript_links_without_saving(): void
    {
        $this->authenticateAdmin();
        $content = $this->validPortfolioContent('Fiqtoril Oyun');
        $content['socialLinks'] = [['name' => 'Malicious', 'href' => 'javascript:alert(1)']];

        $this->putJson('/api/admin/portfolio', ['content' => $content])
            ->assertUnprocessable()
            ->assertInvalid(['content.socialLinks.0.href']);

        $this->assertDatabaseCount('portfolio_contents', 0);
    }

    public function test_admin_image_upload_stores_an_image_on_the_public_disk(): void
    {
        Storage::fake('public');
        $this->authenticateAdmin();
        $image = UploadedFile::fake()->image('avatar.png');

        $response = $this->withHeader('Accept', 'application/json')
            ->post('/api/admin/images', ['image' => $image]);

        $response->assertCreated()
            ->assertJsonPath('url', '/storage/portfolio/'.$image->hashName());
        $this->assertTrue(Storage::disk('public')->exists('portfolio/'.$image->hashName()));
    }

    public function test_contact_form_persists_a_valid_message(): void
    {
        $response = $this->postJson('/api/contact', [
            'name' => 'Ayu',
            'email' => 'ayu@example.com',
            'phone' => '08123456789',
            'service' => 'Landing Page UMKM',
            'subject' => 'Website toko',
            'message' => 'Saya ingin bertanya mengenai pembuatan website.',
        ]);

        $response->assertCreated()
            ->assertJsonPath('message', 'Pesan berhasil dikirim.');
        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Ayu',
            'email' => 'ayu@example.com',
            'is_read' => false,
        ]);
    }

    public function test_contact_form_rejects_missing_required_fields(): void
    {
        $this->postJson('/api/contact', [])
            ->assertUnprocessable()
            ->assertInvalid(['name', 'email', 'message']);

        $this->assertDatabaseCount('contact_messages', 0);
    }

    public function test_admin_can_mark_and_delete_contact_messages(): void
    {
        $this->authenticateAdmin();
        $message = ContactMessage::query()->create([
            'name' => 'Ayu',
            'email' => 'ayu@example.com',
            'message' => 'Minta informasi.',
        ]);

        $this->patchJson("/api/admin/messages/{$message->id}/read")
            ->assertOk()
            ->assertJsonPath('data.is_read', true);
        $this->assertDatabaseHas('contact_messages', ['id' => $message->id, 'is_read' => true]);

        $this->deleteJson("/api/admin/messages/{$message->id}")
            ->assertOk()
            ->assertJsonPath('deleted', true);
        $this->assertDatabaseMissing('contact_messages', ['id' => $message->id]);
    }

    private function authenticateAdmin(): User
    {
        config(['portfolio.admin.email' => 'admin@example.com']);

        return tap(User::factory()->create(['email' => 'admin@example.com']), fn (User $admin) => $this->actingAs($admin));
    }

    private function validPortfolioContent(string $name): array
    {
        $content = config('portfolio.initial_content');
        $content['profile']['name'] = $name;

        return $content;
    }
}

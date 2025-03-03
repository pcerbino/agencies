<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Agency;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;

class AgencyApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_an_agency()
    {
        $payload = [
            'email' => 'test@example.com',
            'name' => 'Test Agency',
            'secret' => 'supersecret'
        ];

        $response = $this->postJson('/api/agencies', $payload);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id'
            ]);

        $this->assertDatabaseHas('agencies', [
            'email' => 'test@example.com',
            'name' => 'Test Agency',
        ]);
    }


    /** @test */
    public function it_requires_unique_email_when_creating_agency()
    {
        Agency::factory()->create(['email' => 'test@example.com']);

        $payload = [
            'email' => 'test@example.com',
            'name' => 'Another Agency',
            'secret' => 'anothersecret'
        ];

        $response = $this->postJson('/api/agencies', $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function it_retrieves_an_agency_by_email()
    {
        $agency = Agency::factory()->create([
            'email' => 'test@example.com',
            'name' => 'Test Agency',
            'secret' => Crypt::encryptString('mysecretstring')
        ]);

        $response = $this->getJson('/api/agencies?email=test@example.com');

        $response->assertStatus(200)
            ->assertJson([
                'id' => $agency->id,
                'name' => 'Test Agency',
                'email' => 'test@example.com',
                'secret' => 'mysecretstring'
            ]);
    }
}

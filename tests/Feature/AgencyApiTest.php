<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
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
}

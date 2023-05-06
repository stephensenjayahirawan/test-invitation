<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    private User $manager;
    private User $admin;
    protected function setUp(): void{
        parent::setUp();
        $this->manager = $this->create_manager();
        $this->admin = $this->create_admin();
    }
     
    public function create_manager(){
        return User::factory()->create([
            'role' => 'manager',
        ]);
    }
    public function create_admin(){
        return User::factory()->create([
            'role' => 'admin',
        ]);
    }
    
    public function test_manager_cannot_open_user_page()
    {
        $response = $this->actingAs($this->manager)->get('/users');

        $response->assertStatus(403);
    }

    public function test_admin_can_open_user_page()
    {
        $response = $this->actingAs($this->admin)->get('/users');

        $response->assertStatus(200);
    }
}

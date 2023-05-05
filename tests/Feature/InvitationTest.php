<?php

namespace Tests\Feature;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvitationTest extends TestCase
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
    
    public function test_admin_open_inviatation_page()
    {
        $response = $this->actingAs($this->admin)->get('/invitations');

        $response->assertStatus(200);
    }

    public function test_manager_open_inviatation_page()
    {
        $response = $this->actingAs($this->manager)->get('/invitations');

        $response->assertStatus(200);
    }
    
    public function test_admin_open_crete_inviatation_page()
    {
        $response = $this->actingAs($this->admin)->get('/invitations');

        $response->assertStatus(200);
    }
    
    public function test_manager_open_create_inviatation_page()
    {
        $response = $this->actingAs($this->manager)->get('/invitations');

        $response->assertStatus(200);
    }
    
    public function test_admin_crete_inviatation()
    {
        $invitation = [
            'name' => 'Kim Jisoo',
            'email' => 'stphn2909@gmail.com',
            'role' => 'admin'
        ];
        $this->assertDatabaseEmpty(table: 'invitations');
        $response = $this->actingAs($this->admin)->post('/invitations', $invitation);

        $this->assertDatabaseHas(table: 'invitations', data: $invitation);
        $response->assertStatus(302);
        $response->assertRedirectToRoute('invitations');
    }
    
    public function test_manager_create_admin_inviatation()
    {
        $invitation = [
            'name' => 'Kim Jisoo',
            'email' => 'stphn2909@gmail.com',
            'role' => 'admin'
        ];
        $response = $this->actingAs($this->manager)->post('/invitations', $invitation);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('role');
    }

    public function test_manager_create_manager_inviatation()
    {
        $invitation = [
            'name' => 'Kim Jisoo',
            'email' => 'stphn2909@gmail.com',
            'role' => 'manager'
        ];
        $response = $this->actingAs($this->manager)->post('/invitations', $invitation);

        $this->assertDatabaseHas(table: 'invitations', data: $invitation);
        $response->assertStatus(302);
        $response->assertRedirectToRoute('invitations');
    }
}

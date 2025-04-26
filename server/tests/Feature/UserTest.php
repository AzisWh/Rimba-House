<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */

     use RefreshDatabase;

    public function test_add_user_success()
    {
        $response = $this->postJson('/api/user/addUser', [
            'name' => 'alitopan',
            'email' => 'topantambah@gmail.com',
            'age' => 30
        ]);

        $response->assertStatus(201)
                ->assertJson(['message' => 'User berhasil ditambah']);
    }

    public function test_add_user_validation_failed()
    {
        $response = $this->postJson('/api/user/addUser', [
            'name' => '',
            'email' => 'not-an-email',
            'age' => -1
        ]);

        $response->assertStatus(422);  
    }

    public function test_get_all_users_success()
    {
        User::factory()->create(['name' => 'topan belum update','email' => 'topangaming@gmail.com', 'age' => 55]);
        User::factory()->create(['name' => 'TOPIN','email' => 'topingamingedit@gmail.com', 'age' => 25]);

        $response = $this->getJson('/api/allUser');

        $response->assertStatus(200)
                 ->assertJsonCount(2) 
                 ->assertJsonStructure([ 
                     '*' => ['id', 'name', 'email', 'age'] //cekstruktur response
                 ]);
    }

    public function test_get_user_by_id_success()
    {
        $user = User::factory()->create(['name' => 'topan belum update','email' => 'topangaming@gmail.com', 'age' => 55]);

        $response = $this->getJson("/api/user/{$user->id}");

        $response->assertStatus(200)
                 ->assertJson(['id' => $user->id]);
    }

    public function test_get_user_by_id_not_found()
    {
        $response = $this->getJson('/api/user/999999');

        $response->assertStatus(404)
                 ->assertJson(['message' => 'User tidak ditemukan']);
    }

    public function test_edit_user_success()
    {
        $user = User::factory()->create(['name' => 'topan belum update','email' => 'topangaming@gmail.com', 'age' => 55]);

        $response = $this->putJson("/api/user/editUser/{$user->id}", [
            'name' => 'update topan',
            'email' => 'topanupdate@gmail.com',
            'age' => 35
        ]);

        $response->assertStatus(200)
                 ->assertJson(['message' => 'User berhasil diupdate'])
                 ->assertJson(['user' => ['name' => 'update topan']]);
    }

    public function test_edit_user_validation_failed()
    {
        $user = User::factory()->create(['name' => 'topan belum update','email' => 'topangaming@gmail.com', 'age' => 55]);

        $response = $this->putJson("/api/user/editUser/{$user->id}", [
            'email' => 'not-an-email'
        ]);

        $response->assertStatus(422);//failed 
    }

    public function test_edit_user_not_found()
    {
        $response = $this->putJson('/api/user/editUser/999999', [
            'name' => 'Updated Name'
        ]);

        $response->assertStatus(404)
                 ->assertJson(['message' => 'User tidak ditemukan']);
    }

    public function test_delete_user_success()
    {
        $user = User::factory()->create(['name' => 'topan belum update','email' => 'topangaming@gmail.com', 'age' => 55]);

        $response = $this->deleteJson("/api/user/delUser/{$user->id}");

        $response->assertStatus(200)
                 ->assertJson(['message' => 'User berhasil dihapus']);
    }

    public function test_delete_user_not_found()
    {
        $response = $this->deleteJson('/api/user/delUser/999999');

        $response->assertStatus(404)
                 ->assertJson(['message' => 'User tidak ditemukan']);
    }

}

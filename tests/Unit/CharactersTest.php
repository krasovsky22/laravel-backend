<?php

namespace Tests\Unit;

use App\Character;
use App\User;
use CharactersTableSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Passport\Passport;
use Tests\TestCase;
use UsersTableSeeder;
use function count;

class CharactersTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->seed(UsersTableSeeder::class);
        $this->seed(CharactersTableSeeder::class);

        Passport::actingAs(
            factory(User::class)->create()
        );
    }

    public function testUsersDatabase()
    {
        $characters = Character::all();
        $this->assertGreaterThanOrEqual(CharactersTableSeeder::CHARACTERS_NUMBER, count($characters));
    }

    public function testClientsController()
    {
        $response = $this->get('/api/users');
        $response->assertStatus(200);
    }

}

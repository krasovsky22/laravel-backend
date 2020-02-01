<?php

use Illuminate\Database\Seeder;

class CharactersTableSeeder extends Seeder
{
    const CHARACTERS_NUMBER = 10;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Character::class, self::CHARACTERS_NUMBER)->create();
    }
}

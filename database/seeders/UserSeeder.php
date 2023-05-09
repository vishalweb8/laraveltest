<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();

        $users = User::factory()->count(10)->create();

        foreach ($users as $user) {
            $user->setManyMeta([
                'age' => rand(18, 65),
                'gender' => $faker->randomElement(['male', 'female', 'non-binary']),
                'occupation' => $faker->jobTitle(),
                'location' => $faker->city(),
            ]);
        }

    }
}

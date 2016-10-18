<?php

use Illuminate\Database\Seeder;
use SgcAdmin\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create(
            [
                'name' => 'Administrador',
                'email' => 'root@devyzi.com',
                'password' => bcrypt('devsis357@#'),
                'role' => 'admin',
                'remember_token' => str_random(10),
            ]
        );
    }
}

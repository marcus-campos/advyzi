<?php

use Illuminate\Database\Seeder;

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

        factory(User::class)->create(
            [
                'name' => 'Chefe',
                'email' => 'chefe@devyzi.com',
                'password' => bcrypt('123456'),
                'role' => 'boss',
                'remember_token' => str_random(10),
            ]
        );

        factory(User::class)->create(
            [
                'name' => 'Vendedor',
                'email' => 'vendedor@devyzi.com',
                'password' => bcrypt('123456'),
                'role' => 'salesman',
                'remember_token' => str_random(10),
            ]
        );

        /*factory(User::class, 10)->create()->each(function ($u){
            $u->client()->save(factory(Client::class)->make());
        });*/
    }
}

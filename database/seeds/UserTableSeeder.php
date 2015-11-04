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
        factory(App\Models\User::class, 50)->create();

        $users = [
            [
                'username' => 'spock',
                'name' => 'Spock',
                'email' => 'spock@startrek.com',
                'status' => 'ativo',
                'password' => bcrypt('123456'),
            ],
            [
                'username' => 'james',
                'name' => 'James',
                'email' => 'james.t@startrek.com',
                'status' => 'ativo',
                'password' => bcrypt('123456'),
            ],
            [
                'username' => 'hikaru',
                'name' => 'Hikaru',
                'email' => 'hikaru@startrek.com',
                'status' => 'ativo',
                'password' => bcrypt('123456'),
            ],
        ];

        foreach ($users as $user) {
            App\Models\User::create($user);
        }
    }
}

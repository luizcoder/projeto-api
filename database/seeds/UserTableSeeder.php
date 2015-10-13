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
        
        factory(App\User::class, 50)->create();
        
        $users = [
            [
                'name'=> "Spock",
                'email'=> "spock@startrek.com",
                'password'=> bcrypt("123")
            ],  
            [
                'name'=> "James",
                'email'=> "james.t@startrek.com",
                'password'=> bcrypt("123")
            ],  
            [
                'name'=> "Hikaru",
                'email'=> "hikaru@startrek.com",
                'password'=> bcrypt("123")
            ]
        ];

        foreach($users as $user){

            App\User::create($user);
        }

    }
}

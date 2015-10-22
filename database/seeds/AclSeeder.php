<?php

use Illuminate\Database\Seeder;

class AclSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $adminGroup = App\Models\Group::create([
                'name' => 'admin',
                'display_name' => 'Administradores',
                'description' => 'Grupo dos administradores',
            ]);

        $listUserRule =  App\Models\Rule::create([
                'name' => 'get.user',
                'display_name' => 'Listar usuários',
                'description' => 'Permite listar os usuários cadastrados.',
            ]);

        $adminGroup->rules()->attach($listUserRule->id);

        $user = App\Models\User::where('username','spock')->first();

        $user->groups()->attach($adminGroup->id);

    }
}

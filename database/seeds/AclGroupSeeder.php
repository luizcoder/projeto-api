<?php

use Illuminate\Database\Seeder;

class AclGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Cadastrando/buscandos os grupos
        $adminGroup = App\Models\Group::firstOrCreate([
                'name' => 'admin',
                'display_name' => 'Administradores',
                'description' => 'Grupo dos administradores',
            ]);

        $userGroup = App\Models\Group::firstOrCreate([
                'name' => 'user',
                'display_name' => 'Usuários',
                'description' => 'Grupo dos usuários',
            ]);

        // retornando id das rules
        $rules_id = App\Models\Rule::lists('id')->toArray();

        // relacionando rules ao grupo
        $adminGroup->rules()->sync($rules_id);

        // Adicionando usuário ao grupo
        $user = App\Models\User::where('username', 'spock')->first();
        $user->groups()->attach($adminGroup->id);
    }
}

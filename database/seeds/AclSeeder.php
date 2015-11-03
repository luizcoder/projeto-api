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

        $userGroup = App\Models\Group::create([
                'name' => 'user',
                'display_name' => 'Usuários',
                'description' => 'Grupo dos usuários',
            ]);

        $listUserRule = App\Models\Rule::create([
                'name' => 'listar.usuario',
                'display_name' => 'Listar usuário',
                'description' => 'Permite listar os usuários cadastrados.',
            ]);

        $updateUserRule = App\Models\Rule::create([
                'name' => 'alterar.usuario',
                'display_name' => 'Alterar usuários',
                'description' => 'Permite alterar os usuários cadastrados.',
            ]);

        $createUserRule = App\Models\Rule::create([
                'name' => 'cadastrar.usuario',
                'display_name' => 'Cadastrar usuários',
                'description' => 'Permite cadastrar usuários.',
            ]);

        $deleteUserRule = App\Models\Rule::create([
                'name' => 'deletar.usuario',
                'display_name' => 'Deletar usuários',
                'description' => 'Permite deletar usuários.',
            ]);

        $updateUserPasswordRule = App\Models\Rule::create([
                'name' => 'alterar.senha.usuario',
                'display_name' => 'Alterar senha dos usuários',
                'description' => 'Permite alterar senha dos usuários.',
            ]);

        $listGroupRule = App\Models\Rule::create([
                'name' => 'listar.grupo',
                'display_name' => 'Listar grupo',
                'description' => 'Permite listar os grupos cadastrados.',
            ]);

        $updateGroupRule = App\Models\Rule::create([
                'name' => 'alterar.grupo',
                'display_name' => 'Alterar grupos',
                'description' => 'Permite alterar os grupos cadastrados.',
            ]);

        $createGroupRule = App\Models\Rule::create([
                'name' => 'cadastrar.grupo',
                'display_name' => 'Cadastrar grupos',
                'description' => 'Permite cadastrar grupos.',
            ]);

        $deleteGroupRule = App\Models\Rule::create([
                'name' => 'deletar.grupo',
                'display_name' => 'Deletar grupos',
                'description' => 'Permite deletar grupos.',
            ]);

        $adminGroup->rules()->attach([
            $listUserRule->id,
            $updateUserRule->id,
            $createUserRule->id,
            $deleteUserRule->id,
            $updateUserPasswordRule->id,
            $listGroupRule->id,
            $updateGroupRule->id,
            $createGroupRule->id,
            $deleteGroupRule->id,
        ]);

        $userGroup->rules()->attach([
            $listUserRule->id,
            $updateUserRule->id,

        ]);

        $user = App\Models\User::where('username', 'spock')->first();
        $user->groups()->attach($adminGroup->id);
    }
}

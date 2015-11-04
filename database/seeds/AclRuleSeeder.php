<?php

use Illuminate\Database\Seeder;

class AclRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listUserRule = App\Models\Rule::firstOrCreate([
                'name' => 'listar.usuario',
                'display_name' => 'Listar usuário',
                'description' => 'Permite listar os usuários cadastrados.',
            ]);

        $updateUserRule = App\Models\Rule::firstOrCreate([
                'name' => 'alterar.usuario',
                'display_name' => 'Alterar usuários',
                'description' => 'Permite alterar os usuários cadastrados.',
            ]);

        $createUserRule = App\Models\Rule::firstOrCreate([
                'name' => 'cadastrar.usuario',
                'display_name' => 'Cadastrar usuários',
                'description' => 'Permite cadastrar usuários.',
            ]);

        $deleteUserRule = App\Models\Rule::firstOrCreate([
                'name' => 'deletar.usuario',
                'display_name' => 'Deletar usuários',
                'description' => 'Permite deletar usuários.',
            ]);

        $updateUserPasswordRule = App\Models\Rule::firstOrCreate([
                'name' => 'alterar.senha.usuario',
                'display_name' => 'Alterar senha dos usuários',
                'description' => 'Permite alterar senha dos usuários.',
            ]);

        $listGroupRule = App\Models\Rule::firstOrCreate([
                'name' => 'listar.grupo',
                'display_name' => 'Listar grupo',
                'description' => 'Permite listar os grupos cadastrados.',
            ]);

        $updateGroupRule = App\Models\Rule::firstOrCreate([
                'name' => 'alterar.grupo',
                'display_name' => 'Alterar grupos',
                'description' => 'Permite alterar os grupos cadastrados.',
            ]);

        $createGroupRule = App\Models\Rule::firstOrCreate([
                'name' => 'cadastrar.grupo',
                'display_name' => 'Cadastrar grupos',
                'description' => 'Permite cadastrar grupos.',
            ]);

        $deleteGroupRule = App\Models\Rule::firstOrCreate([
                'name' => 'deletar.grupo',
                'display_name' => 'Deletar grupos',
                'description' => 'Permite deletar grupos.',
            ]);

        $listRoutesRule = App\Models\Rule::firstOrCreate([
                'name' => 'listar.rotas',
                'display_name' => 'Listar rotas',
                'description' => 'Permite listar as rotas disponíveis.',
            ]);
    }
}

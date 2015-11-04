<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use App\Models\Group;

class GroupController extends Controller
{
    public function __construct()
    {
        //
    }

    public function validator($data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'display_name' => 'required',
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Paginação padrão
        $per_page = 10;

        //Caso seja enviado paramento de paginação
        //o valor padrão será alterado
        if ($request->input('per_page')) {
            $per_page = $request->input('per_page');
        }

        //Caso seja enviado paramento para busca
        if ($request->input('search')) {
            $groups = Group::with(['rules'])->search($request->input('search'))
                        ->paginate($per_page);

        // Se nenhum parametro for enviado
        // retorna todos os dados da tabela
        } else {
            $groups = Group::with(['rules'])->paginate($per_page);
        }

        return $groups;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['name', 'display_name', 'description', 'rules_id']);

        $validator = $this->validator($data);

        if ($validator->fails()) {
            return ['created' => false,'errors' => $validator->errors()->all()];
        }

        $group = Group::create($data);
        $group->fill($data);

        $group->rules()->detach();
        if (isset($data['rules_id'])) {
            $group->rules()->attach(array_unique($data['rules_id']));
        }

        $group->load('rules');

        $group->save();

        return ['created' => true,'group' => $group];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only(['name', 'display_name', 'description', 'rules_id']);

        $validator = $this->validator($data);

        if ($validator->fails()) {
            return ['updated' => false,'errors' => $validator->errors()->all()];
        }

        $group = Group::find($id);
        $group->update($data);

        $group->rules()->detach();
        if (isset($data['rules_id'])) {
            $group->rules()->attach(array_unique($data['rules_id']));
        }

        $group->load('rules');

        return ['updated' => true,'group' => $group];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Group::findOrFail($id)->delete()) {
            return ['deleted' => true];
        } else {
            return ['deleted' => false];
        }
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    public function __construct()
    {
       // Apply the jwt.auth middleware to all methods in this controller
       // except for the authenticate method. We don't want to prevent
       // the user from retrieving their token if they don't already have it
       $this->middleware('jwt.auth');
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
        if($request->input('per_page')){
            $per_page = $request->input('per_page');
        }

        //Caso seja enviado paramento para busca
        if($request->input('search')){

            $users = User::search($request->input('search'))
                        ->paginate($per_page);

        // Se nenhum parametro for enviado
        // retorna todos os dados da tabela
        }else{

            $users = User::paginate($per_page);
        }

        return $users;
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

        $data = $request->only(['name','email','password','password_confirmation']);
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id)->get();
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
        $user = User::findOrFail($id);
        $user->update(['name'=> $request->input('name'), 'email'=>$request->input('email')]);

        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, $id)
    {

        $data = $request->only(['password','password_confirmation']);
        $validator = Validator::make($data, [
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return ['updated' => false,'errors' => $validator->errors()->all()];
        }

        $user = User::findOrFail($id);
        $user->update(['password'=> bcrypt($request->input('password'))]);

        return ['updated' => true];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(User::findOrFail($id)->delete()) {
            return ['deleted'=>true];
        }else{
            return ['deleted'=>false];
        }
    }
}

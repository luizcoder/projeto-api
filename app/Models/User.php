<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Carbon\Carbon;
use App\EloquentSearch;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, EloquentSearch;

    /**
     * Additional Columns
     *
     * @var string
     */

    protected $appends = ['rules'];
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username','name', 'email', 'password','status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Colunas que serão utilizadas para busca rápida
     *
     * @var array
     */
    protected $searchable = ['username','name' ,'email','status'];


    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y H:i:s');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y H:i:s');
    }

    public function getRulesAttribute(){

        return $this->rules();
    }

    public function groups()
    {
        return $this->belongsToMany('App\Models\Group');
    }

    /*
     * Verificar se o usuário possui permissão de acesso
     *
     * @string name
     * @return Boolean
     */
    public function hasRule($rule_name){
        $valid = false;
        $rules = $this->rules();

        $array = array_where($rules, function($key, $value) use($rule_name)
        {
            if( $rule_name == $value->name ){
                return true;
            }
        });

        if(sizeOf($array) > 0)
            $valid = true;

        return $valid;
    }


    /*
    * Retornar lista de pesmissões do usuário
    */
    public function rules(){
        $rules = Rule::join('group_rule', 'rules.id', '=', 'group_rule.rule_id')
                     ->join('group_user', 'group_user.group_id', '=', 'group_rule.group_id')
                     ->where('group_user.user_id', $this->id)->get();

         return $rules;
     }
}

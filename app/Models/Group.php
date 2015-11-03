<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\EloquentSearch;

class Group extends Model
{
    use EloquentSearch;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','display_name', 'description'];

    /**
     * Colunas que serão utilizadas para busca rápida
     *
     * @var array
     */
    protected $searchable = ['name','display_name' ,'description'];

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y H:i:s');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y H:i:s');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }

    public function rules()
    {
        return $this->belongsToMany('App\Models\Rule');
    }
}

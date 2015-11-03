<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\EloquentSearch;

class Rule extends Model
{
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
    protected $table = 'rules';

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


    public function groups()
    {
        return $this->belongsToMany('App\Models\Groups');
    }

}

<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Rule;

use Validator;

class AclController extends Controller
{

    public function __construct()
    {

    }


    public function getGroup() {
        return Group::all();
    }

    public function getRule() {
        return Rule::all();
    }

}

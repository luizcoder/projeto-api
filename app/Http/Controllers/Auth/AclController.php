<?php

namespace app\Http\Controllers\Auth;

use Illuminate\Http\Request;

use app\Http\Requests;
use app\Http\Controllers\Controller;
use app\Models\Group;
use app\Models\Rule;

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

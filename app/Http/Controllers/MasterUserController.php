<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
class MasterUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function masterdatahardware()
    {
        return view('userleader.masterdata.view');
    }
}

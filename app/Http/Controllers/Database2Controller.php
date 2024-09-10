<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class Database2Controller extends Controller
{
    //
    public function show()
    {
        $pdo = DB::connection('second_db')->table('log')->orderBy('logID','DESC')->take(10)->get();
        dd($pdo);
    }
}

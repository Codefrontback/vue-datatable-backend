<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function getStudents(Request $request)
    {
        if($request['query'])
        {
            $users = User::select('id', 'name', 'email')->where('name', 'like', '%' . $request['query'] . '%')->paginate($request->limit ? $request->limit : 20);
        }
        elseif($request->orderBy)
        {
            $users = User::select('id', 'name', 'email')->orderBy($request->orderBy, $request->ascending == 1 ? 'ASC' : 'DESC')->paginate($request->limit ? $request->limit : 20);
        }
        else
        {
            $users = User::select('id', 'name', 'email')->paginate($request->limit ? $request->limit : 20);
        }

        return response()->json($users);
    }
}
<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as time;

class RoleController extends Controller
{
    public function index()
    {
        $role = DB::table('role')
        ->select('id','name','description')
        ->where('status','=',1)
        ->get();
        return response()->json($role);
    }

    public function store(Request $request)
    {
        $role = new Role([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'createdBy' => 1,
            'createdDate' => time::now(),
            'status' => $request->get('status')
        ]);
        $role->save();
        return response($role, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $role = DB::table('role')
        ->select('id','name','description')
        ->where('id','=',$id)
        ->get();
        return response()->json($role);
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->name = $request->get('name');
        $role->description = $request->get('description');
        $role->updatedBy = 1;
        $role->updatedDate = time::now();
        $role->status = $request->get('status');
        $role->save();
         return response()->json($role);
    }
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        return response()->json($role);
    }
}

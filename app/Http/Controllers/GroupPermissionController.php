<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

class GroupPermissionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $group = Group::findOrFail($request->group_id);
        
        $group->permissions()->syncWithoutDetaching($request->permission_id);

        return back()->withSuccess('Permissão cadastrada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $groupId, int $permissionId)
    {
        $group = Group::findOrFail($groupId);
        $group->permissions()->detach($permissionId);

        return back()->withSuccess('Permissão removida com sucesso!');
    }
}

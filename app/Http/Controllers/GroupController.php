<?php

namespace App\Http\Controllers;

use App\{Group, Permission};
use Illuminate\Http\Request;
use App\Http\Requests\GroupRequest;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request('search');
        
        $groups = Group::with('users')
                    ->search($search)
                    ->orderBy('name')
                    ->paginate(10);
                    
        return view('groups.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('groups.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupRequest $request)
    {
        Group::create($request->all());

        return redirect('groups')
            ->withSuccess('Grupo cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        $permissions = Permission::all();
        return view('groups.form', compact('group', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GroupRequest $request, Group $group)
    {
        $group->update($request->all());

        return redirect('groups')
            ->withSuccess('Grupo atualizado com sucesso!');       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {  
        if ($group->users()->exists()) {
            return back()->withError('Oops, há usuários cadastros para o grupo, por favor verifique!');
        }

        $group->delete();

        return back()->withSuccess('Grupo excluído com sucesso!');
    }
}

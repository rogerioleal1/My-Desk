<?php

namespace App\Http\Controllers;

use Image;
use Illuminate\Http\Request;
use App\{User, Group, Company, System};
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request('search');
        
        $users = User::with('group')
                    ->search($search)
                    ->orderBy('name')
                    ->paginate(20);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.form', [
            'groups'    => Group::all(),
            'companies' => Company::all(),
            'systems'   => System::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $data = $request->all();

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $this->storeAvatar($request);
        }

        $user = User::create($data);

        foreach ($data['systems'] as $system) {
            $user->systems()->attach($system);
        }

        return redirect('users')
            ->withSuccess('Usuário cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $userSystems = $user->systems()->get()->toArray();

        $allowedSystems = array_map(function ($system) {
            return $system['id'];
        }, $userSystems);

        return view('users.form', [
            'user'      => $user,
            'groups'    => Group::all(),
            'companies' => Company::all(),
            'systems'   => System::all(),
            'allowedSystems' => $allowedSystems,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->filled('password')
              ? $request->all()
              : $request->except(['password', 'password_confirmation']);
              
        if ($request->hasFile('avatar')) {
            $data['avatar'] = $this->storeAvatar($request);
        }
                
        $user->update($data);
        
        foreach ($data['systems'] as $system) {
            $user->systems()->syncWithoutDetaching($system);
        }

        return redirect('users')
            ->withSuccess('Usuário atualizado com sucesso!');       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user == auth()->user()) {
            return back()->withError('Oops, Não é permitido remover o próprio usuário!');
        }
        
        $user->delete();

        return redirect('users')
            ->withSuccess('Usuário excluído com sucesso!');
    }

    public function storeAvatar($request)
    {
        if ($request->old_avatar != 'avatars/avatar.png') {
            Storage::delete($request->old_avatar);
        }

        $avatar = Storage::putFile('avatars', $request->avatar);

        $path = public_storage_path($avatar);

        Image::make($path)->resize(180, 180)->save($path);

        return $avatar;
    }
}

<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ChangeProfileRequest;

class ChangeProfile extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.userdata', ['user' => Auth::user()]);
    }

    public function update(ChangeProfileRequest $request)
    {
        $data = $request->filled('password')
              ? $request->all()
              : $request->except(['password', 'password_confirmation']);
              
        if ($request->hasFile('avatar')) {
            $data['avatar'] = $this->storeAvatar($request);
        }
                
        $request->user()->update($data);
        
        return back()->withSuccess('Perfil alterado com sucesso!'); 
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
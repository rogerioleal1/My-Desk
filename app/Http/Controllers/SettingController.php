<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Http\Requests\SettingRequest;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(SettingRequest $request, Setting $setting)
    {
        $data = $request->all();

        if ($request->hasFile('logo')) {
            $data['logo'] = $this->storeLogo($request);
        }

        $setting->update($data);

        return redirect('settings')->withSuccess('Configurações salvas com sucesso!');       
    }

    public function storeLogo($request)
    {
        Storage::delete($request->old_logo);
        return Storage::putFile('settings', $request->logo);
    }
}

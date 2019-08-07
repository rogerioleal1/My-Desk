<?php

namespace App\Http\Controllers;

use App\System;
use Illuminate\Http\Request;
use App\Http\Requests\SystemRequest;

class SystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request('search');
        
        $systems = System::search($search)
                        ->orderBy('name')
                        ->paginate(10);
                    
        return view('systems.index', compact('systems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('systems.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SystemRequest $request)
    {
        System::create($request->all());

        return redirect('systems')
            ->withSuccess('Sistema cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(System $system)
    {
        return view('systems.form', compact('system'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SystemRequest $request, System $system)
    {
        $system->update($request->all());

        return redirect('systems')
            ->withSuccess('Sistema atualizado com sucesso!');       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(System $system)
    {  
        if ($system->users()->exists()) {
            return back()->withError('Oops, há usuários associados à esse sistema, por favor verifique!');
        }

        $system->delete();

        return redirect('systems')
            ->withSuccess('Sistema excluído com sucesso!');
    }
}

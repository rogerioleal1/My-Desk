<?php

namespace App\Http\Controllers;

use Auth;
use App\Mail\{TicketCreated, TicketUpdated};
use Illuminate\Http\Request;
use App\Http\Requests\TicketRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

use App\{Ticket, Category, User, Document};

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request('search');

        $tickets = Ticket::search($search)
                        ->orderBy('status', 'asc')
                        ->paginate(10);

        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tickets.form', [
            'categories'  => Category::whereStatus(1)->get(),
            'systems'     => Auth::user()->systems,
            'technicians' => User::whereIn('group_id', [1, 2])->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketRequest $request)
    {
        $ticket = Auth::user()->tickets()->create($request->all());

        if ($request->hasFile('documents')) {
            $this->storeDocuments($ticket, $request->documents);
        }

        $ticket->followups()->create([
            'user_id' => Auth::user()->id,
            'title'   => 'Criou chamado id: ' . format_ticket_id($ticket->id),
        ]);

        //Mail::to('seu-email@gmail.com')->queue(new TicketCreated($ticket));

        return redirect('tickets')
            ->withSuccess('Chamado cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        return view('tickets.form', [
            'ticket'      => $ticket,
            'categories'  => Category::whereStatus(1)->get(),
            'systems'     => Auth::user()->systems,
            'technicians' => User::whereIn('group_id', [1, 2])->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TicketRequest $request, Ticket $ticket)
    {
        $data = $request->all();

        if ($ticket->getOriginal('solution') != $request->get('solution')) {
            $data['status']    = 4;
            $data['solved_at'] = now();
        }

        $ticket->update($data);

        if ($request->hasFile('documents')) {
            $this->storeDocuments($ticket, $request->documents);
        }

        //Mail::to('seu-email@gmail.com')->queue(new TicketUpdated($ticket));

        return back()->withSuccess('Chamado atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect('tickets')
            ->withSuccess('Chamado excluído com sucesso!');
    }

    public function storeDocuments(Ticket $ticket, $documents)
    {
        foreach ($documents as $document) {

            // $fileName = $document->getClientOriginalName();

            $fileHash = str_replace('.' . $document->extension(), '', $document->hashName());
            $fileName = $fileHash . '.' . $document->getClientOriginalExtension();

            $path = Storage::putFileAs('documents', $document, $fileName);

            $ticket->documents()->create([
                'user_id'  => Auth::user()->id,
                'filepath' => $path
            ]);
        }
    }

    public function feedback(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $ticket->status = $request->status;
        $ticket->rating = $request->rating;

        $ticket->save();

        $approved = $request->status == 5 ? 'Aprovou' : 'Reprovou';
        $title = $approved . ' solução descrita no chamado, avaliou com ' . $request->rating . ' estrela(s)';

        $ticket->followups()->create([
            'user_id' => Auth::user()->id,
            'title'   => $title,
            'message' => $request->message,
        ]);

        return back()->withSuccess('Chamado atualizado com sucesso!');
    }

    public function followup(Request $request)
    {
        $ticket = Ticket::findOrFail($request->ticket_id);

        $ticket->followups()->create([
            'user_id' => Auth::user()->id,
            'title'   => 'Inseriu novo comentário no acompanhamento do chamado',
            'message' => $request->message,
        ]);

        return back()->withSuccess('Comentário registrado com sucesso!');
    }
}

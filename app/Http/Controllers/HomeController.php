<?php

namespace App\Http\Controllers;

use App\{Ticket, Message};
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = [
            'allTickets' => Ticket::all()->count(),
            'opened'     => Ticket::whereStatus(1)->count(),
            'inProgress' => Ticket::whereStatus(2)->count(),
            'pending'    => Ticket::whereStatus(3)->count(),
            'solved'     => Ticket::whereStatus(4)->count(),
            'closed'     => Ticket::whereStatus(5)->count(),
            'latest'     => Ticket::latest()->take(20)->get(),
        ];
        
        $messages = Message::getMessages();

        return view('home', compact('tickets','messages'));
    }
}

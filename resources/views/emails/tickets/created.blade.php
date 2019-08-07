@component('mail::message')
# Chamado {{ format_ticket_id($ticket->id) }} criado com sucesso!

@component('mail::table')
|                   |                                                    |
| ----------------- |----------------------------------------------------| 
| Assunto           | {{ $ticket->subject }}                             | 
| Solicitante       | {{ $ticket->user->name }}                          | 
| Data de Abertura  | {{ $ticket->created_at->format('d.m.Y H:i:s') }}   | 
| Prioridade        | {{ get_priority_ticket($ticket->priority) }}       | 
| Status            | {{ get_status_ticket($ticket->status) }}           | 
| Técnico           | {{ $ticket->technician->name ?? 'Não Atribuído' }} | 
@endcomponent

<hr>

<div class="description">
    {!! $ticket->description !!}
</div>

@component('mail::button', ['url' => $url])
Clique aqui para visualizar o chamado
@endcomponent

@endcomponent

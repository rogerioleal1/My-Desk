@extends('layouts.app')

@section('content')

@push('styles')
    <style>
        .container {
            max-width: 90% !important;
        }
    </style>
@endpush

<div class="row justify-content-center">
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fa fa-ticket-alt"></i> Chamados
            </h1>
        </div>

        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Listagem Chamados
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form method="GET" action="{{ route('tickets.index') }}">
                            <div class="input-group mb-3">
                                <input class="form-control" name="search" value="{{ request('search') ?? '' }}" 
                                    placeholder="Filtrar por assunto, descrição..."/>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="submit">
                                        <i class="fa fa-search"></i> Buscar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    @can('tickets.create')
                    <div class="col-md-6 text-right">
                        <a href="{{ route('tickets.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Novo Chamado
                        </a>
                    </div>
                    @endcan

                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Solicitante</th>
                                    <th>Assunto</th>
                                    <th>Prioridade</th>
                                    <th>Data de Abertura</th>
                                    <th>Técnico</th>
                                    <th>Status</th>
                                    <th class="text-center" width="12%">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($tickets as $ticket)
                                <tr>
                                    <td>
                                        <a href="{{ route('tickets.show', $ticket->id) }}">
                                            {{ format_ticket_id($ticket->id) }}
                                        </a>
                                    </td>
                                    <td>{{ $ticket->user->name }}</a>
                                    <td>{{ $ticket->subject }}</td>
                                    <td>{{ get_priority_ticket($ticket->priority) }}</a>
                                    <td>{{ $ticket->created_at->format('d.m.Y') }}</td>
                                    <td>{{ $ticket->technician->name ?? 'Não Atribuído' }}</td>
                                    <td>
                                        <span class="btn btn-sm btn-{{ get_color_ticket($ticket->status) }} ">
                                            {{ get_status_ticket($ticket->status) }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-sm btn-secondary" title="Visualizar Chamado">
                                            <i class="fa fa-search"></i>
                                        </a>
                             
                                        <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-sm btn-info" title="Editar Chamado">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        @can('tickets.destroy')
                                        <a href="javascript:;" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $ticket->id }})" title="Excluir Chamado">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        @endcan
        
                                        <form id="btn-delete-{{ $ticket->id }}" action="{{ route('tickets.destroy', $ticket->id) }}"
                                            method="post" class="hidden">
        
                                            @method('DELETE')
                                            @csrf
        
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">
                                        <div class="alert alert-danger text-center">
                                            <i class="fa fa-exclamation-triangle"></i>
                                            Oops... nenhum registro encontrado!
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        <div class="row justify-content-md-center">
                            {{ $tickets->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
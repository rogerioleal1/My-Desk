@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fa fa-info-circle"></i> Avisos
            </h1>
        </div>

        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Listagem dos Avisos do Sistema
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form method="GET" action="{{ route('messages.index') }}">
                            <div class="input-group mb-3">
                                <input class="form-control" name="search" value="{{ request('search') ?? '' }}" placeholder="Filtrar por nome ou descrição..."/>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="submit" >
                                        <i class="fa fa-search"></i> Buscar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    @can('messages.create')
                    <div class="col-md-6 text-right">
                        <a href="{{ route('messages.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Novo Aviso
                        </a>
                    </div>
                    @endcan

                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Assunto</th>
                                    <th>Inicia em</th>
                                    <th>Expira em</th>
                                    <th>Data do Cadastro</th>
                                    <th>Status</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($messages as $message)
                                <tr>
                                    <td>{{ $message->id }}</td>
                                    <td>
                                        <a href="{{ route('messages.show', $message->id) }}">
                                            {{ $message->subject }}
                                        </a>
                                    </td>
                                    <td>{{ $message->starts_from->format('d.m.Y') }}</td>
                                    <td>{{ $message->expires_at->format('d.m.Y') }}</td>
                                    <td>{{ $message->created_at->format('d.m.Y H:i:s') }}</td>
                                    <td class="text-center">{{ icon_status($message->status) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('messages.show', $message->id) }}" class="btn btn-sm btn-secondary" title="Visualizar Aviso">
                                            <i class="fa fa-search"></i>
                                        </a>

                                        <a href="{{ route('messages.edit', $message->id) }}" class="btn btn-sm btn-info" title="Editar Aviso">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        
                                        <a href="javascript:;" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $message->id }})" title="Excluir Aviso">
                                            <i class="fa fa-trash"></i>
                                        </a>
        
                                        <form id="btn-delete-{{ $message->id }}" action="{{ route('messages.destroy', $message->id) }}"
                                            method="post" class="hidden">
        
                                            @method('DELETE')
                                            @csrf
        
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
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
                            {{ $messages->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
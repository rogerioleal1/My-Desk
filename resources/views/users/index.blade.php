@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="container-fluid">
        
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fa fa-users-cog"></i> Usuários
            </h1>
        </div>

        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Listagem de Usuários do Sistema
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form method="GET" action="{{ route('users.index') }}">
                            <div class="input-group mb-3">
                                <input class="form-control" name="search" value="{{ request('search') ?? '' }}" placeholder="Filtrar por nome, email ou grupo..."/>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="submit" >
                                        <i class="fa fa-search"></i> Buscar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    @can('users.create')
                    <div class="col-md-6 text-right">
                        <a href="{{ route('users.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Novo Usuário
                        </a>
                    </div>
                    @endcan

                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Avatar</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Empresa</th>
                                    <th>Grupo</th>
                                    <th>Status</th>
                                    <th class="text-center" width="10%">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>
                                        <img src="{{ uploads_path($user->avatar) }}" class="rounded-circle" width="40" />
                                    </td>
                                    <td>
                                        <a href="{{ route('users.show', $user->id) }}">
                                            {{ $user->name }}
                                        </a>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->company->name }}</td>
                                    <td>{{ $user->group->name }}</td>
                                    <td class="text-center">{{ icon_status($user->status) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-info" title="Editar Usuário">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        
                                        <a href="javascript:;" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $user->id }})" title="Excluir Usuário">
                                            <i class="fa fa-trash"></i>
                                        </a>
        
                                        <form id="btn-delete-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}"
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
                            {{ $users->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
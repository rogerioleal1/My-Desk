@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fa fa-bars"></i> Categorias de Chamado
            </h1>
        </div>

        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Listagem dos Categorias de Chamado do Sistema
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form method="GET" action="{{ route('categories.index') }}">
                            <div class="input-group mb-3">
                                <input class="form-control" name="search" value="{{ request('search') ?? '' }}" placeholder="Filtrar por descrição..."/>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="submit" >
                                        <i class="fa fa-search"></i> Buscar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    @can('categories.create')
                    <div class="col-md-6 text-right">
                        <a href="{{ route('categories.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Nova Categoria
                        </a>
                    </div>
                    @endcan

                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Descrição</th>
                                    <th>Tickets</th>
                                    <th>Data de Cadastro</th>
                                    <th>Data de Alteração</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</a>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-pill badge-{{ $category->tickets->count() > 0 ? 'success' : 'danger' }} ">
                                            {{ $category->tickets->count() }}
                                        </span>
                                    </td>
                                    <td>{{ $category->created_at->format('d.m.Y H:i:s') }}</td>
                                    <td>{{ $category->updated_at->format('d.m.Y H:i:s') }}</td>
                                    <td class="text-center">{{ icon_status($category->status) }}</td>
                                    <td>
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-info" title="Editar Categoria">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        
                                        <a href="javascript:;" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $category->id }})" title="Excluir Categoria">
                                            <i class="fa fa-trash"></i>
                                        </a>
        
                                        <form id="btn-delete-{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}"
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
                            {{ $categories->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fa fa-building"></i> Empresas
            </h1>
        </div>

        <div class="card mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Listagem dos Empresas
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <form method="GET" action="{{ route('companies.index') }}">
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

                    @can('companies.create')
                    <div class="col-md-6 text-right">
                        <a href="{{ route('companies.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus"></i> Nova Empresa
                        </a>
                    </div>
                    @endcan

                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Usuários</th>
                                    <th>Status</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse ($companies as $company)
                                <tr>
                                    <td>{{ $company->id }}</td>
                                    <td>{{ $company->name }}</td>
                                    <td>
                                        {{ $company->description }}
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-pill badge-{{ $company->users->count() > 0 ? 'success' : 'danger' }} ">
                                            {{ $company->users->count() }}
                                        </span>
                                    </td>
                                    <td class="text-center">{{ icon_status($company->status) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-sm btn-info" title="Editar Empresa">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        
                                        <a href="javascript:;" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $company->id }})" title="Excluir Empresa">
                                            <i class="fa fa-trash"></i>
                                        </a>
        
                                        <form id="btn-delete-{{ $company->id }}" action="{{ route('companies.destroy', $company->id) }}"
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
                            {{ $companies->links() }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
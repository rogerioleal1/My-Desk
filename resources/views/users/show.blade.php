@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fa fa-user"></i> Visualizar Usuário
            </h1>
        </div>

        <div class="row">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header py-3 bg-info">
                                <div class="text-center">
                                    <img class="rounded-circle img-profile" src="{{ uploads_path($user->avatar) }}" width="120" />&nbsp;
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Nome</label>
                                    <div class="col-md-9">
                                        <p class="form-control-plaintext">{{ $user->name }}</p>
                                    </div>
                                </div>

                                <hr class="hr-dotted">
                                
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-md-9">
                                        <p class="form-control-plaintext">{{ $user->email }}</p>
                                    </div>
                                </div>

                                <hr class="hr-dotted">

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Grupo</label>
                                    <div class="col-md-9">
                                        <p class="form-control-plaintext">{{ $user->group->name }}</p>
                                    </div>
                                </div>

                                <hr class="hr-dotted">

                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Empresa</label>
                                    <div class="col-md-9">
                                        <p class="form-control-plaintext">{{ $user->company->name }}</p>
                                    </div>
                                </div>

                                <hr class="hr-dotted">
                                
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Qtd. Acessos</label>
                                    <div class="col-md-9">
                                        <p class="form-control-plaintext">{{ $user->access_number }}</p>
                                    </div>
                                </div>

                                <hr class="hr-dotted">
                                
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Último Login em</label>
                                    <div class="col-md-9">
                                        <p class="form-control-plaintext">
                                            {{ $user->last_login_at ? $user->last_login_at->format('d.m.Y H:i:s') : 'Sem Acesso' }}
                                        </p>
                                    </div>
                                </div>

                                <hr class="hr-dotted">
                                
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-md-9">
                                        <p class="form-control-plaintext">
                                            {{ icon_status($user->status) }}
                                        </p>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <p>
                                    <i class="fa fa-calendar-check"></i> Cadastrado em: {{ $user->created_at->format('d.m.Y H:h:s') }}</p>
                                <p>
                                    <i class="fa fa-calendar-alt"></i> Atualizado em: {{ $user->updated_at->format('d.m.Y H:h:s') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
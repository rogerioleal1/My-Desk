@extends('layouts.app')
        
@section('content')
<div class="row justify-content-center">
    <div class="container-fluid">
    
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fa fa-user-edit"></i> Alterar Usuário
            </h1>
        </div>
    
        <div class="card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Preencha os campos abaixo e clique em Salvar Alterações
                </h6>
            </div>
    
            <div class="card-body">
                <form class="form-horizontal" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">

                    @method('PUT')

                    @csrf

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nome *</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name', $user->name) }}">
                        
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Email *</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" value="{{ $user->email }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Nova Senha</label>
                        <div class="col-md-9">
                            <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Nova Senha">

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Confirmar Senha</label>
                        <div class="col-md-9">
                            <input type="password" name="password_confirmation" class="form-control"  placeholder="Confirmar Senha">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Foto</label>
                        <div class="col-md-9">
                            
                            <input type="hidden" name="old_avatar" value="{{ $user->avatar ?? null }}">

                            <div class="kv-avatar">
                                <div class="file-loading">
                                    <input type="file" id="avatar" name="avatar" value="{{ old('avatar') }}">
                                </div>
                            </div>

                            @if ($errors->has('avatar'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('avatar') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <hr>
                    <div class="form-group row mb-0">
                        <div class="col-md-9 offset-md-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-check"></i> Salvar Alterações
                            </button>
                            
                            <a class="btn btn-light" href="{{ route('home') }}">
                                <i class="fa fa-undo"></i> Voltar ao Painel
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@include('users.scripts.avatar')
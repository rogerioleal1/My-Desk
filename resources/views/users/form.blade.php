@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fa fa-users-cog"></i>
                {{ isset($group->id) ? 'Editar Usuário' : 'Novo Usuário' }}
            </h1>
        </div>

        <div class="card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Preencha os campos e clique em Salvar Usuário
                </h6>
            </div>

            <div class="card-body">
                @if (! isset($user))
                    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                @else
                    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                @endif

                    @csrf

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nome *</label>
                        <div class="col-md-9">
                            <input type="text" id="name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name', $user->name ?? null) }}" placeholder="Nome" required autofocus>

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
                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email', $user->email ?? null) }}" placeholder="Email" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Grupo *</label>
                        <div class="col-md-9">
                            <select name="group_id" class="form-control{{ $errors->has('group_id') ? ' is-invalid' : '' }} select2" required>
                                <option value="">Selecione o grupo...</option>
                                @foreach($groups as $group)
                                    <option value="{{ $group->id }}"
                                        {{ $group->id == old('group_id', $user->group_id ?? null) ? 'selected' : '' }}>
                                        {{ $group->name }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($errors->has('group_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('group_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Empresa *</label>
                        <div class="col-md-9">
                            <select name="company_id" class="form-control{{ $errors->has('company_id') ? ' is-invalid' : '' }} select2" required>
                                <option value="">Selecione a empresa...</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}"
                                        {{ $company->id == old('company_id', $user->company_id ?? null) ? 'selected' : '' }}>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>

                            @if ($errors->has('company_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('company_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Sistemas *</label>
                        <div class="col-md-9">
                            <select name="systems[]" class="form-control select2" multiple required>
                                @foreach($systems as $system)
                                    <option value="{{ $system->id }}"
                                        {{ in_array($system->id, $allowedSystems ?? []) ? 'selected' : '' }}>
                                        {{ $system->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Senha</label>
                        <div class="col-md-9">
                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Senha">

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
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar Senha">
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

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-md-9">
                            <input type="hidden" name="status" value="0">
                            <input type="checkbox" name="status" value="1"
                                @if (old('status', $group->status ?? 1)) checked @endif >

                            @if ($errors->has('status'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <hr>
                    <div class="form-group row mb-0">
                        <div class="col-md-9 offset-md-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-check"></i> Salvar Usuário
                            </button>
                            
                            <a class="btn btn-light" href="{{ route('users.index') }}">
                                <i class="fa fa-undo"></i> Voltar à listagem
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            @isset($user)
            <div class="card-footer">
                <p>Cadastrado em: {{ $user->created_at->format('d.m.Y H:i:s') }}</p>
                <p>Atualizado em: {{ $user->updated_at->format('d.m.Y H:i:s') }}</p>
            </div>
            @endisset
        </div>
    </div>
</div>
@endsection

@include('users.scripts.avatar')
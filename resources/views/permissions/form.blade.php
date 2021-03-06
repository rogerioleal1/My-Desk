@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fa fa-users"></i>
                {{ isset($permission->id) ? 'Editar Permissão' : 'Nova Permissão' }}
            </h1>
        </div>

        <div class="card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Preencha os campos e clique em Salvar Permissão
                </h6>
            </div>

            <div class="card-body">
                @if (! isset($permission))
                    <form method="POST" action="{{ route('permissions.store') }}">
                @else
                    <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
                        @method('PUT')
                @endif

                    @csrf

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nome *</label>
                        <div class="col-md-9">
                            <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name', $permission->name ?? null) }}" placeholder="Nome" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Rota *</label>
                        <div class="col-md-9">
                            <input type="text" name="route" class="form-control{{ $errors->has('route') ? ' is-invalid' : '' }}" value="{{ old('route', $permission->route ?? null) }}" placeholder="Rota" required>

                            @if ($errors->has('route'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('route') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Descrição *</label>
                        <div class="col-md-9">
                            <textarea name="description" rows="5" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                placeholder="Descrição" required>{{ old('description', $permission->description ?? null) }}</textarea>

                            @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-md-9">
                            <input type="hidden" name="status" value="0">
                            <input type="checkbox" name="status" value="1"
                                @if (old('status', $permission->status ?? 1)) checked @endif >

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
                                <i class="fa fa-check"></i> Salvar Permissão
                            </button>
                            
                            <a class="btn btn-light" href="{{ route('permissions.index') }}">
                                <i class="fa fa-undo"></i> Voltar à listagem
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            @isset($permission)
            <div class="card-footer">
                <p>Cadastrado em: {{ $permission->created_at->format('d.m.Y H:i:s') }}</p>
                <p>Atualizado em: {{ $permission->updated_at->format('d.m.Y H:i:s') }}</p>
            </div>
            @endisset
        </div>
    </div>
</div>
@endsection
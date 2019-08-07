@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fa fa-users"></i>
                {{ isset($category->id) ? 'Editar Categoria' : 'Novo Categoria' }}
            </h1>
        </div>

        <div class="card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Preencha os campos e clique em Salvar Categoria
                </h6>
            </div>

            <div class="card-body">
                @if (! isset($category))
                    <form method="POST" action="{{ route('categories.store') }}">
                @else
                    <form method="POST" action="{{ route('categories.update', $category->id) }}">
                        @method('PUT')
                @endif

                    @csrf

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Descrição *</label>
                        <div class="col-md-9">
                            <input type="text" id="name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name', $category->name ?? null) }}" placeholder="Descrição" required>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-md-9">
                            <input type="hidden" name="status" value="0">
                            <input type="checkbox" name="status" value="1"
                                @if (old('status', $category->status ?? 1)) checked @endif >

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
                                <i class="fa fa-check"></i> Salvar Categoria
                            </button>
                            
                            <a class="btn btn-light" href="{{ route('categories.index') }}">
                                <i class="fa fa-undo"></i> Voltar à listagem
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            @isset($category)
            <div class="card-footer">
                <p>
                    <i class="fa fa-calendar-check"></i> Cadastrado em: {{ $category->created_at->format('d.m.Y H:i:s') }}</p>
                <p>
                    <i class="fa fa-calendar-alt"></i> Atualizado em: {{ $category->updated_at->format('d.m.Y H:i:s') }}
                </p>
            </div>
            @endisset
        </div>
    </div>
</div>
@endsection
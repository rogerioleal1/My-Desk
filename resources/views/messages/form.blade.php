@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fa fa-info-circle"></i>
                {{ isset($message->id) ? 'Editar Aviso' : 'Novo Aviso' }}
            </h1>
        </div>

        <div class="card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Preencha os campos e clique em Salvar Aviso
                </h6>
            </div>

            <div class="card-body">
                @if (! isset($message))
                    <form method="POST" action="{{ route('messages.store') }}">
                @else
                    <form method="POST" action="{{ route('messages.update', $message->id) }}">
                        @method('PUT')
                @endif

                    @csrf

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Empresa *</label>
                        <div class="col-md-9">
                            <select name="company_id" class="form-control{{ $errors->has('company_id') ? ' is-invalid' : '' }} select2" required>
                                <option value="">Selecione a empresa...</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}"
                                        {{ $company->id == old('company_id', $message->company_id ?? null) ? 'selected' : '' }}>
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
                        <label class="col-sm-2 col-form-label">Assunto *</label>
                        <div class="col-md-9">
                            <input type="text" name="subject" class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" value="{{ old('subject', $message->subject ?? null) }}" placeholder="Assunto" required>

                            @if ($errors->has('subject'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('subject') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Mensagem *</label>
                        <div class="col-md-9">
                            <textarea id="description" name="description" rows="5" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                placeholder="Mensagem" required>{{ old('description', $message->description ?? null) }}</textarea>

                            @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Exibir entre *</label>
                        <div class="col-md-4">
                            <input type="text" name="starts_from" class="date-picker form-control{{ $errors->has('starts_from') ? ' is-invalid' : '' }}" 
                                value="{{ old('starts_from', isset($message) ? $message->starts_from->format('d/m/Y') : null) }}" placeholder="DD/MM/AAAA" required>

                            @if ($errors->has('starts_from'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('starts_from') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-5">
                            <input type="text" name="expires_at" class="date-picker form-control{{ $errors->has('expires_at') ? ' is-invalid' : '' }}" 
                                value="{{ old('expires_at', isset($message) ? $message->expires_at->format('d/m/Y') : null) }}" placeholder="DD/MM/AAAA" required>

                            @if ($errors->has('expires_at'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('expires_at') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-md-9">
                            <input type="hidden" name="status" value="0">
                            <input type="checkbox" name="status" value="1"
                                @if (old('status', $message->status ?? 1)) checked @endif >

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
                                <i class="fa fa-check"></i> Salvar Aviso
                            </button>
                            
                            <a class="btn btn-light" href="{{ route('messages.index') }}">
                                <i class="fa fa-undo"></i> Voltar à listagem
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            @isset($message)
            <div class="card-footer">
                <p>Cadastrado em: {{ $message->created_at->format('d.m.Y H:i:s') }}</p>
                <p>Atualizado em: {{ $message->updated_at->format('d.m.Y H:i:s') }}</p>
            </div>
            @endisset
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('#description').summernote({
        placeholder: 'Descreva de forma clara e objetiva sua solicitação',
        tabsize: 2,
        height: 300
    })

    $('div.note-group-select-from-files').remove();
</script>
@endpush
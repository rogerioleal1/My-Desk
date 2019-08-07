@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fa fa-ticket-alt"></i>
                {{ isset($ticket) ? 'Editar Chamado' : 'Novo Chamado' }}
            </h1>

            <div>
                @can('tickets.index')
                <a href="{{ route('tickets.index') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-list fa-sm"></i> Meus Chamados
                </a>
                @endcan

                @if (isset($ticket) && Gate::check('tickets.show'))
                <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-sm btn-info">
                    <i class="fa fa-search"></i> Acompanhar Chamado
                </a>
                @endif
            </div>
        </div>

        <div class="alert alert-info">
            <i class="fa fa-info-circle"></i> 
            Este menu permite criar e editar chamados. Procure descrever sua solicitação
            de forma clara e objetiva para que possamos solucionar o mais breve possível.
        </div>

        <div class="row">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    Preencha os campos e clique em Salvar Chamado
                                </h6>
                            </div>

                            <div class="card-body">

                                @if (! isset($ticket))
                                    <form method="POST" action="{{ route('tickets.store') }}" enctype="multipart/form-data">
                                @else
                                    <form method="POST" action="{{ route('tickets.update', $ticket->id) }}" enctype="multipart/form-data">
                                        @method('PUT')
                                @endif

                                    @csrf

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Solicitante *</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" 
                                                value="{{ isset($ticket) ? $ticket->user->name : auth()->user()->name }}" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Tipo de Solicitação *</label>
                                        <div class="col-md-9">
                                            <select name="type" class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }} select2" required>
                                                <option value="">Selecione o tipo de solicitação</option>
                                                @foreach (get_type_ticket() as $key => $type)
                                                    <option value="{{ $key }}"
                                                        {{ $key == old('type', $ticket->type ?? null) ? 'selected' : '' }}>
                                                        {{ $type }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('type'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('type') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Categoria *</label>
                                        <div class="col-md-9">
                                            <select name="category_id" class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }} select2" required>
                                                <option value="">Selecione a categoria...</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ $category->id == old('category_id', $ticket->category_id ?? null) ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                
                                            @if ($errors->has('category_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('category_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Sistema *</label>
                                        <div class="col-md-9">
                                            <select name="system_id" class="form-control{{ $errors->has('system_id') ? ' is-invalid' : '' }} select2" required>
                                                <option value="">Selecione o sistema...</option>
                                                @foreach($systems as $system)
                                                    <option value="{{ $system->id }}"
                                                        {{ $system->id == old('system_id', $ticket->system_id ?? null) ? 'selected' : '' }}>
                                                        {{ $system->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('system_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('system_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Prioridade *</label>
                                        <div class="col-md-9">
                                            <select name="priority" class="form-control{{ $errors->has('priority') ? ' is-invalid' : '' }} select2" required>
                                                <option value="">Selecione a prioridade</option>
                                                @foreach (get_priority_ticket() as $key => $priority)
                                                    <option value="{{ $key }}"
                                                        {{ $key == old('priority', $ticket->priority ?? null) ? 'selected' : '' }}>
                                                        {{ $priority }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('priority'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('priority') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Assunto *</label>
                                        <div class="col-md-9">
                                            <input type="text" name="subject" class="form-control{{ $errors->has('subject') ? ' is-invalid' : '' }}" 
                                                value="{{ old('subject', $ticket->subject ?? null) }}" placeholder="Informe o assunto" required>

                                            @if ($errors->has('subject'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('subject') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Descrição *</label>
                                        <div class="col-md-9">
                                        <textarea  id="description" name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" required>{{ $ticket->description ?? '' }}</textarea>

                                            @if ($errors->has('description'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    @if (! isset($group)) 
                                    <input type="hidden" name="status" value="1">
                                    @endunless

                                    @if (Auth::user()->group_id != 3)
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Status *</label>
                                            <div class="col-md-9">
                                                <select name="status" class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }} select2" required>
                                                    <option value="">Selecione o status</option>
                                                    @foreach (get_status_ticket() as $key => $status)
                                                        <option value="{{ $key }}"
                                                            {{ $key == old('status', $ticket->status ?? null) ? 'selected' : '' }}>
                                                            {{ $status }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('status'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('status') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Técnico *</label>
                                            <div class="col-md-9">
                                                <select name="assigned_to" class="form-control{{ $errors->has('assigned_to') ? ' is-invalid' : '' }} select2">
                                                    <option value="">Selecione o técnico...</option>
                                                    @foreach($technicians as $technician)
                                                        <option value="{{ $technician->id }}"
                                                            {{ $technician->id == old('assigned_to', $ticket->assigned_to ?? null) ? 'selected' : '' }}>
                                                            {{ $technician->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                        
                                                @if ($errors->has('assigned_to'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('assigned_to') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Solução</label>
                                            <div class="col-md-9">
                                                <textarea  id="solution" name="solution" class="form-control{{ $errors->has('solution') ? ' is-invalid' : '' }}">{{ $ticket->solution ?? '' }}</textarea>
    
                                                @if ($errors->has('solution'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('solution') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Anexar Documento</label>
                                        <div class="col-md-9">
                                            <input type="file" id="documents" name="documents[]" value="{{ old('documents') }}" multiple>
                                            
                                            @if ($errors->has('documents'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('documents') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-9 offset-md-2">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-check"></i> Salvar Chamado
                                            </button>
                                            
                                            <a class="btn btn-light" href="{{ route('tickets.index') }}">
                                                <i class="fa fa-undo"></i> Voltar à listagem
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            @isset($ticket)
                            <hr>
                            <div class="form-group">
                                <div class="col-md-12">
                                    @include('tickets.list-documents')
                                </div>
                            </div>

                            <div class="card-footer">
                                <p>
                                    <i class="fa fa-calendar-check"></i> Cadastrado em: {{ $ticket->created_at->format('d.m.Y H:i:s') }}</p>
                                <p>
                                    <i class="fa fa-calendar-alt"></i> Atualizado em: {{ $ticket->updated_at->format('d.m.Y H:i:s') }}
                                </p>
                            </div>
                            @endisset

                        </div>
                    </div>
                </div>
            </div>
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

    $('#solution').summernote({
        placeholder: 'Descreva de forma clara e objetiva a solução do chamado',
        tabsize: 2,
        height: 300
    })

    $('div.note-group-select-from-files').remove();

    $('#documents').fileinput({
        theme: "fas",
        language: "pt-BR",
        showUpload: false,
        showCancel: false,
        removeClass: 'btn btn-danger',
        title: 'teste',
        allowedFileExtensions: [
            'jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'csv'
        ],
        fileActionSettings: {
            showRemove: false,
        },
        overwriteInitial: false,
        maxFileSize: 3000,
        maxFilesNum: 10,
    })
</script>
@endpush

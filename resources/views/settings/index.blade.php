@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fa fa-users-cog"></i>
                Configurações Gerais
            </h1>
        </div>

        <div class="card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Preencha os campos e clique em Salvar Usuário
                </h6>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('settings.update', $settings->id) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nome do Sistema *</label>
                        <div class="col-md-9">
                            <input type="text" name="app_name" class="form-control @error('app_name') is-invalid @enderror" 
                                value="{{ old('app_name', $settings->app_name) }}" placeholder="Nome do Sistema">

                            @error('app_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Descrição *</label>
                        <div class="col-md-9">
                            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" 
                                value="{{ old('description', $settings->description) }}" placeholder="Descrição">

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Email *</label>
                        <div class="col-md-9">
                            <input id="email" type="email" class="form-control @error('email') is-invalid' @enderror" name="email" 
                                value="{{ old('email', $settings->email) }}" placeholder="Email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Telefone</label>
                        <div class="col-md-9">
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                                value="{{ old('phone', $settings->phone) }}" placeholder="(99) 99999-9999">

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Logo</label>
                        <div class="col-md-9">
                            
                            <input type="hidden" name="old_logo" value="{{ $settings->logo }}">

                            <div class="kv-avatar">
                                <div class="file-loading">
                                    <input type="file" id="logo" name="logo" value="{{ old('logo') }}">
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
                                <i class="fa fa-check"></i> Salvar Alteração
                            </button>
                            
                            <a class="btn btn-light" href="{{ route('home') }}">
                                <i class="fa fa-undo"></i> DashBoard
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-footer">
                <p>Cadastrado em: {{ $settings->created_at->format('d.m.Y H:i:s') }}</p>
                <p>Atualizado em: {{ $settings->updated_at->format('d.m.Y H:i:s') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $('#logo').fileinput({
        theme: "fas",
        language: "pt-BR",
        showUpload: false,
        showCancel: false,
        showClose: false,
        showCaption: false,
        removeClass: 'btn btn-danger',
        title: 'teste',
        allowedFileExtensions: [
            'jpg', 'jpeg', 'png'
        ],
        defaultPreviewContent: [
            "<img src='{{ uploads_path($settings->logo ?? "settings/logo.png") }}' class='file-preview-image' width='180'>",
        ],
        fileActionSettings: {
            showRemove: false,
        },
        overwriteInitial: true,
        purifyHtml: true,
    })
</script>
@endpush
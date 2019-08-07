@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fa fa-info-circle"></i> Avisos
            </h1>
        </div>

        <div class="row">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    Detalhes do Aviso
                                </h6>
                            </div>

                            <div class="card-body">

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Assunto</label>
                                    <div class="col-md-9">
                                        <p class="form-control-plaintext">{{ $message->subject }}</p>
                                    </div>
                                </div>

                                <hr class="hr-dotted">

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Mensagem</label>
                                    <div class="col-md-9">
                                        <p class="form-control-plaintext">{!! $message->description !!}</p>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <p>
                                    <i class="fa fa-calendar-check"></i> Cadastrado em: {{ $message->created_at->format('d.m.Y H:h:s') }}</p>
                                <p>
                                    <i class="fa fa-calendar-alt"></i> Atualizado em: {{ $message->updated_at->format('d.m.Y H:h:s') }}
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
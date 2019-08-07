@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fa fa-tachometer-alt"></i> DashBoard
            </h1>
            <div>
                @can('tickets.index')
                <a href="{{ route('tickets.index') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-list fa-sm"></i> Meus Chamados
                </a>
                @endcan 
                
                @can('tickets.create')
                <a href="{{ route('tickets.create') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-plus fa-sm"></i> Novo Chamado
                </a>
                @endcan
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Abertos
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $tickets['opened'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Em Andamento
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $tickets['inProgress'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pendentes
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $tickets['pending'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Resolvidos
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $tickets['solved'] + $tickets['closed']}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8 col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fa fa-chart-pie"></i> Gráfico por Status
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-pie pt-4 pb-2">
                            <canvas id="pieChartStatus"></canvas>
                        </div>
                        
                        <div class="mt-4 text-center small">
                            <span class="mr-2">
                                <i class="fas fa-circle text-info"></i> Abertos
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-primary"></i> Em Andamento
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-warning"></i> Pendentes
                            </span>
                            <span class="mr-2">
                                <i class="fas fa-circle text-success"></i> Resolvidos
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fa fa-chart-bar"></i> Percentuais por Status
                        </h6>
                    </div>
                    <div class="card-body">
                        <h4 class="small font-weight-bold">
                            @php $percentOpened = calc_percentage($tickets['opened'], $tickets['allTickets']) @endphp
                            Abertos <span class="float-right">{{ $percentOpened }}%</span>
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width: {{ $percentOpened }}%" aria-valuenow="{{ $percentOpened }}"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>

                        <h4 class="small font-weight-bold">
                            @php $percentInProgress = calc_percentage($tickets['inProgress'], $tickets['allTickets']) @endphp
                            Em Andamento
                            <span class="float-right">{{ $percentInProgress }}%</span>
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: {{ $percentInProgress }}%" aria-valuenow="{{ $percentInProgress }}"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>

                        <h4 class="small font-weight-bold">
                            @php $percentPending = calc_percentage($tickets['pending'], $tickets['allTickets']) @endphp 
                            Pendentes <span class="float-right">{{ $percentPending }}%</span>
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: {{ $percentPending }}%" aria-valuenow="{{ $percentPending }}"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>

                        <h4 class="small font-weight-bold">
                            @php $percentSolved = calc_percentage($tickets['solved'], $tickets['allTickets']) @endphp 
                            Solucionados <span class="float-right">{{ $percentSolved }}%</span>
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: {{ $percentSolved }}%" aria-valuenow="{{ $percentSolved }}"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>

                        <h4 class="small font-weight-bold">
                            @php $percentClosed = calc_percentage($tickets['closed'], $tickets['allTickets']) @endphp
                            Fechados <span class="float-right">{{ $percentClosed }}%</span>
                        </h4>
                        <div class="progress mb-4">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-dark" role="progressbar" style="width: {{ $percentClosed }}%" aria-valuenow="{{ $percentClosed }}"
                                aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card shadow mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fa fa-clock"></i> Chamados Recentes
                        </h6>
                    </div>
                    <div class="card-body table-responsive" style="overflow:scroll; height:350px;">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Solicitante</th>
                                    <th>Assunto</th>
                                    <th>Prioridade</th>
                                    <th>Data de Abertura</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tickets['latest'] as $ticket)
                                <tr>
                                    <td>
                                        <a href="{{ route('tickets.show', $ticket->id) }}">
                                            {{ format_ticket_id($ticket->id) }}
                                        </a>
                                    </td>
                                    <td>{{ $ticket->subject }}</td>
                                    <td>{{ $ticket->subject }}</td>
                                    <td>{{ get_priority_ticket($ticket->priority) }}</a>
                                        <td>{{ $ticket->created_at->format('d.m.Y H:i:s') }}</td>
                                        <td>
                                            <span class="btn btn-sm btn-{{ get_color_ticket($ticket->status) }} ">
                                            {{ get_status_ticket($ticket->status) }}
                                        </span>
                                        </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8">
                                        <div class="alert alert-danger text-center">
                                            <i class="fa fa-exclamation-triangle"></i> Oops... nenhum registro encontrado!
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fa fa-info-circle"></i> Avisos
                        </h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            @forelse ($messages as $message)
                                <li class="media {{ $loop->first ? '' : 'my-4' }}">
                                    <div class="media-body">
                                        <a href="{{ route('messages.show', $message->id) }}">
                                            <h5 class="mt-0 mb-1">{{ $message->subject }}</h5>
                                        </a>
                                        
                                        {!! $message->description !!}
                                    </div>
                                </li>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <div class="alert alert-danger text-center">
                                            <i class="fa fa-exclamation-triangle"></i> Oops... nenhum aviso cadastrado!
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fa fa-question-circle"></i> Ajuda e Suporte
                        </h6>
                    </div>
                    <div class="card-body">
                        <p>Seja bem vindo ao {{ $settings->app_name }}.</p>
                        <p>
                            Caso ocorra algum problema ou dúvida na utilização do sistema, entre em contato conosco pelo email
                            <a href="mailto:{{ $settings->email }}" target="_top">{{ $settings->email }}</a> ou pelo telefone
                            {{ $settings->phone }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    const chart = $('#pieChartStatus')

    const pieChartStatus = new Chart(chart, {
        type: 'doughnut',
        data: {
            labels: ['Abertos', 'Em Andamento', 'Pendentes', 'Solucionados'],
            datasets: [{
                data: [
                    {{ $tickets['opened'] }},
                    {{ $tickets['inProgress'] }},
                    {{ $tickets['pending'] }},
                    {{ $tickets['solved'] }},
                ],
                backgroundColor: ['#6cb2eb', '#3490dc', '#3490dc', '#38c172'],
                hoverBackgroundColor: ['#6cb2eb', '#3490dc', '#3490dc', '#38c172'],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            tooltips: {
                backgroundColor: 'rgb(255,255,255)',
                bodyFontColor: '#858796',
                borderColor: '#dddfeb',
                borderWidth: 1,
                xPadding: 15,
                yPadding: 15,
                displayColors: false,
                caretPadding: 10,
            },
            legend: {
                display: false
            },
            cutoutPercentage: 80,
        },
    })
</script>
@endpush
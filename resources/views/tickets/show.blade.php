@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fa fa-ticket-alt"></i> 
                Visualizar Chamado {{ format_ticket_id($ticket->id) }} ({{ get_status_ticket($ticket->status) }})
            </h1>

            <div>
                @can('tickets.index')
                <a href="{{ route('tickets.index') }}" class="btn btn-sm btn-info">
                    <i class="fas fa-list fa-sm"></i> Meus Chamados
                </a>
                @endcan 

                @can('tickets.edit')
                <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-sm btn-info">
                    <i class="fa fa-edit"></i> Editar Chamado
                </a>
                @endcan
            </div>
        </div>

        <div class="row">
            <div class="container">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link {{ request()->tab == '' ? 'active' : '' }}" data-toggle="tab" href="#tab-info">
                            Detalhes do Chamado
                        </a>
                        
                        <a class="nav-item nav-link {{ request()->tab == 'followup' ? 'active' : '' }}" data-toggle="tab" href="#tab-followup">
                            Acompanhamento <span class="badge badge-pill badge-success">{{ $ticket->followups->count() }}</span>
                        </a>

                        <a class="nav-item nav-link {{ request()->tab == 'documents' ? 'active' : '' }}" data-toggle="tab" href="#tab-documents">
                            Documentos <span class="badge badge-pill badge-success">{{ $ticket->documents->count() }}</span>
                        </a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show {{ request()->tab == '' ? 'active' : '' }}" id="tab-info">
                        @include('tickets.tab-info')
                    </div>

                    <div class="tab-pane fade show {{ request()->tab == 'followup' ? 'active' : '' }}" id="tab-followup">
                        @include('tickets.tab-followup')
                    </div>

                    <div class="tab-pane fade show {{ request()->tab == 'documents' ? 'active' : '' }}" id="tab-documents">
                        @include('tickets.tab-documents')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script type="text/javascript">        
        $('a[data-toggle="tab"]').on('shown.bs.tab', event => {

            let tabId = $(event.target).attr('href').split('#tab-')[1]

            let pathUrl = document.location.pathname

            if (tabId == 'info') {
                history.replaceState('', '', pathUrl)
                return false
            }

            history.replaceState('', '', `${pathUrl}?tab=${tabId}`)
        })
  </script>
@endpush
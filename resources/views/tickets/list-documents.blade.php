<div class="alert alert-info">
    <span class="fa fa-file-alt"></span>&nbsp; Listagem de Documentos Salvos
</div>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Usuário</th>
            <th>Nome do Arquivo</th>
            <th>Data de Cadastro</th>
            <th class="text-center">Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($ticket->documents as $document)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $document->user->name }}</td>
            <td>{{ str_replace('documents/', '', $document->filepath) }}</td>
            <td>{{ $document->created_at->format('d.m.Y H:i:s') }}</td>
            <td class="text-center">
                <a href="{{ uploads_path($document->filepath) }}" class="btn btn-sm btn-info" title="Visualizar Documento" target="_blank">
                    <i class="fa fa-search"></i>
                </a>

                @can('documents.destroy')
                <a href="javascript:;" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $document->id }})" title="Excluir Documento">
                    <i class="fa fa-trash"></i>
                </a>

                <form id="btn-delete-{{ $document->id }}" action="{{ route('documents.destroy', $document->id) }}"
                    method="post" class="hidden">

                    @method('DELETE')
                    @csrf

                </form>
                @endcan
            </td>
        </tr>
        @empty
            <tr>
                <td colspan="9">
                    <div class="alert alert-danger text-center">
                        <i class="fa fa-exclamation-triangle"></i>
                        Oops... não há documentos cadastrados neste chamado!
                    </div>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
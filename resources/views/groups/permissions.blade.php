<br>
<div class="row justify-content-center">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    Permissões de Acesso
                </h6>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('groups.permissions.store') }}">
                    @csrf

                    <input type="hidden" name="group_id" value="{{ $group->id }}">

                    <div class="form-group row">
                        <div class="col-md-9">
                            <select name="permission_id" class="form-control" required>
                                <option value="">Selecione a Permissão</option>
                                
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->id }}">
                                        {{ $permission->name . ' - ' . $permission->description }}
                                    </option>
                                @endforeach
        
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus"></i> Adicionar Permissão
                            </button>
                        </div>
                    </div>
                </form>

                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Rota</th>
                            <th>Descrição</th>
                            <th>Data de Cadastro</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($group->permissions as $permission)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->route }}</td>
                            <td>{{ $permission->description }}</td>
                            <td>{{ $permission->pivot->created_at->format('d.m.Y H:i:s') }}</td>
                            <td class="text-center">
                                <a href="javascript:;" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $permission->id }})" title="Excluir Permissão">
                                    <i class="fa fa-trash"></i>
                                </a>
                
                                <form id="btn-remove-{{ $permission->id }}" action="{{ route('groups.permissions.destroy', [$group->id, $permission->id]) }}"
                                    method="post" class="hidden">
                
                                    @method('DELETE')
                                    @csrf
                
                                </form>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="9">
                                    <div class="alert alert-danger text-center">
                                        <i class="fa fa-exclamation-triangle"></i>
                                        Oops... não há permissões cadastradas para este grupo!
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
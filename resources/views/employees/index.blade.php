@extends('index')

@section('conteudo')
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabela de Funcionarios</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Privilegio</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($employees as $item)

                        @if(Auth::user()->id != $item->id)
                            @if(UserPermissions::listEmployee($item))
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email}}</td>
                                    <td>{{ $item->role->name}}</td>
                                    <td>
                                        @can('update', $item)
                                        <a href="{{ route('employees.edit', $item) }}" class="btn btn-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z" />
                                                <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z" />
                                            </svg>
                                        </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endif
                        @endif

                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Privilegio</th>
                            <th>Ações</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection
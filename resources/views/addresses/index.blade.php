@extends('index')

@section('conteudo')
<div class="container-fluid">

    <!-- Page Heading -->
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabela de Endereços</h6>
            <div class="d-sm-flex align-items-center justify-content-end mb-4">
                <a href="{{route('addresses.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-md text-white-50"></i>Adicionar</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Endereço</th>
                            <th>Numero</th>
                            <th>Bairro</th>
                            <th>Cidade</th>
                            <th>CEP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($addresses as $item)
                        <tr>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->number}}</td>
                            <td>{{ $item->neighborhood}}</td>
                            <td>{{ $item->city}}</td>
                            <td>{{ $item->zipcode}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Endereço</th>
                            <th>Numero</th>
                            <th>Bairro</th>
                            <th>Cidade</th>
                            <th>CEP</th>
                        </tr>
                    </tfoot>
                </table>

            </div>
            
        </div>
    </div>

</div>

@endsection
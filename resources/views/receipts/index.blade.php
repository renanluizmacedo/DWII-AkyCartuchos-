@extends('index')

@section('conteudo')
<div class="container-fluid">

    <!-- Page Heading -->

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tabela de Recibos</h6>
            <div class="d-sm-flex align-items-center justify-content-end mb-4">
                <a href="{{route('receipts.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-plus fa-md text-white-50"></i>Adicionar</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nome Cliente</th>
                            <th>Valor Total</th>
                            <th>Ações</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($receipts as $receipt)
                        <tr>
                            <td>{{ $receipt->customer->name}}</td>
                            <td>R$ {{ $receipt->totalPrice}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nome Cliente</th>
                            <th>Valor Total</th>
                            <th>Ações</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection
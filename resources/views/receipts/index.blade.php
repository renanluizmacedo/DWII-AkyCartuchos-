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
                            <th>Data/Hora Atendimento</th>
                            <th>Ações</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($receipts as $receipt)
                        <tr>
                            <td>{{ $receipt->customer->name}}</td>
                            <td>R$ {{ $receipt->totalPrice}}</td>
                            <td>{{$receipt->created_at}}</td>
                            <td>
                                <a href="{{ route('receipts.show', $receipt) }}" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Nome Cliente</th>
                            <th>Valor Total</th>
                            <th>Data/Hora Atendimento</th>
                            <th>Ações</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection
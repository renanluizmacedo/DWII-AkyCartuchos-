@extends('index')

@section('conteudo')
<h2>Cliente</h2>
<div class="form-group row">
    <div class="col-sm-6 mb-3 mb-sm-0">
        <label for="name">Nome</label>
        <input type="text" class="form-control form-control-user" id="name" name="name" readonly aria-describedby="name" placeholder="Insira o nome" value="{{$receipt->customer->name}}">
    </div>
    <div class="col-sm-6 mb-3 mb-sm-4">
        <label for="phone">Telefone</label>
        <input type="number" class="form-control form-control-user" id="phone" name="phone" readonly aria-describedby="phone" placeholder="Insira o telefone" value="{{$receipt->customer->phone}}">
    </div>

</div>

<h2>Items</h2>
<div class="col-sm-2 mb-3 mb-sm-4 mr-0">
    <label for="totalPrice">Valor Total</label>
    <input type="number" class="form-control form-control-user" id="totalPrice" name="totalPrice" readonly aria-describedby="totalPrice" value="{{$receipt->totalPrice}}">
</div>
<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Numero de Série</th>
                    <th>Preço Unitário</th>
                    <th class="col-2">Quantidade</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($receiptItems as $receiptItem)
                <tr>
                    <td>{{ $receiptItem->item->name}}</td>
                    <td>{{ $receiptItem->item->serial_number}}</td>
                    <td>{{ $receiptItem->item->price}}</td>
                    <td>{{ $receiptItem->amount}}</td>

                </tr>
                @endforeach

            </tbody>
            <tfoot>
                <tr>
                    <th>Nome</th>
                    <th>Numero de Série</th>
                    <th>Preço Unitário</th>
                    <th class="col-2">Quantidade</th>
                </tr>
            </tfoot>
        </table>

    </div>
</div>
@endsection
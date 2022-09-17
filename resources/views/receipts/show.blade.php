@extends('index')

@section('conteudo')
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

<div class="d-flex  justify-content-between">
    <div class="div mb-0">
    </div>
    <div class="col-md-6 div">
        <label for="totalPrice" class="h3 "><strong> Valor Total</strong></label>
        <input type="number" class="form-control form-control-user bg-success text-light" id="totalPrice" name="totalPrice" readonly aria-describedby="totalPrice" value="{{$receipt->totalPrice}}">
    </div>
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
@extends('index')

@section('conteudo')
<div class="container-fluid">
    <h3>INFORMAÇÕES ITEM</h3>

    <div class="form-group row">
        <div class="col-sm-6 mb-3 mb-sm-4">
            <label for="name">Nome do item</label>
            <input type="text" class="form-control form-control-user" id="name" name="name" readonly aria-describedby="name" placeholder="Insira o nome do Item" value="{{$item->name}}">
        </div>

        <div class="col-sm-6 mb-3 mb-sm-4">
            <label for="serial_number">Numero de Série</label>
            <input type="number" class="form-control form-control-user" id="serial_number" name="serial_number" readonly aria-describedby="serial_number" placeholder="Insira o Numero de Série" value="{{$item->serial_number}}">
        </div>
        <div class="col-sm-6 mb-3 mb-sm-4">
            <label for="price">Valor</label>
            <input type="number" class="form-control form-control-user" id="price" name="price" readonly aria-describedby="price" placeholder="Insira o Valor" value="{{$item->price}}">
        </div>
        <div class="col-sm-6 mb-3 mb-sm-4">
            <label for="type_item">Tipo do item</label>
            <input type="text" class="form-control form-control-user" id="type_item" name="type_item" readonly aria-describedby="type_item" placeholder="Insira o nome do Item" value="{{$itemType->name}}">
        </div>

    </div>

    <div class="row">
        <div class="col-md-6">
            <a href="{{route('items.index')}}" class="btn btn-primary btn-user btn-block">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                    <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z" />
                </svg>
                &nbsp; Voltar
            </a>

        </div>
    </div>

    <hr>
</div>
@endsection
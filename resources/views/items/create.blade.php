@extends('index')

@section('conteudo')
<div class="container-fluid">
    <h3>CADASTRAR ITEMS</h3>
    <div class="modal fade" id="tipoItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tipo de Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('itemsType.store') }}" method="POST" id="itemTypeForm">
                        @csrf

                        <div class="form-group">
                            <label for="item_type" class="col-form-label">Nome :</label>
                            <input type="text" name="item_type" class="form-control" id="item_type">
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($itemType as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" form="itemTypeForm">Save</button>
                </div>


            </div>
        </div>
    </div>

    <form class="user" action="{{ route('items.store') }}" method="POST">
        @csrf
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-4">
                <label for="name">Nome do item</label>
                <input type="text" class="form-control form-control-user" id="name" name="name" aria-describedby="name" placeholder="Insira o nome do Item">
            </div>

            <div class="col-sm-4 mb-3 mb-sm-4">
                <label for="type_item">Tipo de item</label>
                <select name="type_item" class="custom-select form-create @if($errors->has('type_item')) is-invalid @endif">
                    @foreach ($itemType as $item)
                    <option value="{{$item->id}}" @if($item->id == old('type_item')) selected="true" @endif>
                        {{ $item->name }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('type_item'))
                <div class='invalid-feedback'>
                    {{ $errors->first('type_item') }}
                </div>
                @endif
            </div>
            <div class="d-sm-flex align-items-center justify-content-start ">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tipoItem" data-whatever="@mdo">Add. tipo item</button>
            </div>

            <div class="col-sm-8 mb-3 mb-sm-4">
                <label for="serial_number">Numero de Série</label>
                <input type="number" class="form-control form-control-user" id="serial_number" name="serial_number" aria-describedby="serial_number" placeholder="Insira o Numero de Série">
            </div>
            <div class="col-sm-4 mb-3 mb-sm-4">
                <label for="price">Valor</label>
                <input type="number" class="form-control form-control-user" id="price" name="price" aria-describedby="price" placeholder="Insira o Valor">
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
            <div class="col-md-6">
                <button type="submit" class="btn-user btn-block btn-success">Submit</button>

            </div>
        </div>

        <hr>
    </form>

</div>
@endsection
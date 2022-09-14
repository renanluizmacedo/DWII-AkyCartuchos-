@extends('index')

@section('conteudo')
<div class="container-fluid">

    <form class="user" action="{{ route('receipts.store') }}" method="POST" id="receiptStore">
        @csrf

        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-4">
                <label for="name">Nome</label>
                <input type="text" class="form-control form-control-user" id="name" name="name" aria-describedby="name" placeholder="Insira o nome" @if($receiptSession["name"] !='null' ) value={{$receiptSession["name"]}} @endif>
            </div>
            <div class="col-sm-4 mb-3 mb-sm-4">
                <label for="phone">Telefone</label>
                <input type="number" class="form-control form-control-user" id="phone" name="phone" aria-describedby="phone" placeholder="Insira o telefone" @if($receiptSession["phone"] !='null' ) value={{$receiptSession["phone"]}} @endif>
            </div>
            <div class="col-sm-2 mt-4 mb-sm-4">
                <div class="d-sm-flex align-items-center justify-content-start ">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCliente" data-whatever="@mdo">Add. Cliente</button>
                </div>
            </div>
            <div class="col-sm-10 mb-3 mb-sm-4">
                <label for="item">Items</label>
                <select name="item" class="custom-select form-create @if($errors->has('item')) is-invalid @endif">
                    @foreach ($items as $item)
                    <option value="{{$item->id}}" @if($item->id == old('items')) selected="true" @endif>
                        {{ $item->name }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('item'))
                <div class='invalid-feedback'>
                    {{ $errors->first('item') }}
                </div>
                @endif
            </div>
            <div class="col-sm-2 mb-3 mb-sm-4 p-4">
                <button type="submit" class="btn btn-primary" form="receiptStore" name="botaoSession" value="botaoSession">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                    </svg>
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="col-2">Name</th>
                                <th class="col-2">Serial Number</th>
                                <th class="col-2">Price</th>
                                <th class="col-2">Type</th>
                                <th class="col-2">Quantidade</th>
                                <th>Ações</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php $index=0; @endphp

                            @foreach ($items_session as $item)
                            <tr>
                                <input type="hidden" name="SELECTED_ITEMS[]" value="{{ $item->id }}">
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->serial_number}}</td>
                                <td>{{ $item->price}}</td>
                                <td>{{ $item->itemType->name}}</td>
                                <td>
                                    <input type="number" class="form-control col-8" id="AMOUNT_ITEM" name="AMOUNT_ITEM[]" aria-describedby="AMOUNT_ITEM" @if($receiptSession["amount_item"] !='null' ) value={{$receiptSession["amount_item"][$index]}} @endif>
                                </td>
                            </tr>
                            @php $index++; @endphp

                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Serial Number</th>
                                <th>Price</th>
                                <th>Type</th>
                                <th class="col-2">Quantidade</th>
                                <th>Ações</th>

                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="col-sm-12 mb-3 mb-sm-4">
                <textarea class="form-control" name="note" cols="80" rows="5" placeholder="Observação">{{$receiptSession["note"]}}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="{{route('receipts.index')}}" class="btn btn-primary btn-user btn-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z" />
                    </svg>
                    &nbsp; Voltar
                </a>
                <button type="submit" class="btn btn-primary btn-user btn-block btn-sucess">Submit</button>
            </div>
        </div>

        <hr>
    </form>

</div>
@endsection
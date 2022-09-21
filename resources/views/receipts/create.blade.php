@extends('index')

@section('conteudo')
<div class="container-fluid">
    @if ($receiptSession != null)
        @if (array_key_exists('itemInserted', $receiptSession))
            @if($receiptSession['itemInserted'] == 1)
                <x-alert-item-inserted id="hide"></x-alert-item-inserted>
            @else
                <x-alert-item-not-inserted id="hide"></x-alert-item-not-inserted>
            @endif
        @endif
        @if (array_key_exists('itemRemoved', $receiptSession))
            @if($receiptSession['itemRemoved'] == 1)
                <x-alert-item-removed id="hide"></x-alert-item-removed>
            @endif
        @endif
        @if (array_key_exists('emptyList', $receiptSession))
            @if($receiptSession['emptyList'] == 1)
                <x-alert-empty-items id="hide"></x-alert-empty-items>
            @endif
        @endif
    @endif
    <form class="user" action="{{ route('receipts.store') }}" method="POST" id="receiptStore">
        @csrf
        <div class="form-group row">
            <input type="hidden" name="customer_id" @if($receiptSession["customer_id"] !='null' ) value={{$receiptSession["customer_id"]}} @endif>


            <div class="col-sm-6 mb-3 mb-sm-4">
                <label for="name">Nome</label>
                <input type="text" class="form-control form-control-user @if($errors->has('name')) is-invalid @endif" 
                id="name" name="name" readonly placeholder="Insira o nome" 
                @if($receiptSession["name"] !='null' ) value={{$receiptSession["name"]}} @endif>
                @if($errors->has('name'))
                <div class='invalid-feedback'>
                    {{ $errors->first('name') }}
                </div>
                @endif
            </div>

            <div class="col-sm-4 mb-3 mb-sm-4">
                <label for="phone">Telefone</label>
                <input type="number" class="form-control form-control-user @if($errors->has('phone')) is-invalid @endif" id="phone" name="phone" readonly placeholder="Insira o telefone" @if($receiptSession["phone"] !='null' ) value={{$receiptSession["phone"]}} @endif>
                @if($errors->has('phone'))
                <div class='invalid-feedback'>
                    {{ $errors->first('phone') }}
                </div>
                @endif
            </div>
            <div class="col-sm-2 mt-4 mb-sm-4">
                <div class="d-sm-flex align-items-center justify-content-start ">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCliente" data-whatever="@mdo">Add. Cliente</button>
                </div>
            </div>
            <div class="col-sm-10 mb-3 mb-sm-4">
                <label for="item">Items</label>
                <select name="item" class="custom-select form-create">
                    @foreach ($items as $item)
                    <option value="{{$item->id}}" @if($item->id == old('items')) selected="true" @endif>
                        {{ $item->name }}
                    </option>
                    @endforeach
                </select>

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

                                <th>Nome</th>
                                <th>Numero de Série</th>
                                <th>Preço</th>
                                <th>Tipo</th>
                                <th class="col-2">Quantidade</th>
                                <th>Ações</th>

                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($items_session as $item)
                            <tr>
                                <input type="hidden" name="SELECTED_ITEMS[]" value="{{ $item->id }}">

                                <td>{{ $item->name }}</td>
                                <td>{{ $item->serial_number}}</td>
                                <td>{{ $item->price}}</td>
                                <td>{{ $item->itemType->name}}</td>
                                <td>
                                    <input type="number" min="1" class="form-control col-8" id="AMOUNT_ITEM" name="AMOUNT_ITEM[]" aria-describedby="AMOUNT_ITEM" value="1">
                                </td>
                                <td>
                                    <a href="{{ route('removeItemTable',$item->id) }}"  class="btn btn-danger" name="form_{$item->id}}" value="{{$item->id}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#FFF" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                        </svg>
                                    </a>

                                </td>

                            </tr>

                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>

                                <th>Nome</th>
                                <th>Numero de Série</th>
                                <th>Preço</th>
                                <th>Tipo</th>
                                <th class="col-2">Quantidade</th>
                                <th>Ações</th>

                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
            <div class="col-sm-12 mb-3 mb-sm-4">
                <textarea class="form-control  @if($errors->has('note')) is-invalid @endif" name="note" cols="80" rows="5" placeholder="Observação">{{$receiptSession["note"]}}</textarea>
                @if($errors->has('note'))
                <div class='invalid-feedback'>
                    {{ $errors->first('note') }}
                </div>
                @endif
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
                <button type="submit" class="btn btn-primary btn-user btn-block btn-sucess" form="receiptStore">Salvar</button>
            </div>
        </div>

        <hr>
    </form>
    <form class="user" action="{{ route('customerReceipt') }}" method="POST" id="customerReceipt">
        @csrf

        <div class="modal fade" id="modalCliente" tabindex="-1" aria-labelledby="modalCliente" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cliente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-sm-10 mb-3 mb-sm-4">
                            <label for="customer">Cliente</label>
                            <select name="customer" class="custom-select form-create @if($errors->has('customer')) is-invalid @endif">
                                @foreach ($customers as $c)
                                <option value="{{$c->id}}" @if($c->id == old('customer')) selected="true" @endif>
                                    {{ $c->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-success" form="customerReceipt">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
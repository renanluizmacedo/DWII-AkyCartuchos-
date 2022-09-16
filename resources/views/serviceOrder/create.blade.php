@extends('index')

@section('conteudo')
<div class="container-fluid">

    <form class="user" action="{{ route('serviceOrder.store') }}" method="POST" id="serviceOrderStore">
        @csrf


        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-4">
                <label for="name">Nome</label>
                <input type="text" class="form-control form-control-user" id="name" name="name" aria-describedby="name" placeholder="Insira o nome" @if($serviceOrdemSession["name"] !='null' ) value={{$serviceOrdemSession["name"]}} @endif>
            </div>
            <div class="col-sm-6 mb-3 mb-sm-4">
                <label for="phone">Telefone</label>
                <input type="number" class="form-control form-control-user" id="phone" name="phone" aria-describedby="phone" placeholder="Insira o telefone" @if($serviceOrdemSession["phone"] !='null' ) value={{$serviceOrdemSession["phone"]}} @endif>
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
                <button type="submit" class="btn btn-primary" form="serviceOrderStore" name="botaoSession" value="botaoSession">
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
                                <th>Name</th>
                                <th>Serial Number</th>
                                <th>Price</th>
                                <th>Type</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items_session as $item)

                            <tr>
                                <input type="hidden" name="SELECTED_ITEMS[]" value="{{ $item->id }}">
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->price}}</td>
                                <td>{{ $item->serial_number}}</td>
                                <td>{{ $item->itemType->name}}</td>
                                <td>{{ $item->itemType->name}}</td>
                                <td>
                                    <a href="{{ route('item.edit', $item->id) }}" class="btn btn-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z" />
                                            <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z" />
                                        </svg>
                                    </a>
                                    <a nohref style="cursor:pointer" onclick="showInfoModal('CURSO: {{ $item->nome }}', 'SIGLA: {{ $item->sigla }}', '{{ $item->tempo }} ANOS')" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                                            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
                                        </svg>
                                    </a>
                                    <a nohref style="cursor:pointer" onclick="showRemoveModal('{{ $item->id }}', '{{ $item->nome }}')" class="btn btn-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFF" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                        </svg>
                                    </a>
                                </td>
                                <form action="{{ route('item.destroy', $item->id) }}" method="POST" id="form_{{$item->id}}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>Serial Number</th>
                                <th>Price</th>
                                <th>Type</th>
                                <th>Ações</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="col-sm-12 mb-3 mb-sm-4">
                <textarea class="form-control" name="note" cols="80" rows="5" placeholder="Observação">{{$serviceOrdemSession["note"]}}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="{{route('serviceOrder.index')}}" class="btn btn-primary btn-user btn-block">
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
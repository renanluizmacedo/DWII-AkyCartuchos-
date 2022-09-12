@extends('index')

@section('conteudo')
<div class="container-fluid">

    <form class="user" action="{{ route('serviceOrder.store') }}" method="POST" id="serviceOrderStore">
        @csrf
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-4">
                <label for="name">Nome</label>
                <input type="text" class="form-control form-control-user" id="name" name="name" aria-describedby="name" placeholder="Insira o nome">
            </div>
            <div class="col-sm-6 mb-3 mb-sm-4">
                <label for="phone">Telefone</label>
                <input type="number" class="form-control form-control-user" id="phone" name="phone" aria-describedby="phone" placeholder="Insira o telefone">
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
                            @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->price}}</td>
                                <td>{{ $item->serial_number}}</td>
                                <td>{{ $item->itemType->name}}</td>
                                <td>{{ $item->itemType->name}}</td>

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
            <div class="div">

            </div>
            <div class="col-sm-12 mb-3 mb-sm-4">
                <textarea name="" id="" cols="80" rows="5" placeholder="Observação"></textarea>
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
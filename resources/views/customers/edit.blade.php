@extends('index')

@section('conteudo')
<div class="container-fluid">
    <h3>ALTERAR CLIENTES</h3>

    <form class="user" action="{{ route('customers.update',$customer->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="name">Nome</label>
                <input type="text" class="form-control form-control-user" id="name" name="name" aria-describedby="name" placeholder="Insira o nome" value="{{$customer->name}}">
            </div>
            <div class="col-sm-6 mb-3 mb-sm-4">
                <label for="phone">Telefone</label>
                <input type="number" class="form-control form-control-user" id="phone" name="phone" aria-describedby="phone" placeholder="Insira o telefone" value="{{$customer->phone}}">
            </div>
            <div class="col-sm-12 mb-3 mb-sm-0">
                <label for="address">Endereço</label>
                <select name="address" class="custom-select form-create @if($errors->has('address')) is-invalid @endif">
                    @foreach ($addresses as $item)
                    <option value="{{$item->id}}" @if($item->id == old('address')) selected="true" @endif>
                        {{ $item->address }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('address'))
                <div class='invalid-feedback'>
                    {{ $errors->first('address') }}
                </div>
                @endif
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <a href="{{route('customers.index')}}" class="btn btn-primary btn-user btn-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z" />
                    </svg>
                    &nbsp; Voltar
                </a>

            </div>
            <div class="col-md-6">
                <button type="submit" class=" btn-user btn-block btn-success">Submit</button>

            </div>
        </div>

        <hr>
    </form>
</div>
@endsection
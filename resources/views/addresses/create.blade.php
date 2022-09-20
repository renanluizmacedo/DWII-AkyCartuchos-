@extends('index')

@section('conteudo')
<div class="container-fluid">

    <form class="user" action="{{ route('addresses.store') }}" method="POST">
        @csrf
        <div class="form-group row">
            <div class="col-sm-8 mb-3 mb-sm-2">
                <label for="address">Endereço</label>
                <input type="text" class="form-control form-control-user" id="address" name="address" aria-describedby="name" placeholder="Insira o Endereço">
            </div>
            <div class="col-sm-4 mb-3 mb-sm-2">
                <label for="zipcode">CEP</label>
                <input type="number" class="form-control form-control-user" id="zipcode" name="zipcode" aria-describedby="zipcode" placeholder="Insira o CEP">
            </div>
            <div class="col-sm-4 mb-3 mb-sm-2">
                <label for="number">Numero</label>
                <input type="number" class="form-control form-control-user" id="number" name="number" aria-describedby="number" placeholder="Insira o Numero">
            </div>
            <div class="col-sm-8 mb-3 mb-sm-2">
                <label for="neighborhood">Bairro</label>
                <input type="text" class="form-control form-control-user" id="neighborhood" name="neighborhood" aria-describedby="neighborhood" placeholder="Insira o Bairro">
            </div>
            <div class="col-sm-12 mb-3 mb-sm-2">
                <label for="city">Cidade</label>
                <input type="text" class="form-control form-control-user" id="city" name="city" aria-describedby="city" placeholder="Insira a Cidade">
            </div>

        </div>


        <div class="row">
            <div class="col-md-6">
                <a href="{{route('addresses.index')}}" class="btn btn-primary btn-user btn-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z" />
                    </svg>
                    &nbsp; Voltar
                </a>

            </div>
            <div class="col-md-6">
                <button type="submit" class=" btn-success btn-user btn-block ">Salvar</button>

            </div>
        </div>

        <hr>
    </form>
</div>
@endsection
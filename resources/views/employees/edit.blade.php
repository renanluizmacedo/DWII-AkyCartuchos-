@extends('index')

@section('conteudo')
<div class="container-fluid">
    <h3>EDITAR FUNCIONARIO</h3>

    <form class="user" action="{{ route('employees.update',$employee->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="name">Nome</label>
                <input type="text" class="form-control form-control-user" id="name" readonly name="name" aria-describedby="name" placeholder="Insira o nome" value="{{$employee->name}}">
            </div>
            <div class="col-sm-6 mb-3 mb-sm-4">
                <label for="email">Email</label>
                <input type="email" class="form-control form-control-user" id="email" readonly name="email" aria-describedby="email" placeholder="Insira o Email" value="{{$employee->email}}">
            </div>
            <div class="col-sm-12 mb-3 mb-sm-0">
                <label for="role">Privilegio</label>
                <select name="role" class="custom-select form-create @if($errors->has('role')) is-invalid @endif">
                    @foreach ($roles as $item)
                        @if($item->name != 'ADMINISTRADOR')
                            <option value="{{$item->id}}" @if($item->id == $employee->role->id) selected="true" @endif>
                                {{ $item->name }}
                            </option>
                        @endif
                    @endforeach
                </select>
                @if($errors->has('role'))
                <div class='invalid-feedback'>
                    {{ $errors->first('role') }}
                </div>
                @endif
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <a href="{{route('employees.index')}}" class="btn btn-primary btn-user btn-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z" />
                    </svg>
                    &nbsp; Voltar
                </a>

            </div>
            <div class="col-md-6">
                <button type="submit" class=" btn-user btn-block btn-success">Salvar</button>

            </div>
        </div>

        <hr>
    </form>
</div>
@endsection
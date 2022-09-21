@extends('index')

@section('conteudo')
<div class="container-fluid">
    <h3>INFORMAÇÕES DA CONTA</h3>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="name">Nome</label>
                <input type="text" class="form-control form-control-user" readonly id="name" name="name" 
                aria-describedby="name" value="{{Auth::user()->name}}">
            </div>
            <div class="col-sm-6 mb-3 mb-sm-4">
                <label for="email">Email</label>
                <input type="email" class="form-control form-control-user" readonly id="email" name="email" aria-describedby="email"  value="{{Auth::user()->email}}">
            </div>
            <div class="col-sm-12 mb-3 mb-sm-0">
                <label for="text">Privilégio</label>
                <input type="text" class="form-control form-control-user" readonly id="role" name="role" aria-describedby="role"  value="{{Auth::user()->role->name}}">
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <a href="{{route('dashboard')}}" class="btn btn-primary btn-user btn-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left-square-fill" viewBox="0 0 16 16">
                        <path d="M16 14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12zm-4.5-6.5H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5a.5.5 0 0 0 0-1z" />
                    </svg>
                    &nbsp; Voltar
                </a>

            </div>
        </div>

        <hr>
    </form>
</div>
@endsection
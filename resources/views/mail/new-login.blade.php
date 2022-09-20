<html>
<body>
   <h4>Seja bem vindo(a), {{$user->nome}}</h4>
   <p> Novo acesso com email: {{$user->email}}</p>
   <p> Data/Hora: {{ $data }}</p>
   <div>
       <img width="100%" height="100%"
           src="{{ $message->embed(public_path().'/img/logo_marca.png') }}">
   </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Library</h1>

    
<div class="col">
@foreach($books as $key => $value)
    <div class="card">
        <img src="https://www.lumien.it/wp-content/uploads/2022/01/Come-promuovere-un-libro.jpg" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Nome Libro :{{$value->title}}</h5>
            <p class="card-text">ID libro :{{$value->id}}</p>
            <p class="card-text">Pagine :{{$value->pages}}</p>
            <p class="card-text">Anno pubblicazione : {{$value->year}}</p></p>

            @foreach ($value->authors as $user)
            <p class="card-text">Autore : {{$user->name}}</p>
           
            @endforeach

            @foreach ($value->categories as $categoriesItem)
            <p class="card-text">Categoria: {{$categoriesItem->name}}</p>
            
            @endforeach

            @foreach ($value->reservations as $reservations)
            <p class="card-text">Prenotazioni : {{$reservations->stato}}</p>
            <p class="card-text">ID Utente Prenotazione : {{$reservations->user_id}}</p>
            @endforeach
            
            @foreach($users as $key => $users)
            <p class="card-text">Nome Utente: {{$users->name}}</p>
            @endforeach
            
        </div>
    </div>
</div>
@endforeach




</body>
</html>

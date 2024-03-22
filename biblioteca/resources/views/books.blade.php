    @extends('layouts.layout')
    @section('title', 'Books Library')
    @section('content')
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($books as $key => $value)
        <div class="col">
            <div class="card">
                <img src="https://www.lumien.it/wp-content/uploads/2022/01/Come-promuovere-un-libro.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Nome Libro :{{$value->title}}</h5>
                    <p class="card-text">ID libro :{{$value->id}}</p>
                    <p class="card-text">Pagine :{{$value->pages}}</p>
                    <p class="card-text">Numero di Copie :{{$value->numcopies}}</p>
                    <p class="card-text">Anno pubblicazione : {{$value->year}}</p>

                    @foreach ($value->authors as $user)
                    <p class="card-text" id="card-author">Autore : {{$user->name}}</p>
                    @endforeach

                    @foreach ($value->categories as $categoriesItem)
                    <p class="card-text">Categoria: {{$categoriesItem->name}}</p>
                    @endforeach

                    @foreach ($value->reservations as $reservations)
                    <p class="card-text">Prenotazioni : {{$reservations->stato}}</p>
                    <p class="card-text">ID Utente Prenotazione : {{$reservations->user_id}}</p>
                    @endforeach

                    @foreach($value->reservations as $reservation)
                    @foreach($users as $user)
                    @if($reservation->user_id === $user->id)
                    <p class="card-text">Nome Utente: {{$user->name}}</p>
                    @endif
                    @endforeach
                    @endforeach
                    @if(Auth::user()->isAdmin === 1)
                    <div class="d-flex">
                        <a type="button" class="btn btn-outline-warning h-25 mx-2" href="/books/{{$value->id}}/edit"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="/books/{{$value->id}}">
                            @csrf
                            @method ('DELETE')
                            <button type="submit" class="btn btn-outline-danger" ><i class="bi bi-trash"></i></button>
                        </form>

                    </div>
                    @endif

                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endsection

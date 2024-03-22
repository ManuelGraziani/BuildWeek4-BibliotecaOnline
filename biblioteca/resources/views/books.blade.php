    @extends('layouts.layout')
    @section('title', 'Books Library')
    @section('content')
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($books as $key => $value)
        <div class="col">
            <div class="card">
                <img src="https://www.lumien.it/wp-content/uploads/2022/01/Come-promuovere-un-libro.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <table class="table text-start">
                                <thead>
                                    <tr>
                                        <th scope="col">Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border-0" id="card-title">{{$value->title}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col">
                            <table class="table text-end">
                                <thead>
                                    <tr>
                                        <th scope="col">Authors</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($value->authors as $user)
                                    <tr>
                                        <td class="border-0" id="card-author">{{$user->name}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row border-top border-bottom">
                        <div class="col">
                            <h5>Dettagli</h5>
                            <p class="card-text">Pagine :{{$value->pages}}</p>
                            <p class="card-text">Anno pubblicazione : {{$value->year}}</p>
                        </div>
                        <div class="col text-end">
                            <ul class="list-group">
                                <h5>Categoria</h5>

                                @foreach ($value->categories as $categoriesItem)
                                <li class="list-group-item border-0">{{$categoriesItem->name}}</li>
                                @endforeach
                            </ul>

                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                            <h5>Stato</h5>
                            @foreach ($value->reservations as $reservations)
                            @if($reservations->book_id === $value->id)
                            <p class="card-text">Prenotazioni : {{$reservations->stato}}</p>
                            <p class="card-text">ID Utente Prenotazione : {{$reservations->user_id}}</p>
                            @endif
                            @endforeach
                            <div class="d-flex justify-content-between align-items-center my-3">


                                <p class="card-text m-0">Numero di Copie :{{$value->numcopies}}</p>
                                @if($value->numcopies >= 1)

                                <span>
                                    <a class="btn btn-outline-primary" href="">Prenota</a>
                                </span>
                                @else
                                <span>
                                    <button type="button" class="btn btn-danger" disabled>Non disponibile</button>
                                </span>

                                @endif
                            </div>
                            @foreach($value->reservations as $reservation)
                            @foreach($users as $user)
                            @if($reservation->user_id === $user->id)
                            <p class="card-text">Nome Utente: {{$user->name}}</p>
                            @endif
                            @endforeach
                            @endforeach
                        </div>
                    </div>
                    @if(Auth::user()->isAdmin === 1)
                    <div class="d-flex my-3">
                        <a type="button" class="btn btn-outline-warning h-25 mx-2" href="/books/{{$value->id}}/edit"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="/books/{{$value->id}}">
                            @csrf
                            @method ('DELETE')
                            <button type="submit" class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>

                    </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endsection
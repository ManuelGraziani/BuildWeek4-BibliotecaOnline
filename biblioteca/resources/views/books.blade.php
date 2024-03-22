    @extends('layouts.layout')
    @section('title', 'Books Library')
    @section('content')
    <div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach($books as $key => $value)
        <div class="col">
            <div class="card">
                <img src="https://www.lumien.it/wp-content/uploads/2022/01/Come-promuovere-un-libro.jpg" class="card-img-top" alt="..." >
                <div class="card-body">
                    <h5 class="card-title">Nome Libro :{{$value->title}}</h5>
                    <p class="card-text">ID libro :{{$value->id}}</p>
                    <p class="card-text">Pagine :{{$value->pages}}</p>
                    <p class="card-text">Numero di Copie :{{$value->numcopies}}</p>
                    <p class="card-text">Anno pubblicazione : {{$value->year}}</p>

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

                    @foreach($value->reservations as $reservation)
                        @foreach($users as $user)
                            @if($reservation->user_id === $user->id)
                            <p class="card-text">Nome Utente: {{$user->name}}</p>
                            @endif
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endsection

    <script>

        const search = document.getElementById('search');
        const cards_titles = document.querySelectorAll('.card-title');

        search.addEventListener('input', (e) => {
            const value = e.target.value.toLowerCase(); // Convert input value to lowercase for case-insensitive search
            cards_titles.forEach(card_title => {
                const card = card_title.closest('.card'); // Get the closest parent .card element
                if (card_title.textContent.toLowerCase().includes(value)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
    


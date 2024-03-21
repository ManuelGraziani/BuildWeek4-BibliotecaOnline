<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="col">
    <h1>Library</h1>
    <form action="search">
                    <label for="search">Search</label>
                    <input type="text" id="search" name="search" placeholder="Search">
                </form>
        @foreach($books as $key => $value)
        <div class="card">
            <img src="https://www.lumien.it/wp-content/uploads/2022/01/Come-promuovere-un-libro.jpg" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Nome Libro :{{$value->title}}</h5>
                <p class="card-text">ID libro :{{$value->id}}</p>
                <p class="card-text">Pagine :{{$value->pages}}</p>
                <p class="card-text">Anno pubblicazione : {{$value->year}}</p>
                </p>

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
</body>
</html>
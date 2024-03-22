@extends('layouts.layout')
@section('title', 'Modifica Libro')

@section('content')
<form method="POST" action="/books/{{ $book->id }}">
    @csrf
    @method('PUT')
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Titolo</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="title" value="{{ $book->title }}">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Descrizione</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="description" value="{{ $book->description }}">
  </div>
  <button type="submit" class="btn btn-outline-secondary">Modifica</button>
</form>
@endsection
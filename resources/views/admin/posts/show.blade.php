@extends('layouts.app');

@section('content')

  <div class="container">
    <h1>{{ $article->title }}</h1>
    <img src={{ asset('storage/'.$article->image) }} alt="">
    <div class="">
      {{ $article->content }}
    </div>
  </div>

@endsection

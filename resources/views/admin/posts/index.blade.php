@extends('layouts.app')
@section('content')

  <div class="container">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Titolo</th>
          <th scope="col">Slug</th>
          <th scope="col">Contenuto</th>
          <th>Azioni</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($articles as $article)
          <tr>
            <td>{{$article->title}}</td>
            <td>{{$article->slug}}</td>
            <td>{{$article->content}}</td>
            <td>
              <a href={{route('posts.show', $article->slug)}}>View</a>
              {{-- <a href={{route('posts.show')}}>View</a>
              <a href={{route('posts.show')}}>View</a> --}}
            </td>
          </tr>
        @endforeach

      </tbody>
    </table>

  </div>

@endsection

@extends('adminlte::page')

@section('title', 'CRM | Новости')

@section('content_header')
  <h1>Новости</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-header text-right">
      <a class="btn btn-primary" href="{{ route('crm.posts.create') }}">Создать</a>
    </div>
    <div class="card-body">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Заголовок</th>
            <th scope="col">Дата создания</th>
            <th scope="col">Действия</th>
          </tr>
        </thead>
        <tbody>
          @foreach($posts as $post)
            <tr>
              <td class="text-bold">{{ $post->id }}</td>
              <td>
                <a href="{{ route('crm.posts.show', [ 'post' => $post->id ]) }}">{{ $post->title }}</a>
              </td>
              <td>{{ $post->created_at->format('d.m.Y h:m') }}</td>
              <td>
                <div class="btn-group">
                  <a class="btn btn-default" href="{{ route('crm.posts.edit', [ 'post' => $post->id ]) }}">
                    <i class="fas fa-edit"></i>
                  </a>
                  <form method="POST" action="{{ route('crm.posts.destroy', [ 'post' => $post->id ]) }}">
                    @method('DELETE')
                    @csrf
                    <button class="btn btn-default" type="submit"><i class="fas fa-trash"></i></button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer">
      {{ $posts->links() }}
    </div>
  </div>
@stop

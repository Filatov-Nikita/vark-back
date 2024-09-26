@extends('adminlte::page')

@section('title', 'CRM | Новости | ' . $post->title)

@section('content_header')
  <h1>Новости | {{ $post->title }}</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-header">
      <div class="row justify-content-between">
        <a class="btn btn-primary mr-2" href="{{ route('crm.posts.index') }}">К списку</a>
        <div class="row">
          <a class="btn btn-primary mr-2" href="{{ route('crm.posts.edit', [ 'post' => $post->id ]) }}">Редактировать</a>
          <form method="POST" action="{{ route('crm.posts.destroy', [ 'post' => $post->id ]) }}">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger" type="submit">Удалить</button>
          </form>
        </div>
      </div>
    </div>
    <div class="card-body">
      <table class="table table-striped">
        <tbody>
          <tr>
            <td>ID</td>
            <td>{{ $post->id }}</td>
          </tr>
          <tr>
            <td>Дата создания</td>
            <td>{{ $post->created_at->format('d.m.Y h:m') }}</td>
          </tr>
          <tr>
            <td>Заголовок</td>
            <td>{{ $post->title }}</td>
          </tr>
          <tr>
            <td>Url</td>
            <td>{{ $post->slug }}</td>
          </tr>
          <tr>
            <td>Контент</td>
            <td>{{ $post->body }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
@stop

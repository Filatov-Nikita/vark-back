@extends('adminlte::page')

@section('title', 'CRM | Новости | Редактировать')

@section('content_header')
  <h1>Новости | Редактировать</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-header">
      <a class="btn btn-primary mr-2" href="{{ route('crm.posts.show', [ 'post' => $post->id ]) }}">В карточку</a>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('crm.posts.update', [ 'post' => $post->id ]) }}">
        @csrf
        @method('PUT')
        <x-adminlte-input
          name="title"
          id="title"
          label="Заголовок"
          type="text"
          value="{{ $post->title }}"
          enable-old-support
        />
        <x-adminlte-input
          name="slug"
          id="slug"
          label="Url"
          type="text"
          value="{{ $post->slug }}"
          enable-old-support
        />
        <x-adminlte-textarea
          name="body"
          id="body"
          label="Контент"
          rows="10"
          enable-old-support
        >
          {{ $post->body }}
        </x-adminlte-textarea>
        <button type="submit" class="btn btn-primary">
          Отправить
        </button>
      </form>
    </div>
  </div>
@stop

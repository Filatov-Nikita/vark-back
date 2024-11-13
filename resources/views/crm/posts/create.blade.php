@extends('adminlte::page')

@section('title', 'CRM | Новости | Создать')

@section('content_header')
  <h1>Новости | Создать</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-header">
      <a class="btn btn-primary mr-2" href="{{ route('crm.posts.index') }}">К списку</a>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('crm.posts.store') }}">
        @csrf
        <x-adminlte-input
          name="title"
          id="title"
          label="Заголовок"
          type="text"
          enable-old-support
        />
        <x-adminlte-input
          name="slug"
          id="slug"
          label="Url"
          type="text"
          enable-old-support
        />
        <x-adminlte-textarea
          name="body"
          id="body"
          label="Контент"
          rows="10"
          enable-old-support
        />
        <button type="submit" class="btn btn-primary">
          Отправить
        </button>
      </form>
    </div>
  </div>
@stop

@section('js')
  @vite('resources/js/posts/save.js')
@stop

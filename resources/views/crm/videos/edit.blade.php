@extends('adminlte::page')

@section('title', 'CRM | Фото | Редактировать')

@section('content_header')
  <h1>Фото | Редактировать</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-header">
      <a class="btn btn-primary mr-2" href="{{ route('crm.videos.show', [ 'video' => $video->id ]) }}">В карточку</a>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('crm.videos.update', [ 'video' => $video->id ]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-adminlte-input-file
          name="video"
          legend="Открыть"
          placeholder="Выберите файл"
          label="Видео"
        >
          <x-slot name="bottomSlot">
            <span class="text-sm text-gray">Максимум 10мб</span>
          </x-slot>
        </x-adminlte-input-file>
        <x-adminlte-input-file
          name="preview"
          legend="Открыть"
          placeholder="Выберите файл"
          label="Миниатюра"
        >
          <x-slot name="bottomSlot">
            <span class="text-sm text-gray">Максимум 1мб</span>
          </x-slot>
        </x-adminlte-input-file>
        <x-adminlte-input
          name="title"
          id="title"
          label="Заголовок (необязательно)"
          type="text"
          enable-old-support
          value="{{ $video->title }}"
        />
        <button type="submit" class="btn btn-primary">
          Отправить
        </button>
      </form>
    </div>
  </div>
@stop

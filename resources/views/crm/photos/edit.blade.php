@extends('adminlte::page')

@section('title', 'CRM | Фото | Редактировать')

@section('content_header')
  <h1>Фото | Редактировать</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-header">
      <a class="btn btn-primary mr-2" href="{{ route('crm.photos.show', [ 'photo' => $photo->id ]) }}">В карточку</a>
    </div>
    <div class="card-body">
      <form method="POST" action="{{ route('crm.photos.update', [ 'photo' => $photo->id ]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-2">
          <img style="width: 200px; height: auto" width="{{ $photo->image->width }}" height="{{ $photo->image->height }}" src="{{ $photo->image->url }}" />
        </div>
        <x-adminlte-input-file
          name="photo"
          legend="Открыть"
          placeholder="Выберите файл"
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
          value="{{ $photo->title }}"
        />
        <button type="submit" class="btn btn-primary">
          Отправить
        </button>
      </form>
    </div>
  </div>
@stop

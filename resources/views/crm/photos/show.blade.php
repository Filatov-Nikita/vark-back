@extends('adminlte::page')

@section('title', 'CRM | Фото | №' . $photo->id)

@section('content_header')
  <h1>Фото | №{{ $photo->id }}</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-header">
      <div class="row justify-content-between">
        <a class="btn btn-primary mr-2" href="{{ route('crm.photos.index') }}">К списку</a>
        <div class="row">
          <a class="btn btn-primary mr-2" href="{{ route('crm.photos.edit', [ 'photo' => $photo->id ]) }}">Редактировать</a>
          <form method="POST" action="{{ route('crm.photos.destroy', [ 'photo' => $photo->id ]) }}">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger" type="submit">Удалить</button>
          </form>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="mb-4">
        <img style="width: 450px; height: auto" width="{{ $photo->image->width }}" height="{{ $photo->image->height }}" src="{{ $photo->image->url }}" />
      </div>
      @if($photo->title)
        <p>{{ $photo->title }}</p>
      @endif
    </div>
  </div>
@stop

@extends('adminlte::page')

@section('title', 'CRM | Фото')

@section('content_header')
  <h1>Фото</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-header text-right">
      <a class="btn btn-primary" href="{{ route('crm.photos.create') }}">Создать</a>
    </div>
    <div class="card-body">
      <div class="row">
        @foreach($photos as $photo)
        <div class="col-3">
          <div class="card">
            <a href="{{ route('crm.photos.show', [ 'photo' => $photo->id ]) }}">
              <img
                style="height: 250px; object-fit: cover"
                class="card-img-top img-fluid"
                width="{{ $photo->image->width }}"
                height="{{ $photo->image->height }}"
                src="{{ $photo->image->url }}"
              />
            </a>
            <div class="card-body">
              <p style="min-height: 20px">{{ $photo->title }}</p>
              <a href="{{ route('crm.photos.show', [ 'photo' => $photo->id ]) }}" class="btn btn-danger w-100">
                Удалить
              </a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
@stop

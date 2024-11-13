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
      @if(count($photos) === 0)
        <p class="text-center mb-0 py-4">Еще не добавлено ни одного фото</p>
      @else
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
              <form method="POST" action="{{ route('crm.photos.destroy', [ 'photo' => $photo->id ]) }}">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger w-100" type="submit">Удалить</button>
              </form>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @endif
    </div>
  </div>
@stop

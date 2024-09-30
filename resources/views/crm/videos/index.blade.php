@extends('adminlte::page')

@section('title', 'CRM | Видео')

@section('content_header')
  <h1>Видео</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-header text-right">
      <a class="btn btn-primary" href="{{ route('crm.videos.create') }}">Создать</a>
    </div>
    <div class="card-body">
      <div class="row">
        @foreach($videos as $video)
        <div class="col-3">
          <div class="card">
            <a href="{{ route('crm.videos.show', [ 'video' => $video->id ]) }}">
              <img
                style="height: 250px; object-fit: cover"
                class="card-img-top img-fluid"
                width="{{ $video->preview->width }}"
                height="{{ $video->preview->height }}"
                src="{{ $video->preview->url }}"
              />
            </a>
            <div class="card-body">
              <p style="min-height: 20px">{{ $video->title }}</p>
              <form method="POST" action="{{ route('crm.videos.show', [ 'video' => $video->id ]) }}">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger w-100" type="submit">Удалить</button>
              </form>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
@stop

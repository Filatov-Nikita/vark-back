@extends('adminlte::page')

@section('title', 'CRM | Видео | №' . $video->id)

@section('content_header')
  <h1>Видео | №{{ $video->id }}</h1>
@stop

@section('content')
  <div class="card">
    <div class="card-header">
      <div class="row justify-content-between">
        <a class="btn btn-primary mr-2" href="{{ route('crm.videos.index') }}">К списку</a>
        <div class="row">
          <a class="btn btn-primary mr-2" href="{{ route('crm.videos.edit', [ 'video' => $video->id ]) }}">Редактировать</a>
          <form method="POST" action="{{ route('crm.videos.destroy', [ 'video' => $video->id ]) }}">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger" type="submit">Удалить</button>
          </form>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="mb-4">
        <video style="width: 550px; display: block" class="mb-4" src="{{ $video->video->url }}" autoplay controls muted></video>
        <img style="width: 350px; height: auto; display: block;" width="{{ $video->preview->width }}" height="{{ $video->preview->height }}" src="{{ $video->preview->url }}" />
      </div>
      @if($video->title)
        <p>{{ $video->title }}</p>
      @endif
    </div>
  </div>
@stop

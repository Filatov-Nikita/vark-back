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
          <tr>
            <td>Миниатюра</td>
            @if($post->thumbnail)
            <td>
              <div class="mb-4">
                <img style="width: 300px; height: auto" width="{{ $post->thumbnail->width }}" height="{{ $post->thumbnail->height }}" src="{{ $post->thumbnail->url }}" />
              </div>
              <form action="{{ route('crm.posts.thumbnail.update', [ 'post' => $post->id ]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <x-adminlte-input-file
                  name="thumbnail"
                  legend="Открыть"
                  placeholder="Выберите файл"
                >
                  <x-slot name="bottomSlot">
                    <span class="text-sm text-gray">Максимум 1мб</span>
                  </x-slot>
                </x-adminlte-input-file>
                <button class="btn btn-primary" type="submit">Обновить</button>
              </form>
            </td>
            @else
            <td>
              <form action="{{ route('crm.posts.thumbnail.store', [ 'post' => $post->id ]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <x-adminlte-input-file
                  name="thumbnail"
                  legend="Открыть"
                  placeholder="Выберите файл"
                >
                  <x-slot name="bottomSlot">
                    <span class="text-sm text-gray">Максимум 1мб</span>
                  </x-slot>
                </x-adminlte-input-file>
                <button class="btn btn-primary" type="submit">Загрузить</button>
              </form>
            </td>
            @endif
          </tr>
          <tr>
            <td>Изображение</td>
            @if($post->image)
            <td>
              <div class="mb-4">
                <img style="width: 300px; height: auto" width="{{ $post->image->width }}" height="{{ $post->image->height }}" src="{{ $post->image->url }}" />
              </div>
              <form action="{{ route('crm.posts.image.update', [ 'post' => $post->id ]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <x-adminlte-input-file
                  name="image"
                  legend="Открыть"
                  placeholder="Выберите файл"
                >
                  <x-slot name="bottomSlot">
                    <span class="text-sm text-gray">Максимум 1мб</span>
                  </x-slot>
                </x-adminlte-input-file>
                <button class="btn btn-primary" type="submit">Обновить</button>
              </form>
            </td>
            @else
            <td>
              <form action="{{ route('crm.posts.image.store', [ 'post' => $post->id ]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <x-adminlte-input-file
                  name="image"
                  legend="Открыть"
                  placeholder="Выберите файл"
                >
                  <x-slot name="bottomSlot">
                    <span class="text-sm text-gray">Максимум 1мб</span>
                  </x-slot>
                </x-adminlte-input-file>
                <button class="btn btn-primary" type="submit">Загрузить</button>
              </form>
            </td>
            @endif
          </tr>
        </tbody>
      </table>
    </div>
  </div>
@stop

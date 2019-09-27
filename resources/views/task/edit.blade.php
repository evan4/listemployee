@extends('layouts.app') 
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Dashboard</div>
      </div>
    </div>
  </div>

  <h1>Правка задачи</h1>
  <div class="row">
    <form method="post" action="/admin/task-update" class="col-12">
      @csrf
      <input type="hidden" name="_method" value="PUT">
      <input type="hidden" name="id" value="{{$task->id}}">
      <div class="form-group">
        <label for="title">Заголовок</label>
        <input type="text" class="form-control" name="title" 
        id="title" value="{{$task->title}}" required>
      </div>
      <div class="form-group">
        <label for="message">Текст</label>
        <textarea name="message" id="message" class="form-control"
          id="message" rows="3" required>{{$task->message}}</textarea>
      </div>
      <div class="form-group">
          <select name="status" class="status custom-select">
              <option value="0" 
              {{ ($task->status === 0) ? 'selected' : '' }}
              >В работе</option>
              <option value="1"
              {{ ($task->status === 1) ? 'selected' : '' }}
              >Завершено</option>
          </select>
      </div>
      <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

  </div>
</div>
@endsection
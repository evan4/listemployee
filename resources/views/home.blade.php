@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif You are logged in!
                </div>

            </div>
        </div>

    </div>
    <div class="alert alert-success alert-dismissible d-none" role="alert">
        <p class="result"></p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="alert alert-danger alert-dismissible d-none"  role="alert">
        <p>Произошла ошибка. Попробуйте еще раз</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="row justify-content-between">
        <h1 class="col-4">Список задач</h2>
            <div class="col-4">
                <button type="button" data-toggle="modal" data-target="#newTask" class="btn btn-primary float-right mt-2" id="new-task">Создать задачу</button>
            </div>
    </div>

    <div class="row">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width:20%">Заголовок</th>
                        <th style="width:65%">Задача</th>
                        <th style="width:15%">Статус</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                    <tr>
                        <td style="width:20%">{{$task->title}}</td>
                        <td style="width:65%">{{$task->message}}</td>
                        <td style="width:15%">
                            <select name="status" class="status custom-select" id="status-{{$task->id}}">
                                <option value="0" 
                                {{ ($task->status === 0) ? 'selected' : '' }}
                                >В работе</option>
                                <option value="1"
                                {{ ($task->status === 1) ? 'selected' : '' }}
                                >Завершено</option>
                            </select>
                        </td>
                        <td class="text-center">
                            <a href="/admin/task/edit/{{$task->id}}">
                                <i class="fas fa-eye-dropper"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="#" id="task-{{$task->id}}" class="task-delete">
                                <i class="fas fa-trash-alt text-danger"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$tasks->links()}}
        </div>
        <!-- Modal -->
        <div class="modal fade" id="newTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Новая задача</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
                    </div>
                    <div class="modal-body">

                        <form method="post" class="newtask">
                            @csrf
                            <div class="form-group">
                                <label for="title">Заголовок</label>
                                <input type="text" class="form-control" name="title" id="title">
                            </div>
                            <div class="form-group">
                                <label for="message">Текст</label>
                                <textarea name="message" id="message" class="form-control" id="message" cols="3" rows="1"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Создать</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
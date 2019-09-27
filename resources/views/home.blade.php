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
    <div class="row">
        <h1 class="mt-5">Список задач</h1>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width:20%">Заголовок</th>
                        <th style="width:70%">Задача</th>
                        <th style="width:10%">Статус</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                    <tr>
                        <td style="width:20%">{{$task->title}}</td>
                        <td style="width:70%">{{$task->message}}</td>
                        <td style="width:10%">
                            @if($task->status) {{$task->status}} @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$tasks->links()}}
        </div>
    </div>
</div>
@endsection
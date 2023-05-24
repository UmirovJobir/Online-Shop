@extends('layouts.main')


@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <style>
        .my-active span{
            background-color: #5cb85c !important;
            color: white !important;
            border-color: #5cb85c !important;
        }
        ul.pager>li {
            display: inline-flex;
            padding: 5px;
        }
    </style>


    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Пользователи</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Главная</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row py-2">
                                <div class="col-md-8 pd-2">
                                    <a href="#" class="btn btn-danger" id="deleteAllSelectedRecord">Удалить все</a>
                                    <a href="{{route('users.create')}}" class="btn btn-primary">Добавить</a>
                                </div>

                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>

                                        <tr>
                                            <th><input type="checkbox" name="" id="selected_all_ids"></th>
                                            <th>ID</th>
                                            <th>Имя пользователя</th>
                                            <th>Имя</th>
                                            <th>Фамилия</th>
                                            <th>Отчество</th>
                                            <th>Эмаил</th>
                                            <th>Возраст</th>
                                            <th>Адрес</th>
                                            <th>Пол</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                            <tr id="$user_ids{{$user->id}}">
                                                <td><input type="checkbox" name="ids" class="checkbox_ids" id="" value="{{ $user->id }}"></td>
                                                <td>{{$user->id}}</td>
                                                <td>{{$user->surname}}</td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->patronymic}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->age}}</td>
                                                <td>{{$user->address}}</td>
                                                <td>{{$user->gender}}</td>
                                                <td>
                                                    <div class="row">
                                                        <a href="{{ route('users.show', ['user' => $user->id]) }}" class="btn btn-info">
                                                            <i class="bi bi-info-square"></i>
                                                        </a>
                                                        <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-warning">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </a>
                                                        <form action="{{ route('users.destroy',['user'=>$user->id]) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button onclick="return confirm('Вы уверены, что хотите удалить?')" type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <div class="d-flex">
                                {{ $users->withQueryString()->links() }}
                            </div>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li>{{ $users_count }} users</li>
                            </ol>
                        </div><!-- /.col -->
                    </div>
                </div><!-- /.container-fluid -->

                <script>
                    $(function(e){
                        $("#selected_all_ids").click(function(){
                            $('.checkbox_ids').prop('checked',$(this).prop('checked'));
                        });

                        $("#deleteAllSelectedRecord").click(function(e){
                            e.preventDefault();
                            var all_ids = [];
                            $('input:checkbox[name=ids]:checked').each(function () {
                                all_ids.push($(this).val());
                            });

                            $.ajax({
                                url:"{{route('selectedusers.destroy')}}",
                                type:"DELETE",
                                data: {
                                    ids: all_ids,
                                    _token: "{{csrf_token()}}"
                                },
                                success:function (response){
                                    $.each(all_ids, function(key,val){
                                        $('#user_ids' + val).remove();
                                    })
                                }

                            });
                            location.reload();
                        });
                    });

                </script>
            </div>
        </div>
    </section>
    <!-- /.content -->

@endsection

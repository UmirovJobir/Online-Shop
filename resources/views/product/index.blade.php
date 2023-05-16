@extends('layouts.main')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <style>
        img {
            float: left;
            width:  50px;
            height: 50px;
            object-fit: cover;
            /*margin-right: 10px;*/
        }
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
                    <h1 class="m-0">Продукты</h1>
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
                                    <a href="{{route('products.create')}}" class="btn btn-primary">Добавить</a>
                                </div>

{{--                        <div class="row">--}}
{{--                            @foreach($products as $product)--}}
{{--                                <div class="card" style="width: 18rem;">--}}
{{--                                    @if ($product->preview_image)--}}
{{--                                        <img width="15%" src="{{asset('storage/'.$product->preview_image)}}" class="card-img-top" alt="...">--}}
{{--                                    @else--}}
{{--                                        <img width="22%" src="{{asset('storage/images/unknown.jpg')}}" class="card-img-top" alt="...">--}}
{{--                                    @endif--}}
{{--                                    <div class="card-body">--}}
{{--                                        <h4><strong>{{$product->title}}</strong></h4>--}}
{{--                                        <p class="card-text">--}}
{{--                                            ID --- {{$product->id}}<br>--}}
{{--                                            Description --- {{$product->description}}<br>--}}
{{--                                            Content --- {{$product->content}}<br>--}}
{{--                                            Count --- {{$product->count}}<br>--}}
{{--                                            Price --- {{$product->price}}<br>--}}
{{--                                            Category --- {{$product->category_id}}<br>--}}
{{--                                            Published --- {{$product->is_published}}<br>--}}
{{--                                            Images</p>--}}
{{--                                        <a href="{{route('products.show',$product->id)}}" class="btn btn-primary">Open</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        </div>--}}


                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>

                                <tr>
                                    <th><input type="checkbox" name="" id="selected_all_ids"></th>
                                    <th>ID</th>
                                    <th>Заголовок</th>
                                    <th>Описание</th>
                                    <th>Цена</th>
                                    <th>Категория</th>
                                    <th>Статус</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($products as $product)
                                    <tr id="$product_ids{{$product->id}}">
                                        <td><input type="checkbox" name="ids" class="checkbox_ids" id="" value="{{ $product->id }}"></td>
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->title}}</a></td>
                                        <td>{{$product->description}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>{{$product->category->title}}</td>
                                        <td>{{$product->statusTitle}}</td>
                                        <td>
                                            <div class="row">
                                                <a href="{{ route('products.show', ['product' => $product->id]) }}" class="btn btn-info">
                                                    <i class="bi bi-info-square"></i>
                                                </a>
                                                <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="btn btn-warning">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <form action="{{ route('products.destroy',['product'=>$product->id]) }}" method="post">
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
            <div class="d-flex">
                {!! $products->links() !!}
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
                        url:"{{route('selectedproducts.destroy')}}",
                        type:"DELETE",
                        data: {
                            ids: all_ids,
                            _token: "{{csrf_token()}}"
                        },
                        success:function (response){
                            $.each(all_ids, function(key,val){
                                $('#product_ids' + val).remove();
                            })
                        }

                    });
                    location.reload();
                });
            });

        </script>
    </section>
    <!-- /.content -->

@endsection


@extends('layouts.main')

@section('content')
    <style>
        img {
            float: left;
            width:  100px;
            height: 100px;
            object-fit: cover;
            margin-right: 10px;
        }
    </style>

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Продуст ID-{{$product->id}}</h1>
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
                        <div class="card-header d-flex p-3">
                            <div class="mr-2">
                                <a href="{{route('products.edit', ['product'=>$product->id])}}" class="btn btn-primary">Редактировать</a>
                            </div>
                            <form action="{{route('products.destroy',['product'=>$product->id])}}" method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" class="btn btn-danger" value="Удалить">
                            </form>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <tbody>
                                    <tr>
                                        <td>ID</td>
                                        <td>{{$product->id}} </td>
                                    </tr>
                                    <tr>
                                        <td>Наименование</td>
                                        <td>{{$product->title}}</td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td>{{$product->description}}</td>
                                    </tr>
                                    <tr>
                                        <td>Content</td>
                                        <td>{{$product->content}}</td>
                                    </tr>
                                    <tr>
                                        <td>Count</td>
                                        <td>{{$product->count}}</td>
                                    </tr>
                                    <tr>
                                        <td>Price</td>
                                        <td>{{$product->price}}</td>
                                    </tr>
                                    <tr>
                                        <td>Category</td>
                                        <td>{{$product->category_id}}</td>
                                    </tr>
                                    <tr>
                                        <td>Published</td>
                                        <td>{{$product->is_published}}</td>
                                    </tr>
                                    <tr>
                                        <td>Image</td>
                                        @if ($product->preview_image)
                                            <td><img width="22%" src="{{asset('storage/images/'.$product->preview_image)}}"></td>
                                        @else
                                            <td><img width="22%" src="{{asset('storage/Unknown_person.jpeg')}}"></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Images</td>
                                        <td>
                                            @if ($product->images)
                                                @php
                                                    $images=explode(',',$product->images);
                                                @endphp
                                                @foreach($images as $image)
                                                    <img src="{{asset('storage/products/'.$image)}}" alt="photo">
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

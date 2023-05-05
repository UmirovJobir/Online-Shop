@extends('layouts.main')

@section('content')
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
                            <a href="{{route('products.create')}}" class="btn btn-primary">Добавить</a>
                        </div>

                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Наименование</th>
                                    <th>Description</th>
                                    <th>Content</th>
                                    <th>Count</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                    <th>Published</th>
                                    <th>Images</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td><a href="{{route('products.show',$product->id)}}">{{$product->title}}</a></td>
                                        <td>{{$product->description}}</td>
                                        <td>{{$product->content}}</td>
                                        <td>{{$product->count}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>{{$product->category_id}}</td>
                                        <td>{{$product->is_published}}</td>
                                        <td>
                                            @if ($product->images)
                                                @php
                                                    $images=explode(',',$product->images);
                                                @endphp
                                                <img src="{{asset('storage/products/'.$images[0])}}" width="100" alt="photo">
{{--                                                @foreach($images as $image)--}}
{{--                                                    <img src="{{asset('storage/products/'.$image)}}" width="100" alt="photo">--}}
{{--                                                @endforeach--}}
                                            @endif
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
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

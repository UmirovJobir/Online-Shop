@extends('layouts.main')

@section('content')
    <style>
        .preview_image {
            float: left;
            width:  100%;
            height: 100%;
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

{{--    <section class="content">--}}
{{--        <div class="container-fluid">--}}
{{--            <div class="card mb-3" style="max-width: 540px;">--}}
{{--                <div class="row no-gutters">--}}
{{--                    <div class="col-md-4">--}}
{{--                        @if ($product->preview_image)--}}
{{--                            <img class="preview_image" src="{{asset('storage/'.$product->preview_image)}}">--}}
{{--                        @else--}}
{{--                            <img class="preview_image" src="{{asset('storage/images/unknown.jpg')}}">--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                    <div class="col-md-8">--}}
{{--                        <div class="card-body">--}}


{{--                            <h4><strong>{{$product->title}}</strong></h4>--}}
{{--                            <p class="card-text">{{$product->description}}</p>--}}
{{--                            <p><h5>{{$product->price}}</h5></p>--}}
{{--                            @foreach($colors as $color)--}}
{{--                                <span style="width: 16px; height: 16px; white-space: pre-line; border-radius: 20px; color:{{'#'.$color->title}}; background: {{'#'.$color->title}}">00</span>--}}
{{--                            @endforeach--}}
{{--                            <br>--}}
{{--                            @foreach($tegs as $teg)--}}
{{--                                <span style="white-space: pre-line; color:blue;">#{{$teg->title}}</span>--}}
{{--                            @endforeach--}}
{{--                            <p class="card-text"><small class="text-muted">{{$product->created_at}}</small></p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

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
                                        <td>{{$category}}</td>
                                    </tr>
                                    <tr>
                                        <td>Published</td>
                                        <td>{{$product->is_published}}</td>
                                    </tr>
                                    <tr>
                                        <td>Image</td>
                                        @if ($product->preview_image)
                                            <td><img width="22%" src="{{asset('storage/'.$product->preview_image)}}"></td>
                                        @else
                                            <td><img width="22%" src="{{asset('storage/images/unknown.jpg')}}"></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Images</td>
                                        <td>
                                            @foreach($images as $image)
                                                <img src="{{asset('storage/'.$image->file_path)}}" alt="photo">
                                            @endforeach
                                        </td>
{{--                                        <td>--}}
{{--                                            @if ($product->images)--}}
{{--                                                @php--}}
{{--                                                    $images=explode(',',$product->images);--}}
{{--                                                @endphp--}}
{{--                                                @foreach($images as $image)--}}
{{--                                                    <img src="{{asset('storage/products/'.$image)}}" alt="photo">--}}
{{--                                                @endforeach--}}
{{--                                            @endif--}}
{{--                                        </td>--}}
                                    </tr>
                                    <tr>
                                        <td>Tegs</td>
                                        <td>
                                            @foreach($tegs as $teg)
                                                <p style="color:blue;">#{{$teg->title}}</p>
                                            @endforeach
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Colors</td>
                                        <td>
                                            @foreach($colors as $color)
                                                <div style="width: 16px; height: 16px; border-radius: 20px; background: {{'#'.$color->title}}"></div>
                                            @endforeach
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

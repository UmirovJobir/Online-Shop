@extends('layouts.main')

@section('content')
    <style>
        * {
            box-sizing: border-box;
        }

        img {
            float: left;
            width:  200px;
            height: 200px;
            object-fit: cover;
            margin-right: 10px;
        }

        .column {
            float: left;
            width: 33.33%;
            padding: 5px;
        }

    </style>

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать продукт ID-{{$product->id}}</h1>
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
                <form action="{{route('products.update', ['product'=>$product->id])}}" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('patch')
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" value="{{$product->title}}" class="form-control" placeholder="Наименование">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <input type="text" name="description" value="{{$product->description}}" class="form-control" placeholder="Описание">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                            <input type="text" name="price" value="{{$product->price}}" class="form-control" placeholder="Цена">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select name="status" class="form-control select2" style="width: 100%;">
                                <option value="1" {{ $product->status == '1' ? 'selected' : '' }}>Faol</option>
                                <option value="2" {{ $product->status == '2' ? 'selected' : '' }}>Faol emas</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <select name="category_id" class="form-control select2" style="width: 100%;">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}"
                                            @if ($category->id == old('myselect', $product->category_id))
                                                selected="selected"
                                        @endif
                                    >{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tags</label>
                        <div class="col-sm-10">
                            <select id="tegs" name="tegs[]" class="tegs" multiple data-placeholder="Выберите тег" style="width: 100%;">
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}"
                                            @if ($product->tags->pluck('id')->contains($tag->id))
                                                selected="selected"
                                        @endif
                                    >{{$tag->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <input type="submit" class="btn btn-primary" value="Добавить">
                    </div>
                </form>
        </div><!-- /.container-fluid -->
    </section>


    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Images of product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Главная</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">

                <form action="{{route('productimage.store', ['product'=>$product->id])}}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Add images</label>
                        <div class="col-sm-10">
                            <input name="product_images[]" type="file" class="custom-file-input" multiple="multiple" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Выберите файлы</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <input type="submit" class="btn btn-primary" value="Добавить">
                    </div>
                    <span style="color:red">{{$errors->first('product_images')}}</span>
                </form>

                <form action="{{route('productimage.update', ['product'=>$product->id])}}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Images</label>
                        <div class="col-sm-10">
                            @foreach($product->productImages as $image)
                                <div class="column">
                                    <img src="{{asset('storage/'.$image->file_path)}}" alt="photo">
                                    <button onclick="return confirm('Вы уверены, что хотите удалить?')" class="btn btn-primary" name="product_image" type="submit" value="{{$image->file_path}}">Удалить</button>
                                </div>
                            @endforeach
                        </div>
                        <span style="color:red">{{$errors->first('product_image')}}</span>
                    </div>
                </form>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection

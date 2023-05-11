@extends('layouts.main')

@section('content')
    <style>
        img {
            float: left;
            width:  200px;
            height: 200px;
            object-fit: cover;
            margin-right: 10px;
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
            <div class="row">
                <form action="{{route('products.update', ['product'=>$product->id])}}" method="post">
                    @csrf
                    @method('patch')

                    <div class="form-group">
                        <label class="flex flex-col">
                            <span class="">Title: </span>
                            <input type="text" name="title" value="{{$product->title}}" class="form-control" placeholder="Наименование">
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="flex flex-col block">
                            <span class="">Description: </span>
                            <input type="text" name="description" value="{{$product->description}}" class="form-control" placeholder="Описание">
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="flex flex-col block">
                            <span class="">Title: </span>
                            <input type="text" name="price" value="{{$product->price}}" class="form-control" placeholder="Цена">
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="flex flex-col block">
                            <span class="">Select Status: </span>
                            <select name="status" class="form-control select2" style="width: 100%;">
                                <option value="1" {{ $product->status == '1' ? 'selected' : '' }}>Faol</option>
                                <option value="2" {{ $product->status == '2' ? 'selected' : '' }}>Faol emas</option>
                            </select>
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="flex flex-col block">
                            <span class="">Category: </span>
                            <select name="category_id" class="form-control select2" style="width: 100%;">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}"
                                            @if ($category->id == old('myselect', $product->category_id))
                                                selected="selected"
                                        @endif
                                    >{{$category->title}}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="flex flex-col block">
                            <span class="">Tags: </span>
                            <select id="tegs" name="tegs[]" class="tegs" multiple data-placeholder="Выберите тег" style="width: 100%;">
                                    @foreach($tags as $tag)
                                        <option value="{{$tag->id}}"
                                            @if ($product->tags->pluck('id')->contains($tag->id))
                                                selected="selected"
                                            @endif
                                        >{{$tag->title}}</option>
                                    @endforeach
                            </select>
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="flex flex-col block">
                            <span class="">Images: </span>
                            <div class="container">
                                    @foreach($product->productImages as $image)
                                        <img src="{{asset('storage/'.$image->file_path)}}" alt="photo">
                                    @endforeach
                            </div>
                        </label>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="product_images[]" type="file" class="custom-file-input" multiple="multiple" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Выберите файлы</label>
                            </div>
                            <span style="color:red">{{$errors->first('product_images')}}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Добавить">
                    </div>
                </form>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection

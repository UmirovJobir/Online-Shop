@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавить продукт</h1>
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
{{--    <section class="content">--}}
{{--        <div class="container-fluid">--}}
{{--            <!-- Small boxes (Stat box) -->--}}
{{--            <div class="row">--}}
    <section class="content">
        <div class="container-fluid">
                <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
{{--                    <div class="form-group">--}}
{{--                        <input type="text" name="title" class="form-control" placeholder="Наименование">--}}
{{--                        <span style="color:red">{{$errors->first('title')}}</span>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <input type="text" name="description" class="form-control" placeholder="Описание">--}}
{{--                        <span style="color:red">{{$errors->first('description')}}</span>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <input type="text" name="price" class="form-control" placeholder="Цена">--}}
{{--                        <span style="color:red">{{$errors->first('price')}}</span>--}}
{{--                    </div>--}}

{{--                    <!-- Images -->--}}
{{--                    <div class="form-group">--}}
{{--                        <div class="input-group">--}}
{{--                            <div class="custom-file">--}}
{{--                                <input name="product_images[]" type="file" class="custom-file-input" multiple="multiple" id="exampleInputFile">--}}
{{--                                <label class="custom-file-label" for="exampleInputFile">Выберите файлы</label>--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="form-group">--}}
{{--                        <select name="category_id" class="form-control select2" style="width: 100%;">--}}
{{--                            @foreach($categories as $category)--}}
{{--                                <option value="{{$category->id}}">{{$category->title}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}

{{--                    <div class="form-group">--}}
{{--                        <select name="tags[]" class="form-control select2" multiple="multiple"  data-placeholder="Выберите тег" style="width: 100%;">--}}
{{--                            @foreach($tags as $tag)--}}
{{--                                <option value="{{$tag->id}}">{{$tag->title}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}

{{--                    <div class="form-group">--}}
{{--                        <select name="colors[]" class="colors" multiple="multiple" data-placeholder="Выберите цвет" style="width: 100%;">--}}
{{--                            @foreach($colors as $color)--}}
{{--                                <option value="{{$color->id}}">{{$color->title}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">User</label>
                        <div class="col-sm-10">
                            <select name="user_id" class="form-control select2" style="width: 100%;">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control" placeholder="Наименование">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <input type="text" name="description" class="form-control" placeholder="Описание">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                            <input type="number" name="price" class="form-control" placeholder="Цена">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <select name="category_id" class="form-control select2" style="width: 100%;">
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Tags</label>
                        <div class="col-sm-10">
                            <select id="tags" name="tags[]" class="tags" multiple data-placeholder="Выберите тег" style="width: 100%;">
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Colors</label>
                        <div class="col-sm-10">
                            <select id="colors" name="colors[]" class="colors" multiple data-placeholder="Выберите тег" style="width: 100%;">
                                @foreach($colors as $color)
                                    <option value="{{$color->id}}">{{$color->title}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Add images</label>
                        <div class="col-sm-10">
                            <input name="product_images[]" type="file" class="custom-file-input" multiple="multiple" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Выберите файлы</label>
                        </div>
                        <span style="color:red">{{$errors->first('product_images')}}</span>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Добавить">
                    </div>
                </form>
{{--                </div>--}}
{{--                <!-- /.row -->--}}
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    @endsection

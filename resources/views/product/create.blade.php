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
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="Наименование">
                        <span style="color:red">{{$errors->first('title')}}</span>
                    </div>
                    <div class="form-group">
                        <input type="text" name="description" class="form-control" placeholder="Описание">
                        <span style="color:red">{{$errors->first('description')}}</span>
                    </div>
                    <div class="form-group">
                        <textarea name="content" class="form-control" cols="30" rows="10" placeholder="Контент"></textarea>
                        <span style="color:red">{{$errors->first('content')}}</span>
                    </div>
                    <div class="form-group">
                        <input type="text" name="price" class="form-control" placeholder="Цена">
                        <span style="color:red">{{$errors->first('price')}}</span>
                    </div>
                    <div class="form-group">
                        <input type="text" name="count" class="form-control" placeholder="Количество">
                        <span style="color:red">{{$errors->first('count')}}</span>
                    </div>

                    <!-- Image -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="preview_image" type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                                <span style="color:red">{{$errors->first('preview_image')}}</span>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Загрузить</span>
                            </div>
                        </div>
                    </div>

                    <!-- Images -->
                    <div class="form-group">
                        <div class="input-group">
                            <div class="custom-file">
                                <input name="product_images[]" type="file" class="custom-file-input" multiple="multiple" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Выберите файлы</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Загрузить</span>
                            </div>
                            <span style="color:red">{{$errors->first('product_images')}}</span>
                        </div>
                    </div>

{{--                    --}}
{{--                    <div class="form-group">--}}
{{--                        <div class="input-group">--}}
{{--                            <div class="custom-file">--}}
{{--                                <input id="images" type="file" class="custom-file-input" multiple="multiple" name="images[]">--}}
{{--                                <span style="color:red">{{$errors->first('images')}}</span><br>--}}
{{--                                <label class="custom-file-label" for="exampleInputFile">Выберите файлы</label>--}}
{{--                            </div>--}}
{{--                            <div class="input-group-append">--}}
{{--                                <span class="input-group-text">Загрузить</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="form-group">
                        <select name="category_id" class="form-control select2" style="width: 100%;">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                            <select name="tegs[]" class="tegs" multiple="multiple" data-placeholder="Выберите тег" style="width: 100%;">
                            @foreach($tegs as $teg)
                                <option value="{{$teg->id}}">{{$teg->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="colors[]" class="colors" multiple="multiple" data-placeholder="Выберите цвет" style="width: 100%;">
                            @foreach($colors as $color)
                                <option value="{{$color->id}}">{{$color->title}}</option>
                            @endforeach
                        </select>
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

@extends('layouts.main')

@section('content')
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
                        <input type="text" name="title" value="{{$product->title}}" class="form-control" placeholder="Наименование">
                    </div>
                    <div class="form-group">
                        <input type="text" name="description" value="{{$product->description}}" class="form-control" placeholder="Описание">
                    </div>
                    <div class="form-group">
                        <textarea name="content" class="form-control" cols="30" rows="10" placeholder="Контент">{{$product->content}}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" name="price" value="{{$product->price}}" class="form-control" placeholder="Цена">
                    </div>
                    <div class="form-group">
                        <input type="text" name="count" value="{{$product->count}}" class="form-control" placeholder="Количество">
                    </div>

                    <div class="form-group">
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

                    <div class="form-group">
                            <select id="tegs" name="tegs[]" class="tegs" multiple data-placeholder="Выберите тег" style="width: 100%;">
                                    @foreach($tegs as $teg)
                                        <option value="{{$teg->id}}"
                                            @if ($product->tegs->pluck('id')->contains($teg->id))
                                                selected="selected"
                                            @endif
                                        >{{$teg->title}}</option>
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

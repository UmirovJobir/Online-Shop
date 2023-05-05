@extends('layouts.main')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    @foreach($tegs as $teg)
                        <div>
                            {{$teg}}<br>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

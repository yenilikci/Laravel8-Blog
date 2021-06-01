@extends('back.layouts.master')
@section('title','Silinen Makaleler')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><strong>{{$articles->count()}} adet makale bulundu</strong>
                <a href="{{route('admin.makaleler.index')}}" class="btn btn-warning btn-sm float-right p-2"> Yayındaki
                    Makaleler</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Fotoğraf</th>
                        <th>Makale Başlığı</th>
                        <th>Kategori</th>
                        <th>Tıklanma</th>
                        <th>Oluşturma</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($articles as $article)
                        <tr>
                            <td>
                                <img src="{{$article->image}}" width="150" alt="">
                            </td>
                            <td>{{$article->title}}</td>
                            <td>{{$article->getCategory->name}}</td>
                            <td>{{$article->hit}}</td>
                            <td>{{$article->created_at->diffForHumans()}}</td>
                            <td>
                                <a href="{{route('admin.recover.article',$article->id)}}" title="Geri Yükle"
                                   class="btn btn-sm d-block m-1 btn-primary"><i class="fa fa-recycle"></i> </a>
                                <a href="{{route('admin.hard.delete.article',$article->id)}}" title="Sil"
                                   class="btn btn-block d-block m-1 btn-danger"><i
                                        class="fa fa-times"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function () {
            $('.switch').change(function () {
                var id = $(this).attr('data');
                var status = $(this).prop('checked');
                $.get("{{route('admin.switch',)}}", {id: id, status: status}, function (data, status) {
                    console.log(data);
                });
            })
        })
    </script>
@endsection

@extends('back.layouts.master')
@section('title','Tüm makaleler')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><strong>{{$pages->count()}} adet sayfa bulundu</strong>
                    Sayfalar</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Fotoğraf</th>
                        <th>Sayfa Başlığı</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($pages as $page)
                        <tr>
                            <td>
                                <img src="{{$page->image}}" width="150" alt="">
                            </td>
                            <td>{{$page->title}}</td>
                            <td>
                                <input class="switch" data="{{$page->id}}" type="checkbox" data-on="Aktif"
                                       data-off="Pasif" data-offstyle="danger"
                                       data-onstyle="success" @if($page->status == 1) checked
                                       @endif data-toggle="toggle">
                            </td>
                            <td>
                                <a target="_blank" href="{{route('page',$page->slug)}}" title="Görüntüle" class="btn btn-sm d-block m-1 btn-success"><i
                                        class="fa fa-eye"></i> </a>
                                <a href="{{route('admin.makaleler.edit',$page->id)}}" title="Düzenle"
                                   class="btn btn-sm d-block m-1 btn-warning"><i class="fa fa-pen"></i> </a>
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
                $.get("{{route('admin.page.switch')}}", {id: id, status: status}, function (data, status) {
                    console.log(data);
                });
            })
        })
    </script>
@endsection

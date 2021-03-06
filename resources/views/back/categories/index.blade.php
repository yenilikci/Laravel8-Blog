@extends('back.layouts.master')
@section('title', 'Tüm kategoriler')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Yeni Kategori Oluştur
                    </h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('admin.category.create') }}">
                        @csrf
                        <div class="form-group">
                            <label>Kategori Adı</label>
                            <input type="text" name="category" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary float-right">Ekle</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        @yield('title')
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Kategori Adı</th>
                                    <th>Makale Sayısı</th>
                                    <th>Durum</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->articleCount() }}</td>
                                        <td>
                                            <input class="switch" data="{{ $category->id }}" type="checkbox"
                                                data-on="Aktif" data-off="Pasif" data-offstyle="danger"
                                                data-onstyle="success" @if ($category->status == 1) checked @endif data-toggle="toggle">
                                        </td>
                                        <td>
                                            <a category-id="{{ $category->id }}" class="edit-click btn btn-sm btn-primary"
                                                title="Kategoriyi Düzenle"><i class="fa fa-edit"></i></a>
                                            <a category-id="{{ $category->id }}"
                                                category-count="{{ $category->articleCount() }}"
                                                category-name="{{ $category->name }}"
                                                class="remove-click btn btn-sm btn-danger" title="Kategoriyi Sil"><i
                                                    class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- Edit Modal -->
<div class="modal" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Kategoriyi Düzenle</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{ route('admin.category.update') }}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="category-id">
                    <!--Kategori Adı-->
                    <div class="form-group">
                        <label>Kategori Adı:</label>
                        <input id="category" type="text" class="form-control" name="category">
                    </div>
                    <!--Kategori Slug-->
                    <div class="form-group">
                        <label>Kategori Slug:</label>
                        <input id="slug" type="text" class="form-control" name="slug">
                    </div>
                    <button type="submit" class="btn btn-success">Kaydet</button>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
            </div>

        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Kategoriyi Sil</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div id="articleAlert" class="alert alert-danger"></div>
                <form method="post" action="{{ route('admin.category.delete') }}">
                    @csrf
                    <input type="hidden" name="id" id="deleteId">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                    <button id="deleteButton" type="submit" class="btn btn-warning">Sil</button>
                </form>
            </div>

        </div>
    </div>
</div>

@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function() {

            //düzenlenecek kategori bilgisi ajax ile alındı ve modal açıldı
            $('.edit-click').click(function() {
                var id = $(this)[0].getAttribute('category-id');
                $.ajax({
                    type: 'GET',
                    url: '{{ route('admin.category.getdata') }}',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        //geri dönen veri içerisindeki name alanı
                        $('#category').val(data.name)
                        //geri dönen veri içerisindeki slug alanı
                        $('#slug').val(data.slug);
                        $('#category-id').val(data.id);
                        $('#editModal').modal()
                    }
                })
            });

            //silme işlemi
            $('.remove-click').click(function() {
                //kategori id
                var id = $(this)[0].getAttribute('category-id');
                //o kategoriye ait kaç adet makale var
                var count = $(this)[0].getAttribute('category-count');
                //kategori ismini almak
                var categoryName = $(this)[0].getAttribute('category-name');

                $('#articleAlert').html('');


                if (id == 1) {
                    $('#articleAlert').html(
                        categoryName +
                        ' kategorisi ana kategoridir. Silinen diğer kategorilere ait makaleler bu kategori altına eklenmektedir.'
                    );
                    $('.btn-warning').hide();
                    $('#deleteModal').modal();
                    return;
                }

                $('.btn-warning').show();

                $('#deleteId').val(id);

                //o kategoriye ait makale var
                if (count > 0) {
                    $('#articleAlert').html('Bu kategoriye ait ' + count +
                        ' makale bulunmaktadır. Silmek istediğinize emin misiniz?');
                } else if (count == 0 && id != 1) {
                    $('#articleAlert').html(
                        'Bu kategoride hiç makale bulunmamaktadır. Silmek istediğinize emin misiniz? ')
                }
                $('#deleteModal').modal();
            });

            $('.switch').change(function() {
                var id = $(this).attr('data');
                var status = $(this).prop('checked');
                $.get("{{ route('admin.category.switch') }}", {
                    id: id,
                    status: status
                }, function(data, status) {
                    console.log(data);
                });
            })
        })

    </script>
@endsection

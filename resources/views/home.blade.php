<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;1,400&display=swap"
          rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css"/>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <style>
        body {
            background: #F9FAFB;
        }
        h1, h2, h3, h4, h5, h6, p, a, span, button, input, select, option, tr, td, th, label {
            font-family: 'Poppins';
        }
        .table th {
            font-weight: 500;
        }
        .container {
            max-width: 1218px;
        }
        .table td {
            font-size: .9em;
            padding-top: .1rem;
            padding-bottom: .1rem;
        }
        .btn-sm {
            font-size: .9rem;
            padding: .1rem .2rem;
        }

    </style>
    <title>Test Fullstack DOT</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg py-3 navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('index')}}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('index')}}">Data Penduduk</a>
                    </li>
                </ul>
            </div>
            <div class="dropdown end-dropdown">
                <button class="btn dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    {{Auth::user()->name}}
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="{{route('auth.logout')}}">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row mt-3">
            <p class="mb-2">>> Dashboard / <strong>Data Kependudukan</strong></p>
            <div class="col p-3 bg-white rounded">
                <div class="d-flex justify-content-between align-content-center mb-2">
                    <h5>Data Penduduk</h5>
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-post">+ Tambah</button>
                </div>
                <table class="table table-bordered" id="mytable">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>No. KK</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Pekerjaan</th>
                            <th>Status Kawin</th>
                            <th>Nama Ayah</th>
                            <th>Nama Ibu</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="content">
                    @php($no=0)
                    @foreach($anggota as $row)
                        <tr>
                            <td>{{++$no}}</td>
                            <td>{{$row->kk->no_kk}}</td>
                            <td>{{$row->nik}}</td>
                            <td>{{$row->nama}}</td>
                            <td>{{$row->jenkel}}</td>
                            <td>{{$row->tmp_lahir}}</td>
                            <td>{{$row->tgl_lahir}}</td>
                            <td>{{$row->pekerjaan->nm_pekerjaan}}</td>
                            <td>{{$row->status_kawin}}</td>
                            <td>{{$row->nm_ayah}}</td>
                            <td>{{$row->nm_ibu}}</td>
                            <td>
                                <button class="btn btn-sm btn-info mt-1 btn-edit" data-id="{{ $row->id_anggota }}">Ubah</button>
                                <button class="btn btn-sm btn-danger mt-1 btn-delete" data-id="{{ $row->id_anggota }}">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-post" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Tambah Data</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="formSave">
                    <div class="modal-body">
                        <div class="alert alert-danger form-alert" style="display: none" role="alert">
                            <ul class="mb-0"></ul>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="no_kk" class="form-label">No. KK</label>
                                <select id="no_kk" class="form-select" name="no_kk">
                                    @foreach ($kk as $row)
                                        <option value="{{ $row->id_kk }}">{{ $row->no_kk }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="nik" class="form-label">NIK</label>
                                <input type="text" class="form-control" id="nik" name="nik"
                                       placeholder="NIK">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                       placeholder="Nama">
                            </div>
                            <div class="col">
                                <label for="jenkel" class="form-label">Jenis Kelamin</label>
                                <select id="jenkel" class="form-select" name="jenkel">
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col">
                                <label for="tmp_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tmp_lahir" name="tmp_lahir"
                                       placeholder="Tempat Lahir">
                            </div>
                            <div class="col">
                                <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                       placeholder="Tanggal Lahir">
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col">
                                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                <select id="pekerjaan" class="form-select" name="pekerjaan">
                                    @foreach ($pekerjaan as $row)
                                        <option value="{{ $row->id_pkj }}">{{ $row->nm_pekerjaan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="status_kawin" class="form-label">Status Perkawinan</label>
                                <select id="status_kawin" class="form-select" name="status_kawin">
                                    <option value="kawin">Kawin</option>
                                    <option value="belum kawin">Belum Kawin</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col">
                                <label for="nm_ayah" class="form-label">Nama Ayah</label>
                                <input type="text" class="form-control" id="nm_ayah" name="nm_ayah"
                                       placeholder="Nama Ayah">
                            </div>
                            <div class="col">
                                <label for="nm_ibu" class="form-label">Nama Ibu</label>
                                <input type="text" class="form-control" id="nm_ibu" name="nm_ibu"
                                       placeholder="Nama Ibu">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header d-flex justify-content-between">
                <strong>Notifikasi</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">

            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>

    <script>
        $("#mytable").DataTable();

        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })
        $('#modal-post').on('hide.bs.modal', function(e) {
            $('#modal-post form').attr('id', 'formSave');
            $('#modal-post .modal-title').text('Tambah Anggota')
            $('#formSave').trigger("reset");
            $('#formUpdate').trigger("reset");
        })
        //save
        $('body').on('submit', '#formSave', function(e) {
            e.preventDefault()
            $.ajax({
                url: "{{ route('anggota.s') }}",
                type: "POST",
                dataType: 'json',
                data: $(this).serialize(),
                success: function(res) {
                    $('#modal-post').modal('hide');
                    showData();
                    $('#liveToast').toast('show').delay(2000).toast('hide').find('.toast-body').text(res.message);
                },
                error: function( json )
                {
                    if(json.status === 422) {
                        err = "";
                        var errors = json.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            err += `<li>${value[0]}</li>`;
                        });
                        $(".form-alert").slideDown().delay(2000).slideUp().find('ul').html(err);
                    }
                }
            });
        });
        //delete
        $('body').on('click', '.btn-delete', function(e) {
            e.preventDefault();
            var url = "{{ route('anggota.d', ':id') }}";
            url = url.replace(':id', $(this).data('id'));
            if (confirm("Data akan menghapus data?")) {
                $.ajax({
                    url: url,
                    type: "DELETE",
                    dataType: 'json',
                    success: function(res) {
                        showData();
                        $('#liveToast').toast('show').delay(2000).toast('hide').find('.toast-body').text(res.message);
                    },
                    error: function (err, msg) {
                        console.log(err)
                    }
                });
            }
        });
        //edit
        $('body').on('click', '.btn-edit', function(e) {
            var _id = $(this).data('id')
            $('#modal-post').modal('show').find('form').attr('id', 'formUpdate');
            $('#modal-post .modal-title').text('Edit Anggota')
            var url = "{{ route('anggota.g', ':id') }}";
            url = url.replace(':id', _id);
            $.ajax({
                url: url,
                type: "GET",
                dataType: 'json',
                success: function(res) {
                    $("#formUpdate").attr('action', res.id_anggota);
                    $("#no_kk").val(res.kk.id_kk);
                    $("#nik").val(res.nik);
                    $("#nama").val(res.nama);
                    $("#jenkel").val(res.jenkel);
                    $("#tmp_lahir").val(res.tmp_lahir);
                    $("#tgl_lahir").val(res.tgl_lahir);
                    $("#pekerjaan").val(res.pekerjaan.id_pkj);
                    $("#status_kawin").val(res.status_kawin);
                    $("#nm_ayah").val(res.nm_ayah);
                    $("#nm_ibu").val(res.nm_ibu);
                },
            });
        })
        //update
        $('body').on('submit', '#formUpdate', function(e) {
            e.preventDefault()
            var url = "{{ route('anggota.u', ':id') }}";
            url = url.replace(':id', $(this).attr('action'));
            $.ajax({
                url: url,
                type: "PUT",
                dataType: 'json',
                data: $(this).serialize(),
                success: function(res) {
                    $('#modal-post').modal('hide');
                    showData();
                    $('#liveToast').toast('show').delay(2000).toast('hide').find('.toast-body').text(res.message);
                },
                error: function( json )
                {
                    if(json.status === 422) {
                        err = "";
                        var errors = json.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            err += `<li>${value[0]}</li>`;
                        });
                        $(".form-alert").slideDown().delay(2000).slideUp().find('ul').html(err);
                    }
                }
            });
        });

        function showData() {
            $.ajax({
                url: "{{ route('anggota.g') }}",
                type: "GET",
                dataType: 'json',
                success: function(res) {
                    dom = '';
                    $.each(res, function(index, row) {
                        dom += `<tr>
                            <td>${++index}</td>
                            <td>${row.kk.no_kk}</td>
                            <td>${row.nik}</td>
                            <td>${row.nama}</td>
                            <td>${row.jenkel}</td>
                            <td>${row.tmp_lahir}</td>
                            <td>${row.tgl_lahir}</td>
                            <td>${row.pekerjaan.nm_pekerjaan}</td>
                            <td>${row.status_kawin}</td>
                            <td>${row.nm_ayah}</td>
                            <td>${row.nm_ibu}</td>
                            <td>
                                <button class="btn btn-sm btn-info mt-1 btn-edit" data-id="${row.id_anggota}">Ubah</button>
                                <button class="btn btn-sm btn-danger mt-1 btn-delete" data-id="${row.id_anggota}">Hapus</button>
                            </td>
                        </tr>`;
                    })
                    $('#content').html(dom);
                    $("#mytable").DataTable();
                },
            });
        }


    </script>
</body>
</html>

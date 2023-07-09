@extends('layouts.default_admin')

@section('content')
<main>
    <!-- <script type="text/javascript">
        var app = new Vue({
            el : '#details',
            data :{
                barang : null
            }
        });
    </script> -->
    <div class="container-fluid px-4">
        <h2 class="mt-4">User</h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="admin/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">User</li>
        </ol>
        <!-- <div class="card mb-4">
                            <div class="card-body">
                                DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                                <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                                .
                            </div>
                        </div> -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabel User
            </div>
            <div class="card-body">
                <!-- <div style="overflow-x: auto;" style="display: flex;"> -->
                <table id="datatablesSimple">
                    <div class="datatable-top d-flex justify-content-end">
                    <a href="{{ route('admin.user.create') }}" class="btn btn-success btn-kategori">Tambah User</a>
                    </div>
                    <thead>
                        <tr>
                            <th>No</th>
                            <!-- <th class="col-sm-4">Gambar</th> -->
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <!-- <th>Gambar</th> -->
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($users as $r)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $r->name }}</td>
                            <td>{{ $r->email }}</td>
                            <td>{{ $r->no_hp }}</td>
                            <td>{{ $r->alamat }}</td>
                            <td>
                                <a href="{{ route('admin.user.edit', ['id' => $r->id]) }}" class="btn btn-primary">Edit</a>
                            </td>
                            <td>
                                <a href="{{ route('admin.user.hapus', ['id' => $r->id]) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- </div> -->
            </div>
        </div>
    </div>
</main>
@stop
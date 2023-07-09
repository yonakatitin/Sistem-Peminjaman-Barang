@extends('layouts.default_admin')

@section('content')
<main>
    <div class="container-fluid px-4">
        <h2 class="mt-4">Unit Peminjaman</h2>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="unit/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active">Unit Peminjaman</li>
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
                Tabel Unit Peminjaman
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <div class="datatable-top d-flex justify-content-end">
                        <a href="{{ route('admin.unit.create') }}" class="btn btn-success btn-kategori">Tambah Unit</a>
                    </div>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Lokasi</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Lokasi</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach($unit as $r)
                        <tr>
                            <td><?= $i ?></td>
                            <td>{{ $r->nama }}</td>
                            <td>{{ $r->lokasi }}</td>
                            <td>
                                <a href="{{ route('admin.unit.edit', ['id' => $r->id]) }}" class="btn btn-primary">Edit</a>
                            </td>
                            <td>
                                <a href="{{ route('admin.unit.hapus', ['id' => $r->id]) }}" class="btn btn-danger">Delete</a>
                            </td>
                            <?php $i++; ?>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@stop
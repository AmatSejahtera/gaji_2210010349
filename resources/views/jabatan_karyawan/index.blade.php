@extends('adminlte::page')

@section('title', 'Data Jabatan Karyawan')

@section('content_header')
    <h1 class="m-0 text-dark">Data Jabatan Karyawan</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong>Table Data Jabatan Karyawan</strong></h2>
                    <a href="{{ route('jabatan-karyawan.create') }}" class="btn btn-primary btn-md float-right"> Tambah Jabatan Karyawan</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="jabatanKaryawanTable" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>NAMA JABATAN</th>
                                    <th>NAMA KARYAWAN</th>
                                    <th>TANGGAL MULAI</th>
                                    <th class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($jabatanKaryawan as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->jabatan->nama_jabatan ?? '-' }}</td>
                                        <td>{{ $item->karyawan->nama_lengkap ?? '-' }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->tanggal_mulai)) }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('jabatan-karyawan.destroy', $item->id) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <a href="{{ route('jabatan-karyawan.edit', $item->id) }}"
                                                    class="btn btn-md btn-warning">EDIT</a>
                                                <button type="submit" class="btn btn-md btn-danger">HAPUS</button>
                                            </form>
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
@stop

@section('adminlte_js')
    <script>
        $(document).ready(function() {
            $('#jabatanKaryawanTable').DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "pageLength": 10,
                "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
                "order": [[0, 'asc']],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json"
                },
                "columnDefs": [
                    {
                        "orderable": false,
                        "targets": 4
                    }
                ]
            });
        });
    </script>
@stop

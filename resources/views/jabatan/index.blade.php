@extends('adminlte::page')

@section('title', 'Data Jabatan')

@section('content_header')
    <h1 class="m-0 text-dark">Data Jabatan</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong>Table Data Jabatan</strong></h2>
                    <a href="{{ route('jabatan.create') }}" class="btn btn-primary btn-md float-right"> Tambah Jabatan</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="jabatanTable" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>NAMA JABATAN</th>
                                    <th>GAJI POKOK</th>
                                    <th>TUNJANGAN</th>
                                    <th>UANG MAKAN PERHARI</th>
                                    <th class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($jabatan as $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->nama_jabatan }}</td>
                                        <td>Rp {{ number_format($item->gapok_jabatan, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($item->tunjangan_jabatan, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($item->uang_makan_perhari, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('jabatan.destroy', $item->id) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <a href="{{ route('jabatan.edit', $item->id) }}"
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
            $('#jabatanTable').DataTable({
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
                        "targets": 5
                    }
                ]
            });
        });
    </script>
@stop

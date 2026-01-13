@extends('adminlte::page')

@section('title', 'Data Pengguna')

@section('content_header')
    <h1 class="m-0 text-dark">Data Pengguna</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><strong>Table Data Pengguna</strong></h2>
                    <a href="{{ route('pengguna.create') }}" class="btn btn-primary btn-md float-right"> Tambah Pengguna</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="usersTable" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>NO.</th>
                                    <th>NAMA LENGKAP</th>
                                    <th>EMAIL</th>
                                    <th>LEVEL</th>
                                    <th class="text-center">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->level }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('pengguna.destroy', $user->id) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <a href="{{ route('pengguna.edit', $user->id) }}"
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
            $('#usersTable').DataTable({
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

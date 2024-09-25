@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#tambahkriteria" class="d-block card-header py-3" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Kriteria</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="tambahkriteria">
                    <div class="card-body">
                        <form action="{{ route('kriteria.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="nama">Nama Kriteria</label>
                                <input type="text" class="form-control @error('nama_kriteria') is-invalid @enderror" name="nama_kriteria">

                                @error('nama_kriteria')
                                    <div class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button class="btn btn-sm btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#listkriteria" class="d-block card-header py-3" data-toggle="collapse"
                    role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">List Kriteria</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="listkriteria">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="DataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kriteria</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($kriteria as $row)
                                        <tr>
                                            <td>{{  $no++ }}</td>
                                            <td>{{ $row->nama_kriteria }}</td>
                                            <td>
                                                <a href="{{ route('kriteria.edit', $row->id )}}" class="btn btn-sm btn-circle btn-warning" ><i class="fa fa-edit"></i></a>
                                                <form action="{{ route('kriteria.destroy', $row->id )}}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-circle btn-danger hapus">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
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
    </div>
@stop

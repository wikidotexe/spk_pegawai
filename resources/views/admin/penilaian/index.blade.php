@extends('layouts.app')
@section('title', 'SPK Pegawai | Kriteria')
@section('content')
    <div class="card shadow mb-4">
        <!-- Card Header - Accordion -->
        <a href="#tambahpenialain" class="d-block card-header py-3" data-toggle="collapse"
           role="button" aria-expanded="true" aria-controls="collapseCardExample">
            <h6 class="m-0 font-weight-bold text-primary">Penilaian Alternatif</h6>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="tambahpenialain">
            <div class="card-body">
                @if (Session::has('msg'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>Info!</strong> {{ Session::get('msg') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="table-responsive">
                    <form action="{{ route('penilaian.store') }}" method="post">
                        <button class="btn btn-sm btn-primary float-right">Simpan</button>
                        <br><br>
                        @csrf
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Alternatif</th>
                                    @foreach($kriteria as $value)
                                        <th>{{ $value->nama_kriteria }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($alternatif as $valt)
                                    <tr>
                                        <td>{{ $valt->nama_alternatif }}</td>
                                        @foreach($kriteria as $key => $value)
                                            <td>
                                                <select name="crips_id[{{ $value->id }}][{{ $valt->id }}]" class="form-control">
                                                    @foreach($value->crips as $v_1)
                                                        <option value="{{ $v_1->id }}" 
                                                            @if(isset($valt->penilaian[$key]) && $v_1->id == $valt->penilaian[$key]->crips_id) 
                                                                selected 
                                                            @endif>
                                                            {{ $v_1->nama_crips }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        @endforeach
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ count($kriteria) + 1 }}">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
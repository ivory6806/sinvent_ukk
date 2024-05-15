@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <h2>EDIT BARANG MASUK</h2>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('barangmasuk.update',$rsetBarangMasuk->id) }}" method="POST" enctype="multipart/form-data">                    
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">TANGGAL MASUK</label>
                                <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror" name="tgl_masuk" value="{{ old('tgl_masuk',$rsetBarangMasuk->tgl_masuk) }}" placeholder="Masukkan Tanggal Masuk Barang">
                           
                                <!-- error message untuk tgl_masuk -->
                                @error('tgl_masuk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">JUMLAH MASUK</label>
                                <input type="number" min="1" class="form-control @error('qty_masuk') is-invalid @enderror" name="qty_masuk" value="{{ old('qty_masuk',$rsetBarangMasuk->qty_masuk) }}" placeholder="Masukkan Jumlah Masuk Barang">
                           
                                <!-- error message untuk qty_masuk -->
                                @error('qty_masuk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">BARANG</label>
                                <select class="form-control" name="barang_id" aria-label="Default select example">
                                    @foreach ($abarang as $barang)
                                        @if ($selectedBarang && $selectedBarang->id == $barang->id)
                                            <option value="{{ $barang->id }}" selected>{{ $barang->merk }}</option>
                                        @else
                                            <option value="{{ $barang->id }}">{{ $barang->merk }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            
                                <!-- error message untuk barang -->
                                @error('barang_id')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                            <a href="{{ route('barangmasuk.index') }}" class="btn btn-md btn-primary">BACK</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
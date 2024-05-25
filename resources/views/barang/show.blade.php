@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        {{ __('Dashboard') }}
                    </div>
                    <div class="float-end">
                        <a href="{{ route('barang.index') }}" class="btn btn-sm btn-outline-primary">Kembali</a>
                    </div>
                </div>

                <div class="card-body">
                    <hr>
                    <h4>{{ $barang->nama_barang}}</h4>
                    <p class="tmt-3">
                        Harga : RP.{{ number_format($barang->harga, 2)}}
                    </p>
                    <p class="tmt-3">
                        stok :  {!! $barang->stok !!}
                    </p>
                    <p class="tmt-3">
                        Merek ID : {!! $barang->merek_id !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

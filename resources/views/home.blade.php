@extends('layouts.main')

@section('styles')
    <style>
        body {
            overflow: hidden;
        }
    </style>
@endsection

@section('content')
    <div class="wrapper">
        <div class="page-header clear-filter" filter-color="black">
            <div class="page-header-image" data-parallax="true" style="background-image: url('/img/kota-lama.jpg')">
            </div>
            <div class="container">
                <div class="content-center brand">
                    <img class="n-logo" src="/img/logo-diskom-sm.png" alt="" />
                    <h1 class="h1-seo"><b>Diskominfo Kota Semarang</b> </h1>
                    <h3>Mari Isi Kuesioner untuk meningkatkan pelayanan kami.</h3>
                    <a href="/posts"><button type="button" class="btn btn-primary">Pilih Kuesioner</button></a>
                </div>
            </div>
        </div>
    @endsection

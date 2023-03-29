@extends('dashboard.layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Welcome Back, {{ auth()->user()->name }}</h1>
    </div>

    <div class="row">

        <div class="col-lg-10">
            <div class="col-lg-5">
                <div class="row ">
                    <h5>Data Kuesioner</h5>
                    <div class="col-sm-6">
                        <div class="card mt-2 border-0 rounded-0" style="background-color: #d9d9d9">
                            <div class="card-body">
                                <div class="card-title">
                                    <b>Kuesioner Dibuat</b>
                                </div>
                                <div class="card-text">
                                    {{ $totalKuesioner }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card mt-2 border-0 rounded-0" style="background-color: #d9d9d9">
                            <div class="card-body">
                                <div class="card-title">
                                    <b>Kuesioner Aktif</b>
                                </div>
                                <div class="card-text">
                                    {{ $totalKuesionerAktif }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card mt-2 border-0 rounded-0" style="background-color: #d9d9d9">
                            <div class="card-body">
                                <div class="card-title">
                                    <b>Kuesioner Hampir Expired</b>
                                </div>
                                <div class="card-text">
                                    {{ $totalKuesionerHampirExpired }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="card mt-2 border-0 rounded-0" style="background-color: #d9d9d9">
                            <div class="card-body">
                                <div class="card-title">
                                    <b>Total Responden</b>
                                </div>
                                <div class="card-text">
                                    17
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('dashboard.layouts.main')

@section('container')
    <div class="table-responsive col-lg-8 mt-4">
        <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Create new post</a>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Waktu Ekspirasi</th>
                    <th scope="col">Banyak Pertanyaan</th>
                    <th scope="col">Status</th>

                </tr>
            </thead>
            <tbody>
                {{-- loop iteration documentation --}}
                @foreach ($questionnaires as $questionnaire)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $questionnaire->judul }}</td>
                        <td>{{ $questionnaire->waktu_ekspirasi }}</td>
                        <td>{{ $questionnaire->jumlah_pertanyaan }}</td>
                        <td>{{ $questionnaire->status_aktif }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

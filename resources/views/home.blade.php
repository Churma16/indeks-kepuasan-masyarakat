@extends('layouts.main')

@section('style')
    <link href="/css/blog.css" rel="stylesheet" />

    <link href="/css/button.css" rel="stylesheet" />
@endsection

@section('container')
    <br>
    <div class="container mt-2 col-md-9">
        <div class="p-4 p-md-5 mb-4 rounded text-bg-dark ">
            <div class="col-md-6 px-0">
                <h1 class="display-4 fst-italic">
                    Title of a longer featured blog post
                </h1>
                <p class="lead my-3">
                    Multiple lines of text that form the lede, informing new
                    readers quickly and efficiently about what’s most
                    interesting in this post’s contents.
                </p>
                <p class="lead mb-0">
                    <a href="/posts" class="btn btn-primary">Pilih Kuesioner</a>
                    {{-- <button class="button-2-pushable" role="button">
                        <span class="button-2-shadow"></span>
                        <span class="button-2-edge"></span>
                        <span class="button-2-front text">
                            Button 1
                        </span>
                    </button> --}}
                </p>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary">World</strong>
                        <h3 class="mb-0">Featured post</h3>
                        <div class="mb-1 text-muted">Nov 12</div>
                        <p class="card-text mb-auto">
                            This is a wider card with supporting text below
                            as a natural lead-in to additional content.
                        </p>
                        <a href="#" class="stretched-link">Continue reading</a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg"
                            role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice"
                            focusable="false">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#55595c" />
                            <text x="50%" y="50%" fill="#eceeef" dy=".3em">
                                Thumbnail
                            </text>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-success">Design</strong>
                        <h3 class="mb-0">Post title</h3>
                        <div class="mb-1 text-muted">Nov 11</div>
                        <p class="mb-auto">
                            This is a wider card with supporting text below
                            as a natural lead-in to additional content.
                        </p>
                        <a href="#" class="stretched-link">Continue reading</a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg"
                            role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice"
                            focusable="false">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#55595c" />
                            <text x="50%" y="50%" fill="#eceeef" dy=".3em">
                                Thumbnail
                            </text>
                        </svg>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

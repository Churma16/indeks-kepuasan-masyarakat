@if (Request::is('/'))
    <nav class="navbar navbar-expand-lg bg-primary fixed-top navbar-transparent" color-on-scroll="400">
    @else
        <nav class="navbar navbar-expand-lg bg-dark fixed-top">
@endif

<div class="container">
    <div class="navbar-translate">
        <img src="/img/logo-diskom.png" style="max-height: 35px">
        <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
            aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar top-bar"></span>
            <span class="navbar-toggler-bar middle-bar"></span>
            <span class="navbar-toggler-bar bottom-bar"></span>
        </button>
    </div>
    <div class="collapse navbar-collapse justify-content-start" id="navigation"
        data-nav-image="/assets/img/blurred-image-1.jpg">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/"> <i class="feather-16"
                        data-feather="home"></i>
                    Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('posts') ? 'active' : '' }}" href="/posts"> <i
                        class="feather-16"data-feather="file-text"></i>
                    List Kuesioner
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="javascript:void(0)"> <i class="feather-16" data-feather="info"></i>
                    About
                </a>
            </li>
        </ul>
    </div>
    <div class="collapse navbar-collapse justify-content-end" id="navigation"
        data-nav-image="/assets/img/blurred-image-1.jpg">
        <ul class="navbar-nav">
            @auth
                <li class="nav-item dropdown">
                    <a class="nav-link " href="/dashboard"> <i class="feather-16" data-feather="user"></i>
                        {{ auth()->user()->name }}
                    </a>
                @else
                <li class="nav-item">
                    <a class="nav-link " href="/login"> <i class="feather-16" data-feather="log-in"></i>
                        Login
                    </a>
                @endauth
            </li>
        </ul>
    </div>

</div>
</nav>

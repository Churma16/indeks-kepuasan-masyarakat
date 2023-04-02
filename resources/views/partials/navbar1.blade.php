<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container">
            <a class href="/"><img src="/img/logo-diskom.png" style="height:40px; width:auto"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ms-3" id="navbarCollapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('/') ?'active' : '' }}" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('posts') ?'active' : '' }}" href="/posts">Daftar Kuesioner</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="/#contact">Contact</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/login"><i class="bi bi-person-circle"></i> Admin Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

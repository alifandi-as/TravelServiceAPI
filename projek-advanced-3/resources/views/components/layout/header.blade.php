<nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand">
            <img src="{{ asset('assets/images/Logo.png') }}" width="32px" height="28px">
            Kelasku
        </a>
        <form class="d-flex" role="search">
            {{$slot}}
            <a href="/profile" class="btn btn-primary" type="submit">{{auth()->user()->name}}</a>
            <a href="/notifications" class="btn btn-white" type="submit">Notifikasi</a>
            <a href="/" class="btn btn-white">Beranda</a>
            <a href="/kelasku" class="btn btn-white">Kelasku</a>
            {{-- <button class="btn btn-yellow" type="submit">Makanan</button> --}}
            <!-- <a href="/login" class="btn btn-yellow" type="submit">Akun</a> -->
        </form>
    </div>
    </nav>
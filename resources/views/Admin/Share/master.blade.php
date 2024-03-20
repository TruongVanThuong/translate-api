<!doctype html>
<html lang="en">

<head>
    @include('Admin.share.css')
    <title>@yield('title')</title>
    @yield('css')
</head>

<body>
    <div class="wrapper">
        <div class="header-wrapper">
            <header>
                @include('Admin.share.header')
            </header>
            @include('Admin.share.menu')
        </div>
        <div class="page-wrapper">
            <div class="page-content">
                @yield('noi_dung')
            </div>
        </div>
        <div class="overlay toggle-icon"></div>
        <footer class="page-footer">
            <p class="mb-0">Copyright © @php echo date("Y");  @endphp. All right reserved.</p>
        </footer>
    </div>

    @include('Admin.share.js')
    @yield('js')
</body>

</html>

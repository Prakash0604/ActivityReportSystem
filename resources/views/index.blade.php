<!doctype html>
<html lang="en">

<head>
    <title>Activity Tracking</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="">
    <!--Main Navigation-->
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar mt-0 collapse bg-white">
            <div class="position-sticky">
                <div class="list-group list-group-flush mx-3">
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="bi bi-speedometer2"></i> <span> Main dashboard</span>
                    </a>
                    <a href="{{ route('role.index') }}" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="bi bi-key-fill"></i> <span> Role</span>
                    </a>
                    <a href="{{ route('user.index') }}" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="bi bi-people-fill"></i> <span> Users</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple active ">
                        <i class="bi bi-graph-up-arrow"></i> <span> Webiste traffic</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="bi bi-graph-up-arrow"></i> <span> Analytics</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="bi bi-pie-chart-fill"></i> <span> SEO</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="bi bi-list-check"></i> <span> Orders</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="bi bi-globe"></i> <span> International</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="bi bi-building"></i> <span> Partners</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="bi bi-calendar-check"></i> <span> Calendar</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple">
                        <i class="bi bi-cash-coin"></i> <span> Sales</span></a>
                        <a href="{{ route('user.logout') }}" class="list-group-item list-group-item-action py-2 ripple">
                            <i class="bi bi-box-arrow-in-right"></i> <span> LogOut</span></a>
                </div>
            </div>
        </nav>
        <!-- Sidebar -->
    </header>

    <!--Main layout-->
    <main style="margin-top: 58px;">
        <div class="container">
            @yield('content')
        </div>
    </main>
    <!--Main layout-->
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>

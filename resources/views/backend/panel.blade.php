<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">

	@meta



	{{-- vendor css --}}
	<link href="{{ asset('assets/vendor/fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/vendor/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/vendor/cifireicon/cifireicon.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/vendor/jqvmap/jqvmap.min.css') }}" rel="stylesheet">

	{{-- DashForge CSS --}}
	<link rel="stylesheet" href="{{ asset('assets/vendor/dashforge/css/dashforge.css') }}">

    {{-- Custom css style code --}}
	@stack('css-style')

    @vite('resources/js/app.js')
    @stack('head-script')
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
</head>

<body>
	{{-- Sidebar --}}
	<aside class="aside aside-fixed">
		<div class="aside-header">
			<a href="#" class="aside-logo">Backend<span>Admin</span></a>
			<a href="" class="aside-menu-link"><i data-feather="menu"></i><i data-feather="x"></i></a>
		</div>
		<div class="aside-body">
			<ul class="nav nav-aside">

				<li class="nav-label">Dashboard</li>

				<li class="nav-item active"><a href="./dashboard.php" class="nav-link"><i data-feather="home"></i> <span>Home</span></a></li>
				<li class="nav-item"><a href="" class="nav-link"><i data-feather="globe"></i> <span>Website</span></a></li>

				<li class="nav-item">
					<a href="helpdesk.html" class="nav-link">
						<i data-feather="life-buoy"></i>
						<span>Helpdesk</span>
					</a>
				</li>


				<li class="nav-label mg-t-25">Application</li>

				<li class="nav-item with-sub">
					<a href="" class="nav-link"><i data-feather="codepen"></i> <span>Component</span></a>
					<ul>
						<li><a href="./table.php">Table</a></li>
						<li><a href="./form.php">Form Layouts</a></li>
						<li><a href="page-groups.html">Groups</a></li>
						<li><a href="page-events.html">Events</a></li>
					</ul>
				</li>
				<li class="nav-item with-sub">
					<a href="" class="nav-link"><i data-feather="file"></i> <span>Other Pages</span></a>
					<ul>
						<li><a href="page-timeline.html">Timeline</a></li>
					</ul>
				</li>

				<li class="nav-label mg-t-25">Settings</li>
				<li class="nav-item"><a href="app-file-manager.html" class="nav-link"><i data-feather="grid"></i> <span>File Manager</span></a></li>
				<li class="nav-item"><a href="app-calendar.html" class="nav-link"><i data-feather="hash"></i> <span>Apperance</span></a></li>




				<li class="nav-label mg-t-25">User Interface</li>
				<li class="nav-item"><a href="../../components" class="nav-link"><i data-feather="layers"></i> <span>Components</span></a></li>
				<li class="nav-item"><a href="../../collections" class="nav-link"><i data-feather="box"></i> <span>Collections</span></a></li>
			</ul>
		</div>
	</aside>
	{{-- /Sidebar --}}

	<div class="content ht-100v pd-0">
		{{-- Topbar --}}
		<div class="content-header">

            <nav class="nav">
                <a href="{{ url('') }}" class="nav-link" target="_blank"><i data-feather="globe"></i> View site</a>
                <a href="" class="nav-link"><i data-feather="grid"></i></a>
                <a href="" class="nav-link"><i data-feather="align-left"></i></a>
                <a href="" class="nav-link"><i data-feather="align-left"></i></a>
                <a href="" class="nav-link"><i data-feather="align-left"></i></a>
            </nav>
            <nav class="nav">
                <a href="" class="nav-link"><i data-feather="help-circle"></i></a>
                <a href="" class="nav-link"><i data-feather="grid"></i></a>
                <a href="" class="nav-link"><i data-feather="align-left"></i></a>
                <a href="" class="nav-link"><i data-feather="align-left"></i></a>
                <a href="" class="nav-link"><i data-feather="align-left"></i></a>
            </nav>
            <nav class="nav">
                <a href="" class="nav-link"><i data-feather="help-circle"></i></a>
                <a href="" class="nav-link"><i data-feather="grid"></i></a>
                <a href="" class="nav-link"><i data-feather="align-left"></i></a>
                <a href="" class="nav-link"><i data-feather="align-left"></i></a>
                <a href="" class="nav-link"><i data-feather="align-left"></i></a>
            </nav>

			<nav class="nav">
				<a href="" class="nav-link"><i data-feather="help-circle"></i></a>
				<a href="" class="nav-link"><i data-feather="grid"></i></a>
				<a href="" class="nav-link"><i data-feather="align-left"></i></a>
			</nav>
		</div>
		{{-- /Topbar --}}





        {{-- Content --}}
		@yield('content')
        {{-- /Content --}}

	</div> {{-- End .content --}}


    {{-- Any PopUp --}}
    @yield('popup')
    {{-- /Any PopUp --}}

	{{-- Scripts JS --}}

	<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/feather-icons/feather.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

	<script src="{{ asset('assets/vendor/dashforge/js/dashforge.js') }}"></script>
	<script src="{{ asset('assets/vendor/dashforge/js/dashforge.aside.js') }}"></script>
	<script src="{{ asset('assets/vendor/dashforge/js/app.js') }}"></script>


    @stack('foot-script')

</body>
</html>

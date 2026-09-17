@extends($__CI->__LayoutsDestination)

@include('backend::beranda.options')

@section('content')
<div class="content-body">
	<div class="container pd-x-0">
		<div class="d-sm-flex align-items-center justify-content-between mg-lg-b-25 mg-xl-b-30">
			<div>
				<h4 class="mg-b-0 tx-spacing--1">Pengaturan</h4>
				<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
			</div>
		</div>


		{{-- Content here.... --}}
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
				aria-controls="home" aria-selected="true">Home</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
				aria-controls="profile" aria-selected="false">Profile</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
				aria-controls="contact" aria-selected="false">Contact</a>
			</li>
		</ul>
		<div class="tab-content bg-white bd bd-gray-300 bd-t-0 pd-20" id="myTabContent">
			<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
				<h6>Home</h6>
				<p>...</p>
			</div>
			<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
				<h6>Profile</h6>
				<p>...</p>
			</div>
			<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
				<h6>Contact</h6>
				<p>...</p>
			</div>
		</div>
	</div>
</div>
@endsection


@section('popup')
{{-- BS.Modal --}}
{{-- /BS.Modal --}}
@endsection

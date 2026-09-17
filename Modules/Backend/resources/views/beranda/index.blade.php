
@extends($__CI->__LayoutsDestination)
@include('backend::beranda.options')



@section('content')

<div class="content-body">
	<div class="container pd-x-0">
		<!-- Content header -->
		<div class="d-sm-flex align-items-center justify-content-between mg-lg-b-25 mg-xl-b-30">
			<div>
				<h4 class="mg-b-0 tx-spacing--1">Form Layouts</h4>
				<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
			</div>
			<div class="d-noneX d-md-blockX mg-20">
				<button class="btn btn-sm pd-x-15 btn-white btn-uppercase"><i data-feather="mail" class="wd-10 mg-r-5"></i> Email</button>
				<button class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-l-5"><i data-feather="printer" class="wd-10 mg-r-5"></i> Print</button>
				<button class="btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5"><i data-feather="file" class="wd-10 mg-r-5"></i> Generate Report</button>
			</div>
		</div>
		<!-- /Content header -->

		<div class="card">
			<div class="card-body">
				<p class="tx-medium">Normal Table</p>
				<table class="table table-sm table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Title</th>
							<th>Category</th>
							<th>Created_at</th>
							<th>Deleted_at</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php for($i=1; $i < 11; $i++): ?>
						<tr>
							<td><?=$i;?></td>
							<td>Lorem</td>
							<td>Ipsum</td>
							<td>Doloer</td>
							<td>10/12/2028</td>
							<td>
								<a href="" class="text-primary"> Edit</a>
								<span> | </span>
								<a href="" class="text-danger">Delete</a>
							</td>
						</tr>
						<?php endfor ?>
					</tbody>
				</table>
				<br>

				<p class="tx-medium">Vertical Table</p>
				<table class="table bd-b">
					<tr>
						<th>ID</th>
						<td>15789</td>
					</tr>
					<tr>
						<th>Nama</th>
						<td>Lorem</td>
					</tr>
					<tr>
						<th>Alamat</th>
						<td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti velit quod consectetur, impedit recusandae.</td>
					</tr>
					<tr>
						<th>Tlp</th>
						<td>0821-3674-4789</td>
					</tr>
				</table>

				<br><br><br>
				<p class="tx-medium">Borderless Table</p>
				<table class="table table-striped table-hover table-borderless">
					<thead>
						<tr>
							<th>ID</th>
							<th>Title</th>
							<th>Bio</th>
						</tr>
					</thead>
					<tbody>
						<?php for($i=0; $i < 5; $i++): ?>
						<tr>
							<td>135134 <?=$i;?></td>
							<td>Ipsum <?=$i;?></td>
							<td><?=$i;?> Lorem ipsum dolor sit amet consectetur adipisicing el</td>
						</tr>
						<?php endfor ?>
					</tbody>
				</table>
			</div>
		</div>

	</div><!-- container -->
</div>

@endsection


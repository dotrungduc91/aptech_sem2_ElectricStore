@extends('admin/layouts/master')

@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Nhập Thông Tin Danh Mục Sản Phẩm</h1>
				</div>
			</div>
		</div>
		<!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					@if ($errors->any())
					<div class="alert alert-danger">
						 @foreach ($errors->all() as $err)
						 	{{$err}}<br>
						 @endforeach
					</div>
					@endif

					@if (session('message'))
					<div class="alert alert-success">
						 	{{session('message')}}
					</div>
					@endif

					<form method="post" action="{{route('category_update',['id'=>$category->id])}}">
						@csrf
						<div class="form-group">
							<label for="name">Nhập Tên Danh Mục</label>
							<input value="{{$category->name}}" name="name" type="text" class="form-control" id="name" placeholder="Nhập tên danh mục">
						</div>
						<button style="width: 100%" type="submit" class="btn btn-primary">Sửa</button>
					</form>
				</div>
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</section>
	<!-- /.content -->
</div>
@stop
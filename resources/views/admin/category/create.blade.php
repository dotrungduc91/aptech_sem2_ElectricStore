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

					<form method="post" action="{{route('category_store')}}">
						@csrf
						<div class="form-group">
							<label for="name">Tên Danh Mục Muốn Thêm</label>
							<input name="name" type="text" class="form-control" id="name" placeholder="Nhập tên danh mục">
						</div>

						<div class="form-group">
						  <label for="category_parent">Chọn Danh Mục Sản Phẩm Liên Kết:</label>
						  	 <select value = "" class="form-control" name="parent_id">
						  	 	<option value="0">Không có</option>
						  	 	 @foreach ($categoryParentList as $item)
						  	 	 	<option value="{{$item->id}}">{{$item->name}}</option>
						  	 	 @endforeach
						  	 </select>
						</div>
						<button style="width: 100%" type="submit" class="btn btn-primary">Lưu</button>
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
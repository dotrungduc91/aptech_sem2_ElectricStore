@extends('client.layout.master')
@section('list')
	<li class="nav-item mr-lg-3 mb-lg-0 mb-2">
		<a class="nav-link" href="{{ route('client_index') }}">Trang chủ
			<span class="sr-only">(current)</span>
		</a>
	</li>
	
	{{-- Danh sách Category --}}
	@foreach ($categoryP as $parent)
	<li class="nav-item dropdown mr-lg-3 mb-lg-0 mb-2">
		<a class="nav-link dropdown-toggle" href="{{ route('client_product', ['idCategory'=>$parent->id]) }}">
			{{ $parent -> name }}
		</a>
		<div class="dropdown-menu">
			<div class="agile_inner_drop_nav_info p-4">
				<div class="row">
					@foreach ($categoryC as $child)
						@if ($child->parent_id == $parent->id )
						<div class="col-sm-6 multi-gd-img">
							<ul class="multi-column-dropdown">
								<li>
									<a href="{{ route('client_product', ['idCategory'=>$child->id]) }}">{{$child->name}}</a>
								</li>
							</ul>
						</div>
						@endif
					@endforeach
				</div>
			</div>
		</div>
	</li>
	@endforeach
	{{-- //Danh sách Category --}}

	<li class="nav-item mr-lg-3 mb-lg-0 mb-2">
		<a class="nav-link" href="{{ route('client_news') }}">Tin tức</a>
	</li>
	<li class="nav-item mr-lg-3 mb-lg-0 mb-2">
		<a class="nav-link" href="{{ route('client_about') }}">Về chúng tôi</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="{{ route('client_contact') }}">Liên hệ ngay</a>
	</li>
@endsection

@section('content')
	<!-- banner-2 -->
	<div class="page-head_agile_info_w3l">

	</div>
	<!-- //banner-2 -->
	<!-- page -->
	<div class="services-breadcrumb">
		<div class="agile_inner_breadcrumb">
			<div class="container">
				<ul class="w3_short">
					<li>
						<a href="index.html">Trang Chủ</a>
						<i>|</i>
					</li>
					<li>Giỏ Hàng</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //page -->
	<!-- checkout page -->
	<div class="privacy py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<span>G</span>iỏ Hàng
			</h3>
			<!-- //tittle heading -->
			<div class="checkout-right">
				<h4 class="mb-sm-4 mb-3">
					Giỏ hàng đang có
					<span>{{count($cartList)}}</span>
					sản phẩm
				</h4>
				<div class="table-responsive">
					<table class="timetable_sub" style="border:0px">
						{{-- <thead>
							<tr>
								<th><h4 style="color: red">Product</h4></th>
								<th><h4 style="color: red">Số lượng</h4></th>
								<th><h4 style="color: red">Tên sản phẩm</h4></th>
								<th><h4 style="color: red">Giá tiền</h4></th>
								<th><h4 style="color: red">Xóa sản phẩm</h4></th>
							</tr>
						</thead> --}}
						<tbody>
							@php
								$count = 1;
							@endphp
							@foreach ($cartList as $item)
								<tr class="rem1">
									<td class="invert-image">
										<a href="{{ route('client_single', ['id'=>$item->product_id,'href_param'=>$item->product_name]) }}">
											<img src="{{ URL::asset($item->image) }}" alt=" " class="img-responsive">
										</a>
									</td>
									<td class="invert">
										<div class="quantity">
											<div class="quantity-select">
												<div class="entry value-minus">&nbsp;</div>
												<div hidden class="entry valueId">
													<span>{{$item->product_id}}</span>
												</div>
												<div class="entry value">
													{{$item->quantity}}
												</div>
												<div class="entry value-plus active">&nbsp;</div>
											</div>
										</div>
									</td>
									<td class="invert"><a class="changeOrange" style="color: black" href="{{route('client_single',['id'=>$item->product_id,'href_param'=>$item->product_name])}}">{{$item->product_name}}</a></td>
									<td class="invert">{{number_format($item->price, 0, '', '.')}} VNĐ</td>
									<td class="invert">
										<button type="button" onclick="deleteProduct({{$item->product_id}})" class="btn btn-danger">Xoá</button>
									</td>
								</tr>
							@endforeach
							
						</tbody>
					</table>
				</div>
			</div>
			
			@if (count($cartList) > 0)
				<div class="checkout-left">
					<div class="address_form_agile mt-sm-5 mt-4">
						<h4 class="mb-sm-4 mb-3">Điền thông tin</h4>
						<form action="{{route('client_process')}}" method="post" class="creditly-card-form agileinfo_form">
							@csrf
							<div class="creditly-wrapper wthree, w3_agileits_wrapper">
								<div class="information-wrapper">
									<div class="first-row">
										<div class="controls form-group">
											<input class="billing-address-name form-control" type="text" name="name" placeholder="Họ và tên" required="">
										</div>
										<div class="w3_agileits_card_number_grids">
											<div class="w3_agileits_card_number_grid_left form-group">
												<div class="controls">
													<input type="text" class="form-control" placeholder="Số điện thoại" name="phone" required="">
												</div>
											</div>
											<div class="w3_agileits_card_number_grid_right form-group">
												<div class="controls">
													<input type="text" class="form-control" placeholder="Địa chỉ" name="address" required="">
												</div>
											</div>
										</div>
									</div>
									<button class="submit check_out btn">Đặt Hàng</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			@endif
			
		</div>
	</div>
	<!-- //checkout page -->

	<!-- middle section -->
	<div class="join-w3l1 py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<div class="row">
				<div class="col-lg-6">
					<div class="join-agile text-left p-4">
						<div class="row">
							<div class="col-sm-7 offer-name">
								<h6>Smooth, Rich & Loud Audio</h6>
								<h4 class="mt-2 mb-3">Branded Headphones</h4>
								<p>Sale up to 25% off all in store</p>
							</div>
							<div class="col-sm-5 offerimg-w3l">
								<img src="{{ URL::asset('project/images/off1.png') }}" alt="" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 mt-lg-0 mt-5">
					<div class="join-agile text-left p-4">
						<div class="row ">
							<div class="col-sm-7 offer-name">
								<h6>A Bigger Phone</h6>
								<h4 class="mt-2 mb-3">Smart Phones 5</h4>
								<p>Free shipping order over $100</p>
							</div>
							<div class="col-sm-5 offerimg-w3l">
								<img src="{{ URL::asset('project/images/off2.png') }}" alt="" class="img-fluid">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- middle section -->
@endsection

@section('js')
	<!-- js-files -->
	<!-- jquery -->
	<script src="{{ URL::asset('project/js/jquery-2.2.3.min.js') }}"></script>
	<!-- //jquery -->

	<!-- nav smooth scroll -->
	<script>
		$(document).ready(function () {
			$(".dropdown").hover(
				function () {
					$('.dropdown-menu', this).stop(true, true).slideDown("fast");
					$(this).toggleClass('open');
				},
				function () {
					$('.dropdown-menu', this).stop(true, true).slideUp("fast");
					$(this).toggleClass('open');
				}
			);
		});
	</script>
	<!-- //nav smooth scroll -->

	<!-- popup modal (for location)-->
	<script src="{{ URL::asset('project/js/jquery.magnific-popup.js') }}"></script>
	<script>
		$(document).ready(function () {
			$('.popup-with-zoom-anim').magnificPopup({
				type: 'inline',
				fixedContentPos: false,
				fixedBgPos: true,
				overflowY: 'auto',
				closeBtnInside: true,
				preloader: false,
				midClick: true,
				removalDelay: 300,
				mainClass: 'my-mfp-zoom-in'
			});

		});
	</script>
	<!-- //popup modal (for location)-->


	<!-- password-script -->
	<script>
		window.onload = function () {
			document.getElementById("password1").onchange = validatePassword;
			document.getElementById("password2").onchange = validatePassword;
		}

		function validatePassword() {
			var pass2 = document.getElementById("password2").value;
			var pass1 = document.getElementById("password1").value;
			if (pass1 != pass2)
				document.getElementById("password2").setCustomValidity("Passwords Don't Match");
			else
				document.getElementById("password2").setCustomValidity('');
			//empty string means no validation error
		}
	</script>
	<!-- //password-script -->

	<!-- quantity -->
	<script>
		$('.value-plus').on('click', function () {
			var divUpd = $(this).parent().find('.value'),
				newVal = parseInt(divUpd.text(), 10) + 1;
			divUpd.text(newVal);
			var idP = $(this).parent().find('.valueId');
			idProduct = parseInt(idP.text(),10);
			$.post("{{route('client_updateQuantity')}}",{
				'value' : newVal,
				'_token': '{{ csrf_token() }}',
				'idProduct' : idProduct
			},function (data) {
		
			});
		});

		$('.value-minus').on('click', function () {
			var divUpd = $(this).parent().find('.value'),
				newVal = parseInt(divUpd.text(), 10) - 1;
				var idP = $(this).parent().find('.valueId');
				idProduct = parseInt(idP.text(),10);
			if (newVal >= 1){
				divUpd.text(newVal);
				$.post("{{route('client_updateQuantity')}}",{
					'value' : newVal,
					'_token': '{{ csrf_token() }}',
					'idProduct': idProduct
				},function (data) {
		
				});
			} 
		});
	</script>
	<!--quantity-->
	<script>
		function deleteProduct(idProduct) {
			Swal.fire({
			title: 'Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng không?',
			showDenyButton: true,
			showCancelButton: true,
			confirmButtonText: `Có`,
			denyButtonText: `Không`,
			}).then((result) => {
			/* Read more about isConfirmed, isDenied below */
			if (result.isConfirmed) {
				Swal.fire('Đã xóa!', '', 'success')
				$.post("{{route('client_updateQuantity')}}",{
					'idProduct': idProduct,
					'status' : 'delete',
					'_token' : '{{ csrf_token() }}'
				},function (data) {
					location.reload()
				});	

			} else if (result.isDenied) {
				Swal.fire('Chưa xóa!', '', 'info')
				return
			}
			})
		}
	</script>
	<!-- //quantity -->

	<!-- smoothscroll -->
	<script src="{{ URL::asset('project/js/SmoothScroll.min.js') }}"></script>
	<!-- //smoothscroll -->

	<!-- start-smooth-scrolling -->
	<script src="{{ URL::asset('project/js/move-top.js') }}"></script>
	<script src="{{ URL::asset('project/js/easing.js') }}"></script>
	<script>
		jQuery(document).ready(function ($) {
			$(".scroll").click(function (event) {
				event.preventDefault();

				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 1000);
			});
		});
	</script>
	<!-- //end-smooth-scrolling -->

	<!-- smooth-scrolling-of-move-up -->
	<script>
		$(document).ready(function () {
			/*
			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
			};
			*/
			$().UItoTop({
				easingType: 'easeOutQuart'
			});

		});
	</script>
	<!-- //smooth-scrolling-of-move-up -->

	<!-- for bootstrap working -->
	<script src="{{ URL::asset('project/js/boostrap.js') }}"></script>
	<!-- //for bootstrap working -->
	<!-- //js-files -->
@endsection

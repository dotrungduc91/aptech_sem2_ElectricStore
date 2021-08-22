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
						<a href="index.html">Trang chủ</a>
						<i>|</i>
					</li>
					<li>Thông tin cá nhân</li>
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
				<span>T</span>hông Tin
			</h3>
                <div class="form-group">
                    <label for="name">Họ tên</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$name}}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="dong" readonly style="background-color: #f5f1f1" type="email" class="form-control" value="{{$email}}" name="email" id="email">
                </div>
                <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    <input type="text" class="form-control" name="phone" id="phone" value="{{$phone}}">
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <input type="text" class="form-control" name="address" id="address" value="{{$address}}">
                </div>
                <button type="button" id="update" class="btn btn-primary" onclick="updateInfo()">Cập nhật</button>
		</div>
		<div class="container py-xl-4 py-lg-2">
			<h2 style="color: #F44336">Lịch sử đơn hàng</h2>
			<div class="table-responsive mt-4 his">
				<table class="timetable_sub">
					<thead>
						<tr>
							<th>STT</th>
							<th>Ngày đặt đơn hàng</th>
							<th>Số điện thoại</th>
							<th>Địa chỉ</th>
							<th>Chi tiết</th>
							<th>Tình trạng đơn hàng</th>
						</tr>
					</thead>
					<tbody>
						@php
							$index = 1;
						@endphp
						@foreach ($orderList as $order)
							<tr class="rem1">
								<td class="invert">{{$index++}}</td>
								<td class="invert">
									<span>{{$order->order_date}}</span>
								</td>
								<td class="invert">
									<span>{{$order->phone}}</span>
								</td>
								<td class="invert">
									<span>{{$order->address}}</span>
								</td>
								<td class="invert">
									<a href="{{ route('client_orderDetails', ['id'=>$order->id]) }}"><span>Xem chi tiết</span></a>
								</td>
								@if ($order->status_id == 1)
									<td class="invert">
										<span style="color: orange">Chờ xác nhận <a onclick="deleteOrder({{$order->id}})" href="javascript:void(0)" style="color: red">(Hủy đơn hàng)</a></span>
									</td>
								@elseif($order->status_id == 2)
									<td class="invert">
										<span style="color: green">Đã xác nhận <a onclick="deleteOrder({{$order->id}})" href="javascript:void(0)" style="color: red">(Hủy đơn hàng)</a></span>
									</td>
								@elseif($order->status_id == 3)
								<td class="invert">
									<span style="color: orange">Đang giao hàng <a onclick="deleteOrder({{$order->id}})" href="javascript:void(0)" style="color: red">(Hủy đơn hàng)</a></span>
								</td>
								@elseif($order->status_id == 4)
								<td class="invert">
									<span style="color: green">Đã giao hàng</span>
								</td>
								@else
									<td class="invert">
										<span style="color: red">Đã hủy đơn</span>
									</td>
								@endif
							</tr>
						@endforeach
						
					</tbody>
				</table>
			</div>
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
								<img src="{{ asset('project/images/off1.png') }}" alt="" class="img-fluid">
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
								<img src="{{ asset('project/images/off2.png') }}" alt="" class="img-fluid">
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
	{{-- Xóa đơn hàng --}}
	<script>
		function deleteOrder(id) {
			Swal.fire({
			title: 'Bạn có chắc muốn hủy đơn hàng này không?',
			showDenyButton: true,
			showCancelButton: true,
			confirmButtonText: `Có`,
			denyButtonText: `Không`,
			}).then((result) => {
			/* Read more about isConfirmed, isDenied below */
			if (result.isConfirmed) {
				Swal.fire('Đã hủy!', '', 'success')
				$.post("{{route('client_deleteOrder')}}",{
					'id': id,
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
	{{-- //Xóa đơn hàng --}}
    {{-- Cập nhật --}}
    <script>
        function updateInfo() {
            // alert('hello')
            $.post("{{route('client_userUpdate')}}",{
                '_token' : '{{ csrf_token() }}',
                'name' : $('#name').val(),
                'phone' : $('#phone').val(),
                'address' : $('#address').val()
            },function (data) {
                Swal.fire(
                'Cập nhật dữ liệu thành công!',
                'Vui lòng load lại trang để cập nhật dữ liệu',
                'success'
                )  
            });      
        }
    </script>
    {{-- //Cập nhật --}}
	<!-- js-files -->
	<!-- jquery -->
	<script src="{{ asset('project/js/jquery-2.2.3.min.js') }}"></script>
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
	<script src="{{ asset('project/js/jquery.magnific-popup.js') }}"></script>
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
			var option = confirm('Bạn chắc chắn muốn xóa sản phẩm này khỏi danh sách cart không?')
			if(!option) return
			$.post("{{route('client_updateQuantity')}}",{
				'idProduct': idProduct,
				'status' : 'delete',
				'_token' : '{{ csrf_token() }}'
			},function (data) {
				location.reload()
			});	
		}
	</script>
	<!-- //quantity -->

	<!-- smoothscroll -->
	<script src="{{ asset('project/js/SmoothScroll.min.js') }}"></script>
	<!-- //smoothscroll -->

	<!-- start-smooth-scrolling -->
	<script src="{{ asset('project/js/move-top.js') }}"></script>
	<script src="{{ asset('project/js/easing.js') }}"></script>
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
	<script src="{{ asset('project/js/boostrap.js') }}"></script>
	<!-- //for bootstrap working -->
	<!-- //js-files -->
@endsection
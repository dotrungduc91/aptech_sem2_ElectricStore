@extends('client.layout.master')
@section('css')
<style type="text/css">
	h3::first-letter {color: blue}

	img {
		max-width: 100%;
		height: auto;
	}
</style>

@stop

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
					<a href="{{route('client_index')}}">Home</a>
					<i>|</i>
				</li>
				<li>{{$title}}</li>
			</ul>
		</div>
	</div>
</div>
<!-- //page -->

<!-- top Products -->
<div class="ads-grid py-sm-5 py-4">
	<div class="container py-xl-4 py-lg-2">
		<!-- tittle heading -->
		<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
			<style>
				label::first-letter {
					color: blue;
				}
			</style>
			@php
			$arr = explode(' ', $title);
			$title = '<label>'.implode('</label><label>', $arr).'</label>';
			@endphp
			{!! $title !!}
		</h3>
		<!-- //tittle heading -->
		<div class="row">
			<!-- product left -->
			<div class="agileinfo-ads-display col-lg-9">
				<div class="wrapper">
					<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
						<div class="row">
							{{-- Chạy qua từng sản phẩm  --}}
							@if (count($productList) == 0)
							<h3 class="agileits-sear-head mt-3">Không có sản phẩm nào phù hợp với tìm kiếm của bạn</h3>
							@endif
							@foreach ($productList as $product)
							<div class="col-md-4 product-men mt-5">
								<div class="men-pro-item simpleCart_shelfItem">
									<div class="men-thumb-item text-center">
										<img src="{{ asset($product->image) }}" alt="">
										<div class="men-cart-pro">
											<div class="inner-men-cart-pro">
												<a href="{{ route('client_single',['id'=>$product->id,'href_param'=>$product->href_param]) }}" class="link-product-add-cart">Chi tiết</a>
											</div>
										</div>
									</div>
									<div class="item-info-product text-center border-top mt-4">
										<h4 class="pt-1">
											<a href="{{ route('client_single',['id'=>$product->id,'href_param'=>$product->href_param]) }}">{{$product->name}}</a>
										</h4>
										<div class="info-product-price my-2">
											@if ($product->price_discount > 0)
											<span class="item_price">{{number_format($product->price_discount, 0, '', '.')}} VNĐ</span>
											<del>{{number_format($product->price, 0, '', '.')}}</del>
											@else
											<span class="item_price">{{number_format($product->price, 0, '', '.')}} VNĐ</span>
											@endif
										</div>
										@php
										if (time() - strtotime($product->created_at) < 2*24*60*60 ) {
										echo '<span class="product-new-top">New</span>';
									}
									@endphp
									<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
										@if ($product->quantity_available <= 0)
										<input type="submit" value="Hết hàng" style="cursor:not-allowed" class="button" />
										@else
										<form method="post" action="{{route('client_checkout')}}">
											@csrf
											<input hidden type="text" name="idProduct" value="{{$product->id}}">
											<input type="submit" value="Thêm giỏ hàng" class="button" />
										</form>
										@endif
									</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
			{{ $productList->appends(['idCategory' => $idCategory,'s' => $search,'price_level'=>$price_level])->links() }}
		</div>
		<!-- //product left -->
		<!-- product right -->
		<div class="col-lg-3 mt-lg-0 mt-4 p-lg-0">
			<div class="side-bar p-sm-4 p-3">
				<div class="search-hotel border-bottom py-2">
					<h3 class="agileits-sear-head mb-3">Tìm kiếm</h3>
					<form action="{{route('client_product')}}" method="get">
						@php
						if(!empty($idCategory)){
						echo '<input hidden name="idCategory" value="'.$idCategory.'" type="text">';
					}
					@endphp
					<input type="search" placeholder="Tên sản phẩm..." name="s">
					<input type="submit" value=" ">
				</form>
			</div>
			<!-- price -->
			<div class="range border-bottom py-2">
				<h3 class="agileits-sear-head mb-3">Giá</h3>
				<div class="w3l-range">
					<ul>
						<li>
							<a href="{{ route('client_product', ['s'=>$search,'price_level'=>1,'idCategory'=>$idCategory]) }}">Dưới 1.000.000 VNĐ</a>
						</li>
						<li class="my-1">
							<a href="{{ route('client_product',['s'=>$search,'price_level'=>2,'idCategory'=>$idCategory]) }}">1.000.000 - 5.000.000 VNĐ</a>
						</li>
						<li>
							<a href="{{ route('client_product',['s'=>$search,'price_level'=>3,'idCategory'=>$idCategory]) }}">5.000.000 - 10.000.000 VNĐ</a>
						</li>
						<li class="my-1">
							<a href="{{ route('client_product',['s'=>$search,'price_level'=>4,'idCategory'=>$idCategory]) }}">10.000.000 - 20.000.000 VNĐ</a>
						</li>
						<li>
							<a href="{{ route('client_product',['s'=>$search,'price_level'=>5,'idCategory'=>$idCategory]) }}">20.000.000 - 30.000.000 VNĐ</a>
						</li>
						<li class="mt-1">
							<a href="{{ route('client_product',['s'=>$search,'price_level'=>6,'idCategory'=>$idCategory]) }}">Trên 30.000.000 VNĐ</a>
						</li>
					</ul>
				</div>
			</div>
			<!-- //price -->



			<!-- //electronics -->

			<!-- best seller -->
			<div class="f-grid py-2">
				<h3 class="agileits-sear-head mb-3">Sản phẩm bán chạy</h3>
				<div class="box-scroll">
					<div class="scroll">
						@foreach ($productListHot as $product)
						<div class="row my-5">
							<div class="col-lg-3 col-sm-2 col-3 left-mar">
								<img src="{{ asset($product->image) }}" alt="" class="img-fluid">
							</div>
							<div class="col-lg-9 col-sm-10 col-9 w3_mvd">
								<a href="{{ route('client_single',['id'=>$product->id,'href_param'=>$product->href_param]) }}">{{$product-> name}}</a>
								<a href="{{ route('client_single',['id'=>$product->id,'href_param'=>$product->href_param]) }}" class="price-mar mt-2">
									@if ($product->price_discount > 0)
									{{number_format($product->price_discount, 0, '', '.')}} VNĐ
									@else
									{{number_format($product->price, 0, '', '.')}} VNĐ
									@endif
								</a>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
			<!-- //best seller -->
		</div>
	</div>
	<!-- //product right -->
</div>
</div>
</div>
<!-- //top products -->

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

<!-- cart-js -->
<!-- //cart-js -->

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

	<!-- imagezoom -->
	<script src="{{ asset('project/js/imagezoom.js') }}"></script>
	<!-- //imagezoom -->

	<!-- flexslider -->
	<link rel="stylesheet" href="{{ asset('project/css/flexslider.css') }}" type="text/css" media="screen" />

	<script src="{{ asset('project/js/jquery.flexslider.js') }}"></script>
	<script>
		// Can also be used with $(document).ready()
		$(window).load(function () {
			$('.flexslider').flexslider({
				animation: "slide",
				controlNav: "thumbnails"
			});
		});
	</script>
	<!-- //FlexSlider-->

	<!-- smoothscroll -->
	<script src="{{ asset('project/js/SmoothScroll.min.js') }}"></script>
	<!-- //smoothscroll -->

	<!-- start-smooth-scrolling -->
	<script src="{{ asset('project/js/move-top.js') }}"></script>
	<script src="{{ asset('project/js/easing.js') }}"></script>
	<script>
		jQuery(document).ready(function ($) {
			$(".scroll").click(function (event) {
				// event.preventDefault();

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

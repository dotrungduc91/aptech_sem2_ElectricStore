<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>Electro Store Ecommerce Category Bootstrap Responsive Web Template | About Us :: w3layouts</title>
	<!-- Meta tag Keywords -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<meta name="keywords" content="Electro Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design"
	/>
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<!-- //Meta tag Keywords -->

	<!-- Custom-Files -->
	<link href="{{ asset('/project/css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />
	<!-- Bootstrap css -->
	<link href="{{ asset('/project/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
	<!-- Main css -->
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<!-- Font-Awesome-Icons-CSS -->
	<link href="{{ asset('/project/css/popuo-box.css') }}" rel="stylesheet" type="text/css" media="all" />
	<!-- pop-up-box -->
	<link href="{{ asset('/project/css/menu.css') }}" rel="stylesheet" type="text/css" media="all" />
	<!-- menu style -->
	<!-- //Custom-Files -->

	<!-- web fonts -->
	<link href="//fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&amp;subset=latin-ext" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese"
	rel="stylesheet">
	<!-- //web fonts -->
	@yield('css')	
</head>

<body>
	<!-- top-header -->
	<div class="agile-main-top">
		<div class="container-fluid">
			<div class="row main-top-w3l py-2">
				<div class="col-lg-4 header-most-top">
					<p class="text-white text-lg-left text-center">Trung tâm mua sắm giá rẻ
						<i class="fas fa-shopping-cart ml-1"></i>
					</p>
				</div>
				<div class="col-lg-8">
					<!-- header lists -->
					<ul style="display: flex;list-style-type: none">
						<li class="text-center border-right text-white px-4">
							<a class="play-icon popup-with-zoom-anim text-white" href="#small-dialog1">
								<i class="fas fa-map-marker mr-2"></i>Chọn địa chỉ</a>
							</li>
							<li class="text-center border-right text-white px-4">
								<i class="fas fa-phone mr-2"></i> 0 967 962 184
							</li>
							@guest
							@if (Route::has('login'))
							<li class="text-center border-right text-white px-4">
								<a href="{{ route('login') }}" class="text-white">
									<i class="fas fa-sign-in-alt mr-2"></i> Đăng nhập </a>
								</li>
								@endif

								@if (Route::has('register'))
								<li class="text-center text-white px-4">
									<a href="{{ route('register') }}"  class="text-white">
										<i class="fas fa-sign-out-alt mr-2"></i>Đăng kí </a>
									</li>
									@endif
									@else
									<li class="text-center border-right text-white px-4">
										<a href="{{ route('client_user') }}" class="text-white">Xin chào, {{ Auth::user()->name }}</a>
									</li>
									<li class="text-center text-white px-4">
										<a href="{{ route('logout') }}"  class="text-white" onclick="event.preventDefault();
										document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt mr-2"></i>Đăng xuất </a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
											@csrf
										</form>
									</li>
									@endguest
								</ul>
								<!-- //header lists -->
							</div>
						</div>
					</div>
				</div>

				<!-- Button trigger modal(select-location) -->
				<div id="small-dialog1" class="mfp-hide">
					<div class="select-city">
						<h3>
							<i class="fas fa-map-marker"></i> Please Select Your Location</h3>
							<select class="list_of_cities">
								<optgroup label="Popular Cities">
									<option selected style="display:none;color:#eee;">Select City</option>
									<option>Birmingham</option>
									<option>Anchorage</option>
									<option>Phoenix</option>
									<option>Little Rock</option>
									<option>Los Angeles</option>
									<option>Denver</option>
									<option>Bridgeport</option>
									<option>Wilmington</option>
									<option>Jacksonville</option>
									<option>Atlanta</option>
									<option>Honolulu</option>
									<option>Boise</option>
									<option>Chicago</option>
									<option>Indianapolis</option>
								</optgroup>
								<optgroup label="Alabama">
									<option>Birmingham</option>
									<option>Montgomery</option>
									<option>Mobile</option>
									<option>Huntsville</option>
									<option>Tuscaloosa</option>
								</optgroup>
							</select>
							<div class="clearfix"></div>
						</div>
					</div>
					<!-- //shop locator (popup) -->

					<!-- //top-header -->

					<!-- header-bottom-->
					<div class="header-bot">
						<div class="container">
							<div class="row header-bot_inner_wthreeinfo_header_mid">
								<!-- logo -->
								<div class="col-md-3 logo_agile">
									<h1 class="text-center">
										<a href="{{ route('client_index') }}" class="font-weight-bold font-italic">
											<img src="{{ asset('project/images/logo2.png') }}" alt=" " class="img-fluid">Electric Store
										</a>
									</h1>
								</div>
								<!-- //logo -->
								<!-- header-bot -->
								<div class="col-md-9 header mt-4 mb-md-0 mb-4">
									<div class="row">
										<!-- search -->
										<div class="col-10 agileits_search">
											<form class="form-inline" action="{{route('client_product')}}" method="get">
												@php
												if(!empty($idCategory)){
												echo '<input hidden name="idCategory" value="'.$idCategory.'" type="text">';
											}
											@endphp
											{{-- <input hidden name="idCategory" value="{{$idCategory}}" type="text"> --}}
											<input class="form-control mr-sm-2" name="s" type="search" placeholder="Nhập sản phẩm muốn tìm..." aria-label="Search">
											<button class="btn my-2 my-sm-0" type="submit">Search</button>
										</form>
									</div>
									<!-- //search -->
									<!-- cart details -->
									<div class="col-2 top_nav_right text-center mt-sm-0 mt-2">
										<div class="wthreecartaits wthreecartaits2 cart cart box_1">
											<a href="{{route('client_showCart')}}">
												<button class="btn w3view-cart" type="submit" name="submit" value="">
													<i class="fas fa-cart-arrow-down"></i>
												</button>
											</a>
										</div>
									</div>
									<!-- //cart details -->
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- shop locator (popup) -->
				<!-- //header-bottom -->
				<!-- navigation -->
				<div class="navbar-inner">
					<div class="container">
						<nav class="navbar navbar-expand-lg navbar-light bg-light">
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
							aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav text-center mr-xl-5">
								@yield('list')
							</ul>
						</div>
					</nav>
				</div>
			</div>
			<!-- //navigation -->

			@yield('content')

			<!-- footer -->
			<footer>
				<div class="footer-top-first">
					<div class="container py-md-5 py-sm-4 py-3">
						<!-- footer first section -->
						<h2 class="footer-top-head-w3l font-weight-bold mb-2">Thiết bị điện tử :</h2>
						<p class="footer-main mb-4">
							Nếu bạn đang cân nhắc về một chiếc điện thoại mới,
							hay đang tìm kiếm một chiếc smart-watch ưng ý, 
							chúng tôi sẽ giúp bạn dễ dàng tìm thấy chính xác những gì bạn cần với mức giá bạn có thể mua được. 
							Chúng tôi cung cấp giá ưu đãi hàng ngày ở nhiều thiết bị như điện thoại, đồng hồ thông minh và hơn thế nữa.
						</p>
						<!-- //footer first section -->
						<!-- footer second section -->
						<div class="row w3l-grids-footer border-top border-bottom py-sm-4 py-3">
							<div class="col-md-4 offer-footer">
								<div class="row">
									<div class="col-4 icon-fot">
										<i class="fas fa-dolly"></i>
									</div>
									<div class="col-8 text-form-footer">
										<h3>Miễn phí ship</h3>
										<p>đơn hàng trên 20.000.000 VNĐ</p>
									</div>
								</div>
							</div>
							<div class="col-md-4 offer-footer my-md-0 my-4">
								<div class="row">
									<div class="col-4 icon-fot">
										<i class="fas fa-shipping-fast"></i>
									</div>
									<div class="col-8 text-form-footer">
										<h3>Vận chuyển nhanh</h3>
										<p>xuyên lục địa</p>
									</div>
								</div>
							</div>
							<div class="col-md-4 offer-footer">
								<div class="row">
									<div class="col-4 icon-fot">
										<i class="far fa-thumbs-up"></i>
									</div>
									<div class="col-8 text-form-footer">
										<h3>Lựa chọn đúng đắn</h3>
										<p>mọi sản phẩm</p>
									</div>
								</div>
							</div>
						</div>
						<!-- //footer second section -->
					</div>
				</div>
				<!-- footer third section -->
				<div class="w3l-middlefooter-sec">
					<div class="container py-md-5 py-sm-4 py-3">
						<div class="row footer-info w3-agileits-info">
							<!-- footer categories -->
				<!-- 			<div class="col-md-3 col-sm-6 footer-grids">
								<h3 class="text-white font-weight-bold mb-3">Danh mục</h3>
								<ul>
									<li class="mb-3">
										<a href="{{ route('client_product') }}">Điện thoại</a>
									</li>
									<li class="mb-3">
										<a href="{{ route('client_product') }}">Smart Watch</a>
									</li>
									<li class="mb-3">
										<a href="{{ route('client_product') }}">Máy tính xách tay</a>
									</li>
								</ul>
							</div> -->
							<!-- //footer categories -->
							<!-- quick links -->
							<div class="col-md-4 col-sm-6 footer-grids mt-sm-0 mt-4">
								<h3 class="text-white font-weight-bold mb-3">Liên kết nhanh</h3>
								<ul>
									<li class="mb-3">
										<a href="{{ route('client_about') }}">Về chúng tôi</a>
									</li>
									<li class="mb-3">
										<a href="{{ route('client_contact') }}">Liên lạc ngay</a>
									</li>
									<li class="mb-3">
										<a href="{{ route('client_help') }}">Hỗ trợ</a>
									</li>
									<li class="mb-3">
										<a href="{{ route('client_faqs') }}">Thắc mắc và giải đáp</a>
									</li>
									<li class="mb-3">
										<a href="{{ route('client_terms') }}">Điều khoản sử dụng</a>
									</li>
									<li>
										<a href="{{ route('client_privacy') }}">Chính sách bảo mật</a>
									</li>
								</ul>
							</div>
							<div class="col-md-4 col-sm-6 footer-grids mt-md-0 mt-4">
								<h3 class="text-white font-weight-bold mb-3">Liên hệ</h3>
								<ul>
									<li class="mb-3">
										<i class="fas fa-map-marker"></i> Tòa nhà Detech Số 8 Tôn Thất Thuyết, TP Hà Nội</li>
										<li class="mb-3">
											<i class="fas fa-mobile"></i> +84.7646302 </li>
											<li class="mb-3">
												<i class="fas fa-phone"></i> 0967962184 </li>
												<li class="mb-3">
													<i class="fas fa-envelope-open"></i>
													<a href="mailto:tiendat184.it@mail.com"> electric.store@gmail.com</a>
												</li>
											</ul>
										</div>
										<div class="col-md-4 col-sm-6 footer-grids w3l-agileits mt-md-0 mt-4">
											<!-- newsletter -->
											<h3 class="text-white font-weight-bold mb-3">Bản tin</h3>
											<p class="mb-3">Giao hàng miễn phí cho đơn hàng đầu tiên của bạn!</p>
											<form action="#" method="post">
												<div class="form-group">
													<input type="email" class="form-control" placeholder="Email" name="email" required="">
													<input type="submit" value="Go">
												</div>
											</form>
											<!-- //newsletter -->
											<!-- social icons -->
											<div class="footer-grids  w3l-socialmk mt-3">
												<h3 class="text-white font-weight-bold mb-3">Theo dõi chúng tôi tại</h3>
												<div class="social">
													<ul>
														<li>
															<a class="icon tw" href="https://www.facebook.com/nguyentiendat18042002" target="_blank">
																<i class="fab fa-facebook-f"></i>
															</a>
														</li>
														<li>
															<a class="icon gp" href="#">
																<i class="fab fa-google-plus-g"></i>
															</a>
														</li>
													</ul>
												</div>
											</div>
											<!-- //social icons -->
										</div>
									</div>
									<!-- //quick links -->
								</div>
							</div>
							<!-- //footer third section -->
							
							<!-- copyright -->
							<div class="copy-right py-3">
								<div class="container">
									<p class="text-center text-white">© 2021 Cửa hàng điện tử. Tất cả các quyền | Thiết kế bởi
										<a href="http://w3layouts.com"> W3layouts</a> và Team 3 Aptech
									</p>
								</div>
							</div>
							<!-- //copyright -->

							@yield('js')	

						</body>

						</html>
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
	<script src="{{ asset('/js/app.js') }}"></script>
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
					<p class="text-white text-lg-left text-center">Trung t??m mua s???m gi?? r???
						<i class="fas fa-shopping-cart ml-1"></i>
					</p>
				</div>
				<div class="col-lg-8">
					<!-- header lists -->
					<ul style="display: flex;list-style-type: none">
						<li class="text-center border-right text-white px-4">
							<a class="play-icon popup-with-zoom-anim text-white" href="#small-dialog1">
								<i class="fas fa-map-marker mr-2"></i>Ch???n ?????a ch???</a>
							</li>
							<li class="text-center border-right text-white px-4">
								<i class="fas fa-phone mr-2"></i> 0 967 962 184
							</li>
							@guest
							@if (Route::has('login'))
							<li class="text-center border-right text-white px-4">
								<a href="{{ route('login') }}" class="text-white">
									<i class="fas fa-sign-in-alt mr-2"></i> ????ng nh???p </a>
								</li>
								@endif

								@if (Route::has('register'))
								<li class="text-center text-white px-4">
									<a href="{{ route('register') }}"  class="text-white">
										<i class="fas fa-sign-out-alt mr-2"></i>????ng k?? </a>
									</li>
									@endif
									@else
									<li class="text-center border-right text-white px-4">
										<a href="{{ route('client_user') }}" class="text-white">Xin ch??o, {{ Auth::user()->name }} 
										(L???ch s??? ????n h??ng)
										</a>
									</li>
									<li class="text-center text-white px-4">
										<a href="{{ route('logout') }}"  class="text-white" onclick="event.preventDefault();
										document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt mr-2"></i>????ng xu???t </a>
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
											<img src="{{ asset('/project/images/logo2.png') }}" alt=" " class="img-fluid">Electric Store
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
											<input class="form-control mr-sm-2" name="s" type="search" placeholder="Nh???p s???n ph???m mu???n t??m..." aria-label="Search">
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
						<h2 class="footer-top-head-w3l font-weight-bold mb-2">Thi???t b??? ??i???n t??? :</h2>
						<p class="footer-main mb-4">
							N???u b???n ??ang c??n nh???c v??? m???t chi???c ??i???n tho???i m???i,
							hay ??ang t??m ki???m m???t chi???c smart-watch ??ng ??, 
							ch??ng t??i s??? gi??p b???n d??? d??ng t??m th???y ch??nh x??c nh???ng g?? b???n c???n v???i m???c gi?? b???n c?? th??? mua ???????c. 
							Ch??ng t??i cung c???p gi?? ??u ????i h??ng ng??y ??? nhi???u thi???t b??? nh?? ??i???n tho???i, ?????ng h??? th??ng minh v?? h??n th??? n???a.
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
										<h3>Mi???n ph?? ship</h3>
										<p>????n h??ng tr??n 20.000.000 VN??</p>
									</div>
								</div>
							</div>
							<div class="col-md-4 offer-footer my-md-0 my-4">
								<div class="row">
									<div class="col-4 icon-fot">
										<i class="fas fa-shipping-fast"></i>
									</div>
									<div class="col-8 text-form-footer">
										<h3>V???n chuy???n nhanh</h3>
										<p>xuy??n l???c ?????a</p>
									</div>
								</div>
							</div>
							<div class="col-md-4 offer-footer">
								<div class="row">
									<div class="col-4 icon-fot">
										<i class="far fa-thumbs-up"></i>
									</div>
									<div class="col-8 text-form-footer">
										<h3>L???a ch???n ????ng ?????n</h3>
										<p>m???i s???n ph???m</p>
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
								<h3 class="text-white font-weight-bold mb-3">Danh m???c</h3>
								<ul>
									<li class="mb-3">
										<a href="{{ route('client_product') }}">??i???n tho???i</a>
									</li>
									<li class="mb-3">
										<a href="{{ route('client_product') }}">Smart Watch</a>
									</li>
									<li class="mb-3">
										<a href="{{ route('client_product') }}">M??y t??nh x??ch tay</a>
									</li>
								</ul>
							</div> -->
							<!-- //footer categories -->
							<!-- quick links -->
							<div class="col-md-4 col-sm-6 footer-grids mt-sm-0 mt-4">
								<h3 class="text-white font-weight-bold mb-3">Li??n k???t nhanh</h3>
								<ul>
									<li class="mb-3">
										<a href="{{ route('client_about') }}">V??? ch??ng t??i</a>
									</li>
									<li class="mb-3">
										<a href="{{ route('client_contact') }}">Li??n l???c ngay</a>
									</li>
									<li class="mb-3">
										<a href="{{ route('client_help') }}">H??? tr???</a>
									</li>
									<li class="mb-3">
										<a href="{{ route('client_faqs') }}">Th???c m???c v?? gi???i ????p</a>
									</li>
									<li class="mb-3">
										<a href="{{ route('client_terms') }}">??i???u kho???n s??? d???ng</a>
									</li>
									<li>
										<a href="{{ route('client_privacy') }}">Ch??nh s??ch b???o m???t</a>
									</li>
								</ul>
							</div>
							<div class="col-md-4 col-sm-6 footer-grids mt-md-0 mt-4">
								<h3 class="text-white font-weight-bold mb-3">Li??n h???</h3>
								<ul>
									<li class="mb-3">
										<i class="fas fa-map-marker"></i> T??a nh?? Detech S??? 8 T??n Th???t Thuy???t, TP H?? N???i</li>
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
											<h3 class="text-white font-weight-bold mb-3">B???n tin</h3>
											<p class="mb-3">Giao h??ng mi???n ph?? cho ????n h??ng ?????u ti??n c???a b???n!</p>
											<form action="#" method="post">
												<div class="form-group">
													<input type="email" class="form-control" placeholder="Email" name="email" required="">
													<input type="submit" value="Go">
												</div>
											</form>
											<!-- //newsletter -->
											<!-- social icons -->
											<div class="footer-grids  w3l-socialmk mt-3">
												<h3 class="text-white font-weight-bold mb-3">Theo d??i ch??ng t??i t???i</h3>
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
									<p class="text-center text-white">?? 2021 C???a h??ng ??i???n t???. T???t c??? c??c quy???n | Thi???t k??? b???i
										<a href="http://w3layouts.com"> W3layouts</a> v?? Team 3 Aptech
									</p>
								</div>
							</div>
							<!-- //copyright -->

							@yield('js')	

						</body>

						</html>
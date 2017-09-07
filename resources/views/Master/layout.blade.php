<!DOCTYPE html>
<html lang="zh-CN.utf-8">
	<head>
		<meta charset="utf-8">
		<meta name="keywords" conent="商会 澳洲 上海">
		<meta name="language" content="cn">
		<meta name="content-language" content="cn">
	 	<title>{{ $title }}</title>

		<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	 	<link rel="stylesheet" href="/css/bootstrap.min.css" />
	 	<link rel="stylesheet" href="/css/non-responsive.css" />
	 	<link rel="stylesheet" href="/css/style.css" />
	 	@yield('header')
	</head>

	<body>

		<div class="header">
			<div class="container">
				<div class="logo">
					<img width="88" height="110" src="/img/logo1.png" style="margin-top:5px;"/>
	            </div>
	            <div class="navigation">
					<nav class="navbar-collapse collapse" role="navigation">
		                <ul class="nav navbar-nav navbar-main">

		                        <li class="{{ ($nav == 1)?'active':'' }}">
	                                    <a title="首页" href="{{ url('/') }}">
		                                        首页
		                                        <span class="bar"></span>
		                                    </a>
		                        </li>

		                        <li class="{{ ($nav == 2)?'active':'' }}">

		                                    <a title="商会活动" href="{{ url('/event') }}">
		                                        商会活动
		                                        <span class="bar"></span>
		                                    </a>

		                        </li>

		                        <li class="{{ ($nav == 3)?'active':'' }}">

		                                    <a title="会员申请" href="{{ url('/member-registration ') }}">
		                                      	会员申请
		                                        <span class="bar"></span>
		                                    </a>

		                        </li>

		                        <li class="{{ ($nav == 4)?'active':'' }}">

		                                    <a href="{{ url('/aboutus') }}" title="关于我们">
		                                        关于我们
		                                        <span class="bar"></span>
		                                    </a>
		                        </li>
		                </ul>
		            </nav>
	            </div>
	            </div>
			</div>

		<div class="container">

			@yield('content')

		</div>

		<!-- footer -->
		<footer class="footer">
			<div class="container">
				<ul class="footer-menu">
					<li class="column">
						<span class="footer-title">友情链接</span>
						<ul class="footer-menu-inner">
							<li>
								<a href="#">友情链接1</a>
							</li>
							<li>
								<a href="#">友情链接2</a>
							</li>
							<li>
								<a href="#">友情链接3</a>
							</li>
							<li>
								<a href="#">友情链接4</a>
							</li>
						</ul>
					</li>
					<li class="column">
						<span class="footer-title">友情赞助</span>
						<ul class="footer-menu-inner">
							<li><a href="#">友情赞助1</a></li>
							<li><a href="#">友情赞助2</a></li>
							<li><a href="#">友情赞助3</a></li>
							<li><a href="#">友情赞助4</a></li>
						</ul>
					</li>
					<li class="column">
						<span class="footer-title">合作伙伴</span>
						<ul class="footer-menu-inner">
							<li><a href="#">合作伙伴1</a></li>
							<li><a href="#">合作伙伴2</a></li>
							<li><a href="#">合作伙伴3</a></li>
							<li><a href="#">合作伙伴4</a></li>
						</ul>
					</li>
					<li class="column">
						<span class="footer-title">联系我们</span>
						<ul class="footer-menu-inner">
							<li></li>
							<li></li>
							<li></li>
							<li></li>
						</ul>
					</li>
				</ul>

				<div class="copyright">
					<div class="break-line"></div>
					<p>@copyright 2016</p>
				</div>
			</div>
		</footer>

		<script type="text/javascript" src="/js/jquery.min.js"></script>
		<script type="text/javascript" src="/js/bootstrap.min.js"></script>

		@yield('footer')
	</body>
</html>

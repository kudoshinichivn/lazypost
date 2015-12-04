
<!DOCTYPE HTML>
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<title>LazySales</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:image" content="{{ URL::asset('images/og_image_fb.jpg') }}" />
<link rel="shortcut icon" href="{{ URL::asset('images/favicon.ico') }}" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/uikit.almost-flat.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/uikit.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/components/progress.almost-flat.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/components/progress.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/components/progress.gradient.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/components/datepicker.almost-flat.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/components/datepicker.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/components/datepicker.gradient.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/components/autocomplete.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/components/accordion.almost-flat.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/components/accordion.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/components/accordion.gradient.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/components/form-file.almost-flat.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/components/form-file.min.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/components/form-file.gradient.min.css') }}"/>



<script type="text/javascript" src="{{ URL::asset('js/uikit.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/lazysales.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/components/datepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/components/timepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/components/autocomplete.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/components/accordion.min.js') }}"></script>



</head>
<body>
<header class="wrapper">
	<div class="uk-width-1-1">
		<div class="uk-grid">
			<div class="uk-width-1-1 uk-width-medium-1-3 uk-width-small-1-1 uk-text-center"><a href="<?php Config::get('facebook.redirect_url');?>"><img src="{{ URL::asset('images/lazypost.png') }}"/></a></div>
			<div style="padding-top: 1%;" class="uk-width-1-1 uk-width-medium-1-2 uk-width-small-1-1 uk-text-middle">
			@section('sidebar')
           	
        	@show
        	</div>
		</div>
	</div>
</header>

	@section('content')
     
    @show

		
<footer class="wrapper">
	<div class="uk-width-1-1">
	<div class="uk-grid">
		<div style="padding: 1% 0 1% 10%;" class="uk-width-1-1 uk-width-medium-1-2 uk-width-small-1-1 uk-text-middle">
			<div class="uk-text-left">
			<p>
			<p>
			<p>
			<span><i class="uk-icon-support"></i> <?php echo Lang::get('lazysales.support'); ?></span><br>
			<span><i class="uk-icon-envelope"></i> <?php echo Lang::get('lazysales.email'); ?>: support@lazysales.net</span><br>
			<span><i class="uk-icon-phone"></i> <?php echo Lang::get('lazysales.hotline'); ?>: 0934530808</span><br>
			</div>
			
		</div>
		<div style="padding: 1% 0 1% 10%;" class="uk-width-1-1 uk-width-medium-1-2 uk-width-small-1-1 uk-text-middle">
			<div style="margin-left:3%;" class="uk-text-left">
			<p>
			<p>
			<p>
			<span><i class="uk-icon-language"></i> Language: <a onclick="language('en');">English</a>-<a onclick="language('vi');">Vietnamese</a></span>
			<p>
			<p>
			<span>LazyPost Copyright <i class="uk-icon-copyright"></i> 2015 All rights reserved.</span>
			
			
			
			</div>
		
		</div>
		
	</div>
	</div>
</footer>

</body>
</html>

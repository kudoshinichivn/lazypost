

<!DOCTYPE HTML>
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>

<title>LazySales</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta property="og:image" content="../public/images/og_image_fb.jpg" />
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="../public/css/uikit.almost-flat.min.css"/>
<link rel="stylesheet" type="text/css" href="../public/css/uikit.min.css"/>
<link rel="stylesheet" type="text/css" href="../public/css/style.css"/>
<link rel="stylesheet" type="text/css" href="../public/css/components/progress.almost-flat.min.css"/>
<link rel="stylesheet" type="text/css" href="../public/css/components/progress.min.css"/>
<link rel="stylesheet" type="text/css" href="../public/css/components/progress.gradient.min.css"/>
<script type="text/javascript" src="../public/js/uikit.min.js"></script>
<script type="text/javascript" src="../public/js/lazysales.js"></script>
</head>
<body>
<script type="text/javascript">
 function login(){
            var  screenX    = typeof window.screenX != 'undefined' ? window.screenX : window.screenLeft,
                 screenY    = typeof window.screenY != 'undefined' ? window.screenY : window.screenTop,
                 outerWidth = typeof window.outerWidth != 'undefined' ? window.outerWidth : document.body.clientWidth,
                 outerHeight = typeof window.outerHeight != 'undefined' ? window.outerHeight : (document.body.clientHeight - 22),
                 width    = 600,
                 height   = 500,
                 left     = parseInt(screenX + ((outerWidth - width) / 2), 10),
                 top      = parseInt(screenY + ((outerHeight - height) / 2.5), 10),
                 features = (
                    'width=' + width +
                    ',height=' + height +
                    ',left=' + left +
                    ',top=' + top
                  );
 
            var newwindow=window.open('<?php echo $login_url; ?>','Login by Facebook',features);
 
           if (window.focus) {newwindow.focus()}
          return false;
        }       
        

        
 
    
</script>
<header class="wrapper">
	<div class="uk-width-1-1">
	<div class="uk-grid">
		<div class="uk-width-1-1 uk-width-medium-1-3 uk-width-small-1-1 uk-text-center"><a href=""><img src="../public/images/lazypost.png"/></a></div>
		<div style="padding: 0 0 0 20%;" class="uk-width-1-1 uk-width-medium-1-2 uk-width-small-1-1 uk-text-middle uk-text-center">
			<p>
			<p>
			<p>
			<div class="fb-like" data-href="https://www.facebook.com/pages/LazySales/846085282142272" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
			<p>
		</div>
	</div>
	</div>
</header>
<div class="consit">
<content class="wrapper">
	<div class="uk-width-1-1">
		<div class="uk-grid">
				
				<div class="uk-width-1-1 uk-width-medium-1-2 uk-width-small-1-1 uk-text-middle">
					<div class="uk-cover video" style="height: 350px;">
						<iframe data-uk-cover="" src="https://www.youtube.com/embed/yR8yuS_U2s0?autoplay=1&amp;controls=0&amp;showinfo=0&amp;rel=0&amp;loop=1&amp;modestbranding=1&amp;wmode=transparent&amp;enablejsapi=1&amp;api=1" width="550" height="300" frameborder="0" allowfullscreen="" style="width: 534px; height: 300px;"></iframe>
					</div>					
				</div>
				<div style="padding-top:5%" class="uk-width-1-1 uk-width-medium-1-2 uk-width-small-1-1 uk-text-middle">
					<h3 class="slogan2"><?php echo Lang::get('lazysales.slogan_lazypost'); ?></h3>
					<a onclick="login();"><img src="images/tryitfreetoday.png"/><img src="images/btn_login.png"/></a>
				</div>
		</div>
	</div>
	
</content>
</div>

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
			<span>LazySales Copyright <i class="uk-icon-copyright"></i> 2015 All rights reserved.</span>
			
			
			
			</div>
		
		</div>
		
	</div>
	</div>
</footer>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=587413424733329";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</body>

</html>

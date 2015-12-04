@extends('LazySales.layout')

@section('sidebar')
    
    <div style="margin-top:3%;" class="fb-like" data-href="https://www.facebook.com/pages/LazySales/846085282142272" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
@stop

@section('content')

<div class="consit">
<content>
	<div class="uk-width-1-1">
		<div class="uk-grid">
				
				<div class="uk-width-1-1 uk-width-medium-1-2 uk-width-small-1-1 uk-text-middle">
					<div class="uk-cover video" style="height: 350px;">
						<iframe data-uk-cover="" src="https://www.youtube.com/embed/yR8yuS_U2s0?autoplay=1&amp;controls=0&amp;showinfo=0&amp;rel=0&amp;loop=1&amp;modestbranding=1&amp;wmode=transparent&amp;enablejsapi=1&amp;api=1" width="550" height="300" frameborder="0" allowfullscreen="" style="width: 534px; height: 300px;"></iframe>
					</div>					
				</div>
				<div style="padding-top:5%" class="uk-width-1-1 uk-width-medium-1-2 uk-width-small-1-1 uk-text-middle">
					<h3 class="slogan2"><?php echo Lang::get('lazysales.slogan_lazypost'); ?></h3>
					<a onclick="login();"><img src="{{ URL::asset('images/tryitfreetoday.png') }}"/><img src="{{ URL::asset('images/btn_login.png') }}"/></a>
				</div>
		</div>
	</div>
</content>	
</div>
@stop

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3&appId=587413424733329";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


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
 
            var newwindow=window.open('{{$login_url}}','Login by Facebook',features);
 
           if (window.focus) {newwindow.focus()}
          return false;
        }       
        

        
 
    
</script>
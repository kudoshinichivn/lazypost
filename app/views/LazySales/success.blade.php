@extends('LazySales.layout')

<script type="text/javascript">window.onload=function(){loadpages();};</script>
@section('sidebar')
    
    <ul style='margin-top:2%;' class="navibar">
		<li><button data-uk-modal="{target:'#pricing'}" class="uk-button uk-button-small uk-button-success" type="button">{{Lang::get('lazysales.plans_and_pricing')}}</button></li>
		<li><a data-uk-modal="{target:'#help'}"><i class="uk-icon-flag"></i> {{ Lang::get('lazysales.help')}}</a></li>
		<li><a onclick="loadhistory(); UIkit.offcanvas.show('#history');"><i class="uk-icon-history"></i> {{ Lang::get('lazysales.history')}}</a></li>
		<li><a href="{{Config::get('facebook.redirect_url').'/logout'}}"><i class="uk-icon-sign-out"></i> {{ Lang::get('lazysales.logout')}}</a></li>
		
	</ul>	
@stop

@section('content')
<form id="myform" action="" method="post" enctype="multipart/form-data" onsubmit="return nosubmit();">
<content class="wrapper" >
	<div class="uk-width-1-1">
		<div class="uk-grid">
			<div class="uk-width-1-1 uk-width-large-1-4 uk-width-medium-1-4 uk-hidden-small"></div>	
			<div class="uk-width-1-1 uk-width-large-1-2 uk-width-medium-1-2 uk-width-small-1-1 uk-container-center">
				<h3 class="tittle">{{ Lang::get('lazysales.step1')}}</h3>
				<ul class="uk-tab uk-width-medium-1-1" data-uk-tab="">
					<li class="uk-active" aria-expanded="true"><a onclick="show_post();">
					<i class="uk-icon-pencil-square-o"></i> {{ Lang::get('lazysales.post')}}</a></li>
					
					<li class="" aria-expanded="false"><a onclick="show_album();">
					<i class="uk-icon-photo"></i> {{ Lang::get('lazysales.create_photo_album')}}</a></li>
					
					
					
				</ul>
				<div class="content-bg">
					<div class="uk-form" id="post"> 
					
						<div class="uk-form-row"><textarea class="message" id="message" rows="4" name="message" placeholder="{{ Lang::get('lazysales.write_something')}}"></textarea></div>
						<div class="uk-form-row"><div class="uk-form-icon uk-width-1-1"><i class="uk-icon-link"></i><input type="text" name="link" id="link" class="link" placeholder="{{ Lang::get('lazysales.enter_link_here')}}"/></div></div>
						<div class="uk-form-row">
						
							<div class="uk-grid">
								<div class="uk-form-file" style="padding-right:0px;">
									
									<button class="uk-button uk-button-primary">{{ Lang::get('lazysales.select_image')}}</button>
									
									<input onchange="upload(this.form);" name="image" id="image" type="file">
								</div>
								<div>
									<label id="loading_image" style="display:none;"><img  src='images/loading_mini.gif' width="35" height="35"/>{{ Lang::get('lazysales.uploading_image')}}</label>
									<label id="loaded_image"></label>
								</div>
							</div>
							
							
								
						</div>	
						
						
					
					</div>
					<div class="uk-form" id="album" style="display:none;"> 
						<div class="uk-form-row"><input type="text" name="album_tittle" id="album_tittle" class="link" placeholder="{{ Lang::get('lazysales.enter_album_tittle')}}"/></div>
						<div class="uk-form-row"><textarea class="message" id="album_decription" rows="4" name="album_decription" placeholder="{{ Lang::get('lazysales.enter_album_decrip')}}"></textarea></div>
						
						<div class="uk-form-row">
						
							<div class="uk-grid">
								
								<div class="uk-form-file" style="padding-right:0px;">
									
									<button class="uk-button uk-button-primary">{{ Lang::get('lazysales.select_image')}}</button>
									
									<input onchange="upload_album(this.form);" name="images[]" id="images" type="file" multiple />
								</div>
								
								<div>
									<label id="loading_album" style="display:none;"><img  src='../public/images/loading_mini.gif' width="35" height="35"/>{{ Lang::get('lazysales.uploading_image')}}</label>
									
								</div>
								
							</div>
							
							
								
						</div>
						<div id="list_images"  class="uk-form-row" style="display:none;">
							<div class="uk-scrollable-box" >
								<div id="images_preview">
								</div>	
							</div>	
						
						</div>
						
						
					
					</div>
				</div>
				<h3 class="tittle">{{ Lang::get('lazysales.step2')}}</h3>
				<ul class="uk-tab uk-width-medium-1-1" data-uk-tab="">
					<li class="uk-active" aria-expanded="true"><a onclick="loadpages();" >
					<i class="uk-icon-file"></i> {{ Lang::get('lazysales.page')}}</a></li>
					<li class="" aria-expanded="false"><a onclick="loadgroups();">
					
					<i class="uk-icon-group"></i> {{ Lang::get('lazysales.group')}}</a></li>
					
				</ul>
				<div class="content-bg">
					<div class="list">	
						<div class="uk-scrollable-box">
							<table id="listcheck" border="0">
								<tbody id="list">
									<div style="margin: 5% auto; display:none;" id="loading_node" class='uk-text-center'>
										<span class='tittle'><img src='images/loading2.gif'/> {{ Lang::get('lazysales.loading_data')}}</span>
									</div>

								
								
								
								
								</tbody>
							</table>
						</div>
						<div class="uk-form-row"></div>
						<div class="uk-form-row"></div>
							
						<label class="uk-text-bold uk-text-danger"><input type="checkbox" id="checkall" value="checkall"> {{ Lang::get('lazysales.select_all')}}</label>				
					</div>
					
				</div>
				<div id="btn_page" style="float:right;" class="uk-margin">
					<div class="uk-button-group">
						
						<button data-uk-modal="{target:'#processbox'}" onclick="post_page();" class="uk-button uk-button-large class uk-button-primary btn"><i class="uk-icon-facebook-square"></i> {{ Lang::get('lazysales.post_now');?></button>
						<button onclick="show_schedule();" data-uk-modal="{target:'#processbox'}" class="uk-button uk-button-large class uk-button-primary btn2"><i class="uk-icon-calendar"></i> {{ Lang::get('lazysales.schedule');?></button>
					</div>
				</div>
				<div id="btn_group" style="float:right;" class="uk-margin">
					
						
						<button  data-uk-modal="{target:'#processbox'}" onclick="post_group();" class="uk-button uk-button-large class uk-button-primary btn"><i class="uk-icon-facebook-square"></i> {{ Lang::get('lazysales.post_now');?></button>
						
				
				</div>
				<div id="btn_album" style="float:right;" class="uk-margin">
					
						
						<button  data-uk-modal="{target:'#processbox'}" onclick="post_album(this.form);" class="uk-button uk-button-large class uk-button-primary btn"><i class="uk-icon-image"></i> {{ Lang::get('lazysales.create_photo_album');?></button>
						
				
				</div>
				
			</div>
			<div class="uk-width-1-1 uk-width-large-1-4 uk-width-medium-1-4 uk-hidden-small"></div>					
		</div>
				
	</div>
	
</content>
</form>

@stop

<div id="processbox" class="uk-modal">
	<div class="uk-modal-dialog">
		<a class="uk-modal-close uk-close uk-close-alt"></a>
		<div id="datetimepicker" class="uk-width-1-1 uk-form">
			<div class="uk-grid">
				<div class="uk-width-2-3">
					
					<p><input placeholder="{{ Lang::get('lazysales.setdate');?>" id="date" type="text" data-uk-datepicker="{weekstart:0, format:'YYYY/MM/DD'}"></p>
					
					<p><input placeholder="{{ Lang::get('lazysales.settime');?>" id="time" type="text" data-uk-timepicker="{format:'24h'}"></p>
					
					
				</div>
				<div class="uk-width-1-3">
				<p><button style="width:100px; height:80px;" onclick="schedule_page();" class="uk-button uk-button-primary btn"> <i class="uk-icon-facebook"></i> <span> {{ Lang::get('lazysales.schedule');?></span></button></p>
				
				
				</div>
			</div>
		
		</div>
		<h3 class="tittle"><p id="process"></p><p id="log"></p></h3><h3><p id="log2"></p></h3>
		<div id="processbar1" class="uk-progress uk-progress-striped uk-active" style="display:none">
			  <div id="processbar2" class="uk-progress-bar" style="display:none"></div>
		</div>
	</div>
</div>


<div id="help" class="uk-modal">
	<div class="uk-modal-dialog">
		
		<a  class="uk-modal-close uk-close uk-close-alt"></a>
		<p>
		<p>
		<div class="uk-accordion" data-uk-accordion="">

			<h3 class="uk-accordion-title">{{ Lang::get('lazysales.how_to_post');?></h3>
			<div data-wrapper="true" style="height: 0px; position: relative; overflow: hidden;" aria-expanded="false"><div class="uk-accordion-content">
				<p>
					<div class="uk-cover video" style="height: 350px;">
						<iframe data-uk-cover="" src="https://www.youtube.com/embed/v26ZKpTTH8M?autoplay=0&amp;controls=0&amp;showinfo=0&amp;rel=0&amp;loop=1&amp;modestbranding=1&amp;wmode=transparent&amp;enablejsapi=1&amp;api=1" width="550" height="300" frameborder="0" allowfullscreen="" style="width: 534px; height: 300px;"></iframe>
					</div>
				</p>
			</div></div>
			<h3 class="uk-accordion-title">{{ Lang::get('lazysales.how_to_schedule');?></h3>
			<div data-wrapper="true" style="height: 0px; position: relative; overflow: hidden;" aria-expanded="false"><div class="uk-accordion-content">
				<p>
					<div class="uk-cover video" style="height: 350px;">
						<iframe data-uk-cover="" src="https://www.youtube.com/embed/tv1TlMBehIk?autoplay=0&amp;controls=0&amp;showinfo=0&amp;rel=0&amp;loop=1&amp;modestbranding=1&amp;wmode=transparent&amp;enablejsapi=1&amp;api=1" width="550" height="300" frameborder="0" allowfullscreen="" style="width: 534px; height: 300px;"></iframe>
					</div>
					
				</p>
			</div></div>

		</div>
	
	</div>
</div>


<div id="history" class="uk-offcanvas" ondblclick="UIkit.offcanvas.hide([force = false])" >
	<div class="uk-offcanvas-bar">
		<div class="uk-width-1-1 header">
			<img src="images/history-header.png"/>
		</div>
		<div style="margin: 5% auto;" id="loading_history" class='uk-text-center'><span class='tittle'><img src='images/loading2.gif'/> {{ Lang::get('lazysales.loading_data')}}</span></div>
		<div style="padding:3%;" id="log_history"></div>
	</div>	
</div>

<div id="pricing" class="uk-modal">
	
	<div class="uk-modal-dialog">
		<a class="uk-modal-close uk-close uk-close-alt"></a>
		<h3 class="tittle">{{ Lang::get('lazysales.lazy_post_is_in_time_trial')}}</h3>
		
	</div>
</div>



<script type='text/javascript'> var list_images={{json_encode($list_images)}};</script>

<?php
foreach ($list_images as $name) 
	{
	
		?>
		
			<div class='uk-form-row'><div class='uk-grid'>
			<div class='uk-width-1-3'>
			<img style='border: 1px soild #000;' width='200' heigh='150' class='uk-border-rounded' src="{{URL::asset('temp/'.$name)}}"/>
			</div>
			<div class='uk-width-2-3'>
			<textarea style='width:100%' type='text' id="{{$name}}" name="{{$name}}" placeholder="{{Lang::get('lazysales.image_decrip')}}"></textarea>
			</div></div></div>
			<br>
		<?php
	}


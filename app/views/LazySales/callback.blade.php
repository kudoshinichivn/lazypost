<?php
if ($result==true) {
	?>
		<script type='text/javascript'>
			window.close();
			window.opener.location.href='{{$url}}';
		</script>
	<?php
}
else
{
	?>
		<script type='text/javascript'>
			window.close();		
		</script>
	<?php
}


						
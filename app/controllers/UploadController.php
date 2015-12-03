<?php

class UploadController extends BaseController {

	public function upload(){
		if (Input::hasFile('image'))
		{	
			
			$name = Input::file('image')->getClientOriginalName();
			$extension = Input::file('image')->getClientOriginalExtension();
			$size = Input::file('image')->getSize(); //byte
			if($extension=="jpg" || $extension =="png" && $size <=2097152)
			{
				Input::file('image')->move('../public/temp',$name);
				echo Lang::get('lazysales.image_loaded_success')." <i class='uk-icon-check-circle'></i>";
				Session::put('image', $name);
				
			}
			else
				echo Lang::get('lazysales.image_loaded_fail')." <i class='uk-icon-close'></i>";
		}
		else
			echo Lang::get('lazysales.image_loaded_fail')." <i class='uk-icon-close '></i>";
	}
	public function upload_album(){	
			echo "<script>
				var list_images=[];
				
				</script>";
				
			foreach (Input::file('images') as $image) {
				
				
				$size =  $image->getSize();
				$name = $image->getClientOriginalName();
				$extension = $image->getClientOriginalExtension();
				if($size > 0 && $size <=2097152)
				{
					
					
					if($extension=="jpg" || $extension =="png")
					{
						
						$image->move('../public/temp',$name);
						
						echo "
						<div class='uk-form-row'><div class='uk-grid'>
						<div class='uk-width-1-3'>
						<img style='border: 1px soild #000;' width='200' heigh='150' class='uk-border-rounded' src='../public/temp/".$name."'/>
						</div>
						<div class='uk-width-2-3'>
						<textarea style='width:100%' type='text' id='".$name."' name='".$name."' placeholder='".Lang::get('lazysales.image_decrip')."'></textarea>
						</div></div></div>
						<br>
						<script>
						list_images.push('".$name."');
						
						</script>
						";
					}
					else 
						echo "
						<div class='uk-form-row'><div class='uk-grid'>
						<div class='uk-width-1-3'>
						<img style='border: 1px soild #000;' width='200' heigh='150' class='uk-border-rounded' src='../public/images/alert.png'/>
						</div>
						<div class='uk-width-2-3'>
						 ".Lang::get('lazysales.could_not_uploaded_image')."<b>".$name."</b><br>
						 ".Lang::get('lazysales.reason').": ".Lang::get('lazysales.file_is_not_image')."
						</div></div></div><br>";
				}
				else 
					echo "
						<div class='uk-form-row'><div class='uk-grid'>
						<div class='uk-width-1-3'>
						<img style='border: 1px soild #000;' width='200' heigh='150' class='uk-border-rounded' src='../public/images/alert.png'/>
						</div>
						<div class='uk-width-2-3'>
						 ".Lang::get('lazysales.could_not_uploaded_image')."<b>".$name."</b><br>
						 ".Lang::get('lazysales.reason').": ".Lang::get('lazysales.file_too_heavy')."
						</div></div></div><br>";
				

			}
			
		
		
			
	}
}
?>

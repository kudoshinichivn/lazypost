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
				
				if(Session::has('image'))
					Session::forget('image');
				
				Session::put('image', $name);
				
				return Lang::get('lazysales.image_loaded_success')." <i class='uk-icon-check-circle'></i>";
				
			}
			else
				return Lang::get('lazysales.image_loaded_fail')." <i class='uk-icon-close'></i>";
		}
		else
			return Lang::get('lazysales.image_loaded_fail')." <i class='uk-icon-close '></i>";
	}
	public function upload_album(){	
			
			$list_images_success=array();
			$list_images_fail=array();
			$list_images_fail2=array();	
			foreach (Input::file('images') as $image) {
				
				
				$size =  $image->getSize();
				$name = $image->getClientOriginalName();
				$extension = $image->getClientOriginalExtension();
				if($size > 0 && $size <=2097152)
				{
					
					
					if($extension=="jpg" || $extension =="png")
					{
						
						$image->move('../public/temp',$name);
						$list_images_success[]=$name;
						
						
					}
					else 
						
						$list_images_fail[]=$name;
				}
				else 
					
					$list_images_fail2[]=$name;
			
			}
			
			return View::make('LazySales.upload_album',array('list_images_success' =>$list_images_success,'list_images_fail'=>$list_images_fail,'list_images_fail2'=>$list_images_fail2));
			
		
			
	}
}
?>

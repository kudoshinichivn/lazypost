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
			
			$list_images=array();
			foreach (Input::file('images') as $image) {
				
				
				$size =  $image->getSize();
				$name = $image->getClientOriginalName();
				$extension = $image->getClientOriginalExtension();
				if($size > 0 && $size <=2097152)
				{
					
					
					if($extension=="jpg" || $extension =="png")
					{
						
						$image->move('../public/temp',$name);
						$list_images[]=$name;
						
						
					}
					
				}
				
			
			}
			
			return View::make('LazySales.upload_album',array('list_images' =>$list_images));
			
		
			
	}
}
?>

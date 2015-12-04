<?php
class AlbumController extends BaseController {
	public function create_album(){
		$fb=LazySalesHelper::fb();
		$fbApp=LazySalesHelper::fbApp();
		$accessToken;
		if(Input::has('access_token'))
			$accessToken=Input::get('access_token');
		else
			$accessToken=$_SESSION['accessToken'];

		
			
			try{
				$request = new Facebook\FacebookRequest($fbApp, $accessToken, 'POST', '/'.Input::get('node').'/albums',
					array(
					'name'=>Input::get('album_tittle'),
					'message'=>Input::get('album_decription')
					
				));
				$response = $fb->getClient()->sendRequest($request);
				$album_id = $response->getGraphNode()->getProperty('id');
				
				$list_decrip=Input::get('list_decrip');
				foreach(Input::get('list_images') as $key => $value)
				{
					$request = new Facebook\FacebookRequest($fbApp, $accessToken, 'POST', '/'.$album_id.'/photos',
						array(
							//'url' => '../public/temp/'.$value,
							'source' => $fb->fileToUpload('../public/temp/'.$value),
							'message' => $list_decrip[$key]
					));
					$response = $fb->getClient()->sendRequest($request);
				}
		
			
			}
			catch(Facebook\Exceptions\FacebookResponseException $e) {
			  // When Graph returns an error
			  echo 'Graph returned an error: ' . $e->getMessage();
			  exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
			  // When validation fails or other local issues
			  echo 'Facebook SDK returned an error: ' . $e->getMessage();
			  exit;
			}
		
	}
}
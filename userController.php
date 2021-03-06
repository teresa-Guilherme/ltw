<?php
	session_start();
	
	include_once('connection.php');
	include_once('userRegistration.php');
	include_once('userLogin.php');
	include_once('comment.php');
	include_once('gallery.php');
	
	$response_array['status'] = 'serverIssues';
	
	$data = file_get_contents('php://input');
	if(isset($data)){
		$jsonData = json_decode($data);
		
		switch($jsonData->dicionario){
		case 'createUser':
			if(existUser($dbh,$jsonData->username,$jsonData->email)==0){
				if(createUser($dbh,$jsonData->name, $jsonData->username,$jsonData->age,$jsonData->email,$jsonData->password)==0)
					$response_array['status'] = 'success';
			}
			else $response_array['status'] = 'userExists';
			break;
		
		case 'loginUser':
					if(checkLogin($dbh,$jsonData->username,$jsonData->password)==0){
						$response_array['status'] = 'success';
						$_SESSION['username'] = $jsonData->username;
					}
			
			break;
			
		case 'logoutUser':
			if(isset($_SESSION['username']))
			{	
				session_unset();
				session_destroy();
				$response_array['status'] = 'success';
			}
			break;
			
		case 'loggedUser':
			if(isset($_SESSION['username']))
			{	
				if(($response_array['info']=userInfo($dbh,$_SESSION['username']))!=null)
					$response_array['status'] = 'success';
			}
			else $response_array['status'] = 'not';
			break;
			
		case 'amILogged':
			if(isset($_SESSION['username'])&&$_SESSION['username']==$jsonData->user)
			{	
				$response_array['status'] = 'success';
			}else  $response_array['status'] = 'userNotLogged';
			break;
		
		case 'userInfo':
			if(($response_array['info']=userInfo($dbh,$jsonData->user))!=null){
				$response_array['status']='success';
				if(isset($_SESSION['username'])&&$_SESSION['username']==$jsonData->user)
				{	
					$response_array['myUser'] = true;
				}else $response_array['myUser'] = false;
			}else $response_array['status']='notFound';
			break;
			
		case 'updateUser':
			session_regenerate_id(true);
			if(isset($_SESSION['username']) && $_SESSION['username']==$jsonData->user)
			{	
				if(updateUser($dbh,$jsonData->name,$jsonData->user,$jsonData->age,$jsonData->email,$jsonData->imgSrc)==0)
					$response_array['status'] = 'success';
			}else  $response_array['status'] = 'userNotLogged';
			break;
		
		case 'changePass':
			session_regenerate_id(true);
			if(isset($_SESSION['username']) && $_SESSION['username']==$jsonData->user)
			{	
				if(checkLogin($dbh,$jsonData->user,$jsonData->oldPass)==0){
					if(updatePass($dbh,$jsonData->user,$jsonData->newPass)==0){
						$response_array['status']='success';
					}
				}else  $response_array['status'] = 'wrongPass';
			}
			break;
			
		case 'markFav':
			session_regenerate_id(true);
			if(isset($_SESSION['username']))
			{	
				if(updateFav($dbh,$_SESSION['username'],$jsonData->id)==0)
						$response_array['status']='success';
				
			}else  $response_array['status'] = 'notLogged';
			break;
			
		case 'postComment':
			if(isset($_SESSION['username']))
			{	
				if(postComment($dbh,$_SESSION['username'],$jsonData->id,$jsonData->comment)==0)
						$response_array['status']='success';
				
			}else  $response_array['status'] = 'notLogged';
			break;	
			
		case 'postPhoto':
		
			if(isset($_SESSION['username']))
			{	
				if(postPhoto($dbh,$jsonData->restaurant,$jsonData->imgSrc,$_SESSION['username'])==0)
						$response_array['status']='success';
				
			}else  $response_array['status'] = 'notLogged';
			break;	
			
		}
		
		
		
	}
	echo json_encode($response_array);
?>
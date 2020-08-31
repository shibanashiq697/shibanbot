<?php
@ini_set("output_buffering", "Off");
@ini_set('implicit_flush', 1);
@ini_set('zlib.output_compression', 0);
@ini_set('max_execution_time',1200);
header( 'Content-type: text/html; charset=utf-8' );

include 'instagram.php';


if(isset($_GET['username'],$_GET['password']))
{ 	
	//$post = Login($_GET['username'], $_GET['password']);
	$username =$_GET['username'];
	$password =$_GET['password'];
$ua = iphone();
$phoneid=generate_guid(true);
$crstoken=get_csrftoken();
$guid=generate_guid(true);
$deviceid=generate_device_id(true);
$uuid=generate_guid(true);

		$devid = generate_device_id(true);
        $login = json_encode([
            'phone_id' => $phoneid,
            '_csrftoken' => $crstoken,
            'username' => $username,
            'guid' => $guid,
            'device_id' => $deviceid,
            'password' => $password
            
      ]);
        $login = proccess(1, $ua, 'accounts/login/', 0, hook($login));
		$data = json_decode($login[1]);
		if($data->status<>'ok')
		{
			
		
			die(json_encode(array('status' => 'fail', 'message' => 'Status: Username and Password wrong!', 'cookie' => 'null', 'ip' => $ip))); 	}else{
			preg_match_all('%Set-Cookie: (.*?);%',$login[0],$d);$cookie = '';
			for($o=0;$o<count($d[0]);$o++)$cookie.=$d[1][$o].";";
			//print 'Login Success<br>';
			die(json_encode(array('status' => 'ok', 'message' => 'Status: login success', 'cookie' => $cookie, 'ua'=>$ua,'post_login'=>$post_login,'ip' => $ip)));
			echo'<br'.$cookie
	 ;
		}


//****************************************************************************

          exit();
          
}
echo 'Ready mahn' ;  

<?php 
	session_start();

	if(!$_SESSION['spdcsession']){
		header('Location: index.php');
	}

	include("functions.php");
	date_default_timezone_set('Europe/Istanbul');
    $spdc = $_SESSION['spdcsession'];

    // get access token with sp_dc cookie //

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://open.spotify.com/get_access_token?reason=transport&productType=web_player');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $headers = [
        'Cookie: sp_dc='.$spdc.'',
        'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0',
        'Accept: application/json'
    ];

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $calistir = curl_exec($ch);
    curl_close($ch);

    $json = json_decode($calistir);
    $accessToken = $json->accessToken;

    // get access token with sp_dc cookie //

    // get buddylist with access token //

    $ch2 = curl_init();

    curl_setopt($ch2, CURLOPT_URL, 'https://guc-spclient.spotify.com/presence-view/v1/buddylist');
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false);

    $headers2 = [
        'Authorization: Bearer '.$accessToken.'',
        'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0',
        'Accept: application/json'
    ];

    curl_setopt($ch2, CURLOPT_HTTPHEADER, $headers2);

    $calistir2 = curl_exec($ch2);
    curl_close($ch2);

    $json2 = json_decode($calistir2);
    // print_r($json2->friends['0']); --> to access a single user information
    $toplamarkadas = count($json2->friends);

    // get buddylist with access token //

?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <title>SpotiBuddy</title>
  <meta name="viewport" content="width=device-width, initial-scale=1"><link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css'>
<link rel="icon" href="https://www.freepnglogos.com/uploads/spotify-logo-png/spotify-icon-marilyn-scott-0.png" type="image/x-icon" />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Cabin'><link rel="stylesheet" href="./style.css">

</head>
<body>

<div class="container">
	<br>
	<center><img width="5%" src="https://www.freepnglogos.com/uploads/spotify-logo-png/spotify-download-logo-30.png"><a style="font-size:25px;color:black" href="index.php">SpotiBuddy</a></center>
	<div class="row">
		<div class="col-md-12">
			<div id="output">
				<center><font style="color: white">Arkadaşlarım Ne Dinliyor? (<?php echo $toplamarkadas; ?> kullanıcı)</font></center>

				<?php 

				for ($i = $toplamarkadas-1; $i >= 0; $i--) { ?>
				    
					<div class="row friend">
					<a target="_blank" href="<?php print_r($json2->friends[$i]->user->uri); ?>"><img src="<?php if(!empty($json2->friends[$i]->user->imageUrl)){ print_r($json2->friends[$i]->user->imageUrl); } else { print_r("profile.jpg"); } ?>" alt="profile photo"></a>
					<div class="title">
						<a target="_blank" style="color:white" href="<?php print_r($json2->friends[$i]->user->uri); ?>"><?php print_r($json2->friends[$i]->user->name); ?></a>
						<br>
						<a target="_blank" style="color:white" href="<?php print_r($json2->friends[$i]->track->uri); ?>"><?php print_r($json2->friends[$i]->track->name); ?></a> - <a target="_blank" style="color:white" href="<?php print_r($json2->friends[$i]->track->artist->uri); ?>"><?php print_r($json2->friends[$i]->track->artist->name); ?></a> <a target="_blank" style="color:white" href="<?php print_r($json2->friends[$i]->track->context->uri); ?>">(<?php print_r($json2->friends[$i]->track->context->name); ?>) 🎵</a>
						<br>
						

					</div><?php 
						$mil = $json2->friends[$i]->timestamp;
						$seconds = $mil / 1000; // converting ms unix timestamp to normal date
						echo get_time_ago($seconds); // convert timestamp to time ago type
						?>
					
				</div>	

				<?php }

				?>
			<center><a href="index.php" class="btn btn-light">Çıkış Yap</a></center>
			</div>
		</div>
	</div>
</div>
<center>SpotiBuddy © 2021
<br>
<a target="_blank" style="color:black" href="https://mertpolat.com.tr">Developer</a>
</center>
<br>


<!-- partial -->
<!-- <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js'></script><script src="./script.js"></script> -->

</body>
</html>

<?php 
	session_start();
	date_default_timezone_set('Europe/Istanbul');
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
	<center><img width="15%" src="https://www.freepnglogos.com/uploads/spotify-logo-png/spotify-download-logo-30.png"><font size="18">SpotiBuddy</font></center>
	<div class="row">
		<div class="col-md-12">
			<div id="output">
				<center><font color="white">Giriş Anahtarı </font><a style="color:white" href="video.mp4">(Nasıl Alacağım?)</a></center><br>
				<div class="search">
					<i class="fa fa-fw fa-key"></i>
					<form action="" name="spdcgonder" method="post">
					<input size="100" minlength="100" required name="spdc" id="searchBar" type="text">
				</div>
<center><button type="submit" name="spdcgonder" class="btn btn-light">Giriş Yap</button></center>
</form>
<br>
<center><font color="white">SpotiBuddy, Spotify'da arkadaşlarınızın hangi müziği dinlediğini mobilde görmenizi sağlar. Bilgisayar kullanarak tek seferlik alacağınız bir giriş anahtarı ile SpotiBuddy üzerinden arkadaş listenize erişebilir ve hangi müziği dinlediğini görebilirsiniz.</font></center>
			</div>
		</div>
	</div>
</div>
<center>SpotiBuddy © 2021</center>

<center><a target="_blank" style="color:black" href="https://mertpolat.com.tr">Developer</a></center>

<?php 

if(isset($_POST['spdcgonder'])){
	$spdc = htmlspecialchars(strip_tags($_POST['spdc']));
	$_SESSION['spdcsession'] = $spdc;
	header('Location: friendactivity.php');
}

?>

<!-- partial -->
<!-- <script src='https://code.jquery.com/jquery-3.2.1.slim.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js'></script><script src="./script.js"></script> -->

</body>
</html>

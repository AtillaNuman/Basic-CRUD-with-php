<?php require_once 'connection.php'; 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DÜZENLE</title>
	<style>
		* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body {
    margin: 20px; /* Space around the entire content */
    padding: 20px; /* Space inside the body content */
    font-family: Arial, sans-serif; /* Set a global font */
    line-height: 1.6; /* Improve text readability */
}

h2, h3, h4, h5, h6 {
    margin-top: 20px;
    margin-bottom: 10px;
}

p {
    margin-bottom: 15px;
}

hr {
    margin: 20px 0; /* Space above and below horizontal rules */
}

br {
    margin: 10px 0; /* Space around line breaks */
}

	</style>
</head>
<body>

<?php 
	$result = "";

	if ($_GET['durum']=="ok") {
		
		$result = "İşlem başarılı";

	} elseif ($_GET['durum']=="no") {

		$result = "İşlem başarısız";


	}

?>

	<h2>KAYIT DÜZENLEME İŞLEMİ</h2>
	<hr>
	<br>
	<p><?php echo $result; ?></p>

<?php 
	$bilgilerimsor=$conn->prepare("SELECT * FROM bilgilerim WHERE bilgilerim_id=:id");
	$bilgilerimsor->execute(
		[
			'id' => $_GET['bilgilerim_id']
		]
	);
	$bilgilerimcek=$bilgilerimsor->fetch(PDO::FETCH_ASSOC);
?>


	<form action="islem.php" method="POST">

		<input type="text"  name="bilgilerim_ad" value="<?php echo $bilgilerimcek['bilgilerim_ad']; ?>">

		<input type="text"  name="bilgilerim_soyad" value="<?php echo $bilgilerimcek['bilgilerim_soyad']; ?>">

		<input type="email"  name="bilgilerim_mail" value="<?php echo $bilgilerimcek['bilgilerim_mail']; ?>">

		<input type="number"  name="bilgilerim_yas" style="width:10.5%"; min="0" max="127" value="<?php echo $bilgilerimcek['bilgilerim_yas']; ?>">

		<input type="hidden" value="<?php echo $bilgilerimcek['bilgilerim_id']; ?>" name="bilgilerim_id">

		<button type="submit" name="guncelle">Formu Güncelle</button>

		<button><a href="index.php" style="text-decoration: none;">Ana Sayfaya Git</a></button>

	</form>


</body>
</html>

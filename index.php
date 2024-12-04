<?php include 'connection.php'; 
	  
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PDO</title>
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

	<h2>KAYIT İŞLEMİ</h2>
	<hr>
	<br>
	<p><?php echo $result; ?></p>

	<form action="islem.php" method="POST">

		<input type="text"  name="bilgilerim_ad" placeholder="Adınızı Giriniz...">

		<input type="text"  name="bilgilerim_soyad" placeholder="Soyadınızı Giriniz...">

		<input type="email"  name="bilgilerim_mail" placeholder="Mail Giriniz...">

		<input type="number"  name="bilgilerim_yas" style="width:10.5%"; min="0" max="127" placeholder="Yaşınızı Giriniz...">

		<button type="submit" name="insertislemi" id="buttonform">Formu Gönder</button>

	</form>
		<br>
		<h4>Kayıtların Listelenmesi</h4>
		<hr>

		<table style="width: 60%" border="1">
		<tr>
		<th>S.No</th>
		<th>ID</th>
		<th>Ad</th>
		<th>Soyad</th>
		<th>Mail</th>
		<th>Yaş</th>
		<th width="50" colspan="2">İşlemler</th>
		</tr>
		
		<?php 
		// Prepare and execute the query
		$bilgilerimsor = $conn->prepare("SELECT * FROM bilgilerim");

		$say = 0;

		if ($bilgilerimsor->execute()) {
		    // Fetch the results
		    while ($bilgilerimcek = $bilgilerimsor->fetch(PDO::FETCH_ASSOC)) { $say++ ?>
		        <tr>
		        	<td><?php echo $say; ?></td>
		            <td><?php echo htmlspecialchars($bilgilerimcek['bilgilerim_id']); ?></td>
		            <td><?php echo htmlspecialchars($bilgilerimcek['bilgilerim_ad']); ?></td>
		            <td><?php echo htmlspecialchars($bilgilerimcek['bilgilerim_soyad']); ?></td>
		            <td><?php echo htmlspecialchars($bilgilerimcek['bilgilerim_mail']); ?></td>
		            <td><?php echo htmlspecialchars($bilgilerimcek['bilgilerim_yas']); ?></td>
		            <td align="center"><a href="duzenle.php?bilgilerim_id=<?php echo $bilgilerimcek['bilgilerim_id']; ?>"><button>Düzenle</button></a></td>
		            <td align="center"><a href="islem.php?bilgilerim_id=<?php echo $bilgilerimcek['bilgilerim_id']?>&bilgilerimsil=ok"><button>Sil</button></a></td>
		        </tr>
		    <?php }
		} else {
		    // Output the error if the query fails
		    $errorInfo = $bilgilerimsor->errorInfo();
		    echo "Error executing query: " . htmlspecialchars($errorInfo[2]);
		}
		?>	
		</table>

</body>
</html>

<?php 
require_once 'connection.php';

if (isset($_POST['insertislemi']))
{

	$save_to_db=$conn->prepare("INSERT INTO bilgilerim set

		bilgilerim_ad=:ad,
		bilgilerim_soyad=:soyad,
		bilgilerim_mail=:mail,
		bilgilerim_yas=:yas
		");

	$insert = $save_to_db->execute(
		[
    'ad' => $_POST['bilgilerim_ad'],
    'soyad' => $_POST['bilgilerim_soyad'],
    'mail' => $_POST['bilgilerim_mail'],
    'yas' => $_POST['bilgilerim_yas']
		]
								);


	if($insert){
		//echo "KAYIT İŞLEMİ BAŞARILI!";

		Header("Location:index.php?durum=ok");
		exit;
		
	} else {
		//echo "KAYIT İŞLEMİ BAŞARISIZ!";

		Header("Location:index.php?durum=no");
		exit;
	}


}


if (isset($_POST['guncelle']))
{
	$bilgilerim_id=$_POST['bilgilerim_id'];

	$save_to_db=$conn->prepare("UPDATE bilgilerim set

		bilgilerim_ad=:ad,
		bilgilerim_soyad=:soyad,
		bilgilerim_mail=:mail,
		bilgilerim_yas=:yas
		WHERE bilgilerim_id={$_POST['bilgilerim_id']}
		");

	$update = $save_to_db->execute(
		[
    'ad' => $_POST['bilgilerim_ad'],
    'soyad' => $_POST['bilgilerim_soyad'],
    'mail' => $_POST['bilgilerim_mail'],
    'yas' => $_POST['bilgilerim_yas'],	
		]);


	if($update){
		//echo "GÜNCELLEME İŞLEMİ BAŞARILI!";

		Header("Location:duzenle.php?durum=ok&bilgilerim_id=$bilgilerim_id");
		exit;
		
	} else {
		//echo "GÜNCELLEME İŞLEMİ BAŞARISIZ!";

		Header("Location:duzenle.php?durum=no&bilgilerim_id=$bilgilerim_id");
		exit;
	}

}


	if ($_GET['bilgilerimsil']=="ok"){

		$sil=$conn->prepare("DELETE FROM bilgilerim WHERE bilgilerim_id=:id");
		$kontrol=$sil->execute(array(
			'id' => $_GET['bilgilerim_id']
		));

		if($kontrol) {
			Header ("Location:index.php?durum=ok");
			exit;
		} else {
			header("Location:index.php?durum=no");
			exit;
		}
	}


?>
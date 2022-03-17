<?php
session_start();
include_once("dbc.php");
include 'fcm.php';
$sPostData = file_get_contents("php://input");
$oPostData = json_decode($sPostData);


$sActionID=$oPostData->action_id;
switch ($sActionID) 
{
		case 'azuriraj_pacijenta':
		$datum_baza_1="";
		$dan_1;
		$mjesec_1;
		$godina_1;
		$datum_prikaz_1="";
		$cjepivo;
		$sQuery = "UPDATE cijepi_se_cijepljenje SET vrsta_cjepiva=:vrsta_cjepiva, prva_doza_datum=:prva_doza_datum, prva_doza_status=:prva_doza_status, druga_doza_datum=:druga_doza_datum, druga_doza_status=:druga_doza_status, token=:token WHERE OIB=:OIB";
		$oStatement = $oDbConnector->prepare($sQuery);
		$oData = array(
		 'vrsta_cjepiva' => $oPostData->vrsta_cjepiva,
		 'prva_doza_datum' => $oPostData->prva_doza_datum,
		 'prva_doza_status' => $oPostData->prva_doza_status,
		 'druga_doza_datum' => $oPostData->druga_doza_datum,
		 'druga_doza_status' => $oPostData->druga_doza_status,
		 'OIB' => $oPostData->OIB,
		 'token' => $oPostData->token
		);
			$datum_baza_1=$oPostData->prva_doza_datum;
			$dan_1=substr($datum_baza_1, -2);
			$mjesec_1=substr($datum_baza_1, -4, 2);
			$godina_1=substr($datum_baza_1, 0, -4);
			$datum_prikaz_1=$dan_1.".".$mjesec_1.".".$godina_1.".";
			$sQuery2 = "SELECT * FROM cijepi_se_cjepiva WHERE cijepi_se_cjepiva.ID= ".$oPostData->vrsta_cjepiva;
				$oRecord2=$oDbConnector->query($sQuery2);
				while($oRow2=$oRecord2->fetch(PDO::FETCH_ASSOC))
				{
					$cjepivo=$oRow2['naziv_cjepiva'];
				}
		try
		{
			$oStatement=$oDbConnector->prepare($sQuery);
			$oStatement->execute($oData);
			echo 1;
			$regId =$oPostData->token;

			$arrNotification= array(
				'body' => "Naručeni ste za cijepljenje, termin prve doze je: ".$datum_prikaz_1. PHP_EOL ."Cjepivo: ".$cjepivo,
				'title' => "Cijepi se!"
			);

			$fcm = new FCM();
			$result = $fcm->send_notification($regId, $arrNotification);
		}
		catch(PDOException $error)
		{
			echo $error;
			echo 0;
		}		
		break;

		case 'azuriraj_pacijenta2':
		$datum_baza_1="";
		$dan_1;
		$mjesec_1;
		$godina_1;
		$datum_prikaz_1="";
		$datum_baza_2="";
		$dan_2;
		$mjesec_2;
		$godina_2;
		$datum_prikaz_2="";
		$sQuery = "UPDATE cijepi_se_cijepljenje SET prva_doza_datum=:prva_doza_datum, prva_doza_status=:prva_doza_status, druga_doza_datum=:druga_doza_datum, druga_doza_status=:druga_doza_status, token=:token WHERE OIB=:OIB";
		$oStatement = $oDbConnector->prepare($sQuery);
		$oData = array(
		 'prva_doza_datum' => $oPostData->prva_doza_datum,
		 'prva_doza_status' => $oPostData->prva_doza_status,
		 'druga_doza_datum' => $oPostData->druga_doza_datum,
		 'druga_doza_status' => $oPostData->druga_doza_status,
		 'OIB' => $oPostData->OIB,
		 'token' => $oPostData->token,
		);
			$datum_baza_1=$oPostData->prva_doza_datum;
			$dan_1=substr($datum_baza_1, -2);
			$mjesec_1=substr($datum_baza_1, -4, 2);
			$godina_1=substr($datum_baza_1, 0, -4);
			$datum_prikaz_1=$dan_1.".".$mjesec_1.".".$godina_1.".";

			$datum_baza_2=$oPostData->druga_doza_datum;
			$dan_2=substr($datum_baza_2, -2);
			$mjesec_2=substr($datum_baza_2, -4, 2);
			$godina_2=substr($datum_baza_2, 0, -4);
			$datum_prikaz_2=$dan_2.".".$mjesec_2.".".$godina_2.".";
		try
		{
			$oStatement=$oDbConnector->prepare($sQuery);
			$oStatement->execute($oData);
			echo 1;
			if($oPostData->prva_doza_status=="Cijepljen" && $oPostData->druga_doza_status=="Naručen")
			{
				$regId =$oPostData->token;

				$arrNotification= array(
					'body' => "Naručeni ste za drugu dozu dana: ".$datum_prikaz_2,
					'title' => "Cijepi se!"
				);

				$fcm = new FCM();
				$result = $fcm->send_notification($regId, $arrNotification);
			}
			if($oPostData->prva_doza_status=="Naručen" && $oPostData->druga_doza_status=="Naručen")
			{
				$regId =$oPostData->token;

				$arrNotification= array(
					'body' => "Vaš novi termin za cijepljenje prvom dozom je dana: ".$datum_prikaz_1,
					'title' => "Cijepi se!"
				);

				$fcm = new FCM();
				$result = $fcm->send_notification($regId, $arrNotification);
			}
		}
		catch(PDOException $error)
		{
			echo $error;
			echo 0;
		}		
		break;

		case 'azuriraj_testiranje':
		$datum_baza_1="";
		$dan_1;
		$mjesec_1;
		$godina_1;
		$datum_prikaz_1="";
		$sQuery = "UPDATE cijepi_se_testiranje SET datum=:datum, rezultat=:rezultat, token=:token WHERE ID=:ID";
		$oStatement = $oDbConnector->prepare($sQuery);
		$oData = array(
		 'datum' => $oPostData->datum,
		 'rezultat' => $oPostData->rezultat,
		 'ID' => $oPostData->ID,
		 'token' => $oPostData->token
		);
			$datum_baza_1=$oPostData->datum;
			$dan_1=substr($datum_baza_1, -2);
			$mjesec_1=substr($datum_baza_1, -4, 2);
			$godina_1=substr($datum_baza_1, 0, -4);
			$datum_prikaz_1=$dan_1.".".$mjesec_1.".".$godina_1.".";
		try
		{
			$oStatement=$oDbConnector->prepare($sQuery);
			$oStatement->execute($oData);
			echo 1;
			$regId =$oPostData->token;
			if($oPostData->rezultat=="Na čekanju")
			{

			$arrNotification= array(
				'body' => "Datum: ". $datum_prikaz_1. PHP_EOL . "Status: Naručen",
				'title' => "Cijepi se!"
			);

			}else{
				$arrNotification= array(
				'body' => "Datum: ". $datum_prikaz_1. PHP_EOL . "Rezultat: ". $oPostData->rezultat,
				'title' => "Cijepi se!"
			);
			}

			$fcm = new FCM();
			$result = $fcm->send_notification($regId, $arrNotification);
		}
		catch(PDOException $error)
		{
			echo $error;
			echo 0;
		}		
		break;
}
?>
<?php
include_once("dbc.php");

$sJsonID= "";
$oJson= array();

if(isset($_GET['json_id']))
{
	$sJsonID= $_GET['json_id'];
}
else
{
	header("Location:index.php");
}


switch ($sJsonID)
{
	case 'ucitaj_na_cekanju':
	$datum_baza_rodenje="";
	$dan_rodenje;
	$mjesec_rodenje;
	$godina_rodenje;
	$datum_prikaz_rodenje="";
	$danasnji_datum=Date("Ymd");
	$datum_razlika;
	$godina;

		$sQuery="SELECT * FROM cijepi_se_korisnici";
		$oRecord=$oDbConnector->query($sQuery);
		while($oRow=$oRecord->fetch(PDO::FETCH_ASSOC))
		{
			$sQuery2 = "SELECT * FROM cijepi_se_cijepljenje WHERE vrsta_cjepiva IS NULL AND cijepi_se_cijepljenje.OIB= ".$oRow['OIB'];
			$oRecord2=$oDbConnector->query($sQuery2);
			while($oRow2=$oRecord2->fetch(PDO::FETCH_ASSOC))
			{
				$datum_baza_rodenje=$oRow['datum_rodenja'];
				$dan_rodenje=substr($datum_baza_rodenje, -2);
				$mjesec_rodenje=substr($datum_baza_rodenje, -4, 2);
				$godina_rodenje=substr($datum_baza_rodenje, 0, -4);
				$datum_prikaz_rodenje=$dan_rodenje.".".$mjesec_rodenje.".".$godina_rodenje.".";
				$datum_razlika=$danasnji_datum-$datum_baza_rodenje;
				$godina=substr($datum_razlika, 0, 2);
				$god = (int)$godina;
				
				$oPacijent_cekanje=new Pacijent(
				$oRow['ime'],
    			$oRow['prezime'],
    			$oRow['adresa'],
    			$oRow['grad'],
    			$oRow['zupanija'],
    			$oRow['OIB'],
    			$datum_prikaz_rodenje,
    			$god,
    			$oRow['token']
				);	
				array_push($oJson, $oPacijent_cekanje);
			}
		}
		
		break;

		case 'ucitaj_narucene':
		$datum_baza_rodenje="";
		$dan_rodenje;
		$mjesec_rodenje;
		$godina_rodenje;
		$datum_prikaz_rodenje="";
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
		$danasnji_datum=Date("Ymd");
		$datum_razlika;
		$godina;
		$sQuery="SELECT * FROM cijepi_se_korisnici";
		$oRecord=$oDbConnector->query($sQuery);
		while($oRow=$oRecord->fetch(PDO::FETCH_ASSOC))
		{
			$sQuery2 = "SELECT * FROM cijepi_se_cijepljenje WHERE druga_doza_status<>'Cijepljen' AND cijepi_se_cijepljenje.OIB= ".$oRow['OIB'];
			$oRecord2=$oDbConnector->query($sQuery2);
			while($oRow2=$oRecord2->fetch(PDO::FETCH_ASSOC))
			{
				$datum_baza_rodenje=$oRow['datum_rodenja'];
				$dan_rodenje=substr($datum_baza_rodenje, -2);
				$mjesec_rodenje=substr($datum_baza_rodenje, -4, 2);
				$godina_rodenje=substr($datum_baza_rodenje, 0, -4);
				$datum_prikaz_rodenje=$dan_rodenje.".".$mjesec_rodenje.".".$godina_rodenje.".";

				$datum_baza_1=$oRow2['prva_doza_datum'];
				$dan_1=substr($datum_baza_1, -2);
				$mjesec_1=substr($datum_baza_1, -4, 2);
				$godina_1=substr($datum_baza_1, 0, -4);
				$datum_prikaz_1=$dan_1.".".$mjesec_1.".".$godina_1.".";

				$datum_baza_2=$oRow2['druga_doza_datum'];
				$dan_2=substr($datum_baza_2, -2);
				$mjesec_2=substr($datum_baza_2, -4, 2);
				$godina_2=substr($datum_baza_2, 0, -4);
				$datum_prikaz_2=$dan_2.".".$mjesec_2.".".$godina_2.".";
				$datum_razlika=$danasnji_datum-$datum_baza_rodenje;
				$godina=substr($datum_razlika, 0, 2);
				$god = (int)$godina;

				$sQuery3 = "SELECT * FROM cijepi_se_cjepiva WHERE cijepi_se_cjepiva.ID= ".$oRow2['vrsta_cjepiva'];
				$oRecord3=$oDbConnector->query($sQuery3);
				while($oRow3=$oRecord3->fetch(PDO::FETCH_ASSOC))
				{
				$oPacijent_naruceni=new Pacijent(
				$oRow['ime'],
    			$oRow['prezime'],
    			$oRow['adresa'],
    			$oRow['grad'],
    			$oRow['zupanija'],
    			$oRow2['OIB'],
    			$datum_prikaz_rodenje,
    			$god,
    			$oRow['token'],
    			$oRow3['naziv_cjepiva'],
    			$datum_prikaz_1,
    			$oRow2['prva_doza_status'],
    			$datum_prikaz_2,
    			$oRow2['druga_doza_status']
				);	
				array_push($oJson, $oPacijent_naruceni);
				}
			}
		}
		
		
		break;
		

		case 'ucitaj_cijepljene':
		$datum_baza_rodenje="";
		$dan_rodenje;
		$mjesec_rodenje;
		$godina_rodenje;
		$datum_prikaz_rodenje="";
		$datum_baza_2="";
		$dan_2;
		$mjesec_2;
		$godina_2;
		$datum_prikaz_2="";
		$danasnji_datum=Date("Ymd");
		$datum_razlika;
		$godina;
		$sQuery="SELECT * FROM cijepi_se_korisnici";
		$oRecord=$oDbConnector->query($sQuery);
		while($oRow=$oRecord->fetch(PDO::FETCH_BOTH))
		{
			$sQuery2 = "SELECT * FROM cijepi_se_cijepljenje WHERE druga_doza_status='Cijepljen' AND cijepi_se_cijepljenje.OIB= ".$oRow['OIB'];
			$oRecord2=$oDbConnector->query($sQuery2);
			while($oRow2=$oRecord2->fetch(PDO::FETCH_BOTH))
			{
				$datum_baza_rodenje=$oRow['datum_rodenja'];
				$dan_rodenje=substr($datum_baza_rodenje, -2);
				$mjesec_rodenje=substr($datum_baza_rodenje, -4, 2);
				$godina_rodenje=substr($datum_baza_rodenje, 0, -4);
				$datum_prikaz_rodenje=$dan_rodenje.".".$mjesec_rodenje.".".$godina_rodenje.".";

				$datum_baza_2=$oRow2['druga_doza_datum'];
				$dan_2=substr($datum_baza_2, -2);
				$mjesec_2=substr($datum_baza_2, -4, 2);
				$godina_2=substr($datum_baza_2, 0, -4);
				$datum_prikaz_2=$dan_2.".".$mjesec_2.".".$godina_2.".";
				$datum_razlika=$danasnji_datum-$datum_baza_rodenje;
				$godina=substr($datum_razlika, 0, 2);
				$god = (int)$godina;
				
				$sQuery3 = "SELECT * FROM cijepi_se_cjepiva WHERE cijepi_se_cjepiva.ID= ".$oRow2['vrsta_cjepiva'];
				$oRecord3=$oDbConnector->query($sQuery3);
				while($oRow3=$oRecord3->fetch(PDO::FETCH_ASSOC))
				{
				$oPacijent_cijepljeni=new Pacijent(
				$oRow['ime'],
    			$oRow['prezime'],
    			$oRow['adresa'],
    			$oRow['grad'],
    			$oRow['zupanija'],
    			$oRow2['OIB'],
    			$datum_prikaz_rodenje,
    			$god,
    			$oRow['token'],
    			$oRow3['naziv_cjepiva'],
    			$oRow2['prva_doza_datum'],
    			$oRow2['prva_doza_status'],
    			$datum_prikaz_2,
    			$oRow2['druga_doza_status']
				);	
				array_push($oJson, $oPacijent_cijepljeni);
				}
			}
		}
		

        break;

        case 'ucitaj_cjepiva':
		$sQuery="SELECT * FROM cijepi_se_cjepiva";
		$oRecord=$oDbConnector->query($sQuery);
		while($oRow=$oRecord->fetch(PDO::FETCH_ASSOC))
		{
					$oVrste_cjepiva=new Cjepivo(
					$oRow['ID'],
					$oRow['naziv_cjepiva']
				);
				
				
			array_push($oJson,$oVrste_cjepiva);
		}

        break;

        case 'ucitaj_zupanije':
		$sQuery="SELECT * FROM cijepi_se_zupanije";
		$oRecord=$oDbConnector->query($sQuery);
		while($oRow=$oRecord->fetch(PDO::FETCH_ASSOC))
		{
					$oZupanije=new Zupanija(
					$oRow['ID'],
					$oRow['naziv_zupanije']
				);
				
				
			array_push($oJson,$oZupanije);
		}

        break;

        case 'ucitaj_testiranja':
		$datum_baza_rodenje="";
		$dan_rodenje;
		$mjesec_rodenje;
		$godina_rodenje;
		$datum_prikaz_rodenje="";
		$datum_baza_testiranje="";
		$dan_testiranje;
		$mjesec_testiranje;
		$godina_testiranje;
		$datum_prikaz_testiranje="";
		$danasnji_datum=Date("Ymd");
		$datum_razlika;
		$godina;

		$sQuery="SELECT * FROM cijepi_se_korisnici";
		$oRecord=$oDbConnector->query($sQuery);
		while($oRow=$oRecord->fetch(PDO::FETCH_ASSOC))
		{
			$sQuery2 = "SELECT * FROM cijepi_se_testiranje WHERE (rezultat IS NULL OR rezultat='Na čekanju') AND cijepi_se_testiranje.OIB= ".$oRow['OIB'];
			$oRecord2=$oDbConnector->query($sQuery2);
			while($oRow2=$oRecord2->fetch(PDO::FETCH_ASSOC))
			{
				$datum_baza_rodenje=$oRow['datum_rodenja'];
				$dan_rodenje=substr($datum_baza_rodenje, -2);
				$mjesec_rodenje=substr($datum_baza_rodenje, -4, 2);
				$godina_rodenje=substr($datum_baza_rodenje, 0, -4);
				$datum_prikaz_rodenje=$dan_rodenje.".".$mjesec_rodenje.".".$godina_rodenje.".";

				$datum_baza_testiranje=$oRow2['datum'];
				$dan_testiranje=substr($datum_baza_testiranje, -2);
				$mjesec_testiranje=substr($datum_baza_testiranje, -4, 2);
				$godina_testiranje=substr($datum_baza_testiranje, 0, -4);
				$datum_prikaz_testiranje=$dan_testiranje.".".$mjesec_testiranje.".".$godina_testiranje.".";
				$datum_razlika=$danasnji_datum-$datum_baza_rodenje;
				$godina=substr($datum_razlika, 0, 2);
				$god = (int)$godina;
				
				$oPacijent_testiranje=new Testiranje(
				$oRow2['ID'],
				$oRow['ime'],
    			$oRow['prezime'],
    			$oRow['adresa'],
    			$oRow['grad'],
    			$oRow['zupanija'],
    			$oRow['OIB'],
    			$datum_prikaz_rodenje,
    			$god,
    			$oRow2['test'],
    			$datum_prikaz_testiranje,
    			$oRow2['rezultat'],
    			$oRow['token']
				);	
				array_push($oJson, $oPacijent_testiranje);
			}
		}
		
		break;

		case 'ucitaj_povijest_testiranja':
		$datum_baza_rodenje="";
		$dan_rodenje;
		$mjesec_rodenje;
		$godina_rodenje;
		$datum_prikaz_rodenje="";
		$danasnji_datum=Date("Ymd");
		$datum_razlika;
		$godina;

		$sQuery="SELECT * FROM cijepi_se_korisnici";
		$oRecord=$oDbConnector->query($sQuery);
		while($oRow=$oRecord->fetch(PDO::FETCH_ASSOC))
		{
			$sQuery2="SELECT DISTINCT OIB FROM cijepi_se_testiranje WHERE cijepi_se_testiranje.rezultat<> 'Na čekanju' AND cijepi_se_testiranje.OIB= ".$oRow['OIB'];
				$oRecord2=$oDbConnector->query($sQuery2);
				while($oRow2=$oRecord2->fetch(PDO::FETCH_ASSOC))
				{
				$datum_baza_rodenje=$oRow['datum_rodenja'];
				$dan_rodenje=substr($datum_baza_rodenje, -2);
				$mjesec_rodenje=substr($datum_baza_rodenje, -4, 2);
				$godina_rodenje=substr($datum_baza_rodenje, 0, -4);
				$datum_prikaz_rodenje=$dan_rodenje.".".$mjesec_rodenje.".".$godina_rodenje.".";
				$datum_razlika=$danasnji_datum-$datum_baza_rodenje;
				$godina=substr($datum_razlika, 0, 2);
				$god = (int)$godina;
				
				$oPacijent_povijest_testiranja=new PovijestTestiranja(
				$oRow['ime'],
    			$oRow['prezime'],
    			$oRow['adresa'],
    			$oRow['grad'],
    			$oRow['zupanija'],
    			$oRow['OIB'],
    			$datum_prikaz_rodenje,
    			$god
				);	
				array_push($oJson, $oPacijent_povijest_testiranja);
				}
		}
		
		break;

		case 'ucitaj_rezultate':
		$datum_baza_testiranje="";
		$dan_testiranje;
		$mjesec_testiranje;
		$godina_testiranje;
		$datum_prikaz_testiranje="";

		$sQuery="SELECT * FROM cijepi_se_korisnici";
		$oRecord=$oDbConnector->query($sQuery);
		while($oRow=$oRecord->fetch(PDO::FETCH_ASSOC))
		{
			$sQuery2 = "SELECT * FROM cijepi_se_testiranje WHERE rezultat<>'Na čekanju' AND cijepi_se_testiranje.OIB= ".$oRow['OIB'];
			$oRecord2=$oDbConnector->query($sQuery2);
			while($oRow2=$oRecord2->fetch(PDO::FETCH_ASSOC))
			{
				$datum_baza_testiranje=$oRow2['datum'];
				$dan_testiranje=substr($datum_baza_testiranje, -2);
				$mjesec_testiranje=substr($datum_baza_testiranje, -4, 2);
				$godina_testiranje=substr($datum_baza_testiranje, 0, -4);
				$datum_prikaz_testiranje=$dan_testiranje.".".$mjesec_testiranje.".".$godina_testiranje.".";
				$oPacijent_rezulati=new Rezultat(
				$oRow2['OIB'],
    			$oRow2['test'],
    			$datum_prikaz_testiranje,
    			$oRow2['rezultat']
				);	
				array_push($oJson, $oPacijent_rezulati);
			}
		}
		
		break;
        
}

echo json_encode($oJson);


?>
function DateTimePicker()
{
    $('#inptDatumPrvaDoza').datetimepicker({
        format: "DD.MM.YYYY",
        locale: "hr",
        useCurrent: false,
        minDate: new Date(),
        daysOfWeekDisabled: [0,6],
        widgetPositioning: {
            horizontal: 'auto',
            vertical: 'bottom'
        }
    });
}

function DateTimePicker3()
{
    $('#inptDatumDrugaDoza').datetimepicker({
        format: "DD.MM.YYYY",
        locale: "hr",
        useCurrent: false,
        minDate: new Date(),
        daysOfWeekDisabled: [0,6],
        widgetPositioning: {
            horizontal: 'auto',
            vertical: 'bottom'
        }
    });
}

function DateTimePicker4()
{
    $('#inptDatumPrvaDoza2').datetimepicker({
        format: "DD.MM.YYYY",
        locale: "hr",
        useCurrent: false,
        minDate: new Date(),
        daysOfWeekDisabled: [0,6],
        widgetPositioning: {
            horizontal: 'auto',
            vertical: 'bottom'
        }
    });
}

function DateTimePicker5()
{
    $('#inptDatumDrugaDoza2').datetimepicker({
        format: "DD.MM.YYYY",
        locale: "hr",
        useCurrent: false,
        minDate: new Date(),
        daysOfWeekDisabled: [0,6],
        widgetPositioning: {
            horizontal: 'auto',
            vertical: 'bottom'
        }
    });
}

function DateTimePicker2()
{
    $('#inptDatumTestiranja').datetimepicker({
        format: "DD.MM.YYYY",
        locale: "hr",
        useCurrent: false,
        minDate: new Date(),
        daysOfWeekDisabled: [0,6],
        widgetPositioning: {
            horizontal: 'auto',
            vertical: 'bottom'
        }
    });
}

var oPacijentiModul = angular.module('pacijenti-app', []);

oPacijentiModul.controller('pacijentiController', function ($scope, $http) {
    $scope.oPacijenti_cekanje = [];
    $scope.oPacijenti_naruceni = [];
    $scope.oPacijenti_cijepljeni = [];
    $scope.oVrste_cjepiva = [];
    $scope.oZupanije = [];
    $scope.oPacijenti_testiranje = [];
    $scope.oPacijenti_povijest_testiranja = [];
    $scope.oPacijenti_rezultati = [];
    $scope.oRezultati = ["Pozitivan", "Negativan", "Na čekanju"];
    $scope.oRezultati2 = ["Pozitivan", "Negativan"];
    $scope.oTestovi = ["PCR", "Brzi"];
    $scope.filterzupanije = {zupanija: "!!"};
    $scope.filterrezultata = {rezultat: "!!"};
    $scope.filtertestovi = {test: "!!"};
    $scope.filtergodina = {god: "!!"};
    $scope.oGodine = ["Stariji od 18", "Stariji od 25", "Stariji od 35", "Stariji od 45", "Stariji od 65", "Stariji od 80"];


    $scope.filterpostarosti = function (god, odab) {
        var minValue;
        
        if(odab=="!!")
        {
            minValue=0;
        }
        else if(odab=="Stariji od 18")
        {
            minValue=18;
        }
        else if(odab=="Stariji od 25")
        {
            minValue=25;
        }
        else if(odab=="Stariji od 35")
        {
            minValue=35;
        }
        else if(odab=="Stariji od 45")
        {
            minValue=45;
        }
        else if(odab=="Stariji od 65")
        {
            minValue=65;
        }
        else if(odab=="Stariji od 80")
        {
            minValue=80;
        }

  return function predicateFunc(item) {
    return minValue <= item[god];
  };
};

      

    $http({
        method : "GET",
        url: "json.php?json_id=ucitaj_cjepiva"
    }).then(function(response) {
        console.log(response);
        $scope.oVrste_cjepiva = response.data;
    },function (response) {
        console.log('Došlo je do pogreške');
    });

    $http({
        method : "GET",
        url: "json.php?json_id=ucitaj_zupanije"
    }).then(function(response) {
        console.log(response);
        $scope.oZupanije = response.data;
    },function (response) {
        console.log('Došlo je do pogreške');
    });


$scope.UcitajNaCekanju = function()
{
    $http({
        method : "GET",
        url: "json.php?json_id=ucitaj_na_cekanju"
    }).then(function(response) {
        console.log(response);
        $scope.oPacijenti_cekanje = response.data;
    },function (response) {
        console.log('Došlo je do pogreške');
    });
};

$scope.UcitajNarucene = function()
{
    $http({
        method : "GET",
        url: "json.php?json_id=ucitaj_narucene"
    }).then(function(response) {
        console.log(response);
        $scope.oPacijenti_naruceni = response.data;
    },function (response) {
        console.log('Došlo je do pogreške');
    });
};

$scope.UcitajCijepljene = function()
{
    $http({
        method : "GET",
        url: "json.php?json_id=ucitaj_cijepljene"
    }).then(function(response) {
        console.log(response);
        $scope.oPacijenti_cijepljeni = response.data;
    },function (response) {
        console.log('Došlo je do pogreške');
    });
};

$scope.UcitajTestiranje = function()
{
    $http({
        method : "GET",
        url: "json.php?json_id=ucitaj_testiranja"
    }).then(function(response) {
        console.log(response);
        $scope.oPacijenti_testiranje = response.data;
    },function (response) {
        console.log('Došlo je do pogreške');
    });
};

$scope.UcitajPovijestTestiranja = function()
{
    $http({
        method : "GET",
        url: "json.php?json_id=ucitaj_povijest_testiranja"
    }).then(function(response) {
        console.log(response);
        $scope.oPacijenti_povijest_testiranja = response.data;
    },function (response) {
        console.log('Došlo je do pogreške');
    });
};

$scope.UcitajRezultate = function()
{
    $http({
        method : "GET",
        url: "json.php?json_id=ucitaj_rezultate"
    }).then(function(response) {
        console.log(response);
        $scope.oPacijenti_rezultati = response.data;
    },function (response) {
        console.log('Došlo je do pogreške');
    });
};

$scope.UcitajNaCekanju();
$scope.UcitajNarucene();
$scope.UcitajCijepljene();
$scope.UcitajTestiranje();
$scope.UcitajPovijestTestiranja();
$scope.UcitajRezultate();

$scope.GetModal = function(naziv, pacijent)
    {
        if(naziv=='uredi')
        {
            $scope.inptVrstacjepiva = "1";
            $scope.inptOIB = pacijent.oib;
            $scope.inpttoken = pacijent.token;
            $('#azurirajpacijenta').modal
            ({
                show: true
            });   
        }
    }

$scope.GetModal2 = function(naziv2, pacijent2)
    {
        if(naziv2=='uredi2')
        {
            $scope.inptPrvaDoza = pacijent2.prva_doza_status;
            $scope.inptDrugaDoza = pacijent2.druga_doza_status;
            $scope.inptOIB2 = pacijent2.oib;
            $scope.inpttoken2 = pacijent2.token;
            $('#inptDatumPrvaDoza2').val(pacijent2.prva_doza_datum);
            $('#inptDatumDrugaDoza2').val(pacijent2.druga_doza_datum);
            $('#azurirajpacijenta2').modal
            ({
                show: true
            });   
        }
    }

    $scope.GetModal3 = function(naziv3, pacijent3)
    {
        if(naziv3=='uredi3')
        {
            if(pacijent3.rezultat=="N/A"){

                $scope.inptRezultatTestiranja = "Na čekanju";
            }
            else{

                $scope.inptRezultatTestiranja = pacijent3.rezultat;
                $('#inptDatumTestiranja').val(pacijent3.datum); 
            }
            
            $scope.inptID = pacijent3.id;
            $scope.inpttoken3 = pacijent3.token;
            $('#azurirajpacijenta3').modal
            ({
                show: true
            });   
        }
    }

    $scope.AzurirajPacijenta = function()
    {
        var Datum1 = $('#inptDatumPrvaDoza').data("DateTimePicker").date().format('YYYYMMDD');
        var Datum2 = $('#inptDatumDrugaDoza').data("DateTimePicker").date().format('YYYYMMDD');
        var Status = "Naručen";
        var oData = {
            'action_id':'azuriraj_pacijenta',
            'vrsta_cjepiva': $scope.inptVrstacjepiva,
            'prva_doza_datum': Datum1,
            'prva_doza_status': Status,
            'druga_doza_datum': Datum2,
            'druga_doza_status': Status,
            'OIB': $scope.inptOIB,
            'token': $scope.inpttoken
        };

        $http.post('action.php', oData)
        .then
        (
            function (response) 
            {
                console.log(response);
                $scope.UcitajNaCekanju();
                window.location.reload();
            },
            function (e) 
            {
                console.log("Greska");
                $scope.UcitajNaCekanju();
                window.location.reload();
            }
        );
    };

    $scope.AzurirajPacijenta2 = function()
    {
        var postojecidatum=$('#inptDatumPrvaDoza2').val();
        var postojecidatum2=$('#inptDatumDrugaDoza2').val();
        var Datum_prve_doze;
        var Datum_druge_doze;
        if(postojecidatum=="")
        {
            Datum_prve_doze = $('#inptDatumPrvaDoza2').data("DateTimePicker").date().format('YYYYMMDD');
        }
        else{
            Datum_prve_doze=postojecidatum.split('.').reverse().join('')
        }
        if(postojecidatum2=="")
        {
            Datum_druge_doze = $('#inptDatumDrugaDoza2').data("DateTimePicker").date().format('YYYYMMDD');
        }
        else{
            Datum_druge_doze=postojecidatum2.split('.').reverse().join('')
        }
        var oData = {
            'action_id':'azuriraj_pacijenta2',
            'prva_doza_datum': Datum_prve_doze,
            'prva_doza_status': $scope.inptPrvaDoza,
            'druga_doza_datum': Datum_druge_doze,
            'druga_doza_status': $scope.inptDrugaDoza,
            'OIB': $scope.inptOIB2,
            'token': $scope.inpttoken2
        };

        $http.post('action.php', oData)
        .then
        (
            function (response) 
            {
                console.log(response);
                $scope.UcitajNarucene();
                window.location.reload();
            },
            function (e) 
            {
                console.log("Greska");
                $scope.UcitajNarucene();
                window.location.reload();
            }
        );
    };

    $scope.AzurirajTestiranje = function()
    {
        var postojecidatum=$('#inptDatumTestiranja').val();
        var Datum_testiranja;
        if(postojecidatum=="")
        {
            Datum_testiranja = $('#inptDatumTestiranja').data("DateTimePicker").date().format('YYYYMMDD');
        }
        else{
            Datum_testiranja=postojecidatum.split('.').reverse().join('')
        }
        var oData = {
            'action_id':'azuriraj_testiranje',
            'datum': Datum_testiranja,
            'rezultat': $scope.inptRezultatTestiranja,
            'ID': $scope.inptID,
            'token': $scope.inpttoken3
        };

        $http.post('action.php', oData)
        .then
        (
            function (response) 
            {
                console.log(response);
                $scope.UcitajTestiranje();
                window.location.reload();
            },
            function (e) 
            {
                console.log("Greska");
                $scope.UcitajTestiranje();
                window.location.reload();
            }
        );
    };

    $scope.ProvjeraNarucivanje=function()
    {
        if (document.forms['frm1'].prva.value === "" || document.forms['frm1'].druga.value === "") {
    alert("Molim Vas popunite sva polja!");
    }
    else
    {
        $scope.AzurirajPacijenta();
    }
}

$scope.ProvjeraNarucivanje2=function()
    {
        if (document.forms['frm3'].prva2.value === "" || document.forms['frm3'].druga2.value === "") {
    alert("Molim Vas popunite sva polja!");
    }
    else
    {
        $scope.AzurirajPacijenta2();
    }
}

$scope.ProvjeraTestiranje=function()
    {
        if (document.forms['frm4'].datum_testiranje.value === "" || document.forms['frm4'].datum_testiranje.value === "...") {
    alert("Molim Vas popunite sva polja!");
    }
    else
    {
        $scope.AzurirajTestiranje();
    }
}

$scope.DohvatiOIBTestiranog=function(oibtestiranog){
    localStorage.setItem('test', oibtestiranog);
    

};
$scope.trenutnioib=localStorage.getItem("test");


});


/*var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();

today = dd + '.' + mm + '.' + yyyy + '.';
document.write(today);*/


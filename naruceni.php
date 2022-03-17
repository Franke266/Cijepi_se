<!DOCTYPE html>
<html lang="hr" ng-app="pacijenti-app">

<head>
    <title>Cijepi se</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <link href="plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/angular.min.js"></script>
    <script src="js/angular-route.min.js"></script>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="150" ng-app="pacijenti-app" ng-controller="pacijentiController">
    <header>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <img src="img/vuv_hr.png" height="60" width="270">
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index.php">Na čekanju</a></li>
                        <li class="active"><a href="naruceni.php">Naručeni</a></li>
                        <li><a href="cijepljeni.php">Cijepljeni</a></li>
                        <li><a href="testiranje.php">Testiranje</a></li>
                        <li><a href="povijest_testiranja.php">Povijest testiranja</a></li>
                    </ul>
                   
                </div>
            </div>
        </nav>
        <div class="jumbotron">
           
        </div>
    </header>

    
    <div class="container-fluid">
    <table class="table table-hover">
        <input id="searchInput" ng-model="searchText" placeholder="Pretraži">
        <select id="filter" ng-model="filterzupanije.zupanija">
            <option value="!!">Oaberite županiju:</option>
            <option ng-repeat="zupanija in oZupanije" ng-click="filterzupanije(zupanija.naziv_zupanije)">{{zupanija.naziv_zupanije}}</option>
        </select>
        <select id="filter" ng-model="filtergodina.god">
            <option value="!!">Dob:</option>
            <option ng-repeat="god in oGodine" ng-click="filtergodina(god)">{{god}}</option>
        </select>
            <thead>
                <tr>
                    <th>Rbr.</th>
                    <th>Ime</th>
                    <th>Prezime</th>
                    <th>Adresa</th>
                    <th>Grad</th>
                    <th>Županija</th>
                    <th>OIB</th>
                    <th>Datum rođenja</th>
                    <th>Cjepivo</th>
                    <th>Prva doza</th>
                    <th></th>
                    <th>Druga doza</th>
                    <th></th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="pacijent2 in oPacijenti_naruceni | filter:searchText | filter:filterzupanije | filter:filterpostarosti('god', filtergodina.god)">
                    <td>{{$index + 1}}</td>
                    <td>{{pacijent2.ime}}</td>
                    <td>{{pacijent2.prezime}}</td>
                    <td>{{pacijent2.adresa}}</td>
                    <td>{{pacijent2.grad}}</td>
                    <td>{{pacijent2.zupanija}}</td>
                    <td>{{pacijent2.oib}}</td>
                    <td>{{pacijent2.datum_rodenja}}</td>
                    <td>{{pacijent2.cjepivo}}</td>
                    <td>{{pacijent2.prva_doza_status}}</td>
                    <td>{{pacijent2.prva_doza_datum}}</td>
                    <td>{{pacijent2.druga_doza_status}}</td>
                    <td>{{pacijent2.druga_doza_datum}}</td>
                    <td><a ng-click="GetModal2('uredi2', pacijent2)">
                        <span class="glyphicon glyphicon-calendar" style="font-size:1.5em;"></span>
                    </a> </td>   
                </tr>
            </tbody>
        </table>

    </div>

    <div class="modal" id="azurirajpacijenta2" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color:#1E90FF">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="color:white"> Ažuriraj pacijenta</h4>
            </div>          
            <div class="modal-body">
                <form class="form-horizontal" name="frm3">
                    <div class="form-group">
                        <label class="control-label col-md-3">Prva doza</label>
                        <div class="col-md-8">
                            <input name="prva2" id="inptDatumPrvaDoza2" type="text" class="form-control date" placeholder="Odaberite datum">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Pacijent je primio prvu dozu</label>
                        <div class="col-md-8">
                         <label class="dozada" for="prvadozada">Da
                            <input id="prvadozada" type="radio" ng-model="inptPrvaDoza" value="Cijepljen">
                            </label></br>
                            <label class="dozane" for="prvadozane">Ne
                            <input id="prvadozane" type="radio" ng-model="inptPrvaDoza" value="Naručen">
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Druga doza</label>
                        <div class="col-md-8">
                            <input name="druga2" id="inptDatumDrugaDoza2" type="text" class="form-control date" placeholder="Odaberite datum">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Pacijent je primio drugu dozu</label>
                        <div class="col-md-8">
                            <label class="dozada" for="drugadozada">Da
                            <input id="drugadozada" type="radio" ng-model="inptDrugaDoza" value="Cijepljen">
                            </label></br>
                            <label class="dozane" for="drugadozane">Ne
                            <input id="drugadozane" type="radio" ng-model="inptDrugaDoza" value="Naručen">
                            </label></br>
                        </div>
                    </div>

                    
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-s" ng-click="ProvjeraNarucivanje2()" data-dismiss="modal">Spremi</button>
                <button type="button" class="btn btn-default" onClick="window.location.reload();" data-dismiss="modal">Odustani</button>
            </div>
        </div>
    </div>
</div>
   

    

    <footer>
        <div class="container-fluid futer-container">
            <div class="row">
                <div class="col-sm-12 col-xs-4 text-center">
                    <p>                    
                    </p>             
                    <p> &copy; 2022 - Cijepi se | Ivan Franjić</p>
                   </div>
            </div>
        </div>
    </footer>
    <script src="js/script.js"></script>
    <script src="plugins/bootstrap-daterangepicker/moment.js"></script>
    <script src="plugins/moment/moment-with-locales.min.js"></script>
    <script src="plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
            $(function () {
                DateTimePicker4();
                DateTimePicker5();
            });
    </script>
</body>

</html>
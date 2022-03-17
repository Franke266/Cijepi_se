<!DOCTYPE html>
<html lang="hr" ng-app="pacijenti-app">

<head>
    <title>Cijepi se</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
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
                        <li><a href="naruceni.php">Naručeni</a></li>
                        <li class="active"><a href="cijepljeni.php">Cijepljeni</a></li>
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
                    <th>Datum cijepljenja</th>

                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="pacijent in oPacijenti_cijepljeni | filter:searchText | filter:filterzupanije | filter:filterpostarosti('god', filtergodina.god)">
                    <td>{{$index + 1}}</td>
                    <td>{{pacijent.ime}}</td>
                    <td>{{pacijent.prezime}}</td>
                    <td>{{pacijent.adresa}}</td>
                    <td>{{pacijent.grad}}</td>
                    <td>{{pacijent.zupanija}}</td>
                    <td>{{pacijent.oib}}</td>
                    <td>{{pacijent.datum_rodenja}}</td>
                    <td>{{pacijent.cjepivo}}</td>
                    <td>{{pacijent.druga_doza_datum}}</td> 
                </tr>
            </tbody>
        </table>

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
</body>

</html>
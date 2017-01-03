<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once('core/constants.php');
require_once('core/functions.php');
$all_consults = getAllConsults();
$all_doctors = getAllDoctors();
$all_meds = getAllMeds();
$all_pacients = getAllPacients();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(isset($_POST['save_consult'])){
    $data = array($_POST['data'],
                  $_POST['diagnostic'],
                  $_POST['doza_medicament'],
                  $_POST['medic_id'],
                  $_POST['medicament_id'],
                  $_POST['pacient_id']
                  );
    if(addConsultatie($data)){
      setMessage(1, 'Consultatia a fost salvata cu succes.');
      $all_consults = getAllConsults();
    }else{
      setMessage(0, 'Consultatia nu a fost salvata.');
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consultatii</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://bootswatch.com/united/bootstrap.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <header id='header' style="height:30px">
        <nav class="navbar navbar-default navbar-fixed-top tall">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" data-target="#myNavbar" data-toggle="collapse"
                            class="btn btn-default btn-lg navbar-toggle">
                        <span class="glyphicon glyphicon-menu-hamburger " aria-hidden="true"></span>
                    </button>
                    <a href="index.php" class="navbar-brand">Proiect 3</a>
                </div>
                <!-- Collection of nav links and other content for toggling -->
                <div id="myNavbar" class="collapse navbar-collapse">
                  <ul class="nav navbar-nav navbar-right">
                      <li class="active"><a href="index.php">Consultatii</a></li>
                      <li><a href="medici.php">Medici</a></li>
                      <li><a href="pacienti.php">Pacienti</a></li>
                      <li><a href="medicamente.php">Medicamente</a></li>
                  </ul>
                </div>
            </div>
        </nav>
    </header>

    <section id='container' style="background-color:#337ab7; color: white; display: block; margin-right: auto; margin-left: auto; margin-top: 50px;" class="container">
      <div class="panel panel-info" style="margin-top:20px;">
        <!-- Default panel contents -->
        <div class="panel-heading">Adaugare</div>
        <?php showMessages(); ?>
          <div class="panel-body">
            <form class="form-horizontal" method="post" style="color: black;">
              <div class="form-group">
                <label for="data" class="col-sm-2 control-label">Data</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" name="data" id="data" placeholder="Data">
                </div>
              </div>
              <div class="form-group">
                <label for="diagnostic" class="col-sm-2 control-label">Diagnostic</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="diagnostic" id="diagnostic" placeholder="Diagnostic">
                </div>
              </div>
              <div class="form-group">
                <label for="doza_medicament" class="col-sm-2 control-label">Doza Medicament</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="doza_medicament" id="doza_medicament" placeholder="Doza Medicament">
                </div>
              </div>
              <div class="form-group">
                <label for="medic_id" class="col-sm-2 control-label">Medic</label>
                <div class="col-sm-10">
                  <select id="medic_id" name="medic_id" class="form-control">
                    <?php
                    foreach($all_doctors as $doc){
                      echo '<option value="'.$doc['MedicID'].'">'.$doc['NumeMedic'].' '.$doc['PrenumeMedic'].'</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="medicament_id" class="col-sm-2 control-label">Medicament</label>
                <div class="col-sm-10">
                  <select id="medicament_id" name="medicament_id" class="form-control">
                    <?php
                    foreach($all_meds as $med){
                      echo '<option value="'.$med['MedicamentID'].'">'.$med['Denumire'].'</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="pacient_id" class="col-sm-2 control-label">Pacient</label>
                <div class="col-sm-10">
                  <select id="pacient_id" name="pacient_id" class="form-control">
                    <?php
                    foreach($all_pacients as $pacient){
                      echo '<option value="'.$pacient['PacientID'].'">'.$pacient['NumePacient'].' '.$pacient['PrenumePacient'].'</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" name="save_consult" class="btn btn-default">Salveaza</button>
                </div>
              </div>
            </form>
          </div>
      </div>
      <div class="panel panel-success" style="margin-top:20px;">
        <!-- Default panel contents -->
        <div class="panel-heading">Vizualizare</div>
          <!-- Table -->
          <table class="table table-condensed text-info">
            <thead>
              <tr>
                <th>#ID</th>
                <th>Nume/Prenume medic</th>
                <th>Denumire medicament</th>
                <th>Nume/Prenume pacient</th>
                <th>Data</th>
                <th>Diagnostic</th>
                <th>Doza medicament</th>
                <th>Actiuni</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach($all_consults as $consults){
                  buildModificareConsultModals($consults);
                  echo '<tr>
                          <td>'.$consults['ConsultatieID'].'</td>
                          <td>'.$consults['NumePrenumeMedic'].'</td>
                          <td>'.$consults['MedicamentDenumire'].'</td>
                          <td>'.$consults['NumePrenumePacient'].'</td>
                          <td>'.$consults['Data'].'</td>
                          <td>'.$consults['Diagnostic'].'</td>
                          <td>'.$consults['DozaMedicament'].'</td>
                          <td>
                            <a data-toggle="modal" data-target="#modal-id-'.$consults['ConsultatieID'].'" title="Modifica" href="#"><i class="glyphicon glyphicon-cog"></i></a>
                            <a onclick="deleteConsult('.$consults['ConsultatieID'].')" title="Sterge" href="#"><i class="glyphicon glyphicon-remove"></i></a>
                          </td>
                        </tr>';
                }
               ?>
            </tbody>
          </table>
      </div>
      <div class="modals-wrapper">
        <?php
          echo implode('', $modifyConsults);
        ?>
      </div>
    </section>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/requests.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>

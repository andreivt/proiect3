<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once('core/constants.php');
require_once('core/functions.php');
$all_doctors = getAllDoctors();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(isset($_POST['save_doctor'])){
    $data = array($_POST['nume_medic'],
                  $_POST['prenume_medic'],
                  $_POST['specializare']
                  );
    if(addDoctor($data)){
      setMessage(1, 'Medicul a fost salvat cu succes.');
      $all_doctors = getAllDoctors();
    }else{
      setMessage(0, 'Medicul nu a fost salvat.');
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
    <title>Medici</title>

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
                      <li><a href="index.php">Consultatii</a></li>
                      <li class="active"><a href="medici.php">Medici</a></li>
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
                <label for="nume_medic" class="col-sm-2 control-label">Nume</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="nume_medic" id="nume_medic" placeholder="Nume Medic">
                </div>
              </div>
              <div class="form-group">
                <label for="prenume_medic" class="col-sm-2 control-label">Prenume</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="prenume_medic" id="prenume_medic" placeholder="Prenume Medic">
                </div>
              </div>
              <div class="form-group">
                <label for="specializare" class="col-sm-2 control-label">Specializare</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="specializare" id="specializare" placeholder="Specializare">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" name="save_doctor" class="btn btn-default">Salveaza</button>
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
                <th>Nume</th>
                <th>Prenume</th>
                <th>Specializare</th>
                <th>Actiuni</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach($all_doctors as $medic){
                  buildModificareMedicModals($medic);
                  echo '<tr>
                          <td>'.$medic['MedicID'].'</td>
                          <td>'.$medic['NumeMedic'].'</td>
                          <td>'.$medic['PrenumeMedic'].'</td>
                          <td>'.$medic['Specializare'].'</td>
                          <td>
                            <a data-toggle="modal" data-target="#modal-id-'.$medic['MedicID'].'" title="Modifica" href="#"><i class="glyphicon glyphicon-cog"></i></a>
                            <a onclick="deleteMedic('.$medic['MedicID'].')" title="Sterge" href="#"><i class="glyphicon glyphicon-remove"></i></a>
                          </td>
                        </tr>';
                }
               ?>
            </tbody>
          </table>
      </div>
      <div class="modals-wrapper">
        <?php
          echo implode('', $modifyMedic);
        ?>
      </div>
    </section>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/requests.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>

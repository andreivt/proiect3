<?php
require_once 'functions.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(isset($_POST['delete_consult'])){
    echo deleteConsult($_POST['consultatieID']);
  }

  if(isset($_POST['modify_medicament'])) {
    $id = $_POST['MedicamentID'];
    $val = $_POST['Denumire'];
    echo modifyMedicament($id, $val);
  }

  if(isset($_POST['delete_medicament'])) {
    $id = $_POST['MedicamentID'];
    echo deleteMedicament($id);
  }

  if(isset($_POST['delete_pacient'])) {
    $id = $_POST['PacientID'];
    echo deletePacient($id);
  }

  if(isset($_POST['modify_pacient'])) {
    $pacientID = $_POST['PacientID'];
    $numePacient = $_POST['numePacient'];
    $prenumePacient = $_POST['prenumePacient'];
    $cnp = $_POST['cnp'];
    $adresaPacient = $_POST['adresaPacient'];
    $asigurare = $_POST['asigurare'];
    echo modifyPacient(array( $numePacient,
                              $prenumePacient,
                              $cnp,
                              $adresaPacient,
                              $asigurare,
                              $pacientID
                            ));
  }

  if(isset($_POST['delete_medic'])) {
    $id = $_POST['MedicID'];
    echo deleteMedic($id);
  }

  if(isset($_POST['modify_medic'])) {
    $medicID = $_POST['MedicID'];
    $numeMedic = $_POST['NumeMedic'];
    $prenumeMedic = $_POST['PrenumeMedic'];
    $specializare = $_POST['Specializare'];
    echo modifyMedic(array( $numeMedic,
                              $prenumeMedic,
                              $specializare,
                              $medicID
                            ));
  }

  if(isset($_POST['modify_consult'])) {

    $consultatieID = $_POST['ConsultatieID'];
    $data = $_POST['data'];
    $diagnostic = $_POST['diagnostic'];
    $doza_medicament = $_POST['doza_medicament'];
    $medic_id = $_POST['medic_id'];
    $medicament_id = $_POST['medicament_id'];
    $pacient_id = $_POST['pacient_id'];


    echo modifyConsult(array( $data,
                              $diagnostic,
                              $doza_medicament,
                              $medic_id,
                              $medicament_id,
                              $pacient_id,
                              $consultatieID
                            ));
  }
}

?>

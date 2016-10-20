<?php
require_once 'db.php';
$messages = array(); // will hold error messages

function getAllDoctors() {
  global $connection;
  $sth = $connection->prepare("SELECT * FROM Medic");
  $sth->execute();
  return $sth->fetchAll(PDO::FETCH_ASSOC);
}

function addDoctor($data) {
  global $connection;
  $sth = $connection->prepare("INSERT INTO Medic(NumeMedic, PrenumeMedic, Specializare) VALUES ( ? , ? , ?)");
  if( $sth->execute($data) ) {
    return true;
  } else {
    return false;
  }
}

function setMessage($status, $message) {
  global $messages;
  array_push($messages, array('status' => $status,
                              'message' => $message));
}

function showMessages() {
  global $messages;
  if(empty($messages)) return;

  $html = '<div id="messages_holder" style="width: 50%;margin-top: 1em;color: black;margin-left: auto;margin-right: auto;">';

  foreach($messages as $message) {
    if($message['status']) {
      $html .= '<div class="bg-success" style="padding: 5px;margin: 1px;border-radius: 10px;text-align: center;">'.$message['message'].'</div>';
    }else{
      $html .= '<div class="bg-danger" style="padding: 5px;margin: 1px;border-radius: 10px;text-align: center;">'.$message['message'].'</div>';
    }
  }

  $html .= '</div>';

  echo $html;
}

function getAllPacients() {
  global $connection;
  $sth = $connection->prepare("SELECT * FROM Pacient");
  $sth->execute();
  return $sth->fetchAll(PDO::FETCH_ASSOC);
}

function addPacient($data) {
  global $connection;
  $sth = $connection->prepare("INSERT INTO Pacient(NumePacient, PrenumePacient, CNP, Adresa, Asigurare) VALUES ( ?, ?, ?, ?, ?)");
  if( $sth->execute($data) ) {
    return true;
  } else {
    return false;
  }
}

function getAllMeds() {
  global $connection;
  $sth = $connection->prepare("SELECT * FROM Medicamente");
  $sth->execute();
  return $sth->fetchAll(PDO::FETCH_ASSOC);
}

function addMed($data) {
  global $connection;
  $sth = $connection->prepare("INSERT INTO Medicamente(Denumire) VALUES ( ? )");
  if( $sth->execute($data) ) {
    return true;
  } else {
    return false;
  }
}

function getAllConsults() {
  global $connection;
  $sth = $connection->prepare("SELECT c.Data, c.Diagnostic, c.DozaMedicament, c.ConsultatieID, CONCAT(m.NumeMedic, ' ', m.PrenumeMedic) AS NumePrenumeMedic, med.Denumire AS MedicamentDenumire, CONCAT(p.NumePacient,' ', p.PrenumePacient) AS NumePrenumePacient FROM Consultatie c LEFT JOIN Medic m ON m.MedicID = c.MedicID LEFT JOIN Medicamente med ON med.MedicamentID = c.MedicamentID LEFT JOIN Pacient p ON p.PacientID = c.PacientID");
  $sth->execute();
  return $sth->fetchAll(PDO::FETCH_ASSOC);
}

function addConsultatie($data){
  global $connection;
  $sth = $connection->prepare("INSERT INTO Consultatie(Data, Diagnostic, DozaMedicament, MedicID, MedicamentID, PacientID) VALUES ( ?, ?, ?, ?, ?, ? )");
  if( $sth->execute($data) ) {
    return true;
  } else {
    return false;
  }
}

function deleteConsult($id) {
  global $connection;
  $sth = $connection->prepare("DELETE FROM Consultatie WHERE ConsultatieID = ?");
  if( $sth->execute(array($id)) ) {
    return true;
  } else {
    return false;
  }
}

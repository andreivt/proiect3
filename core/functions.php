<?php
require_once 'db.php';
require_once 'templates.php';
$messages = array(); // will hold error messages
$modifyMeds = array();
$modifyPacienti = array();
$modifyMedic = array();
$modifyConsults = array();

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
  return $sth->execute(array($id));
}

function buildModificareMedicamenteModals($data) {
  global $templateModalMedicamente, $modifyMeds;
  $to_search = array('__ID__', '__VALUE__');
  $to_replace = array($data['MedicamentID'], $data['Denumire']);
  $new = str_replace($to_search, $to_replace, $templateModalMedicamente);
  array_push($modifyMeds, $new);
}

function deleteMedicament($id) {
  global $connection;
  $sth = $connection->prepare("DELETE FROM Medicamente WHERE MedicamentID = ?");
  return $sth->execute(array($id));
}

function modifyMedicament($id, $val) {
  global $connection;
  $sth = $connection->prepare("UPDATE Medicamente SET Denumire = ? WHERE MedicamentID = ?");
  return $sth->execute(array($val, $id));
}

function buildModificarePacientiModals($data) {
  global $templateModalPacienti, $modifyPacienti;
  $to_search = array('__ID__', '__NUME__', '__PRENUME__', '__CNP__', '__ADRESA__', '__ASIGURARE_DA__', '__ASIGURARE_NU__');
  $to_replace = array($data['PacientID'], $data['NumePacient'], $data['PrenumePacient'], $data['CNP'], $data['Adresa'], ($data['Asigurare'] == 1 ? 'checked' : ''), ($data['Asigurare'] == 0 ? 'checked' : ''));
  $new = str_replace($to_search, $to_replace, $templateModalPacienti);
  array_push($modifyPacienti, $new);
}

function deletePacient($id) {
  global $connection;
  $sth = $connection->prepare("DELETE FROM Pacient WHERE PacientID = ?");
  return $sth->execute(array($id));
}

function modifyPacient($data) {
  global $connection;
  $sth = $connection->prepare("UPDATE Pacient SET NumePacient = ?, PrenumePacient = ?, CNP = ?, Adresa = ?, Asigurare = ? WHERE PacientID = ?");
  return $sth->execute($data);
}

function buildModificareMedicModals($data) {
  global $templateModalMedic, $modifyMedic;
  $to_search = array('__ID__', '__NUME__', '__PRENUME__', '__SPECIALIZARE__');
  $to_replace = array($data['MedicID'], $data['NumeMedic'], $data['PrenumeMedic'], $data['Specializare']);
  $new = str_replace($to_search, $to_replace, $templateModalMedic);
  array_push($modifyMedic, $new);
}

function deleteMedic($id) {
  global $connection;
  $sth = $connection->prepare("DELETE FROM Medic WHERE MedicID = ?");
  return $sth->execute(array($id));
}

function modifyMedic($data) {
  global $connection;
  $sth = $connection->prepare("UPDATE Medic SET NumeMedic = ?, PrenumeMedic = ?, Specializare = ? WHERE MedicID = ?");
  return $sth->execute($data);
}


function buildModificareConsultModals($data) {
  global $templateModalConsults, $modifyConsults;

  $all_doctors = getAllDoctors();
  $all_meds = getAllMeds();
  $all_pacients = getAllPacients();

  $docsTmp = array();
  $medsTmp = array();
  $pacsTmp = array();

  foreach($all_doctors as $doc){
    array_push($docsTmp, '<option value="'.$doc['MedicID'].'">'.$doc['NumeMedic'].' '.$doc['PrenumeMedic'].'</option>');
  }
  foreach($all_meds as $med){
    array_push($medsTmp, '<option value="'.$med['MedicamentID'].'">'.$med['Denumire'].'</option>');
  }
  foreach($all_pacients as $pacient){
    array_push($pacsTmp, '<option value="'.$pacient['PacientID'].'">'.$pacient['NumePacient'].' '.$pacient['PrenumePacient'].'</option>');
  }

  $to_search = array('__ID__', '__DATA__', '__DIAGNOSTIC__', '__DOZA_MEDICAMENT__', '__MEDICI__', '__MEDICAMENTE__', '__PACIENTI__');
  $to_replace = array($data['ConsultatieID'], $data['Data'], $data['Diagnostic'], $data['DozaMedicament'], implode(' ', $docsTmp), implode(' ', $medsTmp), implode(' ', $pacsTmp));
  $new = str_replace($to_search, $to_replace, $templateModalConsults);
  array_push($modifyConsults, $new);
}

function modifyConsult($data) {
  global $connection;
  $sth = $connection->prepare("UPDATE Consultatie SET Data = ?, Diagnostic = ?, DozaMedicament = ?, MedicID = ?, MedicamentID = ?, PacientID = ? WHERE ConsultatieID = ?");
  return $sth->execute($data);
}

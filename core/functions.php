<?php
require_once 'db.php';
$messages = array(); // will hold error messages
$modifyMeds = array();
$modifyPacienti = array();
$modifyMedic = array();
$modifyConsults = array();

$templateModalMedicamente = '<div id="modal-id-__ID__" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 style="color: black;" class="modal-title">Modifica medicamentul cu ID: __ID__</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label style="color: black;" for="nume">Nume</label>
          <input type="text" class="form-control" id="nume" placeholder="Nume" value="__VALUE__">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="modifyMedicament(\'__ID__\')">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->';

$templateModalPacienti = '<div id="modal-id-__ID__" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 style="color: black;" class="modal-title">Modifica pacientul cu ID: __ID__</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="post" style="color: black;">
          <div class="form-group">
            <label style="color: black;" for="nume_pacient" class="col-sm-2 control-label">Nume</label>
            <div class="col-sm-10">
              <input value="__NUME__" type="text" class="form-control" name="nume_pacient" id="nume_pacient" placeholder="Nume Pacient">
            </div>
          </div>
          <div class="form-group">
            <label style="color: black;" for="prenume_pacient" class="col-sm-2 control-label">Prenume</label>
            <div class="col-sm-10">
              <input value="__PRENUME__" type="text" class="form-control" name="prenume_pacient" id="prenume_pacient" placeholder="Prenume Pacient">
            </div>
          </div>
          <div class="form-group">
            <label style="color: black;" for="cnp_pacient" class="col-sm-2 control-label">CNP</label>
            <div class="col-sm-10">
              <input value="__CNP__" type="text" class="form-control" name="cnp_pacient" id="cnp_pacient" placeholder="CNP Pacient">
            </div>
          </div>
          <div class="form-group">
            <label style="color: black;" for="adresa_pacient" class="col-sm-2 control-label">Adresa</label>
            <div class="col-sm-10">
              <input value="__ADRESA__" type="text" class="form-control" name="adresa_pacient" id="adresa_pacient" placeholder="Adresa">
            </div>
          </div>
          <div class="form-group">
            <label style="color: black;" for="asigurare_pacient" class="col-sm-2 control-label">Asigurare</label>
            <div style="color: black;" class="col-sm-10">
              <input type="radio" name="asigurare_pacient" id="asigurare_pacient" value="1" __ASIGURARE_DA__  >Da
              <input type="radio" name="asigurare_pacient" value="0" __ASIGURARE_NU__  >Nu
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="modifyPacient(\'__ID__\')">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->';

$templateModalMedic = '<div id="modal-id-__ID__" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 style="color: black;" class="modal-title">Modifica medicul cu ID: __ID__</h4>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" method="post" style="color: black;">
        <div class="form-group">
          <label for="nume_medic" class="col-sm-2 control-label">Nume</label>
          <div class="col-sm-10">
            <input value="__NUME__" type="text" class="form-control" name="nume_medic" id="nume_medic" placeholder="Nume Medic">
          </div>
        </div>
        <div class="form-group">
          <label for="prenume_medic" class="col-sm-2 control-label">Prenume</label>
          <div class="col-sm-10">
            <input value="__PRENUME__" type="text" class="form-control" name="prenume_medic" id="prenume_medic" placeholder="Prenume Medic">
          </div>
        </div>
        <div class="form-group">
          <label for="specializare" class="col-sm-2 control-label">Specializare</label>
          <div class="col-sm-10">
            <input value="__SPECIALIZARE__" type="text" class="form-control" name="specializare" id="specializare" placeholder="Specializare">
          </div>
        </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="modifyMedic(\'__ID__\')">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->';

$templateModalConsults = '<div id="modal-id-__ID__" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 style="color: black;" class="modal-title">Modifica consultatia cu ID: __ID__</h4>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" method="post" style="color: black;">
        <div class="form-group">
          <label for="data" class="col-sm-2 control-label">Data</label>
          <div class="col-sm-10">
            <input value="__DATA__" type="date" class="form-control" name="data" id="data" placeholder="Data">
          </div>
        </div>
        <div class="form-group">
          <label for="diagnostic" class="col-sm-2 control-label">Diagnostic</label>
          <div class="col-sm-10">
            <input value="__DIAGNOSTIC__" type="text" class="form-control" name="diagnostic" id="diagnostic" placeholder="Diagnostic">
          </div>
        </div>
        <div class="form-group">
          <label for="doza_medicament" class="col-sm-2 control-label">Doza Medicament</label>
          <div class="col-sm-10">
            <input value="__DOZA_MEDICAMENT__" type="text" class="form-control" name="doza_medicament" id="doza_medicament" placeholder="Doza Medicament">
          </div>
        </div>
        <div class="form-group">
          <label for="medic_id" class="col-sm-2 control-label">Medic</label>
          <div class="col-sm-10">
            <select id="medic_id" name="medic_id" class="form-control">
            __MEDICI__
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="medicament_id" class="col-sm-2 control-label">Medicament</label>
          <div class="col-sm-10">
            <select id="medicament_id" name="medicament_id" class="form-control">
            __MEDICAMENTE__
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="pacient_id" class="col-sm-2 control-label">Pacient</label>
          <div class="col-sm-10">
            <select id="pacient_id" name="pacient_id" class="form-control">
            __PACIENTI__
            </select>
          </div>
        </div>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="modifyConsult(\'__ID__\')">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->';

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

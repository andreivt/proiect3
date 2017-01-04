<?php

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

?>

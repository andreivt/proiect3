function deleteConsult(id) {
    $.ajax({
            method: "POST",
            url: "core/requests.php",
            data: {
                delete_consult: 1,
                consultatieID: id
            }
        })
        .done(function(msg) {
            if (msg == 1) {
                location.reload();
            } else {
                alert('eroare');
            }
        });
}

function deleteMedicament(id) {
    $.ajax({
            method: "POST",
            url: "core/requests.php",
            data: {
                delete_medicament: 1,
                MedicamentID: id
            }
        })
        .done(function(msg) {
            if (msg == 1) {
                location.reload();
            } else {
                alert('eroare');
            }
        });
}

function modifyMedicament(id) {
    let newValue = document.querySelector('#modal-id-' + id + ' #nume').value;
    $.ajax({
            method: "POST",
            url: "core/requests.php",
            data: {
                modify_medicament: 1,
                MedicamentID: id,
                Denumire: newValue
            }
        })
        .done(function(msg) {
            if (msg == 1) {
                location.reload();
            } else {
                alert('eroare');
            }
        });
}

function deletePacient(id) {
    $.ajax({
            method: "POST",
            url: "core/requests.php",
            data: {
                delete_pacient: 1,
                PacientID: id
            }
        })
        .done(function(msg) {
            if (msg == 1) {
                location.reload();
            } else {
                alert('eroare');
            }
        });
}

function modifyPacient(id) {

    let numePacient = document.querySelector('#modal-id-' + id + ' #nume_pacient').value;
    let prenumePacient = document.querySelector('#modal-id-' + id + ' #prenume_pacient').value;
    let cnp = document.querySelector('#modal-id-' + id + ' #cnp_pacient').value;
    let adresaPacient = document.querySelector('#modal-id-' + id + ' #adresa_pacient').value;
    let asigurare = document.querySelector('#modal-id-' + id + ' input[name="asigurare_pacient"]:checked').value;

    $.ajax({
            method: "POST",
            url: "core/requests.php",
            data: {
                modify_pacient: 1,
                PacientID: id,
                numePacient: numePacient,
                prenumePacient: prenumePacient,
                cnp: cnp,
                adresaPacient: adresaPacient,
                asigurare: asigurare
            }
        })
        .done(function(msg) {
            if (msg == 1) {
                location.reload();
            } else {
                alert('eroare');
            }
        });
}

function deleteMedic(id) {
    $.ajax({
            method: "POST",
            url: "core/requests.php",
            data: {
                delete_medic: 1,
                MedicID: id
            }
        })
        .done(function(msg) {
            if (msg == 1) {
                location.reload();
            } else {
                alert('eroare');
            }
        });
}

function modifyMedic(id) {

    let nume_medic = document.querySelector('#modal-id-' + id + ' #nume_medic').value;
    let prenume_medic = document.querySelector('#modal-id-' + id + ' #prenume_medic').value;
    let specializare = document.querySelector('#modal-id-' + id + ' #specializare').value;

    $.ajax({
            method: "POST",
            url: "core/requests.php",
            data: {
                modify_medic: 1,
                MedicID: id,
                NumeMedic: nume_medic,
                PrenumeMedic: prenume_medic,
                Specializare: specializare
            }
        })
        .done(function(msg) {
            if (msg == 1) {
                location.reload();
            } else {
                alert('eroare');
            }
        });
}

function modifyConsult(id) {

    let data = document.querySelector('#modal-id-' + id + ' #data').value;
    let diagnostic = document.querySelector('#modal-id-' + id + ' #diagnostic').value;
    let doza_medicament = document.querySelector('#modal-id-' + id + ' #doza_medicament').value;
    let medicIdTmp = document.querySelector('#modal-id-' + id + ' #medic_id');
    let medic_id = medicIdTmp.options[medicIdTmp.selectedIndex].value;
    let medicamentIdTmp = document.querySelector('#modal-id-' + id + ' #medicament_id');
    let medicament_id = medicamentIdTmp.options[medicamentIdTmp.selectedIndex].value;
    let pacientIdTmp = document.querySelector('#modal-id-' + id + ' #pacient_id');
    let pacient_id = pacientIdTmp.options[pacientIdTmp.selectedIndex].value;

    $.ajax({
            method: "POST",
            url: "core/requests.php",
            data: {
                modify_consult: 1,
                ConsultatieID: id,
                data: data,
                diagnostic: diagnostic,
                doza_medicament: doza_medicament,
                medic_id: medic_id,
                medicament_id: medicament_id,
                pacient_id: pacient_id
            }
        })
        .done(function(msg) {
            if (msg == 1) {
                location.reload();
            } else {
                alert('eroare');
            }
        });
}

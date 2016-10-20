function deleteConsult(id) {
    alert(id);
    $.ajax({
            method: "POST",
            url: "core/requests.php",
            data: {
                delete_consult: 1,
                consultatieID: id
            }
        })
        .done(function(msg) {
            alert("Data Saved: " + msg);
        });
}

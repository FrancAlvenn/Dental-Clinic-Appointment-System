$(document).on('submit', '#saveAppointment', function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("save_student", true);

    $.ajax({
        type: "POST",
        url: "php/schedule-crud.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            
            var res = jQuery.parseJSON(response);
            if(res.status == 422) {
                $('#errorMessage').removeClass('d-none');
                $('#errorMessage').text(res.message);
            }else if(res.status == 200){
                $('#errorMessage').addClass('d-none');
                $('#studentAddModal').modal('hide');
                $('#saveAppointment')[0].reset();
            }else if(res.status == 500) {
                alert(res.message);
            }
        }
    });

});
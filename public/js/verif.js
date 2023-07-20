$(document).on('click', '#modalveriflihatschedule', function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    // console.log(id);
    var url = 'verifikator/datatask/user/pengerjaan/'+id;
    $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#showmodalverif').html(data);
        })
        .fail(function() {
            $('#showmodalverif').html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                );
        });
});

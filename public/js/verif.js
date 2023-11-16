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
$(document).on('click', '#buttontambahorderverify', function(e) {
    e.preventDefault();

    var url = 'verifikator/datatask/tambahorder';
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
$(document).on('click', '#button-grapic-cabang-verifikator', function(e) {
    e.preventDefault();

    var url = 'verifikator/datagraphic/task';
    $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#menu-data-cabang-verifikator').html(data);
        })
        .fail(function() {
            $('#menu-data-cabang-verifikator').html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                );
        });
});


$(document).on("click", "#submit-button-verifikator-user", function (e) {
    e.preventDefault();
    var data = $("#form-modal-verifikator").serialize();
    $("#show-laporan-verifikator").html(
        "<br><br><br><img src='loading.gif'  style='display: block; margin: auto;'>"
    );
    $.ajax({
        url: 'verifikator/datagraphic/posttask/',
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf"]').attr("content"),
        },
        type: "POST",
        data: data,
        dataType: "html",
    })
        .done(function (datapdf) {
            $("#show-laporan-verifikator").html('<iframe src="data:application/pdf;base64, '+datapdf+'" style="width:100%;; height:500px;" frameborder="0"></iframe>');
        })
        .fail(function () {
            // console.log(data);
            $("#show-laporan-verifikator").html(
                'Gagal Baca'
            );
        });
});
$(document).on("click", "#submit-button-verifikator-user-view", function (e) {
    e.preventDefault();
    var data = $("#form-modal-verifikator").serialize();
    $("#show-laporan-verifikator").html(
        "<br><br><br><img src='loading.gif'  style='display: block; margin: auto;'>"
    );
    $.ajax({
        url: 'verifikator/datagraphic/viewtask/',
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf"]').attr("content"),
        },
        type: "POST",
        data: data,
        dataType: "html",
    })
        .done(function (datapdf) {
            $("#show-laporan-verifikator").html(datapdf);
        })
        .fail(function () {
            // console.log(data);
            $("#show-laporan-verifikator").html(
                'Gagal Baca'
            );
        });
});

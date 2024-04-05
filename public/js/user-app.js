$(document).on("click", "#buttontiketpersonal", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    var url = "user/lihattiket/" + id;
    // console.log(id);
    $.ajax({
        url: url,
        type: "GET",
        dataType: "html",
    })
        .done(function (data) {
            $("#bodyformdatainputtiket").html(data);
        })
        .fail(function () {
            $("#bodyformdatainputtiket").html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
            );
        });
});
$(document).on("click", "#buttontiketgroup", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    var url = "user/group/lihattiket/" + id;
    console.log(id);
    $.ajax({
        url: url,
        type: "GET",
        dataType: "html",
    })
        .done(function (data) {
            $("#bodyformdatainputtiket").html(data);
        })
        .fail(function () {
            $("#bodyformdatainputtiket").html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
            );
        });
});
$(document).on("click", "#showdatatugas", function (e) {
    e.preventDefault();

    $.ajax({
        url: "user/lihattugas",
        type: "GET",
        dataType: "html",
    })
        .done(function (data) {
            $("#showdatatugasx").html(data);
        })
        .fail(function () {
            $("#showdatatugasx").html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
            );
        });
});
$(document).on("click", "#buttoninputlaporan", function (e) {
    e.preventDefault();
    $.ajax({
        url: "user/laporan/tambah",
        type: "GET",
        dataType: "html",
    })
        .done(function (data) {
            $("#bodyformdatainputtiket").html(data);
        })
        .fail(function () {
            $("#bodyformdatainputtiket").html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
            );
        });
});
$(document).on("click", "#buttontiketlaporan", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    $.ajax({
        url: "user/laporan/lihatdatalaporan/" + id,
        type: "GET",
        dataType: "html",
    })
        .done(function (data) {
            $("#lihatdatatask").html(data);
        })
        .fail(function () {
            $("#lihatdatatask").html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
            );
        });
});
$(document).on("click", "#buttonshowdetaillaporan", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    $.ajax({
        url: "user/laporan/lihatlaporan/" + id,
        type: "GET",
        dataType: "html",
    })
        .done(function (data) {
            $("#bodyformdatainputtiket").html(data);
        })
        .fail(function () {
            $("#bodyformdatainputtiket").html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
            );
        });
});
$(document).on("click", "#task_kinerja", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    $.ajax({
        url: "user/task/kinerja/" + id,
        type: "GET",
        dataType: "html",
    })
        .done(function (data) {
            $("#bodytask_kinerja").html(data);
        })
        .fail(function () {
            $("#bodytask_kinerja").html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
            );
        });
});
$(document).on("click", "#task_kinerja_admin", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    $.ajax({
        url: "user/task/kinerja-admin/" + id,
        type: "GET",
        dataType: "html",
    })
        .done(function (data) {
            $("#bodytask_kinerja").html(data);
        })
        .fail(function () {
            $("#bodytask_kinerja").html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
            );
        });
});
$(document).on("click", "#buttonmemberitugasuser", function (e) {
    e.preventDefault();
    $.ajax({
        url: "user/userleader/modal/beritugas",
        type: "GET",
        dataType: "html",
    })
        .done(function (data) {
            $("#bodyformdatainputtiket").html(data);
        })
        .fail(function () {
            $("#bodyformdatainputtiket").html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
            );
        });
});
$(document).on("click", "#buttonlihattugasuser", function (e) {
    e.preventDefault();
    $.ajax({
        url: "user/userleader/modal/lihattugas",
        type: "GET",
        dataType: "html",
    })
        .done(function (data) {
            $("#lihatdatatask").html(data);
        })
        .fail(function () {
            $("#lihatdatatask").html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
            );
        });
});
$(document).on("click", "#printkpi", function (e) {
    e.preventDefault();
    $.ajax({
        url: "user/userleader/modal/periodekpi",
        type: "GET",
        dataType: "html",
    })
        .done(function (data) {
            $("#bodyformdatainputtiket").html(data);
        })
        .fail(function () {
            $("#bodyformdatainputtiket").html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
            );
        });
});
$(document).on("click", "#printlaporanuser", function (e) {
    e.preventDefault();
    $.ajax({
        url: "user/userleader/modal/printlaporan",
        type: "GET",
        dataType: "html",
    })
        .done(function (data) {
            $("#bodyformdatainputtiket").html(data);
        })
        .fail(function () {
            $("#bodyformdatainputtiket").html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
            );
        });
});
$(document).on("click", "#buttondetailtask", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    $.ajax({
        url: "user/userleader/table/detailtask/" + id,
        type: "GET",
        dataType: "html",
    })
        .done(function (data) {
            $("#detaildatatask").html(data);
        })
        .fail(function () {
            $("#detaildatatask").html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
            );
        });
});
$(document).on("click", "#button-kinerja-user", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    $.ajax({
        url: "user/userleader/table/laporandatakinerja/" + id,
        type: "GET",
        dataType: "html",
    })
        .done(function (data) {
            $("#bodyformdatainputtiket").html(data);
        })
        .fail(function () {
            $("#bodyformdatainputtiket").html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
            );
        });
});
// $(document).on('click', '#submit-button-laporan-user-coba', function(e) {
//     e.preventDefault();
//     var id = $(this).data("id");
//     $.ajax({
//             url: 'user/userleader/modal/postprintlaporan/'+id,
//             type: 'GET',
//             dataType: 'html'
//         })
//         .done(function(data) {
//             $('#show-laporan-user').html('<iframe src="data:application/pdf;base64, '+data+'" style="width:100%;; height:500px;" frameborder="0"></iframe>');
//         })
//         .fail(function() {
//             $('#show-laporan-user').html('<i class="fa fa-info-sign"></i> Something went wrong, Please try again...');
//         });
// });

$(document).on("click", "#submit-button-laporan-user", function (e) {
    e.preventDefault();
    var data = $("#form-laporan-user").serialize();
    $("#show-laporan-user").html(
        "<br><br><br><img src='loading.gif'  style='display: block; margin: auto;'>"
    );
    $.ajax({
        url: "user/userleader/modalreport/postprintlaporan",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf"]').attr("content"),
        },
        type: "POST",
        data: data,
        dataType: "html",
    })
        .done(function (datapdf) {
            $("#show-laporan-user").html(
                '<iframe src="data:application/pdf;base64, ' +
                    datapdf +
                    '" style="width:100%;; height:500px;" frameborder="0"></iframe>'
            );
        })
        .fail(function () {
            // console.log(data);
            $("#show-laporan-user").html("Gagal Baca");
        });
});
$(document).on("click", "#buttontikettask", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    $.ajax({
        url: "user/user/task/kerjakan/" + id,
        type: "GET",
        dataType: "html",
    })
        .done(function (data) {
            $("#lihatdatatask").html(data);
        })
        .fail(function () {
            $("#lihatdatatask").html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
            );
        });
});
$(document).on("click", "#button-hendle-cabang-user", function (e) {
    e.preventDefault();
    // var id = $(this).data("id");
    $.ajax({
        url: "user/user/handledatacabang/",
        type: "GET",
        dataType: "html",
    })
        .done(function (data) {
            $("#menu-data-cabang-user").html(data);
        })
        .fail(function () {
            $("#menu-data-cabang-user").html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
            );
        });
});
$(document).on("click", "#task-harian-hendler-user", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    $.ajax({
        url: "user/user/handledatacabang/task/" + id,
        type: "GET",
        dataType: "html",
    })
        .done(function (data) {
            $("#body-hendler-cabang-user").html(data);
        })
        .fail(function () {
            $("#body-hendler-cabang-user").html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
            );
        });
});
$(document).on("click", "#task-custom-hendler-user", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    $.ajax({
        url: "user/user/handledatacabang/customtask/" + id,
        type: "GET",
        dataType: "html",
    })
        .done(function (data) {
            $("#body-hendler-cabang-user").html(data);
        })
        .fail(function () {
            $("#body-hendler-cabang-user").html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
            );
        });
});
$(document).on("click", "#button-lengkapi-custon-task", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    $("#menu-custom-handle-user").html(
        '<div style="text-align: center; padding:2%;"><div class="spinner-border" role="status" > <span class="sr-only">Loading...</span> </div></div>'
    );
    $.ajax({
        url: "user/user/handlecabang/customtask/lengkapidata/" + id,
        type: "GET",
        dataType: "html",
    })
        .done(function (data) {
            $("#menu-custom-handle-user").html(data);
        })
        .fail(function () {
            $("#menu-custom-handle-user").html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
            );
        });
});

$(document).on("click", "#button-respon-laporan-user", function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    $.ajax({
        url: "user/user/handlecabang/respon-laporan-user/" + id,
        type: "GET",
        dataType: "html",
    })
        .done(function (data) {
            $("#menu-respon-laporan-user").html(data);
        })
        .fail(function () {
            Lobibox.notify("error", {
                pauseDelayOnHover: true,
                icon: "fa fa-info-circle",
                continueDelayOnInactiveTab: false,
                position: "center top",
                showClass: "bounceIn",
                hideClass: "bounceOut",
                sound: false,
                width: 400,
                msg: "Hubungi Administrator Jika terjadi Eror",
            });
        });
});

//CUSTOM
$(document).on("click", "#button-simpan-custom-task-user", function (e) {
    e.preventDefault();
    var data = $("#form-post-custom-task").serialize();
    $("#menu-custom-handle-user").html(
        "<br><br><br><img src='loading.gif'  style='display: block; margin: auto;'>"
    );
    $.ajax({
        url: "user/user/handlecabang/customtask/new-data/simpan",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf"]').attr("content"),
        },
        type: "POST",
        data: data,
        dataType: "html",
    })
        .done(function (data) {
            $("#menu-custom-handle-user").html(data);
        })
        .fail(function () {
            $("#menu-custom-handle-user").html("Gagal Baca");
        });
});

function waktu() {
    var id = 123;
    $("#nitifikasipesan").html("");
    $.ajax({
        url: "user/notifikasi/lihatnotif/" + id,
        type: "GET",
        dataType: "html",
    })
        .done(function (data) {
            $("#nitifikasipesan").html(data);
        })
        .fail(function () {
            $("#nitifikasipesan").html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
            );
        });
}

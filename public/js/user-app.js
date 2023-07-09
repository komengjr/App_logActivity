$(document).on('click', '#buttontiketpersonal', function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    var url = 'user/lihattiket/'+id;
    // console.log(id);
    $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#bodyformdatainputtiket').html(data);
        })
        .fail(function() {
            $('#bodyformdatainputtiket').html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                );
        });
});
$(document).on('click', '#buttontiketgroup', function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    var url = 'user/group/lihattiket/'+id;
    console.log(id);
    $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#bodyformdatainputtiket').html(data);
        })
        .fail(function() {
            $('#bodyformdatainputtiket').html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                );
        });
});
$(document).on('click', '#showdatatugas', function(e) {
    e.preventDefault();

    $.ajax({
            url: 'user/lihattugas',
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#showdatatugasx').html(data);
        })
        .fail(function() {
            $('#showdatatugasx').html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                );
        });
});
$(document).on('click', '#buttoninputlaporan', function(e) {
    e.preventDefault();
    $.ajax({
            url: 'user/laporan/tambah',
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#bodyformdatainputtiket').html(data);
        })
        .fail(function() {
            $('#bodyformdatainputtiket').html('<i class="fa fa-info-sign"></i> Something went wrong, Please try again...');
        });
});
$(document).on('click', '#buttonshowdetaillaporan', function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    $.ajax({
            url: 'user/laporan/lihatlaporan/'+id,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#bodyformdatainputtiket').html(data);
        })
        .fail(function() {
            $('#bodyformdatainputtiket').html('<i class="fa fa-info-sign"></i> Something went wrong, Please try again...');
        });
});
$(document).on('click', '#task_kinerja', function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    $.ajax({
            url: 'user/task/kinerja/'+id,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#bodytask_kinerja').html(data);
        })
        .fail(function() {
            $('#bodytask_kinerja').html('<i class="fa fa-info-sign"></i> Something went wrong, Please try again...');
        });
});
$(document).on('click', '#buttonmemberitugasuser', function(e) {
    e.preventDefault();
    $.ajax({
            url: 'user/userleader/modal/beritugas',
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#bodyformdatainputtiket').html(data);
        })
        .fail(function() {
            $('#bodyformdatainputtiket').html('<i class="fa fa-info-sign"></i> Something went wrong, Please try again...');
        });
});
$(document).on('click', '#buttonlihattugasuser', function(e) {
    e.preventDefault();
    $.ajax({
            url: 'user/userleader/modal/lihattugas',
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {

            $('#lihatdatatask').html(data);
        })
        .fail(function() {
            $('#lihatdatatask').html('<i class="fa fa-info-sign"></i> Something went wrong, Please try again...');
        });
});
$(document).on('click', '#printkpi', function(e) {
    e.preventDefault();
    $.ajax({
            url: 'user/userleader/modal/periodekpi',
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#bodyformdatainputtiket').html(data);
        })
        .fail(function() {
            $('#bodyformdatainputtiket').html('<i class="fa fa-info-sign"></i> Something went wrong, Please try again...');
        });
});
$(document).on('click', '#buttondetailtask', function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    $.ajax({
            url: 'user/userleader/table/detailtask/'+id,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#detaildatatask').html(data);
        })
        .fail(function() {
            $('#detaildatatask').html('<i class="fa fa-info-sign"></i> Something went wrong, Please try again...');
        });
});
$(document).on('click', '#buttontikettask', function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    $.ajax({
            url: 'user/user/task/kerjakan/'+id,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#lihatdatatask').html(data);
        })
        .fail(function() {
            $('#lihatdatatask').html('<i class="fa fa-info-sign"></i> Something went wrong, Please try again...');
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
        .done(function(data) {
            $("#nitifikasipesan").html(data);
        })
        .fail(function() {
            $("#nitifikasipesan").html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
            );
        });
}

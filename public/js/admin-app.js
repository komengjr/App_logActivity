function getDataOptionTiket() {
    var datatiket = document.getElementById('datatiket').value;
    // e.preventDefault();
    // var url = $(this).data('url');
    // console.log(datakode);
    $.ajax({

            url: "admin/tiket/getdataoption/"+datatiket,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#optiontiketmasteradmin').html(data);
        })
        .fail(function() {
            $('#optiontiketmasteradmin').html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                );
        });
};
function getDataOptionKinerja() {
    var datakinerja = document.getElementById('datakinerja').value;
    // var kategori = document.getElementById('kategori').value;
    // e.preventDefault();
    // var url = $(this).data('url');
    // console.log(datakode);
    $.ajax({

            url: "admin/tiket/getdataoptionkinerja/"+datakinerja,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#optionkinerjaadmin').html(data);
        })
        .fail(function() {
            $('#optionkinerjaadmin').html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                );
        });
};
$(document).on('click', '#buttontampilmapscabang', function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    var url = 'admin/maps/data/cabang/'+id;
    // console.log(id);
    $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#bodyformdatamapscabang').html(data);
        })
        .fail(function() {
            $('#bodyformdatamapscabang').html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                );
        });
});
$(document).on('click', '#datauseradmin', function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    var url = 'admin/data/datauseradmin';
    // console.log(id);
    $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#bodyformdatamapscabang').html(data);
        })
        .fail(function() {
            $('#bodyformdatamapscabang').html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                );
        });
});
$(document).on('click', '#tugasuserharian', function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    var url = 'admin/data/tugasharian';
    // console.log(id);
    $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#bodyformdatamapscabang').html(data);
        })
        .fail(function() {
            $('#bodyformdatamapscabang').html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                );
        });
});
$(document).on('click', '#datagroup', function(e) {
    e.preventDefault();

    var url = 'admin/data/datagroup';
    // console.log(id);
    $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#bodyformdatamapscabang').html(data);
        })
        .fail(function() {
            $('#bodyformdatamapscabang').html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                );
        });
});
$(document).on('click', '#dataperiode', function(e) {
    e.preventDefault();

    var url = 'admin/data/dataperiode';
    // console.log(id);
    $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#bodyformdatamapscabang').html(data);
        })
        .fail(function() {
            $('#bodyformdatamapscabang').html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                );
        });
});
$(document).on('click', '#buttonshowtiket', function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    var url = 'admin/data/showtiketadmin/'+id;
    // console.log(id);
    $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#showmodaladmin').html(data);
        })
        .fail(function() {
            $('#showmodaladmin').html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                );
        });
});
$(document).on('click', '#buttonedittiket', function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    var url = 'admin/data/edittiketadmin/'+id;
    // console.log(id);
    $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#showmodaladmin').html(data);
        })
        .fail(function() {
            $('#showmodaladmin').html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                );
        });
});
$(document).on('click', '#buttonadminbuattiket', function(e) {
    e.preventDefault();
    // var id = $(this).data("id");
    var url = 'admin/tiket/data/tambah';
    // console.log(id);
    $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#bodyformdatatiket').html(data);
        })
        .fail(function() {
            $('#bodyformdatatiket').html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                );
        });
});
$(document).on('click', '#buttonshowdetailuser', function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    var url = 'admin/user/data/detail/'+id;
    // console.log(id);
    $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#divtableuseradmin').html(data);
        })
        .fail(function() {
            $('#divtableuseradmin').html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                );
        });
});
$(document).on('click', '#buttontambahtiketbaru', function(e) {
    e.preventDefault();
    var url = 'admin/dataworklist/tiketbaru';
    $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#divtableworklist').html(data);
        })
        .fail(function() {
            $('#divtableworklist').html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                );
        });
});
$(document).on('click', '#buttontambahuserbaru', function(e) {
    e.preventDefault();
    var url = 'admin/datauser/tambah';
    $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#divtableuseradmin').html(data);
        })
        .fail(function() {
            $('#divtableuseradmin').html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                );
        });
});
$(document).on('click', '#buttontambahperiodebaru', function(e) {
    e.preventDefault();
    var url = 'admin/dataperiode/tambah';
    $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#divtableworklist').html(data);
        })
        .fail(function() {
            $('#divtableworklist').html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                );
        });
});
$(document).on('click', '#datajadwaltugas', function(e) {
    e.preventDefault();
    var url = 'admin/dataworklist/tiketbaru';
    $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#divtableworklist').html(data);
        })
        .fail(function() {
            $('#divtableworklist').html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                );
        });
});
$(document).on('click', '#buttonusertable', function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    var url = 'admin/datagroup/tambahuser/'+id;
    // console.log(id);
    $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#menugroup').html(data);
        })
        .fail(function() {
            $('#menugroup').html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                );
        });
});
$(document).on('click', '#buttoncabangtable', function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    var url = 'admin/datagroup/tambahcabang/'+id;
    console.log(id);
    $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#menugroup').html(data);
        })
        .fail(function() {
            $('#menugroup').html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                );
        });
});
$(document).on('click', '#buttontambahgroupbaru', function(e) {
    e.preventDefault();
    var url = 'admin/datagroup/tambah';
    $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#divtableworklist').html(data);
        })
        .fail(function() {
            $('#divtableworklist').html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                );
        });
});
$(document).on('click', '#buttonuserpengerjaantask', function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    // console.log(id);
    var url = 'admin/datatask/user/pengerjaan/'+id;
    $.ajax({
            url: url,
            type: 'GET',
            dataType: 'html'
        })
        .done(function(data) {
            $('#divtableworklist').html(data);
        })
        .fail(function() {
            $('#divtableworklist').html(
                '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                );
        });
});


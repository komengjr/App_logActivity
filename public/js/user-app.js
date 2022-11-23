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
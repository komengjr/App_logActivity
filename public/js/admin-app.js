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
$(document).on('click', '#tugasuserbulanan', function(e) {
    e.preventDefault();
    var id = $(this).data("id");
    var url = 'admin/data/tugasbulanan';
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
function success_notibaru(){
    Lobibox.notify('success', {
    pauseDelayOnHover: true,
    continueDelayOnInactiveTab: false,
    position: 'top center',
    icon: 'fa fa-check-circle',
    msg: 'Data Berhasil di Tambah.'
    });
  }
function success_notiupdate(){
    Lobibox.notify('success', {
    pauseDelayOnHover: true,
    continueDelayOnInactiveTab: false,
    position: 'top center',
    icon: 'fa fa-check-circle',
    msg: 'Data Berhasil di Update.'
    });
  }
function success_notihapus(){
    Lobibox.notify('success', {
    pauseDelayOnHover: true,
    continueDelayOnInactiveTab: false,
    position: 'top center',
    icon: 'fa fa-check-circle',
    msg: 'Data Berhasil di Hapus.'
    });
  }
  function getDataOptionTiket() {
    var datatiket = document.getElementById('datatiket').value;
    // e.preventDefault();
    // var url = $(this).data('url');
    // console.log(datakode);
    $.ajax({

            url: "masteradmin/tiket/getdataoption/"+datatiket,
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
$(document).ready(function() {
    $(document).on('click', '#datausermasteradmin', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'html'
                    })
                    .done(function(data) {
                        $('#bodyformdatamasteradmin').html(data);
                    })
                    .fail(function() {
                        $('#bodyformdatamasteradmin').html(
                            '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                            );
                    });
    });
    $(document).on('click', '#datacabangmasteradmin', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'html'
                    })
                    .done(function(data) {
                        $('#bodyformdatamasteradminx').html(data);
                    })
                    .fail(function() {
                        $('#bodyformdatamasteradminx').html(
                            '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                            );
                    });
    });
    $(document).on('click', '#buttondetiledatacabang', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'html'
                    })
                    .done(function(data) {
                        $('#divtablecabang').html(data);
                    })
                    .fail(function() {
                        $('#divtablecabang').html(
                            '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                            );
                    });
    });
    $(document).on('click', '#buttontambahuserbaru', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'html'
                    })
                    .done(function(data) {
                        $('#divinputuser').html(data);
                    })
                    .fail(function() {
                        $('#divinputuser').html(
                            '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                            );
                    });
    });
    $(document).on('click', '#editdatauserbaru', function(e) {
                e.preventDefault();
                var url = $(this).data('url');
                $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'html'
                    })
                    .done(function(data) {
                        $('#divinputuser').html(data);
                    })
                    .fail(function() {
                        $('#divinputuser').html(
                            '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                            );
                    });
    });

    $(document).on('click', '#simpandatauserbaru', function(e) {
        var data = $('#formpostuserbaru').serialize();
        e.preventDefault();
        var url = $(this).data('url');
        console.log(data);
        $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('content')
                },
                type: 'POST',
                data: data,
                dataType: 'html'
            })
            .done(function(data) {
                $('#divtableuser').html(data);
                success_notibaru();
            })
            .fail(function() {
                $('#divtableuser').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...' );
            });
    });
    $(document).on('click', '#simpandatauseredit', function(e) {
        var data = $('#formpostuseredit').serialize();
        e.preventDefault();
        var url = $(this).data('url');
        console.log(data);
        $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('content')
                },
                type: 'POST',
                data: data,
                dataType: 'html'
            })
            .done(function(data) {
                $('#divtableuser').html(data);
                success_notibaru();
            })
            .fail(function() {
                $('#divtableuser').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...' );
            });
    });

    $(document).on('click', '#datagroupmasteradmin', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data) {
                $('#bodyformdatamasteradmin').html(data);
            })
            .fail(function() {
                $('#bodyformdatamasteradmin').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                    );
            });
    });
    $(document).on('click', '#buttontambahgroupbaru', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data) {
                $('#divinputuser').html(data);
            })
            .fail(function() {
                $('#divinputuser').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                    );
            });
    });
    $(document).on('click', '#simpandatagroupbaru', function(e) {
        var data = $('#formpostgroupbaru').serialize();
        e.preventDefault();
        var url = $(this).data('url');
        console.log(data);
        $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('content')
                },
                type: 'POST',
                data: data,
                dataType: 'html'
            })
            .done(function(data) {
                $('#divtablegroup').html(data);
                success_notibaru();
            })
            .fail(function() {
                $('#divtablegroup').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...' );
            });
    });
    $(document).on('click', '#showdatagroup', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data) {
                $('#bodyformdatamasteradmin').html(data);
            })
            .fail(function() {
                $('#bodyformdatamasteradmin').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                    );
            });
    });
    $(document).on('click', '#buttontambahgroupcabangbaru', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data) {
                $('#divinputuser').html(data);
            })
            .fail(function() {
                $('#divinputuser').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                    );
            });
    });
    $(document).on('click', '#buttontambahgroupuserbaru', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data) {
                $('#divinputuser').html(data);
            })
            .fail(function() {
                $('#divinputuser').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                    );
            });
    });
    $(document).on('click', '#simpandatagroupcabangbaru', function(e) {
        var data = $('#formpostgroupcabangbaru').serialize();
        e.preventDefault();
        var url = $(this).data('url');
        console.log(data);
        $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('content')
                },
                type: 'POST',
                data: data,
                dataType: 'html'
            })
            .done(function(data) {
                $('#bodyformdatamasteradmin').html(data);
                success_notibaru();
            })
            .fail(function() {
                $('#bodyformdatamasteradmin').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...' );
            });
    });
    $(document).on('click', '#simpandatagroupuserbaru', function(e) {
        var data = $('#formpostgroupuserbaru').serialize();
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('content')
                },
                type: 'POST',
                data: data,
                dataType: 'html'
            })
            .done(function(data) {
                $('#bodyformdatamasteradmin').html(data);
                success_notibaru();
            })
            .fail(function() {
                $('#bodyformdatamasteradmin').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...' );
            });
    });
    $(document).on('click', '#buttontambahcabangbaru', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data) {
                $('#divinputcabang').html(data);
            })
            .fail(function() {
                $('#divinputcabang').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                    );
            });
    });
    $(document).on('click', '#simpandatacabangbaru', function(e) {
        var data = $('#formpostcabangbaru').serialize();
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('content')
                },
                type: 'POST',
                data: data,
                dataType: 'html'
            })
            .done(function(data) {
                $('#divtablecabang').html(data);
                success_notibaru();
            })
            .fail(function() {
                $('#divtablecabang').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...' );
            });
    });
    $(document).on('click', '#datataskmasteradmin', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data) {
                $('#bodyformdatamasteradmin').html(data);
            })
            .fail(function() {
                $('#bodyformdatamasteradmin').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                    );
            });
    });
    $(document).on('click', '#tampildatataskuser', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        // let pdfWindow = window.open("");
        $('#divtableworklist').html('<div class="tengah"><div class="spinner-border text-primary text-center" style="display: flex; justify-content: center; align-items: center;"></div></div>');
        $.ajax({
                url: url,
                type: 'GET',
                dataType : 'text',
                contentType : 'application/pdf',
            })
            .done(function(data) {
                // window.open("data:application/pdf," + url);
                $('#divtableworklist').html('<iframe src="'+url+'" width="100%" height="500"></iframe>');
                // $('#divtableworklist').html("<iframe width='100%' height='100%' src='data:application/pdf;base64," + url +"'></iframe>");
            })
            .fail(function() {
                $('#divtableworklist').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                    );
            });
    });
    $(document).on('click', '#dataworklistmasteradmin', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data) {
                $('#bodyformdatamasteradmin').html(data);
            })
            .fail(function() {
                $('#bodyformdatamasteradmin').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                    );
            });
    });
    $(document).on('click', '#buttontambahworklistbaru', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data) {
                $('#divinputworklist').html(data);
            })
            .fail(function() {
                $('#divinputworklist').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                    );
            });
    });
    $(document).on('click', '#buttoneditdataworklist', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data) {
                $('#divinputworklist').html(data);
            })
            .fail(function() {
                $('#divinputworklist').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                    );
            });
    });
    $(document).on('click', '#simpandataworklistbaru', function(e) {
        var data = $('#formpostworklistbaru').serialize();
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('content')
                },
                type: 'POST',
                data: data,
                dataType: 'html'
            })
            .done(function(data) {
                $('#divtableworklist').html(data);
                success_notibaru();
            })
            .fail(function() {
                $('#divtableworklist').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...' );
            });
    });
    $(document).on('click', '#editdataworklistbaru', function(e) {
        var data = $('#formpostworklistedit').serialize();
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('content')
                },
                type: 'POST',
                data: data,
                dataType: 'html'
            })
            .done(function(data) {
                $('#divtableworklist').html(data);
                success_notiupdate();
            })
            .fail(function() {
                $('#divtableworklist').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...' );
            });
    });
    $(document).on('click', '#hapusdataworklistbaru', function(e) {
        var data = $('#formpostworklistedit').serialize();
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('content')
                },
                type: 'POST',
                data: data,
                dataType: 'html'
            })
            .done(function(data) {
                $('#divtableworklist').html(data);
                success_notihapus();
            })
            .fail(function() {
                $('#divtableworklist').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...' );
            });
    });
    $(document).on('click', '#datagroupworklistmasteradmin', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data) {
                $('#bodyformdatamasteradminx').html(data);
            })
            .fail(function() {
                $('#bodyformdatamasteradminx').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                    );
            });
    });
    $(document).on('click', '#buttontambahgroupworklistbaru', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data) {
                $('#divinputgroupworklist').html(data);
            })
            .fail(function() {
                $('#divinputgroupworklist').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                    );
            });
    });
    $(document).on('click', '#buttoneditgroupworklist', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data) {
                $('#divinputgroupworklist').html(data);
            })
            .fail(function() {
                $('#divinputgroupworklist').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                    );
            });
    });
    $(document).on('click', '#simpandatagroupworklistbaru', function(e) {
        var data = $('#formpostgroupworklistbaru').serialize();
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('content')
                },
                type: 'POST',
                data: data,
                dataType: 'html'
            })
            .done(function(data) {
                $('#divtablegroupworklist').html(data);
                success_notibaru();
            })
            .fail(function() {
                $('#divtablegroupworklist').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...' );
            });
    });
    $(document).on('click', '#editdatagroupworklistbaru', function(e) {
        var data = $('#formpostgroupworklistbaru').serialize();
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('content')
                },
                type: 'POST',
                data: data,
                dataType: 'html'
            })
            .done(function(data) {
                $('#divtablegroupworklist').html(data);
                success_notiupdate();
            })
            .fail(function() {
                $('#divtablegroupworklist').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...' );
            });
    });
    $(document).on('click', '#hapusdatagroupworklistbaru', function(e) {
        var data = $('#formpostgroupworklistbaru').serialize();
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('content')
                },
                type: 'POST',
                data: data,
                dataType: 'html'
            })
            .done(function(data) {
                $('#divtablegroupworklist').html(data);
                success_notihapus();
            })
            .fail(function() {
                $('#divtablegroupworklist').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...' );
            });
    });
    $(document).on('click', '#datapersonworklistmasteradmin', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data) {
                $('#bodyformdatamasteradminx').html(data);
            })
            .fail(function() {
                $('#bodyformdatamasteradminx').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                    );
            });
    });
    $(document).on('click', '#buttontambahpersonworklistbaru', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data) {
                $('#divinputpersonworklist').html(data);
            })
            .fail(function() {
                $('#divinputpersonworklist').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                    );
            });
    });
    $(document).on('click', '#buttoneditdatapersonworklist', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data) {
                $('#divinputpersonworklist').html(data);
            })
            .fail(function() {
                $('#divinputpersonworklist').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                    );
            });
    });
    $(document).on('click', '#simpandatapersonworklistbaru', function(e) {
        var data = $('#formpostpersonworklistbaru').serialize();
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('content')
                },
                type: 'POST',
                data: data,
                dataType: 'html'
            })
            .done(function(data) {
                $('#divtablepersonworklist').html(data);
                success_notibaru();
            })
            .fail(function() {
                $('#divtablepersonworklist').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...' );
            });
    });
    $(document).on('click', '#editdatapersonworklistbaru', function(e) {
        var data = $('#formpostpersonworklistbaru').serialize();
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('content')
                },
                type: 'POST',
                data: data,
                dataType: 'html'
            })
            .done(function(data) {
                $('#divtablepersonworklist').html(data);
                success_notiupdate();
            })
            .fail(function() {
                $('#divtablepersonworklist').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...' );
            });
    });
    $(document).on('click', '#hapusdatapersonworklistbaru', function(e) {
        var data = $('#formpostpersonworklistbaru').serialize();
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('content')
                },
                type: 'POST',
                data: data,
                dataType: 'html'
            })
            .done(function(data) {
                $('#divtablepersonworklist').html(data);
                success_notihapus();
            })
            .fail(function() {
                $('#divtablepersonworklist').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...' );
            });
    });
    $(document).on('click', '#datatypeworklistmasteradmin', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data) {
                $('#bodyformdatamasteradmin').html(data);
            })
            .fail(function() {
                $('#bodyformdatamasteradmin').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                    );
            });
    });
    $(document).on('click', '#buttontambahtypeworklistbaru', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data) {
                $('#divinputtypeworklist').html(data);
            })
            .fail(function() {
                $('#divinputtypeworklist').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                    );
            });
    });
    $(document).on('click', '#simpandatatypeworklistbaru', function(e) {
        var data = $('#formposttypeworklistbaru').serialize();
        e.preventDefault();
        var url = $(this).data('url');
        console.log(data);
        $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf"]').attr('content')
                },
                type: 'POST',
                data: data,
                dataType: 'html'
            })
            .done(function(data) {
                $('#divtabletypeworklist').html(data);
                success_notibaru();
            })
            .fail(function() {
                $('#divtabletypeworklist').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...' );
            });
    });
    $(document).on('click', '#tombolbuattiketworklist', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data) {
                $('#bodyformdatamasteradmintiket').html(data);
            })
            .fail(function() {
                $('#bodyformdatamasteradmintiket').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                    );
            });
    });
    $(document).on('click', '#datatiketgroupworklist', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data) {
                $('#bodyformdatamasteradminx').html(data);
            })
            .fail(function() {
                $('#bodyformdatamasteradminx').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                    );
            });
    });
    $(document).on('click', '#datatiketpersonalworklist', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data) {
                $('#bodyformdatamasteradminx').html(data);
            })
            .fail(function() {
                $('#bodyformdatamasteradminx').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                    );
            });
    });
    $(document).on('click', '#datatiketlaporan', function(e) {
        e.preventDefault();
        var url = $(this).data('url');
        $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data) {
                $('#bodyformdatamasteradminx').html(data);
            })
            .fail(function() {
                $('#bodyformdatamasteradminx').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                    );
            });
    });
    // $(document).on('click', '#datatitikmaps', function(e) {
    //     e.preventDefault();
    //     var url = $(this).data('url');
    //     $.ajax({
    //             url: url,
    //             type: 'GET',
    //             dataType: 'html'
    //         })
    //         .done(function(data) {
    //             $('#bodyformdatamasteradminx').html(data);
    //         })
    //         .fail(function() {
    //             $('#bodyformdatamasteradminx').html(
    //                 '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
    //                 );
    //         });
    // });
});

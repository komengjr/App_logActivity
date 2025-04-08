<form action="{{ route('simpanjadwalpiketnasional') }}" method="post">
    @csrf
    <div class="card">
        <div class="card-header text-uppercase">Pilih Range Waktu</div>
        <div class="card-body">
            {{-- <div class="form-group">
                <label>Pilih Group</label>
                <select name="txt_name" id="txt_name" class="form-control single-select"
                    onchange="getDataOptionKinerjax();">
                    <option value=""></option>
                    @foreach ($group as $group)
                        <option value="{{ $group->kd_group }}">{{ $group->nama_group }}</option>
                    @endforeach
                </select>
            </div> --}}
            <div class="form-group">
                <label>Date Range</label>
                <div id="dateragne-picker">
                    <input type="text" name="mulai" value="{{ $id }}" id="" hidden>
                    <div class="input-daterange input-group">
                        <input type="text" class="form-control" name="start" style="cursor: pointer;"
                            value="{{ $id }}" disabled />
                        <div class="input-group-prepend">
                            <span class="input-group-text">Sampai</span>
                        </div>
                        <input type="text" name="date" class="form-control datepicker" id="date"
                            autocomplete="off" />
                    </div>
                </div>
            </div>
            <br>
            <div class="group">
                <div class="row">
                    {{-- <div class="col-md-4">
                        <button class="btn btn-dark btn-block"><i class="fa fa-save"></i> Simpan Tanggal</button>
                    </div>
                    <div class="col-md-4">
                        <button class="btn btn-info btn-block"><i class="fa fa-save"></i> Setup Manual</button>
                    </div> --}}
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fa fa-save"></i> Setup Otomatis
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- <div class="card">
        <div class="card-header text-uppercase">Pilih User</div>
        <div class="card-body">
            <form>
                <div class="form-group" id="pilihanwilayah">
                    <label>Pilih User</label>
                    <select class="form-control multiple-select" multiple="multiple" disabled>
                        <option value=""></option>
                    </select>
                </div>

                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div> --}}
</form>


<script src="{{ asset('assets/plugins/jquery-multi-select/jquery.multi-select.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-multi-select/jquery.quicksearch.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.single-select').select2();

        $('.multiple-select').select2();

        $('#dateragne-picker .input-daterange').datepicker({
            autoclose: true,
            startDate: new Date('{{ $id }}'),
            todayHighlight: true
        });

        $('#my_multi_select1').multiSelect();
        $('#my_multi_select2').multiSelect({
            selectableOptgroup: true
        });

        $('#my_multi_select3').multiSelect({
            selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
            selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
            afterInit: function(ms) {
                var that = this,
                    $selectableSearch = that.$selectableUl.prev(),
                    $selectionSearch = that.$selectionUl.prev(),
                    selectableSearchString = '#' + that.$container.attr('id') +
                    ' .ms-elem-selectable:not(.ms-selected)',
                    selectionSearchString = '#' + that.$container.attr('id') +
                    ' .ms-elem-selection.ms-selected';

                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function(e) {
                        if (e.which === 40) {
                            that.$selectableUl.focus();
                            return false;
                        }
                    });

                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function(e) {
                        if (e.which == 40) {
                            that.$selectionUl.focus();
                            return false;
                        }
                    });
            },
            afterSelect: function() {
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function() {
                this.qs1.cache();
                this.qs2.cache();
            }
        });

        $('.custom-header').multiSelect({
            selectableHeader: "<div class='custom-header'>Selectable items</div>",
            selectionHeader: "<div class='custom-header'>Selection items</div>",
            selectableFooter: "<div class='custom-header'>Selectable footer</div>",
            selectionFooter: "<div class='custom-header'>Selection footer</div>"
        });


    });
</script>
<script>
    function getDataOptionKinerjax() {
        var datakinerja = document.getElementById('txt_name').value;
        $.ajax({

                url: "../../admin/menu/form-piket/option/" + datakinerja,
                type: 'GET',
                dataType: 'html'
            })
            .done(function(data) {
                $('#pilihanwilayah').html(data);
            })
            .fail(function() {
                $('#pilihanwilayah').html(
                    '<i class="fa fa-info-sign"></i> Something went wrong, Please try again...'
                );
            });
    };
</script>

<form action="" method="post">
    <div class="card">
        <div class="card-header text-uppercase">Pilih Wilayah</div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label>Pilih Group</label>
                    <select class="form-control single-select">
                        <option value=""></option>
                        @foreach ($group as $group)
                            <option value="{{$group->kd_group}}">{{$group->nama_group}}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header text-uppercase">Pilih User</div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label>Multiple select boxes</label>
                    <select class="form-control multiple-select" multiple="multiple">
                        <option value=""></option>
                        @foreach ($user as $user)
                            <option value="">{{ $user->nama_lengkap }}</option>
                        @endforeach
                    </select>
                </div>

            </form>
        </div>
    </div>

</form>


<script src="{{ asset('assets/plugins/jquery-multi-select/jquery.multi-select.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-multi-select/jquery.quicksearch.js') }}"></script>

<script>
    $(document).ready(function() {
        $('.single-select').select2();

        $('.multiple-select').select2();

        //multiselect start

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

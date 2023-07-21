<div class="row align-items-start">
    <div class="col">
        <select id="County" class="form-select-lg mb-3 form-control" wire:model="selectedCounty" name="County">
            <option value="">County</option>
            @foreach ($counties as $co)
            <option value="{{$co->id}}">{{$co->name}}</option>
            @endforeach
        </select>
    </div>


    @if (!is_null($subcounty))
    <div class="col">
        <select id="subCounty" class="form-select-lg mb-3 form-control" wire:model="selectedSubCounty" name="subCounty">
            <option value="">SubCounty</option>
            @foreach ($subcounty as $su)
            <option value="{{$su->id}}">{{$su->name}}</option>
            @endforeach
        </select>
    </div>
    @endif


    @if (!is_null($town))
    <div class="col">
        <select id="Town" class="form-select-lg mb-3 form-control" wire:model="selectedTown" name="Town">
            <option value="">Town</option>
            @foreach ($town as $to)
            <option value="{{$to->id}}">{{$to->name}}</option>
            @endforeach
        </select>
    </div>
    @endif
</div>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('select').select2({
            theme: "classic"
        });
        //preselecting the select2 inputs + ajax calls
        @if(old('county') != null)
        $('#county').val('{{old('
            county ')}}');
        $('#county').trigger('change');
        _fetchSubCounties({
            {
                old('county')
            }
        });
        @endif

        @if(old('subcounty') != null)
        $('#subcounty').val('{{old('
            subcounty ')}}');
        $('#subcounty').trigger('change');
        _fetchTowns({
            {
                old('subcounty')
            }
        });
        @endif

        @if(old('town') != null)
        $('#town').val('{{old('
            town ')}}'); // Select the option with a value of '1'
        @endif

        //SubCounty Populator
        $('#county').change(function(e) {
            var countyId = this.value;
            _fetchSubCounties(countyId);
        });

        //Town Populator
        $('#subcounty').change(function(e) {
            var scounty_id = this.value;
            _fetchTowns(scounty_id);
        });
    });

    function _fetchSubCounties(countyId) {
        $.ajax({
            url: "{{url('fetch-subcounties')}}",
            type: "POST",
            data: {
                county_id: countyId,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function(result) {
                $('#subcounty').empty().select2('destroy');
                $('#subcounty').select2({
                    data: result.data
                });
                $('#subcounty').trigger('change');
            }
        });
    }

    function _fetchTowns(scounty_id) {
        $.ajax({
            url: "{{url('fetch-towns')}}",
            type: "POST",
            data: {
                sc_id: scounty_id,
                _token: '{{csrf_token()}}'
            },
            dataType: 'json',
            success: function(result) {
                $('#town').empty().select2('destroy');
                $('#town').select2({
                    data: result.data
                });
            }
        });
    }
</script>
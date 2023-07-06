<form role="form text-left" action="{{URL::to('authRegister')}}" method="post">
    @csrf
    <div class="mb-3">
        <input type="text" value="{{old('Name') ?? ""}}" class="form-control @error('Name') is-invalid @enderror" name="Name" placeholder="Your Names" aria-label="Name" aria-describedby="email-addon">
        <div class="invalid-feedback">
            @error('Name') {{$message}} @enderror
        </div>
    </div>
    <div class="mb-3">
        <input type="number" value="{{old('National_id') ?? ""}}" class="form-control @error('National_id') is-invalid @enderror" name="National_id" placeholder="National id" aria-label="National_id" aria-describedby="email-addon">
        <div class="invalid-feedback">
            @error('National_id') {{$message}} @enderror
        </div>
    </div>

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


    <div class="mb-3">
        <input value="{{old('email') ?? ""}}" type="email" class="form-control  @error('email') is-invalid @enderror" name="email" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
        <div class="invalid-feedback">
            @error('email') {{$message}} @enderror
        </div>
    </div>
    <div class="mb-3">
        <input value="{{old('phone') ?? ""}}" type="phone" class="form-control  @error('phone') is-invalid @enderror" name="phone" placeholder="Your phone number" aria-label="phone" aria-describedby="email-addon">
    </div>
    <div class="mb-3">
        <input value="{{old('age') ?? ""}}" type="number" class="form-control  @error('age') is-invalid @enderror" name="age" placeholder="Your age" aria-label="age" aria-describedby="email-addon">
    </div>
    <div class="mb-3">
        <input value="" type="password" class="form-control  @error('password') is-invalid @enderror" name="password" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
        <div class="invalid-feedback">
            @error('password') {{$message}} @enderror
        </div>
    </div>

    </div>
    <div class="text-center">
        <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>
    </div>
    <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{URL::to('login')}}" class="text-dark font-weight-bolder"> <i class="fa fa-solid fa-key"></i> Sign in</a></p>
</form>

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
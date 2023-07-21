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

<div class="request-list">
    @foreach($rrequests as $rrequest)
        <div class="request">
            <a href="{{URL::to('')}}">
            <div class="request-details">
                <div class="ret_Bname">
                    {{$rrequest->Retailers->BName}}
                </div>
                <div class="ret_loc">
                {{$rrequest->Retailers->SubCounty->name}},
                {{$rrequest->Retailers->Town->name}}
                </div>
                <div class="ret_demand">
                    {{$rrequest->demand_required}}
                </div>
                <div class="ret_name">
                    {{$rrequest->Retailers->Name}}
                </div>
            </div>
            </a>
        </div>
    @endforeach
    </div>
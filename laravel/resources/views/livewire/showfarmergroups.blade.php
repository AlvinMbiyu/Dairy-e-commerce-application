<div class="group-list">
    @foreach($farmerg as $fg)
        <div class="group-item">

            <a href="{{URL::to('prop-details/'.$property->Plot_No)}}">
            <div class="group-details">
                <div class="group-number">
                    {{$fg->id}}
                </div>
                <div class="fg_loc">
                {{$fg->SubCounty->name}},
                {{$fg->Town->name}}
                </div>
                <div class="fg_price">
                    {{$fg->price_per_litre}}
                </div>
                <div class="fg_members">
                    {{$fg->Farmers->count()}}
                </div>
            </div>
            </a>
        </div>
    @endforeach
    </div>

@extends('tables')

@section('headTitle', 'Your Properties')
@section('pageTitle', 'Your Properties')

@section('content')
<div class="row">
  <div class='col-12'>

    <div class="d-flex justify-content-end">
      <a class="btn btn-secondary" href="{{URL::to('your_properties/addre')}}">
        <i class="fas fa-plus"></i> Add re
      </a>
    </div>

    <div class="card mb-4">
      <div class="card-header pb-0">

      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center justify-content-center mb-0">
            <thead>
              <tr>

                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Retailer</th>
                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Shop_name</th>
                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">County</th>
                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">SubCounty</th>
                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Town</th>
                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Demand</th>
              </tr>
            </thead>
            <tbody>

              @forelse($requests as $re)
              <tr>
                <td>
                  <p class="text-xs px-3 font-weight-bold mb-0">{{$re->Retailers->name}}</p>
                </td>
                <td>
                  <p class="text-xs px-3 font-weight-bold mb-0">{{$re->Retailers->County->name}}</p>
                </td>
                <td>
                  <p class="text-xs px-3 font-weight-bold mb-0">{{$re->Retailers->SubCounty->name}}</p>
                </td>
                <td>
                  <p class="text-xs px-3 font-weight-bold mb-0">{{$re->Retailers->Town->name}}</p>
                </td>
                <td>
                  <p class="text-xs px-3 font-weight-bold mb-0">{{$re->Retailers->demand}}</p>
                </td>

                <td class="align-middle text-center">
                  <a>
                    <i class="fa-solid fa-pen-to-square"></i>
                  </a>

                  <a href="{{URL::to('viewhouseunits/'.$re->Plot_No)}}">
                  <i class="fa-solid fa-house"></i>
                  </a>

                  <a>
                    <i class="fa fa-usd" aria-hidden="true"></i>
                  </a>

                  <a onclick=" return confirm('Are you sure?');">
                    <i class="fa-solid fa-trash"></i>
                  </a>

                </td>
              </tr>
              @empty
              <tr>
                <td colspan="3">No records found</td>
              </tr>
              @endforelse

            </tbody>
          </table>
          <div class="pagn-links">

          </div>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection

@section('scripts')
<script type="text/javascript">
  iziToast.show({
    messageColor: 'white',
    icon: 'fa-sharp fa-solid fa-circle-check',
    iconColor: 'white',
    backgroundColor: '#17c1e8',
    message: "{{ session('status')}}",
    position: 'topRight'
  });
</script>
@endsection
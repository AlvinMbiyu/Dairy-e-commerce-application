@extends('tables')

@section('headTitle', 'Your Properties')
@section('pageTitle', 'Your Properties')

@section('content')
<div class="row">
  <div class='col-12'>
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

              @forelse($Rrequests as $re)
              <tr>
                <td>
                  <p class="text-xs px-3 font-weight-bold mb-0">{{$re->Retailer->Name}}</p>
                </td>
                <td>
                  <p class="text-xs px-3 font-weight-bold mb-0">{{$re->Retailer->BName}}</p>
                </td>
                <td>
                  <p class="text-xs px-3 font-weight-bold mb-0">{{$re->Retailer->County->name}}</p>
                </td>
                <td>
                  <p class="text-xs px-3 font-weight-bold mb-0">{{$re->Retailer->SubCounty->name}}</p>
                </td>
                <td>
                  <p class="text-xs px-3 font-weight-bold mb-0">{{$re->Retailer->Town->name}}</p>
                </td>
                <td>
                  <p class="text-xs px-3 font-weight-bold mb-0">{{$re->demand_required}}</p>
                </td>

                <td class="align-middle text-center">
                  <a class="btn btn-secondary" data-toggle="modal" data-target="#acceptModal">
                    <i class="fas fa-plus"></i> Accept request
                  </a>
                  <!-- Modal -->
                  <div class="modal fade" id="acceptModal" tabindex="-1" role="dialog" aria-labelledby="acceptModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="demoModalLabel">Request an order</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form id="order" method="post" action="{{url('/farmergroup/view-requests/accept/')}}">
                            @csrf

                            @if ($errors->any())
                            <div class="alert alert-danger">
                              <ul>
                                @foreach ($errors->all() as $error)
                                <li class="text-white">{{ $error }}</li>
                                @endforeach
                              </ul>
                            </div>
                            @endif
                            <div class="form-group">

                              <input type="hidden" name="id" value="{{ $re->id }}">
                              <div class="mb-3">
                                Are you sure?
                              </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                          <div class="text-center">
                            <button type="submit" class="btn btn-primary"> Accept </button>
                          </div>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>


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

<script>
  // Open the modal
  function openModal() {
    $('#acceptModal').modal('show');
  }

  // Close the modal
  function closeModal() {
    $('#acceptModal').modal('hide');
  }
</script>
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
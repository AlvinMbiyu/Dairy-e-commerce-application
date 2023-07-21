@extends('tables')

@section('headTitle', 'Your Orders')
@section('pageTitle', 'Your Orders')

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

                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Delivery id</th>
                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Farmer Group ID</th>
                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Retail request Id</th>
                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Amount delivered</th>
                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Delivery Confirmation</th>

              </tr>
            </thead>
            <tbody>

              @forelse($deliveries as $del)
              <tr>
                <td>
                  <p class="text-xs px-3 font-weight-bold mb-0">{{$del->id}}</p>
                </td>
                <td>
                  <p class="text-xs px-3 font-weight-bold mb-0">{{$del->FarmerGroups->id}}</p>
                </td>
                <td>
                  <p class="text-xs px-3 font-weight-bold mb-0">{{$del->RetailerRequests->id}}</p>
                </td>
                <td>
                  <p class="text-xs px-3 font-weight-bold mb-0">{{$del->amount_delivered}}</p>
                </td>
                <td>
                  <p class="text-xs px-3 font-weight-bold mb-0">{{$del->delivery_confirmation}}</p>
                </td>

                <td class="align-middle text-center">
                  <a class="btn btn-secondary" data-toggle="modal" data-target="#confirmDModal">
                    <i class="fas fa-plus"></i> confirm Delivery
                  </a>
                  <!-- Modal -->
                  <div class="modal fade" id="confirmDModal" tabindex="-1" role="dialog" aria-labelledby="confirmDModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="demoModalLabel">Request an order</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form id="confirmD" method="post" action="{{url('retailer/viewdeliveries/confirm')}}">
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

                              <input type="hidden" name="id" value="{{ $del->id }}">
                              <div class="mb-3">
                                Are you sure?
                              </div>

                            </div>

                        </div>
                        <div class="modal-footer">
                          <div class="text-center">
                            <button type="submit" class="btn btn-primary"> confirm Delivery </button>
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
@extends('tables')

@section('headTitle', 'Your Payments')
@section('pageTitle', 'Your Payments')

@section('content')
<div class="row">
  <div class='col-12'>

    <div class="d-flex justify-content-end">
      <a class="btn btn-secondary" data-toggle="modal" data-target="#paymentModal">
        <i class="fas fa-plus"></i> Make payment
      </a>
    </div>
            <!-- Modal -->
            <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="demoModalLabel">Choose delivery person</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="payment" method="post" action="{{URL::to('/retailer/pay')}}">
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
                    <div class="mb-3">
                      <!-- Hidden input field for Gid -->
                      <input type="hidden" name="Rid" value="{{auth()->guard('retailers')->id()}}">
                    </div>
                    <div class="mb-3">
                      <label for="total_amount">Payment Amount:</label>
                      <input type="number" class="form-control @error('total_amount') is-invalid @enderror" name="total_amount" value="{{ old('total_amount') }}" placeholder="Payment amount  Required" required>
                      <div class="invalid-feedback">
                        @error('total_amount') {{ $message }} @enderror
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="GID">Group ID:</label>
                      <input type="number" class="form-control @error('GID') is-invalid @enderror" name="GID" value="{{ old('GID') }}" placeholder="Group ID Required" required>
                      <div class="invalid-feedback">
                        @error('GID') {{ $message }} @enderror
                      </div>
                    </div>
                    <div class="mb-3">
                      <label for="ddid">Delivery ID:</label>
                      <input type="number" class="form-control @error('ddid') is-invalid @enderror" name="ddid" value="{{ old('ddid') }}" placeholder="Delivery ID Required" required>
                      <div class="invalid-feedback">
                        @error('ddid') {{ $message }} @enderror
                      </div>
                    </div>

                  </div>

              </div>
              <div class="modal-footer">
                <div class="text-center">
                  <button type="submit" class="btn btn-primary"> Pay </button>
                </div>
              </div>
              </form>
            </div>
          </div>
        </div>

    <div class="card mb-4">
      <div class="card-header pb-0">

      </div>
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table align-items-center justify-content-center mb-0">
            <thead>
              <tr>

                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Payment ID</th>
                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Group ID</th>
                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Delivery ID</th>
                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Total Price</th>
              </tr>
            </thead>
            <tbody>

              @forelse($transactions as $re)
              <tr>
                <td>
                  <p class="text-xs px-3 font-weight-bold mb-0">{{$re->id}}</p>
                </td>
                <td>
                  <p class="text-xs px-3 font-weight-bold mb-0">{{$re->Gid}}</p>
                </td>
                <td>
                  <p class="text-xs px-3 font-weight-bold mb-0">{{$re->delivery_id}}</p>
                </td>
                <td>
                  <p class="text-xs px-3 font-weight-bold mb-0">{{$re->total_price}}</p>
                </td>

                <td class="align-middle text-center">


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
<script>
  // Open the modal
  function openModal() {
    $('#paymentModal').modal('show');
  }

  // Close the modal
  function closeModal() {
    $('#paymentModal').modal('hide');
  }
</script>
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
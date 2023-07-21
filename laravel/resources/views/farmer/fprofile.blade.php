@extends('tables')

@section('headTitle', 'Your Profile')
@section('pageTitle', 'Your Profile')

@section('content')
<div class="row">
  <div class='col-12'>

    <div class="d-flex justify-content-end">
      <a class="btn btn-secondary" data-toggle="modal" data-target="#livestockModal">
        <i class="fas fa-plus"></i> Add livestock
      </a>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="livestockModal" tabindex="-1" role="dialog" aria-labelledby="livestockModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="demoModalLabel">Choose delivery person</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="livestock" method="post" action="{{URL::to('farmer/livestock')}}">
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
                <select id="Ltid" class="form-select-lg mb-3 form-control" name="Ltid">
                  <option value="">Livestock Breed</option>
                  @foreach ($livts as $livt)
                  <option value="{{$livt->Ltid}}">{{$livt->Type}}</option>
                  @endforeach
                </select>
              </div>

              <div class="mb-3">
                <label for="quantity">Quantity:</label>
                <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" placeholder="Quantity  Required" required>
                <div class="invalid-feedback">
                  @error('quantity') {{ $message }} @enderror
                </div>
              </div>
              <div class="modal-footer">
          <div class="text-center">
            <button type="submit" class="btn btn-primary"> Add </button>
          </div>
          </form>
          </div>

        </div>

        </div>
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

              <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Total Milk Average amount per milk</th>
              <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Number of livestock per breed</th>
            </tr>
          </thead>
          <tbody>

            @forelse($averages as $av)
            <tr>
              <td>
                <p class="text-xs px-3 font-weight-bold mb-0">{{$av->Total_avg_Amount}}</p>
              </td>
              <td>
                <p class="text-xs px-3 font-weight-bold mb-0">{{$av->No_of_liv}}</p>
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
    $('#livestockModal').modal('show');
  }

  // Close the modal
  function closeModal() {
    $('#livestockModal').modal('hide');
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
<div class="mb-3">
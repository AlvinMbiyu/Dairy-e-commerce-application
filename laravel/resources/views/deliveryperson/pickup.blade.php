@extends('layout')
@section('headTitle', 'Pick up points')
@section('pageTitle', 'Pick up points')

@section('aside')

<li class="nav-item mt-3">
  <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
</li>

<li class="nav-item">
  <a class="nav-link  (request()->is('sign-in*')) ? 'active' : ''" href="{{URL::to('login')}}">
    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
      <i class="fa-solid fa-user-tie"></i>
    </div>
    <span class="nav-link-text ms-1">Sign in</span>
  </a>
</li>
<li class="nav-item">
  <a class="nav-link  (request()->is('sign-up*')) ? 'active' : ''" href="{{URL::to('register')}}">
    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
      <i class="fa-solid fa-right-to-bracket"></i>
    </div>
    <span class="nav-link-text ms-1">Sign Up</span>
  </a>
</li>
@endsection

@section('content')
<form action="{{ url('/delivery-person/pick-up') }}" method="GET">
    <div class="form-group">
    <livewire:inputaddress />
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Filter</button>
    </div>
</form>

<!-- Display filtered farmer groups -->
@if ($farmers->count() > 0)
<div class="group-list">
@foreach($drs as $dr)
  @foreach($farmers as $fg)
  <div class="group-item">
    <div class="group-details">
      <div class="group-number">
        {{$fg->Name}}
      </div>
      <div class="fg_loc">
        {{$fg->SubCounty->name}},
        {{$fg->Town->name}}
      </div>
    </div>
    <div class="row">
      <div class='col-12'>
        <div class="d-flex justify-content-end">
          <a class="btn btn-secondary" data-idUpdate="'.$fg->id'" data-toggle="modal" data-target="#orderModal">
            <i class="fas fa-plus"></i> Record milk
          </a>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="demoModalLabel">Record milk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="order" method="post" action="{{url('delivery-person/pick-up/record')}}">
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
                      <input type="hidden" name="Gid" value="{{ $fg->Gid }}">
                      <input type="hidden" name="DRid" value="{{ $dr->id}}">
                    </div>

                    <div class="mb-3">
                      <label for="demand">Farmer ID:</label>
                      <input type="number" class="form-control @error('Fid') is-invalid @enderror" name="Fid" value="{{ old('Fid') }}" placeholder="Retailer ID" required>
                      <div class="invalid-feedback">
                        @error('Fid') {{ $message }} @enderror
                      </div>
                    </div>

                    <div class="mb-3">
                      <label for="demand">Amount Produced (in litres):</label>
                      <input type="number" class="form-control @error('amount_produced') is-invalid @enderror" name="amount_produced" value="{{ old('amount_produced') }}" placeholder="amount produced" required>
                      <div class="invalid-feedback">
                        @error('amount_produced') {{ $message }} @enderror
                      </div>
                    </div>

                  </div>
                
              </div>
              <div class="modal-footer">
                <div class="text-center">
                  <button type="submit" class="btn btn-primary"> Order </button>
                </div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endforeach
@endforeach
@else
    <p>No farmer groups found.</p>
@endif



<script>
  // Open the modal
  function openModal() {
    $('#orderModal').modal('show');
  }

  // Close the modal
  function closeModal() {
    $('#orderModal').modal('hide');
  }
 
</script>


@endsection
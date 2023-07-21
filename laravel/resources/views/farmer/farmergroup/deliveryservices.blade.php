@extends('layout')
@section('headTitle', 'Available delivery persons')
@section('pageTitle', 'Available delivery persons')

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
<form action="{{ url('/farmergroup/view-dp') }}" method="GET">
  <div class="form-group">
    <livewire:inputaddress />
  </div>

  <div class="form-group">
    <button type="submit" class="btn btn-primary">Filter</button>
  </div>
</form>
<div class="group-list">
  @if ($dps->count() > 0)
  @foreach($dps as $dp)
  <div class="group-item">
    <div class="group-details">
      <div class="group-number">
        {{$dp->Did}}
      </div>
      <div class="dp_loc">
        {{$dp->SubCounty->name}},
        {{$dp->Town->name}}
      </div>
      <div class="dp_price">
        {{$dp->price_per_litre}}
      </div>
    </div>
    <div class="row">
      <div class='col-12'>
        <div class="d-flex justify-content-end">
          <a class="btn btn-secondary" data-idUpdate="{{ $dp->id}}" data-toggle="modal" data-target="#orderModal">
            <i class="fas fa-plus"></i> Choose delivery person
          </a>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="demoModalLabel">Choose delivery person</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="order" method="post" action="{{url('/farmergroup/view-dp/request')}}">
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
                      <input type="hidden" name="Did" value="{{ $dp->Did }}">
                    </div>
                    <div class="mb-3">
                      <label for="est_amount">Est Amount (in litres):</label>
                      <input type="number" class="form-control @error('est_amount') is-invalid @enderror" name="est_amount" value="{{ old('est_amount') }}" placeholder="Estimated amount  Required" required>
                      <div class="invalid-feedback">
                        @error('est_amount') {{ $message }} @enderror
                      </div>
                    </div>

                  </div>

              </div>
              <div class="modal-footer">
                <div class="text-center">
                  <button type="submit" class="btn btn-primary"> order </button>
                </div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
  @else
  <p>No farmer groups found.</p>
  @endif
</div>


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
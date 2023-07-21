@extends('layout')
@section('headTitle', 'Available farmer groups')
@section('pageTitle', 'Available farmer groups')

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
<form action="{{ url('retailer/{National_id}/buymilk') }}" method="GET">
    <div class="form-group">
    <livewire:inputaddress />
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Filter</button>
    </div>
</form>

<!-- Display filtered farmer groups -->
@if ($farmerg->count() > 0)
<div class="group-list">
  @foreach($farmerg as $fg)
  <div class="group-item">
    <div class="group-details">
      <div class="group-number">
       Farmer Group ID: {{$fg->id}}
      </div>
      <div class="fg_loc">
       Subcounty: {{$fg->SubCounty->name}},
       Town: {{$fg->Town->name}}
      </div>
      <div class="fg_price">
       Farmer Group Price: {{$fg->price_per_litre}}
      </div>
      <div class="fg_members">
       Number of Farmers: {{$fg->Farmers->count()}}
      </div>
    </div>
    <div class="row">
      <div class='col-12'>
        <div class="d-flex justify-content-end">
          <a class="btn btn-secondary" data-idUpdate="{{ $fg->id}}" data-toggle="modal" data-target="#orderModal">
            <i class="fas fa-plus"></i> Choose group
          </a>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="demoModalLabel">Request an order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="order" method="post" action="{{url('retailer/buymilk/order')}}">
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
                      <input type="hidden" name="Gid" value="{{ $fg->id }}">
                    </div>

                    <div class="mb-3">
                      <label for="demand">Demand Required (in litres):</label>
                      <input type="number" class="form-control @error('demand') is-invalid @enderror" name="demand" value="{{ old('demand') }}" placeholder="Demand Required" required>
                      <div class="invalid-feedback">
                        @error('demand') {{ $message }} @enderror
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
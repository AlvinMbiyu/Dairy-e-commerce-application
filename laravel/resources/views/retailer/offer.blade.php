@extends('layout')
@section('headTitle', 'Available farmer groups')
@section('pageTitle', 'Available farmer groups')

@section('aside')

<li class="nav-item mt-3">
  <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
</li>

<li class="nav-item">
  <a class="nav-link  (request()->is('sign-in*')) ? 'active' : ''" href="{{URL::to('retailer/login')}}">
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
@if (session('status'))
<h6 class="alert alert-success">{{session('status')}}</h6>
@endif
<form id="order-form" method="POST" action="{{URL::to('retailer/{National_id}/buymilk/choosegroup/order')}}">
    @csrf
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
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
                    <!--input pattern= "[a-zA-Z]{2,10}$" required-->
                    <input type="number" hidden required name="National_id" value="" class="form-control @error('National_id') is-invalid @enderror" placeholder="Confirm your National id number">
                    <div class="invalid-feedback">
                        @error('National_id') {{$message}} @enderror
                    </div>

                    <input type="number" hidden required name="Gid" value="" class="form-control @error('Gid') is-invalid @enderror" >
                    <div class="invalid-feedback">
                        @error('Gid') {{$message}} @enderror
                    </div>

                    <p>Demand</p><input type="text" required name="demand" value="{{old('demand')}}" class="form-control @error('Property_Ad') is-invalid @enderror" placeholder="In litres">
                    <div class="invalid-feedback">
                        @error('demand') {{$message}} @enderror
                    </div>

                <input type="submit" name="submit" class="form-control btn btn-success">

            </div>
        </div>

    </div>

    </div>

</form>

@endsection
@extends('layout')
@section('headTitle', 'Dashboard')
@section('pageTitle', 'Dashboard')

@section('aside')
<li class="nav-item">
        <a class="nav-link {{(request()->is('farmer/{National_id}/dashboard')) ? 'active' : ''}}" href="{{URL::to('farmer/{National_id}/dashboard')}}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">      
            <i class="fa-solid fa-bars"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
        </li>

        <li class="nav-item">
          <a class="nav-link  (request()->is('retailer/{National_id}/profile')) ? 'active' : ''" href="{{URL::to('retailer/{National_id}/profile')}}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-user-tie"></i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  (request()->is('retailer/{National_id}/buymilk')) ? 'active' : ''" href="{{URL::to('retailer/{National_id}/buymilk')}}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-right-to-bracket"></i>
            </div>
            <span class="nav-link-text ms-1">Buy Milk</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  (request()->is('sign-out*')) ? 'active' : ''" href="{{URL::to('login')}}">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa-solid fa-right-to-bracket"></i>
            </div>
            <span class="nav-link-text ms-1">Sign Out</span>
          </a>
        </li>
@endsection

@section('content')

@endsection
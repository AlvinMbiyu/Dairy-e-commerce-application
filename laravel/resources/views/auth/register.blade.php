<!--
=========================================================
* Soft UI Dashboard - v1.0.6
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{URL::to('img/k-housing-favicon.png')}}">
    <link rel="icon" type="image/png" href="{{URL::to('img/k-housing-favicon.png')}}">
    <title>
        Zovala - Register
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{URL::to('css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{URL::to('css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- Font Awesome Icons INSERT YOUR KIT-->
    <script src="https://kit.fontawesome.com/0378161b2b.js" crossorigin="anonymous"></script>
    <link href="{{URL::to('css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{URL::to('css/soft-ui-dashboard.css?v=1.0.6')}}" rel="stylesheet" />
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Custom css -->
    <link href="{{URL::to('css/custom.css')}}" rel="stylesheet" />
</head>

<body class="">
<!-- Navbar -->
<nav class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
    <div class="container">
        <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white w-20" href="{{URL::to('/')}}">
            <img src="{{URL::to('img/logo-no-background.png')}}" class="navbar-brand-img w-100" alt="main_logo">
        </a>

        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav mx-auto ms-xl-auto me-xl-7">
                <li class="nav-item">
                    <a class="nav-link me-2" href="{{URL::to('login')}}">
                        <i class="fas fa-key opacity-6  me-1"></i>
                        Sign In
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->
<main class="main-content  mt-0">
    <section class="min-vh-100 mb-8">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('{{URL::to("img/curved-images/curved14.jpg")}}');">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">Welcome!</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0">
                        <div class="card-body">
                           <livewire:inputaddress />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<!--   Core JS Files   -->
<script src="{{URL::to('js/core/popper.min.js')}}"></script>
<script src="{{URL::to('js/core/bootstrap.min.js')}}"></script>
<script src="{{URL::to('js/plugins/perfect-scrollbar.min.js')}}"></script>
<script src="{{URL::to('js/plugins/smooth-scrollbar.min.js')}}"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript">
        $(document).ready(function() {
            $('select').select2({
                theme: "classic"
            });
            //preselecting the select2 inputs + ajax calls
            @if(old('county') != null)
                $('#county').val('{{old('county')}}');
                $('#county').trigger('change');
                _fetchSubCounties({{old('county')}});
            @endif

            @if(old('subcounty') != null)
                $('#subcounty').val('{{old('subcounty')}}');
                $('#subcounty').trigger('change');
                _fetchTowns({{old('subcounty')}});
            @endif

            @if(old('town') != null)
                $('#town').val('{{old('town')}}'); // Select the option with a value of '1'
            @endif

            //SubCounty Populator
            $('#county').change(function(e){
                var countyId = this.value;
                _fetchSubCounties(countyId);
            });

            //Town Populator
            $('#subcounty').change(function(e){
                var scounty_id = this.value;
                _fetchTowns(scounty_id);
            });
        });

        function _fetchSubCounties(countyId){
            $.ajax({
                url: "{{url('fetch-subcounties')}}",
                type: "POST",
                data: {
                    county_id: countyId,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#subcounty').empty().select2( 'destroy' );
                    $('#subcounty').select2({data:result.data});
                    $('#subcounty').trigger('change');
                }
            });
        }

        function _fetchTowns(scounty_id){
            $.ajax({
                url: "{{url('fetch-towns')}}",
                type: "POST",
                data: {
                    sc_id: scounty_id,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (result) {
                    $('#town').empty().select2( 'destroy' );
                    $('#town').select2({data:result.data});
                }
            });
        }
</script>
</body>

</html>

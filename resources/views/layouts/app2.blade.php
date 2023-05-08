<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Smart Account</title>

    <!-- font awsom -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
          integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <!-- Bootstrap core CSS-->
    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom fonts for this template
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
     -->
    <!-- Page level plugin CSS-->
    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('css/sb-admin.css')}}" rel="stylesheet">
    <style>

        .closeli {
            float: right;
            cursor: pointer;
        }

        .breadcrumb {
            background-color: #212529 !important;
        }

        .table-wrapper-scroll-y {
            width: 100%;
            display: block;
            max-height: 300px;
            overflow-y: auto;
            -ms-overflow-style: -ms-autohiding-scrollbar;
        }
    </style>
    @yield('css')
</head>

<body id="page-top">

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.php">Smart Account</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
     <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for..." aria-label="Search"
                       aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

    <!-----------------------Navbar----------------------->

    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <span class="badge badge-danger">9+</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </li>
        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <span class="badge badge-danger">7</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </li>
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">Settings</a>
                <a class="dropdown-item" href="#">Activity Log</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>

<!------------------- Sidebar ----------------->

<div id="wrapper">
 <ul class="sidebar navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="{{route('store.dashboard')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>

     <!------------------- store ----------------->
     <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-store"></i>
                <span>Store</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <h6 class="dropdown-header">Store</h6>
                <a class="dropdown-item" href="{{route('store.dashboard')}}">Dashboard</a>
                <div class="dropdown-divider"></div>
                <h6 class="dropdown-header">Store data</h6>
                <a class="dropdown-item" href="{{route('brand.add')}}">Add Brand Name</a>
                <a class="dropdown-item" href="{{route('dec.add')}}">Add Item Description</a>
              <!--  <a class="dropdown-item" href="{{route('auth.add')}}">Add Auth Praice</a> -->

                <div class="dropdown-divider"></div>
                <h6 class="dropdown-header">Store</h6>
                <a class="dropdown-item" href="{{route('product.add')}}">Add Product</a>


                <div class="dropdown-divider"></div>
                <h6 class="dropdown-header">SaLes</h6>
                <a class="dropdown-item" href="{{route('customer.index')}}">Add customer </a>
                <a class="dropdown-item" href="{{route('sale.add.get')}}">Sale Products </a>

                <div class="dropdown-divider"></div>
                <h6 class="dropdown-header">Purchases:</h6>
                <a class="dropdown-item" href="{{route('supplier.add.get')}}">Add Supplier</a>
                <a class="dropdown-item" href="{{route('buy.add.get')}}">Buy Products </a>
                <div class="dropdown-divider"></div>
                <h6 class="dropdown-header">Store Room:</h6>
                <a class="dropdown-item" href="{{route('store.add.get')}}">Add Store </a>
            </div>
         </li>

     <!--------------------- service -------------------------------->

     <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
         <i class="fas fa-wrench"></i>
           <span>Service</span>
         </a>
         <div class="dropdown-menu" aria-labelledby="pagesDropdown">

             <h6 class="dropdown-header">Machine Information</h6>
             <a class="dropdown-item" href="{{route('addMachine.index')}}">Add Machine </a>
             <a class="dropdown-item" href="">update Machine</a>

             <div class="dropdown-divider"></div>
             <h6 class="dropdown-header">Calls</h6>
             <a class="dropdown-item" href="{{route('addCall.index')}}">Add Call</a>
             <a class="dropdown-item" href="{{route('callTable')}}">Call Table</a>

             <div class="dropdown-divider"></div>

             <h6 class="dropdown-header">Engineers:</h6>
             <a class="dropdown-item" href="{{route('addEngineers.index')}}">Add Engineers</a>
             <a class="dropdown-item" href="{{route('showEngineerTable')}}">Engineer table</a>
             <a class="dropdown-item" href="{{route('addEngineers.index')}}">Add Engineers</a>

        </div>
     </li>
     <!--------------------- Sales -------------------------------->

       <li class="nav-item dropdown">
           <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
             aria-haspopup="true" aria-expanded="false">
             <i class="fas fa-headset"></i>
            <span>Sales</span>
             </a>
               <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                 <h6 class="dropdown-header">Sales</h6>
                   <a class="dropdown-item" href="{{route('salesMen.index')}}">Add Sales</a>
            </div>
         </li>
     </ul>
     <!--page contetnt-->

{{-- <li class="nav-item dropdown">
 <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
 aria-haspopup="true" aria-expanded="false">
 <i class="fas fa-wrench"></i>
 <span>Servicing</span>
 </a>
 <div class="dropdown-menu" aria-labelledby="pagesDropdown">
 <a class="dropdown-item" href="servicing/dashboard.php">Dashboard</a>
 </div>
 </li>
 <li class="nav-item dropdown">
 <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown"
 aria-haspopup="true" aria-expanded="false">
 <i class="fas fa-file-invoice-dollar"></i>
 <span>Sales</span>
 </a>
 <div class="dropdown-menu" aria-labelledby="pagesDropdown">
 <a class="dropdown-item" href="sales/salesrequest.php">Sales Request</a>
 </div>
 </li>--}}
    <!--page contetnt-->

    <div id="content-wrapper" class="bg-dark">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{route('store.dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active"></li>
            </ol>

            <!-- Page Content -->
            <div class="container">
                @yield('some')
                <div class="card col-sm-12 mx-auto mt-5">
                    @yield('content')
                </div>
                @yield('content2')
            </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer bg-dark text-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright © Smart System 2018</span>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('js/sb-admin.min.js')}}"></script>

<script src="{{asset('js/websqljs.js')}}"></script>


<script>

    /*

    get prouduct data
    */

    var Productname = document.getElementById("Productname");
    var ProductDiscretion = document.getElementById('ProductDiscretion');
    var PartNumber = document.getElementById('PartNumber');
    var ProductModel = document.getElementById('ProductModel');
    var ProductType = document.getElementById('ProductType');

    function init() {
        db.transaction(function (tx) {
            tx.executeSql('SELECT * FROM prouduct', [], function (tx, results) {
                var len = results.rows.length, i;
                for (i = 0; i < len; i++) {
                    //alert(results.rows.item(i).name);
                    var name = results.rows.item(i).name
                    var Discretion = results.rows.item(i).Discretion
                    var nump = results.rows.item(i).Number
                    var model = results.rows.item(i).Model
                    var type = results.rows.item(i).Type
                    Productname.options[Productname.options.length] = new Option(name, '0', false, false);
                    ProductDiscretion.options[ProductDiscretion.options.length] = new Option(Discretion, '0', false, false);
                    PartNumber.options[PartNumber.options.length] = new Option(nump, '0', false, false);
                    ProductModel.options[ProductModel.options.length] = new Option(model, '0', false, false);
                    ProductType.options[ProductType.options.length] = new Option(type, '0', false, false);
                }
            });

        });
    }

    init()
    var data = [];

    function savedata() {


        db.transaction(function (tx) {

            tx.executeSql(('INSERT INTO supplier (name,address,mobilenumber,telephonenumber) VALUES (?,?,?,?)'), [data.push = document.getElementById('Suppliername').value,
                data.push = document.getElementById('address').value,
                data.push = document.getElementById('Mobilenumber').value,
                data.push = document.getElementById('Telephonenumber').value
            ]);
        });
        location.reload();

    }

    //end save data


</script>
@yield('js')
</body>

</html>

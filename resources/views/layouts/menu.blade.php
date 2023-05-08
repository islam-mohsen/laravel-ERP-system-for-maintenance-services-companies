<!------------------- Sidebar ----------------->
<div id="wrapper">
 <ul class="sidebar navbar-nav" style="background-image: url({{asset('images/sidebar.jpg') }})">
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
                <a class="dropdown-item" href="{{route('type.add')}}">Add Product Type</a>

                <div class="dropdown-divider"></div>
                <h6 class="dropdown-header">Store</h6>
                <a class="dropdown-item" href="{{route('product.add')}}">Add Product</a>


                <div class="dropdown-divider"></div>
                <h6 class="dropdown-header">SaLes</h6>
                <a class="dropdown-item" href="{{route('customer.index')}}">Add customer </a>
                <a class="dropdown-item" href="{{route('customerTable')}}">Customer table </a>
                <a class="dropdown-item" href="{{route('sale.add.get')}}">Add Sales invoice </a>

                <div class="dropdown-divider"></div>
                <h6 class="dropdown-header">Purchases</h6>
                <a class="dropdown-item" href="{{route('supplier.add.get')}}">Add Supplier</a>
                <a class="dropdown-item" href="{{route('supplierTable')}}">Supplier table </a>
                <a class="dropdown-item" href="{{route('buy.add.get')}}">Add Purchases invoice </a>
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
           <a class="dropdown-item" href="{{route('machineInfo.table')}}">Machine table</a>

           <div class="dropdown-divider"></div>
           <h6 class="dropdown-header">Calls</h6>
           <a class="dropdown-item" href="{{route('addCall.index')}}">Add Call</a>
           <a class="dropdown-item" href="{{route('callTable')}}">Call Table</a>
           <a class="dropdown-item" href="{{route('uncompletedCall')}}">Uncompleted Call</a>
           <a class="dropdown-item" href="{{route('ServiceReportTable')}}">Service Report</a>


           <div class="dropdown-divider"></div>

           <h6 class="dropdown-header">Engineers:</h6>
           <a class="dropdown-item" href="{{route('addEngineers.index')}}">Add Engineers</a>
           <a class="dropdown-item" href="{{route('showEngineerTable')}}">Engineer table</a>

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

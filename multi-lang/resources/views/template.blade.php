<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

 
        <title>Athmos - Multilenguage admin</title>

        <!-- vendor css -->
        <link href="{{ url('templates') }}/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="{{ url('templates') }}/lib/Ionicons/css/ionicons.css" rel="stylesheet">
        <link href="{{ url('templates') }}/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
        <link href="{{ url('templates') }}/lib/rickshaw/rickshaw.min.css" rel="stylesheet">

        <link href="{{url('/templates')}}/lib/datatables/jquery.dataTables.css" rel="stylesheet">

        <!-- Starlight CSS -->
        <link rel="stylesheet" href="{{ url('templates') }}/css/starlight.css">
        <link rel="stylesheet" href="{{ url('templates') }}/css/style.css">


        <style type="text/css">
          body{
            background: #fff!important;
          }
        </style>

    </head>
    <body>
        
      @if(Auth::user())
    <!-- ########## START: LEFT PANEL ########## -->
        <div class="sl-logo">
            <a href="#"><i class="icon ion-android-star-outline"></i>Multi-lenguage</a>
        </div>

        <div class="sl-sideleft">

          <label class="sidebar-label">Navigation</label>
          
          <div class="sl-sideleft-menu">
            <a href="{{url('/panel')}}" class="sl-menu-link active">
              <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                <span class="menu-item-label">Dashboard</span>
              </div><!-- menu-item -->
            </a><!-- sl-menu-link -->


            <a href="#" class="sl-menu-link">
              <div class="sl-menu-item">
                <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
                <span class="menu-item-label">Modules</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
              </div><!-- menu-item -->
            </a><!-- sl-menu-link -->
            <ul class="sl-menu-sub nav flex-column">
              <li class="nav-item"><a href="{{url('/modules/create')}}" class="nav-link"><i class="menu-item-icon icon ion-plus"></i>  Add Module</a></li>

              @foreach(App\Module::all() as $module)
                <li class="nav-item"><a href="{{url('/modules')}}/{{$module->id}}" class="nav-link">{{$module->name}}</a></li>
              @endforeach
            </ul>

          </div><!-- sl-sideleft-menu -->

          <br>
        </div><!-- sl-sideleft -->
        <!-- ########## END: LEFT PANEL ########## -->

        <!-- ########## START: HEAD PANEL ########## -->
        <div class="sl-header">
          <div class="sl-header-left">
            <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
            <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
          </div><!-- sl-header-left -->
          <div class="sl-header-right">
            <nav class="nav">
              <div class="dropdown">
                <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
                  <span class="logged-name"><span class="hidden-md-down"> {{Auth::user()->name}}</span></span>
                  <img src="../img/img3.jpg" class="wd-32 rounded-circle" alt="">
                </a>
                <div class="dropdown-menu dropdown-menu-header wd-200">
                  <ul class="list-unstyled user-profile-nav">
                    <li><a href=""><i class="icon ion-ios-person-outline"></i> Edit Profile</a></li>
                    <li><a href=""><i class="icon ion-ios-gear-outline"></i> Settings</a></li>
                    <li><a href=""><i class="icon ion-power"></i> Sign Out</a></li>
                  </ul>
                </div><!-- dropdown-menu -->
              </div><!-- dropdown -->
            </nav>

          </div><!-- sl-header-right -->
        </div><!-- sl-header -->
        <!-- ########## END: HEAD PANEL ########## -->


        <!-- ########## START: MAIN PANEL ########## -->
        <div class="sl-mainpanel">
          <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{url('/panel')}}">Dashboard</a>
            @yield('page_name')
          </nav>

          <div class="sl-pagebody">

            @yield('content')

          </div><!-- sl-pagebody -->
          
          <footer class="sl-footer">
            <div class="footer-left">
              <div class="mg-b-2">Copyright &copy; 2017. Starlight. All Rights Reserved.</div>
              <div>Made by ThemePixels.</div>
            </div>

          </footer>
        </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
      @endif

        <script src="{{ url('templates') }}/lib/jquery/jquery.js"></script>
        <script src="{{ url('templates') }}/lib/popper.js/popper.js"></script>
        <script src="{{ url('templates') }}/lib/bootstrap/bootstrap.js"></script>
        <script src="{{ url('templates') }}/lib/jquery-ui/jquery-ui.js"></script>
        <script src="{{ url('templates') }}/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
        <script src="{{ url('templates') }}/lib/jquery.sparkline.bower/jquery.sparkline.min.js"></script>
        <script src="{{ url('templates') }}/lib/d3/d3.js"></script>
        <script src="{{ url('templates') }}/lib/rickshaw/rickshaw.min.js"></script>
        <script src="{{ url('templates') }}/lib/chart.js/Chart.js"></script>
        <script src="{{ url('templates') }}/lib/Flot/jquery.flot.js"></script>
        <script src="{{ url('templates') }}/lib/Flot/jquery.flot.pie.js"></script>
        <script src="{{ url('templates') }}/lib/Flot/jquery.flot.resize.js"></script>
        <script src="{{ url('templates') }}/lib/flot-spline/jquery.flot.spline.js"></script>

        <script src="{{url('/templates')}}/lib/datatables/jquery.dataTables.js"></script>
        <script src="{{url('/templates')}}/lib/datatables-responsive/dataTables.responsive.js"></script>


        <script src="{{ url('templates') }}/js/starlight.js"></script>
        <script src="{{ url('templates') }}/js/ResizeSensor.js"></script>
        <script src="{{ url('templates') }}/js/dashboard.js"></script>



       <!--  <script src="{{ url('assets') }}/BootstrapFormHelpers/dist/js/bootstrap-formhelpers.min.js"></script>

        <script src="{{ url('assets') }}/BootstrapFormHelpers/js/bootstrap-formhelpers-languages.js"></script>

        <script src="{{ url('assets') }}/BootstrapFormHelpers/js/bootstrap-formhelpers-countries.js"></script>

        <script src="{{ url('assets') }}/BootstrapFormHelpers/js/lang/en_US/bootstrap-formhelpers-languages.en_US.js"></script>
 -->
        @yield('scripts')
        <script type="text/javascript">
          $('.data-table').dataTable( {
            "paging": true
          } );

          function ConfirmDelete()
          {
            var x = confirm("Are you sure you want to delete?");
            if (x)
              return true;
            else
              return false;
          }
        </script>
    </body>
</html>

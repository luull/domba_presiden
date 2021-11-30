<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico')}}"/>
    <link href="{{ asset('admin/assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('admin/assets/js/loader.js')}}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('admin/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('admin/plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/dashboard/dash_1.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/plugins/flatpickr/flatpickr.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/plugins/flatpickr/custom-flatpickr.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/table/datatable/dt-global_style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/css/forms/switches.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
   
    @yield('style')
    @yield('script_atas')

</head>

<body>

<div id="load_screen"> <div class="loader"> <div class="loader-content">
    <div class="spinner-grow align-self-center"></div>
    </div></div></div>
      @include('admin.header')
      <div class="main-container" id="container">
        <div class="overlay"></div>
        <div class="search-overlay"></div>
            <div class="sidebar-wrapper sidebar-theme">
              @include('admin.sidebar')
              <!-- #/ container -->
            </div>
            @yield('content_title')
            <div id="content" class="main-content">

                @yield('content')
      
            </div>
      </div>
  </div>
    <script src="https://use.fontawesome.com/e431abfbc6.js"></script>
    <script src="{{ asset('admin/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
    <script src="{{ asset('admin/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{ asset('admin/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('admin/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
    <script src="{{ asset('admin/assets/js/app.js')}}"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="{{ asset('admin/assets/js/custom.js')}}"></script>
    <script src="{{ asset('admin/plugins/apex/apexcharts.min.js')}}"></script>
    <script src="{{ asset('admin/assets/js/dashboard/dash_1.js')}}"></script>
    <script src="{{ asset('admin/assets/js/scrollspyNav.js')}}"></script>
    <script src="{{ asset('admin/plugins/flatpickr/flatpickr.js')}}"></script>
    <script src="{{ asset('admin/plugins/flatpickr/custom-flatpickr.js')}}"></script>
    <script>
      var f1 = flatpickr(document.getElementById('basicFlatpickr'));
    </script>
    <script>
      var f1 = flatpickr(document.getElementById('basicFlatpickr2'));
    </script>
    <script src="{{ asset('admin/plugins/table/datatable/datatables.js')}}"></script>
    <script>
        $('#zero-config').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
        "<'table-responsive'tr>" +
        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7 
        });
    </script>
    <script src="{{ asset('admin/plugins/select2/select2.min.js')}}"></script>
    <script src="{{ asset('admin/plugins/select2/custom-select2.js')}}"></script>
    @yield('script')
</body>
<div class="modal" tabindex="-1" role="dialog" id="mymodal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" id="btnOk" class="btn btn-primary">Save changes</button>
          <button type="button" id="btnClose" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</html>
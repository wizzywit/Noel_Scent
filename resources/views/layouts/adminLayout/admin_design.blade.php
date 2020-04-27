<!DOCTYPE html>
<html lang="en">
<head>
<title>Noel's Scent Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css" integrity="sha256-zuyRv+YsWwh1XR5tsrZ7VCfGqUmmPmqBjIvJgQWoSDo=" crossorigin="anonymous" /> -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.min.css">
<link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap-responsive.min.css') }}" />
<link rel="stylesheet" href="{{ asset('css/backend_css/fullcalendar.css') }}" />
<link rel="stylesheet" href="{{ asset('css/backend_css/matrix-style.css') }}" />
<link rel="stylesheet" href="{{ asset('css/backend_css/matrix-media.css') }}" />
<link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap-wysihtml5.css') }}" />
<link href="{{ asset('fonts/backend_fonts/css/font-awesome.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('css/backend_css/jquery.gritter.css') }}" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>


<!-- for datatbles -->  
<link rel="stylesheet" href="{{ asset('css/backend_css/uniform.css') }}" />
<link rel="stylesheet" href="{{ asset('css/backend_css/select2.css') }}" />

</head>
<body>
@include('layouts.adminLayout.admin_header')
@include('layouts.adminLayout.admin_sidebar')
@yield('content')

@include('layouts.adminLayout.admin_footer')

<!-- <script src="{{ asset('js/backend_js/excanvas.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.ui.custom.js') }}"></script> 
<script src="{{ asset('js/backend_js/bootstrap.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.flot.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.flot.resize.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.peity.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/fullcalendar.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/matrix.js') }}"></script> 
<script src="{{ asset('js/backend_js/matrix.dashboard.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.gritter.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/matrix.interface.js') }}"></script> 
<script src="{{ asset('js/backend_js/matrix.chat.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.validate.js') }}"></script> 
<script src="{{ asset('js/backend_js/matrix.form_validation.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.wizard.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.uniform.js') }}"></script> 
<script src="{{ asset('js/backend_js/select2.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/matrix.popover.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.dataTables.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/matrix.tables.js') }}"></script>  -->

<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
//   function goPage (newURL) {

//       // if url is empty, skip the menu dividers and reset the menu selection to default
//       if (newURL != "") {
      
//           // if url is "-", it is this page -- reset the menu:
//           if (newURL == "-" ) {
//               resetMenu();            
//           } 
//           // else, send page to designated URL            
//           else {  
//             document.location.href = newURL;
//           }
//       }
//   }

// resets the menu selection upon entry to this page:

function confirmDelete(){
		if(confirm("Proceed to delete category?")){ 
			return true;
		}
		else return false;
  }
  function confirmDeleteProd(){
		if(confirm("Proceed to delete Product?")){ 
			return true;
		}
		else return false;
  }
  
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js" integrity="sha256-JirYRqbf+qzfqVtEE4GETyHlAbiCpC005yBTa4rj6xg=" crossorigin="anonymous"></script> -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.all.min.js"></script>
<script src="{{ asset('js/backend_js/jquery.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.ui.custom.js') }}"></script> 
<script src="{{ asset('js/backend_js/bootstrap.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.uniform.js') }}"></script> 
<script src="{{ asset('js/backend_js/masked.js') }}"></script> 
<script src="{{ asset('js/backend_js/select2.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/jquery.validate.js') }}"></script> 
<script src="{{ asset('js/backend_js/matrix.js') }}"></script> 
<script src="{{ asset('js/backend_js/matrix.form_validation.js') }}"></script>
<script src="{{ asset('js/backend_js/jquery.dataTables.min.js') }}"></script> 
<script src="{{ asset('js/backend_js/matrix.tables.js') }}"></script>
<script src="{{ asset('js/backend_js/bootstrap-wysihtml5.js') }}"></script>
<script src="{{ asset('js/backend_js/jquery.peity.min.js') }}"></script>
<script src="{{ asset('js/backend_js/wysihtml5-0.3.0.js') }}"></script>

<script src="{{ asset('js/backend_js/jquery.gritter.min.js') }}"></script>
<script src="{{ asset('js/backend_js/matrix.interface.js') }}"></script> 
<script src="{{ asset('js/backend_js/matrix.popover.js') }}"></script>
</body>
</html>

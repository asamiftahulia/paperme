<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>@yield('page-title')</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

    <!-- Bootstrap core CSS     -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="{{asset('assets/css/material-dashboard.css?v=1.2.0')}}" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{asset('assets/css/demo.css')}}" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
    <!-- JQuery DataTable Css -->
    <link href="{{asset('/assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style-timeline.css')}}" media="all" />

    <!-- selectpicker -->

    <!-- datepicker -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-*.min.js"></script>


</head>

<body>
<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="../assets/img/sidebar-1.jpg">
        <!--
    Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"
    Tip 2: you can also add an image using data-image tag
-->
        <div class="logo">
            <a href="http://www.creative-tim.com" class="simple-text">
                Paperless System
            </a>
        </div>
        <div class="sidebar-wrapper">
            <ul class="nav">
                <!-- <li class="@yield('aktif-dashboard')">
                    <a href="{{route('dashboard.index')}}">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="@yield('aktif-mbank')">
                    <a href="{{route('master-bank.index')}}">
                        <i class="material-icons" class="@yield('aktif')">dashboard</i>
                        <p>Master Bank</p>
                    </a>
                </li>
                <li class="@yield('aktif-mbranch')">
                    <a href="{{route('master-branch.index')}}">
                        <i class="material-icons">dashboard</i>
                        <p>Master Branch</p>
                    </a>
                </li>
                <li class="@yield('aktif-mtipedep')">
                    <a href="{{route('tipe-deposito.create')}}">
                        <i class="material-icons">bubble_chart</i>
                        <p>Master Tipe Deposito</p>
                    </a>
                </li>
                <li class="@yield('aktif-muser')">
                    <a href="{{route('user.create')}}">
                        <i class="material-icons">person</i>
                        <p>Master User</p>
                    </a>
                </li> -->
                <li class="@yield('aktif-m-sr')">
                    <a href="{{route('special-rate.index')}}">
                        <i class="material-icons">person</i>
                        <p>Master Special Rate</p>
                    </a>
                 </li>
                <li class="@yield('aktif-mtimedep')">
                    <a href="{{route('time-deposit.create')}}">
                        <i class="material-icons">person</i>
                        <p>Time Deposit (TD)</p>
                    </a>
                 </li>
              <!--<li class="@yield('aktif-timeline')">
                    <a href="{{route('time-deposit.create')}}">
                        <i class="material-icons">person</i>
                        <p>Timeline</p>
                    </a>
                </li> -->
               <!--  <li>
                    <a href="{{route('trx-time-deposit.create')}}">
                        <i class="material-icons">person</i>
                        <p>Transaction TD</p>
                    </a>
                </li> -->
                <!-- <li>
                    <a href="{{route('customer.index')}}">
                        <i class="material-icons">content_paste</i>
                        <p>Customer List</p>
                    </a>
                </li> -->
              <!--   <li>
                    <a href="{{route('customer.index')}}">
                        <i class="material-icons">library_books</i>
                        <p>Datatables</p>
                    </a>
                </li> -->
            </ul>
        </div>
    </div>
    <div class="main-panel">

        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Blog
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>
                    <a href="http://www.creative-tim.com">IT System Developer</a>, made with love for a better web
                </p>
            </div>
        </footer>
    </div>
</div>
</body>
<!--   Core JS Files   -->

<!-- toastr -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<!-- end toastr -->
<script src="{{asset('/assets/js/admin.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/js/jquery-3.2.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/js/material.min.js')}}" type="text/javascript"></script>
<!--  Charts Plugin -->
<script src="{{asset('/assets/js/chartist.min.js')}}"></script>
<!--  Dynamic Elements plugin -->
<script src="{{asset('/assets/js/arrive.min.js')}}"></script>
<!--  PerfectScrollbar Library -->
<script src="{{asset('/assets/js/perfect-scrollbar.jquery.min.js')}}">
</script>
<!--  Notifications Plugin    -->
<script src="{{asset('/assets/js/bootstrap-notify.js')}}"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Material Dashboard javascript methods -->
<script src="{{asset('/assets/js/material-dashboard.js?v=1.2.0')}}"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<!-- <script src="{{asset('assets/js/demo.js')}}"></scrip

<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('/assets/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{asset('/assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>
<!-- <script src="{{asset('/assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js')}}"></script> -->
<script src="{{asset('/assets/plugins/jquery-datatable/extensions/export/buttons.flash.min.js')}}"></script>
<script src="{{asset('/assets/plugins/jquery-datatable/extensions/export/jszip.min.js')}}"></script>
<script src="{{asset('/assets/plugins/jquery-datatable/extensions/export/pdfmake.min.js')}}"></script>
<script src="{{asset('/assets/plugins/jquery-datatable/extensions/export/vfs_fonts.js')}}"></script>
<script src="{{asset('/assets/plugins/jquery-datatable/extensions/export/buttons.html5.min.js')}}"></script>
<script src="{{asset('/assets/plugins/jquery-datatable/extensions/export/buttons.print.min.js')}}"></script>
<script src="{{asset('/assets/plugins/jquery.masknumber.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/plugins/jquery.maskedinput.js')}}" type="text/javascript"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<script src="{{asset('/assets/js/bootstrap-datepicker.js')}}" type="text/javascript"></script>

<script>
        @if(Session::has('message'))    
        var type = "{{Session::get('alert-type','info')}}"
        switch(type){
            case 'success':
                toastr.success("{{Session::get('message')}}");
                break;
            case 'info':
                toastr.info("{{Session::get('message')}}");
                break;
            case 'warning':
                toastr.warning("{{Session::get('message')}}");
                break;
            case 'error':
                toastr.error("{{Session::get('message')}}");
                break;
        }
    @endif

    $(function() {
        $("#amount").keyup().maskNumber({integer: true});
    });

    // $(function() {
    //     $('#special_rate').keyup().maskNumber("#,##0.00", {reverse: true});
    // });

   
    //date
    $(function(){
        $('#expired_date').mask('99/99/9999');
        // $('#date_rollover').mask('99/99/9999');
        // $('#money').mask('Rp 99,999');
    });
    $( function() {
        $( "#date_rollover" ).datepicker();
    } );
    $(function () {
        $('.js-basic-example').DataTable({
            responsive: true
        });
        //Exportable table
        $('.js-exportable').DataTable({
            dom: 'Bfrtip',
            responsive: true,
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
    //end exportable
    //form validation
    $(function () {
        $('#form_validation').validate({
            rules: {
                'checkbox': {
                    required: true
                },
                'gender': {
                    required: true
                }
            },
            highlight: function (input) {
                $(input).parents('.form-line').addClass('error');
            },
            unhighlight: function (input) {
                $(input).parents('.form-line').removeClass('error');
            },
            errorPlacement: function (error, element) {
                $(element).parents('.form-group').append(error);
            }
        });
        //Advanced Form Validation
        $('#form_advanced_validation').validate({
            rules: {
                'date': {
                    customdate: true
                },
                'creditcard': {
                    creditcard: true
                }
            },
            highlight: function (input) {
                $(input).parents('.form-line').addClass('error');
            },
            unhighlight: function (input) {
                $(input).parents('.form-line').removeClass('error');
            },
            errorPlacement: function (error, element) {
                $(element).parents('.form-group').append(error);
            }
        });
        //Custom Validations ===============================================================================
        //Date
        $.validator.addMethod('customdate', function (value, element) {
                return value.match(/^\d\d\d\d?-\d\d?-\d\d$/);
            },
            'Please enter a date in the format YYYY-MM-DD.'
        );
        //Credit card
        $.validator.addMethod('creditcard', function (value, element) {
                return value.match(/^\d\d\d\d?-\d\d\d\d?-\d\d\d\d?-\d\d\d\d$/);
            },
            'Please enter a credit card in the format XXXX-XXXX-XXXX-XXXX.'
        );
        //==================================================================================================
    });
</script>

<script type="text/javascript">
  function autoFill() {
    var specialRate = document.getElementById('special_rate').value;
    if(specialRate!='' ){    
    var period = document.getElementById('period').value;
    var pausecontent = new Array();
    <?php foreach($data as $datas){ ?>
        pausecontent.push('<?php echo $datas; ?>');
        alert(pausecontent);
    <?php } ?> 
    var data ;
    for(var i = 0; i<pausecontent.length;i++){
            pausecontent[i] = JSON.parse(pausecontent[i]);
           if(period == pausecontent[i].term){
               data = pausecontent[i];
               break;
           }
    }
    //  document.getElementById("demo").innerHTML = data.term;
     document.getElementById("demo").innerHTML = data.term + ", " + data.counter_rate + ", " + data.area_manager + ", " + data.regional_head + ", " + data.director;
    
     if(specialRate >= data.counter_rate && specialRate <= data.area_manager){
        document.getElementById('normal_rate').innerHTML = 'asa';
        document.getElementById("apr").innerHTML = 'BRANCH MANAGER';
     }else if(specialRate >= data.area_manager && specialRate <= data.regional_head){
        document.getElementById('normal_ratenr').value = data.area_manager;
        document.getElementById("apr").innerHTML = 'AREA MANAGER';
     }else if(specialRate >= data.regional_head && specialRate <= data.director){
        document.getElementById('normal_rate').value = data.regional_head;
        document.getElementById("apr").innerHTML = 'REGIONAL HEAD';
     }else if(specialRate > data.director){
         document.getElementById('normal_rate').value = data.director;
        document.getElementById("apr").innerHTML = 'DIRECTOR';
         
     }
    }
  }

</script>


</html>
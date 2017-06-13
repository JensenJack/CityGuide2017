<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" href="{{ config('app.app_setting.favicon') }}">
        <title>@yield('title', app_name())</title>

        <!-- Meta -->
        <meta name="description" content="@yield('meta_description', 'Laravel 5 Boilerplate')">
        <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">

            <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
            <meta name="keywords" content="Template, html, premium, themeforest" />
            <meta name="description" content="Traveler - Premium template for travel companies">
            <meta name="author" content="Tsoy">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            
       

        @yield('meta')

        <!-- Styles -->
        @yield('before-styles')

        <!-- GOOGLE FONTS -->
            <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700' rel='stylesheet' type='text/css'>
            <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600' rel='stylesheet' type='text/css'>
            <!-- /GOOGLE FONTS -->
            <link rel="stylesheet" href="/css/frontend/css/bootstrap.css">
            <link rel="stylesheet" href="/css/frontend/css/font-awesome.css">
            <link rel="stylesheet" href="/css/frontend/css/icomoon.css">
            <link rel="stylesheet" href="/css/frontend/css/styles.css">
            <link rel="stylesheet" href="/css/frontend/css/mystyles.css">
            <script src="/js/frontend/js/modernizr.js"></script>


        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        @langRTL
            {!! Html::style(elixir('css/rtl.css')) !!}
        @endif

        @yield('after-styles')
            {{ Html::style(elixir('css/frontend.css')) }}
        <!-- Scripts -->
       
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
    <body id="app-layout">
        <div id="app">

            
                @include('frontend.includes.head')

               
                @include('includes.partials.messages')
                @yield('content')
         
         

                @include('frontend.includes.footer')

        
        </div><!--#app-->

        <!-- Scripts -->
        @yield('before-scripts')
        {{-- <script src="/js/frontend/js/modernizr.js"></script> --}}
        {{-- {!! Html::script(elixir('/js/frontend.js')) !!} --}}
        <script src="/js/frontend/js/jquery.js"></script>
        <script src="/js/frontend/js/bootstrap.js"></script>
        <script src="/js/frontend/js/slimmenu.js"></script>
        <script src="/js/frontend/js/bootstrap-datepicker.js"></script>
        <script src="/js/frontend/js/bootstrap-timepicker.js"></script>
        <script src="/js/frontend/js/nicescroll.js"></script>
        <script src="/js/frontend/js/dropit.js"></script>
        <script src="/js/frontend/js/ionrangeslider.js"></script>
        <script src="/js/frontend/js/icheck.js"></script>
        <script src="/js/frontend/js/fotorama.js"></script>
        <script src="/js/frontend/js/typeahead.js"></script>
        <script src="/js/frontend/js/card-payment.js"></script>
        <script src="/js/frontend/js/magnific.js"></script>
        <script src="/js/frontend/js/owl-carousel.js"></script>
        <script src="/js/frontend/js/fitvids.js"></script>
        <script src="/js/frontend/js/tweet.js"></script>
        <script src="/js/frontend/js/countdown.js"></script>
        <script src="/js/frontend/js/gridrotator.js"></script>
        <script src="/js/frontend/js/custom.js"></script>
        
        @yield('after-scripts')

     <!--    error messages -->

        <script type="text/javascript">
        $(document).ready(function() { 
            var errors = JSON.parse('{!! $errors->toJson() !!}');
            $.each(errors, function( key, value ) {

                    if($("input[name='" + key + "']").length) {
                        $("input[name='" + key + "']").after("<span style='color:red;'>"+value+"</span>");
                    }
                    if($("textarea[name='" + key + "']").length) {
                        $("textarea[name='" + key + "']").after("<span style='color:red;'>"+value+"</span>");
                    }
                    if($("select[name='" + key + "']").length) {
                        $("select[name='" + key + "']").after("<span style='color:red;'>"+value+"</span>");
                    }
                

            });
        });
    </script>

        


        @include('includes.partials.ga')
    </body>
</html>
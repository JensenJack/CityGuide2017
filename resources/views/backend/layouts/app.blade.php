<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ config('app.app_setting.favicon') }}">
        <title>{{ app_name() }} | @yield('title','Home')</title>

        <!-- Meta -->
        <meta name="description" content="@yield('meta_description', 'Default Description')">
        <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
        @yield('meta')

        <!-- Styles -->
        @yield('before-styles')

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        @langRTL
            {{ Html::style(elixir('css/backend-rtl.css')) }}
            {{ Html::style(elixir('css/rtl.css')) }}
        @else
            {{ Html::style(elixir('css/backend.css')) }}
            {{ Html::style('css/backend/plugin/select2/css/select2.min.css') }}
            {{ Html::style('css/backend/plugin/select2/css/select2-bootstrap.min.css') }}
        @endif

        @yield('after-styles')

        <!-- Html5 Shim and Respond.js IE8 support of Html5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        {{ Html::script('https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js') }}
        {{ Html::script('https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js') }}
        <![endif]-->

        <!-- Scripts -->
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
    </head>
    <body class="skin-{{ config('backend.theme') }} {{ config('backend.layout') }}">
        @include('includes.partials.logged-in-as')

        <div class="wrapper">
            @include('backend.includes.header')
            @include('backend.includes.sidebar')

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    @yield('page-header')

                    {{-- Change to Breadcrumbs::render() if you want it to error to remind you to create the breadcrumbs for the given route --}}
                    {!! Breadcrumbs::renderIfExists() !!}
                </section>

                <!-- Main content -->
                <section class="content">
                    @include('includes.partials.messages')
                    @yield('content')
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            @include('backend.includes.footer')
        </div><!-- ./wrapper -->

        <!-- JavaScripts -->
        @yield('before-scripts')
        {{ Html::script(elixir('js/backend.js')) }}
        {{ Html::script('js/backend/plugin/select2/js/select2.min.js') }}
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
    </body>
</html>
<!doctype html>
<html lang="en">
    @include('dashboard.partials.head')

    <body class="vertical  light  ">
        <div class="wrapper">

            @include('dashboard.partials.header')

            @include('dashboard.partials.sidebar')

            <main role="main" class="main-content">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        @yield('content')
                    </div>
                </div>
            </main>

        </div> <!-- .wrapper -->

        @include('dashboard.modals.mainModal')
        @include('dashboard.modals.deleteModal')
        @include('dashboard.partials.scripts')
    </body>

</html>



















<!doctype html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}" dir="{{LaravelLocalization::getCurrentLocaleDirection()}}">

    @include('dashboard.partials.head')

    <body data-sidebar="dark">
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">
            
            

            

            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">

                        

                    </div>
                </div>

                @include('dashboard.partials.footer')
            </div>

        </div>
        <!-- END layout-wrapper -->

        
    </body>

</html>
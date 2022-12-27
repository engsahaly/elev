<!doctype html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}">
    @include('dashboard.partials.head')

    <body class="vertical light {{LaravelLocalization::getCurrentLocaleDirection()}}">
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
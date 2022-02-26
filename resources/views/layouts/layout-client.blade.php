<!DOCTYPE html>
<html lang="en">

@include('client.partials._head')

<body>
    <div class="wrapper">
        @include('client.partials._header')

        <!-- end header -->
        
        @yield('main')

        {{-- end main --}}

        <!-- footer -->
        @include('client.partials._footer')

    </div>

    @include('client.partials._script')

    @yield('script')
</body>

</html>
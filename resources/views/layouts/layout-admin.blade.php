<!DOCTYPE html>
<html lang="en">

@include('admin.partials._head')

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('admin.partials._navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      @include('admin.partials._settings-panel')
      @include('admin.partials._right-sidebar')

      <!-- partial -->
      <!-- partial:partials/.html -->
      @include('admin.partials._sidebar')

      <!-- partial -->
      <div class="main-panel">
        <!-- start include content -->
        @yield('main')
        <!-- partial:partials/_footer.html -->
        @include('admin.partials._footer')

        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->


  @include('admin.partials._script')
  
  {{-- script --}}
  @yield('script')
</body>

</html>
<!-- editor -->

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<!-- plugins:js -->
<script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{asset('assets/vendors/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
<script src="{{asset('assets/js/jsadmin/dataTables.select.min.js')}}"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{asset('assets/js/jsadmin/off-canvas.js')}}"></script>
<script src="{{asset('assets/js/jsadmin/hoverable-collapse.js')}}"></script>
<script src="{{asset('assets/js/jsadmin/template.js')}}"></script>
<script src="{{asset('assets/')}}/js/jsadmin/settings.js"></script>
<script src="{{asset('assets/js/jsadmin/todolist.js')}}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{asset('assets/js/jsadmin/dashboard.js')}}"></script>
<script src="{{asset('assets/js/jsadmin/Chart.roundedBarCharts.js')}}"></script>

{{-- <script src="{{asset('assets/js/file-upload.js')}}"></script> --}}
{{-- <script src="{{asset('assets/js/typeahead.js')}}"></script> --}}
{{-- <script src="{{asset('assets/js/select2.js')}}"></script> --}}
<!-- End custom js for this page-->
<!-- js -->
<script src="{{asset('assets/js/layout/previewImg.js')}}"></script>
<!-- editor -->
<script src="{{asset('assets/js/jsadmin/editor.js')}}"></script>
<!-- handle data php -->
<script src="{{asset('assets/js/handle/filter_pro_admin.js')}}"></script>
<script src="{{asset('assets/js/handle/helper.js')}}"></script>

<!-- lib js query validate cdn-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

{{-- axios call api --}}
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<!-- validate form -->

{{-- <script src="./public/js/validate/validatorAdmin/validator__cate.js"></script> --}}
<!-- thống kê -->
@yield('plugin-script')


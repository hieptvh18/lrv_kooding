<!-- editor -->

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<!-- plugins:js -->
<script src="./public/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="./public/vendors/chart.js/Chart.min.js"></script>
<script src="./public/vendors/datatables.net/jquery.dataTables.js"></script>
<script src="./public/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
<script src="./public/js/jsadmin/dataTables.select.min.js"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="./public/js/jsadmin/off-canvas.js"></script>
<script src="./public/js/jsadmin/hoverable-collapse.js"></script>
<script src="./public/js/jsadmin/template.js"></script>
<script src="./public/js/jsadmin/settings.js"></script>
<script src="./public/js/jsadmin/todolist.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="./public/js/jsadmin/dashboard.js"></script>
<script src="./public/js/jsadmin/Chart.roundedBarCharts.js"></script>

<script src="./public/js/file-upload.js"></script>
<script src="./public/js/typeahead.js"></script>
<script src="./public/js/select2.js"></script>
<!-- End custom js for this page-->
<!-- js -->
<script src="./public/js/layout/previewImg.js"></script>
<!-- editor -->
<script src="./public/js/jsadmin/editor.js"></script>
<!-- handle data php -->
<script src="./public/js/handle/filter_pro_admin.js"></script>

<!-- lib js query validate cdn-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- validate form -->
<script src="./public/js/validate/validatorAdmin/validator__cate.js"></script>
<!-- thống kê -->
<script>
  // doanh thu theo từng tháng
  const ctx = document.getElementById('doanhthu').getContext('2d');
  const myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [<?php foreach($data['doanh_thu_thang'] as $t){
        echo "'".'Tháng '.$t['thang']."'".',';
      } ?>],
      datasets: [{
        label: 'Doanh thu',
        data: [<?php foreach($data['doanh_thu_thang'] as $t){
            echo $t['doanhthu'].',';
        } ?>],
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>

<!-- số lg hàng theo danh mục -->
<script>
  
  const slhang = document.getElementById('soluonghang').getContext('2d');
  const myChart_slhang = new Chart(slhang, {
    type: 'bar',
    data: {
      labels: [<?php foreach($data['qty_product_cate'] as $item){
          echo "'".$item['name']."'".',';
      } ?>],
      datasets: [{
        label: 'Số lượng',
        data: [<?php foreach($data['qty_product_cate'] as $item){
            echo $item['quantity'].',';
        } ?>],
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<script>
  //<!-- dh bán ra hàng tháng -->
  const spbanra = document.getElementById('spbanra').getContext('2d');
  const myChart_spbanra = new Chart(spbanra, {
    type: 'bar',
    data: {
      labels: [<?php foreach($data['dh_ban_ra'] as $item){
          echo "'".'Tháng '.$item['month']."'".',';
      } ?>],
      datasets: [{
        label: 'Số lượng đơn',
        data: [<?php foreach($data['dh_ban_ra'] as $item){
          echo $item['qty'].',';
      } ?>],
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<!-- tk đơn hàng -->
<script>
  const donhang = document.getElementById('donhang').getContext('2d');
  const myChart_donhang = new Chart(donhang, {
    type: 'pie',
    data: {
      labels: ['Đơn đã hủy','Đơn chưa xác nhận','Đơn đang xử lí','Đơn đã gửi đi'],
      datasets: [{
        label: 'Số sản phẩm',
        data: [<?= $data['cancel_order'] ?>,<?= $data['unprocess_order'] ?>,<?= $data['processing_order'] ?>,<?= $data['sent_order'] ?>],
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <?php if (isset($_GET['msg'])) : ?>
            <div class="bg-success p-2">
                <?php echo $_GET['msg']; ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($data['err'])) : ?>
            <div class="bg-danger text-light p-2">
                <?php echo $data['err']; ?>
            </div>
        <?php endif; ?>
        <div class="card-body">
            <!-- value -->
            <h4 class="card-title mt-5">Thêm giá trị thuộc tính sản phẩm mới</h4>
            <p class="card-description">
                Basic form elements
            </p>
            <form id="add_arb" action="" class="forms-sample mb-5" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputName1">Thuộc tính</label>
                    <select name="attr" id="attr" class="form-control">
                        <?php foreach ($data['attrs'] as $a) : ?>
                            <option value="<?= $a['id'] ?>"><?= $a['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group" id="input-value">
                    <label for="">Giá trị</label>
                    <input type="text" class="form-control" name="value" placeholder="Nhập màu giá trị của thuộc tính(M, l, đỏ cam...)">
                </div>

                <button type="submit" name="btn_add_value" class="btn btn-primary mr-2">Submit</button>
                <a href="" btn btn-light>Danh sách</a>
            </form>
            <h4 class="card-title mt-5">Danh sách gía trị của thuộc tính.</h4>
            <div class="card-body">
                <h4 class="card-title">Danh sách sản phẩm</h4>
               

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên thuộc tính</th>
                                <th>Giá trị</th>
                                <th>Chức năng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $n = 1;
                            foreach ($data['list_attr_value'] as $item) : ?>
                                <tr>
                                    <td><?php echo $n; ?></td>
                                    <td><?= $item['name'] ?></td>
                                    <td><?= $item['value'] ?></td>
                                    <td>
                                      
                                        <a href="product?action=addAttrProduct&del=<?= $item['id'] ?>" onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm?')"><i class="fas fa-trash-alt text-danger fa-2x"></i></a>
                                    </td>
                                </tr>
                            <?php $n++;
                            endforeach ?>

                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>

</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    // $(document).ready(function(){
    //     $('#attr').change(function(){
    //         var attr = $('#attr').val()
    //         if(attr == 2){
    //             $('#input-size').show()
    //             $('#input-color').hide()
    //         }else{
    //             $('#input-size').hide()
    //             $('#input-color').show()
    //         }
    //     })
    // })
</script>
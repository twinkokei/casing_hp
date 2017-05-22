<!-- Content Header (Page header) -->

<?php if(isset($_GET['did']) && $_GET['did'] == 1){ ?>
<section class="content_new">
<div class="alert alert-info alert-dismissable">
<i class="fa fa-check"></i>
<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
<b>Simpan gagal !</b>
Password dan confirm password tidak sama
</div>
</section>
<?php } ?>
<!-- Main content -->
<section class="content">
  <div class="row">
  <!-- right column -->
    <div class="col-md-12">
    <!-- general form elements disabled -->
    <div class="title_page"> <?= $title ?></div>
      <form action="<?= $action?>" method="post" enctype="multipart/form-data" role="form">
        <div class="box box-cokelat">
          <div class="box-body">
            <div class="col-md-9">
              <div class="form-group">
                <label>Nama item</label>
                <input required type="text" name="i_name" class="form-control" placeholder="Masukkan nama item ..." value="<?= $row->item_name ?>"/>
              </div>
              <div class="form-group">
                <label>HPP</label>
                <input required type="number" name="i_original_price" class="form-control" placeholder="Masukkan harga original ..." value="<?= $row->item_original_price ?>"/>
              </div>
              <div class="form-group">
                <label>Margin</label>
                <input required type="number" name="i_margin_price" class="form-control" placeholder="Masukkan margin ..." value="<?= $row->item_margin_price ?>"/>
              </div>
              <div class="form-group">
                <label>Harga Jual</label>
                <input required type="number" name="i_price" class="form-control" placeholder="Masukkan harga ..." value="<?= $row->item_price ?>"/>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>Images</label>
                <?php
                if($id){
                $gambar = ($row->item_img) ? $row->item_img : "default.jpg"; ?>
                <br/>
                <img src="<?= "../img/item/".$gambar ?>" style="width:100%;"/>
                <?php } ?>
                <input type="file" name="i_img" id="i_img" />
              </div>
            </div>
            <div style="clear:both;"></div>
          </div><!-- /.box-body -->
          <div class="box-footer">
            <input class="btn btn-danger" type="submit" value="Save"/>
            <a href="<?= $close_button?>" class="btn btn-danger" >Close</a>
          </div>
        </div><!-- /.box -->
      </form>
    </div><!--/.col (right) -->
  </div>   <!-- /.row -->
</section><!-- /.content -->
<script type="text/javascript">

// function item_kategori(){
//   var x = document.getElementById("kategori_utama").value;
//   //alert(x);
//   $.ajax({
//     type: 'POST',
//     url: 'item.php?page=item_type',
//     data: {x:x},
//     dataType: 'json',
//   }).done(function(data) {
//     $('#item_type_v').html("");
//     // alert(data.data[0]['item_type_name']);
//     for(var inn = 0; inn<data.data.length; inn++){
//     $("#item_type_v").append("<option value='"+data.data[inn]['item_type_id']+"'>"+data.data[inn]['item_type_name']+"</option>");
//     }
//     $('#item_type_v').selectpicker("refresh");
//     });
//   }
</script>

<!-- Content Header (Page header) -->

                 <?php
                if(isset($_GET['did']) && $_GET['did'] == 1){
                ?>
                <section class="content_new">

                <div class="alert alert-info alert-dismissable">
                <i class="fa fa-check"></i>
                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                <b>Simpan gagal !</b>
               Password dan confirm password tidak sama
                </div>

                </section>
                <?php
                }
                ?>

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
                                        <label>Nama merk</label>
                                        <input required type="text" name="i_name" class="form-control" placeholder="Masukkan nama merk ..." value="<?= $row->merk_name ?>"/>
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

    function menu_kategori(){
  			var x = document.getElementById("kategori_utama").value;
  			//alert(x);
  			$.ajax
          ({
  						type: 'POST',
  						url: 'menu.php?page=menu_type',
              data: {x:x},
  						dataType: 'json',
          }).done(function(data) {
  					$('#menu_type_v').html("");
  					// alert(data.data[0]['menu_type_name']);
  						for(var inn = 0; inn<data.data.length; inn++){
                $("#menu_type_v").append("<option value='"+data.data[inn]['menu_type_id']+"'>"+data.data[inn]['menu_type_name']+"</option>");
  						}
  						$('#menu_type_v').selectpicker("refresh");
  				});
  		}
  </script>

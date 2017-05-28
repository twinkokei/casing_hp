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
                                        <label>Type HP</label>
                                        <input required type="text" name="i_name" class="form-control" placeholder="Masukkan nama type HP ..." value="<?= $row->item_name ?>"/>
                                    </div>
                                    <div class="form-group">
                                      <label>Merk</label>
                                        <select id="i_merk" name="i_merk" size="1" class="selectpicker show-tick form-control"
                                        data-live-search="true">
                                        <option value="0"></option>
                                        <?php
                                              while($r_type = mysql_fetch_array($query_merk)){ ?>
                                             <option <?php if($row->item_merk == $r_type['merk_id']){ ?> selected="selected"<?php } ?> value="<?= $r_type['merk_id'] ?>"><?= $r_type['merk_name']?></option>
                                             <?php } ?>
                                        </select>
                                    </div>
                                     <div class="form-group">
                                      <label>Jenis Bahan</label>
                                        <select id="i_bahan" name="i_bahan" size="1" class="selectpicker show-tick form-control"
                                        data-live-search="true">
                                        <option value="0"></option>
                                        <?php
                                              while($r_type = mysql_fetch_array($query_bahan)){ ?>
                                             <option <?php if($row->item_bahan == $r_type['bahan_id']){ ?> selected="selected"<?php } ?> value="<?= $r_type['bahan_id'] ?>"><?= $r_type['bahan_name']?></option>
                                             <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Harga Beli</label>
                                        <input required type="text" name="i_beli_currency" id="i_beli_currency"
                                          class="form-control number_only" placeholder="Masukkan harga Beli ..." onkeyup="number_currency_(this);"
                                          value="<?= format_rupiah($row->harga_beli) ?>"/>
                                        <input required type="hidden" name="i_beli" id="i_beli" class="form-control" placeholder="Masukkan harga Beli..." value="<?= $row->harga_beli ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Harga Jual</label>
                                        <input required type="text" name="i_jual_currency" id="i_jual_currency"
                                          class="form-control number_only" placeholder="Masukkan harga jual ..." onkeyup="number_currency_(this);"
                                          value="<?= format_rupiah($row->item_price) ?>"/>
                                        <input required type="hidden" name="i_jual" id="i_jual" class="form-control" placeholder="Masukkan harga jual ..." value="<?= $row->item_price?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Harga Reseller</label>
                                        <input required type="text" name="i_reseller_currency" id="i_reseller_currency"
                                          class="form-control number_only" placeholder="Masukkan harga reseller ..." onkeyup="number_currency_(this);"
                                          value="<?= format_rupiah($row->harga_reseller) ?>"/>
                                        <input required type="hidden" name="i_reseller" id="i_reseller" class="form-control" placeholder="Masukkan harga reseller ..." value="<?= $row->harga_reseller?>"/>
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
   
   function number_currency_(elem){
        var elem_id = '#'+elem.id;
        var elem_val    = $(elem_id).val();
        var elem_no_cur = elem_id.replace(/_currency/g,'');

        var str = elem_val.toString(), parts = false, output = [], i = 1, formatted = null;

        parts = str.split(".");
        var gabung = '';
        for (var i = 0; i < parts.length; i++) {
          var gabung = gabung+parts[i];
        }

        str = gabung.split("").reverse();
        var i = 1;
        for(var j = 0, len = gabung.length; j < len; j++) {
          if(str[j] != ".") {
            output.push(str[j]);
            if(i%3 == 0 && j < (len - 1)) {
              output.push(".");
            }
            i++;
          }
        }

        formatted = output.reverse().join("");
        $(elem_id).val(formatted);
        $(elem_no_cur).val(gabung);
      }

 </script>
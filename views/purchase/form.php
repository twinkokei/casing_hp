<script type="text/javascript">
      function grand_total()
      {
        
        var harga = parseFloat(document.getElementById("i_harga").value);
        var qty = parseFloat(document.getElementById("i_qty").value);
        
          
        var total = harga * qty;
        
        
        
        document.getElementById("i_total").value = total;
        
      }

       </script>
<!-- Content Header (Page header) -->
        

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
                                    
                                    
                                        <div class="col-md-12">
                                        
                                        <div class="form-group">
                                          <div class="row">
                                            <div class="col-md-11">
                                              <label>Tanggal</label>
                                              <div class="input-group">   
                                                  <div class="input-group-addon">
                                                      <i class="fa fa-calendar"></i>
                                                  </div>
                                                  <input type="text" required class="form-control pull-right" id="date_picker1" name="i_date" value="<?= $row->purchase_date ?>"/>
                                              </div><!-- /.input group -->
                                            </div>
                                          </div>  
                                       </div>
            
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-9">
                                                  <label>Nama Barang</label>
                                                     <select id="i_item_id" name="i_item_id" size="1" class="selectpicker show-tick form-control"
                                                        data-live-search="true">
                                                        <option value="0"></option>
                                                        <?php
                                                          while($r_item = mysql_fetch_array($query_item)){ ?>
                                                         <option <?php if($row->item_id == $r_item['item_id']){ ?> selected="selected"<?php } ?> value="<?= $r_item['item_id'] ?>"><?= $r_item['item_name']?></option>
                                                         <?php } ?>
                                                </select> 
                                                </div>
                                                <div class="col-md-3">
                                                    <button style="margin-top: 23px;" data-toggle="modal" data-target="#modal_item" class="btn btn-info">
                                                    <span class="glyphicon glyphicon-plus"></span>Tambah Item
                                                    </button>
                                                </div>
                                            </div>  
                                        </div>    
                                        <div class="form-group">
                                          <div class="row">
                                              <div class="col-md-11">
                                                <label>Harga</label>
                                                <input required type="number" name="i_harga_currency" id="i_harga_currency"
                                                  class="form-control number_only" placeholder="Masukkan harga ..." onkeyup="number_currency(this);"
                                                  value="<?= format_rupiah($row->purchase_price) ?>"/>
                                                <input required type="hidden" name="i_harga" id="i_harga" class="form-control" placeholder="Masukkan harga harga ..." value="<?= $row->purchase_price ?>"/>
                      
                                              </div>
                                          </div>   
                                        </div>
                                        <div class="form-group">
                                          <div class="row">
                                            <div class="col-md-11">
                                              <label>QTY</label>
                                              <input required type="number" name="i_qty" id="i_qty" class="form-control" placeholder="Masukkan jumlah..." value="<?= $row->purchase_qty ?>" onChange="grand_total()" min="0"/>
                                            </div>
                                          </div>
                                        </div>
                                        
                                        <div class="form-group">
                                          <div class="row">
                                            <div class="col-md-11">
                                              <label>Total Harga</label>
                                              <input required type="text" readonly name="i_total" id="i_total" class="form-control"  value="<?= $row->purchase_total ?>"/>
                                            </div>
                                          </div>  
                                        </div>
                                      
                                        <div class="form-group">
                                          <div class="row">
                                              <div class="col-md-11">
                                                <label>Supplier</label>
                                                 <select id="basic" name="i_supplier" size="1" class="selectpicker show-tick form-control" data-live-search="true" />
                                                 <?php
                                                 while($r_supplier = mysql_fetch_array($query_supplier)){ ?>
                                                   <option value="<?= $r_supplier['supplier_id'] ?>" <?php if($row->supplier_id == $r_supplier['supplier_id']){ ?> selected="selected"<?php } ?>><?= $r_supplier['supplier_name']?></option>
                                                   <?php } ?>
                                                 </select>   
                                              </div>    
                                          </div>                             
                                      </div>
                            
                                      <div class="form-group">
                                        <div class="row">
                                           <div class="col-md-11">
                                              <label>Cabang</label>
                                              <select id="basic" name="i_branch_id" size="1" class="selectpicker show-tick form-control" data-live-search="true" />
                                             <?php
                                             while($r_branch = mysql_fetch_array($query_branch)){ ?>
                                               <option value="<?= $r_branch['branch_id'] ?>" <?php if($row->branch_id == $r_branch['branch_id']){ ?> selected="selected"<?php } ?>><?= $r_branch['branch_name']?></option>
                                               <?php } ?>
                                             </select> 
                                          </div>
                                        </div>                                           
                                      </div>
                                        
                                        
                                        </div>
                                       
                                        <div style="clear:both;"></div>
                                     
                                </div><!-- /.box-body -->
                                
                                  <div class="box-footer">
                                  <?php if(!$id){ ?>
                                <input class="btn btn-warning" type="submit" value="Save"/>
                                <?php } ?>
                                <a href="<?= $close_button?>" class="btn btn-danger" >Close</a>
                             
                             </div>
                            
                            </div><!-- /.box -->
                       </form>
                        </div><!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->

<!-- modal input stock -->
<div id="modal_item" class="modal fade" name="medium_modal">
  <form action="purchase.php?page=save_add_item" method="post">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" style="color: #fff;" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Tambah Item</h4>
        </div>
        <div class="modal-body">
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
              while($r_merk = mysql_fetch_array($query_merk)){
               ?>
               <option value="<?= $r_merk['merk_id']?>"><?= $r_merk['merk_name']?>
               </option>
               <?}?>
              </select>
          </div>
           <div class="form-group">
            <label>Jenis Bahan</label>
              <select id="i_bahan" name="i_bahan" size="1" class="selectpicker show-tick form-control"
              data-live-search="true">
              <option value="0"></option>
              <?php
              while($r_bahan = mysql_fetch_array($query_bahan)){
               ?>
               <option value="<?= $r_bahan['bahan_id']?>"><?= $r_bahan['bahan_name']?>
               </option>
               <?}?>
              </select>
          </div>
          <div class="form-group">
              <label>Harga Beli</label>
              <input required type="number" name="i_beli_currency" id="i_beli_currency"
                class="form-control number_only" placeholder="Masukkan Beli ..." onkeyup="number_currency(this);"
                value="<?= format_rupiah($row->harga_beli) ?>"/>
              <input required type="hidden" name="i_beli" id="i_beli" class="form-control" placeholder="Masukkan harga Beli ..." value="<?= $row->harga_beli ?>"/>
          </div>
          <div class="form-group">
              <label>Harga Jual</label>
              <input required type="number" name="i_jual_currency" id="i_jual_currency"
                class="form-control number_only" placeholder="Masukkan harga Jual ..." onkeyup="number_currency(this);"
                value="<?= format_rupiah($row->item_price) ?>"/>
              <input required type="hidden" name="i_jual" id="i_jual" class="form-control" placeholder="Masukkan harga harga Jual ..." value="<?= $row->item_price ?>"/>
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <input type="submit" class="btn btn-primary" value="Simpan">
          </div>
        </div>
      </div>
    </div>
  </form>
</div>

 <script type="text/javascript">

    function number_currency(elem){
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
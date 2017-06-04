
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
                                       
            
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input required type="text" name="i_name" class="form-control" placeholder="Masukkan nama barang..." value="<?= $row->item_name ?>"/>
                                        </div>
                                        <div class="form-group">
                                          <label>Merk</label>
                                            <select id="i_merk_id" name="i_merk_id" size="1" class="selectpicker show-tick form-control"
                                            data-live-search="true">
                                            <option value="0"></option>
                                            <?php
                                                  while($r_merk = mysql_fetch_array($query_merk)){ ?>
                                                 <option <?php if($row->item_merk == $r_merk['merk_id']){ ?> selected="selected"<?php } ?> value="<?= $r_merk['merk_id'] ?>"><?= $r_merk['merk_name']?></option>
                                                 <?php } ?>
                                            </select>
                                        </div>
                                      <div class="form-group">
                                            <label>Limit</label>
                                            <input min="0" required type="number" name="i_item_limit" class="form-control" placeholder="Masukkan limit stok..." value="<?= $row->item_limit ?>"/>
                                        </div>
                                       
                                        
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
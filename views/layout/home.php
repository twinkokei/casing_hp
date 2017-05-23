<script src="../assets/highcharts.js"></script>
<script src="../assets/exporting.js"></script>

  <?php
  if(isset($_GET['did']) && $_GET['did'] == 1){
  ?>
  <section class="content_new">
    <div class="alert alert-info alert-dismissable">
      <i class="fa fa-check"></i>
      <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
      <b>Sukses !</b>
      Simpan Berhasil
    </div>
  </section>
  <?php
  }else if(isset($_GET['did']) && $_GET['did'] == 2){
  ?>
  <section class="content_new">
    <div class="alert alert-info alert-dismissable">
      <i class="fa fa-check"></i>
      <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
      <b>Sukses !</b>
      Edit Berhasil
    </div>
  </section>
  <?php
  }else if(isset($_GET['did']) && $_GET['did'] == 3){ ?>
  <section class="content_new">
    <div class="alert alert-info alert-dismissable">
      <i class="fa fa-check"></i>
      <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
      <b>Sukses !</b>
      Delete Berhasil
    </div>
  </section>
  <?php } ?>
  <!-- Main content -->
<!-- <link rel="stylesheet" type="text/css" href="../assets/ea/code/css/highcharts.css" /> -->
<!-- <script src="../assets/ea/code/js/highcharts-3d.js"></script>
<script src="../assets/ea/code/js/modules/exporting.js"></script> -->
  <section class="content">
    <div id="container" style="height: 400px; width: : 310px"></div>
    <div class="row hide-on-mobile320">
          <div class="col-md-6">
              <form role="form" action="<?= $action?>" method="post">
                <div class="box">
                  <div class="box-body2 table-responsive">
                    <div class="box-header">
                        <h3 class="box-title">Top Item</h3>
                    </div>
                    <div class="box-body">
                        	<div class="col-md-6">
                              <div class="form-group">
                                <div class="form-group">
                                  <div class="input-group">
                                      <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" required class="form-control pull-left" id="reservation" name="i_date" value="<?= $date_default?>"/>
                                  </div><!-- /.input group -->
                                </div><!-- /.form group -->
                              </div>
                          </div><!-- /.form group -->
                         <div class="col-md-3">
                            <div class="form-group">
                              <div class="input-group">
                                  <input class="btn btn-danger" type="submit" value="Preview"/>
                              </div><!-- /.input group -->
                            </div><!-- /.form group -->
                          </div>
                          <!-- <div class="body-box2 table-responsive"> -->
                            <table id="example3" class="table table-bordered table-striped">
                                  <thead>
                                      <tr>
                                      <th width="5%">No</th>
                                          <th>Nama Item</th>
                                          <th>Qty</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                     $no = 1;
                                      while($row_top = mysql_fetch_array($query_top)){ ?>
                                        <tr <?php if($no == 1){ ?> class="top_food_tr"<?php } ?>>
                                        <td><?php if($no == 1){ ?><div class="top_food"><?= $no ?></div><?php }else{ ?><?= $no ?><?php } ?></td>
                                        <td><?= $row_top['item_name']?></td>
                                        <td><?= $row_top['jumlah']?></td>
                                        </tr>
                                      <?php $no++; } ?>
                                  </tbody>
                                  <tfoot>
                                  </tfoot>
                              </table>
                          <!-- </div>     -->

                  </div><!-- /.box-body -->
                </div>
              </div><!-- /.box -->
            </form>
          </div>
  <!-- stok limit -->
          <div class="col-md-6">
             <div class="box">
                <div class="box-header">
                      <h3 class="box-title">Crisis Raw Inventory Stock</h3>
                </div>
                <div class="box-body2 table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                            	<th>Item</th>
                            	<th>Stok</th>
                              <th>Cabang</th>
                            </tr>
                        </thead>
                        <?php
		                      while($row_stock_limit = mysql_fetch_array($query_stock_limit)){ ?>
                            <tr>
                              <td><?= ($row_stock_limit['item_name']); ?></td>
                              <td><?= $row_stock_limit['item_stock_qty']."(".$row_stock_limit['unit_name'].")"?></td>
                              <td><?= $row_stock_limit['branch_name']?></td>
                            </tr>
                            <?php } ?>
                    </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
          </div>
      </div>
  </section><!-- /.content -->
  <script type="text/javascript">
  var series_chart = [];
  $(document).ready(function(){
    var utc_date = [];
    var normal_date = [];
    var date   = [];
    var date_1 = [];
    var date_2 = [];
    var date_3 = [];
    var date_utc1 = [];
    var date_utc2 = '';
    var aa_date = '';
    var pembelian = [];
    var penjualan = [];
    var date_parse_to_hc_pembelian = [];
    var date_parse_to_hc_penjualan = [];
    var data_hc = '';
    var date_parse_to_hc_pembelian_ = [];
    var date_parse_to_hc_penjualan_ = [];
    var pembelian_ = '';
    function get_val_chart()
    {
      $.ajax({
        dataType  : "json",
        data      : "get",
        url       : "home.php?page=Highcharts",
        success   : function(data){
          $.each(data, function(index, value){
            pembelian = value.journal_credit;
            penjualan = value.journal_debit;
            aa_date   = value.journal_date;
            date      = aa_date.split("-");
            date_parse_to_hc_pembelian = [Date.UTC(date[0], date[1], date[2]), parseInt(pembelian)];
            date_parse_to_hc_pembelian_.push(date_parse_to_hc_pembelian);
            date_parse_to_hc_penjualan = [Date.UTC(date[0], date[1], date[2]), parseInt(penjualan)];
            date_parse_to_hc_penjualan_.push(date_parse_to_hc_penjualan);
          });
          Highcharts_(date_parse_to_hc_pembelian_, date_parse_to_hc_penjualan_);
        }
      });
    }
    get_val_chart();
  function Highcharts_(pembelian, penjualan)
  {
    Highcharts.chart('container', {
        chart: {
            type: 'spline'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: 'Grafik Penjualan dan Pembelian'
        },
        xAxis: {
            type: 'datetime',
            dateTimeLabelFormats: { // don't display the dummy year
                month: '%e. %b',
                year: '%b'
            },
            title: {
                text: 'Date'
            }
        },
        yAxis: {
            title: {
                text: ''
            },
            min: 0
        },
        tooltip: {
            headerFormat: '<b>{series.name}</b><br>',
            pointFormat: '{point.x:%e. %b}: {point.y:.2f} m'
        },
        plotOptions: {
            spline: {
                marker: {
                    enabled: true
                }
            }
        },
        series: [{
            name: 'Pembelian',
            data: pembelian
        }, {
            name: 'Penjualan',
            data: penjualan
        }]
        // series:[]
      });
  }
    // console.log(series_chart);
  });
  </script>

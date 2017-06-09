<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body2 table-responsive">
      <div class="box-header" style="cursor: move;">
      <h3 class="box-title"><strong>List Pembelian</strong></h3>
      </div>
        <table id="pembelian_tb" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th>Tanggal</th>
              <th>Total</th>
              <th>Config</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $no_tr = 1;
          while($rpembelian = mysql_fetch_array($qpembelian)){ ?>
            <tr>
              <td><?= $no_tr?></td>
              <td><?= $rpembelian['purchase_date']?></td>
              <td><?= tool_format_number($rpembelian['purchase_total'])?></td>
              <td style="text-align:center;">
                <a href="javascript:void(0)" onclick="confirm_delete(<?= $rpembelian['purchase_id']; ?>,
                  'report_detail.php?page=deletereport&type=2&date=<?= $_GET['date']?>&branch_id=<?php echo $rpembelian['branch_id']?>&id=')"
                  class="btn btn-default" >
                  <i class="fa fa-trash-o"></i>
                </a>
              </td>
            </tr>
          <?php
          $no_tr++; } ?>
          </tbody>
        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>
<script type="text/javascript">
  $(function(){
    $("#pembelian_tb").dataTable({
    dom: 'Bfrtip',
    buttons: [

        {
            extend: 'pageLength'
        },
        {
            extend: 'copy'
        },
        {
          text: 'Excel',
          action: function () {
            window.location.assign('print.php?page=excelreport&date=<?= $i_date?>');
          }
        },
        {
            extend: 'pdf'
        },
        {
            extend: 'print',
            title : 'Penjualan Bakmi Gili'
        }
    ],
    lengthMenu: [
        [ 10, 25, 50, -1 ],
        [ '10 rows', '25 rows', '50 rows', 'Show all' ]
    ]
  });
});
</script>

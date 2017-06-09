
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body2 table-responsive">
        <div class="box-header" style="cursor: move;">
          <h3 class="box-title"><strong>Detail Stock Perbulan</strong></h3>
        </div>
        <table id="list_item_month" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th>Nama Type HP</th>
              <th>Bulan</th>
              <th>Stock Awal</th>
              <th>Stock Akhir</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $no_item = 1;
          $grand_total_dasar = 0;
          $grand_total_omset = 0;
          while($row_itemmonth = mysql_fetch_array($qitemmonth)){?>
            <tr>
              <td><?php echo $no_item ?></td>
              <td><?php echo $row_itemmonth['item_name']; ?></td>
              <td><?php echo $row_itemmonth['item_price']; ?></td>
              <td><?php echo $row_itemmonth['historystock_date']; ?></td>
              <td><?php echo tool_format_number($row_itemmonth['stock_awal'])?></td>
              <td><?php echo tool_format_number($row_itemmonth['stock_akhir'])?></td>
            </tr>
          <?php
          $no_item++; } ?>
          </tbody>
        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>
<script type="text/javascript">
  $(function(){
    $("#list_item_month").dataTable({
    dom: 'Bfrtip',
    buttons: [

        {
            extend: 'pageLength'
        },
        {
            extend: 'copy'
        },
        {
            extend: 'excel'
        },
        {
            extend: 'pdf'
        },
        {
            extend: 'print',
            title  : 'Bakmi Gili Item Details',
            footer: 'trur'
        }
    ],
    lengthMenu: [
        [ 10, 25, 50, -1 ],
        [ '10 rows', '25 rows', '50 rows', 'Show all' ]
    ]
  });
});
</script>

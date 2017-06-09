
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body2 table-responsive">
        <div class="box-header" style="cursor: move;">
          <h3 class="box-title"><strong>Detail Stock Perhari</strong></h3>
        </div>
        <table id="list_item_day" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th width="5%">No</th>
              <th>Nama Type HP</th>
              <th>Tanggal</th>
              <th>Stock Masuk</th>
              <th>Stock Keluar</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $no_item = 1;
          $grand_total_dasar = 0;
          $grand_total_omset = 0;
          while($row_itemday = mysql_fetch_array($qitemday)){?>
            <tr>
              <td><?php echo $no_item ?></td>
              <td><?php echo $row_itemday['item_name']; ?></td>
              <td><?php echo $row_itemday['historystock_date']; ?></td>
              <td><?php echo tool_format_number($row_itemday['stock_masuk'])?></td>
              <td><?php echo tool_format_number($row_itemday['stock_keluar'])?></td>
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
    $("#list_item_day").dataTable({
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

<form id="formpembayaran" method="post" enctype="multipart/form-data" role="form" id="form_bayar">
	<div class="modal-header">
	  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	  <h4 class="modal-title" align="center">PEMBAYARAN</h4>
	</div>
	<div class="modal-body">
	  	<div class="form-group">
	  		<label>Total</label>
	  		<input type="text" name="total_" id="total_"	class="form-control" readonly value="<?= format_rupiah($total_all)?>" />
	  		<input type="hidden" name="total" id="total"	class="form-control" readonly value="<?= $total_all?>" />
	  	</div>
	  	<div class="form-group">
	  		<label>Metode Pembayaran</label>
	        <select id="payment_method" name="payment_method" size="1" class="selectpicker show-tick form-control" onChange="pembayaran()">
	            <?php
	            while($r_byr = mysql_fetch_array($query_payment_method)){?>
	            <option value="<?= $r_byr['payment_method_id'] ?>"><?= $r_byr['payment_method_name']?></option>
	            <?}?>
	        </select>
	  	</div>
	  	<div id="form_debit_kredit" class="form-group">

	  	</div>
	  	<div class="form-group">
	  		<label>Bayar</label>
	  		<input type="text" name="jml_bayar_currency" id="jml_bayar_currency" class="form-control" placeholder="Masukan Jumlah Bayar..." onkeyup="number_currency_(this);hitung_kembalian();" />
	  		<input type="hidden" name="jml_bayar" id="jml_bayar"/>
	  	</div>
	  	<div class="form-group">
	  		<label>Kembalian</label>
	  		<input type="text" name="jml_kembalian_" id="jml_kembalian_" class="form-control" readonly min="0" />
	  		<input type="hidden" name="jml_kembalian" id="jml_kembalian"/>
	  	</div>
	 <div class="modal-footer">
		<button type="button" class="btn btn-primary" onclick="btn_bayar()">Bayar</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
	 </div>
	</div>
</form>
<script type="text/javascript">
$(document).ready(function(){
	var storage_item_detail = JSON.parse(localStorage.getItem('item_detail'));
	console.log(storage_item_detail);
});



function btn_bayar(){
	var storage_item_detail = JSON.parse(localStorage.getItem('item_detail'));
	var item_id 	= [];
	var item_qty 	= [];
	var item_price = [];
	var paramArr = $("#formpembayaran").serializeArray();
	var url = "transaction.php?page=simpan_transaksi";

	$.each(storage_item_detail, function(index, value){
		item_id.push(value.item_id);
		item_qty.push(value.item_qty);
		item_price.push(value.item_price);
	});
	var i_date = $('#date_picker1').val();
	var i_member = $('#i_member').val();
	var i_branch_id = $('#i_branch_id').val();

	paramArr.push( {name:'item_id[]', value:item_id },
                 {name:'item_qty[]', value:item_qty },
                 {name:'item_price[]', value:item_price },
								 {name:'i_date', value:i_date },
								 {name:'i_member', value:i_member },
								 {name:'i_branch_id', value:i_branch_id });
	 $.ajax({
            type: "POST",
            url: url,
            data: paramArr, // serializes the form's elements.
						dataType: "JSON",
            success: function(data)
            {
							if (data.status == '200') {
								var url = "print.php?page=printstruk&id="+data.id;
								window.open(url);
								setTimeout(function(){ location.reload();}, 1000);

							} else {
								alert("Error !!");
							}
            }
          });
}

	function hitung_kembalian(){
		var harga = $('#total').val();
        var bayar = $('#jml_bayar').val();



        var kembalian = bayar - harga;


        document.getElementById("jml_kembalian_").value = toRp(kembalian);
        document.getElementById("jml_kembalian").value = kembalian;
	}

	function pembayaran(){
		var byr = $('#payment_method').val();

		if (byr != 1) {
			$('#form_debit_kredit').empty();
			$('#form_debit_kredit').append('<label>Bank</label>\
											<select id="bank" name="bank" size="1" class="selectpicker show-tick form-control">\
                        					<?php
                        					while($r_bank = mysql_fetch_array($query_bank)){?>\
                          					<option value="<?= $r_bank['bank_id'] ?>"><?= $r_bank['bank_name']?>\
                         					</option>\
                        					<?}?>\
                  							</select>\
                    						<div class="form-group">\
                    						<label>No Rek</label>\
						                    <input type="text" name="no_rek" id="no_rek" class="form-control" placeholder="Masukan no rek..."/>\
                    						</div>');

		} else {$('#form_debit_kredit').html(''); }
	}


		$("#form_bayar").submit(function(e) {
			var order_detail = JSON.parse(localStorage.getItem('order_detail'));
			var itemid = [];
			var itemprice = [];
			var itemqty = [];
			var order = [];
			var total_all = $('#total_all').val();
			var member_id = $('#i_member').val();
			var branch_id = $('#i_branch_id').val();
			var date_picker1 = $('#date_picker1').val();

			$.each(storage_item_detail, function(index, value){
					itemid.push(value.item_id);
					itemprice.push(value.item_price);
					itemqty.push(value.item_qty);
			});
			var data = {
				itemid : itemid,
				itemqty: itemqty,
				total_all : total_all,
				member_id : member_id,
				branch_id : branch_id,
				date_picker1:date_picker1
			}
			order.push(data);
			localStorage.setItem('order_detail', JSON.stringify(order));
			console.log(order);

	    e.preventDefault(); // avoid to execute the actual submit of the form.
	});

//     $("#form_bayar").submit(function(e) {

//     var url = "controllers/transaction.php?page=save"; // the script where you handle the form input.

//     $.ajax({
//            type: "POST",
//            url: url,
//            data:{total_all:total_all} , // serializes the form's elements.
//            dataType: 'json',
//            success: function(data)
//            {
//                login_response(data); // show response from the php script.
//            }
//          });

//     e.preventDefault(); // avoid to execute the actual submit of the form.
// });


	function number_currency_(elem){
      var elem_id = '#'+elem.id;
      var elem_val   = $(elem_id).val();
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

<?php
  $total_price = 0;
  $dapid = "";

    $query=mysql_query("select distinct b.dapur_id from widget_tmp a
                      join menus b on b.menu_id = a.menu_id
                      where table_id = '$table_id' order by b.dapur_id");

  while($rowes = mysql_fetch_array($query)){?>
    <?php
    $no_item = 1;
    $querymenu = mysql_query("select a.*, b.menu_name,b.dapur_id, c.* from widget_tmp a
                          join menus b on b.menu_id = a.menu_id
                          join menu_types c on c.menu_type_id = b.menu_type_id
                          where table_id = '$table_id' AND b.dapur_id =".$rowes['dapur_id']);
    ?>
    <script>
      var winPrint = window.open('', '_blank', 'left=0,top=0,width=800,height=600,toolbar=0,scrollbars=0,status=0');
      winPrint.document.writeln('<head>');
      winPrint.document.writeln('<style type="text/css">\
        body{\
        	font-family:"Palatino Linotype", "Book Antiqua", Palatino, serif;\
        }\
        .frame{\
        	border:1px solid #000;\
        	width:10%;\
        	margin-left:auto;\
        	margin-right:auto;\
        	padding:10px;\
        }\
        table{\
        	font-size:14px;\
        	\
        }\
        .header{\
        	text-align:center;\
        	font-weight:bold;\
        	font-size:11px;\
        	\
        }\
        .header_img{\
        \
        	width:164px;\
        	height:79px;\
        	margin-left:auto;\
        	margin-right:auto;\
        	margin-bottom:10px;\
        }\
        .back_to_order{\
        	width:10%;\
        	margin-left:auto;\
        	margin-right:auto;\
        	color:#fff;\
        	font-weight:bold;\
        	background:#09F;\
        	text-align:center;\
        	border-radius:10px;\
        	margin-top:10px;\
        	padding:5px;height:30px;\
        }\
        .back_to_order:hover{\
        	background:#069;\
        }\
      </style>');
      winPrint.document.writeln('</head>');
      winPrint.document.writeln('<body>');
      winPrint.document.writeln('<div class="header">\
  			<span style="font-size:14px;text-align:center;font-weight:bold;">BAKMI GILI EXPRESS<br>PLAZA SURABAYA<br>FOODCOURT LT. 4<br><?php echo $rowes['dapur_id']?></span>\
  		</div>');
      winPrint.document.writeln('<table width="100%" border="0" cellspacing="0" cellpadding="0" >\
  		  <tr>\
  		    <td><?= "Meja : ". $row['table_name']?></td>\
  		    <td align="right"><?= $row['transaction_date'] ?></td>\
  		  </tr>\
  		</table>');
      winPrint.document.writeln("<table width='100%' border='0' cellspacing='0' cellpadding='0' style='padding-top: -10;'>");
      <?php while($rowmenu = mysql_fetch_array($querymenu)){ ?>
        winPrint.document.writeln("<tr>");
        //winPrint.document.writeln("<td><?php echo $no_item?></td>");
        winPrint.document.writeln("<td align='left'> <?php echo $rowmenu['menu_name']?></td>");
        winPrint.document.writeln("<td align='right'><?php echo $rowmenu['jumlah']?></td>");
        winPrint.document.writeln("</tr>");
		winPrint.document.writeln("<tr>");
		winPrint.document.writeln("<td align='left'><?php echo $rowmenu['wt_desc']?></td>");
		winPrint.document.writeln("</tr>");
		winPrint.document.writeln("<tr>");
		winPrint.document.writeln("<td><hr></td>");
		winPrint.document.writeln("</tr>");
      <?php $no_item++; }?>
      winPrint.document.writeln("</table>");
      winPrint.document.write('</body>');
      winPrint.document.close();
      winPrint.focus()
      winPrint.print();
      winPrint.close();
    </script>
  <?php }
?>
<script>
  window.history.back();
</script>

<script>
var winPrint = window.open('', '', 'left=0,top=0,width=800,height=600,toolbar=0,scrollbars=0,status=0');
winPrint.document.write('<title>Print  Report</title><br /><br /> Hellow World1');
winPrint.document.close();
winPrint.focus();
winPrint.print();
winPrint.close();

var winPrint2 = window.open('', '', 'left=0,top=0,width=800,height=600,toolbar=0,scrollbars=0,status=0');
winPrint2.document.write('<title>Print  Report</title><br /><br /> Hellow World2');
winPrint2.document.close();
winPrint2.focus();
winPrint2.print();
winPrint2.close();
</script>

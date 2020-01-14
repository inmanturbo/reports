$(document).ready(function() {
 
    $('#example').DataTable( {
     lengthMenu: [[25,50,75,100,-1], [25,50,75,100,"All"]],
        initComplete: function () {
            this.api().columns([1,2]).every( function () { 
                var column = this;
                //var select = $('<select><option value=""></option></select>')                
                  var select = $('<select style="max-width: 175px;  height: 30px; font-size: 16px; font-family: arial; font-weight: normal; color: #343a40; "><option value="" style="color: #343a40;"></option></select>')

                    .appendTo( $(column.header()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                  //select.append( '<option value="'+d+'">'+d+'</option>' )
                    select.append( '<option placeholder="Search" style="background-color: #F2F2F2; font-size: 16px; font-family: arial; font-weight: normal; color: #343a40;" value="'+d+'">'+d+'</option>' )
                    
                } );
            } );
        }
    } );
} );

function showUser(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  }
  else{
      $.get("reports_fields.php?q="+str, function(data, status){
        document.getElementById("txtHint").innerHTML=data;
      //alert("Data: " + data + "\nStatus: " + status);
    });
    
  }
}


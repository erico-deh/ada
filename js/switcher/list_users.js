/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var oTable = null;

function initDoc(){
    createDataTable();
    initToolTips();
}

function toggleDetails(user_id,imgObj) {
        
//    }
//    $j('.imgDetls').on('click', function () {
    var nTr = $j(imgObj).parents('tr')[0];    
    if ( oTable.fnIsOpen(nTr) )
    {
        /* This row is already open - close it */
        imgObj.src = HTTP_ROOT_DIR+"/layout/"+ADA_TEMPLATE_FAMILY+"/img/details_open.png";
        oTable.fnClose( nTr );
    }
    else
    {
        /* Open this row */
        imgObj.src = HTTP_ROOT_DIR+"/js/include/jquery/ui/images/ui-anim_basic_16x16.gif";
        var imageReference=imgObj;
        $j.when(fnFormatDetails(user_id))
        .done   (function( JSONObj )
       { 
            oTable.fnOpen( nTr, JSONObj.html, 'details' );
            if(JSONObj.status==='OK'){
                $j('.User_table').not('.dataTable').dataTable({
                "bJQueryUI": true,
                'aoColumnDefs': JSONObj.columnDefs,
                "oLanguage": 
                {
                      "sUrl": HTTP_ROOT_DIR + "/js/include/jquery/dataTables/dataTablesLang.php"
                },
                "fnDrawCallback":
                    function () {
                        // put the sort icon outside of the DataTables_sort_wrapper div
                        // for better display styling with CSS
                        $j(this).find("thead th div.DataTables_sort_wrapper").each(function(){
                        sortIcon = $j(this).find('span').clone();
                        $j(this).find('span').remove();
                        $j(this).parents('th').append(sortIcon);
                        });
                   } 
                });
            }
       })
       .fail   (function() { 
            console.log("ajax call has failed"); 
	} )
        .always(function (){
            imageReference.src = HTTP_ROOT_DIR+"/layout/"+ADA_TEMPLATE_FAMILY+"/img/details_close.png";
        });
   
    }
}


function createDataTable() {
    
    oTable = $j('#table_users').dataTable({
        "bJQueryUI": true,
        "bFilter": true,
        "bInfo": true,
        "bSort": true,
        "bAutoWidth": true,
        'aoColumnDefs': [{"aTargets": [ 0 ],"sClass":"expandCol"},{ "bSortable": false, "aTargets": [ 4 ],"sClass":"actionCol" } ],
        "oLanguage": 
        {
            "sUrl": HTTP_ROOT_DIR + "/js/include/jquery/dataTables/dataTablesLang.php"
        }
     
    });
}    
     
  function fnFormatDetails ( idUser )
{
    return $j.ajax({
       type	: 'GET',
       url	: HTTP_ROOT_DIR+ '/switcher/ajax/get_userDetails.php',
       data	: {'id_user': idUser},
       dataType :'json'
       });

}



function  initToolTips()
 {
   $j('.tooltip').tooltip({
        
        show :     {
                effect : "slideDown",
                delay : 300,
                duration : 100
        },
        hide : {
                effect : "slideUp",
                delay : 100,
                duration : 100
        },
        position : {
                my : "center bottom-5",
                at : "center top"
        }

        
    }); 
}


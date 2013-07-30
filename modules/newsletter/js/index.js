function initDoc()
{
	initDataTables();
	initButtons();	
	initToolTips();
}

function newNewsletter() {
	self.document.location.href = 'edit_newsletter.php';
}

/**
 * inits jquery buttons
 */
function initButtons()
{
	/**
	 * new button
	 */
	$j('.newButton').button({
		icons : {
			primary : 'ui-icon-document'
		}
	});
	
	/**
	 * actions button
	 */
	
	$j('.editButton').button({
		icons : {
			primary : 'ui-icon-folder-open'
		},
		text : false
	});
	
	$j('.sendButton').button({
		icons : {
			primary : 'ui-icon-arrowthickstop-1-e'
		},
		text : false
	});
	
	$j('.detailsButton').button({
		icons : {
			primary : 'ui-icon-info'
		},
		text : false
	});
	
	$j('.deleteButton').button({
		icons : {
			primary : 'ui-icon-trash'
		},
		text : false
	});	
}

function initDataTables() {
	var datatable = $j('#newsletterHistory').dataTable( {
		 		"bJQueryUI": true,
                "bFilter": true,
                "bInfo": false,
                "bSort": true,
                "bAutoWidth": true,
                "bPaginate" : false,
                'aoColumns': [
                              // first empty column generated by ADA HTML engine, let's hide it
                                { "bSearchable": false,
                                  "bVisible":    false },
                                null,
                                { "sType": "date-eu" },                                           
                                null,
                                { "bSearchable" : false, "bSortable" : false, "sWidth" : "15%"}
                            ]
	}).show();
}

function initToolTips() {
	// inizializzo i tooltip sul title di ogni elemento!
	$j('.tooltip').tooltip(
			{
				show : {
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
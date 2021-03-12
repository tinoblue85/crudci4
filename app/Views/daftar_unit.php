            <style>
            table{
                font-size:12px;
            }
            </style>

            <table id="list2" style="width:100%;"></table>
            <div id="pager2"></div>
			
	    

            <script>
     
				
				var lastsel2;
                    $("#list2").jqGrid({
                        url: 'unit/json_unit',mtype: "POST",
                        datatype: "json",shrinkToFit: false, gridComplete: function()
						{
						 $('#list2').jqGrid('setGridWidth', '600'); // max width for grid
						},
                        colNames: [	'ID', 'NAMA UNIT'],
                        colModel: [
						 

							 {
                                name: 'id_unit',
                                index: 'id_unit', editable: false,
                                align: "center",
								width:"100"
                            },
                            {
                                name: 'nama_unit',
                                index: 'nama_unit',editable:true, editrules: { required: true },editoptions:{size:50},
								width:"500"
                            }
                        ],onSelectRow: function(id){
							if(id && id!==lastsel2){
								$('#list2').jqGrid('restoreRow',lastsel2);
								
								lastsel2=id;
							}
						},editurl: "unit/edit"	, height:'auto',
                        rowNum: 20,
                        rowList: [10, 20, 30],
                        pager: '#pager2',
                        sortname: 'id_unit',
                        viewrecords: true,
                        sortorder: "asc",
                        caption: "Data UNIT"
                    });
                    $("#list2").jqGrid('navGrid', '#pager2', {
                        edit: true,
                        add: true,
                        del: true						
                    },{
                                afterSubmit: function(data){
                                    alert(data.responseText);
                                    
									$('.ui-icon-refresh').trigger('click');
									$(".ui-icon-closethick").trigger('click');
                                }
								});

                </script>
         
        </div>
    </div>
</div>

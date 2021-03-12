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
                        url: 'jabatan/json_jabatan',mtype: "POST",
                        datatype: "json",shrinkToFit: false, gridComplete: function()
						{
						 $('#list2').jqGrid('setGridWidth', '600'); // max width for grid
						},
                        colNames: [	'ID', 'NAMA JABATAN'],
                        colModel: [

							 {
                                name: 'id_jabatan',
                                index: 'id_jabatan', editable: false,
                                align: "center",
								width:"100"
                            },
                            {
                                name: 'nama_jabatan',
                                index: 'nama_jabatan',editable:true, editrules: { required: true },editoptions:{size:50},
								width:"500"
                            }
                        ],onSelectRow: function(id){
							if(id && id!==lastsel2){
								$('#list2').jqGrid('restoreRow',lastsel2);
								
								lastsel2=id;
							}
						},editurl: "jabatan/edit"	, height:'auto',
                        rowNum: 20,
                        rowList: [10, 20, 30],
                        pager: '#pager2',
                        sortname: 'id_jabatan',
                        viewrecords: true,
                        sortorder: "asc",
                        caption: "Data JABATAN"
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
								}).navButtonAdd('#pager2',{
					   caption:"XLS", 
					   buttonicon:"ui-icon-circle-triangle-s", 
					   onClickButton: function(){ 
						window.location.href ="export/jabatan";
					   }, 
					   position:"last"
					});

                </script>
         
        </div>
    </div>
</div>

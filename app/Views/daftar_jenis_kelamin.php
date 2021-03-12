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
                        url: 'jenis_kelamin/json_jenis_kelamin',mtype: "POST",
                        datatype: "json",shrinkToFit: false, gridComplete: function()
						{
						 $('#list2').jqGrid('setGridWidth', '600'); // max width for grid
						},
                        colNames: [	'ID', 'NAMA JENIS KELAMIN'],
                        colModel: [
						 

							 {
                                name: 'id_jenis_kelamin',
                                index: 'id_jenis_kelamin', editable: false,
                                align: "center",
								width:"100"
                            },
                            {
                                name: 'nama_jenis_kelamin',
                                index: 'nama_jenis_kelamin',editable:true, editrules: { required: true },editoptions:{size:50},
								width:"500"
                            }
                        ],onSelectRow: function(id){
							if(id && id!==lastsel2){
								$('#list2').jqGrid('restoreRow',lastsel2);
								
								lastsel2=id;
							}
						},editurl: "jenis_kelamin/edit"	, height:'auto',
                        rowNum: 20,
                        rowList: [10, 20, 30],
                        pager: '#pager2',
                        sortname: 'id_jenis_kelamin',
                        viewrecords: true,
                        sortorder: "asc",
                        caption: "Data JENIS KELAMIN"
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
						window.location.href ="export/jenis_kelamin";
					   }, 
					   position:"last"
					});
             
				
			
				
                </script>
         
        </div>
    </div>
</div>

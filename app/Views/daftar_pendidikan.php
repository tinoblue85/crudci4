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
                        url: 'pendidikan/json_pendidikan',mtype: "POST",
                        datatype: "json",shrinkToFit: false,
                        colNames: [	'ID', 'NAMA PENDIDIKAN'],
                        colModel: [
						 

							 {
                                name: 'id_pendidikan',
                                index: 'id_pendidikan', editable: false,
                                align: "center",
								width:"100"
                            },
                            {
                                name: 'nama_pendidikan',
                                index: 'nama_pendidikan',editable:true, editrules: { required: true },editoptions:{size:50},
								width:"500"
                            }
                        ],onSelectRow: function(id){
							if(id && id!==lastsel2){
								$('#list2').jqGrid('restoreRow',lastsel2);
								
								lastsel2=id;
							}
						},editurl: "pendidikan/edit"	, height:'auto',
                        rowNum: 20,
                        rowList: [10, 20, 30],
                        pager: '#pager2',
                        sortname: 'id_pendidikan',
                        viewrecords: true,
                        sortorder: "asc",
                        caption: "Data PENDIDIKAN"
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

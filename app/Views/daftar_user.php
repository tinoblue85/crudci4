            <style>
            table{
                font-size:12px;
            }
            </style>

            <table id="list2" style="width:100%;"></table>
            <div id="pager2"></div>
			
	    <div class="modal fade" id="USERModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">TAMBAH USER</h5>
                  
                </div>
                <div class="modal-body">
					<table>
						<tr>
							<td>Nama</td>
							<td><input type="text" class="form-control"></td>
						</tr>
					</table>
				</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?=base_url()?>/logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

            <script>
     
				
				var lastsel2;
                    $("#list2").jqGrid({
                        url: 'user/json_user',editurl: "user/edit",mtype: "POST",
                        datatype: "json",shrinkToFit: false,
                        colNames: [	'Perusahaan', 'Username','Password','Level'],
                        colModel: [
						 

							 {
                                name: 'id_unit',
                                index: 'id_unit', editable: true,edittype:"select",editoptions:{value:"<?=$cboUnit?>",dataInit : function (elem) {
										$(elem).attr('required',true);
								}},
                                align: "left",
								width:"240"
                            },
                            {
                                name: 'username',
                                index: 'username',editable:true, editrules: { required: true },editoptions:{size:50}
                            }, {
                                name: 'password',
                                index: 'password',
                                align: "left",editable:true, editrules: { required: true },editoptions:{size:50}
                            },
                            {
                                name: 'id_level',
                                index: 'jenis_kelamin', editable: true,edittype:"select",editoptions:{value:"<?=$cboLevel?>",dataInit : function (elem) {
										$(elem).attr('required',true);
								}},
                                align: "left"
                            }
                        ],onSelectRow: function(id){
							if(id && id!==lastsel2){
								$('#list2').jqGrid('restoreRow',lastsel2);
								
								lastsel2=id;
							}
						},editurl: "user/edit"	, height:'auto',
                        rowNum: 20,
                        rowList: [10, 20, 30],
                        pager: '#pager2',
                        sortname: 'id_user',
                        viewrecords: true,
                        sortorder: "asc",
                        caption: "Data User"
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
						window.location.href ="export/user";
					   }, 
					   position:"last"
					});
             
				
			
				
                </script>
         
        </div>
    </div>
</div>

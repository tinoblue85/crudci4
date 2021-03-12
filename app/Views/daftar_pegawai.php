            <style>
            table{
                font-size:12px;
            }
            </style>

            <table id="list2" style="width:100%;"></table>
            <div id="pager2"></div>
			
	    <div class="modal fade" id="pegawaiModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">TAMBAH PEGAWAI</h5>
                  
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
                        url: 'home/json_pegawai',editurl: "home/json_pegawai",mtype: "POST",
                        datatype: "json",shrinkToFit: false, gridComplete: function()
						{
						 $('#list2').jqGrid('setGridWidth', '1024'); // max width for grid
						},
                        colNames: [	'Perusahaan', 'Nama','KTP','NPWP', 'Jenis Kelamin','Alamat','Tempat Lahir','Tgl Lahir','Usia','Tgl Mulai Kerja','Jabatan','Pendidikan','Status','BPJS TK','BPJS Kesehatan'],
                        colModel: [
						 

							{
                                name: 'nama_unit',
                                index: 'nama_unit'
                            },
                            {
                                name: 'nama',
                                index: 'nama',editable:true, editrules: { required: true },editoptions:{size:50}
                            }, {
                                name: 'ktp',
                                index: 'ktp',
                                align: "center",editable:true, editrules: { required: true },editoptions:{size:50}
                            },{
                                name: 'npwp',
                                index: 'npwp',
                                align: "center",editable:true, editrules: { required: true },editoptions:{size:50}
                            },
                            {
                                name: 'id_jenis_kelamin',
                                index: 'jenis_kelamin', editable: true,edittype:"select",editoptions:{value:"<?=$cboJenisKelamin?>",dataInit : function (elem) {
										$(elem).attr('required',true);
								}},
                                align: "center"
                            },{
                                name: 'alamat',
                                index: 'alamat',
                                align: "center",editable:true, editrules: { required: true },editoptions:{size:50}
                            },{
                                name: 'tempat_lahir',
                                index: 'tempat_lahir',
                                align: "center",editable:true, editrules: { required: true },editoptions:{size:50}
                            },{
                                name: 'tgl_lahir',
                                index: 'tgl_lahir', classes:'tanggal',
                                align: "center",editable:true, editrules: { required: true },editoptions:{size:50,dataInit : function (elem) {
									$(elem).datepicker({dateFormat:"yy-mm-dd"});
									
									
									}}
                            },{
                                name: 'usia',
                                index: 'usia',
                                align: "center"
                            },{
                                name: 'tgl_mulai_kerja', classes:'tanggal',
                                index: 'tgl_mulai_kerja',
                                align: "center",editable:true, editrules: { required: true },editoptions:{size:50,dataInit : function (elem) {
									$(elem).datepicker({dateFormat:"yy-mm-dd"});
									} }
                            },
                            {
                                name: 'id_jabatan',
                                index: 'nama_jabatan', editable: true,edittype:"select",editoptions:{value:"<?=$cboJabatan?>"},
                                align: "center"
                            },
                            {
                                name: 'id_pendidikan',
                                index: 'nama_pendidikan', editable: true,edittype:"select",editoptions:{value:"<?=$cboPendidikan?>"},
                                align: "center"
                            },
                            {
                                name: 'id_status',
                                index: 'status', editable: true,edittype:"select",editoptions:{value:"<?=$cboStatus?>"},
                                align: "center"
                            },
                            {
                                name: 'flag_bpjs_tk',
                                index: 'flag_bpjs_tk', editable: true,edittype:"select",editoptions:{value:"1:Aktif;0:Tidak Aktif"},
                                align: "center"
                            },
                            {
                                name: 'flag_bpjs_kes',
                                index: 'flag_bpjs_kes', editable: true,edittype:"select",editoptions:{value:"1:Aktif;0:Tidak Aktif"},
                                align: "center"
                            }
                        ],onSelectRow: function(id){
							if(id && id!==lastsel2){
								$('#list2').jqGrid('restoreRow',lastsel2);
								$('#list2').jqGrid('editRow',id,true,pickdates);
								lastsel2=id;
							}
						},editurl: "home/edit"	,
                        rowNum: 4,
                        rowList: [10, 20, 30],
                        pager: '#pager2',
                        sortname: 'id_data_karyawan',
                        viewrecords: true,
                        sortorder: "asc",
                        caption: "Data Karyawan"
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
						window.location.href ="export/unit";
					   }, 
					   position:"last"
					});

                </script>
         
        </div>
    </div>
</div>

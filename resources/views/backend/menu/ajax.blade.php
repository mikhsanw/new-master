$(document).on("click",".submit-tambah",function() {
		var url			= "{{ url($url_admin.'/menu') }}";
		var dataString	= $('#frmOji').serializeArray();
		letAjax(url, dataString);
});

$( ".submit-ubah" ).click(function() {
		var url			= "{{ url($url_admin.'/menu') }}/"+$("#id").val();
		var dataString	= $('#frmOji').serializeArray();
		letAjax(url, dataString);
});

$( ".submit-hapus" ).click(function() {
		var url					= "{{ url($url_admin.'/menu') }}/"+$("#id").val();
		var dataString	= $('#frmOji').serializeArray();
		letAjax(url, dataString);
});

function letAjax(targetUrl, dataString, methodType = 'POST'){
		$.ajax({
			type: methodType,
			url: targetUrl,
			data: dataString,
			enctype: 'multipart/form-data',
			dataType: 'json',
			cache: false,
			beforeSend: function(){
					sebelumKirim();
			},
			success: function(data){
                    loadMenu();
					successMsg(data);
			},
			error: function(x, e){
				//	errorMsg(x.status);
			}
		});
}


$("#nama").keyup(function() {
		$("#kode").val( this.value.replace(/\s/g, "").toLowerCase() );
		$("#link").val(this.value.replace(/\s/g, "").toLowerCase() );
});

$("#nama").change(function(){
		$(this).closest('.form-group').removeClass('has-error');
});

$("#kode").change(function(){
		$(this).closest('.form-group').removeClass('has-error');
});

$("#link").change(function(){
		$(this).closest('.form-group').removeClass('has-error');
});

$(document).ready(function(){
   $('.tambah').click(function(){
		if({{Auth::user()->level}}==3 && "{{$kode}}" === "halaman"){
			return Swal.fire({
					title: 'Cancelled',
					text: 'Anda tidak memiliki akses untuk ini',
					type: 'error'
				});
		}
		ojisatrianiLoadingFadeIn();
		$.loadmodal({
			url: "{{ url($url_admin.'/'.$kode.'/create') }}",
			id: 'responsive',
			dlgClass: 'fade',
			bgClass: 'primary',
			title: 'Tambah',
			width: 'whatever',
			modal: {
				keyboard: true,
				// any other options from the regular $().modal call (see Bootstrap docs)
				},
          ajax: {
				dataType: 'html',
				method: 'GET',
				success: function(data, status, xhr){
            		ojisatrianiLoadingFadeOut();
            	},

			},
        });
  });

  $(document).on("click",".ubah",function() {
	if({{Auth::user()->level}}==3 && "{{$kode}}" === "halaman"){
			return Swal.fire({
					title: 'Cancelled',
					text: 'Anda tidak memiliki akses untuk ini',
					type: 'error'
				});
		}
    ojisatrianiLoadingFadeIn();
        var id = $(this).attr("{{$kode.'-id'}}");
		$.loadmodal({
			url: "{{ url($url_admin.'/'.$kode) }}/"+ id +"/edit",
      id: 'responsive',
			dlgClass: 'fade',
			bgClass: 'warning',
			title: 'Ubah',
			width: 'whatever',
			modal: {
				keyboard: true,
				// any other options from the regular $().modal call (see Bootstrap docs)
				},
          ajax: {
				dataType: 'html',
				method: 'GET',
				success: function(data, status, xhr){
                    ojisatrianiLoadingFadeOut();
				},
			},
        });
	});

  	$(document).on("click",".hapus",function() {
		if({{Auth::user()->level}}==3 && "{{$kode}}" === "halaman"){
			return Swal.fire({
					title: 'Cancelled',
					text: 'Anda tidak memiliki akses untuk ini',
					type: 'error'
				});
		}
		ojisatrianiLoadingFadeIn();
        var id = $(this).attr("{{$kode.'-id'}}");
		$.loadmodal({
			url: "{{ url($url_admin.'/'.$kode) }}/hapus/"+ id,
      id: 'responsive',
			dlgClass: 'fade',
			bgClass: 'danger',
			title: 'Hapus',
			width: 'whatever',
			modal: {
				keyboard: true,
				// any other options from the regular $().modal call (see Bootstrap docs)
				//$('#uraian').val(id),
				},
          ajax: {
				dataType: 'html',
				method: 'GET',
				success: function(data, status, xhr){
                    ojisatrianiLoadingFadeOut();
				},
			},
        });
	});

  	$(document).on("click",".detail",function() {
		ojisatrianiLoadingFadeIn();
        var id = $(this).attr("{{$kode.'-id'}}");
		$.loadmodal({
			url: "{{ url($url_admin.'/'.$kode) }}/"+ id,
            id: 'responsive',
			dlgClass: 'fade',
			bgClass: 'danger',
			title: 'Detail',
			width: 'whatever',
			modal: {
				keyboard: true,
				// any other options from the regular $().modal call (see Bootstrap docs)
				//$('#uraian').val(id),
				},
          ajax: {
				dataType: 'html',
				method: 'GET',
				success: function(data, status, xhr){
                    $('.submit-detail').hide();
                    ojisatrianiLoadingFadeOut();
				},
			},
        });
	});

});

$(document).on("click",".logo",function() {
    ojisatrianiLoadingFadeIn();
    var id = $(this).attr("{{$kode.'-id'}}");
    $.loadmodal({
        url: "{{ url($url_admin.'/'.$kode) }}/logo/"+ id,
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
                $('.modal-footer').remove();
                ojisatrianiLoadingFadeOut();
            },
        },
    });
});

$(document).on("click",".favicon",function() {
    ojisatrianiLoadingFadeIn();
    var id = $(this).attr("{{$kode.'-id'}}");
    $.loadmodal({
        url: "{{ url($url_admin.'/'.$kode) }}/favicon/"+ id,
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
                $('.modal-footer').remove();
                ojisatrianiLoadingFadeOut();
            },
        },
    });
});
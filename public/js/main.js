$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});

$(document).ready(function() {
    $('#btn_pet_adopt').on('click',function(event) {
        var self = $(this),dom_parser,html = '';

        html = $('#div_pet_adopt').html();
        html = $.parseHTML($.trim(html));

        console.log(html);
        console.log(html[0]);
        console.log(html[0].innerHTML);
        swal({
            html:true,
            title:'Informações para contato!',
            type: 'info',
            text:html[0].innerHTML});
    });
});

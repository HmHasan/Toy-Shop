
$('#update_form').submit(function (e){
    e.preventDefault();
    let form = $(this);
    let data = $('#update_form').serializeArray();
    let test = new FormData;
    jQuery.each()
    let url = $(this).data('route');
   $.ajax({
       type:'POST',
       url:url,
       cache: false,
       contentType: false,
       processData: false,
       data:new FormData(this),
       success:function (data) {
           window.location.href = "http://nasir.test/product/";
       }
   })

})
//Delete Done
// $('#delete_form').submit(function (e){
//     e.preventDefault();
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//     let route = $(this).data('route');
//     $.ajax({
//         type:'DELETE',
//         url:route,
//         dataType:'JSON',
//         success:function (data) {
//             window.location.href = "http://nasir.test/product/";
//         }
//     })
//
// })

// Modal Open

$('.addAttr').click(function() {
    let id = $(this).data('id');
    $('#id').val(id);
} );


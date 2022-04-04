
//success and error message timeout code
setTimeout(function(){
  $('.alert-success').slideUp(1000);
},3000);

setTimeout(function(){
  $('.alert-danger').slideUp(1000);
},10000);
//success and error message timeout code

//datatable code starts
$(document).ready( function () {
    $('#myTable').DataTable({
      "paging": true,
      "searching": true,
      "lenthChange": true,
      "ordering": false,
      "info": true,
      "autoWidth": false
    });
});
//datatable code ends

//modal code ends
$(document).ready(function(){
  $(document).on("click", "#softDelete", function(){
    var softDeleteId = $(this).data('id');
    $(".modal_body #modal_id").val(softDeleteId);
   });
   $(document).on("click", "#restore", function(){
     var restoreId = $(this).data('id');
     $(".modal_body #modal_ids").val(restoreId);
    });
   $(document).on("click", "#delete", function(){
     var deleteId = $(this).data('id');
     $(".modal_body #modal_id").val(deleteId);
    });
  });
  //modal code ends

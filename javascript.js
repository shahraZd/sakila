$(document).ready(function () {
    //Pagination numbers
    $('#paginationNumbers').DataTable({
      "pagingType": "numbers"
    });
  });

  function confirmation() {
     confirm("Are you sure you want to delete this entry?");
  }
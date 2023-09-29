$(document).ready(function () {
  $('#myTable').DataTable({
      // "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
      "scrollX": true,
      "language": {
          "search": "",
          "searchPlaceholder": "Search...",
          "decimal": ",",
          "thousands": ".",
      },
  });

  $('.dataTables_filter input[type="search"]').css({
      "marginBottom": "10px"
  });

  $('#myTable2').DataTable({
    // "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
    "scrollX": true,
    "language": {
        "search": "",
        "searchPlaceholder": "Search...",
        "decimal": ",",
        "thousands": ".",
    },
});
});

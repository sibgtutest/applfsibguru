$(document).ready(function(){
    $("#myInput1").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myList1 li").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
    $("#myInput2").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myList2 li").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
    $("#myInput3").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#myList3 li").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });    
  });
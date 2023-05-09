$(document).ready(function () {

    $(document).on('click','.delete_product_btn', function(e){
        e.preventDefault();
        
        var id = $(this).val();

        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                type: "POST",
                url: "code.php",
                data: {
                    'product_id':id,
                    'delete_product_btn': true
                },
                success: function(response){
                    if(response == 200){
                        swal("Success!", "Deleted successfully!", "success");
                        $("#products_table").load(location.href + " #products_table");
                    }
                    else if(response == 500){
                        swal("Error!", "Something went wrong!", "error");
                    }
                }
              });
            }
          });

    })

    $(document).on('click','.delete_category_btn', function(e){
      e.preventDefault();
      
      var id = $(this).val();

      swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover.",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              type: "POST",
              url: "code.php",
              data: {
                  'category_id':id,
                  'delete_category_btn': true
              },
              success: function(response){
                  if(response == 200){
                      swal("Success!", "Deleted successfully!", "success");
                      $("#category_table").load(location.href + " #category_table");
                  }
                  else if(response == 500){
                      swal("Error!", "Something went wrong!", "error");
                  }
              }
            });
          }
        });

  })

    $(document).on('click','.delete_inventory_btn', function(e){
      e.preventDefault();
      
      var id = $(this).val();

      swal({
          title: "Are you sure?",
          text: "Once deleted, you will not be able to recover.",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              type: "POST",
              url: "code.php",
              data: {
                  'id':id,
                  'delete_inventory_btn': true
              },
              success: function(response){
                  if(response == 200){
                      swal("Success!", "Deleted successfully!", "success");
                      $("#inventory_table").load(location.href + " #inventory_table");
                  }
                  else if(response == 500){
                      swal("Error!", "Something went wrong!", "error");
                  }
              }
            });
          }
        });

  })

  $(document).on('click','.delete_faqs_btn', function(e){
    e.preventDefault();
    
    var id = $(this).val();

    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            type: "POST",
            url: "code.php",
            data: {
                'id':id,
                'delete_faqs_btn': true
            },
            success: function(response){
                if(response == 200){
                    swal("Success!", "Deleted successfully!", "success");
                    $("#faqs_table").load(location.href + " #faqs_table");
                }
                else if(response == 500){
                    swal("Error!", "Something went wrong!", "error");
                }
            }
          });
        }
      });

  })

  $(document).on('click','.delete_address_btn', function(e){
    e.preventDefault();
    
    var id = $(this).val();

    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            type: "POST",
            url: "code.php",
            data: {
                'id':id,
                'delete_address_btn': true
            },
            success: function(response){
                if(response == 200){
                    swal("Success!", "Deleted successfully!", "success");
                    $("#address_table").load(location.href + " #address_table");
                }
                else if(response == 500){
                    swal("Error!", "Something went wrong!", "error");
                }
            }
          });
        }
      });

  })
  
  $dateCond = '';
if (!empty($_GET['date1']) && !empty($_GET['date2'])) {
$dateCond = "DATE(date) >= '{$_GET['date1']}' AND DATE(date) <= '{$_GET['date2']}'";
}

});
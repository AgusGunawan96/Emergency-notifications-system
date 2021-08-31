function validatecn()
    {
        var chks = document.getElementsByName('mark[]');
            var hasChecked = false;
                for (var i = 0; i < chks.length; i++) {
                    if (chks[i].checked)
                        {
                    hasChecked = true;
                break;
            }
        }
            if (hasChecked == false)
                {
                    swal({
                        title: "Please select at least one!",
                        buttonsStyling: false,
                        type: 'error',
                        confirmButtonClass: "btn btn-danger"
                    }).catch(swal.noop)
                return false;
            }
        return true;
    }

function confirms(func)
    {
        swal({
            title: "Confirmation",
            text: "Are you sure?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Confirm",
            cancelButtonText: "Cancel",
            showLoaderOnConfirm: true,
            allowOutsideClick: false,
            focusCancel: true
        }).then(function (eval) {
            if (eval.value) {
                swal({
                    title: 'Success!', 
                    text: 'Sms Sent!', 
                    type: 'success', 
                    confirmButtonText: 'Close', 
                    allowEscapeKey: false
                  });

                  try {
                    document.getElementById("pelajaran").submit();
                  }
                  catch(err) {
                    document.getElementById("nEmployeeID").submit();
                  }
            }
                if (eval.dismiss) {
            ///eval case esc|cancel
                    }
                return false;
            });
        return false;
    }



function validatecs()
    {
        var chks = document.getElementsByName('nEmployeeID[]');
            var hasChecked = false;
                for (var i = 0; i < chks.length; i++) {
                    if (chks[i].checked) {
                            hasChecked = true;
                                break;
                            }
                        }
                    if (hasChecked == false)
                {
                    swal({
                        title: "Please select at least one!",
                        buttonsStyling: false,
                        type: 'error',
                        confirmButtonClass: "btn btn-danger"
                    }).catch(swal.noop)
                return false;
            }
        return true;
    }

    $(document).ready(function(){
    $(".open_modal_cn").on("click",function(){
        var chks = document.getElementsByName('mark[]');
            var hasChecked = false;
                for (var i = 0; i < chks.length; i++) {
                    if (chks[i].checked) {
                        hasChecked = true;
    $("#exampleModal").modal("show");
        document.getElementById('disaster').required = true;
            document.getElementById("pelajaran").onsubmit = function(){
                return confirms();
            }
        break;
                }
                    }
                if (hasChecked == false)
                {
             validatecn();
                return false;
                    }
                        return true;
                                });
}); 

$(document).ready(function(){
    $(".open_modal_cs").on("click",function(){
       var chks = document.getElementsByName('nEmployeeID[]');
       var hasChecked = false;
       for (var i = 0; i < chks.length; i++)
       {
           if (chks[i].checked)
           {
           hasChecked = true;
           $("#exampleModal").modal("show");
           document.getElementById('disaster').required = true;
           document.getElementById("nEmployeeID").onsubmit = function(){
               return confirms();
           }
           break;
           }
       }
       if (hasChecked == false)
           {
            validatecs();
            return false;
           }
       return true;
    });
}); 

$(document).ready(function(){
     $(".close_modal").on("click",function(){
        $("#exampleModal").modal("hide");
        document.getElementById('disaster').required = false;
     });
}); 


function onReady(callback) {
    var intervalID = window.setInterval(checkReady, 1000);

    function checkReady() {
        if (document.getElementsByTagName('body')[0] !== undefined) {
            window.clearInterval(intervalID);
            callback.call(this);
        }
    }
}

function show(id, value) {
    document.getElementById(id).style.display = value ? 'block' : 'none';
}
onReady(function () {
    show('page', true);
    show('loading', false);
});

function check()
        {
var check=document.getElementsByName('nEmployeeID[]');
for(var i=0;i<check.length;i++)
    {
if(check[i].type=='checkbox')
{
check[i].checked=true;
        }
    }
}

    function uncheck()
        {
    var uncheck=document.getElementsByName('nEmployeeID[]');
    for(var i=0;i<uncheck.length;i++)
    {
    if(uncheck[i].type=='checkbox')
    {
    uncheck[i].checked=false;
        }
    }
}

//initial checkCount of zero
var checkCount = 0
//maximum number of allowed checked boxes
    var maxChecks = 2

    function setChecks(obj) {
    //increment/decrement checkCount
    if (obj.checked) {
        checkCount = checkCount + 1
    } else {
        checkCount = checkCount - 1
    }
    //if they checked a 4th box, uncheck the box, then decrement checkcount and pop alert
    if (checkCount > maxChecks) {
        obj.checked = false
        checkCount = checkCount - 1
        alert('you may only choose up to ' + maxChecks + ' options')
    }
}



$(document).ready(function() {
    $('#datatables').DataTable({
      "pagingType": "full_numbers",
      "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "All"]
      ],
      responsive: true,
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Search records",
      }
    });

    var table = $('#datatable').DataTable();

    // Edit record
    table.on('click', '.edit', function() {
      $tr = $(this).closest('tr');
      var data = table.row($tr).data();
      alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
        });

    // Delete a record
    table.on('click', '.remove', function(e) {
      $tr = $(this).closest('tr');
      table.row($tr).remove().draw();
      e.preventDefault();
        });

    //Like record
    table.on('click', '.like', function() {
      alert('You clicked on Like button');
    });

    
});
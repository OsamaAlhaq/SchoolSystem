$(document).ready(function(){
    
    //close the dialog popup from the start
    $(function() {    
        
    $("#dialog").dialog({ 
        autoOpen: false 
    });
        
    var value = null;
    var key;
    //Select the table row when clicked on
    $("#Table tr").click(function(){
        if ($(this).hasClass('selected')) {
            $(this).removeClass('selected'); 
            value = null;
        } else {
            $(this).addClass('selected').siblings().removeClass('selected');  
            //value is the row index
            value = $(this).closest('tr').index() + 1;
            key = $(this).find('td:first').html();
            
        }

    });
    
    //when delete key is clicked on
    $(".delete").click(function(){
        //remove the row at index(highlighted)
        if (value) {
            $("tr").eq(value).remove();
            // pass the key to php to delete
            $.ajax(
                {
                    url: "students.php",
                    type: "POST",
                    
                    data: { ind: key},
                    success: function (result) {

                }
            });
        }
        value = null;
    });        
    
    //when the add key is clicked on
    $(".add").click(function(){
        $('#type').val('insert')
        //on click open the dialog
        $("#dialog").dialog({
        modal: true,
        resizable: false,
        draggable:false,
        title: 'title',
        //position: [500,40],
        });    
        $("#dialog").dialog("open");

    });
    
    $(".ui-dialog-titlebar-close").click(function(){
        $(this).dialog("close");
    });
     

        //when the add key is clicked on
    $(".edit").click(function(){
        if (value != null) {
            //set the values
            $('#type').val('update')
            //on click open the dialog
            $("#dialog").dialog({
            modal: true,
            resizable: false,
            draggable:false,
            title: 'title',
            //position: [500,40],
            });    
            $("#dialog").dialog("open");
        }
    });
    
        
    });
});


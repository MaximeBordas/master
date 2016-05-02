$(document).ready(function {    
   $("#popadd").dialog({
    autoOpen: false,
    modal: true,
    title: "un titre",
    height: 150,
    width: 300,
    });

    $("bouton_add").click(function() {
        $('#popadd').dialog('open');
    }); 
}); 
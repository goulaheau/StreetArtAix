$("#participer").on("click", function(){
    var id = parseInt($(this).val(), 10);
    if($(this).is(":checked")) {
        // checkbox is checked -> do something
    } else {
        // checkbox is not checked -> do something different
    }
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "inscription_evenement.php",
        data: "function=loadContent&id=" + id,
        success: function(json) {
            // success function is called when data came back
            // for example: get your content and display it on your site
        }
    });
});

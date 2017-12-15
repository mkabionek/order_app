$("#accept-btn").on("click", function(){
    var id = $("#order-id").val();
    
    $("#accept-btn").fadeOut(800, function(){
        $("#accept-btn").remove();
    });
    
    var request = $.ajax({
        url: "accept.php",
        method: "POST",
        data: { 
            id : id
        }
      });
       
      request.done(function( msg ) {
          console.log(msg)
        if(msg === "OK"){
           
        }
      });
       
    //   request.fail(function( jqXHR, textStatus ) {
    //     alert( "Request failed: " + textStatus );
    //   });
});


$('#show-mods').on("click", () => {
    $("#mod-div").toggleClass('hidden');
});
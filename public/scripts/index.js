$(document).ready(function(){
    var user_bio;
    var backgroundImage = $("#background-image-file").val();

    // When click "add bio", change the display; 
    $(".adding-bio").click(function(){
        $("#bio").css('display', 'block');
        $(".adding-bio").css('display', 'none');
    });

    // When click Okay button to submit bio
    $("#okay-bio").click(function(){
        user_bio = $("#bio-value").val();
        test_localstore("user_bio", user_bio);
        $("#bio").css('display', 'none');
        $(".bio-intro").css('display', 'none');
        $(".bio").prepend("<p>"+ user_bio +"</p>");
    });

    // $("#post-form button").click(function(){
    //     var postVal = $("#post-value").val();
    //     var now = new Date();
    //     var strDateTime = "Date: "+ now.getFullYear() + " \/ " + Number(now.getMonth() + 1)  + " \/ " + Number(now.getDate() + 1) + "<br> Time: " + Number(now.getHours() + 1) + " : " + Number(now.getMinutes() + 1) ;    
    //     $(".event").prepend(`<div class="post"><div class="thing">
    //     <h3> 
    //         User
    //     </h3>
    //     <h6>${strDateTime}</h6><p>${postVal}</p></div></div>`);
    //     $("#post-value").val("");
    // });

    $('#background-image-file').change(function () {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onloadend = function () {
            $('.background-image').css('background-image', 'url("' + reader.result + '")');
        }
        if (file) {
            reader.readAsDataURL(file);
        } else {
        }
    });
});

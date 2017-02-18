$().ready(function () {
    $("#button").click(tchat);
    setInterval("upUser();", 1000);
    $("#tchat").scrollTop(100000000);

//    if ($("#button").keypress()){
//        $("#button").keypress(tchat);
//    }

});
$(window).load(function () {
});
var tchat = function (e) {
//    var t = $("window").keypress();
//    alert(t);
    e.preventDefault();
//    var l;
    var message = $("#message").val();
//        alert(message);
    $.ajax({
        url: "./envoie",
        data: {"message": message},
        type: 'POST',
        dataType: 'json',
        async: true,
        success: function (data, textStatus, jqXHR) {
            my_function();
//                $("#tchat").append("<p>" + data + "</p>");
//                alert(data);
//                    $('#tchat').append("<p>" + data[1].pseudo + " - " + data[1].date + "</p><p>"+data[1].post+"</p>");
//                    alert(data.length);
//            var last = data.length - 1;
            $("#message").val("");
//                for (var i = 0; i < data.length; i++) {
//                    $('#tchat').append("<p>" + data[i].user + " - " + data[i].message + "</p>");
//            $('#tchat').append("<p> De : " + data[last].pseudo + " à " + data[last].date + "</p><p>" + data[last].post + "</p>");
            $("#tchat").scrollTop(100000000);
//                }
        }
    });
};

function my_function() {
    window.location = location.href;
}
function upUser(){
    $.ajax({
        url: "/updateUser",
        type: 'POST'
    });
}
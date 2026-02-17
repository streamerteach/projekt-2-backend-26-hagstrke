function countdown(time) {
    var diff = time;

    var x = setInterval(function () {
        diff--;

        var d = Math.floor(diff / (60 * 60 * 24));
        var h = Math.floor(diff % (60 * 60 * 24) / (60 * 60));
        var m = Math.floor(diff % (60 * 60) / 60);
        var s = diff % 60;
        
        document.getElementById("timer").innerHTML =
        "Which is in " + d + " day(s) " + h + " hour(s) " + m + " minute(s) " + s + " second(s)";

        if (diff < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "Which is today!";
        }
    }, 1000);
}
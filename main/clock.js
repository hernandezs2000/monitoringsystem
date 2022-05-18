function realtimeClock() {
var rtClock = new Date();
var hours = rtClock.getHours();
var minutes = rtClock.getMinutes();
var seconds = rtClock.getSeconds();

//Add AM and PM system
var amPm = ( hours < 12) ? "AM" : "PM";

//Convert the hrs component to 12 hrs format
hours = (hours > 12) ? hours - 12 : hours;

// Pad the hours, minutes, and seconds with leading zeros
hours = ("0" + hours).slice(-2);
minutes = ("0" + minutes).slice(-2);
seconds = ("0" + seconds).slice(-2);

//Display the clock
document.getElementById('clock').innerHTML = hours + ":" + minutes + ":" + seconds + " " + amPm;
var t = setTimeout(realtimeClock, 500);
}



function updateClock(){
    var now = new Date();
    var dname = now.getDay();
    var mo = now.getMonth();
    var dnum = now.getDate();
    var yr = now.getFullYear();

    var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
    var week = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
    var ids = ["dayname","month","daynum","year"];
    var values = [week[dname], months[mo], dnum, yr];
    
    for(var i=0; i < ids.length; i++)
    document.getElementById(ids[i]).firstChild.nodeValue = values[i];
}
function initClock(){
    updateClock();
    window.setInterval("updateClock()", 1);
}
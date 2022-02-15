/*Covenant T. Elijah*/
window.onload=function(){

    var tens=00;
    var seconds=00;
    var minutes=00;
    var hours=00;
    var days=00;

    var appendTens=document.getElementById("tens");
    var appendSeconds=document.getElementById("seconds");
    var appendMinutes=document.getElementById("minutes");
    var appendHours=document.getElementById("hours");
    var appendDays=document.getElementById('days');
    var buttonStart=this.document.getElementById("active-mic");
    var buttonStop=this.document.getElementById("active-stop");
    //var buttonReset=this.document.getElementById("button-reset");

    var Interval;

               
    function startTimer(){
        tens++;
       
        if(tens<9){
            appendTens.innerHTML="0" + tens;
        }
        if(tens>9){
            appendTens.innerHTML=tens;
        }
        if(tens>99){
            seconds++;
            appendSeconds.innerHTML="0" + seconds;
            tens=0;
            appendTens.innerHTML="0" + tens;
        }
        if(seconds>9){
            appendSeconds.innerHTML=seconds;
        }
        if(seconds>59){
            minutes++;
            appendMinutes.innerHTML="0"+minutes;
            seconds=0;
            appendSeconds.innerHTML="0"+seconds;
        }
        if(minutes>9){
            appendMinutes.innerHTML=minutes;
        }
        if(minutes>59){
            hours++;
            appendHours.innerHTML="0"+hours;
            minutes=0;
            appendMinutes.innerHTML="0"+minutes;
        }
        if(hours>9){
            appendHours.innerHTML=hours;
        }
        if(hours>24){
            days++;
            appendDays.innerHTML="0"+days;
            hours=0;
            appendHours.innerHTML="0"+hours;
        }
    }
    buttonStart.onclick=function(){
        clearInterval(Interval);
        Interval=setInterval(startTimer, 10);
    }
    buttonStop.onclick=function(){
        clearInterval(Interval);
        tens="00";
        seconds="00";
        minutes="00";
        hours="00";
        days="00"
        appendTens.innerHTML=tens;
        appendSeconds.innerHTML=seconds;
        appendMinutes.innerHTML=minutes;
        appendHours.innerHTML=hours;
        appendHours.innerHTML=days;
    }
    /*buttonReset.onclick=function(){
        clearInterval(Interval);
        tens="00";
        seconds="00";
        minutes="00";
        hours="00";
        days="00"
        appendTens.innerHTML=tens;
        appendSeconds.innerHTML=seconds;
        appendMinutes.innerHTML=minutes;
        appendHours.innerHTML=hours;
        appendHours.innerHTML=days;
    }
    */
}
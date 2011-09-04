
var daysElement    = null;
var hoursElement   = null;
var minutesElement = null;
var secondsElement = null;

timerId = setInterval("updateTimer(timerId)",1000);

function getContainer(){
    daysElement    = $('days');
    hoursElement   = $('hours');
    minutesElement = $('minutes');
    secondsElement = $('seconds');
}

function updateTimer(timerId) {

    var now = new Date();
    var difference = end - now;

    if (difference < 0){
        if (null != daysElement)
            daysElement.update("0");

        if (null != hoursElement)
            hoursElement.update("0");

        if (null != minutesElement)
            minutesElement.update("0");

        if (null != secondsElement)
            secondsElement.update("0");

        clearInterval(timerId);
        exit();
    }

    days = Math.floor(difference / 86400000);
    difference = difference % 86400000;
    hours = Math.floor(difference / 3600000);
    difference = difference % 3600000;
    minutes = Math.floor(difference / 60000);
    difference = difference % 60000;
    seconds = Math.floor(difference / 1000);
    difference = difference % 1000;
    msecs = difference;

    if (null != daysElement)
        daysElement.update(days);

    if (null != hoursElement)
        hoursElement.update(getDoubleDigits(hours));

    if (null != minutesElement)
        minutesElement.update(getDoubleDigits(minutes));

    if (null != secondsElement)
        secondsElement.update(getDoubleDigits(seconds));
}

function getDoubleDigits(x){
    if (x < 10){
        return "0" + x;
    } else {
        return x;
    }
}
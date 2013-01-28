/**
 *
 *  Copyright since 2011 Matthias Balke (magento@balke-technologies.de)
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing, software
 *  distributed under the License is distributed on an "AS IS" BASIS,
 *  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  See the License for the specific language governing permissions and
 *  limitations under the License.
 */
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
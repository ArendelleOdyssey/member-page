<?php $title = "Time Converter";
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/module.init.php') ?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div id="timezone">Loading your timezone</div>
            <div id="time"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12" id="textdefault">
            <p>By default we use <strong>GMT (London time)</strong> for Arendelle Odyssey.</p>
            <p>Below you can find the current time in GMT.</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div id="timeGMT"></div>
        </div>
    </div>
</div>

<script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
<script src="https://momentjs.com/downloads/moment-timezone-with-data.min.js"></script>

<script>
    setInterval(() => {

        var tz = moment.tz.guess();
        document.getElementById('timezone').innerText = "Your timezone is: " + tz

        // Time
        var hours = moment().hours() < 10 ? '0'+moment().hours() : moment().hours()
        var minutes = moment().minutes() < 10 ? '0'+moment().minutes() : moment().minutes()
        var seconds = moment().seconds() < 10 ? '0'+moment().seconds() : moment().seconds()
        document.getElementById('time').innerText = hours + ":" + minutes + ":" + seconds

        // Time GMT
        var hoursGMT = moment().tz('GMT').hours() < 10 ? '0'+moment().tz('GMT').hours() : moment().tz('GMT').hours()
        var minutesGMT = moment().tz('GMT').minutes() < 10 ? '0'+moment().tz('GMT').minutes() : moment().tz('GMT').minutes()
        var secondsGMT = moment().tz('GMT').seconds() < 10 ? '0'+moment().tz('GMT').seconds() : moment().tz('GMT').seconds()
        document.getElementById('timeGMT').innerText = hoursGMT + ":" + minutesGMT + ":" + secondsGMT
    }, 100);
</script>

<style>
#timezone{
    font-size:large;
    margin-top:2em;
}
#time, #timeGMT{
    font-size:xxx-large;
    font-family: ice-kingdom;
    margin-bottom: 2em;
    margin-top:1em;
}
#textdefault{
    font-size:medium;
}
</style>

<?php require_once($_SERVER['DOCUMENT_ROOT'].'/includes/footer.php') ?>
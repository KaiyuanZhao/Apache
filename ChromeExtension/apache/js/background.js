/*
 Displays a notification with the current time. Requires "notifications"
 permission in the manifest file (or calling
 "Notification.requestPermission" beforehand).
 */
function show(content) {
    var time = /(..)(:..)/.exec(new Date());     // The prettyprinted time.
    var hour = time[1] % 12 || 12;               // The prettyprinted hour.
    var period = time[1] < 12 ? 'a.m.' : 'p.m.'; // The period of the day.
    new Notification(hour + time[2] + ' ' + period, {
        icon: '48.png',
        body: content
    });
}

// Conditionally initialize the options.
if (!localStorage.isInitialized) {
    localStorage.isActivated = true;   // The display activation.
    localStorage.isInitialized = true; // The option initialization.
}

// Test for notification support.
if (window.Notification) {
    // While activated, show notifications at the display frequency.
    if (JSON.parse(localStorage.isActivated)) {
        var beginTime = new Date();
        beginTime.setHours(15);
        beginTime.setMinutes(0);
        beginTime.setSeconds(0);
        var endTime = new Date();
        endTime.setHours(17);
        endTime.setMinutes(0);
        endTime.setSeconds(0);
        var now = new Date();
        if (now - beginTime >= 0 && endTime - now > 0)
            show('现在是点餐时间呦，要不要点餐呢？');
    }

    var today = new Date();
    setInterval(function () {
        if (JSON.parse(localStorage.isActivated)) {
            var beginTime = new Date();
            beginTime.setHours(15);
            beginTime.setMinutes(0);
            beginTime.setSeconds(0);
            var endTime = new Date();
            endTime.setHours(16);
            endTime.setMinutes(45);
            endTime.setSeconds(0);
            var now = new Date();
            if (now - beginTime >= 0 && now - beginTime <= 60000)
                show('加班餐订餐开始啦');
            else if (now - endTime >= 0 && now - endTime <= 60000)
                show('加班餐预定要结束了，你定了吗？');
        }
    }, 60000);
}

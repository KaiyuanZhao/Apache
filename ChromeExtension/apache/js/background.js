// Copyright (c) 2011 The Chromium Authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

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
  if (JSON.parse(localStorage.isActivated)) { show('欢迎使用百姓网订餐插件'); }

  var today = new Date();
  setInterval(function() {
    if (JSON.parse(localStorage.isActivated)) {
      var beginTime=new Date();
      beginTime.setHours(15);
      beginTime.setMinutes(0);
      beginTime.setSeconds(0);
      var endTime=new Date();
      endTime.setHours(16);
      endTime.setMinutes(45);
      endTime.setSeconds(0);
      var now = new Date();
      if (now - beginTime >= 0 && now - beginTime <= 60000)
        show('加班餐订餐开始啦');
      else if (now - endTime >= 0 && now - endTime <= 60000)
        show('加班餐预定要结束了，确定不定吗？');
    }
  }, 60000);
}

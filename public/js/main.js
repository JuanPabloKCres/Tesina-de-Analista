app.on('browser-window-created', function (event, window) {
    window.webContents.on('new-window', function(event, url, frameName, disposition, options) {
        console.log("new-window:"+url);
        var url = require('url').parse(url);
        if(url.protocol !== 'http:' && url.protocol !== 'https:' || url.hostname !== 'www.example.com') {
            event.defaultPrevented = true;
            console.log("Invalid URL:"+url);
        }
    });
    console.log("browser-window-created");
})
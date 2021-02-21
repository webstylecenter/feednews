const Ziggy = {"url":"http:\/\/feednews.test","port":null,"defaults":{},"routes":{"debugbar.openhandler":{"uri":"_debugbar\/open","methods":["GET","HEAD"]},"debugbar.clockwork":{"uri":"_debugbar\/clockwork\/{id}","methods":["GET","HEAD"]},"debugbar.telescope":{"uri":"_debugbar\/telescope\/{id}","methods":["GET","HEAD"]},"debugbar.assets.css":{"uri":"_debugbar\/assets\/stylesheets","methods":["GET","HEAD"]},"debugbar.assets.js":{"uri":"_debugbar\/assets\/javascript","methods":["GET","HEAD"]},"debugbar.cache.delete":{"uri":"_debugbar\/cache\/{key}\/{tags?}","methods":["DELETE"]},"checklist.index":{"uri":"checklist","methods":["GET","HEAD"]},"checklist.add":{"uri":"checklist\/add","methods":["POST"]},"checklist.update":{"uri":"checklist\/update","methods":["POST"]},"feedback.index":{"uri":"feedback","methods":["GET","HEAD"]},"feed.add":{"uri":"feed\/add","methods":["POST"],"bindings":{"feedItem":"id","userFeedItem":"id","meta":"id"}},"feed.metadata":{"uri":"feed\/get-meta-data","methods":["POST"]},"feed.pin":{"uri":"feed\/pin","methods":["POST"]},"feed.load.more":{"uri":"feed\/load-more\/{page}","methods":["GET","HEAD"]},"feed.search":{"uri":"feed\/search","methods":["GET","HEAD"]},"feed.overview":{"uri":"feed\/overview","methods":["GET","HEAD"]},"feed.check.x.frame.header":{"uri":"feed\/check-x-frame-header","methods":["POST"]},"feed.popup.opened":{"uri":"feed\/popup-has-been-opened","methods":["GET","HEAD"]},"feed.opened.items":{"uri":"feed\/opened-items","methods":["GET","HEAD"]},"feed.set.opened.item":{"uri":"feed\/set-opened-item","methods":["POST"]},"feed.create":{"uri":"feed\/create-feed-item","methods":["POST"]},"feed.chrome.import":{"uri":"feed\/chrome-import\/{email?}","methods":["POST"],"bindings":{"feedItem":"id","userFeedItem":"id","user":"id"}},"feed.open.shared.item":{"uri":"share\/{feedName}\/{id}","methods":["GET","HEAD"]},"homepage.privacy.policy":{"uri":"privacy-policy","methods":["GET","HEAD"]},"homepage.index":{"uri":"\/","methods":["GET","HEAD"],"bindings":{"weather":"id"}},"homepage.offline":{"uri":"offline","methods":["GET","HEAD"]},"notes.save":{"uri":"notes\/save","methods":["POST"],"bindings":{"note":"id"}},"notes.remove":{"uri":"notes\/remove","methods":["POST"]},"screensaver.index":{"uri":"screensaver","methods":["GET","HEAD"]},"screensaver.background.image":{"uri":"screensaver\/background-image","methods":["GET","HEAD"]},"settings.index":{"uri":"settings","methods":["GET","HEAD"]},"settings.add":{"uri":"settings\/add","methods":["POST"]},"settings.follow":{"uri":"settings\/follow","methods":["POST"]},"settings.update":{"uri":"settings\/update","methods":["POST"]},"settings.remove":{"uri":"settings\/remove","methods":["POST"]},"settings.disable.x.frame.notice":{"uri":"settings\/disable-x-frame-notice","methods":["GET","HEAD"]},"settings.validate.url":{"uri":"settings\/validate-url","methods":["POST"]},"settings.create.user.feed":{"uri":"settings\/create-user-feed","methods":["POST"]},"login":{"uri":"login","methods":["GET","HEAD"]},"authenticate":{"uri":"login","methods":["POST"]},"logout":{"uri":"logout","methods":["GET","HEAD"]},"register":{"uri":"register","methods":["GET","HEAD"]},"register.submit":{"uri":"register\/submit","methods":["POST"]},"oauth.redirect":{"uri":"auth\/redirect","methods":["GET","HEAD"]},"oauth.callback":{"uri":"auth\/callback","methods":["GET","HEAD"]},"oauth.facebook.redirect":{"uri":"auth\/facebook\/redirect","methods":["GET","HEAD"]},"oauth.facebook.callback":{"uri":"auth\/facebook\/callback","methods":["GET","HEAD"]},"oauth.facebook.remove":{"uri":"auth\/facebook\/remove","methods":["GET","HEAD"]},"welcome.index":{"uri":"welcome","methods":["GET","HEAD"]},"weather.detail":{"uri":"weather\/details","methods":["GET","HEAD"],"bindings":{"weather":"id"}},"weather.icon":{"uri":"weather\/icon","methods":["GET","HEAD"],"bindings":{"weather":"id"}}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    for (let name in window.Ziggy.routes) {
        Ziggy.routes[name] = window.Ziggy.routes[name];
    }
}

export { Ziggy };

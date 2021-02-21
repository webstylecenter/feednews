/* eslint-disable no-undef,no-param-reassign */
/** global: chrome */

const HEADER_BLACKLIST = [
  'content-security-policy',
  'x-frame-options',
  'cross-origin-opener-policy',
];

const pushLink = (link) => {
    const formData = new FormData();
    formData.append('url', link);

    fetch('https://www.feednews.me/feed/chrome-import/peter@webstylecenter.com', { method: 'POST', body: formData })
        .then(response => response.json())
        .then(result => {
            if (result.status !== 'success') {
                throw result.message;
            }

            return result;
        })
        .then(result => {
            let notification = new Notification(result.title, { icon: 'feednews.png', body: result.description });
            notification.addEventListener('click', () => {
                chrome.tabs.create({ url: `https://www.feednews.me/#item=${btoa(result.url)}` });
            });
        })
        .catch(error => {
            new Notification('Error occurred', { icon: 'feednews.png', body: error });
        });
};

chrome.browserAction.onClicked.addListener(() => {
  chrome.tabs.query({ active: true, lastFocusedWindow: true }, (tabs) => {
    pushLink(tabs[0].url);
  });
});

chrome.webRequest.onHeadersReceived.addListener(
  (details) => {
    const filteredHeaders = details.responseHeaders.filter((header) => {
      const sanitizedHeader = header.name.toLowerCase();
      return HEADER_BLACKLIST.indexOf(sanitizedHeader) < 0;
    });

    return { responseHeaders: filteredHeaders };
  },
  { urls: ['<all_urls>'] },
  ['blocking', 'responseHeaders'],
);

chrome.contextMenus.create({
  title: 'Add to Feednews',
  contexts: ['link'],
  onclick: (info) => {
    pushLink(info.linkUrl);
  },
});


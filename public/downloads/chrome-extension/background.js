/* eslint-disable no-undef,no-param-reassign */
/** global: chrome */

const HEADER_BLACKLIST = [
  'content-security-policy',
  'x-frame-options',
  'cross-origin-opener-policy',
];

const API_URL = 'https://www.feednews.me';

const pushLink = (link) => {
    const formData = new FormData();
    formData.append('url', link);

    fetch(`${API_URL}/feed/chrome-import/peter%40webstylecenter.com`, { method: 'POST', body: formData })
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
                chrome.tabs.create({ url: `${API_URL}/#item=${btoa(result.url)}` });
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


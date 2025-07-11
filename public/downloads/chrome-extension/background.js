const HEADER_BLACKLIST = [
  'content-security-policy',
  'x-frame-options',
  'cross-origin-opener-policy',
];

const API_URL = 'https://feednews.me';

// Global notification click handler
const notificationUrlMap = {};

chrome.notifications.onClicked.addListener((notificationId) => {
  const url = notificationUrlMap[notificationId];
  if (url) {
    chrome.tabs.create({ url: url });
    delete notificationUrlMap[notificationId]; // Clean up
  }
});

// Use chrome.notifications instead of the Notification API
function createNotification(title, message, url = null) {
  chrome.notifications.create('', {
    type: 'basic',
    iconUrl: 'feednews.png',
    title: title,
    message: message
  }, (notificationId) => {
    if (url) {
      notificationUrlMap[notificationId] = url;
    }
  });
}

const pushLink = (link) => {
  const formData = new FormData();
  formData.append('url', link);

  fetch(`${API_URL}/feed/chrome-import`, { method: 'POST', body: formData })
    .then(response => response.json())
    .then(result => {
      if (result.status !== 'success') {
        throw new Error(result.message);
      }

      const fullUrl = `${API_URL}/#item=${btoa(result.url)}`;
      createNotification(result.title, result.description, fullUrl);
    })
    .catch(error => {
      createNotification('Error occurred', error.message || String(error));
    });
};

// Handle toolbar click
chrome.action.onClicked.addListener((tab) => {
  if (tab.url) {
    pushLink(tab.url);
  }
});

// Setup context menu on install
chrome.runtime.onInstalled.addListener(() => {
  chrome.contextMenus.create({
    id: 'addToFeednews',
    title: 'Add to Feednews',
    contexts: ['link']
  });
});

// Handle context menu click
chrome.contextMenus.onClicked.addListener((info) => {
  if (info.menuItemId === 'addToFeednews' && info.linkUrl) {
    pushLink(info.linkUrl);
  }
});

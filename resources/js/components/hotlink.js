(() => {
    const searchParams = new URLSearchParams(window.location.hash.substring(1));

    const itemUrl = atob(searchParams.get('item'));
    if (!/^((http|https):\/\/)/.test(itemUrl)) {
        return;
    }

    openPage(itemUrl);
    history.replaceState(null, null, ' ');
})();


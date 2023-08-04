chrome.runtime.onMessage.addListener(function(request, sender, sendResponse) {
    if (request.action === 'getHTML') {
        let profileHTML = document.querySelector('.col-sm-8.mb-3.order-2.order-sm-1').innerHTML;
        sendResponse({html: profileHTML});
    }
});

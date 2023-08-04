document.addEventListener('DOMContentLoaded', function() {
    chrome.runtime.sendMessage({ action: 'getPosts' }, function(response) {
        if (chrome.runtime.lastError) {
            console.error(chrome.runtime.lastError);
        } else {
            console.log('Received posts from background.js:', response);
            var selectElement = document.getElementById('language-posts');
            response.posts.forEach(function(post) {
                var option = document.createElement('option');
                option.text = post.title;
                option.value = post.id;
                selectElement.add(option);
            });

            var saveButton = document.getElementById('save-button');
            saveButton.addEventListener('click', function() {
                var selectedPostId = document.getElementById('language-posts').value;
                chrome.tabs.query({ active: true, currentWindow: true }, function(tabs) {
                    chrome.tabs.sendMessage(tabs[0].id, { action: 'saveCandidate', postId: selectedPostId }, function(response) {
                        if (chrome.runtime.lastError) {
                            console.error(chrome.runtime.lastError);
                        } else {
                            console.log('Received name and surname from content.js:', response);
                            // Отправляем имя и фамилию в background.js
                            chrome.runtime.sendMessage({ ...response, action: 'saveCandidate', postId: selectedPostId }, function(response) {
                                if (chrome.runtime.lastError) {
                                    console.error(chrome.runtime.lastError);
                                } else {
                                    console.log('Received response from background.js:', response);
                                }
                            });
                        }
                    });
                });
            });
        }
    });
});

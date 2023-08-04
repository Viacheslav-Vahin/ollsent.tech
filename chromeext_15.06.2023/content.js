// Сразу после загрузки страницы отправляем имя и фамилию в background.js для проверки
document.addEventListener('DOMContentLoaded', function() {
    let fullName = getFullName();
    console.log(fullName);
    chrome.runtime.sendMessage({ ...fullName, action: 'checkCandidate' });
});

// Функция для извлечения имени и фамилии
function getFullName() {
    let fullName = document.querySelector('.pv-text-details__left-panel h1').innerText;
    let names = fullName.split(' ');
    let firstName = names.shift();
    let lastName = names.join(' '); // Обрабатываем случаи, когда фамилия состоит из более чем одного слова
    return { firstName, lastName };
}

// Прослушиваем сообщения от popup.js
chrome.runtime.onMessage.addListener(function(request, sender, sendResponse) {
    if (request.action === "saveCandidate") {
        let fullName = getFullName();
        console.log(fullName);
        sendResponse(fullName); // Отправляем имя и фамилию обратно в popup.js
    }
});
document.addEventListener('DOMContentLoaded', function() {
    let fullNameElement = document.querySelector('.pv-text-details__left-panel h1');

    // Проверяем, что элемент найден перед тем как продолжить
    if (fullNameElement) {
        let fullName = getFullName();
        // Отправляем сообщение с только что извлеченным lastName
        chrome.runtime.sendMessage({ lastName: fullName.lastName, action: 'checkCandidate' }, function(response) {
            if (chrome.runtime.lastError) {
                console.error(chrome.runtime.lastError);
            } else {
                console.log('Received response from background.js:', response);
            }
        });
    }
});
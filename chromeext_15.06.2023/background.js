chrome.runtime.onStartup.addListener(function() {
    getAuthToken().then(showPopupWithPosts);
});

// Обработка сообщений от content script
chrome.runtime.onMessage.addListener(function(message, sender, sendResponse) {
    if (message.action === 'getPosts') {
        getAuthToken()
            .then(authToken => fetchLanguagePosts(authToken))
            .then(posts => {
                sendResponse({ posts: posts });
            })
            .catch(error => {
                console.error('Ошибка при получении постов:', error);
            });
        return true; // keeps the message channel open until sendResponse is executed
    }
    if (message.action === 'saveCandidate') {
        getAuthToken()
            .then(authToken => saveCandidate(message.firstName, message.lastName, message.postId, authToken))
            .then(response => {
                // Отправляем сообщение с результатом сохранения в content script
                sendResponse({ action: 'saveCandidateResult', success: true });
            })
            .catch(error => {
                console.error('Ошибка при сохранении кандидата:', error);
                // Отправляем сообщение с результатом сохранения в content script
                sendResponse({ action: 'saveCandidateResult', success: false });
            });
    }

    console.log("Received message in background.js:", message);

    if (message.action === 'checkCandidate') {
        getAuthToken()
            .then(authToken => checkCandidate(message.lastName, authToken)) // Используем lastName для поиска
            .then(candidateExists => {
                // Отправляем сообщение с результатом проверки в content script
                sendResponse({ action: 'checkCandidateResult', exists: candidateExists });
            })
            .catch(error => {
                console.error('Ошибка при проверке кандидата:', error);
                // Отправляем сообщение с результатом проверки в content script
                sendResponse({ action: 'checkCandidateResult', exists: false });
            });
    }
    return true; // keeps the message channel open until sendResponse is executed
});

// Функция для получения токена аутентификации
async function getAuthToken() {
    let response = await fetch('https://crm.ollsent.tech/wp-json/jwt-auth/v1/token', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            username: 'admin_3',
            password: 'AlexKozyrev280391'
        })
    });

    if (!response.ok) {
        throw new Error('Failed to get auth token');
    }

    let data = await response.json();
    return data.token;
}

// Функция для сохранения кандидата
async function saveCandidate(firstName, lastName, authToken) {
    let response = await fetch('https://crm.ollsent.tech/wp-json/wp/v2/candidate', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + authToken
        },
        body: JSON.stringify({
            status: 'publish',
            title: lastName
        })
    });

    if (!response.ok) {
        throw new Error('Failed to create candidate');
    }

    const candidate = await response.json();

    response = await fetch(`https://crm.ollsent.tech/wp-json/acf/v3/candidate/${candidate.id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + authToken
        },
        body: JSON.stringify({
            fields: {
                imya: firstName,
                familiya: lastName
            }
        })
    });

// Получите выбранный пост из селекта
    let select = document.getElementById('language-posts');
    let selectedPostId = select.options[select.selectedIndex].value;

    // Затем обновите поле ACF
    let acfResponse = await fetch(`https://crm.ollsent.tech/wp-json/acf/v3/candidate/${candidate.id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + authToken
        },
        body: JSON.stringify({
            fields: {
                imya: firstName,
                familiya: lastName,
                spec1: [selectedPostId] // Здесь добавьте выбранный post ID в поле spec1
            }
        })
    });
    if (!response.ok) {
        throw new Error('Failed to update fields');
    }
    if (!acfResponse.ok) {
        throw new Error('Failed to update ACF fields');
    }

    // Обработка ответа по необходимости}
}
// Функция для проверки наличия кандидата
async function checkCandidate(lastName, authToken) { // Используем lastName для поиска
    let response = await fetch('https://crm.ollsent.tech/wp-json/wp/v2/candidate?search=' + lastName, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + authToken
        }
    });

    if (!response.ok) {
        throw new Error('Failed to check candidate');
    }

    const candidates = await response.json();
    console.log('candidates - ' + JSON.stringify(candidates)); // добавил JSON.stringify для логирования
    return candidates.some(candidate => candidate.title.rendered === lastName);
}

async function fetchLanguagePosts(authToken) {
    let response = await fetch('https://crm.ollsent.tech/wp-json/wp/v2/language?per_page=100', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + authToken
        }
    });

    if (!response.ok) {
        throw new Error('Failed to fetch language posts');
    }

    return await response.json();
}

async function showPopupWithPosts() {
    let authToken = await getAuthToken();
    let posts = await fetchLanguagePosts(authToken);

    let select = document.createElement('select');
    select.id = 'language-posts'; // Добавьте идентификатор для последующего использования
    posts.forEach(post => {
        let option = document.createElement('option');
        option.value = post.id;
        option.text = post.title.rendered;
        select.appendChild(option);
    });

    let popup = document.getElementById('pop-prof');
    popup.appendChild(select);
}


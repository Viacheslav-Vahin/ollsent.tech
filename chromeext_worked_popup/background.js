let selectedVacancyId = null;
let cachedHTML = null;  // это ваша глобальная переменная

chrome.runtime.onMessage.addListener(function (message, sender, sendResponse) {
    let authToken;
    let globalContacts = null;
    if (message.action === 'saveCandidate') {
        globalContacts = message.contacts; // Сохраняем контакты
        getAuthToken()
            .then(token => {
                authToken = token;
                return saveCandidate(authToken, message.firstName, message.lastName, globalContacts, message.allInfo, message.foto, message.rezume, message.cvComb);
            })
            .then(candidate => {
                if (!candidate || !candidate.id) {
                    throw new Error('Candidate object is undefined or does not have an id');
                }
                console.log(message);
                // Make a request to save the position
                return fetch(`https://crm.ollsent.tech/wp-json/acf/v3/candidate/${candidate.id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json; charset=utf-8',
                        'Authorization': 'Bearer ' + authToken
                    },
                    body: JSON.stringify({
                        fields: {
                            spec1: message.positionId,
                            posada_inshi: message.positionNoitId,
                            zarplata: message.zarplata,
                            mova_p: message.mova,
                            city_r: message.city,
                            id_vac: message.vacid,
                            candidate_stage: message.candidate_st,
                            tegi: message.tag,
                            engl_r: message.engl,
                            exp_r: message.exp,
                            additional_info_cp: message.adinf
                        }
                    })
                })
            })
            .catch(error => {
                console.error('Error when saving candidate:', error);
                sendResponse({action: 'saveCandidateResult', success: false});
            });
        return true; // keeps the message channel open until sendResponse is executed
    } else if (message.action === 'checkCandidate') {
        getAuthToken()
            .then(authToken => checkCandidate(message.lastName, authToken)) // Используем lastName для поиска
            .then(candidateExists => {
                sendResponse({action: 'checkCandidateResult', exists: candidateExists});
            })
            .catch(error => {
                console.error('Ошибка при проверке кандидата:', error);
                sendResponse({action: 'checkCandidateResult', exists: false});
            });
    } else if (message.action === 'fetchLanguages') {
        getAuthToken()
            .then(authToken => fetchPostTypes(authToken))
            .then(posts => {
                sendResponse({action: 'fetchLanguagesResult', posts: posts});
            })
            .catch(error => {
                console.error('Error fetching languages:', error);
                sendResponse({action: 'fetchLanguagesResult', error: error});
            });
    }
    else if (message.action === 'fetchNoit') {
        getAuthToken()
            .then(authToken => fetchNoitTypes(authToken))
            .then(posts => {
                sendResponse({action: 'fetchNoitResult', posts: posts});
            })
            .catch(error => {
                console.error('Error fetching noit:', error);
                sendResponse({action: 'fetchNoitResult', error: error});
            });
    } else if (message.action === 'updateContactInfo') {
        globalContacts = message.contacts;
        sendResponse({success: true});
    } else if (message.action === 'fetchContacts') {
        getAuthToken()
            .then(authToken => {
                return fetchContacts(authToken);
            })
            .then(contacts => {
                sendResponse({action: 'fetchContactsResult', contacts: contacts});
            })
            .catch(error => {
                console.error('Error when fetching contacts:', error);
                sendResponse({action: 'fetchContactsResult', contacts: []});
            });
        return true;
    }
    if (message.action === 'getContactTypes') {
        getAuthToken()
            .then(fetchContactTypes)
            .then(contactTypes => {
                sendResponse({action: 'getContactTypesResult', contactTypes: contactTypes});
            })
            .catch(error => {
                console.error('Ошибка при получении типов контактов:', error);
                sendResponse({action: 'getContactTypesResult', contactTypes: []});
            });
    }
    if (message.action === 'fetchLanguageTypes') {
        getAuthToken()
            .then(authToken => fetchLanguageTypes(authToken))
            .then(posts => {
                sendResponse({action: 'fetchLanguageTypesResult', posts: posts});
            })
            .catch(error => {
                console.error('Error fetching languages:', error);
                sendResponse({action: 'fetchLanguageTypesResult', error: error});
            });
    }
    if (message.action === 'showRegion') {
        getAuthToken()
            .then(authToken => showRegion(authToken))
            .then(posts => {
                sendResponse({action: 'showRegionResult', posts: posts});
            })
            .catch(error => {
                console.error('Error fetching languages:', error);
                sendResponse({action: 'showRegionResult', error: error});
            });
    }
    if (message.action === 'showVac') {
        getAuthToken()
            .then(authToken => showVac(authToken))
            .then(posts => {
                sendResponse({action: 'showVacResult', posts: posts});
            })
            .catch(error => {
                console.error('Error fetching languages:', error);
                sendResponse({action: 'showVacResult', error: error});
            });
    }
    if (message.action === 'showVacStage') {
        getAuthToken()
            .then(authToken => showVacStage(authToken))
            .then(posts => {
                sendResponse({action: 'showVacStageResult', posts: posts});
            })
            .catch(error => {
                console.error('Error fetching languages:', error);
                sendResponse({action: 'showVacStageResult', error: error});
            });
    }
    if (message.action === 'saveVacancyId') {
        selectedVacancyId = message.vacancyId;
    }
    if (message.action === 'showTags') {
        getAuthToken()
            .then(authToken => showTags(authToken))
            .then(posts => {
                sendResponse({action: 'showTagsResult', posts: posts});
            })
            .catch(error => {
                console.error('Error fetching languages:', error);
                sendResponse({action: 'showTagsResult', error: error});
            });
    }
    if (message.action === 'openTab') {
        chrome.tabs.create({ url: message.url }, async tab => {
            chrome.scripting.executeScript({
                target: { tabId: tab.id },
                files: ['otherContent.js']
            });
            try {
                await waitForTabLoad(tab.id);
                const html = await getTabHTML(tab.id);
                cachedHTML = html;
                console.log('HTML received, sending response back to popup');
                sendResponse({html});
            } catch (err) {
                console.error(err);
            }
        });
        return true;
    }
    return true;
});
function waitForTabLoad(tabId) {
    return new Promise((resolve, reject) => {
        chrome.tabs.onUpdated.addListener(function listener (updatedTabId, info) {
            if (info.status === 'complete' && updatedTabId === tabId) {
                console.log('Tab has loaded, removing listener');
                chrome.tabs.onUpdated.removeListener(listener);
                resolve();
            }
        });
    });
}
function getTabHTML(tabId) {
    return new Promise((resolve, reject) => {
        chrome.tabs.sendMessage(tabId, {action: 'getHTML'}, function(response) {
            if (chrome.runtime.lastError) {
                console.log('Error when getting HTML', chrome.runtime.lastError.message);
                reject(chrome.runtime.lastError.message);
            } else {
                console.log('HTML received from tab', response.html);
                resolve(response.html);
            }
        });
    });
}
async function getProfileHTML(url) {
    return new Promise((resolve, reject) => { // Добавьте reject как аргумент
        chrome.runtime.sendMessage({action: 'openTab', url: url}, function(response) {
            console.log(response);
            if(response && response.html){
                resolve(response.html);
            } else {
                console.error('Error: Response does not contain html property');
                reject("Response does not contain html property"); // Теперь вы можете отклонить обещание
            }
        });
    });
}

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
async function saveCandidate(authToken, firstName, lastName, contacts = [], allInfo, foto, rezume, cvComb) {
    let profileHTML = cachedHTML;
    let headers = new Headers();
    headers.append('Content-Type', 'application/json; charset=utf-8');
    headers.append('Authorization', 'Bearer ' + authToken);
    let response = await fetch('https://crm.ollsent.tech/wp-json/wp/v2/candidate', {
        method: 'POST',
        headers: headers,
        body: JSON.stringify({
            status: 'draft',
            title: lastName
        })
    });
    if (!response.ok) {
        let responseBody = await response.text();
        console.error(responseBody);
        throw new Error('Failed to create candidate');
    }
    const candidate = await response.json();
    await new Promise(resolve => setTimeout(resolve, 6000));
    let cvId = '';

    if(rezume.endsWith('.pdf')) {
        let response_re = await fetch(rezume);
        let blobre = await response_re.blob();
        let formDatare = new FormData();
        formDatare.append('file', blobre, 'filename.pdf');
        let uploadResponsere = await fetch('https://crm.ollsent.tech/wp-json/wp/v2/media', {
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + authToken
            },
            body: formDatare
        });
        if (!uploadResponsere.ok) {
            throw new Error('Failed to upload file');
        }
        let uploadResultre = await uploadResponsere.json();
        cvId = uploadResultre.id;
    }
    else {
        let response_re = await fetch(rezume);
        let blobre = await response_re.blob();
        let formDatare = new FormData();
        formDatare.append('file', blobre, 'filename.docx');
        let uploadResponsere = await fetch('https://crm.ollsent.tech/wp-json/wp/v2/media', {
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + authToken
            },
            body: formDatare
        });
        if (!uploadResponsere.ok) {
            throw new Error('Failed to upload file');
        }
        let uploadResultre = await uploadResponsere.json();
        cvId = uploadResultre.id;
    }
    response = await fetch(`https://crm.ollsent.tech/wp-json/acf/v3/candidate/${candidate.id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + authToken
        },
        body: JSON.stringify({
            fields: {
                resume_r: cvId ? cvId : '',
                code_cv: cvComb,
                code_cv_dj: profileHTML
            }
        })
    });
    if (!response.ok) {
        let responseBody = await response.text();
        console.error(responseBody);
        throw new Error('Failed to create candidate');
    }
    await new Promise(resolve => setTimeout(resolve, 6000));
    // Then update status to 'publish'
    response = await fetch(`https://crm.ollsent.tech/wp-json/wp/v2/candidate/${candidate.id}`, {
        method: 'POST',
        headers: headers,
        body: JSON.stringify({
            status: 'publish'
        })
    });

    if (!response.ok) {
        throw new Error('Failed to update candidate status');
    }

    let imageId = '';
    if (foto) {
        let response_r = await fetch(foto);
        let blob = await response_r.blob();
        let formData = new FormData();
        formData.append('file', blob, 'filename.jpg');
        let uploadResponse = await fetch('https://crm.ollsent.tech/wp-json/wp/v2/media', {
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + authToken
            },
            body: formData
        });
        if (!uploadResponse.ok) {
            throw new Error('Failed to upload image');
        }
        let uploadResult = await uploadResponse.json();
        imageId = uploadResult.id;
    }


    let emailContact = contacts.find(contact => contact.id === '8651');
    let emailValue = emailContact ? emailContact.value : null;
    let now = new Date();
    let saveDatePa = now.getFullYear() + "-" +
        ("0" + (now.getMonth() + 1)).slice(-2) + "-" +
        ("0" + now.getDate()).slice(-2) + " " +
        ("0" + now.getHours()).slice(-2) + ":" +
        ("0" + now.getMinutes()).slice(-2) + ":" +
        ("0" + now.getSeconds()).slice(-2);
    let saveDate = saveDatePa.toString();
    let sec1 = new Date().getTime() / 1000;
    sec1 = sec1 + 86400;
    sec1 = Math.floor(sec1);
    let allInfoPar = '';
    if (allInfo === '') {
        allInfoPar = profileHTML;
    } else {
        allInfoPar = allInfo;
    }
    response = await fetch(`https://crm.ollsent.tech/wp-json/acf/v3/candidate/${candidate.id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + authToken
        },
        body: JSON.stringify({
            fields: {
                imya: firstName,
                familiya: lastName,
                kontakti22: contacts ? contacts.map(contact => ({
                    kontakt222: contact.id,
                    dannik: contact.value,
                    kanal_zvyazku: contact.kanal_zvyazku
                })) : [],
                email_r: emailValue,
                foto_re: imageId,
                // resume_r: cvId ? cvId : '',
                resume_docx: cvId ? cvId : '',
                // code_cv: cvComb,
                dattime: saveDate,
                dataStart2: sec1,
                dataStart0: sec1,
                pdf_parsed: allInfoPar ? allInfoPar : '',
                user_r: 8
            }
        })
    });
    if (!response.ok) {
        throw new Error('Failed to update ACF fields');
    }
    return candidate;
}
async function showVac(authToken) {
    let response = await fetch('https://crm.ollsent.tech/wp-json/wp/v2/vacancy', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + authToken
        }
    });

    if (!response.ok) {
        throw new Error('Failed to fetch contact types');
    }

    const vacTypes = await response.json();
    return vacTypes;
}
async function showVacStage(authToken) {
    let vacancyId = selectedVacancyId ? selectedVacancyId : '';// ID вашей вакансии
    let response = await fetch(`https://crm.ollsent.tech/wp-json/wp/v2/vacancy/${vacancyId}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + authToken
        }
    });

    if (!response.ok) {
        throw new Error('Failed to fetch contact types');
    }

    const vacStTypes = await response.json();
    // return vacStTypes.acf.etapi_spivbesidi.map(item => item.label);

    return vacStTypes.acf.etapi_spivbesidi;
}
async function checkCandidate(lastName, authToken) {
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
    return candidates.some(candidate => candidate.title.rendered === lastName);
}

async function fetchPostTypes(authToken) {
    let postTypes = ['language'];
    let allPostsPromises = postTypes.map(postType => {
        return fetch(`https://crm.ollsent.tech/wp-json/wp/v2/${postType}?per_page=100`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + authToken
            }
        }).then(response => {
            if (!response.ok) {
                throw new Error('Failed to fetch posts');
            }
            return response.json();
        });
    });

    let allPosts = await Promise.all(allPostsPromises);
    return allPosts.flat();
}

async function fetchNoitTypes(authToken) {
    let postTypes = ['noitposts'];
    let allPostsPromises = postTypes.map(postType => {
        return fetch(`https://crm.ollsent.tech/wp-json/wp/v2/${postType}?per_page=100`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + authToken
            }
        }).then(response => {
            if (!response.ok) {
                throw new Error('Failed to fetch posts');
            }
            return response.json();
        });
    });

    let allPosts = await Promise.all(allPostsPromises);
    return allPosts.flat();
}

function fetchContacts(authToken) {
    const url = 'https://crm.ollsent.tech/wp-json/wp/v2/contacts';
    return fetch(url, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + authToken
        }
    })
        .then(response => response.json())
        .then(data => {
            return data;
        })
        .catch(error => console.error('Error:', error));
}

async function fetchContactTypes(authToken) {
    let response = await fetch('https://crm.ollsent.tech/wp-json/wp/v2/contacts', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + authToken
        }
    });

    if (!response.ok) {
        throw new Error('Failed to fetch contact types');
    }

    const contactTypes = await response.json();
    return contactTypes;
}

async function fetchLanguageTypes(authToken) {
    let response = await fetch('https://crm.ollsent.tech/wp-json/wp/v2/mova', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + authToken
        }
    });
    if (!response.ok) {
        throw new Error('Failed to fetch contact types');
    }
    const languageTypes = await response.json();
    return languageTypes;
}

async function showRegion(authToken) {
    let response = await fetch('https://crm.ollsent.tech/wp-json/wp/v2/countries?per_page=100', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + authToken
        }
    });

    if (!response.ok) {
        throw new Error('Failed to fetch contact types');
    }

    const regTypes = await response.json();
    return regTypes;
}
async function showTags(authToken) {
    let response = await fetch('https://crm.ollsent.tech/wp-json/wp/v2/tagstype?per_page=100', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + authToken
        }
    });
    if (!response.ok) {
        throw new Error('Failed to fetch contact types');
    }
    const tagTypes = await response.json();
    return tagTypes;
}
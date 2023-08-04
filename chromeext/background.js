let selectedVacancyId = null;
let cachedHTML = null;
let nowD = new Date();
let saveDateParse = nowD.getFullYear() + "-" +
    ("0" + (nowD.getMonth() + 1)).slice(-2) + "-" +
    ("0" + nowD.getDate()).slice(-2) + " " +
    ("0" + nowD.getHours()).slice(-2) + ":" +
    ("0" + nowD.getMinutes()).slice(-2) + ":" +
    ("0" + nowD.getSeconds()).slice(-2);
let saveDt = saveDateParse.toString();
chrome.runtime.onMessage.addListener(function (message, sender, sendResponse) {
    let authToken;
    let globalContacts = null;
    if (message.action === 'login') {
        // console.log('login');
        let username = message.username;
        let password = message.password;
        fetch('https://crm.ollsent.tech/wp-json/jwt-auth/v1/token', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({username: username, password: password})
        })
            .then(response => response.json())
            .then(data => {
                // console.log('data', data);
                if (data.token) {
                    chrome.storage.local.set({'authToken': data.token, 'username': data.user_nicename});
                    sendResponse({action: 'loginResult', success: true, userId: data.user_nicename});
                    chrome.tabs.query({active: true, currentWindow: true}, function(tabs) {
                        let tab = tabs[0];
                        chrome.tabs.reload(tab.id);
                    });
                } else {
                    sendResponse({action: 'loginResult', success: false, message: 'Уведено не правильні данні'});
                }
            })
            .catch(error => {
                sendResponse({action: 'loginResult', success: false, message: 'An error occurred during login'});
            });
        return true;
    }
    // if (message.action === 'login') {
    //     fetch('https://crm.ollsent.tech/wp-json/jwt-auth/v1/token', {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json'
    //         },
    //         body: JSON.stringify({username: message.username, password: message.password})
    //     })
    //         .then(response => response.json())
    //         .then(data => {
    //             if (data.token) {
    //                 // Login successful
    //                 chrome.storage.local.set({authToken: data.token, userDisplayName: data.user_display_name}, function() {
    //                     console.log('Token is set to ' + data.token);
    //                     console.log('User Display Name is set to ' + data.user_display_name);
    //                     sendResponse({action: 'loginResult', success: true});
    //                 });
    //             } else {
    //                 // Login failed
    //                 sendResponse({action: 'loginResult', success: false, message: 'Уведено не правильні данні'});
    //             }
    //         })
    //         .catch(error => {
    //             console.error('Error during login:', error);
    //             sendResponse({action: 'loginResult', success: false, message: 'An error occurred during login'});
    //         });
    //     return true; // keeps the message channel open until sendResponse is executed
    // }
    else if (message.action === 'logout') {
        // console.log('logout');
        chrome.storage.local.remove(['authToken'], function() {
            chrome.tabs.query({active: true, currentWindow: true}, function(tabs) {
                let tab = tabs[0];
                chrome.tabs.reload(tab.id);
            });
        });
    }
    if (message.action === 'saveCandidate') {
        globalContacts = message.contacts; // Сохраняем контакты
        chrome.storage.local.get(['authToken'], function (result) {
            let authToken = result.authToken;
            let currentUserId = getCurrentUserId(authToken);
            checkCandidateId(message.lastName, authToken, currentUserId, message.vacid)
                .then(({isAddedByCurrentUser, isOnCurrentVacancy}) => {
                    // console.log('isAddedByCurrentUser',isAddedByCurrentUser);
                    // console.log('isOnCurrentVacancy',isOnCurrentVacancy);
                    if (!isAddedByCurrentUser && !isOnCurrentVacancy) {
                        // Если кандидат был добавлен другим пользователем и уже на текущей вакансии, отображаем сообщение об ошибке
                        chrome.tabs.query({active: true, currentWindow: true}, function(tabs) {
                            chrome.tabs.sendMessage(tabs[0].id, {action: 'showError', message: 'Цього кандидата вже відмітили на вакансію'});
                        });
                        sendResponse({action: 'saveCandidateResult', success: false});
                    } else {
                        // Если кандидат был добавлен текущим пользователем или не на текущей вакансии, продолжить обработку
                        return checkCandidate(message.lastName, authToken) // проверяем существует ли кандидат
                            .then(candidateId => {
                                return saveCandidate(authToken, message.firstName, message.lastName, globalContacts, message.allInfo, message.foto, message.rezume, message.cvComb, message.candidateId, message.zvidku);
                            })
                            .then(candidate => {
                    if (!candidate || !candidate.id) {
                        throw new Error('Candidate object is undefined or does not have an id');
                    }
                    let oldAdditionalInfo = candidate.acf.additional_info || '';
                    let infoArray = [
                    message.adinf ? '</br><em>' + saveDt + ' - </em> <strong>Доданий коментар:</strong>' + message.adinf + '</strong>' : '',
                    message.positionIdName ? '</br><em>' + saveDt + ' - </em> <strong>Додана позиція:</strong>' + message.positionIdName + '</strong>' : '',
                    message.positionNoitIdName ? '</br><em>' + saveDt + ' - </em> <strong>Додана позиція:</strong>' + message.positionNoitIdName + '</strong>' : '',
                    message.zarplata ? '</br><em>' + saveDt + ' - </em> <strong>Додана Зарплата:</strong>' + message.zarplata + '</strong>' : '',
                    message.movaName ? '</br><em>' + saveDt + ' - </em> <strong>Додана Мова:</strong>' + message.movaName + '</strong>' : '',
                    message.cityName ? '</br><em>' + saveDt + ' - </em> <strong>Додано Місто:</strong>' + message.cityName + '</strong>' : '',
                    message.vacidName ? '</br><em>' + saveDt + ' - </em> <strong>Додана ID вакансії:</strong>' + message.vacidName + '</strong>' : '',
                    message.candidate_st ? '</br><em>' + saveDt + ' - </em> <strong>Доданий Етап по вакансії кандидата:</strong>' + message.candidate_st + '</strong>' : '',
                    message.tag ? '</br><em>' + saveDt + ' - </em> <strong>Додані Теги:</strong>' + message.tag + '</strong>' : '',
                    message.englName ? '</br><em>' + saveDt + ' - </em> <strong>Додано Рівень Англійської:</strong>' + message.englName + '</strong>' : '',
                    message.exp ? '</br><em>' + saveDt + ' - </em> <strong>Додано Досвід:</strong>' + message.exp + '</strong>' : ''
                    ];
                    infoArray = infoArray.filter(info => info !== '');
                    let additional_info = infoArray.join('');
                    let newAdditionalInfo = oldAdditionalInfo + additional_info;
                    // console.log('oldAdditionalInfo : ', oldAdditionalInfo);
                    // console.log('newAdditionalInfo : ', newAdditionalInfo);
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
                                main_comment: message.adinf,
                                additional_info: newAdditionalInfo,
                                main_comment_sw: message.adinfch
                                // additional_info_cp: message.adinf
                                // additional_info: message.adinf
                            }
                        })
                    });
                })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Failed to save the position');
                                }
                                // console.log('Candidate and position saved successfully');
                                sendResponse({action: 'saveCandidateResult', success: true});
                            })
                            .catch(error => {
                                console.error('Error when saving candidate:', error);
                                sendResponse({action: 'saveCandidateResult', success: false});
                            });
                    }
                })
                .catch(error => {
                    console.error('Error when checking candidate:', error);
                    sendResponse({action: 'saveCandidateResult', success: false});
                });
        });
        return true; // keeps the message channel open until sendResponse is executed
    }
    else if (message.action === 'checkCandidate') {
        chrome.storage.local.get(['authToken'], function (result) {
            let authToken = result.authToken;
            // console.log(message.lastName);
            // console.log(authToken);
            checkCandidate(message.lastName, authToken) // Используем lastName для поиска
                .then(candidateExists => {
                    console.log('candidateExists: ', candidateExists);
                    sendResponse({action: 'checkCandidateResult', exists: candidateExists});
                })
                .catch(error => {
                    console.error('Ошибка при проверке кандидата:', error);
                    sendResponse({action: 'checkCandidateResult', exists: false});
                });
        });
        return true; // keeps the message channel open until sendResponse is executed
    }
    else if (message.action === 'getCandidateSalary') {
        chrome.storage.local.get(['authToken'], function (result) {
            let authToken = result.authToken;
            // console.log(message.lastName);
            // console.log(authToken);
            getCandidateSalary(message.lastName, authToken) // Используем lastName для поиска
                .then(({foundCand, foundCandidatez, mova, kontakti22}) => {
                    // console.log('candidateSalary: ', foundCand);
                    sendResponse({action: 'getCandidateSalaryResult', salary: foundCand, exp: foundCandidatez, mova: mova, kontakti22: kontakti22});
                })
                .catch(error => {
                    console.error('Ошибка при получении зарплаты кандидата:', error);
                    sendResponse({action: 'getCandidateSalaryResult', salary: null, mova: null});
                });
        });
        return true; // keeps the message channel open until sendResponse is executed
    }
    else if (message.action === 'fetchLanguages') {
        chrome.storage.local.get(['authToken'], function (result) {
            let authToken = result.authToken;
            fetchPostTypes(authToken)
                .then(posts => {
                    sendResponse({action: 'fetchLanguagesResult', posts: posts});
                })
                .catch(error => {
                    console.error('Error fetching languages:', error);
                    sendResponse({action: 'fetchLanguagesResult', error: error});
                });
        });
        return true; // keeps the message channel open until sendResponse is executed
    }
    else if (message.action === 'fetchNoit') {
        chrome.storage.local.get(['authToken'], function (result) {
            let authToken = result.authToken;
            fetchNoitTypes(authToken)
                .then(posts => {
                    sendResponse({action: 'fetchNoitResult', posts: posts});
                })
                .catch(error => {
                    console.error('Error fetching noit:', error);
                    sendResponse({action: 'fetchNoitResult', error: error});
                });
        });
    }
    else if (message.action === 'updateContactInfo') {
        globalContacts = message.contacts;
        sendResponse({success: true});
    }
    else if (message.action === 'fetchContacts') {
        chrome.storage.local.get(['authToken'], function (result) {
            let authToken = result.authToken;
            fetchContacts(authToken)
                .then(contacts => {
                    sendResponse({action: 'fetchContactsResult', contacts: contacts});
                })
                .catch(error => {
                    console.error('Error when fetching contacts:', error);
                    sendResponse({action: 'fetchContactsResult', contacts: []});
                });
        });
        return true;
    }
    if (message.action === 'getContactTypes') {
        chrome.storage.local.get(['authToken'], function (result) {
            let authToken = result.authToken;
            fetchContactTypes(authToken)
                .then(contactTypes => {
                    sendResponse({action: 'getContactTypesResult', contactTypes: contactTypes});
                })
                .catch(error => {
                    console.error('Ошибка при получении типов контактов:', error);
                    sendResponse({action: 'getContactTypesResult', contactTypes: []});
                });
        });
        return true; // keeps the message channel open until sendResponse is executed
    }
    if (message.action === 'fetchLanguageTypes') {
        chrome.storage.local.get(['authToken'], function (result) {
            let authToken = result.authToken;
            fetchLanguageTypes(authToken)
                .then(posts => {
                    sendResponse({action: 'fetchLanguageTypesResult', posts: posts});
                })
                .catch(error => {
                    console.error('Error fetching languages:', error);
                    sendResponse({action: 'fetchLanguageTypesResult', error: error});
                });
        });
        return true; // keeps the message channel open until sendResponse is executed
    }
    if (message.action === 'showRegion') {
        chrome.storage.local.get(['authToken'], function (result) {
            let authToken = result.authToken;
            showRegion(authToken)
                .then(posts => {
                    sendResponse({action: 'showRegionResult', posts: posts});
                })
                .catch(error => {
                    console.error('Error fetching languages:', error);
                    sendResponse({action: 'showRegionResult', error: error});
                });
        });
        return true; // keeps the message channel open until sendResponse is executed
    }
    if (message.action === 'showVac') {
        chrome.storage.local.get(['authToken'], function (result) {
            let authToken = result.authToken;
            showVac(authToken)
                .then(posts => {
                    sendResponse({action: 'showVacResult', posts: posts});
                })
                .catch(error => {
                    console.error('Error fetching languages:', error);
                    sendResponse({action: 'showVacResult', error: error});
                });
        });
        return true; // keeps the message channel open until sendResponse is executed
    }
    if (message.action === 'showVacStage') {
        chrome.storage.local.get(['authToken'], function (result) {
            let authToken = result.authToken;
            showVacStage(authToken)
                .then(posts => {
                    sendResponse({action: 'showVacStageResult', posts: posts});
                })
                .catch(error => {
                    console.error('Error fetching languages:', error);
                    sendResponse({action: 'showVacStageResult', error: error});
                });
        });
        return true; // keeps the message channel open until sendResponse is executed
    }
    if (message.action === 'saveVacancyId') {
        selectedVacancyId = message.vacancyId;
    }
    if (message.action === 'showTags') {
        chrome.storage.local.get(['authToken'], function (result) {
            let authToken = result.authToken;
            showTags(authToken)
                .then(posts => {
                    sendResponse({action: 'showTagsResult', posts: posts});
                })
                .catch(error => {
                    console.error('Error fetching languages:', error);
                    sendResponse({action: 'showTagsResult', error: error});
                });
        });
        return true; // keeps the message channel open until sendResponse is executed
    }
    if (message.action === 'openTab') {
        // chrome.tabs.create({ url: message.url }, async tab => {
        //     chrome.scripting.executeScript({
        //         target: { tabId: tab.id },
        //         files: ['otherContent.js']
        //     });
        //     try {
        //         await waitForTabLoad(tab.id);
        //         const html = await getTabHTML(tab.id);
        //         cachedHTML = html;
        //         sendResponse({html});
        //     } catch (err) {
        //         console.error(err);
        //     }
        // });
        //
        // setTimeout(() => {
        //     chrome.tabs.remove(tab.id);
        // }, 2000);
        // return true;
        const currentTabId = sender.tab.id; // Сохраняем ID текущей вкладки

        chrome.tabs.create({url: message.url}, async tab => {
            chrome.scripting.executeScript({
                target: {tabId: tab.id},
                files: ['otherContent.js']
            });
            try {
                await waitForTabLoad(tab.id);
                const html = await getTabHTML(tab.id);
                cachedHTML = html;
                sendResponse({html});
            } catch (err) {
                console.error(err);
            }
            chrome.tabs.remove(tab.id, () => {
                chrome.tabs.update(currentTabId, {active: true});
            });
        });
        return true;
    }
    // if (message.action === 'login') {
    //     let username = message.username;
    //     let password = message.password;
    //     return fetch('https://crm.ollsent.tech/wp-json/jwt-auth/v1/token', {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json'
    //         },
    //         body: JSON.stringify({username: username, password: password})
    //     })
    //         .then(response => response.json())
    //         .then(data => {
    //             if (data.token) {
    //                 console.log(data);
    //                 return {action: 'loginResult', userId: data.user_nicename};
    //             } else {
    //                 return {action: 'loginResult', error: 'Invalid credentials'};
    //             }
    //         })
    //         .catch(error => {
    //             return {action: 'loginResult', error: error.message};
    //         });
    // }
    return true;
});

function waitForTabLoad(tabId) {
    return new Promise((resolve, reject) => {
        chrome.tabs.onUpdated.addListener(function listener(updatedTabId, info) {
            if (info.status === 'complete' && updatedTabId === tabId) {
                chrome.tabs.onUpdated.removeListener(listener);
                resolve();
            }
        });
    });
}

function getTabHTML(tabId) {
    return new Promise((resolve, reject) => {
        chrome.tabs.sendMessage(tabId, {action: 'getHTML'}, function (response) {
            if (chrome.runtime.lastError) {
                reject(chrome.runtime.lastError.message);
            } else {
                resolve(response.html);
            }
        });
    });
}

// async function getProfileHTML(url) {
//     return new Promise((resolve, reject) => { // Добавьте reject как аргумент
//         chrome.runtime.sendMessage({action: 'openTab', url: url}, function(response) {
//             if(response && response.html){
//                 resolve(response.html);
//             } else {
//                 console.error('Error: Response does not contain html property');
//                 reject("Response does not contain html property"); // Теперь вы можете отклонить обещание
//             }
//         });
//     });
// }
// async function getAuthToken() {
//     let response = await fetch('https://crm.ollsent.tech/wp-json/jwt-auth/v1/token', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json'
//         },
//         body: JSON.stringify({
//             username: 'admin_3',
//             password: 'AlexKozyrev280391'
//         })
//     });
//     if (!response.ok) {
//         throw new Error('Failed to get auth token');
//     }
//     let data = await response.json();
//     return data.token;
// }

async function saveCandidate(authToken, firstName, lastName, contacts = [], allInfo, foto, rezume, cvComb, candidateId = null, zvidku) {
    let profileHTML = cachedHTML;
    let headers = new Headers();
    headers.append('Content-Type', 'application/json; charset=utf-8');
    headers.append('Authorization', 'Bearer ' + authToken);
    let candidate;
    let cvId = '';

    if (rezume && rezume.endsWith('.pdf')) {
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
        // else if(rezume && rezume.endsWith('.docx')) {
        //     console.log('.docx');
        //     let response_re = await fetch(rezume);
        //     let blobre = await response_re.blob();
        //     let formDatare = new FormData();
        //     formDatare.append('file', blobre, 'filename.docx');
        //     let uploadResponsere = await fetch('https://crm.ollsent.tech/wp-json/wp/v2/media', {
        //         method: 'POST',
        //         headers: {
        //             'Authorization': 'Bearer ' + authToken
        //         },
        //         body: formDatare
        //     });
        //     if (!uploadResponsere.ok) {
        //         throw new Error('Failed to upload file');
        //     }
        //     let uploadResultre = await uploadResponsere.json();
        //     cvId = uploadResultre.id;
    // }
    else if (rezume && rezume.endsWith('.docx')) {
        try {
            let response_re = await fetch(rezume);
            if (!response_re.ok) {
                throw new Error('Failed to fetch resume');
            }
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
        } catch (error) {
            cvId = '';
            console.error(error);
        }
    } else {
        cvId = '';
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
    let lkdContact = contacts.find(contact => contact.id === '8655');
    let emailValue = emailContact ? emailContact.value : null;
    let lkdValue = lkdContact ? lkdContact.value : null;
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
    // console.log('if candidateId true : ', candidateId);
    if (candidateId) {
        let response = await fetch(`https://crm.ollsent.tech/wp-json/wp/v2/candidate/${candidateId}`, {
            method: 'GET',
            headers: headers
        });
        if (!response.ok) {
            throw new Error('Failed to fetch candidate');
        }
        let responseClone = response.clone();
        candidate = await response.json();
        console.log('candidateId', candidateId);
        let updateResponse = await fetch(`https://crm.ollsent.tech/wp-json/wp/v2/candidate/${candidateId}`, {
            method: 'PUT',
            headers: headers,
            body: JSON.stringify({
                title: lastName,
            })
        });
        console.log('updateResponse', updateResponse);

        if (!updateResponse.ok) {
            throw new Error('Failed to update candidate');
        }
        candidate = await responseClone.json();
        let infoArray = [
            firstName ? '</br><em>' + saveDt + ' - </em> <strong>Додано Ім\'я:</strong>' + firstName + '</strong>' : '',
            lastName ? '</br><em>' + saveDt + ' - </em> <strong>Додано Прізвище:</strong>' + lastName + '</strong>' : '',
            contacts ? '</br><em>' + saveDt + ' - </em> <strong>Додано Контакти:</strong>' + contacts.map(contact => contact.id + ' ' + contact.value + ' ' + contact.kanal_zvyazku).join(', ') + '</strong>' : '',
            emailValue ? '</br><em>' + saveDt + ' - </em> <strong>Додано Email:</strong>' + emailValue + '</strong>' : '',
            lkdValue ? '</br><em>' + saveDt + ' - </em> <strong>Додано LinkedIn:</strong>' + lkdValue + '</strong>' : '',
            imageId ? '</br><em>' + saveDt + ' - </em> <strong>Додано Фото ID:</strong>' + imageId + '</strong>' : '',
            rezume ? '</br><em>' + saveDt + ' - </em> <strong>Додано Резюме ID:</strong>' + rezume + '</strong>' : '',
            saveDate ? '</br><em>' + saveDt + ' - </em> <strong>Додано Дату:</strong>' + saveDate + '</strong>' : '',
            sec1 ? '</br><em>' + saveDt + ' - </em> <strong>Додано Дату початку:</strong>' + sec1 + '</strong>' : '',
            allInfoPar ? '</br><em>' + saveDt + ' - </em> <strong>Додано Інформацію PDF:</strong>' + allInfoPar + '</strong>' : '',
            // userId ? '</br><em>' + saveDt + ' - </em> <strong>Додано User ID:</strong>' + userId + '</strong>' : '',
            cvId ? '</br><em>' + saveDt + ' - </em> <strong>Додано Resume ID:</strong>' + cvId + '</strong>' : '',
            cvComb ? '</br><em>' + saveDt + ' - </em> <strong>Додано Code CV:</strong>' + cvComb + '</strong>' : '',
            profileHTML ? '</br><em>' + saveDt + ' - </em> <strong>Додано Code CV DJ:</strong>' + profileHTML + '</strong>' : '',
            zvidku ? '</br><em>' + saveDt + ' - </em> <strong>Додано Звідки кандидат:</strong>' + zvidku + '</strong>' : ''
        ];

// Удаление пустых строк
        infoArray = infoArray.filter(info => info !== '');

        let additional_info = infoArray.join('');
        // console.log(additional_info);
        let base64Url = authToken.split('.')[1];
        let base64 = base64Url.replace('-', '+').replace('_', '/');
        let payload = JSON.parse(atob(base64));
        let userId = payload.data.user.id;
        response = await fetch(`https://crm.ollsent.tech/wp-json/acf/v3/candidate/${candidate.id}`, {
            method: 'PUT',
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
                    lkd_r: lkdValue,
                    foto_re: imageId,
                    resume_docx: cvId ? cvId : '',
                    dattime: saveDate,
                    dataStart2: sec1,
                    dataStart0: sec1,
                    pdf_parsed: allInfoPar ? allInfoPar : '',
                    user_r: userId,
                    resume_r: cvId ? cvId : '',
                    code_cv: cvComb,
                    code_cv_dj: profileHTML,
                    zvidki_kandidat: zvidku,
                    additional_info: additional_info
                    // resume_r: cvId ? cvId : '',
                    // code_cv: cvComb,
                }
            })
        });
        if (!response.ok) {
            throw new Error('Failed to update ACF fields');
        }
    } else {
        // console.log('if candidateId false : ', candidateId);
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
        candidate = await response.json();
        await new Promise(resolve => setTimeout(resolve, 6000));
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
    let base64Url = authToken.split('.')[1];
    let base64 = base64Url.replace('-', '+').replace('_', '/');
    let payload = JSON.parse(atob(base64));
    let userId = payload.data.user.id;
    let infoArray = [
        firstName ? '</br><em>' + saveDt + ' - </em> <strong>Додано Ім\'я:</strong>' + firstName + '</strong>' : '',
        lastName ? '</br><em>' + saveDt + ' - </em> <strong>Додано Прізвище:</strong>' + lastName + '</strong>' : '',
        contacts ? '</br><em>' + saveDt + ' - </em> <strong>Додано Контакти:</strong>' + contacts.map(contact => contact.id + ' ' + contact.value + ' ' + contact.kanal_zvyazku).join(', ') + '</strong>' : '',
        emailValue ? '</br><em>' + saveDt + ' - </em> <strong>Додано Email:</strong>' + emailValue + '</strong>' : '',
        lkdValue ? '</br><em>' + saveDt + ' - </em> <strong>Додано LinkedIn:</strong>' + lkdValue + '</strong>' : '',
        imageId ? '</br><em>' + saveDt + ' - </em> <strong>Додано Фото ID:</strong>' + imageId + '</strong>' : '',
        rezume ? '</br><em>' + saveDt + ' - </em> <strong>Додано Резюме ID:</strong>' + rezume + '</strong>' : '',
        saveDate ? '</br><em>' + saveDt + ' - </em> <strong>Додано Дату:</strong>' + saveDate + '</strong>' : '',
        sec1 ? '</br><em>' + saveDt + ' - </em> <strong>Додано Дату початку:</strong>' + sec1 + '</strong>' : '',
        allInfoPar ? '</br><em>' + saveDt + ' - </em> <strong>Додано Інформацію PDF:</strong>' + allInfoPar + '</strong>' : '',
        userId ? '</br><em>' + saveDt + ' - </em> <strong>Додано User ID:</strong>' + userId + '</strong>' : '',
        cvId ? '</br><em>' + saveDt + ' - </em> <strong>Додано Resume ID:</strong>' + cvId + '</strong>' : '',
        cvComb ? '</br><em>' + saveDt + ' - </em> <strong>Додано Code CV:</strong>' + cvComb + '</strong>' : '',
        profileHTML ? '</br><em>' + saveDt + ' - </em> <strong>Додано Code CV DJ:</strong>' + profileHTML + '</strong>' : '',
        zvidku ? '</br><em>' + saveDt + ' - </em> <strong>Додано Звідки кандидат:</strong>' + zvidku + '</strong>' : ''
    ];

// Удаление пустых строк
    infoArray = infoArray.filter(info => info !== '');

    let additional_info = infoArray.join('');
    // console.log(additional_info);
    response = await fetch(`https://crm.ollsent.tech/wp-json/acf/v3/candidate/${candidate.id}`, {
        method: 'PUT',
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
                lkd_r: lkdValue,
                foto_re: imageId,
                resume_docx: cvId ? cvId : '',
                dattime: saveDate,
                dataStart2: sec1,
                dataStart0: sec1,
                pdf_parsed: allInfoPar ? allInfoPar : '',
                user_r: userId,
                zvidki_kandidat: zvidku,
                additional_info: additional_info,
                // resume_r: cvId ? cvId : '',
                // code_cv: cvComb,
            }
        })
    });
    if (!response.ok) {
        throw new Error('Failed to update ACF fields');
    }
    return candidate;
}

// async function checkCandidate(lastName, authToken) {
//     let response = await fetch('https://crm.ollsent.tech/wp-json/wp/v2/candidate?search=' + lastName, {
//         method: 'GET',
//         headers: {
//             'Content-Type': 'application/json',
//             'Authorization': 'Bearer ' + authToken
//         },
//     });
//     if (!response.ok) {
//         throw new Error('Failed to check candidate');
//     }
//     // const candidates = await response.json();
//     // return candidates.some(candidate => candidate.title.rendered === lastName);
//     const candidates = await response.json();
//     const foundCandidate = candidates.find(candidate => candidate.title.rendered === lastName);
//     return foundCandidate ? foundCandidate.id : null;
// }
// async function checkCandidate(lastName, emailValue, lkdValue,authToken) {
//     let url = `https://crm.ollsent.tech/wp-json/wp/v2/candidate?search=${lastName}`;
//     if (emailValue) {
//         url += `&email_r=${emailValue}`;
//     } if (lkdValue) {
//         url += `&lkd_r=${lkdValue}`;
//     }
//
//     let response = await fetch(url, {
//         method: 'GET',
//         headers: {
//             'Content-Type': 'application/json',
//             'Authorization': 'Bearer ' + authToken
//         },
//     });
//     console.log(response);
//     if (!response.ok) {
//         throw new Error('Failed to check candidate');
//     }
//     const candidates = await response.json();
//     const foundCandidate = candidates.find(candidate => candidate.title.rendered === lastName);
//     return foundCandidate ? foundCandidate.id : null;
// }
async function checkCandidate(lastName, authToken) {
    let response = await fetch('https://crm.ollsent.tech/wp-json/wp/v2/candidate?search=' + lastName, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + authToken
        },
    });
    if (!response.ok) {
        throw new Error('Failed to check candidate');
    }
    const candidates = await response.json();
    // console.log('candidates: ', candidates);
    const foundCandidate = candidates.find(candidate => {
        // console.log(candidate.acf.id_vac);
        return candidate.title.rendered === lastName && (candidate.acf.lkd_r || candidate.acf.email_r);
    });
    return foundCandidate ? {id: foundCandidate.id, id_vac: foundCandidate.acf.id_vac} : null;
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

function getCurrentUserId(authToken) {
    let base64Url = authToken.split('.')[1];
    let base64 = base64Url.replace('-', '+').replace('_', '/');
    let payload = JSON.parse(atob(base64));
    let userId = payload.data.user.id;
    return userId;
}

// async function checkCandidateId(lastName, authToken, currentUserId) {
//     let response = await fetch('https://crm.ollsent.tech/wp-json/wp/v2/candidate?search=' + lastName, {
//         method: 'GET',
//         headers: {
//             'Content-Type': 'application/json',
//             'Authorization': 'Bearer ' + authToken
//         },
//     });
//     if (!response.ok) {
//         throw new Error('Failed to check candidate');
//     }
//     const candidates = await response.json();
//     const foundCandidate = candidates.find(candidate => candidate.acf.user_r === currentUserId);
//     return !!foundCandidate; // Возвращает true, если кандидат был добавлен текущим пользователем, и false в противном случае
// }
// async function checkCandidateId(lastName, authToken, currentUserId, currentVacId) {
//     let response = await fetch('https://crm.ollsent.tech/wp-json/wp/v2/candidate?search=' + lastName, {
//         method: 'GET',
//         headers: {
//             'Content-Type': 'application/json',
//             'Authorization': 'Bearer ' + authToken
//         },
//     });
//     if (!response.ok) {
//         throw new Error('Failed to check candidate');
//     }
//     const candidates = await response.json();
//     const foundCandidate = candidates.find(candidate => candidate.acf.user_r === currentUserId);
//     const isCandidateOnCurrentVacancy = candidates.some(candidate => candidate.acf.id_vac === currentVacId && candidate.acf.id_vac !== '0');
//     console.log('isCandidateOnCurrentVacancy', isCandidateOnCurrentVacancy);
//     return {
//         isAddedByCurrentUser: !!foundCandidate, // Возвращает true, если кандидат был добавлен текущим пользователем, и false в противном случае
//         isOnCurrentVacancy: isCandidateOnCurrentVacancy // Возвращает true, если кандидат уже на текущей вакансии, и false в противном случае
//     };
// }
// async function checkCandidateId(lastName, authToken, currentUserId, currentVacId) {
//     let response = await fetch('https://crm.ollsent.tech/wp-json/wp/v2/candidate?search=' + lastName, {
//         method: 'GET',
//         headers: {
//             'Content-Type': 'application/json',
//             'Authorization': 'Bearer ' + authToken
//         },
//     });
//     if (!response.ok) {
//         throw new Error('Failed to check candidate');
//     }
//     const candidates = await response.json();
//     const foundCandidate = candidates.find(candidate => {
//         const isAddedByCurrentUser = candidate.acf.user_r === currentUserId;
//         // const isOnCurrentVacancy = candidates.some(candidate => candidate.acf.id_vac === currentVacId && candidate.acf.id_vac !== '0');
//         const isOnCurrentVacancy = candidate.acf.id_vac === currentVacId;
//         console.log('candidate.acf.user_r',candidate.acf.user_r);
//         console.log('currentUserId',currentUserId);
//         console.log('candidate.acf.id_vac',candidate.acf.id_vac);
//         console.log('currentVacId',currentVacId);
//         return isAddedByCurrentUser || isOnCurrentVacancy;
//     });
//
//     return {
//         isAddedByCurrentUser: foundCandidate ? foundCandidate.acf.user_r === currentUserId : false,
//         isOnCurrentVacancy: foundCandidate ? foundCandidate.acf.id_vac === currentVacId : false
//     };
// }
async function checkCandidateId(lastName, authToken, currentUserId, currentVacId) {
    let response = await fetch('https://crm.ollsent.tech/wp-json/wp/v2/candidate?search=' + lastName, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + authToken
        },
    });
    if (!response.ok) {
        throw new Error('Failed to check candidate');
    }
    const candidates = await response.json();
    const foundCandidate = candidates.find(candidate => {
        const isAddedByCurrentUser = candidate.acf.user_r === currentUserId;
        const isOnCurrentVacancy = currentVacId === 0 || candidate.acf.id_vac === "0" || candidate.acf.id_vac === currentVacId;
        // console.log('candidate.acf.user_r',candidate.acf.user_r);
        // console.log('currentUserId',currentUserId);
        // console.log('candidate.acf.id_vac',candidate.acf.id_vac);
        // console.log('currentVacId',currentVacId);
        return isAddedByCurrentUser || isOnCurrentVacancy;
    });

    return {
        isAddedByCurrentUser: foundCandidate ? foundCandidate.acf.user_r === currentUserId : false,
        isOnCurrentVacancy: foundCandidate ? (foundCandidate.acf.id_vac === currentVacId || currentVacId === 0 || foundCandidate.acf.id_vac === "0") : false
    };
}
async function getCandidateSalary(lastName, authToken) {
    let response = await fetch('https://crm.ollsent.tech/wp-json/wp/v2/candidate?search=' + lastName, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + authToken
        },
    });
    if (!response.ok) {
        throw new Error('Failed to check candidate');
    }
    const candidates = await response.json();
    const foundCandidate = candidates.find(candidate => candidate.title.rendered.toLowerCase() === lastName.toLowerCase());
    // console.log(foundCandidate.acf);
    return {
        foundCand: foundCandidate ? foundCandidate.acf.zarplata : null,
        foundCandidatez: foundCandidate ? foundCandidate.acf.exp_r : null,
        mova: foundCandidate ? foundCandidate.acf.mova_p : null,
        kontakti22: foundCandidate ? foundCandidate.acf.kontakti22 : null
    };
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

// let isLinkedInReloaded = false;
// let currentProfile = null;

chrome.tabs.onUpdated.addListener(function (tabId, changeInfo, tab) {
    if (changeInfo.status === 'complete' && /^http/.test(tab.url)) {
        chrome.tabs.sendMessage(tabId, {
            action: 'updateColor',
            url: tab.url
        })
    }
    // if (changeInfo.url && changeInfo.url.includes('https://www.linkedin.com/in/')) {
    //     const checkInterval = setInterval(() => {
    //         chrome.tabs.get(tabId, function (tab) {
    //             if (tab.status === "complete") {
    //                 console.log("Страница полностью загружена!");
    //                 clearInterval(checkInterval);
    //                 const profile = changeInfo.url.split('/')[4];
    //                 console.log(profile);
    //                 console.log(currentProfile);
    //                 console.log(changeInfo);
    //                 console.log(tabId);
    //
    //                 if (profile !== currentProfile) {
    //                     currentProfile = profile;
    //                     console.log('currentProfile: ', currentProfile);
    //                     chrome.runtime.reload();
    //                 }
    //             }
    //         });
    //     }, 100);
    // }

    // if (tab.url && isCandidatePage(tab.url) && !/\/contact-info\/$/.test(tab.url)) {
    //     console.log("Обновление данных расширения");
    //     updateExtensionData(tabId);
    // }
    // function isCandidatePage(url) {
    //     return url.includes("linkedin.com") ||
    //         url.includes("work.ua") ||
    //         url.includes("rabota.ua") ||
    //         url.includes("robota.ua") ||
    //         url.includes("djinni.co");
    // }
    //
    // async function updateExtensionData(tabId) {
    //     await chrome.tabs.sendMessage(tabId, { action: 'updateExtensionData' });
    //     console.log("Обновление данных расширения на странице кандидата");
    //     chrome.tabs.reload(tabId);
    // }
});


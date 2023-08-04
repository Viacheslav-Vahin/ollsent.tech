document.addEventListener('DOMContentLoaded', function () {

    document.getElementById('loginButton').addEventListener('click', function () {
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        localStorage.setItem('username', username);
        localStorage.setItem('password', password);
        chrome.runtime.sendMessage({action: 'login', username: username, password: password});
        setTimeout(function () {
            chrome.storage.local.get(['username'], function (result) {
            console.log(result);
            if (result.username) {
                document.getElementById('usernameDisplay').textContent = result.username;
                document.getElementById('loginOk').style.display = 'block';
                document.getElementById('loginForm').style.display = 'none';
                document.getElementById('errorMessage').style.display = 'none';
            } else {
                document.getElementById('errorMessage').style.display = 'block';
            }
        });
        },1000);
    });

    document.getElementById('logoutButton').addEventListener('click', function () {
        chrome.storage.local.get(['username'], function (result) {
            document.getElementById('loginOk').style.display = 'none';
            document.getElementById('loginForm').style.display = 'block';
            // localStorage.removeItem('username');
            // localStorage.removeItem('password');
            chrome.storage.local.remove(['username']);
            chrome.storage.local.remove(['password']);
        });
        chrome.runtime.sendMessage({action: 'logout'});
    });

    window.onload = function () {
        var username = localStorage.getItem('username');
        var password = localStorage.getItem('password');
        if (username && password) {
            document.getElementById('username').value = username;
            document.getElementById('password').value = password;
        }
        chrome.storage.local.get(['username'], function (result) {
            if (result.username) {
                // Выводим имя пользователя
                document.getElementById('usernameDisplay').textContent = result.username;
                document.getElementById('loginOk').style.display = 'block';
                document.getElementById('loginForm').style.display = 'none';
            } else {
                document.getElementById('loginOk').style.display = 'none';
                document.getElementById('loginForm').style.display = 'block';
            }
        });
    };

});

// chrome.runtime.onMessage.addListener(function (message, sender, sendResponse) {
//     console.log(message.action);
//     if (message.action === 'loginResult') {
//         if (message.userId) {
//             console.log(message.userId);
//         } else {
//             console.error('Login failed:', message.error);
//         }
//     }
// });

// chrome.runtime.onMessage.addListener(function (message, sender, sendResponse) {
//     console.log(message.action);
//     if (message.action === 'loginResult') {
//         console.log('message in loginResult');
//         if (message.success) {
//             console.log('Login successful');
//             document.getElementById('usernameDisplay').textContent = localStorage.getItem('username');
//             document.getElementById('loginOk').style.display = 'block';
//             document.getElementById('loginForm').style.display = 'none';
//         } else {
//             console.error('Login failed:', message.message);
//             document.getElementById('errorMessage').textContent = message.message;
//             document.getElementById('errorMessage').style.display = 'block';
//         }
//     }
// });


// let globalContacts = null;
//
// // Когда попап открывается
// window.addEventListener('load', (event) => {
//     chrome.tabs.query({active: true, currentWindow: true}, function(tabs) {
//         chrome.tabs.sendMessage(tabs[0].id, {action: 'popupOpened'});
//     });
// });
//
//
// document.addEventListener('DOMContentLoaded', function() {
//     chrome.runtime.sendMessage({ action: 'fetchContacts' }, function(response) {
//         if (chrome.runtime.lastError) {
//             console.error(chrome.runtime.lastError);
//         } else {
//             globalContacts = response.contacts;
//             createFieldGroup(response.contacts);
//             createUserFieldGroup();
//         }
//     });
//     createToggleSwitchers();
//     showZarplata();
//     showLanguageLevels();
//     showExpLevel();
//     showAdditionalInfo();
//
//     var addButton = document.getElementById('add-button');
//     addButton.addEventListener('click', function() {
//         createUserFieldGroup();
//     });
//
//     chrome.runtime.sendMessage({ action: 'fetchLanguages' }, function(response) {
//         if (chrome.runtime.lastError) {
//             console.error(chrome.runtime.lastError);
//         } else {
//             showPopupWithPosts(response.posts);
//         }
//     });
//     chrome.runtime.sendMessage({ action: 'fetchNoit' }, function(response) {
//         if (chrome.runtime.lastError) {
//             console.error(chrome.runtime.lastError);
//         } else {
//             showPopupWithNoitPosts(response.posts);
//         }
//     });
//     chrome.runtime.sendMessage({ action: 'fetchLanguageTypes' }, function(response) {
//         if (chrome.runtime.lastError) {
//             console.error(chrome.runtime.lastError);
//         } else {
//             showLanguageTypes(response.posts);
//         }
//     });
//     chrome.runtime.sendMessage({ action: 'showLanguageLevels' }, function() {
//         if (chrome.runtime.lastError) {
//             console.error(chrome.runtime.lastError);
//         } else {
//             showLanguageLevels();
//         }
//     });
//     chrome.runtime.sendMessage({ action: 'showAdditionalInfo' }, function() {
//         if (chrome.runtime.lastError) {
//             console.error(chrome.runtime.lastError);
//         } else {
//             showAdditionalInfo();
//         }
//     });
//     chrome.runtime.sendMessage({ action: 'showRegion' }, function(response) {
//         if (chrome.runtime.lastError) {
//             console.error(chrome.runtime.lastError);
//         } else {
//             showRegion(response.posts);
//         }
//     });
//     chrome.runtime.sendMessage({ action: 'showVac' }, function(response) {
//         if (chrome.runtime.lastError) {
//             console.error(chrome.runtime.lastError);
//         } else {
//             showVacancy(response.posts);
//         }
//     });
//     $(document).on('change', '#vac-select', function (e) {
//         let selectedVacId = Array.from(this.selectedOptions).map(option => option.value);
//         let numVacId = Number(selectedVacId[0]);
//         chrome.runtime.sendMessage({ action: 'saveVacancyId', vacancyId: numVacId });
//         chrome.runtime.sendMessage({ action: 'showVacStage' }, function(response) {
//             if (chrome.runtime.lastError) {
//                 console.error(chrome.runtime.lastError);
//             } else {
//                 showVacancyStage(response.posts);
//             }
//         });
//     });
//
//     chrome.runtime.sendMessage({ action: 'showTags' }, function(response) {
//         if (chrome.runtime.lastError) {
//             console.error(chrome.runtime.lastError);
//         } else {
//             showTags(response.posts);
//         }
//     });
//
//     var saveButton = document.getElementById('save-button');
//     saveButton.addEventListener('click', function() {
//         let contactFields = Array.from(document.querySelectorAll('.contact-field-group'));
//         let contacts = contactFields.map(field => {
//             return {
//                 id: field.querySelector('select').value,
//                 value: field.querySelector('input').value,
//                 kanal_zvyazku: field.querySelector('input[type="checkbox"]').checked
//             };
//         });
//         chrome.tabs.query({ active: true, currentWindow: true }, function(tabs) {
//             chrome.tabs.sendMessage(tabs[0].id, {action: 'saveCandidate'}, function (response) {
//                 if (chrome.runtime.lastError) {
//                     console.error(chrome.runtime.lastError);
//                 } else {
//                     let select = document.getElementById('language-select');
//                     let selectNoit = document.getElementById('noit-select');
//                     let selectMova = document.getElementById('mova-select');
//                     let selectReg = document.getElementById('reg-select');
//                     let selectVac = document.getElementById('vac-select');
//                     let selectVacStage = document.getElementById('stage-select');
//                     let selectTag = document.getElementById('tags-select');
//                     let selectAdditional = document.getElementById('additional-info').value;
//                     let selectEngLevels = document.getElementById('language-level-select').value;
//                     let selectExpRange = document.getElementById('exp-range').value;
//
//                     let selectedPositionId = Array.from(select.selectedOptions).map(option => option.value);
//                     let selectedPositionNoitId = Array.from(selectNoit.selectedOptions).map(option => option.value);
//                     let selectedMovaId = Array.from(selectMova.selectedOptions).map(option => option.value);
//                     let selectedRegId = Array.from(selectReg.selectedOptions).map(option => option.value);
//                     let selectedVacId = Array.from(selectVac.selectedOptions).map(option => option.value);
//                     let numVacId = Number(selectedVacId[0]);
//                     let selectedVacStageId = [];
//                     let valVacStageId ='';
//                     if(selectVacStage) {
//                         selectedVacStageId = Array.from(selectVacStage.selectedOptions).map(option => option.value);
//                         valVacStageId = selectedVacStageId[0].toString();
//                     }
//                     let selectedTagId = Array.from(selectTag.selectedOptions).map(option => option.value);
//                     let zarplataInput = document.getElementById('zarp');
//                     let zarplataValue = '';
//                     if (zarplataInput) {
//                         zarplataValue = zarplataInput.value;
//                     }
//                     chrome.runtime.sendMessage({
//                         ...response,
//                         positionId: selectedPositionId,
//                         positionNoitId: selectedPositionNoitId,
//                         mova: selectedMovaId,
//                         city: selectedRegId,
//                         vacid: numVacId,
//                         candidate_st: valVacStageId,
//                         tag: selectedTagId,
//                         adinf: selectAdditional,
//                         engl: selectEngLevels,
//                         exp: selectExpRange,
//                         zarplata: zarplataValue,
//                         contacts: contacts,
//                         action: 'saveCandidate'
//                     }, function (response) {
//                         if (chrome.runtime.lastError) {
//                             console.error(chrome.runtime.lastError);
//                         } else {
//                         }
//                     });
//                 }
//             });
//             chrome.runtime.sendMessage({action: 'fetchLanguageTypes'}, response => {
//                 if (chrome.runtime.lastError) {
//                     console.error(chrome.runtime.lastError);
//                 } else {
//                     let selectMova = document.getElementById('mova-select');
//                     if (selectMova) {
//                         let selectedMovaId = selectMova.value;
//                         chrome.runtime.sendMessage({ ...response, mova:selectedMovaId, action: 'fetchLanguageTypes' }, function(response) {
//                             if (chrome.runtime.lastError) {
//                                 console.error(chrome.runtime.lastError);
//                             } else {
//                             }
//                         });
//                     } else {
//                         console.error('Language select element not found');
//                     }
//                 }
//             });
//         });
//     });
//
//     $('select').on('select2:select', function (e) {
//         var selectedOptions = $(this).val();  // Получаем массив выбранных значений
//         if (selectedOptions.length > 1 && selectedOptions.includes('all')) {
//             var index = selectedOptions.indexOf('all');
//             if (index > -1) {
//                 selectedOptions.splice(index, 1);
//             }
//             $(this).val(selectedOptions).trigger('change');
//         }
//     });
//     $(document).on('mousedown', function (e) {
//         var opened = $(".select2-container--open");
//         if (opened.length > 0) {
//             var inContainer = opened.has(e.target).length > 0;
//             var isContainer = opened.is(e.target);
//
//             if (!inContainer && !isContainer) {
//                 var instances = $.fn.select2.amd.require('select2/dropdown/closeOnSelect');
//                 instances.close();
//             }
//         }
//     });
// });
// function createToggleSwitchers() {
//     let buttonPosts = document.createElement('button');
//     buttonPosts.id = 'button-posts';
//     buttonPosts.innerText = 'ІТ';
//     let buttonNoitPosts = document.createElement('button');
//     buttonNoitPosts.id = 'button-noitposts';
//     buttonNoitPosts.innerText = 'Інше';
//     buttonPosts.addEventListener('click', function() {
//         document.getElementById('pop-noit').style.display = 'none'; // скрыть NoitPosts
//         document.getElementById('pop-prof').style.display = 'block'; // показать Posts
//     });
//     buttonNoitPosts.addEventListener('click', function() {
//         document.getElementById('pop-prof').style.display = 'none'; // скрыть Posts
//         document.getElementById('pop-noit').style.display = 'block'; // показать NoitPosts
//     });
//     let popup = document.getElementById('toogler'); // замените 'popup' на ID вашего попапа
//     popup.appendChild(buttonPosts);
//     popup.appendChild(buttonNoitPosts);
// }
// function showPopupWithPosts(posts) {
//     let select = document.createElement('select');
//     select.id = 'language-select';
//     select.setAttribute('multiple', 'multiple');  // Добавьте эту строку, чтобы сделать Select2 мультиселектом
//     posts.forEach(post => {
//         let option = document.createElement('option');
//         option.value = post.id;
//         option.text = post.title.rendered;
//         select.appendChild(option);
//     });
//     let popup = document.getElementById('pop-prof');
//     popup.appendChild(select);
//     $('#language-select').select2({
//         closeOnSelect: false,
//     });
//     document.getElementById('pop-prof').style.display = 'block';
// }
// function showPopupWithNoitPosts(posts) {
//     let select = document.createElement('select');
//     select.id = 'noit-select';
//     select.setAttribute('multiple', 'multiple');  // Добавьте эту строку, чтобы сделать Select2 мультиселектом
//     posts.forEach(post => {
//         let option = document.createElement('option');
//         option.value = post.id;
//         option.text = post.title.rendered;
//         select.appendChild(option);
//     });
//     let popup = document.getElementById('pop-noit');
//     popup.appendChild(select);
//     $('#noit-select').select2({
//         closeOnSelect: false,
//     });
//     document.getElementById('pop-noit').style.display = 'none';
// }
// function showZarplata() {
//     let zarplataInput = document.createElement('input');
//     zarplataInput.id = 'zarp';
//     let popup = document.getElementById('pop-zp');
//     popup.appendChild(zarplataInput);
// }
//
// function showLanguageTypes(posts) {
//     let select = document.createElement('select');
//     select.id = 'mova-select';
//     select.setAttribute('multiple', 'multiple');  // Добавьте эту строку, чтобы сделать Select2 мультиселектом
//     posts.forEach(post => {
//         let option = document.createElement('option');
//         option.value = post.id;
//         option.text = post.title.rendered;
//         select.appendChild(option);
//     });
//     let popup = document.getElementById('pop-mova');
//     popup.appendChild(select);
//     $('#mova-select').select2({
//         closeOnSelect: false,
//     });
// }
// function showRegion(posts) {
//     let select = document.createElement('select');
//     select.id = 'reg-select';
//     select.setAttribute('multiple', 'multiple');  // Добавьте эту строку, чтобы сделать Select2 мультиселектом
//     posts.forEach(post => {
//         let option = document.createElement('option');
//         option.value = post.id;
//         option.text = post.title.rendered;
//         select.appendChild(option);
//     });
//     let popup = document.getElementById('region');
//     popup.appendChild(select);
//     $('#reg-select').select2({
//         closeOnSelect: false,
//     });
// }
// function showVacancy(posts) {
//     let select = document.createElement('select');
//     select.id = 'vac-select';
//     posts.forEach(post => {
//         let option = document.createElement('option');
//         option.value = post.id;
//         option.text = post.title.rendered;
//         select.appendChild(option);
//     });
//     let popup = document.getElementById('vacancy');
//     popup.appendChild(select);
//     $('#vac-select').select2({
//         closeOnSelect: true,
//     });
// }
// function showVacancyStage(posts) {
//     let popup = document.getElementById('stage');
//     popup.innerHTML = '';  // Clear the popup's content before appending the new select
//     let select = document.createElement('select');
//     let textStage = document.createElement('h3');
//     textStage.innerText = 'Етапи'; // use innerText or textContent here
//     select.id = 'stage-select';
//     posts.forEach(post => {
//         let option = document.createElement('option');
//         option.value = post;
//         option.text = post;
//         select.appendChild(option);
//     });
//     popup.appendChild(textStage);
//     popup.appendChild(select);
//     $('#stage-select').select2({
//         closeOnSelect: true,
//     });
// }
//
// function showTags(posts) {
//     let select = document.createElement('select');
//     select.id = 'tags-select';
//     select.setAttribute('multiple', 'multiple');  // Добавьте эту строку, чтобы сделать Select2 мультиселектом
//     posts.forEach(post => {
//         let option = document.createElement('option');
//         option.value = post.id;
//         option.text = post.title.rendered;
//         select.appendChild(option);
//     });
//     let popup = document.getElementById('tags');
//     popup.appendChild(select);
//     $('#tags-select').select2({
//         closeOnSelect: false,
//     });
// }
// function createFieldGroup(contacts) {
//     contacts = contacts || [];
//     if (Array.isArray(contacts)) {
//         for (let contact of contacts) {
//             let fieldGroup = document.createElement('div');
//             fieldGroup.className = 'contact-field-group';
//             let selectElement = document.createElement('select');
//             let inputElement = document.createElement('input');
//             let checkboxElement = document.createElement('input');
//             checkboxElement.type = 'checkbox';
//             checkboxElement.name = 'kanal_zvyazku';
//             checkboxElement.id = 'kanal_zvyazku';
//             for (let optionContact of contacts) {
//                 let selectOption = document.createElement('option');
//                 selectOption.value = optionContact.id;
//                 selectOption.text = optionContact.type;
//                 if (optionContact.id === contact.id) {
//                     selectOption.selected = true;
//                 }
//                 selectElement.add(selectOption);
//             }
//             let contactValue = contact.value ? contact.value.replace('mailto:', '') : "";
//             inputElement.value = contactValue;
//             fieldGroup.appendChild(selectElement);
//             fieldGroup.appendChild(inputElement);
//             fieldGroup.appendChild(checkboxElement);
//             let popup = document.getElementById('contacts');
//             popup.appendChild(fieldGroup);
//         }
//     } else {
//         console.error('Contacts is not an array:', contacts);
//     }
// }
// function createUserFieldGroup() {
//     let fieldGroup = document.createElement('div');
//     fieldGroup.className = 'contact-field-group';
//     let selectElement = document.createElement('select');
//     let inputElement = document.createElement('input');
//     let checkboxElement = document.createElement('input');
//     checkboxElement.type = 'checkbox';
//     checkboxElement.name = 'kanal_zvyazku';
//     checkboxElement.id = 'kanal_zvyazku';
//     for (let contact of globalContacts) {
//         let selectOption = document.createElement('option');
//         selectOption.value = contact.id;
//         selectOption.text = contact.title.rendered;
//         selectElement.add(selectOption);
//     }
//     fieldGroup.appendChild(selectElement);
//     fieldGroup.appendChild(inputElement);
//     fieldGroup.appendChild(checkboxElement);
//     let popup = document.getElementById('contacts');
//     popup.appendChild(fieldGroup);
// }
// function showLanguageLevels() {
//     let select = document.createElement('select');
//     select.id = 'language-level-select';
//     let languageLevels = {
//         "1": "Beginner / Elementary (A1)",
//         "2": "Pre-intermediate (A2)",
//         "3": "Intermediate (B1)",
//         "4": "Upper-intermediate (B2)",
//         "5": "Advanced (C1)",
//         "6": "Fluent (C2)"
//     };
//     for (let key in languageLevels) {
//         let option = document.createElement('option');
//         option.value = key;
//         option.text = languageLevels[key];
//         select.appendChild(option);
//     }
//     let popup = document.getElementById('pop-mova-r');
//     popup.appendChild(select);
// }
// function showAdditionalInfo() {
//     let tinput = document.createElement('textarea');
//     tinput.id = 'additional-info';
//     let popup = document.getElementById('comments');
//     popup.appendChild(tinput);
// }
// function showExpLevel() {
//     let rangeInput = document.createElement('input');
//     rangeInput.id = 'exp-range';
//     rangeInput.type = 'range';
//     rangeInput.min = 0;
//     rangeInput.max = 15;
//     rangeInput.step = 0.5;
//     let rangeValueInput = document.createElement('input');
//     rangeValueInput.id = 'exp-range-value';
//     rangeValueInput.type = 'number';
//     rangeValueInput.readOnly = true; // чтобы пользователь не мог изменить его вручную
//     rangeValueInput.value = rangeInput.value;
//     rangeInput.addEventListener('input', function() {
//         let expValue = this.value;
//         rangeValueInput.value = expValue; // обновляем значение индикатора
//     });
//     let popup = document.getElementById('pop-dos');
//     popup.appendChild(rangeInput);
//     popup.appendChild(rangeValueInput);
// }
// chrome.runtime.onMessage.addListener(function(message, sender, sendResponse) {
//     // if (message.action === 'checkCandidate') {
//     //     let popupWindow = document.querySelector('body');
//     //     if (message) {
//     //         popupWindow.style.border = '3px solid red';
//     //     } else {
//     //         popupWindow.style.border = '3px solid green';
//     //     }
//     // }
//     if (message.action === 'updateContactInfo') {
//         createFieldGroup(message.contacts);
//
//         // // Восстановите значения полей при загрузке страницы
//         // chrome.storage.local.get(['formValues'], function(result) {
//         //     if (result.formValues) {
//         //         document.getElementById('vac-select').value = result.formValues.vacancy;
//         //         document.getElementById('stage-select').value = result.formValues.stage;
//         //         document.getElementById('language-select').value = result.formValues.it;
//         //         document.getElementById('noit-select').value = result.formValues.noit;
//         //     }
//         // });
//         //
//         // document.addEventListener("DOMContentLoaded", function() {
//         // // Сохраните значения полей при нажатии кнопки "Save"
//         // document.getElementById('vacancy-input').addEventListener('change', saveValues);
//         // document.getElementById('stage-select').addEventListener('change', saveValues);
//         // document.getElementById('language-select').addEventListener('change', saveValues);
//         // document.getElementById('noit-select').addEventListener('change', saveValues);
//         //
//         // function saveValues() {
//         //     let formValues = {
//         //         vacancy: document.getElementById('vacancy-input').value,
//         //         stage: document.getElementById('stage-select').value,
//         //         it: document.getElementById('language-select').value,
//         //         noit: document.getElementById('noit-select').value,
//         //     };
//         //
//         //     chrome.storage.local.set({formValues}, function() {
//         //         console.log('Values are stored.');
//         //     });
//         // }
//         // });
//     }
// });

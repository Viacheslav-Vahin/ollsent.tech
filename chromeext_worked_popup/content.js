// let btn = document.createElement("div");
// btn.id = 'mainBtn';
// btn.style.width = "75px";
// btn.style.height = "75px";
// btn.style.position = "fixed";
// btn.style.left = "10px";
// btn.style.top = "10px";
// btn.style.borderRadius = "50%";
// btn.style.backgroundColor = "green";
// btn.style.cursor = "pointer";
// btn.style.zIndex = "999999"; // чтобы кнопка была поверх других элементов
// // btn.onclick = function() {
// //     // здесь код для открытия попапа
// //     chrome.runtime.sendMessage({action: "open_popup"});
// // };
// document.body.appendChild(btn);
// // Функция для добавления попапа на страницу
// function addPopupToPage(html) {
//     let popupWrapper = document.createElement('div');
//     popupWrapper.innerHTML = html;
//     popupWrapper.style.display = 'none'; // По умолчанию попап скрыт
//     popupWrapper.style.position = 'fixed'; // Позиционирование попапа
//     popupWrapper.style.backgroundColor = "white";
//     popupWrapper.style.padding = "15px";
//     popupWrapper.style.top = '150px';
//     popupWrapper.style.left = '25px';
//     popupWrapper.style.zIndex = '10000'; // Чтобы попап был поверх остального контента
//     document.body.appendChild(popupWrapper);
//
//     return popupWrapper;
// }
//
// // Загрузка HTML попапа
// chrome.runtime.sendMessage({action: "get_popup_html"}, response => {
//     let popupWrapper = addPopupToPage(response.html);
//     // При клике на кнопку показываем или скрываем попап
//     btn.onclick = function() {
//         if (popupWrapper.style.display === 'none') {
//             popupWrapper.style.display = 'block';
//         } else {
//             popupWrapper.style.display = 'none';
//         }
//     };
// });

let contactInfoFetched = false;
let currentURL = window.location.href;
function getFullName() {
    let fullNameElement;
    let firstName = '';
    let lastName = '';

    if (currentURL.includes('linkedin.com')) {
        fullNameElement = document.querySelector('.pv-text-details__left-panel h1');
        if (fullNameElement) {
            let fullName = fullNameElement.innerText;
            let names = fullName.split(' ');
            firstName = names.shift();
            lastName = names.join(' ');
        }
    } else if (currentURL.includes('work.ua')) {
        fullNameElement = document.querySelector('.add-top-xs');
        if (fullNameElement) {
            let fullName = fullNameElement.innerText;
            let names = fullName.split(' ');
            firstName = names.shift();
            lastName = names.join(' ');
        }
    } else if (currentURL.includes('robota.ua')) {
        fullNameElement = document.querySelector('.main-info-wrapper .santa-block.santa-top-0.santa-sticky .resume-main-wrapper.ng-star-inserted .santa-flex.santa-items-stretch h1 p.copy-wrap');
        if (fullNameElement) {
            let fullName = fullNameElement.innerText;
            let names = fullName.split(' ');
            firstName = names.shift();
            lastName = names.join(' ');
        }
    } else if (currentURL.includes('djinni.co')) {
        fullNameElement = document.querySelector('#candidate_name');
        if (fullNameElement) {
            let fullName = fullNameElement.innerText;
            let names = fullName.split(' ');
            firstName = names.shift();
            lastName = names.join(' ');
        }
    }

    return { firstName, lastName };
}
function getFullNameParse() {
    let element = '';
    if (currentURL.includes('linkedin.com')) {
        element = document.querySelector('.pv-text-details__left-panel h1');
    }
    // else if (currentURL.includes('djinni.co')) {
    //     element = document.querySelector('#candidate_name');
    // }
    return element ? element.innerText : '';
}
function getEmail() {
    let element = document.querySelector('.pv-contact-info__contact-link[href*="mailto:"]');
    return element ? element.innerText : '';
}
function getLinkedin() {
    let element = '';
    if (currentURL.includes('linkedin.com')) {
        element = document.querySelector('.pv-contact-info__contact-link[href*="linkedin.com"]');
    }
    // else if (currentURL.includes('djinni.co')) {
    //     element = document.querySelector('.inbox-candidate-details--item a[href*="linkedin.com"]');
    // }
    return element ? element.innerText : '';
}
function getPosition() {
    let element = '';
    if (currentURL.includes('linkedin.com')) {
        element = document.querySelector('.pv-text-details__left-panel:not(.mt2) .text-body-medium.break-words');
    } else if (currentURL.includes('work.ua')) {
        element = document.querySelector('.col-sm-8 h2');
    }
    // else if (currentURL.includes('djinni.co')) {
    //     let elementsm = document.querySelector('h5.inbox-candidate-details--title');
    //     if (elementsm) {
    //         let elements = elementsm.innerText.split(',');
    //         element = elements[0];
    //     }
    // }
    return element ? element.innerText : '';
}

function getCountry() {
    let element = document.querySelector('.pv-text-details__left-panel.mt2 .text-body-small.inline.t-black--light.break-words');
    return element ? element.innerText : '';
}
function getGeneralInfo() {
    let element = document.querySelector('.display-flex.ph5.pv3 .pv-shared-text-with-see-more .visually-hidden');
    return element ? element.innerText : '';
}
function aboutInfo() {
    let aboutDiv = document.getElementById('about');
    let textArray = '';
    if (aboutDiv) {
        let nextDiv = aboutDiv.nextElementSibling;
        let nextNextDiv = nextDiv.nextElementSibling;
        if (nextNextDiv) {
            let elements = nextNextDiv.querySelectorAll('.display-flex.full-width .visually-hidden');
            textArray = elements.innerText;
        } else {
            return "No next sibling found";
        }
    } else {
        textArray = '';
    }
    return textArray;
}
function extractTextWithNewLines(element) {
    let text = '';
    for (let child of element.childNodes) {
        if (child.nodeType === Node.TEXT_NODE) {
            text += child.textContent;
        } else if (child.nodeType === Node.ELEMENT_NODE && child.classList && !child.classList.contains('visually-hidden')) {
            text += extractTextWithNewLines(child);
        }
    }
    return text.replace(/\s\s+/g, ' ').trim() + '\n';
}

function getExperience() {
    if (currentURL.includes('linkedin.com')) {
        let experienceDiv = document.getElementById('experience');
        if (experienceDiv) {
            let nextDiv = experienceDiv.nextElementSibling;
            let nextNextDiv = nextDiv.nextElementSibling;
            if (nextNextDiv) {
                let textArray2 = [];
                let parentElements = nextNextDiv.querySelectorAll('.pvs-list__outer-container .pvs-list .artdeco-list__item.pvs-list__item--line-separated.pvs-list__item--one-column .pvs-entity.pvs-entity--padded.pvs-list__item--no-padding-in-columns .display-flex.flex-column.full-width.align-self-center .display-flex.flex-row.justify-space-between .display-flex.flex-column.full-width');
                for(let parentElement of parentElements) {
                    let text = extractTextWithNewLines(parentElement);
                    textArray2.push(text);
                }
                return textArray2.join('\n');
            } else {
                return "No next sibling found";
            }
        }
    }
    else if (currentURL.includes('robota.ua')) {
        let elements = document.querySelector('.santa-flex-grow.santa-h-full');
        let textArray = elements.innerText;
        return textArray;
    }
}
function getEducation() {
    if (currentURL.includes('linkedin.com')) {
        let experienceDiv = document.getElementById('education');
        if (experienceDiv) {
            let nextDiv = experienceDiv.nextElementSibling;
            let nextNextDiv = nextDiv.nextElementSibling;
            if (nextNextDiv) {
                let textArray2 = [];
                let parentElements = nextNextDiv.querySelectorAll('.pvs-list__outer-container .pvs-list .artdeco-list__item.pvs-list__item--line-separated.pvs-list__item--one-column .pvs-entity.pvs-entity--padded.pvs-list__item--no-padding-in-columns .display-flex.flex-column.full-width.align-self-center .display-flex.flex-row.justify-space-between a.display-flex.flex-column.full-width');
                for(let parentElement of parentElements) {
                    let text = extractTextWithNewLines(parentElement);
                    textArray2.push(text);
                }
                return textArray2.join('\n');
            } else {
                return "No next sibling found";
            }
        }
    }
}
function getProjects() {
    if (currentURL.includes('linkedin.com')) {
        let experienceDiv = document.getElementById('education');
        if (experienceDiv) {
            let nextDiv = experienceDiv.nextElementSibling;
            let nextNextDiv = nextDiv.nextElementSibling;
            if (nextNextDiv) {
                let textArray2 = [];
                let parentElements = nextNextDiv.querySelectorAll('.pvs-list__outer-container .pvs-list .artdeco-list__item.pvs-list__item--line-separated.pvs-list__item--one-column .pvs-entity.pvs-entity--padded.pvs-list__item--no-padding-in-columns .display-flex.flex-column.full-width.align-self-center');
                for(let parentElement of parentElements) {
                    let text = extractTextWithNewLines(parentElement);
                    textArray2.push(text);
                }
                return textArray2.join('\n');
            } else {
                return "No next sibling found";
            }
        }
    }
}
function getLdlanguages() {
    if (currentURL.includes('linkedin.com')) {
        let experienceDiv = document.getElementById('languages');
        if (experienceDiv) {
            let nextDiv = experienceDiv.nextElementSibling;
            let nextNextDiv = nextDiv.nextElementSibling;
            if (nextNextDiv) {
                let textArray2 = [];
                let parentElements = nextNextDiv.querySelectorAll('.pvs-list__outer-container .pvs-list .artdeco-list__item.pvs-list__item--line-separated.pvs-list__item--one-column .pvs-entity.pvs-entity--padded.pvs-list__item--no-padding-in-columns .display-flex.flex-column.full-width.align-self-center .display-flex.flex-column.full-width\n');
                for(let parentElement of parentElements) {
                    let text = extractTextWithNewLines(parentElement);
                    textArray2.push(text);
                }
                return textArray2.join('\n');
            } else {
                return "No next sibling found";
            }
        }
    }
}
function cvFile() {
    let textArray = '';
    if (currentURL.includes('linkedin.com')) {
        let fullName = getFullNameParse();
        let email = getEmail();
        let linkedin = getLinkedin();
        let position = getPosition();
        let country = getCountry();
        let generalInfo = getGeneralInfo();
        let aboutinfo = aboutInfo();
        let experience = getExperience();
        let education = getEducation();
        let projects = getProjects();
        let languages = getLdlanguages();

        textArray = '<div class="ld-scr"><h1>'+fullName+'</h1><div class="contact-ld">'+email+'</br>'+linkedin+'</div><div class="anotherinfo">'+position+'</br>'+country+'</br>'+generalInfo+'</br>'+aboutinfo+'</br>'+experience+'</br>'+education+'</br>'+projects+'</br>'+languages+'</br></div></div>'
    } else if (currentURL.includes('robota.ua')) {
        let elements = document.querySelector('.santa-flex-grow.santa-h-full');
        textArray = elements.innerHTML;
    } else if (currentURL.includes('work.ua')) {
        let elements = document.querySelector('.row.row-print .col-md-8.col-left > .card.card-indent.wordwrap');
        textArray = elements.innerHTML;
    } else if (currentURL.includes('djinni.co')) {
        textArray = '';
    }
    return textArray ? textArray : '';
}
function getProfileImageUrl() {
    let imageElement = '';
    if (currentURL.includes('linkedin.com')) {
        imageElement = document.querySelector('.pv-top-card-profile-picture__image');
    } else if (currentURL.includes('work.ua')) {
        imageElement = document.querySelector('.col-xs-12.col-sm-4 .pull-right.no-pull-xs .add-top-sm.add-bottom-sm img');
    } else if (currentURL.includes('robota.ua')) {
        imageElement = document.querySelector('.resume-main-wrapper .img-container.santa-rounded-full.santa-relative img.santa-rounded-full.santa-object-cover.santa-box-border');
    } else if (currentURL.includes('djinni.co')) {
        imageElement = document.querySelector('.inbox-thread-candidate-wrapper img.userpic-image.userpic-image_img');
    }
    return imageElement ? imageElement.src : '';
}
function getCvUrl() {
    let cvElement = '';
    // if (currentURL.includes('linkedin.com')) {
    //     cvElement = document.querySelector('.pv-top-card-profile-picture__image');
    // }
    if (currentURL.includes('work.ua')) {
        cvElement = document.querySelector('ul[aria-labelledby="dropdownMenu-1"] .download-resume');
    } else if (currentURL.includes('djinni.co')) {
        cvElement = document.querySelector('#last a[href*="https://cv.djinni.co/*"]');
        let linkElements = document.querySelectorAll('.alert-link');
        for(let link of linkElements) {
            if(link.href.endsWith('.pdf')) {
                cvElement = link;  // Выведет href каждого элемента с расширением .pdf
            }
        }
    }
    // else if(currentURL.includes('robota.ua')) {
    //     data-id="cv-controls-download-resume-without-contacts"
    // }
    return cvElement ? cvElement.href : '';
}

function getAllInfo() {
    let fullName = getFullNameParse();
    let email = getEmail();
    let linkedin = getLinkedin();
    let position = getPosition();
    let country = getCountry();
    let generalInfo = getGeneralInfo();
    let aboutinfo = aboutInfo();
    let experience = getExperience();
    let education = getEducation();
    let projects = getProjects();
    let languages = getLdlanguages();
    if (currentURL.includes('djinni.co')) {
        return ``;
    } else {
        return `${fullName}\n${position}\n${email}\n${linkedin}\n${country}\n${generalInfo}\n${aboutinfo}\n${experience}\n${education}\n${projects}\n${languages}`;
    }
}
let observer = new MutationObserver(function(mutations) {
    if (currentURL.includes('djinni.co')) {
        setTimeout(function () {
            let link = document.querySelector('a.userpic-link').href;
            chrome.runtime.sendMessage({action: 'openTab', url: link});
        }, 100);
    }
    observer.disconnect();
});
observer.observe(document.body, { childList: true, subtree: true });

chrome.runtime.onMessage.addListener((request, sender, sendResponse) => {
    if (request.action === 'popupOpened') {
        console.log('popupOpened');
        console.log(contactInfoFetched);
        if (!contactInfoFetched) {
            let fullName = getFullName();
            if (fullName.firstName || fullName.lastName) {
                chrome.runtime.sendMessage({...fullName, action: 'checkCandidate'});
                let contactButton = '';
                if (currentURL.includes('linkedin.com')) {
                    contactButton = document.querySelector('#top-card-text-details-contact-info');
                }
                if (currentURL.includes('work.ua')) {
                    contactButton = document.querySelector('#showContacts');
                }
                if (currentURL.includes('robota.ua')) {
                    let pbtn = document.querySelector('.resume-main-wrapper p[data-id="cv-controls-open-contacts"]');
                    if (pbtn) {
                        contactButton = pbtn.parentNode.parentNode;
                    }
                    console.log('rob cv click');
                }
                if (contactButton) {
                    setTimeout(function () {
                        contactButton.click();
                    }, 5000);
                    setTimeout(function () {
                        let linkedinLink = document.querySelector('.pv-contact-info__contact-link[href*="linkedin.com"]');
                        let emailLink = document.querySelector('.pv-contact-info__contact-link[href*="mailto:"]');
                        let linkTelegram = document.querySelector('.link-messenger.link-messenger-telegram[href*="https://t.me/"]');
                        let linkViber = document.querySelector('.link-messenger.link-messenger-viber[href*="viber://chat?number="]');
                        let linkWhatsapp = document.querySelector('.link-messenger.link-messenger-whatsapp[href*="wa.me/"]');
                        let linkEmailWork = document.querySelector('.card.card-indent.wordwrap dl.dl-horizontal dd a[href*="mailto:"]');
                        let linkPhoneRo = document.querySelector('.phone a[href*="tel:"]');
                        let linkEmailRo = document.querySelector('.email a[href*="mailto:"]');
                        let linkTelegramRo = document.querySelector('.santa-flex.santa-items-center.ng-star-inserted a[href*="https://t.me/"]');
                        let linkViberRo = document.querySelector('.santa-flex.santa-items-center.ng-star-inserted a[href*="viber://chat?number="]');
                        let linkWhatsappRo = document.querySelector('.santa-flex.santa-items-center.ng-star-inserted a[href*="wa.me/"]');
                        let linkedinLinkRo = document.querySelector('.santa-flex.santa-items-center.ng-star-inserted a[href*="linkedin.com"]');
                        if (linkedinLink || emailLink) {
                            chrome.runtime.sendMessage({action: 'getContactTypes'}, response => {
                                if (response.action === 'getContactTypesResult') {
                                    let contactTypes = response.contactTypes;
                                    chrome.runtime.sendMessage({
                                        action: 'updateContactInfo',
                                        contacts: [
                                            {
                                                id: contactTypes.find(c => c.slug === 'linkedin').id,
                                                type: 'Linkedin',
                                                value: linkedinLink ? linkedinLink.href : '',
                                                kanal_zvyazku: false // или true, в зависимости от того, является ли данный контакт основным
                                            },
                                            {
                                                id: contactTypes.find(c => c.slug === 'email').id,
                                                type: 'Email',
                                                value: emailLink ? emailLink.href : '',
                                                kanal_zvyazku: false // или true, в зависимости от того, является ли данный контакт основным
                                            }
                                        ]
                                    });
                                }
                            });
                            let closeButton = document.querySelector('.artdeco-modal__dismiss');
                            if (closeButton) {
                                closeButton.click();
                            }
                            // contactInfoFetched = true;
                        } else if (linkTelegram || linkViber || linkWhatsapp || linkEmailWork) {
                            chrome.runtime.sendMessage({action: 'getContactTypes'}, response => {
                                if (response.action === 'getContactTypesResult') {
                                    let contactTypes = response.contactTypes;
                                    chrome.runtime.sendMessage({
                                        action: 'updateContactInfo',
                                        contacts: [
                                            {
                                                id: contactTypes.find(c => c.slug === 'telegram').id,
                                                type: 'Telegram',
                                                value: linkTelegram.href ? linkTelegram.href : '',
                                                kanal_zvyazku: false // или true, в зависимости от того, является ли данный контакт основным
                                            },
                                            {
                                                id: contactTypes.find(c => c.slug === 'email').id,
                                                type: 'Email',
                                                value: linkEmailWork.href ? linkEmailWork.href : '',
                                                kanal_zvyazku: false // или true, в зависимости от того, является ли данный контакт основным
                                            },
                                            {
                                                id: contactTypes.find(c => c.slug === 'viber').id,
                                                type: 'Viber',
                                                value: linkViber.href ? linkViber.href : '',
                                                kanal_zvyazku: false // или true, в зависимости от того, является ли данный контакт основным
                                            },
                                            {
                                                id: contactTypes.find(c => c.slug === 'whatsapp').id,
                                                type: 'Whatsapp',
                                                value: linkWhatsapp.href ? linkWhatsapp.href : '',
                                                kanal_zvyazku: false // или true, в зависимости от того, является ли данный контакт основным
                                            }
                                        ]
                                    });
                                }
                            });
                            // contactInfoFetched = true;
                        } else if (linkTelegramRo || linkViberRo || linkWhatsappRo || linkEmailRo || linkPhoneRo) {
                            chrome.runtime.sendMessage({action: 'getContactTypes'}, response => {
                                if (response.action === 'getContactTypesResult') {
                                    let contactTypes = response.contactTypes;
                                    chrome.runtime.sendMessage({
                                        action: 'updateContactInfo',
                                        contacts: [
                                            {
                                                id: contactTypes.find(c => c.slug === 'telegram').id,
                                                type: 'Telegram',
                                                value: linkTelegramRo.href ? linkTelegramRo.href : '',
                                                kanal_zvyazku: false // или true, в зависимости от того, является ли данный контакт основным
                                            },
                                            {
                                                id: contactTypes.find(c => c.slug === 'email').id,
                                                type: 'Email',
                                                value: linkEmailRo.href ? linkEmailRo.href : '',
                                                kanal_zvyazku: false // или true, в зависимости от того, является ли данный контакт основным
                                            },
                                            {
                                                id: contactTypes.find(c => c.slug === 'viber').id,
                                                type: 'Viber',
                                                value: linkViberRo.href ? linkViberRo.href : '',
                                                kanal_zvyazku: false // или true, в зависимости от того, является ли данный контакт основным
                                            },
                                            {
                                                id: contactTypes.find(c => c.slug === 'whatsapp').id,
                                                type: 'Whatsapp',
                                                value: linkWhatsappRo.href ? linkWhatsappRo.href : '',
                                                kanal_zvyazku: false // или true, в зависимости от того, является ли данный контакт основным
                                            },
                                            {
                                                id: contactTypes.find(c => c.slug === 'phone').id,
                                                type: 'Phone',
                                                value: linkPhoneRo.href ? linkPhoneRo.href : '',
                                                kanal_zvyazku: false // или true, в зависимости от того, является ли данный контакт основным
                                            },
                                            {
                                                id: contactTypes.find(c => c.slug === 'linkedin').id,
                                                type: 'Linkedin',
                                                value: linkedinLinkRo.href ? linkedinLinkRo.href : '',
                                                kanal_zvyazku: false // или true, в зависимости от того, является ли данный контакт основным
                                            }
                                        ]
                                    });
                                }
                            });
                            // contactInfoFetched = true;
                        }
                    }, 6000);
                } else {
                    setTimeout(function () {
                        let linkTelegram = document.querySelector('.link-messenger.link-messenger-telegram[href*="https://t.me/"]');
                        let linkViber = document.querySelector('.link-messenger.link-messenger-viber[href*="viber://chat?number="]');
                        let linkWhatsapp = document.querySelector('.link-messenger.link-messenger-whatsapp[href*="wa.me/"]');
                        let linkEmailWork = document.querySelector('.card.card-indent.wordwrap dl.dl-horizontal dd a[href*="mailto:"]');
                        let linkPhoneRo = document.querySelector('.phone a[href*="tel:"]');
                        let linkEmailRo = document.querySelector('.email a[href*="mailto:"]');
                        let linkTelegramRo = document.querySelector('.santa-flex.santa-items-center.ng-star-inserted a[href*="https://t.me/"]');
                        let linkViberRo = document.querySelector('.santa-flex.santa-items-center.ng-star-inserted a[href*="viber://chat?number="]');
                        let linkWhatsappRo = document.querySelector('.santa-flex.santa-items-center.ng-star-inserted a[href*="wa.me/"]');
                        let linkedinLinkRo = document.querySelector('.santa-flex.santa-items-center.ng-star-inserted a[href*="linkedin.com"]');

                        let linkEmailDj = document.querySelector('#candidate_email[href*="mailto:"]');
                        let linkedinLinkDj = document.querySelector('.col-sm-7.offset-sm-1.col-xs-12.order-md-2.order-sm-1 #last a[href*="linkedin.com"]');
                        let skypeLinkDj = document.querySelector('.inbox-candidate-details--item .inbox-candidate-details--item-inner a[href*="skype:"]');
                        let linkTelegramDj = document.querySelector('.inbox-candidate-details--item .inbox-candidate-details--item-inner a[href*="https://t.me/"]');
                        let linkPhoneDj = document.querySelector('.inbox-candidate-details--item .inbox-candidate-details--item-inner a[href*="tel:"]');
                        let linkViberDj = document.querySelector('.inbox-candidate-details--item .inbox-candidate-details--item-inner a[href*="//wa.me/"]');

                        if (linkTelegram || linkViber || linkWhatsapp || linkEmailWork) {
                            chrome.runtime.sendMessage({action: 'getContactTypes'}, response => {
                                if (response.action === 'getContactTypesResult') {
                                    let contactTypes = response.contactTypes;
                                    chrome.runtime.sendMessage({
                                        action: 'updateContactInfo',
                                        contacts: [
                                            {
                                                id: contactTypes.find(c => c.slug === 'telegram').id,
                                                type: 'Telegram',
                                                value: linkTelegram.href ? linkTelegram.href : '',
                                                kanal_zvyazku: false // или true, в зависимости от того, является ли данный контакт основным
                                            },
                                            {
                                                id: contactTypes.find(c => c.slug === 'email').id,
                                                type: 'Email',
                                                value: linkEmailWork.href ? linkEmailWork.href : '',
                                                kanal_zvyazku: false // или true, в зависимости от того, является ли данный контакт основным
                                            },
                                            {
                                                id: contactTypes.find(c => c.slug === 'viber').id,
                                                type: 'Viber',
                                                value: linkViber.href ? linkViber.href : '',
                                                kanal_zvyazku: false // или true, в зависимости от того, является ли данный контакт основным
                                            },
                                            {
                                                id: contactTypes.find(c => c.slug === 'whatsapp').id,
                                                type: 'Whatsapp',
                                                value: linkWhatsapp.href ? linkWhatsapp.href : '',
                                                kanal_zvyazku: false // или true, в зависимости от того, является ли данный контакт основным
                                            }
                                        ]
                                    });
                                }
                            });
                            // contactInfoFetched = true;
                        } else if (linkTelegramRo || linkViberRo || linkWhatsappRo || linkEmailRo || linkPhoneRo) {
                            chrome.runtime.sendMessage({action: 'getContactTypes'}, response => {
                                if (response.action === 'getContactTypesResult') {
                                    let contactTypes = response.contactTypes;
                                    chrome.runtime.sendMessage({
                                        action: 'updateContactInfo',
                                        contacts: [
                                            {
                                                id: contactTypes.find(c => c.slug === 'telegram').id,
                                                type: 'Telegram',
                                                value: linkTelegramRo ? linkTelegramRo.href : '',
                                                kanal_zvyazku: false // или true, в зависимости от того, является ли данный контакт основным
                                            },
                                            {
                                                id: contactTypes.find(c => c.slug === 'email').id,
                                                type: 'Email',
                                                value: linkEmailRo ? linkEmailRo.href : '',
                                                kanal_zvyazku: false // или true, в зависимости от того, является ли данный контакт основным
                                            },
                                            {
                                                id: contactTypes.find(c => c.slug === 'viber').id,
                                                type: 'Viber',
                                                value: linkViberRo ? linkViberRo.href : '',
                                                kanal_zvyazku: false // или true, в зависимости от того, является ли данный контакт основным
                                            },
                                            {
                                                id: contactTypes.find(c => c.slug === 'whatsapp').id,
                                                type: 'Whatsapp',
                                                value: linkWhatsappRo ? linkWhatsappRo.href : '',
                                                kanal_zvyazku: false // или true, в зависимости от того, является ли данный контакт основным
                                            },
                                            {
                                                id: contactTypes.find(c => c.slug === 'phone').id,
                                                type: 'Phone',
                                                value: linkPhoneRo ? linkPhoneRo.href : '',
                                                kanal_zvyazku: false // или true, в зависимости от того, является ли данный контакт основным
                                            },
                                            {
                                                id: contactTypes.find(c => c.slug === 'linkedin').id,
                                                type: 'Linkedin',
                                                value: linkedinLinkRo ? linkedinLinkRo.href : '',
                                                kanal_zvyazku: false // или true, в зависимости от того, является ли данный контакт основным
                                            }
                                        ]
                                    });
                                }
                            });
                            // contactInfoFetched = true;
                        } else if (linkTelegramDj || linkEmailDj || skypeLinkDj || linkedinLinkDj || linkPhoneDj || linkViberDj) {
                            chrome.runtime.sendMessage({action: 'getContactTypes'}, response => {
                                if (response.action === 'getContactTypesResult') {
                                    let contactTypes = response.contactTypes;

                                    let tempContacts = [];
                                    if (linkTelegramDj) {
                                        tempContacts.push({
                                            id: contactTypes.find(c => c.slug === 'telegram').id,
                                            type: 'Telegram',
                                            value: linkTelegramDj.href,
                                            kanal_zvyazku: false
                                        });
                                    }
                                    if (linkEmailDj) {
                                        tempContacts.push({
                                            id: contactTypes.find(c => c.slug === 'email').id,
                                            type: 'Email',
                                            value: linkEmailDj.href,
                                            kanal_zvyazku: false
                                        });
                                    }
                                    if (skypeLinkDj) {
                                        tempContacts.push({
                                            id: contactTypes.find(c => c.slug === 'skype').id,
                                            type: 'Skype',
                                            value: skypeLinkDj.href,
                                            kanal_zvyazku: false
                                        });
                                    }
                                    if (linkViberDj) {
                                        tempContacts.push({
                                            id: contactTypes.find(c => c.slug === 'viber').id,
                                            type: 'Viber',
                                            value: linkViberDj.href,
                                            kanal_zvyazku: false
                                        });
                                    }
                                    if (linkPhoneDj) {
                                        tempContacts.push({
                                            id: contactTypes.find(c => c.slug === 'phone').id,
                                            type: 'Phone',
                                            value: linkPhoneDj.href,
                                            kanal_zvyazku: false
                                        });
                                    }
                                    if (linkedinLinkDj) {
                                        tempContacts.push({
                                            id: contactTypes.find(c => c.slug === 'linkedin').id,
                                            type: 'Linkedin',
                                            value: linkedinLinkDj.href,
                                            kanal_zvyazku: false
                                        });
                                    }

                                    if (tempContacts.length > 0) {
                                        chrome.runtime.sendMessage({
                                            action: 'updateContactInfo',
                                            contacts: tempContacts
                                        });
                                    }
                                }
                            });
                            // contactInfoFetched = true;
                        }
                    }, 4000);
                }
            }
        }
    }
});


chrome.runtime.onMessage.addListener(function(request, sender, sendResponse) {
    if (request.action === "saveCandidate") {
        let fullName = getFullName();
        let allInfo = getAllInfo();
        let foto = getProfileImageUrl();
        let rezume = getCvUrl();
        let cvComb = cvFile();
        sendResponse({...fullName, allInfo, foto, rezume, cvComb});
    }
    if (request.action === 'checkCandidate') {
        let popupWindow = document.querySelector('body');
        if (request) {
            popupWindow.style.border = '3px solid red';
        } else {
            popupWindow.style.border = '3px solid green';
        }
    }
});

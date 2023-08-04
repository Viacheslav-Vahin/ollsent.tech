let btn = document.createElement('div');
btn.id = "maininfobtn";
btn.className = 'glass-ball';
btn.innerHTML = "✓";
btn.style.position = 'fixed';
btn.style.display = 'none';
btn.style.top = '55px';
btn.style.left = '5px';
btn.style.width = '55px';
btn.style.height = '55px';
btn.style.backgroundColor = '#16a086';
btn.style.borderRadius = '50%';
btn.style.zIndex = 999999;

let btnShine = document.createElement('div');
btnShine.className = "shine";
let btnInn = document.createElement('span');
btnInn.className = "checkmark";

let btnPlus = document.createElement('div');
btnPlus.id = "maininfobtnPlus";
btnPlus.style.position = 'fixed';
btnPlus.style.top = '65px';
btnPlus.style.left = '65px';
btnPlus.style.width = '35px';
btnPlus.style.height = '35px';
btnPlus.style.zIndex = 999999;
btnPlus.style.backgroundImage = 'url(' + chrome.runtime.getURL('img/Ollsent_CRM.png') + ')';
btnPlus.style.backgroundSize = 'cover';
btnPlus.style.backgroundRepeat = 'no-repeat';
btnPlus.innerHTML = "+";
btnPlus.style.display = 'flex';
btnPlus.style.borderRadius = '3px';
btnPlus.style.background = '#16a086';
btnPlus.style.color = '#fff';
btnPlus.style.alignItems = 'center';
btnPlus.style.justifyContent = 'center';
btnPlus.style.fontSize = '22px';
btnPlus.style.fontWeight = 'bold';
btnPlus.style.lineHeight = '1.3';
btnPlus.style.cursor = 'pointer';

let popup = document.createElement('div'); // Создаем новый div для попапа
popup.id = 'mainformWrapper';
popup.style.position = 'fixed';
popup.style.top = '115px';
popup.style.left = '-355px';
popup.style.opacity = '0';
popup.style.transition = 'all, .3s';
popup.style.zIndex = 1000;
popup.style.boxShadow = '0px 0px 3px 0px #16a086';
popup.innerHTML = `
<div id="mainform" class="ext-wrapper" style="overflow-y: scroll; overflow-x: hidden; width: 350px; height: 740px; background-color: #fff; padding: 10px; scrollbar-width: thin; scrollbar-color: #16a086 #16a086;">
    <style>
    /* Это для веб-китовых браузеров, таких как Chrome и Safari */
    #mainform {
            font-family: 'Noto Sans';
    }
    #mainform::-webkit-scrollbar {
        width: 5px; /* Ширина скроллбара */
    }

    #mainform::-webkit-scrollbar-track {
        background: #f1f1f1; /* Цвет фона */
    }

    #mainform::-webkit-scrollbar-thumb {
        background: #16a086; /* Цвет скроллбара */
    }

    #mainform::-webkit-scrollbar-thumb:hover {
        background: #0d6a5d; /* При наведении на скроллбар меняем его цвет */
    }
    #mainform h3{
    font-size: 18px;
    line-height: 26px;
    font-weight: 400;
    margin: 0 !important;
    color: #000 !important;
    }
    #mainform h1{
        color: #16a086;
            font-size: 36px;
    line-height: 42px;
    font-weight: 100;
    }
    #toogler {
    display: flex;
    align-content: center;
    justify-content: center;
    }
    #toogler button {
        background: 0 0;
    border: 1px solid #16a086;
    color: #16a086;
    padding: 7px 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    transition-duration: .4s;
    cursor: pointer;
    position: relative;
    margin-right: 10px;
    }
    #toogler button:hover {
     background: #16a086;
     color: #fff;
    }
    .fields-wrapper > * {
    padding: 10px 0;
    }
    #pop-dos {
    position: relative;
    }
    #exp-range {
        width: calc(100% - 30px) !important;
    }
    #exp-range-value {
        position: absolute;
    appearance: none;
    border: none !important;
    box-shadow: none !important;
    bottom: 5px;
    right: -25px;
    width: 50px !important;
        padding: 0 !important;
    margin-left: 5px;
    outline: none !important;
    color: #000 !important;
    background-color: #fff !important;
    }
    input[type=range]::-webkit-slider-runnable-track {
    width: 100%;
    height: 10px;
    cursor: pointer;
    animate: 0.2s;
    box-shadow: 1px 1px 1px #16a086;
    background: linear-gradient(to right, #16a086, #20bfa3, #39d8c0, #53f2dd, #ffffff);;
    border-radius: 5px;
    border: 0.2px solid #16a086;
}
input[type=range]::-moz-range-track {
    width: 100%;
    height: 10px;
    cursor: pointer;
    animate: 0.2s;
    box-shadow: 1px 1px 1px #16a086;
    background: linear-gradient(to right, #16a086, #20bfa3, #39d8c0, #53f2dd, #ffffff);;
    border-radius: 5px;
    border: 0.2px solid #16a086;
}
input[type=range]::-webkit-slider-thumb {
    box-shadow: 1px 1px 1px #16a086;
    height: 20px;
    width: 20px;
    border-radius: 50%;
    background: #ffffff;
    cursor: pointer;
    -webkit-appearance: none;
    margin-top: -4px;
}
input[type=range]::-moz-range-thumb {
    box-shadow: 1px 1px 1px #16a086;
    height: 20px;
    width: 20px;
    border-radius: 50%;
    background: #ffffff;
    cursor: pointer;
}
#mainform select,
 #mainform .select2 {
width: 100% !important;
}
#mainform input {
padding: 5px;
    border: 1px solid #a29e9e;
    box-shadow: none;
    width: 100%;
    outline: none !important;
}
.contact-field-group {
display: flex;
    align-items: center;
    justify-content: center;
}
.contact-field-group select {
    margin-right: 10px;
    max-width: 115px;
}
.contact-field-group {
position: relative;
padding-bottom: 15px;
}
.contact-field-group input[type=checkbox] {
    z-index: 999;
    position: relative;
    width: 15px !important;
    right: -5px;
    bottom: 5px;
    visibility: visible;
    opacity: 1;
    pointer-events: all !important;
}
.glass-ball {
    position: relative;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    background: rgba(255, 0, 0, 1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    cursor: pointer;
        font-weight: bold;
    font-size: 25px;
    color: #fff;
}

.shine {
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: rgba(255, 255, 255, 0.2);
    transform: rotate(30deg);
    pointer-events: none;
    background: linear-gradient(
        -30deg,
        rgba(255, 255, 255, 0.2) 25%,
        rgba(255, 255, 255, 0.5) 50%,
        rgba(255, 255, 255, 0.2) 75%
    );
}
.glass-ball:hover .shine {
    animation: shine 3s infinite;
}

.checkmark {
    color: white;
    font-size: 2em;
    font-weight: bold;
    z-index: 2;
}

#save-button,
 #add-button {
    background: 0 0;
    border: 1px solid #16a086;
    color: #16a086;
    padding: 7px 15px;
    text-align: center;
    text-decoration: none;
    font-size: 16px;
    transition-duration: .4s;
    cursor: pointer;
    position: relative;
    margin: auto;
    display: block;
}

#save-button:hover,
 #add-button:hover {
color: #fff;
background-color: #16a086;
}

#mainform .fields-wrapper .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #16a086;
    color: #fff;
    border: none;
}
#mainform .fields-wrapper .select2-selection__choice__remove {
    color: #fff;
}
.select2-results__option.select2-results__option--selectable.select2-results__option--highlighted.select2-results__option--selected {
    background: linear-gradient(to right, #16a086, #20bfa3, #39d8c0, #53f2dd, #ffffff);
}
.select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
    background: linear-gradient(to right, #16a086, #20bfa3, #39d8c0, #53f2dd, #ffffff);
    color: white;
}
#mainform .fields-wrapper #additional-info {
    width: 100% !important;
    height: 150px !important;
}
#mainform #mainComment {
    display: inline-block;
    height: 15px;
    position: relative;
    opacity: 1;
    pointer-events: auto;
    margin: 0;
    margin-right: 5px;
    width: auto;
    top: -1px;
}
.highlight-option {
color: red;
font-weight: bold;
}
#candidateInfoPopup {
    position: absolute;
    z-index: 999;
    background: #ff2d2d;
    box-shadow: 0px 0px 5px 2px #ff2d2d;
    border-radius: 5px;
    padding: 10px;
    color: white;
    text-align: center;
    top: 0;
    left: 350px;
    width: 300px;
    font-weight: bold;
}
.closeinfoPopup {
    display: block;
    width: 100%;
    text-align: right;
}
@keyframes shine {
    from {
        transform: rotate(30deg) translateX(-150%);
    }
    to {
        transform: rotate(30deg) translateX(150%);
    }
}
    </style>` +
    '    <h1>Ollsent</h1>\n' +
    '    <div id="candidateInfoPopup" style="display: none;"><button class="closeinfoPopup">✖</button><div id="infoPopupContent"></div></div>\n' +
    '    <div id="candidateInfo" style="display: none;"></div>\n' +
    '    <div id="candidateInfo22" style="display: none;"></div>\n' +
    '    <div class="fields-wrapper">\n' +
    '        <div id="vacancy"><h3>Вакансія</h3></div>\n' +
    '        <div id="stage"></div>\n' +
    '        <div id="toogler"></div>\n' +
    '        <div id="pop-prof"><h3>IT</h3></div>\n' +
    '        <div id="pop-noit"><h3>Інші</h3></div>\n' +
    '        <div id="pop-dos"><h3>Досвід роботи</h3></div>\n' +
    '        <div id="pop-zp"><h3>Зарплатня</h3></div>\n' +
    '        <div id="pop-mova"><h3>Мова</h3></div>\n' +
    '        <div id="pop-mova-r"><h3>Рівень мови</h3></div>\n' +
    '        <div id="contacts">\n' +
    '            <h3>Контакти</h3>\n' +
    '        </div>\n' +
    '        <div id="add-cont-btn">\n' +
    '            <button id="add-button">Додати контакти</button>\n' +
    '        </div>\n' +
    '        <div id="region"><h3>Регіон</h3></div>\n' +
    '        <div id="tags"><h3>Теги</h3></div>\n' +
    '        <div id="comments"><h3>Коментарі</h3></div>\n' +
    '    </div>\n' +
    '    <button id="save-button">Зберегти в ATS</button>\n' +
    '</div>\n';

document.body.appendChild(btn);
document.body.appendChild(btnPlus);
document.body.appendChild(popup);
document.querySelector('#maininfobtn').appendChild(btnShine);
document.querySelector('#maininfobtn').appendChild(btnInn);
btn.addEventListener("click", function () {
    chrome.runtime.sendMessage({command: "openPopup"});
});

chrome.storage.local.get(['authToken'], function(result) {
    if (result.authToken) {
        document.getElementById('maininfobtn').style.display = 'flex';
    }
});
/////////////////////////////////////// main button end //////////////////////////////////
// setTimeout(function () {
chrome.runtime.onMessage.addListener((message, sender, sendResponse) => {
    if (message.action === 'updateExtensionData') {
        // Здесь выполняйте необходимые действия для обновления данных расширения
        // Например, обновите переменные, очистите кэш или выполните другие операции
        // console.log("Обновление данных расширения в контент-скрипте", message.action);
        // Отправьте ответ, чтобы подтвердить обновление данных
        sendResponse({success: true});
    }
    if (message.action === "showError") {
        // Здесь вы можете добавить сообщение об ошибке в нужный вам блок.
        // Например, если у вас есть блок с id="myBlock", вы можете сделать следующее:
        let infopop = document.getElementById("candidateInfoPopup");
        infopop.style.display = 'block';
        document.getElementById("infoPopupContent").textContent = message.message;
    }
});
document.addEventListener('click', function(event) {
    if (event.target.matches('.closeinfoPopup')) {
        document.querySelector('#candidateInfoPopup').style.display = 'none';
    }
});
let contactInfoFetched = false;
let currentURL = window.location.href;
function saveHist() {

}
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
        fullNameElement = document.querySelector('.resume-main-wrapper.ng-star-inserted .santa-flex.santa-items-stretch h1 p.copy-wrap');
        if (fullNameElement) {
            let fullName = fullNameElement.textContent.trim();
            let names = fullName.split(' ');
            if (names.length > 1) {
                firstName = names.shift();
                lastName = names.join(' ');
            } else {
                firstName = names[0];
                lastName = names[0];
            }
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

    // return {firstName, lastName};
    let result = {firstName, lastName};

    if (!result.firstName || !result.lastName) {
        console.error('Could not get full name. firstName: ', result.firstName, ', lastName: ', result.lastName);
    }

    return result;
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
    if (currentURL.includes('work.ua')) {
        let fullName = getFullName();
        fullName = fullName ? fullName : '';
        const h2Elements = document.querySelectorAll('h2');

        const h2Element = h2Elements[0];
        const h3Element = h2Element.nextElementSibling;
        const pElement = h3Element.nextElementSibling;

        const h2Element3 = h2Elements[2];
        const h3Element3 = h2Element3.nextElementSibling;
        const pElement3 = h3Element3.nextElementSibling;
        const h3Element33 = pElement3.nextElementSibling;
        const pElement33 = h3Element33.nextElementSibling;
        const h3Element34 = pElement33.nextElementSibling;
        const pElement34 = h3Element34.nextElementSibling;
        const h3Element35 = pElement34.nextElementSibling;
        const pElement35 = h3Element35.nextElementSibling;
        const h3Element36 = pElement35.nextElementSibling;
        const pElement36 = h3Element36.nextElementSibling;

        const h2Element4 = h2Elements[3];
        const h3Element4 = h2Element4.nextElementSibling;
        const pElement4 = h3Element4.nextElementSibling;

        const h2Element5 = h2Elements[4];
        const h3Element5 = h2Element5.nextElementSibling;
        const pElement5 = h3Element5.nextElementSibling;

        const h2Element6 = h2Elements[5];
        const h3Element6 = h2Element6.nextElementSibling;
        const pElement6 = h3Element6.nextElementSibling;

        let elements = document.querySelector('.row.row-print .col-md-8.col-left > .card.card-indent.wordwrap #add_info');
        let elements2 = document.querySelector('.row.row-print .col-md-8.col-left > .card.card-indent.wordwrap #addInfo');
        let elWr = elements ? elements : elements2;

        let element = fullName.firstName + ' ' + fullName.lastName + "\n" +
            (h2Element ? h2Element.innerText + "\n" : '') +
            (h3Element ? h3Element.innerText + "\n" : '') +
            (pElement ? pElement.innerText + "\n" : '') +
            (h2Element3 ? h2Element3.innerText + "\n" : '') +
            (h3Element3 ? h3Element3.innerText + "\n" : '') +
            (pElement3 ? pElement3.innerText + "\n" : '') +
            (h3Element33 ? h3Element33.innerText + "\n" : '') +
            (pElement33 ? pElement33.innerText + "\n" : '') +
            (h3Element34 ? h3Element34.innerText + "\n" : '') +
            (pElement34 ? pElement34.innerText + "\n" : '') +
            (h3Element35 ? h3Element35.innerText + "\n" : '') +
            (pElement35 ? pElement35.innerText + "\n" : '') +
            (h3Element36 ? h3Element36.innerText + "\n" : '') +
            (pElement36 ? pElement36.innerText + "\n" : '') +
            (h2Element4 ? h2Element4.innerText + "\n" : '') +
            (h3Element4 ? h3Element4.innerText + "\n" : '') +
            (pElement4 ? pElement4.innerText + "\n" : '') +
            (h2Element5 ? h2Element5.innerText + "\n" : '') +
            (h3Element5 ? h3Element5.innerText + "\n" : '') +
            (pElement5 ? pElement5.innerText + "\n" : '') +
            (h2Element6 ? h2Element6.innerText + "\n" : '') +
            (h3Element6 ? h3Element6.innerText + "\n" : '') +
            (pElement6 ? pElement6.innerText + "\n" : '') +
            (elWr ? elWr.innerText + "\n" : '');
        return element ? element : '';
    } else {
        let element = document.querySelector('.display-flex.ph5.pv3 .pv-shared-text-with-see-more .visually-hidden');
        return element ? element.innerText : '';
    }
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
//
// function getExperience() {
//     if (currentURL.includes('linkedin.com')) {
//         let experienceDiv = document.getElementById('experience');
//         if (experienceDiv) {
//             let nextDiv = experienceDiv.nextElementSibling;
//             let nextNextDiv = nextDiv.nextElementSibling;
//             if (nextNextDiv) {
//                 let textArray2 = [];
//                 let parentElements = nextNextDiv.querySelectorAll('.pvs-list__outer-container .pvs-list .artdeco-list__item.pvs-list__item--line-separated.pvs-list__item--one-column .pvs-entity.pvs-entity--padded.pvs-list__item--no-padding-in-columns .display-flex.flex-column.full-width.align-self-center .display-flex.flex-row.justify-space-between .display-flex.flex-column.full-width');
//                 for (let parentElement of parentElements) {
//                     let text = extractTextWithNewLines(parentElement);
//                     textArray2.push(text);
//                 }
//                 return textArray2.join('\n');
//             } else {
//                 return "No next sibling found";
//             }
//         }
function extractHTMLWithNewLines(element) {
    let html = '';
    for (let child of element.childNodes) {
        if (child.nodeType === Node.TEXT_NODE) {
            html += child.textContent;
        } else if (child.nodeType === Node.ELEMENT_NODE && child.classList && !child.classList.contains('visually-hidden')) {
            html += child.innerHTML;
        }
    }
    return html.replace(/\s\s+/g, ' ').trim() + '\n';
}

function getExperience() {
    if (currentURL.includes('linkedin.com')) {
        let experienceDiv = document.getElementById('experience');
        if (experienceDiv) {
            let nextDiv = experienceDiv.nextElementSibling;
            let nextNextDiv = nextDiv.nextElementSibling;
            if (nextNextDiv) {
                let htmlArray2 = [];
                let parentElements = nextNextDiv.querySelectorAll('.pvs-list__outer-container .pvs-list .artdeco-list__item.pvs-list__item--line-separated.pvs-list__item--one-column .pvs-entity.pvs-entity--padded.pvs-list__item--no-padding-in-columns .display-flex.flex-column.full-width.align-self-center .display-flex.flex-row.justify-space-between .display-flex.flex-column.full-width');
                for (let parentElement of parentElements) {
                    let html = extractHTMLWithNewLines(parentElement);
                    htmlArray2.push(html);
                }
                return htmlArray2.join('\n');
            } else {
                return "No next sibling found";
            }
        }
    } else if (currentURL.includes('robota.ua')) {
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
                for (let parentElement of parentElements) {
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

// function getProjects() {
//     if (currentURL.includes('linkedin.com')) {
//         let experienceDiv = document.getElementById('education');
//         if (experienceDiv) {
//             let nextDiv = experienceDiv.nextElementSibling;
//             let nextNextDiv = nextDiv.nextElementSibling;
//             if (nextNextDiv) {
//                 let textArray2 = [];
//                 let parentElements = nextNextDiv.querySelectorAll('.pvs-list__outer-container .pvs-list .artdeco-list__item.pvs-list__item--line-separated.pvs-list__item--one-column .pvs-entity.pvs-entity--padded.pvs-list__item--no-padding-in-columns .display-flex.flex-column.full-width.align-self-center');
//                 for (let parentElement of parentElements) {
//                     let text = extractTextWithNewLines(parentElement);
//                     textArray2.push(text);
//                 }
//                 return textArray2.join('\n');
//             } else {
//                 return "No next sibling found";
//             }
//         }
//     }
// }

function getLdlanguages() {
    if (currentURL.includes('linkedin.com')) {
        let experienceDiv = document.getElementById('languages');
        if (experienceDiv) {
            let nextDiv = experienceDiv.nextElementSibling;
            let nextNextDiv = nextDiv.nextElementSibling;
            if (nextNextDiv) {
                let textArray2 = [];
                let parentElements = nextNextDiv.querySelectorAll('.pvs-list__outer-container .pvs-list .artdeco-list__item.pvs-list__item--line-separated.pvs-list__item--one-column .pvs-entity.pvs-entity--padded.pvs-list__item--no-padding-in-columns .display-flex.flex-column.full-width.align-self-center .display-flex.flex-column.full-width\n');
                for (let parentElement of parentElements) {
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
    if (currentURL.includes('linkedin.com')) {
        cvElement = document.querySelector('.pv-top-card-profile-picture__image');
    }
    if (currentURL.includes('work.ua')) {
        cvElement = document.querySelector('ul[aria-labelledby="dropdownMenu-1"] .download-resume') || document.querySelector('.js-resume-file-pdf-download');
    } else if (currentURL.includes('djinni.co')) {
        cvElement = document.querySelector('#last a[href*="https://cv.djinni.co/*"]');
        let linkElements = document.querySelectorAll('.alert-link');
        for (let link of linkElements) {
            if (link.href.endsWith('.pdf')) {
                cvElement = link;  // Выведет href каждого элемента с расширением .pdf
            }
        }
    }
    // else if(currentURL.includes('robota.ua')) {
    //     data-id="cv-controls-download-resume-without-contacts"
    // }
    return cvElement.href ? cvElement.href : '';
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
    // let projects = getProjects();
    let languages = getLdlanguages();
    if (currentURL.includes('djinni.co')) {
        return ``;
    } else {
        // return `${fullName}\n${position}\n${email}\n${linkedin}\n${country}\n${generalInfo}\n${aboutinfo}\n${experience}\n${education}\n${projects}\n${languages}`;
        return `${
            fullName ? fullName + "\n" : ""}${
            position ? position + "\n" : ""}${
            email ? email + "\n" : ""}${
            linkedin ? linkedin + "\n" : ""}${
            country ? country + "\n" : ""}${
            generalInfo ? generalInfo + "\n" : ""}${
            aboutinfo ? aboutinfo + "\n" : ""}${
            experience ? experience + "\n" : ""}${
            education ? education + "\n" : ""}${
            // projects ? projects + "\n" : ""}${
            languages ? languages + "\n" : ""}`;

        // return '<div class="ld-scr"><h1>' + fullName + '</h1><div class="contact-ld"><p>' + email + '</p><p>' + linkedin + '</p></div><div class="anotherinfo"><h3>Посада</h3><p>' + position + '</p><h3>Локація</h3><p>' + country + '</p><h3>Основна інформація</h3><p>' + generalInfo + '</p><h3>Додаткова інформація</h3><p>' + aboutinfo + '</p><h3>Досвід</h3><p>' + experience + '</p><h3>Навчання</h3><p>' + education + '</p><h3>Мова</h3><p>' + languages + '</p></div></div>'
    }
}

function cvFile() {
    let textArray = '';
    if (currentURL.includes('linkedin.com')) {
        let fullName = getFullNameParse();
        fullName = fullName ? fullName : '';
        let email = getEmail();
        email = email ? email : '';
        let linkedin = getLinkedin();
        linkedin = linkedin ? linkedin : '';
        let position = getPosition();
        position = position ? position : '';
        let country = getCountry();
        country = country ? country : '';
        let generalInfo = getGeneralInfo();
        generalInfo = generalInfo ? generalInfo : '';
        let aboutinfo = aboutInfo();
        aboutinfo = aboutinfo ? aboutinfo : '';
        let experience = getExperience();
        experience = experience ? experience : '';
        let education = getEducation();
        education = education ? education : '';
        // let projects = getProjects();
        // projects = projects ? projects : '';
        let languages = getLdlanguages();
        languages = languages ? languages : '';
        // let photo = getProfileImageUrl();
        // photo = photo ? photo : '';

        textArray = '<div class="ld-scr"><h1>' + fullName + '</h1><div class="contact-ld"><p>' + email + '</p><p>' + linkedin + '</p></div><div class="anotherinfo"><h3>Посада</h3><p>' + position + '</p><h3>Локація</h3><p>' + country + '</p><h3>Основна інформація</h3><p>' + generalInfo + '</p><h3>Додаткова інформація</h3><p>' + aboutinfo + '</p><h3>Досвід</h3><p>' + experience + '</p><h3>Навчання</h3><p>' + education + '</p><h3>Мова</h3><p>' + languages + '</p></div></div>'

    } else if (currentURL.includes('robota.ua')) {
        let elements = document.querySelector('.santa-flex-grow.santa-h-full');
        textArray = elements.innerHTML;
    } else if (currentURL.includes('work.ua')) {
        const h2Elements2 = document.querySelectorAll('.card.card-indent.wordwrap');
        textArray = '<style>.normal-weight.text-muted-print{display: none;} .col-xs-12.col-sm-4{display: none;} .pick-full-load.hidden-print{display: none} .cut-bottom-print{display: none} .js-comment-block{display: none} .btn.btn-default.js-offer-job{display: none;} .hidden-print{display: none;} .dl-horizontal dt { float: left; clear: left; text-align: left;} .flex-wrap { flex-wrap: wrap; } .flex { display: flex; } .skill { max-width: 600px; padding: 8px 15px; border-radius: 20px; color: #000; background-color: #f4f5f6; } .add-right-sm { margin-right: 10px!important; } .ellipsis { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; } .inline-block { display: inline-block; }</style>' + h2Elements2[0].innerHTML;
    } else if (currentURL.includes('djinni.co')) {
        textArray = '';
    }
    return textArray ? textArray : '';
}

function zvidkuKandudat() {
    let url = window.location.href; // текущий URL
    let zvidki_kandidat;
    if (url.includes("https://www.linkedin.com")) {
        zvidki_kandidat = "Linkedin";
    } else if (url.includes("https://www.work.ua")) {
        zvidki_kandidat = "work.ua";
    } else if (url.includes("https://rabota.ua")) {
        zvidki_kandidat = "rabota.ua";
    } else if (url.includes("https://robota.ua")) {
        zvidki_kandidat = "robota.ua";
    } else if (url.includes("https://djinni.co")) {
        zvidki_kandidat = "djinni.co";
    } else {
        zvidki_kandidat = "unknown";
    }
    return zvidki_kandidat;
}
// let observer = new MutationObserver(function (mutations) {
if (currentURL.includes('djinni.co')) {
    setTimeout(function () {
        let link = document.querySelector('a.userpic-link').href;
        chrome.runtime.sendMessage({action: 'openTab', url: link});
    }, 100);
}

function checkFrom() {
    chrome.storage.local.get(['authToken'], function(result) {
        if (result.authToken) {
            setTimeout(function () {
                let fullName = getFullName();
                if (fullName.firstName || fullName.lastName) {
                    chrome.runtime.sendMessage({...fullName, action: 'checkCandidate'});
                    // chrome.runtime.sendMessage({...fullName, action: 'getCandidateSalary'});
                    // chrome.runtime.sendMessage({...fullName, action: 'getCandidateSalary'}, function (response) {
                    //     if (chrome.runtime.lastError) {
                    //         console.error(chrome.runtime.lastError);
                    //     } else {
                    //         let salary = $('#zarp');
                    //         let exp = $('#exp-range');
                    //         salary.val(response.salary);
                    //         exp.val(response.exp);
                    //     }
                    // });
                    chrome.runtime.sendMessage({...fullName, action: 'getCandidateSalary'}, function (response) {
                        if (chrome.runtime.lastError) {
                            console.error(chrome.runtime.lastError);
                        } else {
                            // console.log(response);
                            let salary = $('#zarp');
                            let exp = $('#exp-range');
                            let movaSelect = $('#mova-select'); // замените на ваш селект
                            salary.val(response.salary);
                            exp.val(response.exp);
                            if (response.mova) {
                                let movaId = response.mova[0].ID; // Предполагая, что вы хотите установить первый элемент
                                movaSelect.val(movaId).trigger('change');
                            }
                            const contactItems = response.kontakti22.map(item => ({
                                id: item.kontakt222.ID,
                                type: item.kontakt222.post_title,
                                value: item.dannik,
                                kanal_zvyazku: item.kanal_zvyazku
                            }));

                            createFieldGroup(contactItems);

                        }
                    });
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
                    }
                    if (contactButton) {
                        setTimeout(function () {
                            contactButton.click();
                        }, 3000);
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
                                        let contacts = [
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
                                        ];
                                        let existingValues = [...document.querySelectorAll('.contact-field-group input')].map(input => input.value);
                                        contacts = contacts.filter(contact => !existingValues.includes(contact.value));

                                        if (contacts.length > 0) {
                                           createFieldGroup(contacts);
                                        }
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
                                        let contacts = [
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
                                        ];
                                        createFieldGroup(contacts);
                                    }
                                });
                                // contactInfoFetched = true;
                            } else if (linkTelegramRo || linkViberRo || linkWhatsappRo || linkEmailRo || linkPhoneRo) {
                                chrome.runtime.sendMessage({action: 'getContactTypes'}, response => {
                                    if (response.action === 'getContactTypesResult') {
                                        let contactTypes = response.contactTypes;
                                        let contacts = [
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
                                        ];
                                        createFieldGroup(contacts);
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
                                        let contacts = [
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
                                        ];
                                        createFieldGroup(contacts);
                                    }
                                });
                                // contactInfoFetched = true;
                            } else if (linkTelegramRo || linkViberRo || linkWhatsappRo || linkEmailRo || linkPhoneRo) {
                                chrome.runtime.sendMessage({action: 'getContactTypes'}, response => {
                                    if (response.action === 'getContactTypesResult') {
                                        let contactTypes = response.contactTypes;
                                        let contacts = [
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
                                        ];
                                        createFieldGroup(contacts);
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
                                            createFieldGroup(tempContacts);
                                        }
                                    }
                                });
                                // contactInfoFetched = true;
                            }
                        }, 4000);
                    }
                }
            }, 1000);
        }
    })
}

let currentProfile;
function checkURL() {
    const profile = window.location.pathname.split('/')[2];
    if (profile && profile !== currentProfile) {
        currentProfile = profile;
        const elements = document.getElementsByClassName('contact-field-group');
        while (elements[0]) {
            elements[0].parentNode.removeChild(elements[0]);
        }
        checkFrom();
    }
    // chrome.storage.local.get(['username'], function (result) {
    //     document.getElementsByClassName('ext-wrapper').dataset.result;
    // });
}
checkURL();

const observer = new MutationObserver(checkURL);
observer.observe(document, {subtree: true, childList: true});

btn.onclick = function () {
    if (popup.style.left === '-355px') {
        popup.style.left = '5px';
        popup.style.opacity = '1';
    } else {
        popup.style.left = '-355px'; // Скрываем попап
        popup.style.opacity = '0';
    }
};


// async function checkCandidate() {
//     let fullName = getFullName();
//     let lastName = fullName.lastName;
//     return new Promise((resolve, reject) => {
//         chrome.runtime.sendMessage({action: 'checkCandidate', lastName: lastName}, function (response) {
//             if (response && response.action === 'checkCandidateResult') {
//                 console.log('checkCandidateresponse : ', response.exists);
//                 resolve(response.exists);
//             } else {
//                 console.error('Failed to check candidate');
//                 reject(new Error('Failed to check candidate'));
//             }
//         });
//     });
// }
let existsIdVac = '';
async function checkCandidate() {
    // setTimeout(function () {

    let fullName = getFullName();
    let lastName = fullName.lastName;
    if (!lastName) { // если имя кандидата не существует
        // console.log('No candidate found'); // или любая другая обработка ошибок
        return;
    }
    let candidateInfo22 = document.getElementById('candidateInfo22');
    // console.log(candidateInfo22);
    // console.log(candidateInfo22.dataset);
    // console.log(candidateInfo22.dataset.existsIdVac);
    if (candidateInfo22) {
        existsIdVac = candidateInfo22.dataset.existsIdVac;
        // console.log(existsIdVac); // Здесь будет выведено значение existsIdVac
    }
    return new Promise((resolve, reject) => {
        chrome.runtime.sendMessage({action: 'checkCandidate', lastName: lastName}, function (response) {
            // console.log(response);
            if (response && response.action === 'checkCandidateResult') {
                // console.log(response);
                if (response.exists) {
                    let candidateInfoElement = document.getElementById('candidateInfo'); // Получить элемент
                    let candidateInfo22 = document.getElementById('candidateInfo22'); // Получить элемент
                    if (candidateInfoElement) {
                        // console.log(response.exists.id);
                        candidateInfoElement.dataset.existsId = response.exists.id ? response.exists.id : '';
                    }
                    if (candidateInfo22) { // Проверить существование элемента
                        candidateInfo22.dataset.existsIdVac = response.exists.id_vac ? response.exists.id_vac : '';
                    }
                    resolve(response.exists);
                } else {
                    // console.log('No candidate matches the given name');
                    resolve(null); // Кандидат не найден
                }
            } else {
                console.error('Failed to check candidate');
                reject(new Error('Failed to check candidate'));
            }
        });
    });
    // }, 100 );
}



chrome.runtime.onMessage.addListener(function (request, sender, sendResponse) {
    // if (request.action === "saveCandidate") {
    //     console.log('request');
    //     let fullName = getFullName();
    //     let allInfo = getAllInfo();
    //     let foto = getProfileImageUrl();
    //     let rezume = getCvUrl();
    //     let cvComb = cvFile();
    //     sendResponse({...fullName, allInfo, foto, rezume, cvComb});
    // }
    if (request.action === 'updateColor') {
        // Запустить функцию проверки кандидата, как вы делали ранее
        // Затем изменить цвет кнопки в зависимости от результата
        checkCandidate()
            .then(candidateExists => {
                setTimeout(function () {
                    let addButton = document.getElementById('maininfobtn');
                    if (candidateExists) {
                        addButton.style.background = 'rgba(255, 0, 0, 1)';
                    } else {
                        addButton.style.background = '#16a086';
                    }
                }, 500);

            });
    }
    if (request.action === 'updateContactInfo') {
        createFieldGroup(request.contacts);
    }
});

let globalContacts = null;
chrome.runtime.sendMessage({action: 'fetchContacts'}, function (response) {
    if (chrome.runtime.lastError) {
        console.error(chrome.runtime.lastError);
    } else {
        globalContacts = response.contacts;
        // createFieldGroup(response.contacts);
        // createUserFieldGroup();
    }
});
createToggleSwitchers();
showZarplata();
showLanguageLevels();
showExpLevel();
showAdditionalInfo();

let addButton = document.getElementById('add-button');
addButton.addEventListener('click', function () {
    createUserFieldGroup();
});
chrome.runtime.sendMessage({action: 'fetchLanguages'}, function (response) {
    if (chrome.runtime.lastError) {
        console.error(chrome.runtime.lastError);
    } else {
        showPopupWithPosts(response.posts);
    }
});
chrome.runtime.sendMessage({action: 'fetchNoit'}, function (response) {
    if (chrome.runtime.lastError) {
        console.error(chrome.runtime.lastError);
    } else {
        showPopupWithNoitPosts(response.posts);
    }
});
chrome.runtime.sendMessage({action: 'fetchLanguageTypes'}, function (response) {
    if (chrome.runtime.lastError) {
        console.error(chrome.runtime.lastError);
    } else {
        showLanguageTypes(response.posts);
    }
});
// chrome.runtime.sendMessage({ action: 'showLanguageLevels' }, function() {
//     if (chrome.runtime.lastError) {
//         console.error(chrome.runtime.lastError);
//     } else {
//         showLanguageLevels();
//     }
// });
chrome.runtime.sendMessage({action: 'showAdditionalInfo'}, function () {
    if (chrome.runtime.lastError) {
        console.error(chrome.runtime.lastError);
    } else {
        showAdditionalInfo();
    }
});
chrome.runtime.sendMessage({action: 'showRegion'}, function (response) {
    if (chrome.runtime.lastError) {
        console.error(chrome.runtime.lastError);
    } else {
        showRegion(response.posts);
    }
});
async function fetchDataAndShowVacancy() {
    try {
        await checkCandidate();

        chrome.runtime.sendMessage({action: 'showVac'}, function (response) {
            if (chrome.runtime.lastError) {
                console.error(chrome.runtime.lastError);
            } else {
                showVacancy(response.posts);
            }
        });
    } catch (error) {
        console.error('Error:', error);
    }
}

// Вызовите эту функцию там, где вам нужно выполнить эти действия.
fetchDataAndShowVacancy();

$(document).on('change', '#vac-select', function (e) {
    let selectedVacId = Array.from(this.selectedOptions).map(option => option.value);
    let numVacId = Number(selectedVacId[0]);
    chrome.runtime.sendMessage({action: 'saveVacancyId', vacancyId: numVacId});
    chrome.runtime.sendMessage({action: 'showVacStage'}, function (response) {
        if (chrome.runtime.lastError) {
            console.error(chrome.runtime.lastError);
        } else {
            showVacancyStage(response.posts);
        }
    });
});
chrome.runtime.sendMessage({action: 'showTags'}, function (response) {
    if (chrome.runtime.lastError) {
        console.error(chrome.runtime.lastError);
    } else {
        showTags(response.posts);
    }
});

let saveButton = document.getElementById('save-button');
let saveButtonPlus = document.getElementById('maininfobtnPlus');
function handleClick() {
    let maininfob = document.getElementById('maininfobtn');
    maininfob.style.background = '#0081ff';
    maininfob.style.transform = 'rotate(360deg)';
    maininfob.style.transition = '3s';
    maininfob.style.transitionDuration = '15s';
    let contactFields = Array.from(document.querySelectorAll('.contact-field-group'));
    let contacts = contactFields.map(field => {
        return {
            id: field.querySelector('select').value,
            value: field.querySelector('input').value,
            kanal_zvyazku: field.querySelector('input[type="checkbox"]').checked
        };
    });

    let fullName = getFullName();
    let firstName = fullName.firstName;
    let lastName = fullName.lastName;
    let allInfo = getAllInfo();
    let foto = getProfileImageUrl();
    let rezume = getCvUrl();
    let cvComb = cvFile();
    let zvidku = zvidkuKandudat();

    function getFormValues() {
        let select = document.getElementById('language-select');
        let selectNoit = document.getElementById('noit-select');
        let selectMova = document.getElementById('mova-select');
        let selectReg = document.getElementById('reg-select');
        let selectVac = document.getElementById('vac-select');
        let selectVacStage = document.getElementById('stage-select');
        let selectTag = document.getElementById('tags-select');
        let selectAdditional = document.getElementById('additional-info');
        let selectAdditionalCh = document.getElementById('mainComment');
        let selectEngLevels = document.getElementById('language-level-select');
        let selectExpRange = document.getElementById('exp-range');
        let zarplataInput = document.getElementById('zarp');

        let selectedVacStageId = selectVacStage ? Array.from(selectVacStage.selectedOptions).map(option => option.value) : [];
        let valVacStageId = selectedVacStageId.length > 0 ? selectedVacStageId[0].toString() : '';
        let zarplataValue = zarplataInput ? zarplataInput.value : '';
        // console.log(!!selectAdditionalCh.checked);
        return {
            positionId: select ? Array.from(select.selectedOptions).map(option => option.value) : [],
            positionIdName: select ? Array.from(select.selectedOptions).map(option => option.text) : [],
            positionNoitId: selectNoit ? Array.from(selectNoit.selectedOptions).map(option => option.value) : [],
            positionNoitIdName: selectNoit ? Array.from(selectNoit.selectedOptions).map(option => option.text) : [],
            mova: selectMova ? Array.from(selectMova.selectedOptions).map(option => option.value) : [],
            movaName: selectMova ? Array.from(selectMova.selectedOptions).map(option => option.text) : [],
            city: selectReg ? Array.from(selectReg.selectedOptions).map(option => option.value) : [],
            cityName: selectReg ? Array.from(selectReg.selectedOptions).map(option => option.text) : [],
            vacid: selectVac ? Number(Array.from(selectVac.selectedOptions).map(option => option.value)[0]) : null,
            vacidName: selectVac ? Array.from(selectVac.selectedOptions).map(option => option.text)[0] : [],
            candidate_st: valVacStageId ? valVacStageId : '',
            tag: selectTag ? Array.from(selectTag.selectedOptions).map(option => option.value) : [],
            adinf: selectAdditional ? selectAdditional.value : '',
            adinfch: !!selectAdditionalCh.checked,
            engl: selectEngLevels ? selectEngLevels.value : '',
            englName: selectEngLevels ? selectEngLevels.text : '',
            exp: selectExpRange ? selectExpRange.value : '',
            zarplata: zarplataValue ? zarplataValue : ''
        };
    }

    let candidateInfoElement = document.getElementById('candidateInfo'); // Получить элемент
    let exists = null;
    if (candidateInfoElement) { // Проверить существование элемента
        exists = candidateInfoElement.dataset.existsId; // Получить значение data-атрибута
        // console.log(exists);
    }
    const formValues = getFormValues();
    chrome.runtime.sendMessage({
        action: 'saveCandidate',
        contacts: contacts ? contacts : [],
        firstName: firstName ? firstName : '',
        lastName: lastName ? lastName : '',
        allInfo: allInfo ? allInfo : '',
        foto: foto ? foto : '',
        rezume: rezume ? rezume : '',
        cvComb: cvComb ? cvComb : '',
        candidateId: exists ? exists : '',
        zvidku: zvidku ? zvidku : '',
        ...formValues
    }, function (response) {
        if (!response) {
            return;
        }
        if (chrome.runtime.lastError) {
            console.error(chrome.runtime.lastError);
            return;
        }

        // console.log("Message sent successfully");  // Log successful message
        // console.log(response);  // Log the recipient's response
        let maininfob = document.getElementById('maininfobtn');
        maininfob.style.background = 'rgba(255, 0, 0, 1)';
        maininfob.style.transition = '3s';
        maininfob.style.transitionDuration = '3s';
    });
    // function getFormValues() {
    //     const ids = ['language-select', 'noit-select', 'mova-select', 'reg-select', 'vac-select', 'stage-select', 'tags-select', 'additional-info', 'language-level-select', 'exp-range', 'zarp'];
    //     const values = ids.reduce((acc, id) => {
    //         const select = document.getElementById(id);
    //         if (select) {
    //             acc[id] = Array.from(select.selectedOptions).map(option => option.value);
    //             // Если выбор должен быть числом, преобразуем его в число
    //             if (id === 'vac-select' && acc[id].length > 0) {
    //                 acc[id] = Number(acc[id][0]);
    //             }
    //             // Если значение состоит из нескольких элементов, преобразуем его в строку
    //             if (id === 'stage-select' && acc[id].length > 0) {
    //                 acc[id] = acc[id][0].toString();
    //             }
    //         }
    //         return acc;
    //     }, {});
    //
    //     return values;
    // }


    // });
    chrome.runtime.sendMessage({action: 'fetchLanguageTypes'}, response => {
        if (chrome.runtime.lastError) {
            console.error(chrome.runtime.lastError);
        } else {
            let selectMova = document.getElementById('mova-select');
            if (selectMova) {
                let selectedMovaId = selectMova.value;
                chrome.runtime.sendMessage({
                    ...response,
                    mova: selectedMovaId,
                    action: 'fetchLanguageTypes'
                }, function (response) {
                    if (chrome.runtime.lastError) {
                        console.error(chrome.runtime.lastError);
                    } else {
                    }
                });
            } else {
                console.error('Language select element not found');
            }
        }
    });
}
saveButton.addEventListener('click', handleClick);
saveButtonPlus.addEventListener('click', handleClick);

$('select').on('select2:select', function (e) {
    let selectedOptions = $(this).val();  // Получаем массив выбранных значений
    if (selectedOptions.length > 1 && selectedOptions.includes('all')) {
        let index = selectedOptions.indexOf('all');
        if (index > -1) {
            selectedOptions.splice(index, 1);
        }
        $(this).val(selectedOptions).trigger('change');
    }
});
$(document).on('mousedown', function (e) {
    let opened = $(".select2-container--open");
    if (opened.length > 0) {
        let inContainer = opened.has(e.target).length > 0;
        let isContainer = opened.is(e.target);

        if (!inContainer && !isContainer) {
            let instances = $.fn.select2.amd.require('select2/dropdown/closeOnSelect');
            instances.close();
        }
    }
});

function createToggleSwitchers() {
    let buttonPosts = document.createElement('button');
    buttonPosts.id = 'button-posts';
    buttonPosts.innerText = 'ІТ';
    let buttonNoitPosts = document.createElement('button');
    buttonNoitPosts.id = 'button-noitposts';
    buttonNoitPosts.innerText = 'Інше';
    buttonPosts.addEventListener('click', function () {
        document.getElementById('pop-noit').style.display = 'none'; // скрыть NoitPosts
        document.getElementById('pop-prof').style.display = 'block'; // показать Posts
    });
    buttonNoitPosts.addEventListener('click', function () {
        document.getElementById('pop-prof').style.display = 'none'; // скрыть Posts
        document.getElementById('pop-noit').style.display = 'block'; // показать NoitPosts
    });
    let popup = document.getElementById('toogler'); // замените 'popup' на ID вашего попапа
    popup.appendChild(buttonPosts);
    popup.appendChild(buttonNoitPosts);
}

function showPopupWithPosts(posts) {
    let select = document.createElement('select');
    select.id = 'language-select';
    select.setAttribute('multiple', 'multiple');  // Добавьте эту строку, чтобы сделать Select2 мультиселектом
    posts.forEach(post => {
        let option = document.createElement('option');
        option.value = post.id;
        option.text = post.title.rendered;
        select.appendChild(option);
    });
    let popup = document.getElementById('pop-prof');
    popup.appendChild(select);
    $('#language-select').select2({
        closeOnSelect: false,
    });
    let savedValues = localStorage.getItem('selectedValues');
    if (savedValues) {
        $('#language-select').val(JSON.parse(savedValues)).trigger('change');
    }

    // Сохранить выбранные значения при изменении
    $('#language-select').on('change', function() {
        let selectedValues = $(this).val();
        localStorage.setItem('selectedValues', JSON.stringify(selectedValues));
    });
    document.getElementById('pop-prof').style.display = 'block';
}

function showPopupWithNoitPosts(posts) {
    let select = document.createElement('select');
    select.id = 'noit-select';
    select.setAttribute('multiple', 'multiple');  // Добавьте эту строку, чтобы сделать Select2 мультиселектом
    posts.forEach(post => {
        let option = document.createElement('option');
        option.value = post.id;
        option.text = post.title.rendered;
        select.appendChild(option);
    });
    let popup = document.getElementById('pop-noit');
    popup.appendChild(select);
    $('#noit-select').select2({
        closeOnSelect: false,
    });
    let savedNoValues = localStorage.getItem('noitValues');
    if (savedNoValues) {
        $('#noit-select').val(JSON.parse(savedNoValues)).trigger('change');
    }
    $('#noit-select').on('change', function() {
        let noitValues = $(this).val();
        localStorage.setItem('noitValues', JSON.stringify(noitValues));
    });
    document.getElementById('pop-noit').style.display = 'none';
}

function showZarplata() {
    let zarplataInput = document.createElement('input');
    zarplataInput.id = 'zarp';
    let popup = document.getElementById('pop-zp');
    popup.appendChild(zarplataInput);
}

function showLanguageTypes(posts) {
    let select = document.createElement('select');
    select.id = 'mova-select';
    select.setAttribute('multiple', 'multiple');  // Добавьте эту строку, чтобы сделать Select2 мультиселектом
    posts.forEach(post => {
        let option = document.createElement('option');
        option.value = post.id;
        option.text = post.title.rendered;
        select.appendChild(option);
    });
    let popup = document.getElementById('pop-mova');
    popup.appendChild(select);
    $('#mova-select').select2({
        closeOnSelect: false,
    });
}

function showRegion(posts) {
    let select = document.createElement('select');
    select.id = 'reg-select';
    select.setAttribute('multiple', 'multiple');  // Добавьте эту строку, чтобы сделать Select2 мультиселектом
    posts.forEach(post => {
        let option = document.createElement('option');
        option.value = post.id;
        option.text = post.title.rendered;
        select.appendChild(option);
    });
    let popup = document.getElementById('region');
    popup.appendChild(select);
    $('#reg-select').select2({
        closeOnSelect: false,
    });
}

function showVacancy(posts) {
    let select = document.createElement('select');
    select.id = 'vac-select';
    select.appendChild(new Option('Оберіть вакансію', ''));
    setTimeout(function () {
    posts.forEach(post => {
            let option = document.createElement('option');
        option.value = post.id;
        option.text = post.title.rendered;
        if (post.id === Number(existsIdVac)) {
            option.classList.add('highlight-option');
        }
        select.appendChild(option);
    });
    let popup = document.getElementById('vacancy');
    popup.appendChild(select);

        $('#vac-select').select2({
            closeOnSelect: true,
            templateResult: function (data) {
                // console.log('data.id', data);
                if (data.id === null || !data.element || data.element.className.indexOf('optgroup') > -1) {
                    return data.text;
                }
                var $element = $('<span>' + data.text + '</span>');
                if (data.element.value === existsIdVac) {
                    $element.addClass('highlight-option').parent().css({'color':'red', 'font-weight':'bold'});
                }
                return $element;
            }
        });

        let savedValue = localStorage.getItem('selectedVacancy');
    if (savedValue) {
        $('#vac-select').val(savedValue).trigger('change');
    }
    $('#vac-select').on('change', function() {
        let selectedValue = $(this).val();
        localStorage.setItem('selectedVacancy', selectedValue);
    });
    },2000);
}

function showVacancyStage(posts) {
    let popup = document.getElementById('stage');
    popup.innerHTML = '';  // Clear the popup's content before appending the new select
    let select = document.createElement('select');
    let textStage = document.createElement('h3');
    textStage.innerText = 'Етапи'; // use innerText or textContent here
    select.id = 'stage-select';
    posts.forEach(post => {
        let option = document.createElement('option');
        option.value = post;
        option.text = post;
        select.appendChild(option);
    });
    popup.appendChild(textStage);
    popup.appendChild(select);
    $('#stage-select').select2({
        closeOnSelect: true,
    });
    let savedValue = localStorage.getItem('selectedVacancyStage');
    if (savedValue) {
        $('#stage-select').val(savedValue).trigger('change');
    }
    $('#stage-select').on('change', function() {
        let selectedValue = $(this).val();
        localStorage.setItem('selectedVacancyStage', selectedValue);
    });
}

function showTags(posts) {
    let select = document.createElement('select');
    select.id = 'tags-select';
    select.setAttribute('multiple', 'multiple');  // Добавьте эту строку, чтобы сделать Select2 мультиселектом
    posts.forEach(post => {
        let option = document.createElement('option');
        option.value = post.id;
        option.text = post.title.rendered;
        select.appendChild(option);
    });
    let popup = document.getElementById('tags');
    popup.appendChild(select);
    $('#tags-select').select2({
        closeOnSelect: false,
    });
}

function createFieldGroup(contacts) {
    contacts = contacts || [];
    // console.log(contacts);
    if (Array.isArray(contacts)) {
        for (let contact of contacts) {
            let fieldGroup = document.createElement('div');
            fieldGroup.className = 'contact-field-group';
            let selectElement = document.createElement('select');
            let inputElement = document.createElement('input');
            let checkboxElement = document.createElement('input');
            checkboxElement.type = 'checkbox';
            checkboxElement.name = 'kanal_zvyazku';
            checkboxElement.id = 'kanal_zvyazku';
            for (let optionContact of contacts) {
                let selectOption = document.createElement('option');
                selectOption.value = optionContact.id;
                selectOption.text = optionContact.type;
                if (optionContact.id === contact.id) {
                    selectOption.selected = true;
                }
                selectElement.add(selectOption);
            }
            let contactValue = contact.value ? contact.value.replace('mailto:', '') : "";
            inputElement.value = contactValue;
            fieldGroup.appendChild(selectElement);
            fieldGroup.appendChild(inputElement);
            fieldGroup.appendChild(checkboxElement);
            let popup = document.getElementById('contacts');
            popup.appendChild(fieldGroup);
        }
    } else {
        console.error('Contacts is not an array:', contacts);
    }
}

function createUserFieldGroup() {
    let fieldGroup = document.createElement('div');
    fieldGroup.className = 'contact-field-group';
    let selectElement = document.createElement('select');
    let inputElement = document.createElement('input');
    let checkboxElement = document.createElement('input');
    checkboxElement.type = 'checkbox';
    checkboxElement.name = 'kanal_zvyazku';
    checkboxElement.id = 'kanal_zvyazku';
    for (let contact of globalContacts) {
        let selectOption = document.createElement('option');
        selectOption.value = contact.id;
        selectOption.text = contact.title.rendered;
        selectElement.add(selectOption);
    }
    fieldGroup.appendChild(selectElement);
    fieldGroup.appendChild(inputElement);
    fieldGroup.appendChild(checkboxElement);
    let popup = document.getElementById('contacts');
    popup.appendChild(fieldGroup);
}

function showLanguageLevels() {
    let select = document.createElement('select');
    select.id = 'language-level-select';
    let languageLevels = {
        "1": "Beginner / Elementary (A1)",
        "2": "Pre-intermediate (A2)",
        "3": "Intermediate (B1)",
        "4": "Upper-intermediate (B2)",
        "5": "Advanced (C1)",
        "6": "Fluent (C2)"
    };
    for (let key in languageLevels) {
        let option = document.createElement('option');
        option.value = key;
        option.text = languageLevels[key];
        select.appendChild(option);
    }
    let popup = document.getElementById('pop-mova-r');
    popup.appendChild(select);
}

function showAdditionalInfo() {
    let tinput = document.createElement('textarea');
    tinput.id = 'additional-info';
    let checkboxElement = document.createElement('input');
    checkboxElement.type = 'checkbox';
    checkboxElement.name = 'mainComment';
    checkboxElement.id = 'mainComment';
    let checkboxLabel = document.createElement('span');
    checkboxLabel.textContent = 'Основний коментар';
    let popup = document.getElementById('comments');
    popup.appendChild(tinput);
    popup.appendChild(checkboxElement);
    popup.appendChild(checkboxLabel);
}

function showExpLevel() {
    let rangeInput = document.createElement('input');
    rangeInput.id = 'exp-range';
    rangeInput.type = 'range';
    rangeInput.min = 0;
    rangeInput.max = 15;
    rangeInput.step = 0.5;
    let rangeValueInput = document.createElement('input');
    rangeValueInput.id = 'exp-range-value';
    rangeValueInput.type = 'number';
    rangeValueInput.readOnly = true; // чтобы пользователь не мог изменить его вручную
    rangeValueInput.value = rangeInput.value;
    rangeInput.addEventListener('input', function () {
        let expValue = this.value;
        rangeValueInput.value = expValue; // обновляем значение индикатора
    });
    let popup = document.getElementById('pop-dos');
    popup.appendChild(rangeInput);
    popup.appendChild(rangeValueInput);
}

// },3000 );

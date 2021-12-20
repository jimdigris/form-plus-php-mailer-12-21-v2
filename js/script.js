'use strict';

// делает не активной кнопку Отправить, если нет галочки в политике перс данных
(function () {
    const jForms = Array.from(document.querySelectorAll('.j-form'));

    if (jForms) {
        jForms.forEach(jForm => {
            let button = jForm.querySelector('.j-form-send');
            let hideCheckbox = jForm.querySelector('.j-form-hide-checkbox');
            let chekPolicy = jForm.querySelector('.j-form-chek-policy');
            let labelPolicy = jForm.querySelector('.j-form-label-policy');

            if ((button) && (hideCheckbox) && (labelPolicy) && (chekPolicy)) {
                labelPolicy.addEventListener('click', () => { changeButtonState(hideCheckbox, button); });
                chekPolicy.addEventListener('click', () => { changeButtonState(hideCheckbox, button); });
            }
        });
    }

    function changeButtonState(checkbox, button) {
        if (checkbox.checked) { button.disabled = 'true'; } else { button.removeAttribute('disabled'); }
    }
})();

// отправка формы обратной связи на почту
function send(event, php, nameInfoForm) {
    event.preventDefault ? event.preventDefault() : event.returnValue = false;
    let infoForm = document.querySelector(`.${nameInfoForm}`);
    showInformation(infoForm, 'expectation');

    let req = new XMLHttpRequest();
    req.open('POST', php, true);
    req.onload = function () {
        if (req.status >= 200 && req.status < 400) {
            let json = JSON.parse(this.response);
            if (json.result == "success") { showInformation(infoForm, 'success'); } else { showInformation(infoForm, 'error'); }
        } else { showInformation(infoForm, 'error'); }
    };

    req.onerror = function () { alert("Ошибка отправки запроса"); };
    req.send(new FormData(event.target));

    event.target.reset();

    // выведем информацию об отправке
    function showInformation(infoForm, sendStatus) {
        if (infoForm) {
            infoForm.style.display = 'block';
            let color, text;

            switch (sendStatus) {
                case 'expectation':
                    color = '#cd8f4f';
                    text = 'Отправка сообщения.';
                    break;

                case 'success':
                    color = '#62c169';
                    text = 'Сообщение отправлено.';
                    break;

                case 'error':
                    color = '#e97474';
                    text = 'Сообщение не отправлено. Свяжитесь пожалуйста с нами другим способом.';
                    break;
            }

            infoForm.style.backgroundColor = color;
            infoForm.textContent = text;
        }
    }
}
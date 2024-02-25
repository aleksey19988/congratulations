import {
    Datepicker,
    Input,
    initTE,
} from "tw-elements";

initTE({ Datepicker, Input });

window.onload = function() {
    const datepickerDisableFuture = document.getElementById('date-input');
    if (datepickerDisableFuture) {
        // Костыль для ситуаций, когда календарь был открыт и закрыт (между открытием и закрытием не было кликов)
        datepickerDisableFuture.onclick = function() {
            setTimeout(function() {
                datepickerDisableFuture.click();
            }, 100);
        };
        new Datepicker(datepickerDisableFuture, {
            disableFuture: true,
            showFormat: true,
            cancelBtnText: 'Отмена',
            clearBtnText: 'Очистить',
            monthsFull: [
                'Январь',
                'Февраль',
                'Март',
                'Апрель',
                'Май',
                'Июнь',
                'Июль',
                'Август',
                'Сентябрь',
                'Октябрь',
                'Ноябрь',
                'Декабрь',
            ],
            monthsShort: [
                'Янв',
                'Фев',
                'Мар',
                'Апр',
                'Май',
                'Июн',
                'Июл',
                'Авг',
                'Сент',
                'Окт',
                'Ноя',
                'Дек',
            ],
            title: 'Выберите дату',
            startDay: 0,
            weekdaysFull: [
                'Понедельник',
                'Вторник',
                'Среда',
                'Четверг',
                'Пятница',
                'Суббота',
                'Воскресенье',
            ],
            weekdaysNarrow: ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вскр'],
            weekdaysShort: ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вскр'],
            datepickerCell: "text-red-700",
            datepickerTitleText: "text-red-700"
        });
    }

    // Удаление border у псевдоэлементов поля ввода даты
    let datepickerPseudoElements = document.querySelectorAll('.pointer-events-none');
    datepickerPseudoElements.forEach(function(elem) {
        elem.style.border = 'none';
    });
}



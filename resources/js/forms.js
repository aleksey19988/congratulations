import {
    Datepicker,
    Input,
    initTE,
} from "tw-elements";

initTE({ Datepicker, Input });

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
    });
}

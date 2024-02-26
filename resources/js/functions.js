export function detecDevice() {
    let device = '';

    // Если desktop - отображается datepicker, иначе - input[type="date"]
    if (navigator.userAgent.match(/Android/i)
        || navigator.userAgent.match(/webOS/i)
        || navigator.userAgent.match(/iPhone/i)
        || navigator.userAgent.match(/iPad/i)
        || navigator.userAgent.match(/iPod/i)
        || navigator.userAgent.match(/BlackBerry/i)
        || navigator.userAgent.match(/Windows Phone/i)
    ) {
        document.getElementById('js-mobile-date-input-container').classList.remove('hidden');
        document.getElementById('js-mobile-date-input-container').classList.add('flex');
    } else {
        document.getElementById('js-desktop-date-input-container').classList.remove('hidden');
        document.getElementById('js-desktop-date-input-container').classList.add('flex');
    }
}

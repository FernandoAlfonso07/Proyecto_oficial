document.addEventListener('DOMContentLoaded', () => {
    let elementTimer = document.getElementById('timer');
    let time = parseInt(elementTimer.getAttribute('data-seconds'), 10);

    const executeTimer = () => {
        if (time > 0) {
            time--; // Reduce el tiempo en cada intervalo
            elementTimer.innerHTML = "<h1>" + time + "s</h1>";
        } else {
            clearInterval(intervalTime);
            elementTimer.innerHTML = '<a href="enRutinasCr.php?usu=' + encodeURIComponent(usu) + '&calendar=' + encodeURIComponent(calendarID) + '&p=' + encodeURIComponent(page) + '"><button class="btn btn-primary">Continuar Rutina</button></a>';
        }
    };

    const intervalTime = setInterval(executeTimer, 1000);
});
$(document).ready(function (e) {
    var checked = JSON.parse(localStorage.isActivated);
    options.isActivated.checked = checked;
    changeColor(checked);
    var active = $('#active');
    active.click(function (e) {
        var checked = options.isActivated.checked;
        localStorage.isActivated = checked;
        changeColor(checked);
    });
});

function changeColor(checked) {
    options.style.color = checked ? 'black' : 'graytext';
}
// Flatpickr

var f11 = flatpickr(document.getElementById('basicFlatpickr1'), {
     dateFormat: "d-m-Y",
});
var f12 = flatpickr(document.getElementById('basicFlatpickr2'), {
     dateFormat: "d-m-Y",
});
var f1 = flatpickr(document.getElementById('basicFlatpickr'), {
     dateFormat: "d-m-Y",
});
var f2 = flatpickr(document.getElementById('dateTimeFlatpickr'), {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
});
var f3 = flatpickr(document.getElementById('rangeCalendarFlatpickr'), {
    mode: "range",
});
var f4 = flatpickr(document.getElementById('timeFlatpickr'), {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    defaultDate: "13:45"
});
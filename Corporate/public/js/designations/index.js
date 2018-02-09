function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
    $('#_company_designation_list').addClass('highlight-border');
}
function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    console.log();
    $('#_company_designation_list').removeClass('highlight-border');
    if (ev.target.nodeName == 'UL')
    {
        ev.target.appendChild(document.getElementById(data));
    } else {
        $(ev.target).insertBefore(document.getElementById(data));
    }
}
$(document).ready(function () {
    demo.initMaterialWizard();
//        demo.initFormExtendedDatetimepickers();
    setTimeout(function () {
        $('.card.wizard-card').addClass('active');
    }, 600);
});

function searchEmployees(emp_url, target_ele)
{
    var emp_code = $('#_emp_code_search').val();
    var emp_name = $('#_emp_name_search').val();
    var emp_dep = $('#_emp_dep_search').val();
//    var awrd_url = emp_url;//getBaseUrl('awards/create');
    $.get(emp_url, {'emp_code': emp_code, 'emp_name': emp_name, 'emp_dep': emp_dep}).done(function (data) {
        $('#' + target_ele).html('');
        $('#' + target_ele).html(data);
    });
}
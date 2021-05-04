
$('#add-btn').click(function (e) {
    $('#table_name').text('Имя группы: '+$('#name_of_group').val());
});

let class_create = function(number){
    let _class = document.createElement('div');
    $(_class).addClass('time');
    $(_class).addClass('time-'+number);

    let time = document.createElement('div');
    $(time).text(number);

    let buttons = document.createElement('div');
    $(buttons).addClass('buttons-area');
    let button_add = document.createElement('button');
    let button_del = document.createElement('button');
    $(button_add).text('Add');
    $(button_del).text('Del');
    $(button_add).appendTo($(buttons));
    $(button_del).appendTo($(buttons));


    $(buttons).appendTo($(_class));
    $(time).appendTo($(_class));
    return _class;
}

let day_create = function(number){
    let day = document.createElement('div');
    $(day).addClass('day');
    $(day).attr('id', 'day-'+number);
    for (let time = 1; time < 8; time++) {
        let _class = document.createElement('form')
        _class = class_create(time);
        $(_class).appendTo($(day));
    }
    return day;
}

$(document).ready(function () {
    for (let day = 1; day < 7; day++) {
        // $(day_create(day)).appendTo('#table');		
    }
});

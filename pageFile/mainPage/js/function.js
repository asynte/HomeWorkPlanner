/**
 * Created by KiwiDc on 6/9/15.
 */

$(".pinned").pin();
$('#idCheckbox').prop('checked', false);



function addStunt() {

    $('input').iCheck({
        checkboxClass: 'icheckbox_flat-red',
        radioClass: 'iradio_flat-red',
        increaseArea: '20%'

    });

// handle inputs only inside $('.block')
    $('.block input').iCheck();

// handle only checkboxes inside $('.test')
    $('.test input').iCheck({
        handle: 'checkbox'
    });

// handle .vote class elements (will search inside the element, if it's not an input)
    $('.vote').iCheck();

// you can also change options after inputs are customized
    $('input.some').iCheck({
        // different options
    });
}

$(document).ready(function () {
    addStunt();
})


function userControl()
{
    alert('Function userControl() Trigger!');
}




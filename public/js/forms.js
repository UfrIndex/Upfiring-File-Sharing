'use strict';

$('input#exampleFormControlFile1').change(function(){
    let path = $(this).val();
    let name = path.substring(path.lastIndexOf('\\')+1,path.length);
    $('#labelexampleFormControlFile1').text(name);
});

$('input#poster').change(function(){
    let path = $(this).val();
    let name = path.substring(path.lastIndexOf('\\')+1,path.length);
    $('#labelposter').text(name);
});

$("#add-comment-form").on("submit", function (e) {
    e.preventDefault();
    var $form = $(this);
    $.ajax({
        type: $form.attr('method'),
        url: $form.attr('action'),
        dataType: 'json',
        data: $form.serialize(),
        success: function(data) {
            if ( data.status == 'error' ) {
                alert ( 'Error. Try later.' );
            }
            else {
                $("#comments-list").append(data.comment);
            }
        }
    }).fail(function() {
        alert('Error. Try later.');
    });
});

$(".count").hover(  function() {
    $( this ).addClass( "hover" );
}, function() {
    $( this ).removeClass( "hover" );
});


function show_auth_modal() {
    $('#exampleModal').toggleClass('show').toggle();
    $('body').css('overflow','hidden');
}


function set_like(id, status, infile = 0) {
    $.ajax({
        type: 'post',
        url: '/'+id+'/'+status,
        dataType: 'json',
        data: {
            "infile": infile
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            console.log(data.code);
            if ( data.status == 'error' ) {
                alert ( 'Error. Check, maybe you are not authorized?.' );
            }
            else {
                if (infile == 0) {
                    $('#'+id+ ' .count').html(data.code);
                }
                else {
                    $('.add-like').html(data.code);
                }
            }
        }
    }).fail(function() {
        alert('Error. Check, maybe you are not authorized?.');
    });
}

$(document).on('click', '.auth-in-file .add-like .like', function(){
    set_like($(this).data("id"), 'like', 1);
});

$(document).on('click', '.auth-in-file .add-like .dislike', function(){
    set_like($(this).data("id"), 'dislike', 1);
});

$('.auth .add-like .like').click(function (e) {
    set_like($(this).data("id"), 'like');
});

$('.auth .add-like .dislike').click(function (e) {
    set_like($(this).data("id"), 'dislike');
});

$('.delete-file').click(function (e) {
    delete_ufr_file($(this).data("id"));
});

$('.change-comment-status').click(function (e) {
    $.ajax({
        type: 'post',
        url: 'admin/comments/change-status/' + $(this).data("id"),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            $(this).html(data);

        }
    }).fail(function() {
        alert('Error. Try later.');
    });
});


function send_report(id, type, text= null) {
    $.ajax({
        type: 'post',
        url: '/'+id+'/report',
        data: { type: type,
            ufr_file_id: id,
            text: text,
        },
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            console.log(data);
            if ( data.status == 'error' ) {
                alert ( 'Error. Check, maybe you are not authorized?.' );
            }
            else {
                $('#'+id+ ' .count').html(data.code);

            }
        }
    }).fail(function() {
        alert('Error. Check, maybe you are not authorized?.');
    });
}


function delete_ufr_file(id) {
    $.ajax({
        type: 'post',
        url: '/upload-ufr/'+id+'/delete',
        data: { id: id
        },
        dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            console.log(data);
            if ( data.status == 'error' ) {
                alert ( 'Error. Check, maybe you are not authorized?.' );
            }
            else {
               // window.location.href = '/home';
            }
        }
    }).fail(function() {
        alert('Error. Check, maybe you are not authorized?.');
    });
}

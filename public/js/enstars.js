jQuery('body').on('click', '.bloom', function () {
    var ID = jQuery(this).data('id');
    var cardID = jQuery(this).data('card-id');
    var boyID = jQuery(this).data('boy');
    jQuery('#card-' + ID).html('<img class="img-responsive" src="/images/cards/' + boyID + '_' + cardID + 'b.png">');
    jQuery('#bloom-' + ID).removeClass('bloom').addClass('unbloom');
    jQuery('#bloom-' + ID).removeClass('glyphicon-certificate').addClass('glyphicon-record');
});

jQuery('body').on('click', '.unbloom', function () {
    var ID = jQuery(this).data('id');
    var cardID = jQuery(this).data('card-id');
    var boyID = jQuery(this).data('boy');
    jQuery('#card-' + ID).html('<img class="img-responsive" src="/images/cards/' + boyID + '_' + cardID + '.png">');
    jQuery('#bloom-' + ID).removeClass('unbloom').addClass('bloom');
    jQuery('#bloom-' + ID).removeClass('glyphicon-record').addClass('glyphicon-certificate');
});

//adding a new card
$('body').on('click', '.add-card', function () {
    var ID = jQuery(this).data('id');
    var clickedOn = jQuery(this);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $.ajax({
        type: "POST",
        url: '/add/user/card',
        data: {card_id: ID},
        dataType: 'json',
        success: function (data) {
            //change the color of the bg, add the class
            jQuery('#card-panel-' + data.card_id).addClass('obtained');
            //$('#lastupdated-'+slideID).html(data.date);
            clickedOn.html('Remove');
            clickedOn.removeClass('add-card btn-success');
            clickedOn.addClass('remove-card btn-danger');
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});


//removing card
$('body').on('click', '.remove-card', function () {
    var ID = jQuery(this).data('id');
    var clickedOn = jQuery(this);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $.ajax({
        type: "POST",
        url: '/remove/user/card',
        data: {card_id: ID},
        dataType: 'json',
        success: function (data) {
            //change the color of the bg, remove the class
            jQuery('#card-panel-' + data.card_id).removeClass('obtained');
            //$('#lastupdated-'+slideID).html(data.date);
            //change the text and class of the button
            clickedOn.html('Add');
            clickedOn.removeClass('remove-card btn-danger');
            clickedOn.addClass('add-card btn-success');
        },
        error: function (data) {
            console.log('Error:', data);
        }
    });
});





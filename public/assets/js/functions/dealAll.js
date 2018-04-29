'use strict';

define(['jquery', 'dealOne'], function ($, dealOne) {
    return function (deck, $card_div) {
        $.post('/deal-all');
        for (var i = 0; i < 52; i++) {
            var card = $('*[data-order-in-deck="' + i + '"]');
            dealOne(deck, $card_div, card.attr('data-card-index'));
        }
    };
});
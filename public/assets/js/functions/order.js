'use strict';

define(["jquery"], function ($) {
    return function (deck, $card_div, order) {
        var div_position = $card_div.position();
        var arrayLength = order.length;

        for (var i = 0; i < arrayLength; i++) {
            var card_index = order[i];
            var card = deck.cards[card_index - 1];
            console.log('Card #' + i);
            console.log(card.rank);
            console.log(card.suit);
            console.log(card_index - 1);

            card.pos = i;
            card.animateTo({
                delay: i * 20,
                duration: 300,
                ease: 'quartOut',
                x: div_position.left + i + 1,
                y: div_position.top + i,

                onStart: (function () {
                    card.$el.style.zIndex = i;
                    $(card.$el).attr('data-card-index', card_index);
                    $(card.$el).attr('data-order-in-deck', i);
                })(card, card_index),
                onComplete: (function () {
                    card.setSide('back');
                    card.enableDragging();
                    card.enableFlipping();
                })(card)
            });
        }
        $('.btn').attr("disabled", false);
    };
});
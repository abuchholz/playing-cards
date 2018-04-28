'use strict';

define(["jquery"], function ($) {
    return function (deck, $card_div, order) {
        var div_position = $card_div.position();
        var arrayLength = order.length;

        for (var i = 0; i < arrayLength; i++) {
            var card_position = order[i] - 1;
            var card = deck.cards[card_position];
            card.pos = i;
            card.animateTo({
                delay: i * 20,
                duration: 300,
                ease: 'quartOut',
                x: div_position.left + card_position + 1,
                y: div_position.top + card_position,

                onStart: (function () {
                    card.$el.style.zIndex = card_position;
                    $(card.$el).attr('data-card-position', card_position);
                    $(card.$el).attr('data-index', i);
                })(card, card_position),
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
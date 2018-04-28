'use strict';

define([], function () {
    return function () {
        var div_position = $card_div.position();
        var width = $card_div.width();
        var height = $card_div.height();

        for (var i = 0; i < deck.cards.length; i++) {
            var card = deck.cards[i];
            card.setSide('front');
            card.animateTo({
                delay: 1000 + i * 2,
                duration: 500,
                ease: 'quartOut',

                x: div_position.left + Math.random() * width - 50,
                y: div_position.top + Math.random() * height
            });
        }

        $('.btn').attr("disabled", false);
        $('#deal-one-card').attr("disabled", true);
    };
});
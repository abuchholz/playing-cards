define(['jquery'], function ($) {
        return function (deck, $card_div, data_card_index) {
            var div_position = $card_div.position();
            var width = $card_div.width();
            var card = deck.cards[data_card_index - 1];
            var orderInDeck = $(card.$el).attr('data-order-in-deck');

            card.animateTo({
                delay:    100,
                duration: 300,
                ease:     'quartOut',
                x:        div_position.left + width * .25 + orderInDeck * 15,
                y:        div_position.top + (orderInDeck * 15) % 100,

                onStart:    function () {
                    card.$el.style.zIndex = 100 + orderInDeck;
                }(card),
                onComplete: function () {
                    $('#deal-one-card').attr("disabled", false);
                    card.setSide('front');
                }(card)

            });
        }
    }
);
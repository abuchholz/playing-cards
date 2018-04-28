define([], function () {
        return function (deck, $card_div, index, num_cards_pulled) {
            var div_position = $card_div.position();
            var width = $card_div.width();
            var card = deck.cards[index];
            card.animateTo({
                delay:    500,
                duration: 300,
                ease:     'quartOut',
                x:        div_position.left + width * .25 + num_cards_pulled * 10,
                y:        div_position.top + (num_cards_pulled * 10) % 100,

                onStart:    function () {
                    card.$el.style.zIndex = 100 + num_cards_pulled;
                }(card),
                onComplete: function () {
                    card.setSide('front');
                    console.log(card);
                    num_cards_pulled++;
                    console.log(num_cards_pulled);
                }(card, num_cards_pulled)

            });
        }
    }
);
'use strict';

requirejs.config({
    paths: {
        vendor: 'vendor',
        jquery: 'vendor/jquery',
        deck: 'vendor/deck',
        socketio: 'vendor/socket.io',
        bootstrap: 'vendor/bootstrap'
    },
    shim: {
        "bootstrap": { "deps": ['jquery'] },
        'bootstrap/collapse': { deps: ['jquery'], exports: '$.fn.collapse' },
        'bootstrap/dropdown': { deps: ['jquery'], exports: '$.fn.dropdown' },
        'socketio': { exports: 'io' }
    }
});

requirejs(['jquery', 'socketio', 'deck', 'bootstrap'], function ($, io) {
    var num_cards_pulled = 1;

    $(document).ready(function () {
        $('#startModal').modal('show');

        var socketio_port = $('#socketio-port').html();
        var socket = io(socketio_port);
        socket.on('connect', function (socket) {
            console.log('Socket IO: Connection with server made!');
        });

        var $card_div = $('#cards');
        var deck = Deck();
        deck.mount(document.getElementById('cards'));
        scatter(deck, $card_div);

        $('#start').click(function () {
            $.post('/shuffle');
            $(".button-bar").slideDown();
        });

        $('#shuffle').click(function () {
            $('.btn').attr("disabled", true);
            $.post('/shuffle');
        });
        $('#deal-one-card').click(function () {
            $.post('/deal-one-card');
        });

        $('#scatter').click(function () {
            $('.btn').attr("disabled", true);
            scatter(deck, $card_div);
        });

        socket.on("shuffle:App\\Events\\CardsShuffled", function (result) {
            order(deck, $card_div, result.order);
        });
        socket.on("deal-one-card:App\\Events\\OneCardDealt", function (result) {
            console.log(result.card.id - 1);
            dealOne(deck, $card_div, result.card.id - 1);
        });
    });

    var dealOne = function dealOne(deck, $card_div, index) {
        var div_position = $card_div.position();
        var width = $card_div.width();
        var card = deck.cards[index];
        card.animateTo({
            delay: 500,
            duration: 300,
            ease: 'quartOut',
            x: div_position.left + width * .25 + num_cards_pulled * 10,
            y: div_position.top + num_cards_pulled * 10 % 100,

            onStart: (function () {
                card.$el.style.zIndex = 100 + num_cards_pulled;
            })(card),
            onComplete: (function () {
                card.setSide('front');
                console.log(card);
                num_cards_pulled++;
                console.log(num_cards_pulled);
            })(card, num_cards_pulled)

        });
    };
    var order = function order(deck, $card_div, _order) {
        var div_position = $card_div.position();
        var arrayLength = _order.length;
        for (var i = 0; i < arrayLength; i++) {
            var card_position = _order[i] - 1;
            var card = deck.cards[i];
            card.pos = card_position;
            card.animateTo({
                delay: i * 20,
                duration: 300,
                ease: 'quartOut',
                x: div_position.left + card_position + 1,
                y: div_position.top + card_position,

                onStart: (function () {
                    card.$el.style.zIndex = card_position;
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
    var scatter = function scatter(deck, $card_div) {
        num_cards_pulled = 0;
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
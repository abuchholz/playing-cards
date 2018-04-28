requirejs.config({
    paths: {
        vendor: 'vendor',
        scatter: 'functions/scatter',
        order: 'functions/order',
        dealOne: 'functions/dealOne',
        jquery: 'vendor/jquery',
        deck: 'vendor/deck',
        socketio: 'vendor/socket.io',
        bootstrap: 'vendor/bootstrap'
    },
    shim: {
        "bootstrap": {"deps": ['jquery']},
        'bootstrap/collapse': {deps: ['jquery'], exports: '$.fn.collapse'},
        'bootstrap/dropdown': {deps: ['jquery'], exports: '$.fn.dropdown'},
        'socketio': {exports: 'io'}
    }
});

requirejs(['jquery', 'socketio', 'scatter', 'order', 'dealOne', 'deck', 'bootstrap'],
    function ($, io, scatter, order, dealOne) {
        var num_cards_pulled = 0;

        $(document).ready(function () {
            $('#startModal').modal('show')

            var socketio_port = $('#socketio-port').html();
            var socket = io(socketio_port);
            socket.on('connect', function (socket) {
                console.log('Socket IO: Connection with server made.');
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
                num_cards_pulled = 0;
            });
            $('#deal-one-card').click(function () {
                $.post('/deal-one-card')
            });

            $('#scatter').click(function () {
                $('.btn').attr("disabled", true);
                scatter(deck, $card_div);
                num_cards_pulled = 0;
            });


            socket.on("shuffle:App\\Events\\CardsShuffled", function (result) {
                order(deck, $card_div, result.order);
            });
            socket.on("deal-one-card:App\\Events\\OneCardDealt", function (result) {
                dealOne(deck, $card_div, result.card.id, num_cards_pulled)
            });

        });
    }
);
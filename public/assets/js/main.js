'use strict';

requirejs.config({
    paths: {
        vendor: 'vendor',
        scatter: 'functions/scatter',
        order: 'functions/order',
        dealOne: 'functions/dealOne',
        noMoreCards: 'functions/noMoreCards',
        dealAll: 'functions/dealAll',
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

requirejs(['jquery', 'socketio', 'scatter', 'order', 'dealOne', 'dealAll', 'noMoreCards', 'deck', 'bootstrap'], function ($, io, scatter, order, dealOne, dealAll, noMoreCards) {
    var num_cards_pulled = 0;

    $(document).ready(function () {
        $('#startModal').modal('show');

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
            $('#deal-one-card').attr("disabled", true);
            $.post('/deal-one-card');
        });
        $('#deal-all').click(function () {
            dealAll(deck, $card_div);
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
            console.log(result.cardId);
            dealOne(deck, $card_div, result.cardId);
        });
        socket.on("no-more-cards:App\\Events\\NoMoreCards", function () {
            noMoreCards();
        });
    });
});
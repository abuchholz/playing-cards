
var app = require('http').createServer(handler);
var io = require('socket.io')(app);
var Redis = require('ioredis');
var redis = new Redis(6379, 'redis');

app.listen(6001, function() {
    console.log('Socket.io: Listening on 6001');
});

io.on('connection', function(socket) {
    console.log('Connection with browser made');
    socket.on('disconnect', function() {
        console.log('Connection with browser disconnected');
    });
});

redis.subscribe('shuffle');
redis.subscribe('deal-one-card');
redis.subscribe('no-more-cards');

redis.on('message', function(channel, message) {
    message = JSON.parse(message);
    console.log('Channel: ' + channel);
    console.log('Event received: ' + message.event);
    console.log('Data recieved: ' + message.data);
    io.emit(channel + ':' + message.event, message.data);
});

function handler(req, res) {
    res.writeHead(200);
    res.end('');
}

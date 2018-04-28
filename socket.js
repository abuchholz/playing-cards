
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

redis.subscribe('shuffle', function(err, count) {
    console.log('Redis: shuffle subscribed');
});
redis.subscribe('deal-one-card', function(err, count) {
    console.log('Redis: deal one card subscribed');
});

redis.on('message', function(channel, message) {
    console.log('Channel: ' + channel);
    message = JSON.parse(message);
    console.log('Event received: ' + message.event);
    console.log('Data recieved: ' + message.data);
    io.emit(channel + ':' + message.event, message.data);
});
redis.on('pmessage', function(pattern, channel, message) {
    console.log('Channel: ' + channel);
    message = JSON.parse(message);
    console.log('Event received: ' + message.event);
    console.log('Data recieved: ' + message.data);
    io.emit(channel + ':' + message.event, message.data);
});


/**
 * Helper function to return ASCII code of character
 * @param  [string] string
 * @return [ascii code]
 */
function ord( string ) {
    return string.charCodeAt( 0 );
}
function handler(req, res) {
    res.writeHead(200);
    res.end('');
}

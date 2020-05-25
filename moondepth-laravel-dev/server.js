let http = require('http').Server();
let io = require('socket.io')(http);
let Redis = require('ioredis');

let redis = new Redis();
redis.subscribe('thread-action');
redis.on('message', function(channel, message) {
    console.log('Channel: ' + channel);
    console.log('Message: ' + message);
    io.emit(channel + ':' + message.event, message.data);
});

let port = 3000;
http.listen(port, function () {
    console.log('Listening on Port: ' + port);
});


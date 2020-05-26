let http = require('http').Server();
let io = require('socket.io')(http);
let Redis = require('ioredis');

let redis = new Redis({
    port: 6379, // Redis port
    host: "127.0.0.1", // Redis host
});

redis.subscribe('thread-action', function (error) {
    if (error) {
        throw new Error(error);
    }
});

redis.on('message', function(channel, message) {
    console.log("Receive message %s from channel %s", message, channel);
    io.emit(channel + ':' + message.event, message.data);
});

io.on('connection', (socket) => {
    console.log('A user connected');

    socket.on('socket-new-message', () => {
        console.log('New message recieved');
    });

    socket.on('socket-messages-update', () => {
        console.log('Messages data updated');
    });

    socket.on('disconnect', () => {
        console.log('User disconnected');
    });
});

let port = 3000;
http.listen(port, function () {
    console.log('Listening on Port: ' + port);
});


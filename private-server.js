var http = require('http').Server();
var io = require('socket.io')(http);
var Redis = require('ioredis');


var redis = new Redis();

redis.psubscribe('news-action.*' , (err, count) => {
    console.log('Subscribed news-action');
    console.log(err)
});
io.on('connection', function(socket) {
    console.log('A client connected');
});

// pattern = news-action.*
redis.on('pmessage', function (pattern, channel, message) {
    console.log('From redis: channel - ' + channel + ' Message - ' + message);
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data)
});

http.listen(3000, function () {
    console.log('server started : 3000');
});

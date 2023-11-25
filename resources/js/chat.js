import Echo from 'laravel-echo';

window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001'
});

window.Echo.channel('new-chat-message')
    .listen('NewChatMessage', (e) => {
        // Update your UI to display the incoming message
        console.log(e);
    });

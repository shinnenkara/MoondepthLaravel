<template>
    <div class="thread-messages">
        <div class="row" v-if="Array.isArray(messages) && messages.length" v-for="(message, index) in messages">
            <thread-message :board-id="boardId" :thread-id="threadId" :message-id="message.id"></thread-message>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            boardId: {
                type: String,
                required: true
            },
            threadId: {
                type: Number,
                required: true
            }
        },
        data: function() {
            return {
                messages: [],
                host: 'http://localhost',
                port: '3000',
                eventName: 'thread-action',
                eventApp: 'App\\Events\\NewMessage'
            }
        },
        mounted() {
            let socket = io(this.host + ':' + this.port);
            console.log('socket.io:');
            console.log(this.host + ':' + this.port);

            let app = this;
            socket.on(this.eventName + ':' + this.eventApp, function(data) {
                console.log('event-channel:');
                console.log(this.eventName + ':' + this.eventApp);
                console.log('event-data:');
                console.log(data);
                app.update();
            });
            console.log('socket on:');
            console.log(this.eventName + ':' + this.eventApp);

            this.update();
        },
        methods: {
            update: function () {
                axios.post('/board/' + this.boardId + '/thread/' + this.threadId + '/message' +'/all').then((response) => {
                    let data = response.data;
                    console.log('data');
                    console.log(data);
                    if(Array.isArray(data.messages) && data.messages.length) {
                        console.log(data.messages);
                        this.messages = data.messages;
                    }

                    console.log('board: ' + this.boardId + ' ' + 'thread: ' + this.threadId + '/message' +'/all');
                    if(Array.isArray(this.messages) && this.messages.length) {
                        console.log('messages:');
                        console.log(this.messages);
                    }
                });
            }
        }
    }
</script>

<template>
    <div class="thread-messages">
        <div class="row" v-if="Array.isArray(messages) && messages.length">
            <thread-message v-for="message in messages" v-bind:data="message"
                            v-bind:key="message.id" :board-id="boardId" :thread-id="threadId" :message-id="message.id"></thread-message>
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
                eventRoot: 'thread',
                eventName: 'new-message',
                eventApp: 'NewMessage',
                socket: null
            }
        },
        mounted() {
            this.listen();
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
            },
            listen: function () {
                Echo.channel('redis' + '.' + this.eventRoot + '.' + this.threadId + '.' + this.eventName)
                    .listen(this.eventApp, (e) => {
                        console.log('e:');
                        console.log(e);
                        this.messages.push(e.message);
                });
            }
        }
    }
</script>

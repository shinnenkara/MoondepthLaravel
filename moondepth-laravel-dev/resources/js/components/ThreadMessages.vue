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
                messages: []
            }
        },
        mounted() {
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

                    console.log('board: ' + this.boardId + ' ' + 'thread: ' + this.threadId);
                    if(Array.isArray(this.messages) && this.messages.length) {
                        console.log('messages:');
                        console.log(this.messages);
                    }
                });
            }
        }
    }
</script>

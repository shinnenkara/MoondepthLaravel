<template>
    <div :id="'message-' + this.message.id" class="message col l11 m11 s12">
        <div class="message-head">
            <i class="material-icons hidemessage-icons">arrow_drop_down</i>
            <h5 class="content grey-text text-lighten-1">{{ this.user.username }}</h5>
            <h5 class="content">{{ this.message.created_at }}</h5>
            <a class="white-text" :href="'#m-' + this.message.id ">
                <h5 class="content">No. {{ this.message.id }}</h5></a>
        </div>
        <div class="message-body">
            <div v-if="Array.isArray(this.files) && this.files.length">
                <div class="message-files">
                    <div class="row" v-for="(file, index) in this.files">
                        <message-image :src="src + file['s3_path']" :alt="'' + file['original_name']" :size="'' + file['size']" :width="'' + file['width']" :height="'' + file['height']"></message-image>
                    </div>
                </div>
            </div>
            <div class="container">
                <div v-if="this.message.response_to">
                <a class="white-text" :href="'#message-' + this.message.response_to">
                    <h6>{{'>>' + this.message.response_to}}</h6></a>
                </div>
                <h5>{{ this.message.text }}</h5>
            </div>
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
            },
            messageId: {
                type: Number,
                required: true
            }
        },
        data: function() {
            return {
                message: [],
                user: '',
                filesPath: "",
                files: []
            }
        },
        mounted() {
            this.update();
        },
        methods: {
            update: function () {
                axios.post('/board/' + this.boardId + '/thread/' + this.threadId + '/message/' + this.messageId +'/get').then((response) => {
                    let data = response.data;
                    console.log('data');
                    console.log(data);
                    this.message = data.message;
                    this.user = data.user;
                    if(Array.isArray(data.files) && data.files.length) {
                        this.filesPath = data.filesPath;
                        this.files = data.files;
                    }

                    console.log('board: ' + this.boardId + ' ' + 'thread: ' + this.threadId + ' ' + 'message: ' + this.messageId);
                    console.log('message:');
                    console.log(this.message);
                    console.log('username: ' + this.user);
                    if(Array.isArray(this.files) && this.files.length) {
                        console.log('filesPath: ' + this.filesPath);
                        console.log('files:');
                        console.log(this.files);
                    }
                });
            }
        },
        computed: {
            src() {
                return this.filesPath;
            }
        }
    }
</script>

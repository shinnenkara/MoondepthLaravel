<template>
    <div :id="'message-' + this.message.id" class="message col l11 m11 s12">
        <div class="message-head">
            <i class="material-icons hidemessage-icons">arrow_drop_down</i>
            <h5 class="content grey-text text-lighten-1">{{ username }}</h5>
            <h5 class="content">{{ createdAt }}</h5>
            <a class="white-text" :href="'#message-creation'" @click="this.reply">
                <h5 class="content">No. {{ this.message.id }}</h5></a>
        </div>
        <div class="message-body">
            <div v-if="Array.isArray(this.files) && this.files.length">
                <div class="message-files">
                    <div class="row" v-for="(file, index) in this.files">
                        <message-image v-if="index" :src="src + file['s3_path']" :alt="'' + file['original_name']" :size="'' + file['size']" :width="'' + file['width']" :height="'' + file['height']"></message-image>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="message-text">
                    <div v-if="this.message.response_to">
                        <a class="white-text" :href="'#message-' + this.message.response_to">
                            <h6 style="margin-bottom: 0px">{{ '>>' + this.message.response_to }}</h6></a>
                    </div>
                    <h5>{{ this.message.text }}</h5>
                </div>
                <div v-for="(reply, index) in this.replies">
                    <div v-if="index == 0">
                        <a class="grey-text" :href="'#message-' + reply.id">{{ '>>' + reply.id }}</a>
                    </div>
                    <div v-else>
                        {{ ', '}}<a class="grey-text" :href="'#message-' + reply.id">{{ '>>' + reply.id }}</a>
                    </div>
                </div>
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
                user: [],
                filesPath: "",
                files: [],
                replies: []
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
                    if(Array.isArray(data.replies) && data.replies.length) {
                        this.replies = data.replies;
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
                    if(Array.isArray(this.replies) && this.replies.length) {
                        console.log('replies:');
                        console.log(this.replies);
                    }
                });
            },
            reply: function () {
                let input = $("#response_to_input");
                input.val(this.message.id);
                let label = $("label[for=response_to_input]");
                if(!label.hasClass('active')) {
                    label.addClass('active a');
                }
                this.$root.$emit('openReply');
            }
        },
        computed: {
            src() {
                return this.filesPath;
            },
            username() {
                return this.user.username;
                // return this.user.username.charAt(0).toUpperCase() + this.user.username.slice(1);
            },
            createdAt() {
                let fullDate = new Date(this.message.created_at);
                let year = fullDate.getFullYear();
                let month = fullDate.getMonth();
                if(month < 10) {
                    month = '0' + month;
                }
                let day = fullDate.getDay();
                if(day < 10) {
                    day = '0' + day;
                }
                let hours = fullDate.getHours();
                if(hours < 10) {
                    hours = '0' + hours;
                }
                let minutes = fullDate.getMinutes();
                if(minutes < 10) {
                    minutes = '0' + minutes;
                }
                let seconds = fullDate.getSeconds();
                if(seconds < 10) {
                    seconds = '0' + seconds;
                }
                return year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ':' + seconds;
            }
        }
    }
</script>

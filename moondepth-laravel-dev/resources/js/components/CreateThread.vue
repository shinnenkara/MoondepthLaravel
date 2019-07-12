<template>
    <div id="thread-creation" class="container center">
        <button id="thread-creation-button" class="waves-effect waves-light grey darken-3 btn-large" @click="creationToggle" v-text="buttonText">
        </button>
        
        <div id="shadow" class="container white-text center">
            <form id="thread-form" class="col s12" method="post" action="WebServer/php/SubmitForm">
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input id="username_input" class="white-text" type="text" value="Anonymous" name="username" data-length="20">
                        <label for="username_input">Your username</label>
                        <span class="helper-text grey-text text-darken-2 left">You can get recognized</span>
                    </div>
                    <div class="input-field col s12 m6">
                        <input id="topic_input" class="white-text" type="text" name="topic" data-length="40">
                        <label for="topic_input">Topic</label>
                    </div>
                    <div class="input-field col s12">
                        <textarea id="subject_text_input" class="materialize-textarea white-text" name="subject_text" data-length="120"></textarea>
                        <label for="subject_text_input">Subject text</label>
                    </div>
                    <div class="input-field col s12">
                        <div class="file-field input-field">
                            <div class="btn">
                                <span>File</span>
                                <input id="file_array_input" type="file" name="file_array_input" multiple>
                            </div>
                            <div class="file-path-wrapper">
                                <input id="file_path" class="file-path validate white-text" type="text" name="file_array"> <!-- placeholder="Upload one or more files" -->
                                <span class="helper-text grey-text text-darken-2 left">Upload up to three files</span>
                            </div>
                        </div>
                    </div>
                    <div class="input-field col s12">
                        <button id="submit_input" class="white-text waves-effect waves-light grey darken-3 btn-large" type="submit" name="submit" value="send">Send</button>
                    </div>
                    <div class="submit-check col s12">
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data: function() {
            return {
                status: false,
            }
        },
        computed: {
            buttonText() {
                return ((this.status) ? 'HIDE CREATION' : 'CREATE THREAD');
            }
        },
        methods: {
            creationToggle() {
                this.status = !this.status;
                $(document).ready(function() {
                var shadow = document.getElementById("shadow");
                $(shadow).slideToggle("slow");
            });
            }
        },
    }
</script>

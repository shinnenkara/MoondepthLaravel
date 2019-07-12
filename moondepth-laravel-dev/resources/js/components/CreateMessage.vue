<template>
    <div id="message-creation" class="container center">
        <button id="message-creation-button" class="waves-effect waves-light grey darken-3 btn-large" @click="creationToggle" v-text="buttonText">
        </button>

        <div id="shadow" class="container white-text center" style="display: none; width: 50%; padding: 1.5rem .75rem;">
            <form id="message-form" class="col s12" method="post" action="WebServer/php/SubmitForm">
                <div class="row">
                    <div class="input-field col s12 m6">
                        <input id="username_input" class="white-text" type="text" name="username" value="Anonymous" data-length="20">
                        <label class="active" for="username_input">Your username</label>
                        <span class="helper-text grey-text text-darken-2 left">You can get recognized</span>
                    </div>
                    <div class="input-field col s12 m6 hide">
                        <input id="response_to_input" class="white-text" type="text" name="response_to" data-length="10">
                        <label for="response_to_input">Response to</label>
                    </div>
                    <div class="input-field col s12">
                        <textarea id="message_text_input" class="materialize-textarea white-text" name="message_text" data-length="120"></textarea>
                        <label for="message_text_input">Message text</label>
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
                return ((this.status) ? 'hide replying' : 'make reply');
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

<template>
    <button id="thread-creation-button" class="waves-effect waves-light grey darken-3 btn-large" @click="creationToggle" v-text="buttonText">
    </button>
</template>

<script>
    export default {
        mounted() {
            if(this.is_error) {
                this.creationToggle();
            }
        },
        props: {
            is_error: {
                type: String,
                required: true,
                default: false,
            }
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

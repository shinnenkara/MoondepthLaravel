<template>
    <button id="thread-creation-button" class="waves-effect waves-light grey darken-3 btn-large" @click="creationToggle" v-text="buttonText">
    </button>
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

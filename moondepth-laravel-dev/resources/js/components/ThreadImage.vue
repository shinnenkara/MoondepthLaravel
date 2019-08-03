<template>
    <div class="flex-file col" :class="expanded ? 's12 m12 l12' : 's6 m6 l3'">
        <div class="thread-file-description">
            <span>{{alt}}</span><br />
            <span>({{short_size}}, {{resolution}})</span>
        </div>
        <div class="thread-file-content" @click="expanded = !expanded" :class="expanded ? 'expanded-file' : 'standart-file'">
            <img class="thread-file" :src="src" :alt="alt">
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props: {
            src: {
                type: String,
                required: true,
                default: "",
            },
            alt: {
                type: String,
                required: true,
                default: "404",
            },
            size: {
                type: Number,
                required: true,
                default: 0,
            },
            width: {
                type: Number,
                required: true,
                default: 0,
            },
            height: {
                type: Number,
                required: true,
                default: 0,
            }
        },
        data: function() {
            return {
                expanded: false,
            }
        },
        computed: {
            resolution() {
                return this.width + 'x' + this.height;
            },
            short_size() {
                if(this.size >= 100000) {
                    return (this.size / 1e+6).toFixed(2) + ' MB';
                } else {
                    return this.size;
                }
            }
        },
        methods: {
        },
    }
</script>

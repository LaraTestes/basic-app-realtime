<template>


</template>

<script>

    export default {
        mounted() {

            Echo.channel('public-test-channel')
                .listen('MessagePosted', (data) => {

                    // Push ata to posts list.
                    this.posts.push({
                        message: data.chatMessage.message,
                        username: data.user.name
                    });
                });

            console.log('Component mounted.')
        },

        data() {
            return {
                posts: [],
                newMsg: '',

            }
        },

        methods: {

            press() {

                // Send message to backend.
                this.$http.post('/message/', {message: this.newMsg})
                    .then((response) => {

                        // Clear input field.
                        this.newMsg = '';
                    });
            }
        }


    }

</script>

<style>


</style>
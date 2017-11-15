<template>

    <div>

        <hr>

        <h4>Write something to all users</h4>

        <input type="text" class="form-control" placeholder="something" required="required" v-model="newMsg" @keyup.enter="press">

        <hr>
        <h3>Messages</h3>

        <ul v-for="post in posts">
            <b>@{{ post.username }} says:</b> @{{ post.message }}
        </ul>

    </div>


</template>

<script>

    export default {
        mounted() {

            Echo.channel('public-test-channel')
                .listen('MessagePosted', (data) => {

                    console.log(data);

//                    // Push ata to posts list.
//                    this.posts.push({
//                        message: data.chatMessage.message,
//                        username: data.user.name
//                    });
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
                axios.post('/message', {message: this.newMsg})
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
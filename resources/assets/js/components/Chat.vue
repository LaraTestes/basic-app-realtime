<template>

    <div>

        <hr>

        <h4>Write something to all users</h4>

        <input type="text" class="form-control" placeholder="something" required="required" v-model="newMsg" @keyup.enter="press">

        <hr>
        <h3>Messages</h3>

        <ul v-for="message in messages">
            <b>@{{ message.user.name }} says:</b> {{ message.message }}
        </ul>

    </div>


</template>

<script>

    export default {
        mounted() {

            this.getMessages();

            Echo.channel('public-test-channel')
                .listen('MessagePosted', (data) => {

//                    console.log(data);

                    // Push ata to posts list.
                    this.messages.push({
                        message: data.chatMessage.message,
                        user : data.user
                    });
                });

            console.log('Component mounted.')
        },

        data() {
            return {
                messages: [],
                newMsg: '',

            }
        },

        methods: {

            press() {

                // Clear input field.

                // Send message to backend.
                axios.post('/api/messages', {message: this.newMsg})
                    .then((response) => {

                        this.newMsg = '';

                    });
            },

            getMessages(){

                axios.get('/api/messages').then(response => {

                    this.messages = response.data;

                })

            }
        }


    }

</script>

<style>


</style>
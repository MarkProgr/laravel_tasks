<template>
    <vue-advanced-chat
        :rooms="JSON.stringify(rooms)"
        :messages="JSON.stringify(messages)"
        :messages-loaded="messagesLoaded"
        :rooms-loaded="roomsLoaded"
        :loading-rooms="loadingRooms"
        :current-user-id="currentUserId"
        @send-message="sendMessage($event.detail[0])"
        @fetch-messages="fetchMessages($event.detail[0])"
    />
</template>

<script>
    import { register } from "vue-advanced-chat";
    import { random } from "lodash";

    register()

    export default {
        data() {
            return {
                rooms: [{
                    roomId: 1,
                    roomName: 'Room',
                    index: 3,
                }],
                messages: [],
                currentUserId: random(0, 100, false),
                roomsLoaded: true,
                messagesLoaded: false,
                loadingRooms: false,
            }
        },
        methods: {
            async sendMessage(message) {
                let sentMessage = (await axios.post('/api/messages', {...message, userId: this.currentUserId})).data.data;
                this.messages = [
                    ...this.messages,
                    {
                        _id: sentMessage._id,
                        senderId: this.currentUserId,
                        content: sentMessage.content,
                    }
                ];
            },
            fetchMessages() {
                setInterval(async () => {
                    let messages = (await axios.get('/api/messages')).data.data;
                    this.messages = [
                        ...messages
                    ]
                    this.messagesLoaded = true;
                }, 5000);
            },
        },
        mounted() {
            this.fetchMessages();
        }
    }
</script>

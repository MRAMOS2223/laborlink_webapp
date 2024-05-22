<template>
 <VCard class="chat-container">
        <div class="chat-list">
            <div  v-for="user in users" :key="user.id" class="chat-card" @click="selectUser(user)">
              <img :src="user.profilePic" alt="Profile Picture" class="profile-pic">
              <div class="chat-card-content">
                <div class="name">{{ user.name }}</div>
                <div class="latest-message">{{ user.messages[user.messages.length - 1].text }}</div>
              </div>
            </div>
        </div>
        <div class="chat-content">
          <div v-if="isUserSelected">
            <div class="chat-header">
                <img :src="selectedUser.profilePic" alt="Profile Picture" class="profile-pic">
                <div class="name">{{ selectedUser.name }}</div>
            </div>
            <div class="chat-body"  id="chatBody">
                <div v-for="message in selectedUser.messages" :key="message.id" :class="['message', message.sentByMe ? 'sent' : 'received']">
                    <div class="bubble">{{ message.text }}</div>
                </div>
            </div>
            <div class="message-field" v-if="selectedUser">
                <input type="text" v-model="newMessage" placeholder="Type a message...">
                <div class="send-button" @click="sendMessage">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M0 0h24v24H0V0z" fill="none"/>
                        <path d="M2 21l21-9L2 3v7l15 2-15 2v7z"/>
                    </svg>
                </div>
            </div>
          </div>
          <div v-else class="no-conversation">
              No conversation selected
          </div>
        </div>
 </VCard>
</template>

<script>
import axios from 'axios';
export default {
    data() {
        return {
            BASE_API: window.location.origin+"/api",
            GET_CHATS: "/v1/admin/chat",
            POST_CHAT: "/v1/admin/sendChat",
            users: [],
          selectedUser: {},
          newMessage: ''
        }
    },
    computed: {
        isUserSelected() {
            return Object.keys(this.selectedUser).length > 0;
        }
    },
    mounted() {
      this.loadAdminChats();
    },
    methods: {
        loadAdminChats(){
          axios
                .get(this.BASE_API.concat(this.GET_CHATS))
                .then(response => {
                    if(response.data.success){
                        var data = response.data.data
                        console.log(data)
                        this.users = data;
                    }
                });
        },
        selectUser(user) {
            this.selectedUser = user;
            setTimeout(() => {
              document.getElementById("chatBody").scrollTop = document.getElementById("chatBody").scrollHeight;
            },500);
        },
        sendMessage() {
            if (this.newMessage.trim() !== '') {
                this.selectedUser.messages.push({ id: Date.now(), text: this.newMessage, sentByMe: true });
                

                let payload = {
                  "id": this.selectedUser.receiver_id,
                  "receiver": this.selectedUser.id,
                  "message":  this.newMessage
                };

                axios
                .post(this.BASE_API.concat(this.POST_CHAT), payload)
                .then(response => {
                    if(response.data.success){
                        var data = response.data.data
                        console.log(data)
                        this.users = data;

                        this.newMessage = '';
                        setTimeout(() => {
                          document.getElementById("chatBody").scrollTop = document.getElementById("chatBody").scrollHeight;
                        },500);
                    }
                });
                
            }
        },

    },
    created(){

    },

}
</script>
<style scoped>
body,
html {
  padding: 0;
  margin: 0;
  block-size: 100%;
  font-family: Arial, sans-serif;
}

.chat-container {
  display: flex;
  block-size: 80vh;
  inline-size: 100%;
}

.chat-list {
  background-color: white;
  border-inline-end: 1px solid #ccc;
  inline-size: 35%;
  overflow-y: auto;
}

.chat-card {
  display: flex;
  align-items: center;
  padding: 10px;
  border-block-end: 1px solid #ccc;
}

.profile-pic {
  border-radius: 50%;
  block-size: 50px;
  inline-size: 50px;
  margin-inline-end: 10px;
}

.chat-card-content {
  display: flex;
  flex-direction: column;
  inline-size: calc(100% - 60px);
}

.chat-card-content .name {
  overflow: hidden;
  color: black;
  font-weight: bold;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.chat-card-content .latest-message {
  overflow: hidden;
  color: gray;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.chat-content {
  position: relative;
  display: flex;
  overflow: hidden;
  flex-direction: column;
  background-color: #fff;
  inline-size: 65%;
}

.chat-header {
  display: flex;
  box-sizing: border-box;
  align-items: center;
  padding: 10px;
  block-size: 60px; /* Fixed height to fit the profile picture */
  border-block-end: 1px solid #ccc;
}

.chat-header .profile-pic {
  margin-inline-end: 10px;
}

.chat-header .name {
  color: #000;
  font-size: 1.2em;
  font-weight: bold;
}

.chat-body {
  display: flex;
  box-sizing: border-box;
  flex-direction: column;
  flex-grow: 1;
  padding: 10px;
  block-size: 58vh;
  inline-size: 100%;
  margin-block-end: 60px;
  overflow-y: auto;
  padding-block-end: 50px;
}

.message {
  display: flex;
  margin-block-end: 10px;
  max-inline-size: 70%;
}

.message.sent {
  margin-inline-start: auto;
}

.message.received {
  margin-inline-end: auto;
}

.message .bubble {
  padding: 10px;
  border-radius: 10px;
}

.message.sent .bubble {
  background-color: #346898;
  color: white;
}

.message.received .bubble {
  background-color: #f1f1f1;
  color: black;
}

.message-field {
  position: absolute;
  display: flex;
  box-sizing: border-box;
  align-items: center;
  padding: 10px;
  border-block-start: 1px solid #ccc;
  inline-size: 100%;
  inset-block-end: 0;
}

.message-field input[type="text"] {
  flex-grow: 1;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 20px;
  padding-inline-end: 40px; /* Make space for the send icon */
}

.message-field .attach-icon {
  cursor: pointer;
  margin-inline-end: 10px;
}

.message-field .send-button {
  position: absolute;
  display: flex;
  align-items: center;
  cursor: pointer;
  inset-inline-end: 40px;
}

.message-field .send-button svg {
  fill: #346898;
}

.no-conversation {
  display: flex;
  flex-grow: 1;
  align-items: center;
  justify-content: center;
  color: #888;
  font-size: 1.5em;
  text-align: center;
}
</style>

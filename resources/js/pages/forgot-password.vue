<script setup>
import logoImage from '@images/icons/logo/laborlink.png';
</script>

<template>
  <div class="container-forgot">
    <header class="header">
      <div class="logo">
        <img
          :src="logoImage"
          alt=""
        >
        <h1 class="logo-text">
          LaborLink
        </h1>
      </div>
    </header>
    <main>
      <h2>Forgot Password</h2>
      <p>Please enter your email address to reset your password.</p>
      <form>
        <label for="email">Email</label>
        <input
          id="email"
          type="email"
          name="email"
          placeholder="email@example.com"
          required
        >
        <button
          type="button"
          class="button"
          @click="resetPassword"
        >
          Reset Password
        </button>
      </form>
      <a
        class="goback"
        @click="redirectToLogin"
      >Back to Login</a>
    </main>
    <footer>
      <p>&copy; 2024 All Rights Reserved</p>
    </footer>
  </div>
</template>

<script>
export default {
  data(){
    return {
      loginLink: "/login",
    }
  },
  methods: {
    redirectToLogin(){
      this.$router.push(this.loginLink)
    },
    resetPassword(){
      this.$router.push(this.loginLink)
    },
  },
}
</script>

<style lang="scss">
@import "https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap";

.body {
  display: flex;
  padding: 0;
  margin: 0;
  background-color: #fff;
  font-family: Poppins, sans-serif;
  min-block-size: 100vh;
}

.header {
  margin-block-start: 30px;
  padding-block: 20px 15px;
  padding-inline-start: 8px;
  text-align: start;
}

.logo {
  display: flex;
  align-items: left;
}

.logo-text {
  padding-block-start: 10px;
}

.logo img {
  block-size: 50px;
  inline-size: 50px;
  margin-inline-end: 10px;
}

h1 {
  font-size: 20px;
  margin-inline-start: 20;
}

h2 {
  color: #676767;
  font-size: 25px;
}

main {
  padding: 10px;
}

p {
  color: #676767;
  font-size: 12px;
  line-height: 1;
  margin-block-end: 20px;
}

form {
  display: flex;
  flex-direction: column;
}

label {
  color: gray;
  font-size: 12px;
  font-weight: bold;
  margin-block-end: 5px;
}

input[type="text"],
input[type="password"] {
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 3px;
  margin-block-end: 5px;
}

.checkbox {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-block-end: 30px;
}

.checkbox a {
  color: rgba(53, 104, 153);
  font-size: 11px;
  font-weight: 600;
  text-decoration: none;
}

.button {
  border: none;
  border-radius: 25px;
  background-color: rgba(53, 104, 153);
  color: #fff;
  cursor: pointer;
  font-weight: 600;
  padding-block: 10px;
  padding-inline: 20px;
}

footer {
  margin-block-start: 40px;
  text-align: center;
}

footer p {
  color: gray;
  font-size: 11px;
}

/* Media query for smaller screens */
@media screen and (max-width: 300px) {
  .container {
    padding: 5px;
  }

  h1 {
    font-size: 15px;
  }

  h2 {
    font-size: 20px;
  }

  p {
    font-size: 8px;
  }

  label {
    font-size: 8px;
  }

  input[type="text"],
  input[type="password"] {
    padding: 8px;
  }

  .checkbox a {
    font-size: 5px;
  }

  .button {
    padding-block: 8px;
    padding-inline: 16px;
  }

  footer p {
    font-size: 8px;
  }
}

input[type="email"],
input[type="password"],
.button[type="button"] {
  box-sizing: border-box;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  inline-size: 100%;
  margin-block-start: 5px;
}

.button[type="button"] {
  border-radius: 25px;
  background-color: rgba(53, 104, 153);
  color: #fff;
  cursor: pointer;
  margin-block-start: 25px;
}

.goback {
  display: block;
  color: rgba(53, 104, 153);
  cursor: pointer;
  font-size: 12px;
  margin-block-start: 25px;
  text-align: center;
  text-decoration: none;
}

.goback:hover {
  text-decoration: underline;
}

.container-forgot {
  display: block;
  padding: 110px;
  border-radius: 0;
  background-color: #fff;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 10%);
  inline-size: fit-content;
  margin-block: 0;
  margin-inline: auto;
  max-inline-size: 100%;
}

.column {
  float: inline-start;
}

.left {
  inline-size: 60%;
}

.right {
  inline-size: 40%;
}

.row {
  background-color: white;
}

.row::after {
  display: table;
  clear: both;
  content: "";
}

.inner-padding {
  padding-block-start: 100px;
  padding-inline: 100px;
}

.background-image {
  display: block;
  max-block-size: 100%;
  max-inline-size: 100%;
}
</style>

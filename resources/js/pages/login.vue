<script setup>
import logoImage from '@images/icons/logo/laborlink.png';
import backgroundImage from '@images/pages/login-bg.png';
</script>
<template class="login-body">
  <div class="login-row">
    <div class="login-column login-left">
        <img
          class="background-image"
          :src="backgroundImage"
          alt="image"
        >
    </div>
    <div class="login-column login-right inner-padding">
        <header class="login-header">
            <div class="login-logo">
                <img
                    :src="logoImage"
                    alt=""
                  >
            <h1 class="login-logo-text h1">LaborLink</h1>
          </div>
        </header>
        <main class="login-main">
            <h2 class="h2">Login to your Account</h2>
            <p class="login-p">See what is going on with your business</p>
            <form class="login-form">
                <label class="login-label" for="email">Email</label>
                <input type="text" id="uemail" name="email" placeholder="email@example.com">
                <label class="login-label" for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="************">
                <div class="remember-me-checkbox">
                    <label class="login-label" for="remember-me">
                        <input type="checkbox" element id="remember-me" name="remember-me">
                        Remember Me
                    </label>
                    <a v-on:click="redirectToForgotPasswordPage" class="forgotpassword">Forgot Password?</a>
                </div>
                <button type="button" class="login-button" v-on:click="authenticateUser">Login</button>
            </form>
            
        </main>
        
         <footer class="login-footer">
            <p>&copy; 2024 All Rights Reserved</p>
        </footer>
    </div>

  </div>
    
</template>

<script>
    export default {
    data(){
        return {
        forgotPasswordLink: "/forgot-password",
        dashboardLink: "/dashboard"
        }
    },
    methods: {
        redirectToForgotPasswordPage(){
            this.$router.push('/forgot-password');
        },
        authenticateUser(){
            this.$router.push(this.dashboardLink);
        }
    }
    }
</script>

<style lang="scss">
@import "https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap";

.login-body {
  display: flex;
  padding: 0;
  margin: 0;
  background-color: #fff;
  font-family: Poppins, sans-serif;
  min-block-size: 100vh;
}

.login-container {
  padding: 110px;
  border-radius: 0;
  background-color: #fff;
  block-size: 500px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 10%);
  inline-size: 400px;
}

.login-header {
  margin-block-start: 30px;
  padding-block: 20px 15px;
  padding-inline-start: 8px;
  text-align: start;
}

.login-logo {
  display: flex;
  align-items: left;
}

.login-logo-text {
  padding-block-start: 10px;
}

.login-logo img {
  block-size: 50px;
  inline-size: 50px;
  margin-inline-end: 10px;
}

.h1 {
  font-size: 20px;
  margin-inline-start: 20;
}

.h2 {
  color: #676767;
  font-size: 25px;
}

.login-main {
  padding: 10px;
}

.login-p {
  color: #676767;
  font-size: 12px;
  line-height: 1;
  margin-block-end: 20px;
}

.login-form {
  display: flex;
  flex-direction: column;
}

.login-label {
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

.remember-me-checkbox {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-block-end: 30px;
}

.remember-me-checkbox a {
  color: rgba(53, 104, 153);
  font-size: 11px;
  font-weight: 600;
  text-decoration: none;
}

.login-button {
  border: none;
  border-radius: 25px;
  background-color: rgba(53, 104, 153);
  color: #fff;
  cursor: pointer;
  font-weight: 600;
  padding-block: 10px;
  padding-inline: 20px;
}

.login-footer {
  margin-block-start: 40px;
  text-align: center;
}

.login-footer p {
  color: gray;
  font-size: 11px;
}

/* Media query for smaller screens */
@media screen and (max-width: 300px) {
  .login-container {
    padding: 5px;
  }

  .h1 {
    font-size: 15px;
  }

  .h2 {
    font-size: 20px;
  }

  .login-p {
    font-size: 8px;
  }

  .login-label {
    font-size: 8px;
  }

  input[type="text"],
  input[type="password"] {
    padding: 8px;
  }

  .remember-me-checkbox a {
    font-size: 5px;
  }

  .login-button {
    padding-block: 8px;
    padding-inline: 16px;
  }

  .login-footer p {
    font-size: 8px;
  }
}

input[type="email"],
input[type="password"],
.login-button[type="button"] {
  box-sizing: border-box;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  inline-size: 100%;
  margin-block-start: 5px;
}

.login-button[type="button"] {
  border-radius: 25px;
  background-color: rgba(53, 104, 153);
  color: #fff;
  cursor: pointer;
  margin-block-start: 25px;
}

.goback {
  display: block;
  color: rgba(53, 104, 153);
  font-size: 12px;
  margin-block-start: 25px;
  text-align: center;
  text-decoration: none;
}

.goback:hover {
  text-decoration: underline;
}

.login-column {
  float: inline-start;
}

.login-left {
  inline-size: 60%;
}

.login-right {
  inline-size: 40%;
}

.login-row {
  background-color: white;
}

.login-row::after {
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

.forgotpassword {
  cursor: pointer;
}

</style>

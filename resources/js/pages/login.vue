<script setup>
import logoImage from '@images/icons/logo/laborlink.png';
import backgroundImage from '@images/pages/login-bg.png';
</script>
<template class="body">
  <div class="row">
    <div class="column left">
        <img
          class="background-image"
          :src="backgroundImage"
          alt="image"
        >
    </div>
    <div class="column right inner-padding">
        <header class="header">
            <div class="logo">
                <img
                    :src="logoImage"
                    alt=""
                  >
            <h1 class="logo-text">LaborLink</h1>
          </div>
        </header>
        <main>
            <h2>Login to your Account</h2>
            <p>See what is going on with your business</p>
            <form>
                <label for="email">Email</label>
                <input type="text" id="uemail" name="email" placeholder="email@example.com">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="************">
                <div class="checkbox">
                    <label for="remember-me">
                        <input type="checkbox" element id="remember-me" name="remember-me">
                        Remember Me
                    </label>
                    <a v-on:click="redirectToForgotPasswordPage">Forgot Password?</a>
                </div>
                <button type="button" class="button" v-on:click="authenticateUser">Login</button>
            </form>
            
        </main>
        
         <footer>
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
            this.$router.push(this.forgotPasswordLink);
        },
        authenticateUser(){
            this.$router.push(this.dashboardLink);
        }
    }
    }
</script>

<style lang="scss">
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

.body {
    font-family: "Poppins", sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    min-height: 100vh;
    background-color: #ffffff;
    
}
.container {
    background-color: #fff;
    padding: 110px;
    border-radius: 0;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    width: 400px;
    height: 500px;
    
}

.header {
    text-align: left;
    margin-top: 30px;
    padding-top: 20px;
    padding-left:8px;
    padding-bottom:15px;
}
.logo{
    display: flex;
    align-items: left;
}
.logo-text{
  padding-top: 10px;
}
.logo img{
    margin-right: 10px;
    width: 50px;
    height: 50px;
}

h1 {
    font-size: 20px;
    margin-left: 20;
}
h2 {
    font-size: 25px;
    color: #676767;
    
}
main {
    padding: 10px;
}

p {
    font-size: 12px;
    margin-bottom: 20px;
    line-height: 1;
    color: #676767;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 5px;
    font-weight: bold;
    font-size: 12px;
    color: gray;
}

input[type="text"],
input[type="password"] {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    margin-bottom: 5px;
}

.checkbox {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    
}

.checkbox a {
    color: rgba(53, 104, 153);
    text-decoration: none;
    font-size: 11px;
    font-weight: 600;
}

.button {
    padding: 10px 20px;
    background-color: rgba(53, 104, 153);
    color: #fff;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    font-weight: 600;
}

footer {
    text-align: center;
    margin-top: 40px;
}
footer p{
    font-size: 11px;
    color: gray;
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
        padding: 8px 16px;
    }

    footer p {
        font-size: 8px;
    }
}

input[type="email"],
input[type="password"],
.button[type="button"] {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

.button[type="button"] {
    background-color: rgba(53, 104, 153);
    color: #fff;
    cursor: pointer;
    border-radius: 25px;
    margin-top:25px ;
}

.goback {
    display: block;
    text-align: center;
    margin-top: 25px;
    color: rgba(53, 104, 153);
    text-decoration: none;
    font-size: 12px;
}

.goback:hover {
    text-decoration: underline;
}

.column {
  float: left;
  
}

.left{
  width: 60%;
}

.right{
  width: 40%;
}

.row{
  background-color: white;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

.inner-padding{
  padding-top:100px;
  padding-left:100px;
  padding-right:100px;
}

.background-image{
  max-width: 100%;
  max-height: 100%;
  display: block;
}

</style>

<template>
 <nav class="navbar navbar-expand-lg" style="background-color: #a6a6a6">
    <a class="navbar-brand0" href="/">
      <img src="../assets/Images/logo_front.PNG" alt="" width="45" height="40">
    </a>
    <a class="navbar-brand" href="#">Rebbit</a>

  </nav>




    <div class="form">

      <div class="head">
        <b>Create an account</b>
      </div>
      <div class="centre">
        <div>
          <input type="text" class="btn btn-outline-primary" placeholder="Username*" v-model="username"  />
        </div>
        <div>
          <input type="email" class="btn btn-outline-primary" placeholder="Email*" v-model="email"  />
        </div>
        <div>
          <input type="password" class="btn btn-outline-primary" placeholder="Password*" v-model="password"  />
        </div>
        <div>
          <input type="password" class="btn btn-outline-primary" placeholder="Confirm password*" v-model="password_confirmation"  />
        </div>
        <div>
          <input type="url" class="btn btn-outline-primary" placeholder="profile picture (url)" v-model="profile_pic_url"/>
        </div>
      </div>
      <label for="age">Date of birth </label>
          <select id="age" name="age" v-model="age">
            <option value="1980">1980</option>
            <option value="1990">1990</option>
            <option value="2000" selected>2000</option>
            <option value="2010">2010</option>
            <option value="2020">2020</option>
          </select>
      <div class="centre">
        <button v-on:click="debug(); registerUser();" class="btn btn-outline-primary btn-login">SIGN UP</button>
      </div>
      <footer>
        Already registered ? <strong><a href="/login">Sign in </a></strong>to your account
        <p>*Required fields</p>
      </footer>
    </div>
  
</template>
    
<script>

  export default{
    data()
    {
      return{
        username: "",
        email: "",
        password: "",
        password_confirmation: "", 
        profile_pic_url: "", 
        age: "", 
        currentYear: new Date().getFullYear()
      }
    }, 

    methods:
    {
      debug()
      {
        var userChoice = document.getElementById("age").value;
        console.log(this.username, this.email, this.password, this.profile_pic_url, this.age);
        this.age = this.currentYear - parseInt(userChoice);
        console.log("current year: ", new Date().getFullYear());
        console.log("user selection: ", parseInt(userChoice));
        console.log(this.age);
      }, 
      async registerUser()
      {
        const userChoice = document.getElementById("age").value;
        this.age = this.currentYear - parseInt(userChoice);


        if(this.profile_pic_url != "")
        {
          const requestOptions = {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ 
            username: this.username, 
            email: this.email,
            password: this.password,
            profile_pic_url: this.profile_pic_url, 
            age: this.age
          })
          };
          await fetch("http://localhost:8000/api/AddUserTest", requestOptions)
            .then((response) => console.log(response));
          alert("An email verification link has been sent to " + this.email);
        }
        else
        {
          const requestOptions = {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ 
            username: this.username, 
            email: this.email,
            password: this.password,
            age: this.age
          })
          };
          await fetch("http://localhost:8000/api/AddUserTest", requestOptions)
            .then((response) => console.log(response));
          alert("An email verification link has been sent to " + this.email);
        }
      }
    }
  }
</script>
    
<style scoped>
.navbar-brand0 {
  margin-left: 1%;
}

label{
  margin-left:40%;
}
.form {
  margin-top: 3%;
}

body {
  display: flex;
  padding: 0;
  flex-direction: row;
  background-color: #d9d9d9;
  justify-content: center;
  width: 212.9vh;
  height: 92vh;

}


.nav {
  display: flex;
  justify-content: flex-start;
  text-align: center;
  align-items: flex-start;
  margin: 0;
}


.centre {
  text-align: center;
  
}

form div+div {
  margin-top: 1em;
}

.head {
  text-align: center;
}

b {
  font-family: public Sans;
  font-size: 30px;
}

h3 {
  color: black;
  font-weight: 100;
  font-family: public Sans;
  font-size: 17px;

}

input,
textarea {
  font: 1em open sans;
  border-radius: 1em;
  width: 300px;
  height: 40px;
  border: none;
  background-color: #f2f3f7;
  margin: 0 auto;
  padding: 10px;
  font-family: Open Sans;
  padding-left: 20px;
}

input:hover {
  border-color: #f5d505;
  background-color: #e5e5e5;
}

.forgotdiv {
  text-align: right;
  padding-right: 50px;
}

button {
  margin-left: 0.5em;
  background-color: #ffee00;
  width: 70%;
  margin: 0 auto;
  height: 60px;
  border-radius: 1em;
  border: none;
  font-family: Open Sans;
}

.btn-login {
  color: black;
  font-weight: 600;
  font-size: 15px;
}


footer {
  text-align: center;
  font-family: Open Sans;
  margin-top: 20px;
  color: black;
}

.btn-outline-primary {
  --bs-btn-color: #000000;
  --bs-btn-border-color: #4400ff;
  --bs-btn-hover-color: #000000;
  --bs-btn-hover-bg: #e5e5e5;
  --bs-btn-hover-border-color: #00ff0d;
  --bs-btn-focus-shadow-rgb: #00fbff;
  --bs-btn-active-color: #0000;
  --bs-btn-active-bg: #e5e5e5;
  --bs-btn-active-border-color: #ff0000;
  --bs-btn-active-shadow: inset 0 3px 5pxrgba(0, 0, 0, 0.125);
  --bs-btn-disabled-color: #0000;
  --bs-btn-disabled-bg: transparent;
  --bs-btn-disabled-border-color: #e100ff;
  --bs-gradient: none;
  margin:13px;
}
</style>
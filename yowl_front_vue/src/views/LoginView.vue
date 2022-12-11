<template>
  <nav class="navbar navbar-expand-lg" style="background-color: #a6a6a6">
    <a class="navbar-brand0" href="/">
      <img src="../assets/Images/logo_front.PNG" alt="" width="45" height="40">
    </a>
    <a class="navbar-brand" href="#">Rebbit</a>

  </nav>



    <div class="form5">

      <div class="head5">
        <b>LOGIN</b>
        <h3> Please enter your credentials to log-in</h3>
      </div>
      <div class="centre1">
        <div>
          <input type="text" class="btn5 btn-outline-primary" placeholder="Username" v-model="username" required />
        </div>
        <div>
          <input type="password" class="btn5 btn-outline-primary" placeholder="Password" v-model="password" required />
        </div>
      </div>

      <div class="centre2">
        <button v-on:click="login();" class="btn5 btn-outline-primary btn-login">
          SIGN IN
        </button>
      </div>
 

      
        <footer>
          Not signed in yet? <strong><a href="/register" style="text-decoration: none">Register</a></strong> your account for free
        </footer>
      <br />
    </div>
</template>

<script>
export default{
  data()
  {
    return{
      username: "",
      password: "",
      thisUser: "", 
      loggedUser: []
    }
  }, 

  methods: {
    async debug()
    {
      const response = await fetch("http://localhost:8000/api/usersWithUsername/" + this.username)
        .then((response) => response.json());
      
      this.thisUser = response;
      console.log(this.thisUser.id);
    }, 
    async fetchThisUser()
    {
      const response = await fetch("http://localhost:8000/api/usersWithUsername/" + this.username)
        .then((response) => response.json());
      
      this.thisUser = response;
      console.log(this.thisUser.id, this.thisUser.username);
    },
    async login()
    {
      const requestOptions = {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ 
        username: this.username, 
        password: this.password,
        })
      };
      const response = await fetch("http://localhost:8000/api/Login", requestOptions)
        .then((response) => response.json());
      console.log(response);
      this.loggedUser = response;

      if(response.id)
      {
        console.log("login successful");
        this.$router.push("/connected/" + this.loggedUser.id);
      }
      else
      {
        alert("Incorrect credentials");
        console.log("login not successful");
      }
      
    }
  },

}
</script>

<style scoped>
.navbar-brand0 {
  margin-left: 1%;
}

.form5 {
  margin-top: 3%;
}

body {
  display: flex;
  padding: 0;
  flex-direction: row;
  background-color: #d9d9d9;
  justify-content: center;
  width: 100vw!important;
  height: 100vh!important;
}

.navbar-expand-lg {
  width: 100%;
}

.nav {
  display: flex;
  justify-content: flex-start;
  text-align: center;
  align-items: flex-start;
  margin: 0;
}


.centre1 {
  text-align: center;
  height: 27%;
}

.centre2 {
  text-align: center;
  height: 10%;
}



.head5 {
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
  background-color: #a6a6a6;
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
  width:20%;
  box-shadow:1px 1px 2px 1px;
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
  --bs-btn-active-border-color: #802a2a;
  --bs-btn-active-shadow: inset 0 3px 5pxrgba(0, 0, 0, 0.125);
  --bs-btn-disabled-color: #0000;
  --bs-btn-disabled-bg: transparent;
  --bs-btn-disabled-border-color: #e100ff;
  --bs-gradient: none;
  margin:13px;
}
</style>
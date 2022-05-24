<template>
  <div>
    <div class="signup">
      <img src="../assets/logo.png" width="190" height="190">
      <form id="form" action="http://localhost:8080/" method="post" >
        <label>
          <input type="email" placeholder="Adresse email..." v-model="email">
        </label><br>
        <label>
          <input type="password" placeholder="Mot de passe..." v-model="password">
        </label><br>
        <button type="submit" @click="signup">Connexion</button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      email: "",
      password: ""
    };
  },
  methods: {
    signup() {
      const postData = { email: this.email, password: this.password };
      this.$http
      .post('http://localhost:5000/users/login', postData)
      .then(function (response) {
        if (response.status === 200 && 'token' in response.body) {
          this.$session.start()
          this.$session.set('jwt', response.body.token)
          this.$http.headers.common['Authorization'] = 'Bearer ' + response.body.token
          window.open("http://localhost:8080/", "_parent");
          console.log(postData)
          let id = JSON.parse(response.bodyText)
          sessionStorage.setItem('userId', id.userId)
          console.log("Connexion réussi")
          }
        }, function (err) {
          console.log('err', err)
        })
      }
    }
  }
</script>

<style>
.signup {
  text-align: center;
  margin-top: 70px;
}

input {
  height: 20px;
  width: 210px;
  margin: 5px;
  padding: 10px;
  border: solid black 1px;
  border-radius: 19px;
  font-size: 16px;

}
button{
  height: 45px;
  width: 310px;
  border: solid black 1px;
  border-radius: 22px;
  margin-top: 25px;
  font-size: 18px;
  font-weight: bold;
  color: #2c3e50;
}

button:hover{
  opacity: 0.7;
}
</style>
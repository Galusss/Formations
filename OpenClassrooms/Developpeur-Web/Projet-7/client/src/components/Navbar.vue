<template>
  <div>
    <header>
      <div class="ui inverted segment">
        <div class="ui inverted secondary pointing menu">
          <img src="../assets/icon-left-font-monochrome-white.png" alt="Réseau social de la société Groupomania" class="imgNav" width="150" height="150" @click="goToHome()">
          <a class="item" @click="goToHome()">
            <span>Accueil</span>
          </a>
          <a class="item" v-show="this.$session.exists()" @click="goToArticles()">
            <span>Articles</span>
          </a>
          <a class="item" v-show="this.$session.exists()" @click="goToAccount()">
            <span>Mon compte</span>
          </a>
          <a class="item logout"  @click="logout()" v-show="this.$session.exists()">
            <span>Déconnexion</span>
          </a>
        </div>
      </div>
    </header>
  </div>
</template>


<style scoped>
div.ui.inverted.segment{
  padding: 0 20px;
}

.ui.segment{
  border-radius: 0px;
}

.ui.secondary.pointing.menu .item {
  padding: 0px 25px;
  padding-bottom: 3px;
  font-size: 24px;
  font-family: Verdana, Geneva, Tahoma, sans-serif;
}

.ui.secondary.inverted.pointing.menu, .ui.inverted.segment, .ui.primary.inverted.segment {
  background-color: #162a4a;
}

img{
  margin-right: 30px;
}

a.item{
  height: 150px;
  width: auto;
}

.ui.secondary.inverted.menu .dropdown.item:hover, .ui.secondary.inverted.menu .link.item:hover, .ui.secondary.inverted.menu a.item:hover {
  color: initial;
}

span:hover{
  color: #ffffff;
}

@media screen and (max-width: 900px) {
  .imgNav{
    display: none;
  }

  a.item{
    height: initial;
  }

  div.ui.inverted.segment{
    padding: 0px;
  }

  .ui.secondary.pointing.menu .item {
    padding: 10px 10px;
    margin: 0px;
    font-size: 14px;
  }
}

@media screen and (max-width: 400px) {
  .ui.secondary.pointing.menu .item {
    font-size: 10px;
    padding: 10px 5px;
  }
}
</style>


<script>
export default {
  name: 'Navbar',
  props: {
    msg: String
  },
  methods: {
    logout: function () {
      this.$session.destroy()
      sessionStorage.clear();
      window.open("http://localhost:8080/", "_parent");
    },
    goToHome: function () {
      window.open("http://localhost:8080/", "_parent");
    },
    goToArticles: function() {
      window.open("http://localhost:8080/articles", "_parent");      
    },
    goToAccount: function() {
      window.open("http://localhost:8080/account", "_parent"); 
    }
  }
}
</script>

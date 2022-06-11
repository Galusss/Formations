<template>
    <div class="article">
        <div class="headerArticle">
            <img src="../assets/logo.png" alt="Logo de la société Groupomania" width="200" height="200">
            <h1>Tous les articles présents sur Groupomania</h1>
        </div>
        <section>
            <div class="ui cards">
                <div class="card" v-for="article in articles" :key="article" @click="getOne(article)">
                    <div class="content">
                        <div class="header">
                            {{ article.articleName }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="btnArticle">
                <button class="ui blue button" @click="goToNewArticle()">Créer un article</button>
            </div>
        </section>
    </div> 
</template>


<style scoped>
.headerArticle{
  text-align: center;
  margin: 80px 0px;
}

h1{
  font-family: Georgia, 'Times New Roman', Times, serif;
  font-size: 40px;
  color: rgb(14, 14, 14);
}

h1:after{
  margin: 0;
  content: ' .';
  animation: dots 2s infinite;
}

@keyframes dots{
  0%, 20% {
    color: rgb(14, 14, 14);
    text-shadow: 0.25em 0 0 rgba(0, 0, 0, 0), 0.5em 0 0 rgba(0, 0, 0, 0);
  }
  40% {
    color: rgb(14, 14, 14);
    text-shadow: 0.25em 0 0 rgb(14, 14, 14), 0.5em 0 0 rgba(0, 0, 0, 0);
  }
  60% {
    text-shadow: 0.25em 0 0 rgb(14, 14, 14), 0.5em 0 0 rgba(0, 0, 0, 0);
  }
  80%, 100% {
    text-shadow: 0.25em 0 rgb(14, 14, 14), 0.5em 0 0 rgb(14, 14, 14);
  }
}


.card{
    width: auto;
    height: 150px;
    transform: scale(1);
    transition: transform 0.2s;
    text-align: center;
}


.ui.card > .content > .header:not(.ui), .ui.cards > .card > .content > .header:not(.ui) {
    color: rgb(14, 14, 14);
    font-size: 24px;
}

div.ui.cards{
    margin-top: 50px;
}

.card:hover{
    transform: scale(1.05);
}

div.ui.cards{
    margin: 60px 0px;
}

.ui.card .content, .ui.cards .card .content {
    margin: 53px;
}

.ui.card, .ui.cards > .card{
    border: solid grey 0.1em;
    border-radius: 6px;
    -webkit-box-shadow: 8px 8px 5px 0px rgba(0,0,0,0.4);
    -moz-box-shadow: 8px 8px 5px 0px rgba(0,0,0,0.4);
    box-shadow: 8px 8px 5px 0px rgba(0,0,0,0.4);
    background-color: #bfbfb8;
}

.ui.card, .ui.cards > .card:hover{
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
}

.ui.cards .card{
    margin: 40px;
    justify-content: center;
}

.btnArticle{
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center; 
}

.ui.button{
  border: solid black 1px;
  color: black;
}

.ui.blue.button {
    margin: 50px;
    font-weight: bold;
    font-size: 20px;
    font-family: Georgia, 'Times New Roman', Times, serif;
    min-width: 300px;
}

.ui.blue.button:hover{
    opacity: 0.6;
}

@media screen and (max-width: 1200px) {
  h1{
    font-size: 28px;
  }
}

@media screen and (max-width: 900px) {
  h1{
    font-size: 20px;
  }
  img{
    width: 120px;
    height: 120px;
  }
}

@media screen and (max-width: 550px) {
  h1{
    font-size: 12px;
  }
  
  img{
    width: 80px;
    height: 80px;
  }

  .card{
    max-width: 50px;
  }
}
</style>


<script>
let data = JSON.parse(sessionStorage.getItem('vue-session-key')); 
let token = data.jwt;
export default {
    data () {
        return {
            articles: []    
        };
    },
    mounted () {
        this.$http.get("http://localhost:5000/articles", {
            headers: {
                Authorization: 'bearer ' + token
            }
        })    
        .then(response => {   
            response.json().then((data) => {
                this.articles = data
                let card = document.querySelector("div.ui.cards");
                let title = document.querySelector("h1");
                if (response.body.status == "No article found") {
                    title.innerHTML = "Aucun article n'est présent pour le moment"
                    card.style.display = "none";
                } else{
                    card.style.display = "flex";
                }
            })

        }, (response) => {
            console.log('erreur', response)
        });  
    },
    methods: {
        getOne (article) {
            this.$http.get("http://localhost:5000/articles/" + article.article_id, {
                headers: {
                    Authorization: 'bearer ' + token
                }               
            })    
            .then(response => {   
                response.json().then((data) => {
                    this.article = data
                    console.log('success', data)
                    let res = data.date_publication.split("-")
                    sessionStorage.setItem('articleDateAnnee', res[0]);
                    sessionStorage.setItem('articleDateMois', res[1]);
                    let dateJour = res[2].split("T")
                    sessionStorage.setItem('articleDateJour', dateJour[0]);
                    sessionStorage.setItem('article', JSON.stringify(data));
                    window.open("http://localhost:8080/article/" + article.article_id, "_parent");
                })       
            }, (response) => {
                console.log('erreur', response)
            });  
        },
        goToNewArticle() {
            window.open("http://localhost:8080/article/new", "_parent");
        }
    }
}
</script>

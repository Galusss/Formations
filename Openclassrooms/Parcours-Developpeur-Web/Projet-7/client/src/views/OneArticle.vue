<template>
    <div class="oneArticle">
        <div class="headerOneArticle">
            <h1>
                <img src="../assets/logo.png" alt="Logo de la société Groupomania" width="200" height="200">
            </h1>   
        </div>
        <section>
            <div class="error"></div>
            <div class="ui card">
                <div class="content">
                    <div class="header">
                        {{ name }}
                    </div>
                    <p> {{ description }} </p>
                    <div class="meta">
                        <span>Source(s) :</span> {{ source }}
                    </div>
                    <div class="meta">
                        <span>Publié par</span> {{ firstnameAuthor + " " + lastnameAuthor }}
                    </div>
                    <div class="meta">
                        <span>Date de publication :</span> {{  dateJour + "/" + dateMois + "/" + dateAnnee }}
                    </div>
                </div>
                <div class="btnManageArticle">
                    <button class="ui blue button editBtn" @click="goToUpdateArticle()">Modifier l'article</button>
                    <button class="ui blue button deleteBtn" @click="destroy()">Supprimer l'article</button>
                </div>
                <div class="manageComment">
                    <p class="addComments" @click="openAddComment()">Publier un commentaire</p>
                </div>
                <div class="errorComment"></div>
                <div class="postComment">
                    <label for="commentaire">Publication d'un nouveau commentaires: </label>
                    <textarea class="inputComment" type="text" id="commentaire" name="commentaire" placeholder="Ecrivez votre commentaire ici..."></textarea>
                    <p @click="createComment()">Publier le commentaire</p>
                </div>
                <div class="commentaires"> 
                </div>    
            </div>
            <div class="btnOneArticle">
                <button class="ui blue button" @click="goToArticle()">Voir tout les articles</button>
                <button class="ui blue button" @click="goToNewArticle()">Créer un article</button>
            </div>
        </section>
    </div>
</template>


<style scoped>
.headerOneArticle{
    text-align: center;
    margin: 60px 0px;
}

.header{
    margin-bottom: 50px;
}

.error, .errorComment{
  color: red;
  margin: 10px 0px;
  font-size: 18px;
  font-weight: 400;
  text-align: center;
}

.ui.card > .content > .header:not(.ui), .ui.cards > .card > .content > .header:not(.ui) {
    color: rgb(14, 14, 14);
    font-size: 30px;
}

p{
    color: rgb(14, 14, 14);
    font-size: 16px;   
}

.ui.card .meta, .ui.cards > .card .meta {
    color: rgba(14, 14, 14, 0.795);
    font-size: 14px;
}

.ui.card {
    margin: auto;
    width: 700px;
    height: auto;
    background-color: #bfbfb8;
    font-weight: bold;
}

.ui.card > .content p, .ui.cards > .card > .content p {
    margin-bottom: 50px;
}

.meta{
    margin: 5px 0px;
}

.deleteArticleBtn, .btnOneArticle{
    text-align: center;
    margin: 15px;
}

.btnOneArticle{
    margin: 60px 0px;
}

.ui.button{
    margin: 30px;
    border: solid black 1px;
    color: black;
}

.ui.blue.button{
    font-weight: bold;
    font-size: 18px;
    font-family: Georgia, 'Times New Roman', Times, serif;
    min-width: 250px;
}

.ui.blue.button:hover{
    opacity: 0.6;
}

.ui.card > :last-child, .ui.cards > .card > :last-child {
border-top-left-radius: 0.285714rem;
border-top-right-radius: 0.285714rem;
}

.manageComment{
    display: flex;
}

.addComments{
    font-size: 12px;
    padding: 1em;
    padding-top: 0px;
}

.postComment{
    background-color: white;
    width: 100%;
    border: solid 1px black; 
    display: none;
}

.postComment label{
        font-size: 11px;
        padding: 2px;
}

.inputComment{
    width: 100%;
    min-height: 30px;
}

.postComment p{
    display: flex;
    float: right;
    padding: 4px;
    font-size: 11px;
    color: blue;
}

@media screen and (max-width: 900px) {
    img{
        width: 120px;
        height: 120px;
    }

    .ui.card{
        width: 500px;
    }

    .btnManageArticle{
        display: flex;
        flex-direction: column;
        align-items: center;    
    }
}

@media screen and (max-width: 550px) {
    img{
        width: 80px;
        height: 80px;
    }

    .ui.card{
        width: 300px;
    }
    .ui.blue.button, .ui.red.button{
        font-size: 10px;
        min-width: 150px;
        margin-top: 10px;
    }

    .ui.card > .content > .header:not(.ui), .ui.cards > .card > .content > .header:not(.ui) {
        font-size: 22px;
    }

    p{
        font-size: 12px;   
    }

    .ui.card .meta, .ui.cards > .card .meta {
        font-size: 10px;
    }
}
</style>


<script>
let data = JSON.parse(sessionStorage.getItem('article'));
let dateJour = sessionStorage.getItem('articleDateJour');
let dateMois = sessionStorage.getItem('articleDateMois');
let dateAnnee = sessionStorage.getItem('articleDateAnnee');
let myId = sessionStorage.getItem('userId');
let myPermission = sessionStorage.getItem('userPermission');
let dataToken = JSON.parse(sessionStorage.getItem('vue-session-key')); 
let token = dataToken.jwt;
export default {
    mounted () {
        this.$http.get("http://localhost:5000/commentaires", {
            headers: {
                Authorization: 'bearer ' + token
            }
        })    
        .then(response => {   
            response.json().then((dataComment) => {
                this.comments = dataComment;
                if (dataComment.status !== "No commentaire found") {
                    let a = dataComment.length;
                    let b = 0;
                    for(; b != a; b++) {
                        if (data.article_id == dataComment[b].articleId) {
                            let cardComment = document.querySelector(".commentaires");
                            let commentDiv = document.createElement("div"); // New div for comments          
                            cardComment.appendChild(commentDiv)   
                            commentDiv.style.backgroundColor = "white"
                            commentDiv.style.width = "100%"
                            commentDiv.style.minHeight = "auto";
                            commentDiv.style.border = "solid 1px black"
                            commentDiv.style.marginTop = "5px"
                            commentDiv.setAttribute("class", "test")
                            let authorComment = document.createElement("span"); // New span for Author Comment
                            commentDiv.appendChild(authorComment)
                            authorComment.textContent = dataComment[b].author + " : "
                            authorComment.style.fontSize = "14px"
                            authorComment.style.padding = "4px"
                            let textComment = document.createElement("span"); // New span for Text Comment
                            authorComment.appendChild(textComment)
                            textComment.textContent = dataComment[b].text
                            textComment.style.fontSize = "12px"  
                            let deleteComment = document.createElement("div"); // New span for Button Delete Comment
                            textComment.appendChild(deleteComment)
                            deleteComment.textContent = "Supprimer le commentaire"
                            deleteComment.style.color = "rgb(110, 0, 0)"
                            deleteComment.style.fontSize = "11px"
                            deleteComment.style.padding = "4px"
                            if ((dataComment[b].userId != myId) && (myPermission != 1)) {
                                deleteComment.style.display = "none"
                            }
                            let commentId = document.createElement("span"); // New span for store the commentaire Id
                            deleteComment.appendChild(commentId)
                            commentId.textContent = dataComment[b].commentaire_id
                            commentId.style.display = "none"
                            deleteComment.addEventListener("click", event => {
                                console.log(event)
                                this.$http.delete("http://localhost:5000/commentaires/" + commentId.textContent, {
                                    headers: {
                                        Authorization: 'bearer ' + token
                                    }
                                })
                                .then(response => {   
                                    response.json().then((data) => {
                                        console.log('success', data)
                                        window.location.reload();
                                    })       
                                }, (response) => {
                                    console.log('erreur', response)
                                }); 
                            })                           
                        }
                    }
                }
            })
        }, (response) => {
            console.log('erreur', response)
        });  
        if ((data.userId != myId) && (myPermission != 1)) {
            document.querySelector(".deleteBtn").style.display = "none";
        }
        if (data.userId != myId) {
            document.querySelector(".editBtn").style.display = "none";
        }
    },
    data () {
        return {
            name: data.articleName,
            description: data.article_description,
            source: data.source_article,
            dateJour: dateJour,
            dateMois: dateMois,
            dateAnnee: dateAnnee,
            lastnameAuthor: data.lastnameAuthor,
            firstnameAuthor: data.firstnameAuthor
        };
    },
    dataComment: function () {
        return {
            textComment: ""
        };
    },
    methods: {
        destroy: function () {
            if (data.userId == myId || myPermission == 1) {
                this.$http.delete("http://localhost:5000/articles/" + data.article_id, {
                    headers: {
                        Authorization: 'bearer ' + token
                    }
                })    
                .then(response => {   
                    response.json().then((data) => {
                        console.log('success', data)
                        sessionStorage.removeItem('article');
                        window.open("http://localhost:8080/articles/", "_parent");
                    })       
                }, (response) => {
                    console.log('erreur', response)
                }); 
            } else{
                let error = document.querySelector(".error")
                error.innerHTML = "Erreur: Vous ne pouvez pas supprimer un article que vous n'avez pas créer."
            }
        },
        goToArticle() {
            window.open("http://localhost:8080/articles/", "_parent");      
        },
        goToNewArticle() {
            window.open("http://localhost:8080/article/new", "_parent");
        },
        goToUpdateArticle() {
            window.open("http://localhost:8080/article/update/" + data.article_id, "_parent");
        },
        openAddComment() {
            let addComments = document.querySelector(".addComments");
            let postComment = document.querySelector(".postComment");
            if (addComments.textContent == "Annuler la publication du commentaire") {
                addComments.innerHTML = "Publier un commentaire"
                postComment.style.display = "none";
                let error = document.querySelector(".errorComment");
                error.style.display = "none";
            } else if (addComments.textContent == "Publier un commentaire") {
                addComments.innerHTML = "Annuler la publication du commentaire"
                postComment.style.display = "block";
                let error = document.querySelector(".errorComment");
                error.style.display = "block";
            }
        },
        createComment() {
            let prenom = sessionStorage.getItem('userFirstname')
            let nom = sessionStorage.getItem('userLastname')
            let author = prenom + " " + nom
            let textComment = document.querySelector(".inputComment")
            const postData = { text: textComment.value, articleId: data.article_id, userId: myId, author: author };
            if (textComment.value.length > 0) {
                this.$http
                .post('http://localhost:5000/commentaires', postData)
                .then(response => {   
                    console.log('success', response)
                    window.location.reload()
                }, (response) => {
                    console.log('erreur', response)
                }); 
            } else{
                let error = document.querySelector(".errorComment");
                error.innerHTML = "Vous ne pouvez pas publier un commentaire vide."
            }
        }
    }
}
</script>

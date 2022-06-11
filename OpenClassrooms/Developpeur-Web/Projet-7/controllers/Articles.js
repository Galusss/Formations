const Article = require('../models/Article')
const User = require('../models/User')
User.hasOne(Article, {
    onDelete: 'CASCADE',
});
Article.belongsTo(User)


// get all article
exports.getAllArticle = function (req, res) {
    Article.findAll({order: [["date_publication", 'DESC']]})
    .then(article => {
        if(article.length === 0) {
            res.json({
                status: 'No article found'
            })
            
        }else {
            res.json(article)
        }
    })
};


// get one article with id
exports.getOneArticle = function (req, res) {
    Article.findOne({
        where: {
            article_id: req.params.id
        }
    })
    .then(article => {
        if(!article) {
            res.json({
                status: 'Article not found'
            })
            res.send(err)
        }else {
            res.json(article)
        }
    })
};


// create
exports.create = function (req, res) {
    const today = new Date()
    const articleData = {
        articleName: req.body.articleName,
        article_description: req.body.article_description,
        source_article: req.body.source_article,
        userId: req.body.userId,
        lastnameAuthor: req.body.lastnameAuthor,
        firstnameAuthor: req.body.firstnameAuthor,
        date_inscription: today
    }
    Article.findOne({
        where: {
            articleName: req.body.articleName
        },
    })
    .then(article => {
        if (!article) {
            Article.create(articleData)
            .then(article => {
                res.json({
                    status: article.articleName + ' registered'
                })
            })
            .catch(err => {
                res.send('error: ' + err)
            }) 
        }else {
            res.json({
                error: 'Article name already exists'
            })
        }
    })
    .catch(err => {
        res.send('error: ' + err)
    })
};


// update article with id
exports.update = function (req, res) {
    Article.findOne({
        where: {
            articleName: req.body.articleName
        }       
    })
    .then(article => {
        if (!article) {
            Article.findOne({
                where: {
                    article_id: req.params.id
                }
            })
            .then(async article => {
                if (!article) {
                    res.json({
                        status: 'Article not updated'
                    })
                    throw Error('Article not updated');
                }else {
                    article.source_article = req.body.source_article,
                    article.articleName = req.body.articleName,
                    article.article_description = req.body.article_description,
                    await article.save();
                    res.json(article)
                }
            })
        }else {
            res.json({
                error: 'Article name already exists'
            })            
        }
    })

};


// delete article with id
exports.delete = function (req, res) {
    Article.findOne({
        where: {
            article_id: req.params.id
        }
    })
    .then(async article => {
        if (!article) {
            res.json({
                status: 'Article not deleted'
            })
            throw Error('Article not deleted')
        }else {
            await article.destroy()
            res.json({
                status: 'Article successfully deleted'
            })
        }
    })
};
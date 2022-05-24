const Commentaires = require('../models/Commentaire')
const User = require('../models/User')
User.hasOne(Commentaires, {
    onDelete: 'CASCADE',
});
Commentaires.belongsTo(User)


// get all commentaires
exports.getAllCommentaire = function (req, res) {
    Commentaires.findAll({order: [["createdAt", 'DESC']]})
    .then(commentaire => {
        if(commentaire.length === 0) {
            res.json({
                status: 'No commentaire found'
            })
            
        }else {
            res.json(commentaire)
        }
    })
};

exports.create = function (req, res) {
    const today = new Date()
    const commentaireData = {
        userId: req.body.userId,
        text: req.body.text,
        articleId: req.body.articleId,
        author: req.body.author,
        createdAt: today
    }
    Commentaires.findOne()
    .then(Commentaire => {
        Commentaires.create(commentaireData)
        .then(commentaire => {
            res.json({
                status: 'commentaire ' + commentaire.commentaire_id +  ' registered'
            })
        })
        .catch(err => {
            res.send('error: ' + err)
        }) 
        
    })
    .catch(err => {
        res.send('error: ' + err)
    })
};

exports.delete = function (req, res) {
    Commentaires.findOne({
        where: {
            commentaire_id: req.params.id
        }
    })
    .then(async article => {
        if (!article) {
            res.json({
                status: 'Commentaire not deleted'
            })
            throw Error('Commentaire not deleted')
        }else {
            await article.destroy()
            res.json({
                status: 'Commentaire successfully deleted'
            })
        }
    })
};
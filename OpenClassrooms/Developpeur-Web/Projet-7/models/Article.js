const Sequelize = require("sequelize")
const db = require("../config/db")

const Article = db.sequelize.define(
    'articles', {
        article_id: {
            type: Sequelize.SMALLINT,
            primaryKey: true,
            autoIncrement: true,
            unique: true,
            allowNull : false
        },
        userId: {
            type: Sequelize.SMALLINT,
            allowNull : false
        },
        articleName: {
            type: Sequelize.STRING,
            unique: true,
            allowNull : false
        },
        article_description: {
            type: Sequelize.TEXT,
            allowNull : false
        },
        source_article: {
            type: Sequelize.STRING,
            allowNull : false,
            defaultValue: "Pas de source renseignée"
          
        },
        date_publication: {
            type: Sequelize.DATE,
            allowNull : false,
            defaultValue: Sequelize.NOW
        },
        lastnameAuthor: {
            type: Sequelize.STRING,
            allowNull : false
        },
        firstnameAuthor: {
            type: Sequelize.STRING,
            allowNull : false
        }
    }, 
    {
        timestamps: false
    }
)


module.exports = Article;
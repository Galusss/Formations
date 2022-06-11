const Sequelize = require("sequelize")
const db = require("../config/db")


const Commentaire = db.sequelize.define(
    "commentaire", {
        commentaire_id: {
            type: Sequelize.SMALLINT,
            unique: true,
            autoIncrement: true,
            primaryKey: true,
            allowNull : false
        },
        userId: {
            type: Sequelize.SMALLINT,
            allowNull : false
        },
        articleId: {
            type: Sequelize.SMALLINT,
            allowNull : false
        },
        text: {
            type: Sequelize.TEXT,
            allowNull : false
        },
        author: {
            type: Sequelize.STRING,
            allowNull : false
        },
        createdAt: {
            type: Sequelize.DATE,
            allowNull : false,
            defaultValue: Sequelize.NOW
        },
    },
    {
        timestamps: false
    }
)

module.exports = Commentaire;
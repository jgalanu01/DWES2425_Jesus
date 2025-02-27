const orm = require('sequelize')

const bd = new orm('busNode','root','root',{host:'localhost',port:'3306',dialect:'mysql',dialectModule:require('mysql2')})

module.exports = bd;
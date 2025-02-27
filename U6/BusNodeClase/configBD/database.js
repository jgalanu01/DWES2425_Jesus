const Sequelize=require('sequelize');

//primero se le pasa el nombre de la base de datos, luego el usuario de conexión (root), luego la contraseña ('root')
const bd=new Sequelize('busClase','root','root',{
    host:'localhost',
    port:'3306',
    dialect:'mysql',
    dialectModule:require('mysql2')
});

module.exports=bd;
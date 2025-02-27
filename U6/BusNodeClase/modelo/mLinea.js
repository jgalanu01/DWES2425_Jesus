//Importar tipos de datos para saber en las tablas que campos van a ser
const {DataTypes}=require('sequelize');

//Configuración de la bd la tenemos en configBD/database
const bd=require('../configBD/database');

//Esto hace un create table con los campos que ponga en el examen en la tabla lineas
const Linea=bd.define('Linea',{      
    id:{
        type:DataTypes.INTEGER,
        primaryKey:true,
        autoIncrement:true
    
    },

    nombre:{
        type:DataTypes.STRING,
        allowNull:false
    },
    origen:{
        type:DataTypes.STRING,
        allowNull:false,
       
    },

    destino:{
        type:DataTypes.STRING,
        allowNull:false
    },
},

{

    tableName:'lineas',
    timestamps:true

});

module.exports=Linea;



//Modelos y luego al index.js de modelo

    
    

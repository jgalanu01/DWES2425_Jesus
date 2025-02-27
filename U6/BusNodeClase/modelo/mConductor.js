//Importar tipos de datos para saber en las tablas que campos van a ser
const {DataTypes}=require('sequelize');

//Configuración de la bd la tenemos en configBD/database
const bd=require('../configBD/database');

//Esto hace un create table con los campos que ponga en el examen en la tabla conductores
const Conductor=bd.define('Conductor',{      //El 'Conductor' es igual al const Conductor
    id:{
        type:DataTypes.INTEGER,
        primaryKey:true,
        autoIncrement:true
    
    },

    nombreApe:{
        type:DataTypes.STRING,
        allowNull:false
    },
    dni:{
        type:DataTypes.STRING,
        allowNull:false,
        unique:true
    },

    telefono:{
        type:DataTypes.STRING,
        allowNull:false
    },

    fechaContrato:{
        type:DataTypes.DATE,
        allowNull:false
    }
},

{

    tableName:'conductores',
    timestamps:true

});

module.exports=Conductor;


//Modelos y luego al index.js de modelo

    
    

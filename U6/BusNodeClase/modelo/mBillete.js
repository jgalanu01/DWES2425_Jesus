//Importar tipos de datos para saber en las tablas que campos van a ser
const {DataTypes}=require('sequelize');

//Configuración de la bd la tenemos en configBD/database
const bd=require('../configBD/database');

//Esto hace un create table con los campos que ponga en el examen en la tabla billetes
const Billete=bd.define('Billete',{      
    id:{
        type:DataTypes.INTEGER,
        primaryKey:true,
        autoIncrement:true
    
    },

    conductor_id:{
        type:DataTypes.INTEGER,
        allowNull:false,
        references:{
            model:'conductores',
            key:'id'
        },
        onUpdate:'cascade',
        onDelete:'restrict'
    },
    linea_id:{
        type:DataTypes.INTEGER,
        allowNull:false,
        references:{
            model:'lineas',
            key:'id'
        },
        onUpdate:'cascade',
        onDelete:'restrict'
    },

    fecha:{
        type:DataTypes.DATE,
        allowNull:false
    },

    hora:{
        type:DataTypes.TIME,
        allowNull:false
    },

    precio:{
        type:DataTypes.FLOAT,
        allowNull:false
    },

    tipo:{
        type:DataTypes.ENUM('General','Reducido'),
        allowNull:false
    }
},

{

    tableName:'billetes',
    timestamps:true

});

module.exports=Billete;

//Modelos y luego al index.js de modelo



    
    

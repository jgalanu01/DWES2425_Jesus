const {DataTypes} = require('sequelize');

const bd = require('../configDB/database')

const Linea = bd.define('Linea',{
    id:{
        type:DataTypes.INTEGER,
        primaryKey:true,
        autoIncrement: true
    },
    nombre:{
        type:DataTypes.STRING,
        allowNull:false,
    },
    origen:{
        type:DataTypes.STRING,
        allowNull:false,
    },
    destino:{
        type:DataTypes.STRING,
        allowNull:false,
    },
    
},{
    timestamps:true,
    tableName:'lineas',
});

module.exports=Linea;
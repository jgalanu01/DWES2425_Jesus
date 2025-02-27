const {DataTypes} = require('sequelize');

const bd = require('../configDB/database')

const Conductor = bd.define('Conductor',{
    id:{
        type:DataTypes.INTEGER,
        primaryKey:true,
        autoIncrement: true
    },
    nombreApe:{
        type:DataTypes.STRING,
        allowNull:false,
    },
    dni:{
        type:DataTypes.STRING,
        allowNull:false,
        unique:true,
    },
    telefono:{
        type:DataTypes.STRING,
        allowNull:true,
    },
    fechaContrato:{
        type:DataTypes.DATEONLY,
        allowNull:false,
    },
},{
    timestamps:true,
    tableName:'conductores',
});

module.exports=Conductor;
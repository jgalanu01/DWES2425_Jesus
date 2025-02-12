//Importar libreria de tipos de datos de sequelize
const {DataTypes}= require('sequelize');

//Importar configuración BD
const bd= require('../config/database');
const { on } = require('../app');

//Definimos el modelo de oferta
const Oferta=bd.define('ofertas',
    {
        id:{
            type:DataTypes.INTEGER,
            primaryKey:true,
            autoIncrement:true
        },
        titulo:{
            type:DataTypes.STRING,
            allowNull:false
        },
        descripcion:{
            type:DataTypes.STRING,
            allowNull:false
        },
      usuario_id:{
          type:DataTypes.INTEGER,
          allowNull:false,
          references:{
              model:'usuarios',
              key:'id'
          },
          onUpdate:'CASCADE',
          onDelete:'RESTRICT'
      }
      },
      {
      
      
      timestamps:true
      });

      module.exports=Oferta;
        
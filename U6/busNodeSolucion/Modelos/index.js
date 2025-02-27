const orm = require('sequelize');

const bd = require('../configDB/database');

const Conductor = require('./mConductor');
const Billete = require('./mBillete');
const Linea = require('./mLinea');

Conductor.hasMany(Billete,{foreignKey:'conductor_id'});
Linea.hasMany(Billete,{foreignKey:'linea_id'});
Billete.belongsTo(Conductor,{foreignKey:'conductor_id'})
Billete.belongsTo(Linea,{foreignKey:'linea_id'})

module.exports={
    bd,
    Conductor,
    Billete,
    Linea
}
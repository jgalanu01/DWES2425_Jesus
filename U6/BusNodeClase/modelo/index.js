const bd=require('../configBD/database');

//Importar los modelos
const Conductor=require('./mConductor');
const Linea=require('./mLinea');
const Billete=require('./mBillete');

//Aqui vamos a hacer las relaciones

Conductor.hasMany(Billete,{foreignKey:'conductor_id'});
Linea.hasMany(Billete,{foreignKey:'linea_id'});
Billete.belongsTo(Conductor,{foreignKey:'conductor_id'});
Billete.belongsTo(Linea,{foreignKey:'linea_id'});

module.exports={
    bd,
    Conductor,
    Linea,
    Billete
};


//De aquí nos vamos a app.js
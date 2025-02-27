const Conductor = require('../Modelos/mConductor');
const Billete = require('../Modelos/mBillete');
const Linea = require('../Modelos/mLinea');
async function store(req,res){
    try {
        if(!req.body.conductor_id || !req.body.linea_id || !req.body.tipo || !req.body.precio){
            throw 'Faltan parámetros';
        }
        const c = await Conductor.findByPk(req.body.conductor_id);
        if(!c){
            throw 'No existe conductor'; 
        }
        const l = await Linea.findByPk(req.body.linea_id);
        if(!l){
            throw 'No existe la línea'; 
        }
        const fecha = new Date();
        console.log(fecha.toISOString());
        const b = await Billete.create({conductor_id:req.body.conductor_id,
            linea_id:req.body.linea_id, fecha:fecha.toISOString().split('T')[0], 
            hora:fecha.toISOString().split('T')[1].split('.')[0],
        tipo:req.body.tipo, precio:req.body.precio},{include:[
            {model:Linea, attributes:["nombre"]},
            {model:Conductor, attributes:["nombreApe"]},
        ]});
        res.status(200).send(b);

    } catch (error) {
        res.status(500).send('Error:'+error);
    }
}

module.exports = {store};
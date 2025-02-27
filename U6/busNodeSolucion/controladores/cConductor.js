const Conductor = require('../Modelos/mConductor');
const Billete = require('../Modelos/mBillete');
const Linea = require('../Modelos/mLinea');
async function store(req,res){
    try {
        if(!req.body.nombre || !req.body.dni){
            throw 'Faltan parámetros';
        }
        const c = await Conductor.findOne({where:{dni:req.body.dni}});
        if(c){
            throw 'Ya existe conductor con ese dni'; 
        }
        const co = await Conductor.create({nombreApe:req.body.nombre,dni:req.body.dni, fechaContrato:new Date()});
        res.status(200).send(co);

    } catch (error) {
        res.status(500).send('Error:'+error);
    }
}
async function obtenerTodosBilletes(req,res){
    try {
        if(!req.params.id){
            throw 'Faltan parámetros';
        }
        //Devuelve todos los datos de billete y de línea
        //const c = await Conductor.findByPk(req.params.id,{include:{model:Billete, nested:true}});
        const c = await Conductor.findByPk(req.params.id,{
                include:{model:Billete, 
                        attributes: ['id','tipo','precio'],
                        include:[
                            {model:Linea, attributes:['nombre']},
                            {model:Conductor, attributes:['nombreApe']}]}});
        if(!c){
            throw 'No existe conductor'; 
        }
        res.status(200).send(c.Billetes);

    } catch (error) {
        res.status(500).send('Error:'+error);
    }
}
async function obtenerBilletesFecha(req,res){
    try {
        if(!req.params.id || !req.body.fecha){
            throw 'Faltan parámetros';
        }
        const c = await Conductor.findByPk(req.params.id);
        if(!c){
            throw 'No existe conductor'; 
        }
        const b = await Billete.findAll({
                attributes: ['id','tipo','precio'],
                where:{conductor_id:req.params.id,fecha:req.body.fecha},
                include:[
                    {model:Linea, attributes:['nombre']},
                    {model:Conductor, attributes:['nombreApe']}]
                
            });
        res.status(200).send(b);

    } catch (error) {
        res.status(500).send('Error:'+error);
    }
}

module.exports = {
    store,
    obtenerTodosBilletes,
    obtenerBilletesFecha
}

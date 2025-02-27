const Billete = require('../Modelos/mBillete');
const Linea = require('../Modelos/mLinea');
const bd = require('../configDB/database');

async function obtenerRecaudacion(req, res) {
    try {
        if (!req.params.id || !req.body.fecha) {
            throw 'Faltan parámetros';
        }
        const l = await Linea.findByPk(req.params.id);
        if (!l) {
            throw 'No existe la línea';
        }
        const billetes = await Billete.findAll({
            where: { linea_id: req.params.id, fecha: req.body.fecha }
        });
        let recaudacion = 0;
        billetes.forEach(b => {
            recaudacion += b.precio;
        });
        res.status(200).send({total:recaudacion});

    } catch (error) {
        res.status(500).send('Error:'+error);
    }
}
async function borrar(req, res) {
    try {
        if (!req.params.id) {
            throw 'Faltan parámetros';
        }
        const l = await Linea.findByPk(req.params.id,{include:Billete});
        if (!l) {
            throw 'No existe la línea';
        }
        if(l.Billetes.length==0){
            await Linea.destroy({ where: { id: req.params.id } });
            res.status(200).send({mensaje:'Línea borrada'});
        }
        else{
            const t = await bd.transaction(); // Iniciar la transacción
            try {
                await Billete.destroy({ where: { linea_id: req.params.id }, transaction: t });
                await Linea.destroy({ where: { id: req.params.id }, transaction: t });
                await t.commit();
                res.status(200).send({mensaje:'Línea y billetes borrados'});
            } catch (error) {
                await t.rollback(); 
                res.status(500).send('Error:'+error);
            }
            
        }
        

    } catch (error) {
        res.status(500).send('Error:'+error);
    }
}

module.exports = {
    obtenerRecaudacion,
    borrar
}
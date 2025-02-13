//Incluir modelos
const Oferta = require('../Models/oferta');
const Usuario = require('../Models/usuario');
async function index(req, res) {
    try {
        //Recuperar las ofertas y los datos del usuario que las ha creado
        const ofertas=await Oferta.findAll({include:Usuario});
        res.json(ofertas);
        
    } catch (error) {
        res.status(500).send({ textoError: error });
        
    }
   
}

async function show(req, res) {
    try {
        const oferta=await Oferta.findByPk(req.params.id,{include:Usuario});
        if(!oferta){
            throw 'Oferta no encontrada'
        }
        else{
            res.json(oferta);
        }
        
    } catch (error) {

        res.status(500).send({ textoError: error });
        
    }
   
}

async function store(req, res) {
    try {
        const {titulo,descripcion,usuario}=req.body;
        if(!titulo || !descripcion || !usuario){
            throw 'Faltan datos de la oferta';
        }
        //Comprobar que el usuario existe
        const us=await Usuario.findOne({where:{id:usuario,perfil:'tienda'}});
        if (!us){
            throw 'Tienda no existe';
        }
        else{
            const o=await Oferta.create({titulo,descripcion,usuario_id:usuario});
            res.json(o);

        }
        
    } catch (error) {
        res.status(500).send({ textoError:error });
        
    }
  
}
function update(req, res) {
    res.status(200).send('Modificar oferta');
}
function destroy(req, res) {
    res.status(200).send('Borrar oferta');
}

module.exports = {
    index,
    show,
    store,
    update, 
    destroy
}
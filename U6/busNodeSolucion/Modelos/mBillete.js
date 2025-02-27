const { DataTypes } = require('sequelize');

const bd = require('../configDB/database')

const Billete = bd.define('Billete', {
    id: {
        type: DataTypes.INTEGER,
        primaryKey: true,
        autoIncrement: true
    },
    conductor_id: {
        type: DataTypes.INTEGER,
        allowNull: false,
        references: {
            model: 'conductores',
            key: 'id',
        },
        onUpdate: 'CASCADE',
        onDelete: 'RESTRICT',
    },
    linea_id: {
        type: DataTypes.INTEGER,
        allowNull: false,
        references: {
            model: 'lineas',
            key: 'id',
        },
        onUpdate: 'CASCADE',
        onDelete: 'RESTRICT',
    },
    tipo: {
        type: DataTypes.ENUM('General', 'Reducido'),
        allowNull: false,
    },
    precio: {
        type: DataTypes.FLOAT,
        allowNull: false,
    },
    hora: {
        type: DataTypes.TIME,
        allowNull: false,
    },
    fecha: {
        type: DataTypes.DATEONLY,
        allowNull: false,
    },
}, {
    timestamps: true,
    tableName: 'billetes',
});

module.exports = Billete;
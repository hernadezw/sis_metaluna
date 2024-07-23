<?php

namespace App\Constantes;




class DataSistema
{

public static $envio = [
    ['id'=>'1','nombre'=>'Envio','valor'=>'1'],
    ['id'=>'2','nombre'=>'Sin Envio','valor'=>'0'],
];

public static $tipo_ajuste_invetario = [
    ['nombre'=>'Ingreso','valor'=>'ingreso'],
    ['nombre'=>'Egreso','valor'=>'egreso'],
];

public static $estados = [
    ['id'=>'1','super_id'=>'1','nombre'=>'Aprobado','alias'=>'COM'],
    ['id'=>'2','super_id'=>'1','nombre'=>'Rechazado','alias'=>'REC'],
    ['id'=>'3','super_id'=>'1','nombre'=>'Incompleto','alias'=>'INC'],

    ['id'=>'4','super_id'=>'2','nombre'=>'En proceso','alias'=>'PRO'],
    ['id'=>'5','super_id'=>'2','nombre'=>'Pospuesto','alias'=>'POS'],

    ['id'=>'6','super_id'=>'3','nombre'=>'Aprobado','alias'=>'APR'],
    ['id'=>'7','super_id'=>'3','nombre'=>'Rechazado','alias'=>'REC'],
];

public static $procesos = [
    ['id'=>'1','nombre'=>'Iniciado','alias'=>'INI'],
    ['id'=>'2','nombre'=>'Ejecucion','alias'=>'EJE'],
    ['id'=>'3','nombre'=>'Finalizado','alias'=>'FIN'],
];


public static $forma_pago = [
    ['id'=>'1','nombre'=>'Efectivo','valor'=>'EFECT'],
    ['id'=>'2','nombre'=>'Credito','valor'=>'CREDI'],
    ['id'=>'3','nombre'=>'Cheque','valor'=>'CHEQ'],
    ['id'=>'4','nombre'=>'Tarjeta de Credito','valor'=>'TCREDI'],
    ['id'=>'5','nombre'=>'Tarjeta de Debito','valor'=>'TDEBITO'],
    ['id'=>'6','nombre'=>'Transferencia','valor'=>'TRANSFER'],
    ['id'=>'6','nombre'=>'Deposito','valor'=>'DEPOSIT'],
];


public static $tipo_cliente = [
    ['id'=>'1','nombre'=>'MINORISTA','valor'=>'MINO'],
    ['id'=>'2','nombre'=>'MAYORISTA','valor'=>'MAYO'],
];



}

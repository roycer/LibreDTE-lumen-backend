<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //
}

//public function dte(Request $request){
//
//    $this->validate($request, [
//        'rut' => 'required',
//        'tipoDte' => 'required',
//        'details' => 'required',
//    ]);
//
//    $folios = [
//        $request->tipoDte => getFolio,
//    ];
//
//    $caratula = [
//        'RutEnvia' => '16636576-7',
//        'RutReceptor' => '60803000-K',
//        'FchResol' => '2020-09-04',
//        'NroResol' => 0,
//    ];
//
//    $Emisor = [
//        'RUTEmisor' => '77180742-9',
//        'RznSoc' => 'DONOSO GROUP SPA',
//        'GiroEmis' => 'ACTIVIDADES DE CONSULTORIA DE INFORMATICA Y DE GESTION DE INSTALACIONE',
//        'Acteco' => 620200,
//        'DirOrigen' => 'MANUEL AGUILAR 01105',
//        'CmnaOrigen' => 'PUNTA ARENAS',
//        'CiudadOrigen' => 'PUNTA ARENAS'
//    ];
//
//    $Receptor = [
//        'RUTRecep' => '76939431-1',
//        'RznSocRecep' => 'APPVENTURE SPA',
//        'GiroRecep' => 'SERVICIOS DE CONSULTORIA DE INFORMATICA',
//        'DirRecep' => 'Padre Mariano 391',
//        'CmnaRecep' => 'Providencia',
//        'CiudadRecep' => 'Santiago'
//    ];
//
//    $set_pruebas = [
//
//        // CASO 33 - 1
//        [
//            'Encabezado' => [
//                'IdDoc' => [
//                    'TipoDTE' => 33,
//                    'Folio' => $folios[33],
//                    'FmaPago' => 2,
//                ],
//                'Emisor' => $Emisor,
//                'Receptor' => [
//                    'RUTRecep' => '77343610-K',
//                    'RznSocRecep' => 'CONDOR TRAVEL S.A.',
//                    'GiroRecep' => 'AGENCIA DE VIAJES',
//                    'Contacto' => 'asistente-gerencia@condortravel.com',
//                    'CorreoRecep' => 'asistente-gerencia@condortravel.com',
//                    'DirRecep' => 'SANTA BEATRIZ 100 OF 305',
//                    'CmnaRecep' => 'PROVIDENCIA',
//                    'CiudadRecep' => 'SANTIAGO'
//                ],
//            ],
//            'Detalle' => [
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT1',
//                        'VlrCodigo' => 3
//                    ],
//                    'NmbItem' => 'Outdoors',
//                    'QtyItem' => 1,
//                    'PrcItem' => 134452,
//                    'MontoItem' => 134452,
//                ],
//            ],
//        ],
//        // CASO 33 - 2
//        [
//            'Encabezado' => [
//                'IdDoc' => [
//                    'TipoDTE' => 33,
//                    'Folio' => $folios[33]+1,
//                    'TpoImpresion' => 'N',
//                    'FmaPago' => 2,
//                ],
//                'Emisor' => $Emisor,
//                'Receptor' => [
//                    'RUTRecep' => '76820687-2',
//                    'RznSocRecep' => 'INVERSIONES CALADOC SPA',
//                    'GiroRecep' => 'RESTAURANT',
//                    'CorreoRecep' => 'JBENALDO@LACABRERACHILE.CL',
//                    'DirRecep' => 'ALONSO DE CORDOVA 4263',
//                    'CmnaRecep' => 'VITACURA',
//                    'CiudadRecep' => 'SANTIAGO'
//                ],
//            ],
//            'Detalle' => [
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT',
//                        'VlrCodigo' => 0
//                    ],
//                    'NmbItem' => 'Papas Fritas Crudas',
//                    'QtyItem' => 550,
//                    'UnmdItem' => 'Kg',
//                    'PrcItem' => 650,
//                    'MontoItem' => 357500,
//                ],
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT',
//                        'VlrCodigo' => 1
//                    ],
//                    'NmbItem' => 'Mollejas',
//                    'QtyItem' => 40.7,
//                    'UnmdItem' => 'Kg',
//                    'PrcItem' => 4202,
//                    'MontoItem' => 171021,
//                ],
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT',
//                        'VlrCodigo' => 2
//                    ],
//                    'NmbItem' => 'Palta Hass',
//                    'QtyItem' => 67.8,
//                    'UnmdItem' => 'Kg',
//                    'PrcItem' => 3590,
//                    'MontoItem' => 243402,
//                ],
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT',
//                        'VlrCodigo' => 3
//                    ],
//                    'NmbItem' => 'Pollo Ganso',
//                    'QtyItem' => 66,
//                    'UnmdItem' => 'Kg',
//                    'PrcItem' => 4898,
//                    'MontoItem' => 323268,
//                ],
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT',
//                        'VlrCodigo' => 4
//                    ],
//                    'NmbItem' => 'Pollo Entero',
//                    'QtyItem' => 102.3,
//                    'UnmdItem' => 'Kg',
//                    'PrcItem' => 2150,
//                    'MontoItem' => 219945,
//                ],
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT',
//                        'VlrCodigo' => 5
//                    ],
//                    'NmbItem' => 'Punta De Ganso',
//                    'QtyItem' => 41.95,
//                    'UnmdItem' => 'Kg',
//                    'PrcItem' => 5590,
//                    'MontoItem' => 234501,
//                ],
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT',
//                        'VlrCodigo' => 6
//                    ],
//                    'NmbItem' => 'Queso Provoleta',
//                    'QtyItem' => 21.5,
//                    'UnmdItem' => 'Kg',
//                    'PrcItem' => 7950,
//                    'MontoItem' => 170925,
//                ],
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT',
//                        'VlrCodigo' => 7
//                    ],
//                    'NmbItem' => 'Aceite Frito Master',
//                    'QtyItem' => 170,
//                    'UnmdItem' => 'Kg',
//                    'PrcItem' => 1360,
//                    'MontoItem' => 231200,
//                ],
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT',
//                        'VlrCodigo' => 8
//                    ],
//                    'NmbItem' => 'mix Lechugas tomate rucula verduras',
//                    'QtyItem' => 1,
//                    'UnmdItem' => 'Kg',
//                    'PrcItem' => 1509778,
//                    'MontoItem' => 1509778,
//                ],
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT',
//                        'VlrCodigo' => 9
//                    ],
//                    'NmbItem' => 'Tapabariga Centro Torobayo',
//                    'QtyItem' => 16.4,
//                    'UnmdItem' => 'Kg',
//                    'PrcItem' => 6498,
//                    'MontoItem' => 106567,
//                ],
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT',
//                        'VlrCodigo' => 10
//                    ],
//                    'NmbItem' => 'Masa Empanada',
//                    'QtyItem' => 1650,
//                    'UnmdItem' => 'Kg',
//                    'PrcItem' => 59,
//                    'MontoItem' => 97350,
//                ],
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT',
//                        'VlrCodigo' => 11
//                    ],
//                    'NmbItem' => 'Huevos',
//                    'QtyItem' => 180,
//                    'UnmdItem' => 'Unid',
//                    'PrcItem' => 131,
//                    'MontoItem' => 23580,
//                ],
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT',
//                        'VlrCodigo' => 12
//                    ],
//                    'NmbItem' => 'Servicio Logisticos Agosto',
//                    'QtyItem' => 1,
//                    'UnmdItem' => 'Unid',
//                    'PrcItem' => 783877,
//                    'MontoItem' => 783877,
//                ],
//            ],
//        ],
//        // CASO 33 - 3
//        [
//            'Encabezado' => [
//                'IdDoc' => [
//                    'TipoDTE' => 33,
//                    'Folio' => $folios[33]+2,
//                    'FmaPago' => 2,
//                ],
//                'Emisor' => $Emisor,
//                'Receptor' => [
//                    'RUTRecep' => '77011791-7',
//                    'RznSocRecep' => 'SOUTHBOUND S.A.',
//                    'GiroRecep' => 'OPERADOR TURISTICO',
//                    'Contacto' => 'facturas@southbound.travel',
//                    'CorreoRecep' => 'facturas@southbound.travel',
//                    'DirRecep' => 'IMPERIAL 0655',
//                    'CmnaRecep' => 'PUERTO VARAS',
//                    'CiudadRecep' => 'PUERTO VARAS'
//                ],
//            ],
//            'Detalle' => [
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT1',
//                        'VlrCodigo' => 3
//                    ],
//                    'NmbItem' => 'Outdoors',
//                    'QtyItem' => 1,
//                    'PrcItem' => 168065,
//                    'MontoItem' => 168065,
//                ],
//            ],
//            'Referencia' => [
//                'TpoDocRef' => '801',
//                'FolioRef' => 'BKFI107160',
//                'FchRef' => '2019-12-28',
//                'RazonRef' => 'OC BKFI107160 Centro de Costo: 1',
//            ],
//        ],
//        // CASO 33 - 4
//        [
//            'Encabezado' => [
//                'IdDoc' => [
//                    'TipoDTE' => 33,
//                    'Folio' => $folios[33]+3,
//                    'FmaPago' => 2,
//                ],
//                'Emisor' => $Emisor,
//                'Receptor' => [
//                    'RUTRecep' => '96510510-7',
//                    'RznSocRecep' => 'NAVIERA Y TURISMO SKORPIOS S A',
//                    'GiroRecep' => 'TRANSPORTE DE PASAJEROS POR VIAS DE NAVE',
//                    'Contacto' => 'jvenegas@skorpios.cl',
//                    'CorreoRecep' => 'jvenegas@skorpios.cl',
//                    'DirRecep' => 'ANGELMO 1660',
//                    'CmnaRecep' => 'PUERTO MONTT',
//                    'CiudadRecep' => 'PUERTO MONTT'
//                ],
//            ],
//            'Detalle' => [
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT1',
//                        'VlrCodigo' => 2
//                    ],
//                    'NmbItem' => 'Restaurant',
//                    'QtyItem' => 1,
//                    'PrcItem' => 85660,
//                    'MontoItem' => 85660,
//                ],
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT1',
//                        'VlrCodigo' => 5
//                    ],
//                    'IndExe' => 1,
//                    'NmbItem' => 'Propinas - Tips',
//                    'QtyItem' => 1,
//                    'PrcItem' => 4000,
//                    'MontoItem' => 4000,
//                ],
//            ],
//        ],
//
//        // CASO 34 - 1
//        [
//            'Encabezado' => [
//                'IdDoc' => [
//                    'TipoDTE' => 34,
//                    'Folio' => $folios[34],
//                    'FmaPago' => 1,
//                ],
//                'Emisor' => $Emisor,
//                'Receptor' => [
//                    'RUTRecep' => '77625190-9',
//                    'RznSocRecep' => 'SAT DE CHILE AGENCIA DE VIAJES S.A.',
//                    'GiroRecep' => 'AGENCIA DE VIAJES',
//                    'Contacto' => 'recepcion-chile@southamericantours.com',
//                    'CorreoRecep' => 'recepcion-chile@southamericantours.com',
//                    'DirRecep' => 'PADRE MARIANO #82, OF. 803',
//                    'CmnaRecep' => 'PROVIDENCIA',
//                    'CiudadRecep' => 'SANTIAGO'
//                ],
//            ],
//            'Detalle' => [
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT1',
//                        'VlrCodigo' => 18
//                    ],
//                    'IndExe' => 1,
//                    'NmbItem' => 'Alojamiento Penalizacion',
//                    'QtyItem' => 1,
//                    'PrcItem' => 2291189,
//                    'MontoItem' => 2291189,
//                ],
//            ],
//        ],
//
//        // CASO 61 - 1
//
//        // CASO 61 - 2
//        [
//            'Encabezado' => [
//                'IdDoc' => [
//                    'TipoDTE' => 61,
//                    'Folio' => $folios[61]+1,
//                    'FmaPago' => 2,
//                ],
//                'Emisor' => $Emisor,
//                'Receptor' => [
//                    'RUTRecep' => '77343610-K',
//                    'RznSocRecep' => 'CONDOR TRAVEL S.A.',
//                    'GiroRecep' => 'AGENCIA DE VIAJES',
//                    'Contacto' => 'asistente-gerencia@condortravel.com',
//                    'CorreoRecep' => 'asistente-gerencia@condortravel.com',
//                    'DirRecep' => 'SANTA BEATRIZ 100 OF 305',
//                    'CmnaRecep' => 'PROVIDENCIA',
//                    'CiudadRecep' => 'SANTIAGO'
//                ],
//            ],
//            'Detalle' => [
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT1',
//                        'VlrCodigo' => 3
//                    ],
//                    'NmbItem' => 'Outdoors',
//                    'QtyItem' => 1,
//                    'PrcItem' => 134452,
//                    'MontoItem' => 134452,
//                ],
//            ],
//            'Referencia' => [
//                [
//                    'TpoDocRef' => '33',
//                    'FolioRef' => 50,
//                    'FchRef' => '2020-10-08',
//                    'CodRef' => 1,
//                    'RazonRef' => 'Anula DTE',
//                ],
//            ]
//        ],
//        // CASO 61 - 3
//        [
//            'Encabezado' => [
//                'IdDoc' => [
//                    'TipoDTE' => 61,
//                    'Folio' => $folios[61]+2,
//                    'FmaPago' => 2,
//                ],
//                'Emisor' => $Emisor,
//                'Receptor' => [
//                    'RUTRecep' => '96510510-7',
//                    'RznSocRecep' => 'NAVIERA Y TURISMO SKORPIOS S A',
//                    'GiroRecep' => 'TRANSPORTE DE PASAJEROS POR VIAS DE NAVE',
//                    'Contacto' => 'jvenegas@skorpios.cl',
//                    'CorreoRecep' => 'jvenegas@skorpios.cl',
//                    'DirRecep' => 'ANGELMO 1660',
//                    'CmnaRecep' => 'PUERTO MONTT',
//                    'CiudadRecep' => 'PUERTO MONTT'
//                ],
//            ],
//            'Detalle' => [
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT1',
//                        'VlrCodigo' => 2
//                    ],
//                    'NmbItem' => 'Restaurant',
//                    'QtyItem' => 1,
//                    'PrcItem' => 85660,
//                    'MontoItem' => 85660,
//                ],
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT1',
//                        'VlrCodigo' => 5
//                    ],
//                    'IndExe' => 1,
//                    'NmbItem' => 'Propinas - Tips',
//                    'QtyItem' => 1,
//                    'PrcItem' => 4000,
//                    'MontoItem' => 4000,
//                ],
//            ],
//            'Referencia' => [
//                [
//                    'TpoDocRef' => '33',
//                    'FolioRef' => 53,
//                    'FchRef' => '2020-10-08',
//                    'CodRef' => 1,
//                    'RazonRef' => 'Anula DTE',
//                ],
//            ]
//        ],
//        // CASO 61 - 4
//        [
//            'Encabezado' => [
//                'IdDoc' => [
//                    'TipoDTE' => 61,
//                    'Folio' => $folios[61]+3,
//                    'FmaPago' => 1,
//                ],
//                'Emisor' => $Emisor,
//                'Receptor' => [
//                    'RUTRecep' => '77625190-9',
//                    'RznSocRecep' => 'SAT DE CHILE AGENCIA DE VIAJES S.A.',
//                    'GiroRecep' => 'AGENCIA DE VIAJES',
//                    'Contacto' => 'recepcion-chile@southamericantours.com',
//                    'CorreoRecep' => 'recepcion-chile@southamericantours.com',
//                    'DirRecep' => 'PADRE MARIANO #82, OF. 803',
//                    'CmnaRecep' => 'PROVIDENCIA',
//                    'CiudadRecep' => 'SANTIAGO'
//                ],
//            ],
//            'Detalle' => [
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT1',
//                        'VlrCodigo' => 18
//                    ],
//                    'IndExe' => 1,
//                    'NmbItem' => 'Alojamiento Penalizacion',
//                    'QtyItem' => 1,
//                    'PrcItem' => 2291189,
//                    'MontoItem' => 2291189,
//                ],
//            ],
//            'Referencia' => [
//                [
//                    'TpoDocRef' => '34',
//                    'FolioRef' => 50,
//                    'FchRef' => '2020-10-08',
//                    'CodRef' => 1,
//                    'RazonRef' => 'Anula DTE',
//                ],
//            ]
//        ],
//        // CASO 61 - 5
//        [
//            'Encabezado' => [
//                'IdDoc' => [
//                    'TipoDTE' => 61,
//                    'Folio' => $folios[61]+4,
//                    'TpoImpresion' => 'N',
//                    'FmaPago' => 2,
//                ],
//                'Emisor' => $Emisor,
//                'Receptor' => [
//                    'RUTRecep' => '76820687-2',
//                    'RznSocRecep' => 'INVERSIONES CALADOC SPA',
//                    'GiroRecep' => 'RESTAURANT',
//                    'CorreoRecep' => 'JBENALDO@LACABRERACHILE.CL',
//                    'DirRecep' => 'ALONSO DE CORDOVA 4263',
//                    'CmnaRecep' => 'VITACURA',
//                    'CiudadRecep' => 'SANTIAGO'
//                ],
//            ],
//            'Detalle' => [
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT',
//                        'VlrCodigo' => 0
//                    ],
//                    'NmbItem' => 'Papas Fritas Crudas',
//                    'QtyItem' => 550,
//                    'UnmdItem' => 'Kg',
//                    'PrcItem' => 650,
//                    'MontoItem' => 357500,
//                ],
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT',
//                        'VlrCodigo' => 1
//                    ],
//                    'NmbItem' => 'Mollejas',
//                    'QtyItem' => 40.7,
//                    'UnmdItem' => 'Kg',
//                    'PrcItem' => 4202,
//                    'MontoItem' => 171021,
//                ],
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT',
//                        'VlrCodigo' => 2
//                    ],
//                    'NmbItem' => 'Palta Hass',
//                    'QtyItem' => 67.8,
//                    'UnmdItem' => 'Kg',
//                    'PrcItem' => 3590,
//                    'MontoItem' => 243402,
//                ],
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT',
//                        'VlrCodigo' => 3
//                    ],
//                    'NmbItem' => 'Pollo Ganso',
//                    'QtyItem' => 66,
//                    'UnmdItem' => 'Kg',
//                    'PrcItem' => 4898,
//                    'MontoItem' => 323268,
//                ],
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT',
//                        'VlrCodigo' => 4
//                    ],
//                    'NmbItem' => 'Pollo Entero',
//                    'QtyItem' => 102.3,
//                    'UnmdItem' => 'Kg',
//                    'PrcItem' => 2150,
//                    'MontoItem' => 219945,
//                ],
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT',
//                        'VlrCodigo' => 5
//                    ],
//                    'NmbItem' => 'Punta De Ganso',
//                    'QtyItem' => 41.95,
//                    'UnmdItem' => 'Kg',
//                    'PrcItem' => 5590,
//                    'MontoItem' => 234501,
//                ],
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT',
//                        'VlrCodigo' => 6
//                    ],
//                    'NmbItem' => 'Queso Provoleta',
//                    'QtyItem' => 21.5,
//                    'UnmdItem' => 'Kg',
//                    'PrcItem' => 7950,
//                    'MontoItem' => 170925,
//                ],
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT',
//                        'VlrCodigo' => 7
//                    ],
//                    'NmbItem' => 'Aceite Frito Master',
//                    'QtyItem' => 170,
//                    'UnmdItem' => 'Kg',
//                    'PrcItem' => 1360,
//                    'MontoItem' => 231200,
//                ],
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT',
//                        'VlrCodigo' => 8
//                    ],
//                    'NmbItem' => 'mix Lechugas tomate rucula verduras',
//                    'QtyItem' => 1,
//                    'UnmdItem' => 'Kg',
//                    'PrcItem' => 1509778,
//                    'MontoItem' => 1509778,
//                ],
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT',
//                        'VlrCodigo' => 9
//                    ],
//                    'NmbItem' => 'Tapabariga Centro Torobayo',
//                    'QtyItem' => 16.4,
//                    'UnmdItem' => 'Kg',
//                    'PrcItem' => 6498,
//                    'MontoItem' => 106567,
//                ],
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT',
//                        'VlrCodigo' => 10
//                    ],
//                    'NmbItem' => 'Masa Empanada',
//                    'QtyItem' => 1650,
//                    'UnmdItem' => 'Kg',
//                    'PrcItem' => 59,
//                    'MontoItem' => 97350,
//                ],
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT',
//                        'VlrCodigo' => 11
//                    ],
//                    'NmbItem' => 'Huevos',
//                    'QtyItem' => 180,
//                    'UnmdItem' => 'Unid',
//                    'PrcItem' => 131,
//                    'MontoItem' => 23580,
//                ],
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT',
//                        'VlrCodigo' => 12
//                    ],
//                    'NmbItem' => 'Servicio Logisticos Agosto',
//                    'QtyItem' => 1,
//                    'UnmdItem' => 'Unid',
//                    'PrcItem' => 783877,
//                    'MontoItem' => 783877,
//                ],
//            ],
//            'Referencia' => [
//                [
//                    'TpoDocRef' => '33',
//                    'FolioRef' => 51,
//                    'FchRef' => '2020-10-08',
//                    'CodRef' => 1,
//                    'RazonRef' => 'Anula DTE',
//                ],
//            ]
//        ],
//        // CASO 56 - 1
//        [
//            'Encabezado' => [
//                'IdDoc' => [
//                    'TipoDTE' => 56,
//                    'Folio' => $folios[56],
//                    'FmaPago' => 2,
//                ],
//                'Emisor' => $Emisor,
//                'Receptor' => [
//                    'RUTRecep' => '77343610-K',
//                    'RznSocRecep' => 'CONDOR TRAVEL S.A.',
//                    'GiroRecep' => 'AGENCIA DE VIAJES',
//                    'Contacto' => 'asistente-gerencia@condortravel.com',
//                    'CorreoRecep' => 'asistente-gerencia@condortravel.com',
//                    'DirRecep' => 'SANTA BEATRIZ 100 OF 305',
//                    'CmnaRecep' => 'PROVIDENCIA',
//                    'CiudadRecep' => 'SANTIAGO'
//                ],
//            ],
//            'Detalle' => [
//                [
//                    'CdgItem' => [
//                        'TpoCodigo' => 'INT1',
//                        'VlrCodigo' => 3
//                    ],
//                    'IndExe' => 1,
//                    'NmbItem' => 'Outdoors',
//                    'QtyItem' => 1,
//                    'PrcItem' => 134452,
//                    'MontoItem' => 134452,
//                ],
//            ],
//            'Referencia' => [
//                [
//                    'TpoDocRef' => '61',
//                    'FolioRef' => 51,
//                    'FchRef' => '2020-10-08',
//                    'CodRef' => 1,
//                    'RazonRef' => 'Anula DTE',
//                ],
//            ]
//        ],
//    ];
//
//    $Firma = new \sasco\LibreDTE\FirmaElectronica($this->fconfig);
//
//    $Folios = [];
//
//    foreach ($folios as $tipo => $cantidad){
//        $Folios[$tipo] = new Sii\Folios(file_get_contents(resource_path('FoliosSII_'.$tipo.'.xml')));
//    }
//
//    $EnvioDTE = new Sii\EnvioDte();
//
//    foreach ($set_pruebas as $documento) {
//
//        $DTE = new Sii\Dte($documento);
//
//        if (!$DTE->timbrar($Folios[$DTE->getTipo()]))
//            break;
//        if (!$DTE->firmar($Firma))
//            break;
//
//        $EnvioDTE->agregar($DTE);
//
//    }
//
//    $EnvioDTE->setCaratula($caratula);
//    $EnvioDTE->setFirma($Firma);
//
//    file_put_contents(resource_path('envio_dte.xml'), $EnvioDTE->generar()); // guardar XML en sistema de archivos
//
////        if($track_id = $EnvioDTE->enviar()){
////
////            return var_dump($track_id);
////
////        }
//
//    foreach (\sasco\LibreDTE\Log::readAll() as $error)
//        Log::info($error);
//
//    return 'fail';
//}
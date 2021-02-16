<?php namespace App\Http\Controllers;

use Illuminate\Support\Facades\Date;
use sasco\LibreDTE\FirmaElectronica;
use sasco\LibreDTE\Sii;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CertificacionController extends Controller

{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $fconfig;

    public function __construct()
    {
//        $this->middleware('auth');
        $this->fconfig = ['file'=>resource_path('CertificadoFrenon2020.pfx'), 'pass'=>'Frenon2020'];
        \sasco\LibreDTE\Sii::setServidor('maullin');
        \sasco\LibreDTE\Sii::setAmbiente(\sasco\LibreDTE\Sii::CERTIFICACION);
        date_default_timezone_set('America/Santiago');
    }

    public function invoice(Request $request){

        $this->validate($request, [
            'test' => 'required | boolean',
        ]);

        $folios = [
            33 => 78,
            34 => 9,
            61 => 55,
            56 => 7
        ];

        $caratula = [
            'RutEnvia' => '16636576-7',
            'RutReceptor' => '60803000-K',
            'FchResol' => '2020-09-04',
            'NroResol' => 0,
        ];

        $Emisor = [
            'RUTEmisor' => '77180742-9',
            'RznSoc' => 'DONOSO GROUP SPA',
            'GiroEmis' => 'ACTIVIDADES DE CONSULTORIA DE INFORMATICA Y DE GESTION DE INSTALACIONE',
            'Acteco' => 620200,
            'DirOrigen' => 'MANUEL AGUILAR 01105',
            'CmnaOrigen' => 'PUNTA ARENAS',
            'CiudadOrigen' => 'PUNTA ARENAS'
        ];

        $Receptor = [
            'RUTRecep' => '76939431-1',
            'RznSocRecep' => 'APPVENTURE SPA',
            'GiroRecep' => 'SERVICIOS DE CONSULTORIA DE INFORMATICA',
            'DirRecep' => 'Padre Mariano 391',
            'CmnaRecep' => 'Providencia',
            'CiudadRecep' => 'Santiago',
        ];

        try {

            $dtes_etapa_1_v1 = [
                // CASO 33 1 - Factura electronica
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 33,
                            'Folio' => $folios[33],
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => $Receptor,
                    ],
                    'Detalle' => [
                        [
                            'NmbItem' => 'Cajón AFECTO',
                            'QtyItem' => 177,
                            'PrcItem' => 3994,
                            'MontoItem' => 706938,
                        ],
                        [
                            'NmbItem' => 'Relleno AFECTO',
                            'QtyItem' => 74,
                            'PrcItem' => 6665,
                            'MontoItem' => 493210,
                        ],
                    ],
                    'Referencia' => [
                        'TpoDocRef' => 'SET',
                        'FolioRef' => 0,
                        'RazonRef' => 'CASO 1580572-1',
                    ],
                ],
                // CASO 33 2 - Factura electronica
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 33,
                            'Folio' => $folios[33]+1,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => $Receptor,
                    ],
                    'Detalle' => [
                        [
                            'NmbItem' => 'Pañuelo AFECTO',
                            'QtyItem' => 862,
                            'PrcItem' => 6650,
                            'DescuentoPct' => 11,
                            'DescuentoMonto' => 630553,
                            'MontoItem' => 5101747,
                        ],
                        [
                            'NmbItem' => 'ITEM 2 AFECTO',
                            'QtyItem' => 810,
                            'PrcItem' => 5698,
                            'DescuentoPct' => 26,
                            'DescuentoMonto' => 1199999,
                            'MontoItem' => 3415381,
                        ],
                    ],
                    'Referencia' => [
                        'TpoDocRef' => 'SET',
                        'FolioRef' => 0,
                        'RazonRef' => 'CASO 1580572-2',
                    ],
                ],
                // CASO 33 3 - Factura electronica
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 33,
                            'Folio' => $folios[33]+2,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => $Receptor,
                    ],
                    'Detalle' => [
                        [
                            'NmbItem' => 'Pintura B&W AFECTO',
                            'QtyItem' => 77,
                            'PrcItem' => 7719,
                            'MontoItem' => 594363,
                        ],
                        [
                            'NmbItem' => 'ITEM 2 AFECTO',
                            'QtyItem' => 254,
                            'PrcItem' => 4290,
                            'MontoItem' => 1089660,
                        ],
                        [
                            'IndExe' => 1,
                            'NmbItem' => 'ITEM 3 SERVICIO EXENTO',
                            'QtyItem' => 1,
                            'PrcItem' => 35407,
                            'MontoItem' => 35407,
                        ],
                    ],
                    'Referencia' => [
                        'TpoDocRef' => 'SET',
                        'FolioRef' => 0,
                        'RazonRef' => 'CASO 1580572-3',
                    ],
                ],
                // CASO 33 4 - Factura electronica
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 33,
                            'Folio' => $folios[33]+3,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => $Receptor,
                    ],
                    'Detalle' => [
                        [
                            'NmbItem' => 'ITEM 1 AFECTO',
                            'QtyItem' => 479,
                            'PrcItem' => 6753,
                            'MontoItem' => 3234687,
                        ],
                        [
                            'NmbItem' => 'ITEM 2 AFECTO',
                            'QtyItem' => 203,
                            'PrcItem' => 8343,
                            'MontoItem' => 1693629,
                        ],
                        [
                            'IndExe' => 1,
                            'NmbItem' => 'ITEM 3 SERVICIO EXENTO',
                            'QtyItem' => 2,
                            'PrcItem' => 6846,
                            'MontoItem' => 13692,
                        ],
                    ],
                    'DscRcgGlobal' => [
                        [
                            'TpoMov' => 'D',
                            'TpoValor' => '%',
                            'ValorDR' => 25,
                        ],
                    ],
                    'Referencia' => [
                        'TpoDocRef' => 'SET',
                        'FolioRef' => 0,
                        'RazonRef' => 'CASO 1580572-4',
                    ],
                ],
                // CASO 61 1 - Nota de credito electronica
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 61,
                            'Folio' => $folios[61],
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => $Receptor,
                    ],
                    'Detalle' => [
                        [
                            'NmbItem' => 'CORRIGE GIRO DEL RECEPTOR',
                            'DscItem' => 'Donde dice SERVICIOS DE CONSULTORIA DE INFORMATICA debe decir ACTIVIDADES DE CONSULTORIA DE INFORMATICA',
                            'MontoItem' => 0,
                        ],
                    ],
                    'Referencia' => [
                        [
                            'TpoDocRef' => 'SET',
                            'FolioRef' => 0,
                            'RazonRef' => 'CASO 1580572-5',
                        ],
                        [
                            'TpoDocRef' => 33,
                            'FolioRef' => $folios[33],
                            'CodRef' => 2,
                            'RazonRef' => 'CORRIGE GIRO DEL RECEPTOR',
                        ],
                    ]
                ],
                // CASO 61 2 - Nota de credito electronica
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 61,
                            'Folio' => $folios[61]+1,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => $Receptor,
                    ],
                    'Detalle' => [
                        [
                            'NmbItem' => 'Pañuelo AFECTO',
                            'QtyItem' => 316,
                            'PrcItem' => 6650,
                            'DescuentoPct' => 11,
                            'DescuentoMonto' => 231154,
                            'MontoItem' => 1870246,
                        ],
                        [
                            'NmbItem' => 'ITEM 2 AFECTO',
                            'QtyItem' => 549,
                            'PrcItem' => 5698,
                            'DescuentoPct' => 26,
                            'DescuentoMonto' => 813333,
                            'MontoItem' => 2314869,
                        ],
                    ],
                    'Referencia' => [
                        [
                            'TpoDocRef' => 'SET',
                            'FolioRef' => 0,
                            'RazonRef' => 'CASO 1580572-6',
                        ],
                        [
                            'TpoDocRef' => 33,
                            'FolioRef' => $folios[33]+1,
                            'CodRef' => 3,
                            'RazonRef' => 'DEVOLUCION DE MERCADERIAS',
                        ],
                    ]
                ],
                // CASO 61 3 - Nota de credito electronica
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 61,
                            'Folio' => $folios[61]+2,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => $Receptor,
                    ],
                    'Detalle' => [
                        [
                            'NmbItem' => 'Pintura B&W AFECTO',
                            'QtyItem' => 77,
                            'PrcItem' => 7719,
                            'MontoItem' => 594363,
                        ],
                        [
                            'NmbItem' => 'ITEM 2 AFECTO',
                            'QtyItem' => 254,
                            'PrcItem' => 4290,
                            'MontoItem' => 1089660,
                        ],
                        [
                            'IndExe' => 1,
                            'NmbItem' => 'ITEM 3 SERVICIO EXENTO',
                            'QtyItem' => 1,
                            'PrcItem' => 35407,
                            'MontoItem' => 35407,
                        ],
                    ],
                    'Referencia' => [
                        [
                            'TpoDocRef' => 'SET',
                            'FolioRef' => 0,
                            'RazonRef' => 'CASO 1580572-7',
                        ],
                        [
                            'TpoDocRef' => 33,
                            'FolioRef' => $folios[33]+2,
                            'CodRef' => 1,
                            'RazonRef' => 'ANULA FACTURA',
                        ],
                    ]
                ],
                // CASO 56 1 - Nota de debito Anula Nota de credito basica
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 56,
                            'Folio' => $folios[56],
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => $Receptor,
                    ],
                    'Detalle' => [
                        [
                            'NmbItem' => 'ANULA NOTA DE CREDITO',
                            'MontoItem' => 0,
                        ],
                    ],
                    'Referencia' => [
                        [
                            'TpoDocRef' => 'SET',
                            'FolioRef' => 0,
                            'RazonRef' => 'CASO 1580572-8',
                        ],
                        [
                            'TpoDocRef' => 61,
                            'FolioRef' => $folios[33],
                            'CodRef' => 1,
                            'RazonRef' => 'ANULA NOTA DE CREDITO ELECTRONICA',
                        ],
                    ]
                ],
            ];

            $dtes_etapa_1_v2 = [
                // CASO 33 1 - Factura electronica
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 33,
                            'Folio' => $folios[33],
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => $Receptor,
                    ],
                    'Detalle' => [
                        [
                            'NmbItem' => 'Cajón AFECTO',
                            'QtyItem' => 177,
                            'PrcItem' => 3994,
                            'MontoItem' => 706938,
                        ],
                        [
                            'NmbItem' => 'Relleno AFECTO',
                            'QtyItem' => 74,
                            'PrcItem' => 6665,
                            'MontoItem' => 493210,
                        ],
                    ],
                    'Referencia' => [
                        'TpoDocRef' => 'SET',
                        'FolioRef' => 0,
                        'RazonRef' => 'CASO 1580572-1',
                    ],
                ],
                // CASO 33 2 - Factura electronica
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 33,
                            'Folio' => $folios[33]+1,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => $Receptor,
                    ],
                    'Detalle' => [
                        [
                            'NmbItem' => 'Pañuelo AFECTO',
                            'QtyItem' => 862,
                            'PrcItem' => 6650,
                            'DescuentoPct' => 11,
                            'DescuentoMonto' => 630553,
                            'MontoItem' => 5101747,
                        ],
                        [
                            'NmbItem' => 'ITEM 2 AFECTO',
                            'QtyItem' => 810,
                            'PrcItem' => 5698,
                            'DescuentoPct' => 26,
                            'DescuentoMonto' => 1199999,
                            'MontoItem' => 3415381,
                        ],
                    ],
                    'Referencia' => [
                        'TpoDocRef' => 'SET',
                        'FolioRef' => 0,
                        'RazonRef' => 'CASO 1580572-2',
                    ],
                ],
                // CASO 33 3 - Factura electronica
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 33,
                            'Folio' => $folios[33]+2,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => $Receptor,
                    ],
                    'Detalle' => [
                        [
                            'NmbItem' => 'Pintura B&W AFECTO',
                            'QtyItem' => 77,
                            'PrcItem' => 7719,
                            'MontoItem' => 594363,
                        ],
                        [
                            'NmbItem' => 'ITEM 2 AFECTO',
                            'QtyItem' => 254,
                            'PrcItem' => 4290,
                            'MontoItem' => 1089660,
                        ],
                        [
                            'IndExe' => 1,
                            'NmbItem' => 'ITEM 3 SERVICIO EXENTO',
                            'QtyItem' => 1,
                            'PrcItem' => 35407,
                            'MontoItem' => 35407,
                        ],
                    ],
                    'Referencia' => [
                        'TpoDocRef' => 'SET',
                        'FolioRef' => 0,
                        'RazonRef' => 'CASO 1580572-3',
                    ],
                ],
                // CASO 33 4 - Factura electronica
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 33,
                            'Folio' => $folios[33]+3,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => $Receptor,
                    ],
                    'Detalle' => [
                        [
                            'NmbItem' => 'ITEM 1 AFECTO',
                            'QtyItem' => 479,
                            'PrcItem' => 6753,
                            'MontoItem' => 3234687,
                        ],
                        [
                            'NmbItem' => 'ITEM 2 AFECTO',
                            'QtyItem' => 203,
                            'PrcItem' => 8343,
                            'MontoItem' => 1693629,
                        ],
                        [
                            'IndExe' => 1,
                            'NmbItem' => 'ITEM 3 SERVICIO EXENTO',
                            'QtyItem' => 2,
                            'PrcItem' => 6846,
                            'MontoItem' => 13692,
                        ],
                    ],
                    'DscRcgGlobal' => [
                        [
                            'TpoMov' => 'D',
                            'TpoValor' => '%',
                            'ValorDR' => 25,
                        ],
                    ],
                    'Referencia' => [
                        'TpoDocRef' => 'SET',
                        'FolioRef' => 0,
                        'RazonRef' => 'CASO 1580572-4',
                    ],
                ],
                // CASO 61 1 - Nota de credito electronica
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 61,
                            'Folio' => $folios[61],
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => $Receptor,
                    ],
                    'Detalle' => [
                        [
                            'NmbItem' => 'CORRIGE GIRO DEL RECEPTOR',
                            'DscItem' => 'Donde dice SERVICIOS DE CONSULTORIA DE INFORMATICA debe decir ACTIVIDADES DE CONSULTORIA DE INFORMATICA',
                            'MontoItem' => 0,
                        ],
                    ],
                    'Referencia' => [
                        [
                            'TpoDocRef' => 'SET',
                            'FolioRef' => 0,
                            'RazonRef' => 'CASO 1580572-5',
                        ],
                        [
                            'TpoDocRef' => 33,
                            'FolioRef' => $folios[33],
                            'CodRef' => 2,
                            'RazonRef' => 'CORRIGE GIRO DEL RECEPTOR',
                        ],
                    ]
                ],
                // CASO 61 2 - Nota de credito electronica
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 61,
                            'Folio' => $folios[61]+1,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => $Receptor,
                    ],
                    'Detalle' => [
                        [
                            'NmbItem' => 'Pañuelo AFECTO',
                            'QtyItem' => 316,
                            'PrcItem' => 6650,
                            'DescuentoPct' => 11,
                            'DescuentoMonto' => 231154,
                            'MontoItem' => 1870246,
                        ],
                        [
                            'NmbItem' => 'ITEM 2 AFECTO',
                            'QtyItem' => 549,
                            'PrcItem' => 5698,
                            'DescuentoPct' => 26,
                            'DescuentoMonto' => 813333,
                            'MontoItem' => 2314869,
                        ],
                    ],
                    'Referencia' => [
                        [
                            'TpoDocRef' => 'SET',
                            'FolioRef' => 0,
                            'RazonRef' => 'CASO 1580572-6',
                        ],
                        [
                            'TpoDocRef' => 33,
                            'FolioRef' => $folios[33]+1,
                            'CodRef' => 3,
                            'RazonRef' => 'DEVOLUCION DE MERCADERIAS',
                        ],
                    ]
                ],
                // CASO 61 3 - Nota de credito electronica
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 61,
                            'Folio' => $folios[61]+2,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => $Receptor,
                    ],
                    'Detalle' => [
                        [
                            'NmbItem' => 'Pintura B&W AFECTO',
                            'QtyItem' => 77,
                            'PrcItem' => 7719,
                            'MontoItem' => 594363,
                        ],
                        [
                            'NmbItem' => 'ITEM 2 AFECTO',
                            'QtyItem' => 254,
                            'PrcItem' => 4290,
                            'MontoItem' => 1089660,
                        ],
                        [
                            'IndExe' => 1,
                            'NmbItem' => 'ITEM 3 SERVICIO EXENTO',
                            'QtyItem' => 1,
                            'PrcItem' => 35407,
                            'MontoItem' => 35407,
                        ],
                    ],
                    'Referencia' => [
                        [
                            'TpoDocRef' => 'SET',
                            'FolioRef' => 0,
                            'RazonRef' => 'CASO 1580572-7',
                        ],
                        [
                            'TpoDocRef' => 33,
                            'FolioRef' => $folios[33]+2,
                            'CodRef' => 1,
                            'RazonRef' => 'ANULA FACTURA',
                        ],
                    ]
                ],
                // CASO 56 1 - Nota de debito Anula Nota de credito basica
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 56,
                            'Folio' => $folios[56],
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => $Receptor,
                    ],
                    'Detalle' => [
                        [
                            'NmbItem' => 'ANULA NOTA DE CREDITO',
                            'MontoItem' => 0,
                        ],
                    ],
                    'Referencia' => [
                        [
                            'TpoDocRef' => 'SET',
                            'FolioRef' => 0,
                            'RazonRef' => 'CASO 1580572-8',
                        ],
                        [
                            'TpoDocRef' => 61,
                            'FolioRef' => $folios[61],
                            'CodRef' => 1,
                            'RazonRef' => 'ANULA NOTA DE CREDITO ELECTRONICA',
                        ],
                    ]
                ],
            ];

            $dtes_etapa_2 = [
                // CASO 33 1 - Factura afecta basica
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 33,
                            'Folio' => $folios[33],
                            'FmaPago' => 2,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => [
                            'RUTRecep' => '77343610-K',
                            'RznSocRecep' => 'CONDOR TRAVEL S.A.',
                            'GiroRecep' => 'AGENCIA DE VIAJES',
                            'Contacto' => 'asistente-gerencia@condortravel.com',
                            'CorreoRecep' => 'asistente-gerencia@condortravel.com',
                            'DirRecep' => 'SANTA BEATRIZ 100 OF 305',
                            'CmnaRecep' => 'PROVIDENCIA',
                            'CiudadRecep' => 'SANTIAGO'
                        ],
                    ],
                    'Detalle' => [
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT1',
                                'VlrCodigo' => 3
                            ],
                            'NmbItem' => 'Outdoors',
                            'QtyItem' => 1,
                            'PrcItem' => 134452,
                            'MontoItem' => 134452,
                        ],
                    ],
                ],
                // CASO 33 2 - Factura afecta basica 2
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 33,
                            'Folio' => $folios[33]+1,
                            'TpoImpresion' => 'N',
                            'FmaPago' => 1,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => [
                            'RUTRecep' => '76078481-8',
                            'RznSocRecep' => 'CONSTRUCTORA E INMOBILIARIA II JAIME ARANCIBIA TAGLE Y COMPANIA LIMITADA',
                            'GiroRecep' => 'construccion de edificios residenciales',
                            'CorreoRecep' => 'secretaria@constructorajat.cl',
                            'DirRecep' => 'manuel aguilar #01105',
                            'CmnaRecep' => 'PUNTA ARENAS',
                            'CiudadRecep' => 'PUNTA ARENAS'
                        ],
                    ],
                    'Detalle' => [
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 0
                            ],
                            'NmbItem' => 'VENTA DE STOCK RESTAURANT',
                            'QtyItem' => 1,
                            'PrcItem' => 118721,
                            'MontoItem' => 118721,
                        ],
                    ],
                ],
                // CASO 33 3 - Factura afecta con OC
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 33,
                            'Folio' => $folios[33]+2,
                            'FmaPago' => 2,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => [
                            'RUTRecep' => '77011791-7',
                            'RznSocRecep' => 'SOUTHBOUND S.A.',
                            'GiroRecep' => 'OPERADOR TURISTICO',
                            'Contacto' => 'facturas@southbound.travel',
                            'CorreoRecep' => 'facturas@southbound.travel',
                            'DirRecep' => 'IMPERIAL 0655',
                            'CmnaRecep' => 'PUERTO VARAS',
                            'CiudadRecep' => 'PUERTO VARAS'
                        ],
                    ],
                    'Detalle' => [
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT1',
                                'VlrCodigo' => 3
                            ],
                            'NmbItem' => 'Outdoors',
                            'QtyItem' => 1,
                            'PrcItem' => 168065,
                            'MontoItem' => 168065,
                        ],
                    ],
                    'Referencia' => [
                        'TpoDocRef' => '801',
                        'FolioRef' => 'BKFI107160',
                        'FchRef' => '2019-12-28',
                        'RazonRef' => 'OC BKFI107160 Centro de Costo: 1',
                    ],
                ],
                // CASO 33 4 - Factura afecta con decimales
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 33,
                            'Folio' => $folios[33]+3,
                            'TpoImpresion' => 'N',
                            'FmaPago' => 2,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => [
                            'RUTRecep' => '76820687-2',
                            'RznSocRecep' => 'INVERSIONES CALADOC SPA',
                            'GiroRecep' => 'RESTAURANT',
                            'CorreoRecep' => 'JBENALDO@LACABRERACHILE.CL',
                            'DirRecep' => 'ALONSO DE CORDOVA 4263',
                            'CmnaRecep' => 'VITACURA',
                            'CiudadRecep' => 'SANTIAGO'
                        ],
                    ],
                    'Detalle' => [
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 0
                            ],
                            'NmbItem' => 'Papas Fritas Crudas',
                            'QtyItem' => 550,
                            'UnmdItem' => 'Kg',
                            'PrcItem' => 650,
                            'MontoItem' => 357500,
                        ],
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 1
                            ],
                            'NmbItem' => 'Mollejas',
                            'QtyItem' => 40.7,
                            'UnmdItem' => 'Kg',
                            'PrcItem' => 4202,
                            'MontoItem' => 171021,
                        ],
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 2
                            ],
                            'NmbItem' => 'Palta Hass',
                            'QtyItem' => 67.8,
                            'UnmdItem' => 'Kg',
                            'PrcItem' => 3590,
                            'MontoItem' => 243402,
                        ],
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 3
                            ],
                            'NmbItem' => 'Pollo Ganso',
                            'QtyItem' => 66,
                            'UnmdItem' => 'Kg',
                            'PrcItem' => 4898,
                            'MontoItem' => 323268,
                        ],
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 4
                            ],
                            'NmbItem' => 'Pollo Entero',
                            'QtyItem' => 102.3,
                            'UnmdItem' => 'Kg',
                            'PrcItem' => 2150,
                            'MontoItem' => 219945,
                        ],
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 5
                            ],
                            'NmbItem' => 'Punta De Ganso',
                            'QtyItem' => 41.95,
                            'UnmdItem' => 'Kg',
                            'PrcItem' => 5590,
                            'MontoItem' => 234501,
                        ],
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 6
                            ],
                            'NmbItem' => 'Queso Provoleta',
                            'QtyItem' => 21.5,
                            'UnmdItem' => 'Kg',
                            'PrcItem' => 7950,
                            'MontoItem' => 170925,
                        ],
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 7
                            ],
                            'NmbItem' => 'Aceite Frito Master',
                            'QtyItem' => 170,
                            'UnmdItem' => 'Kg',
                            'PrcItem' => 1360,
                            'MontoItem' => 231200,
                        ],
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 8
                            ],
                            'NmbItem' => 'mix Lechugas tomate rucula verduras',
                            'QtyItem' => 1,
                            'UnmdItem' => 'Kg',
                            'PrcItem' => 1509778,
                            'MontoItem' => 1509778,
                        ],
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 9
                            ],
                            'NmbItem' => 'Tapabariga Centro Torobayo',
                            'QtyItem' => 16.4,
                            'UnmdItem' => 'Kg',
                            'PrcItem' => 6498,
                            'MontoItem' => 106567,
                        ],
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 10
                            ],
                            'NmbItem' => 'Masa Empanada',
                            'QtyItem' => 1650,
                            'UnmdItem' => 'Kg',
                            'PrcItem' => 59,
                            'MontoItem' => 97350,
                        ],
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 11
                            ],
                            'NmbItem' => 'Huevos',
                            'QtyItem' => 180,
                            'UnmdItem' => 'Unid',
                            'PrcItem' => 131,
                            'MontoItem' => 23580,
                        ],
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 12
                            ],
                            'NmbItem' => 'Servicio Logisticos Agosto',
                            'QtyItem' => 1,
                            'UnmdItem' => 'Unid',
                            'PrcItem' => 783877,
                            'MontoItem' => 783877,
                        ],
                    ],
                ],
                // CASO 33 5 - factura afecta muebles
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 33,
                            'Folio' => $folios[33]+4,
                            'TpoImpresion' => 'N',
                            'FmaPago' => 1,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => [
                            'RUTRecep' => '77180742-9',
                            'RznSocRecep' => 'DONOSO GROUP SPA',
                            'GiroRecep' => 'ACT DE CONSULTORIA DE INFORMATICA',
                            'CorreoRecep' => 'EPACHECO@FRENON.COM',
                            'DirRecep' => 'MANUEL AGUILAR 01105',
                            'CmnaRecep' => 'PUNTA ARENAS',
                            'CiudadRecep' => 'PUNTA ARENAS'
                        ],
                    ],
                    'Detalle' => [
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 0
                            ],
                            'NmbItem' => '2 UNIDADES ESCRITORIO MODULAR USADO',
                            'QtyItem' => 2,
                            'PrcItem' => 100000,
                            'MontoItem' => 200000,
                        ],
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 1
                            ],
                            'NmbItem' => '2 UNIDADES SILLAS DE ESCRITORIO USADAS',
                            'QtyItem' => 2,
                            'PrcItem' => 35000,
                            'MontoItem' => 70000,
                        ],
                    ],
                ],
                // CASO 33 6 - Factura Afecta con propina exenta
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 33,
                            'Folio' => $folios[33]+5,
                            'FmaPago' => 2,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => [
                            'RUTRecep' => '96510510-7',
                            'RznSocRecep' => 'NAVIERA Y TURISMO SKORPIOS S A',
                            'GiroRecep' => 'TRANSPORTE DE PASAJEROS POR VIAS DE NAVE',
                            'Contacto' => 'jvenegas@skorpios.cl',
                            'CorreoRecep' => 'jvenegas@skorpios.cl',
                            'DirRecep' => 'ANGELMO 1660',
                            'CmnaRecep' => 'PUERTO MONTT',
                            'CiudadRecep' => 'PUERTO MONTT'
                        ],
                    ],
                    'Detalle' => [
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT1',
                                'VlrCodigo' => 2
                            ],
                            'NmbItem' => 'Restaurant',
                            'QtyItem' => 1,
                            'PrcItem' => 85660,
                            'MontoItem' => 85660,
                        ],
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT1',
                                'VlrCodigo' => 5
                            ],
                            'IndExe' => 1,
                            'NmbItem' => 'Propinas - Tips',
                            'QtyItem' => 1,
                            'PrcItem' => 4000,
                            'MontoItem' => 4000,
                        ],
                    ],
                ],
                // CASO 33 7 - factura afecta servicios 1
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 33,
                            'Folio' => $folios[33]+6,
                            'FmaPago' => 2,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => [
                            'RUTRecep' => '79800310-0',
                            'RznSocRecep' => 'TURISMO COMAPA LTDA',
                            'GiroRecep' => 'AGENCIAS Y ORGANIZADORES DE VIAJES',
                            'Contacto' => 'dte@comapa.cl',
                            'CorreoRecep' => 'dte@comapa.cl',
                            'DirRecep' => 'MAGALLANES 990-E',
                            'CmnaRecep' => 'PUNTA ARENAS',
                            'CiudadRecep' => 'PUNTA ARENAS'
                        ],
                    ],
                    'Detalle' => [
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT1',
                                'VlrCodigo' => 2
                            ],
                            'NmbItem' => 'Restaurant',
                            'QtyItem' => 1,
                            'PrcItem' => 100840,
                            'MontoItem' => 100840,
                        ],
                    ],
                ],
                // CASO 33 8 - factura afecta servicios 2
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 33,
                            'Folio' => $folios[33]+7,
                            'TpoImpresion' => 'N',
                            'FmaPago' => 1
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => [
                            'RUTRecep' => '76380699-5',
                            'RznSocRecep' => 'SOCIEDAD GOMPERTZ & ARANCIBIA LTDA',
                            'GiroRecep' => 'COMPRA Y VENTA DE ANIMALES-CABALGATAS',
                            'CorreoRecep' => 'alobos@aytcontadores.cl',
                            'DirRecep' => 'LOTE 12 TRES PASOS S/n',
                            'CmnaRecep' => 'PUERTO NATALES',
                            'CiudadRecep' => 'PUERTO NATALES'
                        ],
                    ],
                    'Detalle' => [
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 0
                            ],
                            'NmbItem' => 'Servicios prestados mes de Enero 2020',
                            'QtyItem' => 1,
                            'PrcItem' => 1544493,
                            'MontoItem' => 1544493,
                        ],
                    ],
                ],
                // CASO 34 1 - Factura exenta
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 34,
                            'Folio' => $folios[34],
                            'FmaPago' => 1,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => [
                            'RUTRecep' => '77625190-9',
                            'RznSocRecep' => 'SAT DE CHILE AGENCIA DE VIAJES S.A.',
                            'GiroRecep' => 'AGENCIA DE VIAJES',
                            'Contacto' => 'recepcion-chile@southamericantours.com',
                            'CorreoRecep' => 'recepcion-chile@southamericantours.com',
                            'DirRecep' => 'PADRE MARIANO #82, OF. 803',
                            'CmnaRecep' => 'PROVIDENCIA',
                            'CiudadRecep' => 'SANTIAGO'
                        ],
                    ],
                    'Detalle' => [
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT1',
                                'VlrCodigo' => 18
                            ],
                            'IndExe' => 1,
                            'NmbItem' => 'Alojamiento Penalizacion',
                            'QtyItem' => 1,
                            'PrcItem' => 2291189,
                            'MontoItem' => 2291189,
                        ],
                    ],
                ],
                // CASO 34 2 - Factura exenta implementacion
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 34,
                            'Folio' => $folios[34]+1,
                            'TpoImpresion' => 'N',
                            'FmaPago' => 2,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => [
                            'RUTRecep' => '92011000-2',
                            'RznSocRecep' => 'EMPRESA NACIONAL DE ENERGIA ENEX',
                            'GiroRecep' => 'PRODUCTOS DEL PETROLEO',
                            'CorreoRecep' => 'SERGIO.MEZA@ENEX.CL',
                            'DirRecep' => 'AV CONDOR SUR 520',
                            'CmnaRecep' => 'CIUDAD EMPRESARIAL',
                            'CiudadRecep' => 'SANTIAGO'
                        ],
                    ],
                    'Detalle' => [
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 0
                            ],
                            'IndExe' => 1,
                            'NmbItem' => 'Implementacion Sala de Calderas a GLP en la Hotel Rio Serrano segun anexo de con',
                            'QtyItem' => 1,
                            'PrcItem' => 3000000,
                            'MontoItem' => 3000000,
                        ],
                    ],
                ],
                // CASO 61 1 - Nota de credito anula factura basica
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 61,
                            'Folio' => $folios[61],
                            'FmaPago' => 2,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => [
                            'RUTRecep' => '77343610-K',
                            'RznSocRecep' => 'CONDOR TRAVEL S.A.',
                            'GiroRecep' => 'AGENCIA DE VIAJES',
                            'Contacto' => 'asistente-gerencia@condortravel.com',
                            'CorreoRecep' => 'asistente-gerencia@condortravel.com',
                            'DirRecep' => 'SANTA BEATRIZ 100 OF 305',
                            'CmnaRecep' => 'PROVIDENCIA',
                            'CiudadRecep' => 'SANTIAGO'
                        ],
                    ],
                    'Detalle' => [
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT1',
                                'VlrCodigo' => 3
                            ],
                            'NmbItem' => 'Outdoors',
                            'QtyItem' => 1,
                            'PrcItem' => 134452,
                            'MontoItem' => 134452,
                        ],
                    ],
                    'Referencia' => [
                        [
                            'TpoDocRef' => 33,
                            'FolioRef' => $folios[33],
                            'CodRef' => 1,
                            'RazonRef' => 'Anula DTE',
                        ],
                    ]
                ],
                // CASO 61 2 - Nota de credito anula Factura afecta con OC
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 61,
                            'Folio' => $folios[61] + 1,
                            'FmaPago' => 2,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => [
                            'RUTRecep' => '77011791-7',
                            'RznSocRecep' => 'SOUTHBOUND S.A.',
                            'GiroRecep' => 'PERADOR TURISTICO',
                            'Contacto' => 'facturas@southbound.travel',
                            'CorreoRecep' => 'facturas@southbound.travel',
                            'DirRecep' => 'IMPERIAL 0655',
                            'CmnaRecep' => 'PUERTO VARAS',
                            'CiudadRecep' => 'PUERTO VARAS'
                        ],
                    ],
                    'Detalle' => [
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT1',
                                'VlrCodigo' => 3
                            ],
                            'NmbItem' => 'Outdoors',
                            'QtyItem' => 1,
                            'PrcItem' => 168065,
                            'MontoItem' => 168065,
                        ],
                    ],
                    'Referencia' => [
                        [
                            'TpoDocRef' => 33,
                            'FolioRef' => $folios[33]+2,
                            'CodRef' => 1,
                            'RazonRef' => 'Anula DTE',
                        ],
                        [
                            'TpoDocRef' => '801',
                            'FolioRef' => 'BKFI107160',
                            'FchRef' => '2019-12-28',
                            'RazonRef' => 'OC BKFI107160 Centro de Costo: 1',
                        ],
                    ]
                ],
                // CASO 61 3 - Nota de credito anula factura afecta con decimales
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 61,
                            'Folio' => $folios[61]+2,
                            'TpoImpresion' => 'N',
                            'FmaPago' => 2,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => [
                            'RUTRecep' => '76820687-2',
                            'RznSocRecep' => 'INVERSIONES CALADOC SPA',
                            'GiroRecep' => 'RESTAURANT',
                            'CorreoRecep' => 'JBENALDO@LACABRERACHILE.CL',
                            'DirRecep' => 'ALONSO DE CORDOVA 4263',
                            'CmnaRecep' => 'VITACURA',
                            'CiudadRecep' => 'SANTIAGO'
                        ],
                    ],
                    'Detalle' => [
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 0
                            ],
                            'NmbItem' => 'Papas Fritas Crudas',
                            'QtyItem' => 550,
                            'UnmdItem' => 'Kg',
                            'PrcItem' => 650,
                            'MontoItem' => 357500,
                        ],
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 1
                            ],
                            'NmbItem' => 'Mollejas',
                            'QtyItem' => 40.7,
                            'UnmdItem' => 'Kg',
                            'PrcItem' => 4202,
                            'MontoItem' => 171021,
                        ],
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 2
                            ],
                            'NmbItem' => 'Palta Hass',
                            'QtyItem' => 67.8,
                            'UnmdItem' => 'Kg',
                            'PrcItem' => 3590,
                            'MontoItem' => 243402,
                        ],
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 3
                            ],
                            'NmbItem' => 'Pollo Ganso',
                            'QtyItem' => 66,
                            'UnmdItem' => 'Kg',
                            'PrcItem' => 4898,
                            'MontoItem' => 323268,
                        ],
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 4
                            ],
                            'NmbItem' => 'Pollo Entero',
                            'QtyItem' => 102.3,
                            'UnmdItem' => 'Kg',
                            'PrcItem' => 2150,
                            'MontoItem' => 219945,
                        ],
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 5
                            ],
                            'NmbItem' => 'Punta De Ganso',
                            'QtyItem' => 41.95,
                            'UnmdItem' => 'Kg',
                            'PrcItem' => 5590,
                            'MontoItem' => 234501,
                        ],
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 6
                            ],
                            'NmbItem' => 'Queso Provoleta',
                            'QtyItem' => 21.5,
                            'UnmdItem' => 'Kg',
                            'PrcItem' => 7950,
                            'MontoItem' => 170925,
                        ],
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 7
                            ],
                            'NmbItem' => 'Aceite Frito Master',
                            'QtyItem' => 170,
                            'UnmdItem' => 'Kg',
                            'PrcItem' => 1360,
                            'MontoItem' => 231200,
                        ],
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 8
                            ],
                            'NmbItem' => 'mix Lechugas tomate rucula verduras',
                            'QtyItem' => 1,
                            'UnmdItem' => 'Kg',
                            'PrcItem' => 1509778,
                            'MontoItem' => 1509778,
                        ],
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 9
                            ],
                            'NmbItem' => 'Tapabariga Centro Torobayo',
                            'QtyItem' => 16.4,
                            'UnmdItem' => 'Kg',
                            'PrcItem' => 6498,
                            'MontoItem' => 106567,
                        ],
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 10
                            ],
                            'NmbItem' => 'Masa Empanada',
                            'QtyItem' => 1650,
                            'UnmdItem' => 'Kg',
                            'PrcItem' => 59,
                            'MontoItem' => 97350,
                        ],
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 11
                            ],
                            'NmbItem' => 'Huevos',
                            'QtyItem' => 180,
                            'UnmdItem' => 'Unid',
                            'PrcItem' => 131,
                            'MontoItem' => 23580,
                        ],
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 12
                            ],
                            'NmbItem' => 'Servicio Logisticos Agosto',
                            'QtyItem' => 1,
                            'UnmdItem' => 'Unid',
                            'PrcItem' => 783877,
                            'MontoItem' => 783877,
                        ],
                    ],
                    'Referencia' => [
                        [
                            'TpoDocRef' => 33,
                            'FolioRef' => $folios[33]+3,
                            'CodRef' => 1,
                            'RazonRef' => 'Anula DTE',
                        ],
                    ]
                ],
                // CASO 61 4 - Nota de credito anula Factura exenta electronica
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 61,
                            'Folio' => $folios[61]+3,
                            'FmaPago' => 1,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => [
                            'RUTRecep' => '77625190-9',
                            'RznSocRecep' => 'SAT DE CHILE AGENCIA DE VIAJES S.A.',
                            'GiroRecep' => 'AGENCIA DE VIAJES',
                            'Contacto' => 'recepcion-chile@southamericantours.com',
                            'CorreoRecep' => 'recepcion-chile@southamericantours.com',
                            'DirRecep' => 'PADRE MARIANO #82, OF. 803',
                            'CmnaRecep' => 'PROVIDENCIA',
                            'CiudadRecep' => 'SANTIAGO'
                        ],
                    ],
                    'Detalle' => [
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT1',
                                'VlrCodigo' => 18
                            ],
                            'IndExe' => 1,
                            'NmbItem' => 'Alojamiento Penalizacion',
                            'QtyItem' => 1,
                            'PrcItem' => 2291189,
                            'MontoItem' => 2291189,
                        ],
                    ],
                    'Referencia' => [
                        [
                            'TpoDocRef' => 34,
                            'FolioRef' => $folios[34],
                            'CodRef' => 1,
                            'RazonRef' => 'Anula DTE',
                        ],
                    ]
                ],
                // CASO 61 5 - Nota de credito anula Factura exenta implementacion
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 61,
                            'Folio' => $folios[61]+4,
                            'TpoImpresion' => 'N',
                            'FmaPago' => 2,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => [
                            'RUTRecep' => '92011000-2',
                            'RznSocRecep' => 'EMPRESA NACIONAL DE ENERGIA ENEX',
                            'GiroRecep' => 'PRODUCTOS DEL PETROLEO',
                            'CorreoRecep' => 'SERGIO.MEZA@ENEX.CL',
                            'DirRecep' => 'AV CONDOR SUR 520',
                            'CmnaRecep' => 'CIUDAD EMPRESARIAL',
                            'CiudadRecep' => 'SANTIAGO'
                        ],
                    ],
                    'Detalle' => [
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 0
                            ],
                            'IndExe' => 1,
                            'NmbItem' => 'Implementacion Sala de Calderas a GLP en la Hotel Rio Serrano segun anexo de con',
                            'QtyItem' => 1,
                            'PrcItem' => 3000000,
                            'MontoItem' => 3000000,
                        ],
                    ],
                    'Referencia' => [
                        [
                            'TpoDocRef' => '34',
                            'FolioRef' => $folios[34]+1,
                            'CodRef' => 1,
                            'RazonRef' => 'Anula DTE',
                        ],
                    ]
                ],
                // CASO 61 6 - Nota de credito anula factura afecta muebles
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 61,
                            'Folio' => $folios[61]+5,
                            'TpoImpresion' => 'N',
                            'FmaPago' => 1,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => [
                            'RUTRecep' => '77180742-9',
                            'RznSocRecep' => 'DONOSO GROUP SPA',
                            'GiroRecep' => 'ACT DE CONSULTORIA DE INFORMATICA',
                            'CorreoRecep' => 'EPACHECO@FRENON.COM',
                            'DirRecep' => 'MANUEL AGUILAR 01105',
                            'CmnaRecep' => 'PUNTA ARENAS',
                            'CiudadRecep' => 'PUNTA ARENAS'
                        ],
                    ],
                    'Detalle' => [
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 0
                            ],
                            'NmbItem' => '2 UNIDADES ESCRITORIO MODULAR USADO',
                            'QtyItem' => 2,
                            'PrcItem' => 100000,
                            'MontoItem' => 200000,
                        ],
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 1
                            ],
                            'NmbItem' => '2 UNIDADES SILLAS DE ESCRITORIO USADAS',
                            'QtyItem' => 2,
                            'PrcItem' => 35000,
                            'MontoItem' => 70000,
                        ],
                    ],
                    'Referencia' => [
                        [
                            'TpoDocRef' => '33',
                            'FolioRef' => $folios[33]+4,
                            'CodRef' => 1,
                            'RazonRef' => 'Anula DTE',
                        ],
                    ]
                ],
                // CASO 61 7 - Nota de credito anula factura con propina exenta
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 61,
                            'Folio' => $folios[61]+6,
                            'FmaPago' => 2,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => [
                            'RUTRecep' => '96510510-7',
                            'RznSocRecep' => 'NAVIERA Y TURISMO SKORPIOS S A',
                            'GiroRecep' => 'TRANSPORTE DE PASAJEROS POR VIAS DE NAVE',
                            'Contacto' => 'jvenegas@skorpios.cl',
                            'CorreoRecep' => 'jvenegas@skorpios.cl',
                            'DirRecep' => 'ANGELMO 1660',
                            'CmnaRecep' => 'PUERTO MONTT',
                            'CiudadRecep' => 'PUERTO MONTT'
                        ],
                    ],
                    'Detalle' => [
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT1',
                                'VlrCodigo' => 2
                            ],
                            'NmbItem' => 'Restaurant',
                            'QtyItem' => 1,
                            'PrcItem' => 85660,
                            'MontoItem' => 85660,
                        ],
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT1',
                                'VlrCodigo' => 5
                            ],
                            'IndExe' => 1,
                            'NmbItem' => 'Propinas - Tips',
                            'QtyItem' => 1,
                            'PrcItem' => 4000,
                            'MontoItem' => 4000,
                        ],
                    ],
                    'Referencia' => [
                        [
                            'TpoDocRef' => '33',
                            'FolioRef' => $folios[33]+5,
                            'CodRef' => 1,
                            'RazonRef' => 'Anula DTE',
                        ],
                    ]
                ],
                // CASO 61 8 - Nota de credito anula factura afecta servicios 1
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 61,
                            'Folio' => $folios[61]+7,
                            'FmaPago' => 2,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => [
                            'RUTRecep' => '79800310-0',
                            'RznSocRecep' => 'TURISMO COMAPA LTDA',
                            'GiroRecep' => 'AGENCIAS Y ORGANIZADORES DE VIAJES',
                            'Contacto' => 'dte@comapa.cl',
                            'CorreoRecep' => 'dte@comapa.cl',
                            'DirRecep' => 'MAGALLANES 990-E',
                            'CmnaRecep' => 'PUNTA ARENAS',
                            'CiudadRecep' => 'PUNTA ARENAS'
                        ],
                    ],
                    'Detalle' => [
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT1',
                                'VlrCodigo' => 2
                            ],
                            'NmbItem' => 'Restaurant',
                            'QtyItem' => 1,
                            'PrcItem' => 100840,
                            'MontoItem' => 100840,
                        ],
                    ],
                    'Referencia' => [
                        [
                            'TpoDocRef' => '33',
                            'FolioRef' => $folios[33]+6,
                            'CodRef' => 1,
                            'RazonRef' => 'Anula DTE',
                        ],
                    ]
                ],
                // CASO 61 9 - Nota de credito anula factura afecta servicios 2
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 61,
                            'Folio' => $folios[61]+8,
                            'FmaPago' => 2,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => [
                            'RUTRecep' => '76380699-5',
                            'RznSocRecep' => 'SOCIEDAD GOMPERTZ & ARANCIBIA LTDA',
                            'GiroRecep' => 'COMPRA Y VENTA DE ANIMALES-CABALGATAS',
                            'CorreoRecep' => 'alobos@aytcontadores.cl',
                            'DirRecep' => 'LOTE 12 TRES PASOS S/n',
                            'CmnaRecep' => 'PUERTO NATALES',
                            'CiudadRecep' => 'PUERTO NATALES'
                        ],
                    ],
                    'Detalle' => [
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT',
                                'VlrCodigo' => 0
                            ],
                            'NmbItem' => 'Servicios prestados mes de Enero 2020',
                            'QtyItem' => 1,
                            'PrcItem' => 1544493,
                            'MontoItem' => 1544493,
                        ],
                    ],
                    'Referencia' => [
                        [
                            'TpoDocRef' => '33',
                            'FolioRef' => $folios[33]+7,
                            'CodRef' => 1,
                            'RazonRef' => 'Anula DTE',
                        ],
                    ]
                ],
                // CASO 56 1 - Nota de debito Anula Nota de credito basica
                [
                    'Encabezado' => [
                        'IdDoc' => [
                            'TipoDTE' => 56,
                            'Folio' => $folios[56],
                            'FmaPago' => 2,
                        ],
                        'Emisor' => $Emisor,
                        'Receptor' => [
                            'RUTRecep' => '77343610-K',
                            'RznSocRecep' => 'CONDOR TRAVEL S.A.',
                            'GiroRecep' => 'AGENCIA DE VIAJES',
                            'Contacto' => 'asistente-gerencia@condortravel.com',
                            'CorreoRecep' => 'asistente-gerencia@condortravel.com',
                            'DirRecep' => 'SANTA BEATRIZ 100 OF 305',
                            'CmnaRecep' => 'PROVIDENCIA',
                            'CiudadRecep' => 'SANTIAGO'
                        ],
                    ],
                    'Detalle' => [
                        [
                            'CdgItem' => [
                                'TpoCodigo' => 'INT1',
                                'VlrCodigo' => 3
                            ],
                            'NmbItem' => 'Outdoors',
                            'QtyItem' => 1,
                            'PrcItem' => 134452,
                            'MontoItem' => 134452,
                        ],
                    ],
                    'Referencia' => [
                        [
                            'TpoDocRef' => '61',
                            'FolioRef' => $folios[61],
                            'CodRef' => 1,
                            'RazonRef' => 'Anula DTE',
                        ],
                    ]
                ]
            ];

            $set_pruebas = $dtes_etapa_1_v2;

            $Firma = new \sasco\LibreDTE\FirmaElectronica($this->fconfig);

            $Folios = [];

            foreach ($folios as $tipo => $cantidad){
                $Folios[$tipo] = new Sii\Folios(file_get_contents(resource_path('FoliosSII_'.$tipo.'.xml')));
            }

            $EnvioDTE = new Sii\EnvioDte();

            foreach ($set_pruebas as $documento) {

                $DTE = new Sii\Dte($documento);

                if (!$DTE->timbrar($Folios[$DTE->getTipo()]))
                    break;
                if (!$DTE->firmar($Firma))
                    break;

                $EnvioDTE->agregar($DTE);

            }

            $EnvioDTE->setCaratula($caratula);
            $EnvioDTE->setFirma($Firma);

            if($request->test != 0 and ($request->test == 1 or $request->test == 'true'))
            {
                $path_filename = resource_path('dinamic/envio_cer_'.date('Y_m_d_H_i_s').'.xml');
                touch($path_filename);
                file_put_contents($path_filename, $EnvioDTE->generar()); // guardar XML en sistema de archivos

                if($track_id = $EnvioDTE->enviar()){
                    return var_dump($track_id);
                }
            }

            $path_filename = resource_path('dinamic/envio_test_'.date('Y_m_d_H_i_s').'.xml');
            touch($path_filename);
            $xml = $EnvioDTE->generar();
            file_put_contents($path_filename, $xml); // guardar XML en sistema de archivos

            return $xml;

        } catch ( \Exception $e){

            foreach (\sasco\LibreDTE\Log::readAll() as $error)
                Log::info($error);

            return $e->getMessage();
        }

    }

    public function exchange_reception(Request $request){

        $archivo_recibido = resource_path('dinamic/INTERCAMBIO_SII_DTE_1563923.xml');
        $RutReceptor_esperado = '77180742-9';
        $RutEmisor_esperado = '88888888-8';

        // Cargar EnvioDTE y extraer arreglo con datos de carátula y DTEs
        $EnvioDte = new Sii\EnvioDte();
        $EnvioDte->loadXML(file_get_contents($archivo_recibido));
        $Caratula = $EnvioDte->getCaratula();
        $Documentos = $EnvioDte->getDocumentos();

        // caratula
        $caratula = [
            'RutResponde' => $RutReceptor_esperado,
            'RutRecibe' => $Caratula['RutEmisor'],
            'IdRespuesta' => 1,
            //'NmbContacto' => '',
            //'MailContacto' => '',
        ];

        // procesar cada DTE
        $RecepcionDTE = [];

        foreach ($Documentos as $DTE) {
            $estado = $DTE->getEstadoValidacion(['RUTEmisor'=>$RutEmisor_esperado, 'RUTRecep'=>$RutReceptor_esperado]);
            $RecepcionDTE[] = [
                'TipoDTE' => $DTE->getTipo(),
                'Folio' => $DTE->getFolio(),
                'FchEmis' => $DTE->getFechaEmision(),
                'RUTEmisor' => $DTE->getEmisor(),
                'RUTRecep' => $DTE->getReceptor(),
                'MntTotal' => $DTE->getMontoTotal(),
                'EstadoRecepDTE' => $estado,
                'RecepDTEGlosa' => Sii\RespuestaEnvio::$estados['documento'][$estado],
            ];
        }

        // armar respuesta de envío
        $estado = $EnvioDte->getEstadoValidacion(['RutReceptor'=>$RutReceptor_esperado]);
        $RespuestaEnvio = new Sii\RespuestaEnvio();
        $RespuestaEnvio->agregarRespuestaEnvio([
            'NmbEnvio' => basename($archivo_recibido),
            'CodEnvio' => 1,
            'EnvioDTEID' => $EnvioDte->getID(),
            'Digest' => $EnvioDte->getDigest(),
            'RutEmisor' => $EnvioDte->getEmisor(),
            'RutReceptor' => $EnvioDte->getReceptor(),
            'EstadoRecepEnv' => $estado,
            'RecepEnvGlosa' => Sii\RespuestaEnvio::$estados['envio'][$estado],
            'NroDTE' => count($RecepcionDTE),
            'RecepcionDTE' => $RecepcionDTE,
        ]);

        // asignar carátula y Firma
        $RespuestaEnvio->setCaratula($caratula);
        $RespuestaEnvio->setFirma(new FirmaElectronica($this->fconfig));

        // generar XML
        $xml = $RespuestaEnvio->generar();

        file_put_contents(resource_path('dinamic/intercambio_recepcion.xml'), $RespuestaEnvio->generar()); // guardar XML en sistema de archivos

        // validar schema del XML que se generó
        if ($RespuestaEnvio->schemaValidate()) {
            // mostrar XML al usuario, deberá ser guardado y subido al SII en:
            // https://www4.sii.cl/pfeInternet
            return $xml;
        }

        // si hubo errores mostrar
        foreach (\sasco\LibreDTE\Log::readAll() as $error)
            Log::info($error);

        return 'fail';

    }

    public function exchange_shipping(Request $request){

        $archivo_recibido = resource_path('dinamic/INTERCAMBIO_SII_DTE_1563923.xml');
        $RutResponde = '77180742-9';
        $RutFirma = '77180742-9';

        // Cargar EnvioDTE y extraer arreglo con datos de carátula y DTEs
        $EnvioDte = new Sii\EnvioDte();
        $EnvioDte->loadXML(file_get_contents($archivo_recibido));
        $Caratula = $EnvioDte->getCaratula();
        $Documentos = $EnvioDte->getDocumentos();

        // caratula
        $caratula = [
            'RutResponde' => $RutResponde,
            'RutRecibe' => $Caratula['RutEmisor'],
            //'NmbContacto' => '',
            //'MailContacto' => '',
        ];

        // objeto EnvioRecibo, asignar carátula y Firma
        $EnvioRecibos = new Sii\EnvioRecibos();
        $EnvioRecibos->setCaratula($caratula);
        $EnvioRecibos->setFirma(new \sasco\LibreDTE\FirmaElectronica($this->fconfig));

        // procesar cada DTE
        foreach ($Documentos as $DTE) {
            $EnvioRecibos->agregar([
                'TipoDoc' => $DTE->getTipo(),
                'Folio' => $DTE->getFolio(),
                'FchEmis' => $DTE->getFechaEmision(),
                'RUTEmisor' => $DTE->getEmisor(),
                'RUTRecep' => $DTE->getReceptor(),
                'MntTotal' => $DTE->getMontoTotal(),
                'Recinto' => 'Oficina central',
                'RutFirma' => $RutFirma,
            ]);
        }

        // generar XML
        $xml = $EnvioRecibos->generar();

        file_put_contents(resource_path('dinamic/intercambio_envio.xml'), $EnvioRecibos->generar()); // guardar XML en sistema de archivos

        // validar schema del XML que se generó
        if ($EnvioRecibos->schemaValidate()) {
            // mostrar XML al usuario, deberá ser guardado y subido al SII en:
            // https://www4.sii.cl/pfeInternet
            return $xml;
        }

        // si hubo errores mostrar
        foreach (\sasco\LibreDTE\Log::readAll() as $error)
            Log::info($error);

        return 'fail';
    }

    public function exchange_result(Request $request){

        // datos para validar
        $archivo_recibido = resource_path('dinamic/INTERCAMBIO_SII_DTE_1563923.xml');
        $RutReceptor_esperado = '77180742-9';
        $RutEmisor_esperado = '88888888-8';

        // Cargar EnvioDTE y extraer arreglo con datos de carátula y DTEs
        $EnvioDte = new Sii\EnvioDte();
        $EnvioDte->loadXML(file_get_contents($archivo_recibido));
        $Caratula = $EnvioDte->getCaratula();
        $Documentos = $EnvioDte->getDocumentos();

        // caratula
        $caratula = [
            'RutResponde' => $RutReceptor_esperado,
            'RutRecibe' => $Caratula['RutEmisor'],
            'IdRespuesta' => 1,
            //'NmbContacto' => '',
            //'MailContacto' => '',
        ];

        // objeto para la respuesta
        $RespuestaEnvio = new Sii\RespuestaEnvio();

        // procesar cada DTE
        $i = 1;
        foreach ($Documentos as $DTE) {
            $estado = !$DTE->getEstadoValidacion(['RUTEmisor'=>$RutEmisor_esperado, 'RUTRecep'=>$RutReceptor_esperado]) ? 0 : 2;
            $RespuestaEnvio->agregarRespuestaDocumento([
                'TipoDTE' => $DTE->getTipo(),
                'Folio' => $DTE->getFolio(),
                'FchEmis' => $DTE->getFechaEmision(),
                'RUTEmisor' => $DTE->getEmisor(),
                'RUTRecep' => $DTE->getReceptor(),
                'MntTotal' => $DTE->getMontoTotal(),
                'CodEnvio' => $i++,
                'EstadoDTE' => $estado,
                'EstadoDTEGlosa' => Sii\RespuestaEnvio::$estados['respuesta_documento'][$estado],
            ]);
        }

        // asignar carátula y Firma
        $RespuestaEnvio->setCaratula($caratula);
        $RespuestaEnvio->setFirma(new FirmaElectronica($this->fconfig));

        // generar XML
        $xml = $RespuestaEnvio->generar();

        file_put_contents(resource_path('dinamic/intercambio_resultado.xml'), $RespuestaEnvio->generar()); // guardar XML en sistema de archivos

        // validar schema del XML que se generó
        if ($RespuestaEnvio->schemaValidate()) {
            // mostrar XML al usuario, deberá ser guardado y subido al SII en:
            // https://www4.sii.cl/pfeInternet
            return $xml;
        }

        // si hubo errores mostrar
        foreach (\sasco\LibreDTE\Log::readAll() as $error)
            Log::info($error);

        return 'fail';
    }

    public function shopping_book(){

        return 0;

        $caratula = [
            'RutEmisorLibro' => '77180742-9',
            'RutEnvia' => '16636576-7',
            'PeriodoTributario' => '2020-09',
            'FchResol' => '2020-09-04',
            'NroResol' => 0,
            'TipoOperacion' => 'COMPRA',
            'TipoLibro' => 'MENSUAL',
            'TipoEnvio' => 'TOTAL',
        ];

        $Firma = new \sasco\LibreDTE\FirmaElectronica($this->fconfig);
        $LibroCompraVenta = new \sasco\LibreDTE\Sii\LibroCompraVenta(true); // se genera libro simplificado (solicitado así en certificación)

        // agregar detalle desde un archivo CSV con ; como separador
        $LibroCompraVenta->agregarComprasCSV(resource_path('libro_compras.csv'));

        $LibroCompraVenta->setCaratula($caratula);

//        $LibroCompraVenta->generar(); // generar XML sin firma
        file_put_contents(resource_path('envio_libro_compra.xml'), $LibroCompraVenta->generar()); // guardar XML en sistema de archivos

        $LibroCompraVenta->setFirma($Firma);

//        if($track_id = $LibroCompraVenta->enviar()){
//            return var_dump($track_id);
//        }

        // si hubo errores mostrar
        foreach (\sasco\LibreDTE\Log::readAll() as $error)
            Log::info($error);

        return 'fail';

    }

    public function sales_book(){

        return 0;

    }

    public function obtenerSemilla()
    {
//        $client = new SoapClient('https://palena.sii.cl/DTEWS/CrSeed.jws?WSDL');
//        return $client->getSeed();
    }

    public function obtenerToken()
    {
//        $firma_config = ['file'=>resource_path('CertificadoDigitalJaimeArancibia.pfx'), 'pass'=>1234];
//        $token = Sii\Autenticacion::getToken($firma_config);
//        return var_dump($token);
    }

    public function estadoDTE(){

        $token = Sii\Autenticacion::getToken($this->fconfig);
        if($token){
            $estado = \sasco\LibreDTE\Sii::request('QueryEstUp', 'getEstUp', ['77180742', '9', '91513946', $token]);
            if ($estado!==false) {
                $estado->saveXML(resource_path('estado_dte.xml'));
                return $estado->xpath('/SII:RESPUESTA/SII:RESP_HDR');
            }
        }

    }

    public function getFirma(){

        $firma_config = ['file'=>resource_path('CertificadoDigitalJaimeArancibia.pfx'), 'pass'=>1234];
        $Firma = new \sasco\LibreDTE\FirmaElectronica($firma_config);
        $myfirma['getID'] = $Firma->getID();
        $myfirma['getName'] = $Firma->getName();
        $myfirma['getEmail'] = $Firma->getEmail();
        $myfirma['getFrom'] = $Firma->getFrom();
        $myfirma['getTo'] = $Firma->getTo();
        $myfirma['getIssuer'] = $Firma->getIssuer();
        $myfirma['getModulus'] = $Firma->getModulus();
        $myfirma['getCertificate'] = $Firma->getCertificate();

        return $myfirma;

    }

    public function sales_book_beta(){

        return 0;

        $caratula = [
            'RutEmisorLibro' => '77180742-9',
            'RutEnvia' => '16636576-7',
            'PeriodoTributario' => '2020-09',
            'FchResol' => '2020-09-04',
            'NroResol' => 0,
            'TipoOperacion' => 'VENTA',
            'TipoLibro' => 'MENSUAL',
            'TipoEnvio' => 'TOTAL',
        ];

        // Objetos de Firma y LibroCompraVenta
        $Firma = new \sasco\LibreDTE\FirmaElectronica($this->fconfig);
        $LibroCompraVenta = new \sasco\LibreDTE\Sii\LibroCompraVenta(true); // se genera libro simplificado (solicitado así en certificación)

        // agregar detalle desde un archivo CSV con ; como separador
        $LibroCompraVenta->agregarVentasCSV(resource_path('libro_ventas.csv'));

        // enviar libro de compras y mostrar resultado del envío: track id o bien =false si hubo error
        $LibroCompraVenta->setCaratula($caratula);

//        $LibroCompraVenta->generar(false); // generar XML sin firma y sin detalle
        file_put_contents(resource_path('envio_libro_venta.xml'), $LibroCompraVenta->generar(false)); // guardar XML en sistema de archivos
        $LibroCompraVenta->setFirma($Firma);

        if($track_id = $LibroCompraVenta->enviar()){
            return var_dump($track_id);
        }

        // si hubo errores mostrar
        foreach (\sasco\LibreDTE\Log::readAll() as $error)
            Log::info($error);

        return 'fail';
    }


}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// Importamos la clase p_country donde se encuentran los atributos de los paises
use App\Models\p_country; 

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $countries = [
            ["name" => "Afganistán", "nomenclature" => "AF"],
            ["name" => "Albania", "nomenclature" => "AL"],
            ["name" => "Alemania", "nomenclature" => "DE"],
            ["name" => "Andorra", "nomenclature" => "AD"],
            ["name" => "Angola", "nomenclature" => "AO"],
            ["name" => "Anguila", "nomenclature" => "AI"],
            ["name" => "Antártida", "nomenclature" => "AQ"],
            ["name" => "Antigua y Barbuda",	"nomenclature" => "AG"],
            ["name" => "Arabia Saudita", "nomenclature" => "SA"],
            ["name" => "Argelia", "nomenclature" => "DZ"],
            ["name" => "Argentina",	"nomenclature" => "AR"],
            ["name" => "Armenia", "nomenclature" => "AM"],
            ["name" => "Aruba",	"nomenclature" => "AW"],
            ["name" => "Australia",	"nomenclature" => "AU"],
            ["name" => "Austria", "nomenclature" => "AT"],
            ["name" => "Azerbaiyán", "nomenclature" => "AZ"],
            ["name" => "Bélgica", "nomenclature" => "BE"],
            ["name" => "Bahamas", "nomenclature" => "BS"],
            ["name" => "Bahrein", "nomenclature" => "BH"],
            ["name" => "Bangladesh", "nomenclature" => "BD"],
            ["name" => "Barbados", "nomenclature" => "BB"],
            ["name" => "Belice", "nomenclature" => "BZ"],
            ["name" => "Benín",	"nomenclature" => "BJ"],
            ["name" => "Bhután", "nomenclature" => "BT"],
            ["name" => "Bielorrusia", "nomenclature" => "BY"],
            ["name" => "Birmania", "nomenclature" => "MM"],
            ["name" => "Bolivia", "nomenclature" => "BO"],
            ["name" => "Bosnia y Herzegovina", "nomenclature" => "BA"],
            ["name" => "Botsuana", "nomenclature" => "BW"],
            ["name" => "Brasil", "nomenclature" => "BR"],
            ["name" => "Brunéi", "nomenclature" => "BN"],
            ["name" => "Bulgaria", "nomenclature" => "BG"],
            ["name" => "Burkina Faso", "nomenclature" => "BF"],
            ["name" => "Burundi", "nomenclature" => "BI"],
            ["name" => "Cabo Verde", "nomenclature" => "CV"],
            ["name" => "Camboya", "nomenclature" => "KH"],
            ["name" => "Camerún", "nomenclature" => "CM"],
            ["name" => "Canadá", "nomenclature" => "CA"],
            ["name" => "Chad", "nomenclature" => "TD"],
            ["name" => "Chile",	"nomenclature" => "CL"],
            ["name" => "China",	"nomenclature" => "CN"],
            ["name" => "Chipre", "nomenclature" => "CY"],
            ["name" => "Ciudad del Vaticano", "nomenclature" => "VA"],
            ["name" => "Colombia", "nomenclature" => "CO"],
            ["name" => "Comoras", "nomenclature" => "KM"],
            ["name" => "República del Congo", "nomenclature" => "CG"],
            ["name" => "República Democrática del Congo", "nomenclature" => "CD"],
            ["name" => "Corea del Norte", "nomenclature" => "KP"],
            ["name" => "Corea del Sur",	"nomenclature" => "KR"],
            ["name" => "Costa de Marfil", "nomenclature" => "CI"],
            ["name" => "Costa Rica", "nomenclature" => "CR"],
            ["name" => "Croacia", "nomenclature" => "HR"],
            ["name" => "Cuba", "nomenclature" => "CU"],
            ["name" => "Curazao", "nomenclature" => "CW"],
            ["name" => "Dinamarca",	"nomenclature" => "DK"],
            ["name" => "Dominica", "nomenclature" => "DM"],
            ["name" => "Ecuador", "nomenclature" => "EC"],
            ["name" => "Egipto", "nomenclature" => "EG"],
            ["name" => "El Salvador", "nomenclature" => "SV"],
            ["name" => "Emiratos Árabes Unidos", "nomenclature" => "AE"],
            ["name" => "Eritrea", "nomenclature" => "ER"],
            ["name" => "Eslovaquia", "nomenclature" => "SK"],
            ["name" => "Eslovenia",	"nomenclature" => "SI"],
            ["name" => "España", "nomenclature" => "ES"],
            ["name" => "Estados Unidos de América",	"nomenclature" => "US"],
            ["name" => "Estonia", "nomenclature" => "EE"],
            ["name" => "Etiopía", "nomenclature" => "ET"],
            ["name" => "Filipinas",	"nomenclature" => "PH"],
            ["name" => "Finlandia",	"nomenclature" => "FI"],
            ["name" => "Fiyi", "nomenclature" => "FJ"],
            ["name" => "Francia", "nomenclature" => "FR"],
            ["name" => "Gabón",	"nomenclature" => "GA"],
            ["name" => "Gambia", "nomenclature" => "GM"],
            ["name" => "Georgia", "nomenclature" => "GE"],
            ["name" => "Ghana",	"nomenclature" => "GH"],
            ["name" => "Gibraltar",	"nomenclature" => "GI"],
            ["name" => "Granada", "nomenclature" => "GD"],
            ["name" => "Grecia", "nomenclature" => "GR"],
            ["name" => "Groenlandia", "nomenclature" => "GL"],
            ["name" => "Guadalupe",	"nomenclature" => "GP"],
            ["name" => "Guam", "nomenclature" => "GU"],
            ["name" => "Guatemala",	"nomenclature" => "GT"],
            ["name" => "Guayana Francesa", "nomenclature" => "GF"],
            ["name" => "Guernsey", "nomenclature" => "GG"],
            ["name" => "Guinea", "nomenclature" => "GN"],
            ["name" => "Guinea Ecuatorial",	"nomenclature" => "GQ"],
            ["name" => "Guinea-Bissau",	"nomenclature" => "GW"],
            ["name" => "Guyana", "nomenclature" => "GY"],
            ["name" => "Haití",	"nomenclature" => "HT"],
            ["name" => "Honduras", "nomenclature" => "HN"],
            ["name" => "Hong kong",	"nomenclature" => "HK"],
            ["name" => "Hungría", "nomenclature" => "HU"],
            ["name" => "India",	"nomenclature" => "IN"],
            ["name" => "Indonesia",	"nomenclature" => "ID"],
            ["name" => "Irán", "nomenclature" => "IR"],
            ["name" => "Irak", "nomenclature" => "IQ"],
            ["name" => "Irlanda", "nomenclature" => "IE"],
            ["name" => "Isla Bouvet", "nomenclature" => "BV"],
            ["name" => "Isla de Man", "nomenclature" => "IM"],
            ["name" => "Isla de Navidad", "nomenclature" => "CX"],
            ["name" => "Isla Norfolk", "nomenclature" => "NF"],
            ["name" => "Islandia", "nomenclature" => "IS"],
            ["name" => "Islas Bermudas", "nomenclature" => "BM"],
            ["name" => "Islas Caimán", "nomenclature" => "KY"],
            ["name" => "Islas Cocos (Keeling)",	"nomenclature" => "CC"],
            ["name" => "Islas Cook", "nomenclature" => "CK"],
            ["name" => "Islas de Åland", "nomenclature" => "AX"],
            ["name" => "Islas Feroe", "nomenclature" => "FO"],
            ["name" => "Islas Georgias del Sur y Sandwich del Sur",	"nomenclature" => "GS"],
            ["name" => "Islas Heard y McDonald", "nomenclature" => "HM"],
            ["name" => "Islas Maldivas", "nomenclature" => "MV"],
            ["name" => "Islas Malvinas", "nomenclature" => "FK"],
            ["name" => "Islas Marianas del Norte", "nomenclature" => "MP"],
            ["name" => "Islas Marshall", "nomenclature" => "MH"],
            ["name" => "Islas Pitcairn", "nomenclature" => "PN"],
            ["name" => "Islas Salomón",	"nomenclature" => "SB"],
            ["name" => "Islas Turcas y Caicos",	"nomenclature" => "TC"],
            ["name" => "Islas Ultramarinas Menores de Estados Unidos", "nomenclature" => "UM"],
            ["name" => "Islas Vírgenes Británicas",	"nomenclature" => "VG"],
            ["name" => "Islas Vírgenes de los Estados Unidos",	"nomenclature" => "VI"],
            ["name" => "Israel", "nomenclature" => "IL"],
            ["name" => "Italia", "nomenclature" => "IT"],
            ["name" => "Jamaica", "nomenclature" => "JM"],
            ["name" => "Japón",	"nomenclature" => "JP"],
            ["name" => "Jersey", "nomenclature" => "JE"],
            ["name" => "Jordania", "nomenclature" => "JO"],
            ["name" => "Kazajistán", "nomenclature" => "KZ"],
            ["name" => "Kenia",	"nomenclature" => "KE"],
            ["name" => "Kirguistán", "nomenclature" => "KG"],
            ["name" => "Kiribati", "nomenclature" => "KI"],
            ["name" => "Kuwait", "nomenclature" => "KW"],
            ["name" => "Líbano", "nomenclature" => "LB"],
            ["name" => "Laos", "nomenclature" => "LA"],
            ["name" => "Lesoto", "nomenclature" => "LS"],
            ["name" => "Letonia", "nomenclature" => "LV"],
            ["name" => "Liberia", "nomenclature" => "LR"],
            ["name" => "Libia",	"nomenclature" => "LY"],
            ["name" => "Liechtenstein",	"nomenclature" => "LI"],
            ["name" => "Lituania", "nomenclature" => "LT"],
            ["name" => "Luxemburgo", "nomenclature" => "LU"],
            ["name" => "México", "nomenclature" => "MX"],
            ["name" => "Mónaco", "nomenclature" => "MC"],
            ["name" => "Macao",	"nomenclature" => "MO"],
            ["name" => "Macedônia",	"nomenclature" => "MK"],
            ["name" => "Madagascar", "nomenclature" => "MG"],
            ["name" => "Malasia", "nomenclature" => "MY"],
            ["name" => "Malawi", "nomenclature" => "MW"],
            ["name" => "Mali",	"nomenclature" => "ML"],
            ["name" => "Malta",	"nomenclature" => "MT"],
            ["name" => "Marruecos",	"nomenclature" => "MA"],
            ["name" => "Martinica",	"nomenclature" => "MQ"],
            ["name" => "Mauricio", "nomenclature" => "MU"],
            ["name" => "Mauritania", "nomenclature" => "MR"],
            ["name" => "Mayotte", "nomenclature" => "YT"],
            ["name" => "Micronesia", "nomenclature" => "FM"],
            ["name" => "Moldavia", "nomenclature" => "MD"],
            ["name" => "Mongolia", "nomenclature" => "MN"],
            ["name" => "Montenegro", "nomenclature" => "ME"],
            ["name" => "Montserrat", "nomenclature" => "MS"],
            ["name" => "Mozambique", "nomenclature" => "MZ"],
            ["name" => "Namibia", "nomenclature" => "NA"],
            ["name" => "Nauru",	"nomenclature" => "NR"],
            ["name" => "Nepal",	"nomenclature" => "NP"],
            ["name" => "Nicaragua",	"nomenclature" => "NI"],
            ["name" => "Niger",	"nomenclature" => "NE"],
            ["name" => "Nigeria", "nomenclature" => "NG"],
            ["name" => "Niue",	"nomenclature" => "NU"],
            ["name" => "Noruega", "nomenclature" => "NO"],
            ["name" => "Nueva Caledonia", "nomenclature" => "NC"],
            ["name" => "Nueva Zelanda",	"nomenclature" => "NZ"],
            ["name" => "Omán", "nomenclature" => "OM"],
            ["name" => "Países Bajos", "nomenclature" => "NL"],
            ["name" => "Pakistán", "nomenclature" => "PK"],
            ["name" => "Palau",	"nomenclature" => "PW"],
            ["name" => "Palestina",	"nomenclature" => "PS"],
            ["name" => "Panamá", "nomenclature" => "PA"],
            ["name" => "Papúa Nueva Guinea", "nomenclature" => "PG"],
            ["name" => "Paraguay", "nomenclature" => "PY"],
            ["name" => "Perú", "nomenclature" => "PE"],
            ["name" => "Polinesia Francesa", "nomenclature" => "PF"],
            ["name" => "Polonia", "nomenclature" => "PL"],
            ["name" => "Portugal", "nomenclature" => "PT"],
            ["name" => "Puerto Rico", "nomenclature" => "PR"],
            ["name" => "Qatar",	"nomenclature" => "QA"],
            ["name" => "Reino Unido", "nomenclature" => "GB"],
            ["name" => "República Centroafricana", "nomenclature" => "CF"],
            ["name" => "República Checa", "nomenclature" => "CZ"],
            ["name" => "República Dominicana", "nomenclature" => "DO"],
            ["name" => "República de Sudán del Sur", "nomenclature" => "SS"],
            ["name" => "Reunión", "nomenclature" => "RE"],
            ["name" => "Ruanda", "nomenclature" => "RW"],
            ["name" => "Rumanía", "nomenclature" => "RO"],
            ["name" => "Rusia",	"nomenclature" => "RU"],
            ["name" => "Sahara Occidental",	"nomenclature" => "EH"],
            ["name" => "Samoa",	"nomenclature" => "WS"],
            ["name" => "Samoa Americana", "nomenclature" => "AS"],
            ["name" => "San Bartolomé",	"nomenclature" => "BL"],
            ["name" => "San Cristóbal y Nieves", "nomenclature" => "KN"],
            ["name" => "San Marino", "nomenclature" => "SM"],
            ["name" => "San Martín (Francia)", "nomenclature" => "MF"],
            ["name" => "San Pedro y Miquelón", "nomenclature" => "PM"],
            ["name" => "San Vicente y las Granadinas",	"nomenclature" => "VC"],
            ["name" => "Santa Elena", "nomenclature" => "SH"],
            ["name" => "Santa Lucía", "nomenclature" => "LC"],
            ["name" => "Santo Tomé y Príncipe",	"nomenclature" => "ST"],
            ["name" => "Senegal", "nomenclature" => "SN"],
            ["name" => "Serbia", "nomenclature" => "RS"],
            ["name" => "Seychelles", "nomenclature" => "SC"],
            ["name" => "Sierra Leona", "nomenclature" => "SL"],
            ["name" => "Singapur", "nomenclature" => "SG"],
            ["name" => "Sint Maarten", "nomenclature" => "SX"],
            ["name" => "Siria",	"nomenclature" => "SY"],
            ["name" => "Somalia", "nomenclature" => "SO"],
            ["name" => "Sri lanka",	"nomenclature" => "LK"],
            ["name" => "Sudáfrica",	"nomenclature" => "ZA"],
            ["name" => "Sudán",	"nomenclature" => "SD"],
            ["name" => "Suecia", "nomenclature" => "SE"],
            ["name" => "Suiza",	"nomenclature" => "CH"],
            ["name" => "Surinám", "nomenclature" => "SR"],
            ["name" => "Svalbard y Jan Mayen", "nomenclature" => "SJ"],
            ["name" => "Swazilandia", "nomenclature" => "SZ"],
            ["name" => "Tayikistán", "nomenclature" => "TJ"],
            ["name" => "Tailandia",	"nomenclature" => "TH"],
            ["name" => "Taiwán", "nomenclature" => "TW"],
            ["name" => "Tanzania", "nomenclature" => "TZ"],
            ["name" => "Territorio Británico del Océano Índico", "nomenclature" => "IO"],
            ["name" => "Territorios Australes y Antárticas Franceses", "nomenclature" => "TF"],
            ["name" => "Timor Oriental", "nomenclature" => "TL"],
            ["name" => "Togo", "nomenclature" => "TG"],
            ["name" => "Tokelau", "nomenclature" => "TK"],
            ["name" => "Tonga",	"nomenclature" => "TO"],
            ["name" => "Trinidad y Tobago",	"nomenclature" => "TT"],
            ["name" => "Tunez",	"nomenclature" => "TN"],
            ["name" => "Turkmenistán", "nomenclature" => "TM"],
            ["name" => "Turquía", "nomenclature" => "TR"],
            ["name" => "Tuvalu", "nomenclature" => "TV"],
            ["name" => "Ucrania", "nomenclature" => "UA"],
            ["name" => "Uganda", "nomenclature" => "UG"],
            ["name" => "Uruguay", "nomenclature" => "UY"],
            ["name" => "Uzbekistán", "nomenclature" => "UZ"],
            ["name" => "Vanuatu", "nomenclature" => "VU"],
            ["name" => "Venezuela",	"nomenclature" => "VE"],
            ["name" => "Vietnam", "nomenclature" => "VN"],
            ["name" => "Wallis y Futuna", "nomenclature" => "WF"],
            ["name" => "Yemen",	"nomenclature" => "YE"],
            ["name" => "Yibuti", "nomenclature" => "DJ"],
            ["name" => "Zambia", "nomenclature" => "ZM"],
            ["name" => "Zimbabue", "nomenclature" => "ZW"]
        ];

        foreach ($countries as $country){
            
            p_country::create($country);
        }     
    }
}
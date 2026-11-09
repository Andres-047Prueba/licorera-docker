<?php
declare (strict_types = 1);

class ob {
    public string $nombre;
    public  int $precio;
    public $imagen;

    public function __construct(String $nombre,int $precio,$imagen) {
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->imagen = $imagen;
    }
}

$ob1 = new ob("Vino espumoso Prosecco Zonin ", 116900, imagen: "imgs/vino-espumoso-prosecco-zonin-botella-750ml.jpeg");
$ob3 = new ob("Vino las Moras Malbec ", 57900, imagen: "imgs/vino-las-moras-malbec-botella-750ml.jpeg");
$ob4 = new ob("Vino Manischewitz de Uva", 75500, imagen: "imgs/vino-manischewitz-de-uva-botella-750ml.jpeg");
$ob5 = new ob("Vino sanson Botella", 28900, imagen: "imgs/vino-sanson-botella-750ml.jpeg");
$ob6 = new ob("Ginebra Bombay Sapphire",149100, imagen: "imgs/ginebra-bombay-sapphire.jpeg");
$ob7 = new ob("Ginebra Gordon´s London",87900, imagen: "imgs/ginebra-gordon-s-london.jpeg");
$ob8 = new ob("Ginebra Hendrick´s", 30700, imagen: "imgs/ginebra-hendrick-s.jpeg");
$ob9 = new ob("Ginebra Shipper Litro",59900, imagen: "imgs/ginebra-shipper-litro.jpeg");
$ob10 = new ob("Ginebra Tanqueray",286900, imagen: "imgs/ginebra-tanqueray.jpeg");
$ob11 = new ob("Whiskey Jack Daniel´s",126900, imagen: "imgs/whiskey-jack-daniel-s.jpeg");
$ob12 = new ob("Whisky Buchanan´s Special",107900, imagen: "imgs/whisky-buchanan-s-special-reserve-18-anos-botella-750ml.jpeg");
$ob13 = new ob("Whisky Buchanas´s Dulexe", 200900, imagen: "imgs/whisky-buchanas-s-dulexe-12-anos-litro-1l.jpeg");
$ob15 = new ob("Wiskey Somethin Special",93900, imagen: "imgs/wiskey-somethin-special.jpeg");
$ob16 = new ob("Ron Defensor Style 12 Años",225000, imagen: "imgs/ron-defensor-style-12-anos-700ml.jpeg");
$ob17 = new ob("Ron la hechicera Botella",249900, imagen: "imgs/ron-la-hechicera-botella-700ml.jpeg");
$ob18 = new ob("Ron Medellin Gran Solera",215900, imagen: "imgs/ron-medellin-gran-solera-19-anos-botella-750ml.jpeg");
$ob19 = new ob("Ron viejo de caldas 12 años",99900, imagen: "imgs/ron-medellin-8-anos-extra-botella-750ml.jpeg");
$ob20 = new ob("Ron viejo de caldas 8 años",47900, imagen: "imgs/ron-viejo-de-caldas-8-anos-carta-de-oro-mediana-375ml.jpeg");
$ob21 = new ob("Tequila Bestia Blanco",79900, imagen: "imgs/tequila-bestia-blanco.jpeg");
$ob22 = new ob("Tequila Don Julio 70",445900, imagen: "imgs/tequila-don-julio-70-botella-700ml.jpeg");
$ob23 = new ob("Tequila 1800 Silver Botella",210000, imagen: "imgs/tequila-1800-silver-botella.jpeg");
$ob24 = new ob("Tequila Don Julio 1942 Botella",1389900, imagen: "imgs/tequila-don-julio-1942-botella-700ml.jpeg");
$ob25 = new ob("Tequila Patron Añejo Botella",324900, imagen: "imgs/tequila-patron-anejo-botella.jpeg");
$ob26 = new ob("Cerveza Aguila Original", 2900, imagen: "imgs/cerveza-aguila-original.jpeg");
$ob27 = new ob("Cerveza Club Colombia Negra", 2900, imagen: "imgs/cerveza-club-colombia-negra.jpeg");
$ob28 = new ob("Cerveza Club Colombia Roja",3000, imagen: "imgs/cerveza-club-colombia-roja.jpeg");
$ob29 = new ob("Cerveza Pilsen", 3600, imagen: "imgs/cerveza-pilsen.jpeg");
$ob30 = new ob("Cerveza Poker", 3900, imagen: "imgs/cerveza-poker.jpeg");
$ob31 = new ob("Cerveza Redds Lata", 3600, imagen: "imgs/cerveza-redds-lata.jpeg");
$ob32 = new ob("Absolut Raspberry", 99900, imagen: "imgs/absolut-raspberry.jpg");
$ob33 = new ob("Absolut Vodka", 89900, imagen: "imgs/absolut-vodka.jpg");
$ob34 = new ob("Smirnoff Red Label", 99200, imagen: "imgs/smirnoff-red-label.jpg");
$ob35 = new ob("smirnoff-black-vodka",100000, imagen: "imgs/smirnoff-black-vodka.jpg");
$ob36 = new ob("Carton Medio Cigarrillo",96900, imagen: "imgs/carton-medio-cigarrillo.jpeg");
$ob37 = new ob("Cigarrilo Chesterfild Green",10900, imagen: "imgs/cigarrilo-chesterfild-green.jpeg");

require "pagina.php";
require "chatbot.php";
?>
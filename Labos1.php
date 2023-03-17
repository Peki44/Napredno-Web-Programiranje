<!DOCTYPE html>
<html lang="en">
<head>
    <title>Napredno Web Programiranje-LV1</title>
</head>
<body>
<?php

interface iRadovi{
    public function create($data);
    public function save();
    public function read();

}

class DiplomskiRadovi implements iRadovi{
    private $id=NULL;
    private $naziv_rada = NULL;
    private $tekst_rada = NULL;
    private $link_rada = NULL;
    private $oib_tvrtke = NULL;

    function __construct($data){
        $this->id=uniqid();
        $this->naziv_rada=$data['naziv_rada'];
        $this->tekst_rada=$data['tekst_rada'];
        $this->link_rada = $data['link_rada'];
        $this->oib_tvrtke = $data['oib_tvrtke'];

    }

    function readDiplRadData() {
        return array('id' => $this->id, 'naziv_rada' => $this->naziv_rada, 'tekst_rada' => $this->tekst_rada, 'link_rada' => $this->link_rada, 'oib_tvrtke' => $this->oib_tvrtke);
    }
    function create($data){
        self::__construct($data);
    }
    function save(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "radovi";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $id = $this->id;
        $naziv = $this->naziv_rada;
        $tekst = $this->tekst_rada;
        $link = $this->link_rada;
        $oib = $this->oib_tvrtke;

        $sql="INSERT INTO 'diplomski_radovi'('id', 'naziv_rada', 'tekst_rada', 'link_rada', 'oib_tvrtke') VALUES ('$id', '$naziv', '$tekst','$link', '$oib')";
        $conn->close();
    }
    function read(){
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "radovi";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT * FROM diplomski_radovi";
        $result = $conn->query($sql);
        $dipl_radovi = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $conn->close();
    }

}
require_once 'simple_html_dom.php';
$html=new simple_html_dom();
for($redni_broj=2;$redni_broj<=6;$redni_broj++){
    
}
$html->load_file('https://stup.ferit.hr/index.php/zavrsni-radovi/page/2');
foreach($html->find('article')as $article){
    foreach($article->find('h2.entry-title a[href]')as $allLink){
        $allText=new simple_html_dom();
        $allText->load_file($allLink->href);
        foreach($allText->find('div.post-content') as $text) {

        }
    }
    
    foreach($article->find('img')as $img){

    }
    $rad = array(
        'naziv_rada' => $allLink->plaintext,
        'tekst_rada' => $text->plaintext,
        'link_rada' => $allLink->href,
        'oib_tvrtke' => preg_replace('/[^0-9]/', '', $img->src)
    );
 
    $novi_rad = new DiplomskiRadovi($rad);
    $info_rad = $novi_rad->readDiplRadData();

    echo "<p>NAZIV RADA: {$info_rad['naziv_rada']}.</p>";
    echo "<p>TEKST RADA: {$info_rad['tekst_rada']}.</p>";
    echo "<p>LINK RADA: {$info_rad['link_rada']}.</p>";
    echo "<p>OIB TVRTKE: {$info_rad['oib_tvrtke']}.</p><br><br>";
    
    $novi_rad->save();
}
?>
</body>
</html>
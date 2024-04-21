<?php
session_start();
require("includes/dbconnect.php");

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["addToCart"])) {
    include "includes/addToCart.php";
}
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <title>D&D Alkohol Webshop</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/beer.svg">
</head>

<body>
    <div class="container">
        <header>
            <nav id="navbar">
                <ul>
                    <li><a href="index.php"><img src="img/beer.svg" alt="home-nav-img" height="48" id="home-head-img"></a>
                    <li><a href="index.php">Főoldal</a></li>
                    <li><a href="store.php">Ajánlataink</a></li>
                    <?php
                    if (isset($_SESSION["username"])) {
                        echo '<li><a href="cart.php">Kosár</a></li>';
                        echo '<li><a href="profile.php">Profil</a></li>';
                        echo '<li><a href="includes/logout.php">Kijelentkezés</a></li>';
                    } else {
                        echo '<li><a href="login.php">Bejelentkezés</a></li>';
                        echo '<li><a href="register.php">Regisztráció</a></li>';
                    }
                    ?>
                    <li><a href="" hidden>Admin felület</a></li>
                </ul>
            </nav>
        </header>
        <img src="img/headeralgohol.png" alt="hehealgoholxdd" id="home-header-img">
        <div id="home-divis">
            Tekintse meg ajánlatainkat
        </div>
        <main>
            <div id="store-body">
                <div id="store-body-top">
                    <h1>Ajánlataink</h1>
                </div>
                <div id="store-body-block">
                    <div id="product-type">
                        <ul id="store-left-nav">
                            <li data-category="Sör">Sör</li>
                            <li data-category="Bor">Bor</li>
                            <li data-category="Energia ital">Energia ital</li>
                            <li data-category="Üditő">Üditő</li>
                            <li data-category="Whiskey">Whiskey</li>
                            <li data-category="Likőr">Likőr</li>
                        </ul>
                    </div>
                    <div class="product-container">
                        <?php
                            include("includes/listStoreProducts.php");
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <footer>
        <div id="home-foot">
            <div id="projects">
                <h1>Projektjeink</h1>
                <hr>
                <p>
                    <span>Projekt azonosító száma: XDHEHE-4.1.3-5-6-7-16-2077-00314</span> <br>
                    <span>Kedvezményezett neve: D&D 2077 Kereskedelmi Kft.</span> <br>
                    <span>A projekt címe: D&D 2077 Kft. Közlekedés igazgatás az ittasok részére</span> <br>
                    <span>Szerződött támogatás összege: 56 001 315 Ft (2 Eur)</span> <br>
                    <span>Támogatás mértéke: 67%</span> <br>
                    <span>Kölcsön összege: 61 538 610 Ft</span> <br>
                    <span>Kölcsön mértéke: 50%</span> <br>
                    <span>Támogatói okirat hatályba lépése: 2001.09.11.</span> <br>
                </p>
            </div>
            <div id="shops">
                <h1>Üzleteink</h1>
                <div class="mapouter">
                    <div class="gmap_canvas"><iframe class="gmap_iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2762.1922781810617!2d20.425186176754117!3d46.186732284940526!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4744f5a30a864c6f%3A0x97db94adfc72df14!2zUsOzbmF5LW1hZ3TDoXI!5e0!3m2!1shu!2shu!4v1711295763471!5m2!1shu!2shu" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe><a href="https://strandsgame.net/">Strands</a></div>
                </div>
            </div>
            <div id="connections">
                <h1>Kapcsolat</h1>
                <div class="overlay">
                    <div id="conn-wrp">
                        <div id="conn-left">
                            <span>HA ITAL KELL D&D</span> <br>
                            <span>(30) 123-4567</span> <br>
                            <span>(30) 987-6543</span> <br>
                            <span>kapcsolat@d&d.hu</span> <br>
                            <span>fb.com/d&d.aruhaz</span> <br>
                            <span>Kiszombor</span> <br>
                            <span>Rónay-magtár</span>
                        </div>
                        <div id="conn-right">
                            <span>Ha kérdése van, kérjük, vegye fel velünk a kapcsolatot az alábbi elérhetőségek
                                valamelyikén:</span> <br>
                            <span>Telefonszám: +81 8317-3012 </span> <br>
                            <span>E-mail: info@d&d.hu</span> <br>
                            <span>Ügyfélszolgálat nyitvatartása: Hétfőtől péntekig, 9:00 - 17:00 között</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="script.js"></script>
</body>

</html>
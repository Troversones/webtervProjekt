<!DOCTYPE html>
<html lang="hu">

<head>
    <title>D&D Alkohol Webshop</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/beer.svg">
    <script src="script.js"></script>
</head>

<body>
    <div class="container">
        <header>
            <nav id="navbar">
                <ul>
                    <li><a href="index.php"><img src="img/beer.svg" alt="homehead-img" height="48"
                                id="home-head-img"></a>
                    <li><a href="index.php">Főoldal</a></li>
                    <li><a href="store.php">Ajánlataink</a></li>
                    <li><a href="cart.php">Kosár</a></li>
                    <li><a href="profile.php">Profil</a></li>
                    <li><a href="login.php">Bejelentkezés</a></li>
                    <li><a href="register.php">Regisztráció</a></li>
                    <li><a href="" hidden>Admin felület</a></li>
                </ul>
            </nav>
        </header>
        <div id="home-divis" class="highlight-text">
            //Ez egy vizszintes vonallal válassza el a header-t a body-tól
        </div>
        <main>
            <div id="profile">
                <h1>Üdvözlünk Peldanev!</h1>

                <div id="profiledata">
                    <h2>Adatok</h2>
                    <p>E-mail cím: <span>pelda@peldamail.hu</span></p>
                    <p>Szállítási cím: <span>Deszk, Papír utca 12</span></p>
                    <p>Számlázási cím: <span>Azonos a szállítási címmel</span></p>
                    <p>Kuponkód: <span>ALGOHÓL (15% kedvezmény)</span></p>
                    <p>Fizetési mód:
                        <select name="paymethod" id="paymethod">
                            <option value="card">Bankkártya</option>
                            <option value="cash">Készpénz</option>
                            <option value="szep">Szépkártya</option>
                        </select>
                    </p>
                </div>
                <div id="options">
                    <form action="POST">
                        <h2>Jelszó módosítása</h2>
                        <label for="prevpwd">Régi jelszó</label>
                        <input type="password" name="prevpwd" id="prevpwd" placeholder="Régi jelszó">
                        <label for="newvpwd">Új jelszó</label>
                        <input type="password" name="newvpwd" id="newvpwd" placeholder="Új jelszó">
                        <br>
                        <input type="submit" value="Új jelszó beállítása">
                    </form>
                    <form action="POST">
                        <h2>Email módosítása</h2>
                        <label>Régi email</label>
                        <span>pelda@peldamail.hu</span>
                        <label for="newemail">Új email</label>
                        <input type="email" name="newemail" id="newemail" placeholder="Új email">
                        <br>
                        <input type="submit" value="Új email beállítása">
                    </form>
                </div>
            </div>
        </main>
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
                        <div class="gmap_canvas"><iframe class="gmap_iframe"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2762.1922781810617!2d20.425186176754117!3d46.186732284940526!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4744f5a30a864c6f%3A0x97db94adfc72df14!2zUsOzbmF5LW1hZ3TDoXI!5e0!3m2!1shu!2shu!4v1711295763471!5m2!1shu!2shu"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe><a
                                href="https://strandsgame.net/">Strands</a></div>
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
    </div>

</body>

</html>
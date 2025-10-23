<?php
session_start();

// Generate CSRF token
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Simple language handling
$lang = isset($_GET['lang']) ? $_GET['lang'] : (isset($_SESSION['lang']) ? $_SESSION['lang'] : 'de');
$_SESSION['lang'] = $lang;

// Language arrays
$texts = [
    'de' => [
        'title' => 'EWI - Waagenbau und Industrieelektronik GmbH',
        'nav_home' => 'Startseite',
        'nav_profile' => 'Profil',
        'nav_services' => 'Leistungen',
        'nav_references' => 'Referenzen',
        'nav_jobs' => 'Jobs',
        'nav_contact' => 'Kontakt',
        'nav_impressum' => 'Impressum',
        'nav_agb' => 'AGB',
        'hero_title' => 'EWI - Waagenbau und Industrieelektronik GmbH',
        'hero_subtitle' => 'International tätiger Anbieter von Engineering- und technischen Dienstleistungen in der Automatisierungstechnik',
        'about_title' => 'Profil',
        'about_quote' => '"Vieles haben die geleistet, die vor uns gewesen sind, aber sie haben es nicht zu Ende geleistet" (Seneca)',
        'about_text' => 'Aus der im Jahre 1991 gegründeten GbR Waagenbau und Industrieelektronik entstand am 24. Mai 1995 unsere heutige Firma: EWI - Waagenbau und Industrieelektronik GmbH<br><br>Das Unternehmen entwickelte sich in dieser Zeit von einer regionalen Waagenbaufirma zu einem international tätigen Anbieter von Engineering- und technischen Dienstleistungen in der Automatisierungstechnik.',
        'services_title' => 'Leistungen',
        'services_quote' => '"Von der Zukunft hängt ab, wer nicht versteht in der Gegenwart zu wirken" (Seneca)',
        'services_text' => 'Zuverlässige, Richtungsweisende Industriemontagen-Steuerung auf höchstem technischem Niveau in der Automatisierungstechnik bilden den Schwerpunkt unserer Firma. Um die Wünsche und Bedürfnisse unserer Kunden an den heutigen Markt anzupassen, erfordert es von uns nicht nur eine hohe Flexibilität, sondern auch ein breit gefächertes Convolute an Dienstleistungsangeboten z.B.:',
        'service1' => 'Projektierung, Programmierung und Inbetriebnahme von Industriesteuerungen',
        'service2' => 'Installation (elektrisch und mechanisch) von Förderanlagen',
        'service3' => 'Bau und Installation von Schaltschränken',
        'service4' => 'Sonderkonstruktionen für die Wägetechnik',
        'references_title' => 'Referenzen',
        'references_text' => 'Durch unsere fundierten Kenntnisse in der Automatisierungstechnik konnten wir bereits folgende Projekte in Zusammenarbeit mit unseren Auftraggebern weltweit erfolgreich abschließen.',
        'jobs_title' => 'Jobs',
        'jobs_text' => 'In unserem Unternehmen sind aktuell folgende Positionen zu besetzen.<br>Wir suchen:<br>- Elektromonteure<br>- Mechatroniker<br>- Elektroniker<br>- Industriemechaniker<br><br>Bitte bewerben Sie sich mit den üblichen Unterlagen.<br><br>Wir freuen uns auf Ihre Bewerbung!',
        'contact_title' => 'Kontakt',
        'contact_company' => 'EWI Waagenbau & Industrieelektronik GmbH',
        'contact_address' => 'Breitscheid Str. 57<br>16225 Eberswalde',
        'contact_phone' => 'Tel.: 0 33 34 / 42 06 75',
        'contact_fax' => 'Fax: 0 33 34 / 42 07 45',
        'contact_web' => 'www.ewi-britz.de',
        'contact_email' => 'EWI-Britz@t-online.de',
        'contact_management_title' => 'Ansprechpartner',
        'contact_manager_title' => 'Geschäftsführer:',
        'contact_manager_name' => 'Herr Thomas Witt',
        'contact_software_title' => 'Softwarelösung:',
        'contact_software_name' => 'Dip.-Ing. Karsten Ucke',
        'contact_secretary_title' => 'Sekretariat:',
        'contact_secretary_name' => 'Frau Undine Ballentin',
        'impressum_company' => 'EWI Waagenbau & Industrieelektronik GmbH',
        'impressum_address' => 'Breitscheid Str. 57, 16225 Eberswalde',
        'impressum_manager' => 'Geschäftsführer: Thomas Witt',
        'impressum_phone' => 'Tel.: +49 33 34 · 42 06 75',
        'impressum_fax' => 'Fax: +49 33 34 · 42 07 45',
        'impressum_email' => 'E-Mail: EWI-Britz@t-online.de',
        'impressum_register' => 'Registergericht: Amtsgericht Frankfurt/Oder HRB 4868',
        'impressum_tax' => 'Steuernummer: 065 108 009 48',
        'impressum_liability_title' => 'Haftung',
        'impressum_liability_text' => 'Diese Website wurde mit größtmöglicher Sorgfalt zusammengestellt. Trotzdem kann keine Gewähr für die Fehlerfreiheit und Genauigkeit der enthaltenen Informationen übernommen werden. Jegliche Haftung für Schäden, die direkt oder indirekt aus der Benutzung dieser Website entstehen, wird ausgeschlossen, soweit diese nicht auf Vorsatz oder grober Fahrlässigkeit beruhen. Sofern von dieser Website auf Internetseiten verwiesen wird, die von Dritten betrieben werden, übernimmt die EWI GmbH keine Verantwortung für deren Inhalte.',
        'footer_text' => '© ' . date('Y') . ' EWI - Waagenbau und Industrieelektronik GmbH. Alle Rechte vorbehalten.'
    ],
    'en' => [
        'title' => 'EWI - Weighing Technology and Industrial Electronics GmbH',
        'nav_home' => 'Home',
        'nav_profile' => 'Profile',
        'nav_services' => 'Services',
        'nav_references' => 'References',
        'nav_jobs' => 'Jobs',
        'nav_contact' => 'Contact',
        'nav_impressum' => 'Legal Notice',
        'nav_agb' => 'Terms',
        'hero_title' => 'EWI - Waagenbau und Industrieelektronik GmbH',
        'hero_subtitle' => 'International provider of engineering and technical services in automation technology',
        'about_title' => 'Profile',
        'about_quote' => '"Many have achieved things before us, but they have not brought them to completion" (Seneca)',
        'about_text' => 'From the GbR Weighing Technology and Industrial Electronics founded in 1991, our current company was established on May 24, 1995: EWI - Weighing Technology and Industrial Electronics GmbH<br><br>The company has developed from a regional weighing technology company to an internationally active provider of engineering and technical services in automation technology.',
        'services_title' => 'Services',
        'services_quote' => '"The future depends on who does not understand how to act in the present" (Seneca)',
        'services_text' => 'Reliable, forward-looking industrial assembly control at the highest technical level in automation technology forms the focus of our company. To adapt the wishes and needs of our customers to today\'s market, we require not only high flexibility, but also a broad range of service offerings, e.g.:',
        'service1' => 'Project planning, programming and commissioning of industrial controls',
        'service2' => 'Installation (electrical and mechanical) of conveyor systems',
        'service3' => 'Construction and installation of control cabinets',
        'service4' => 'Special constructions for weighing technology',
        'references_title' => 'References',
        'references_text' => 'Through our solid knowledge in automation technology, we have successfully completed the following projects in cooperation with our clients worldwide.',
        'jobs_title' => 'Jobs',
        'jobs_text' => 'The following positions are currently available in our company.<br>We are looking for:<br>- Electrical fitters<br>- Mechatronics technicians<br>- Electronics technicians<br>- Industrial mechanics<br><br>Please apply with the usual documents.<br><br>We look forward to your application!',
        'contact_title' => 'Contact',
        'contact_company' => 'EWI Waagenbau & Industrieelektronik GmbH',
        'contact_address' => 'Breitscheid Str. 57, 16225 Eberswalde',
        'contact_phone' => 'Tel.: +49 33 34 / 42 06 75',
        'contact_fax' => 'Fax: +49 33 34 / 42 07 45',
        'contact_web' => 'www.ewi-britz.de',
        'contact_email' => 'EWI-Britz@t-online.de',
        'contact_management_title' => 'Contact Persons',
        'contact_manager_title' => 'Chief executive officer CEO:',
        'contact_manager_name' => 'Herr Thomas Witt',
        'contact_software_title' => 'Software Developer:',
        'contact_software_name' => 'Dip.-Ing. Karsten Ucke',
        'contact_secretary_title' => 'Executive Secretary:',
        'contact_secretary_name' => 'Frau Undine Ballentin',
        'impressum_company' => 'EWI Waagenbau & Industrieelektronik GmbH',
        'impressum_address' => 'Breitscheid Str. 57<br>16225 Eberswalde',
        'impressum_manager' => 'Chief executive officer CEO:<br>Thomas Witt',
        'impressum_phone' => 'Phone: +49 33 34 · 42 06 75',
        'impressum_fax' => 'Fax: +49 33 34 · 42 07 45',
        'impressum_email' => 'Email: EWI-Britz@t-online.de',
        'impressum_register' => 'Commercial Register: District Court Frankfurt/Oder HRB 4868',
        'impressum_tax' => 'Tax Number: 065 108 009 48',
        'impressum_liability_title' => 'Liability',
        'impressum_liability_text' => 'This website has been compiled with the greatest possible care. Nevertheless, no guarantee can be given for the accuracy and completeness of the information contained. Any liability for damages arising directly or indirectly from the use of this website is excluded, unless such damages are based on intent or gross negligence. If this website refers to websites operated by third parties, EWI GmbH assumes no responsibility for their content.',
        'footer_text' => '© ' . date('Y') . ' EWI - Weighing Technology and Industrial Electronics GmbH. All rights reserved.'
    ]
];

$t = $texts[$lang];
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $t['title']; ?></title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="fonts.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="navbar">
            <div class="nav-container">
                <div class="nav-logo">
                    <img src="images/used/logo.jpg" alt="EWI Britz Logo" class="logo">
                </div>
                
                <div class="nav-menu" id="nav-menu">
                    <a href="#home" class="nav-link"><?php echo $t['nav_home']; ?></a>
                    <a href="#profile" class="nav-link"><?php echo $t['nav_profile']; ?></a>
                    <a href="#services" class="nav-link"><?php echo $t['nav_services']; ?></a>
                    <a href="#references" class="nav-link"><?php echo $t['nav_references']; ?></a>
                    <a href="#jobs" class="nav-link"><?php echo $t['nav_jobs']; ?></a>
                    <a href="#contact" class="nav-link"><?php echo $t['nav_contact']; ?></a>
                </div>
                
                <div class="nav-actions">
                    <div class="language-switcher">
                        <a href="?lang=de" class="lang-btn <?php echo $lang === 'de' ? 'active' : ''; ?>">DE</a>
                        <a href="?lang=en" class="lang-btn <?php echo $lang === 'en' ? 'active' : ''; ?>">EN</a>
                    </div>
                    <button class="nav-toggle" id="nav-toggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <h1 class="hero-title"><?php echo $t['hero_title']; ?></h1>
                <p class="hero-subtitle"><?php echo $t['hero_subtitle']; ?></p>

                <button class="cta-button" onclick="scrollToSection('contact')"><?php echo $t['nav_contact']; ?></button>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="profile" class="about">
        <div class="container">
            <h2 class="section-title"><?php echo $t['about_title']; ?></h2>
            <div class="about-content">
                <div class="about-image">
                    <img src="images/used/profil.jpeg" alt="EWI Britz Unternehmen" class="about-img">
                </div>
                <div class="about-text">
                    <blockquote class="quote"><?php echo $t['about_quote']; ?></blockquote>
                    <p><?php echo $t['about_text']; ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <div class="container">
            <h2 class="section-title"><?php echo $t['services_title']; ?></h2>
            <div class="services-header">
                <div class="services-text">
                    <blockquote class="quote"><?php echo $t['services_quote']; ?></blockquote>
                    <p class="services-intro"><?php echo $t['services_text']; ?></p>
                    <div class="services-list">
                        <ul>
                            <li><?php echo $t['service1']; ?></li>
                            <li><?php echo $t['service2']; ?></li>
                            <li><?php echo $t['service3']; ?></li>
                            <li><?php echo $t['service4']; ?></li>
                        </ul>
                    </div>
                </div>
                <div class="services-image">
                    <img src="images/used/leistungen.jpg" alt="EWI Britz Leistungen" class="services-img">
                </div>
            </div>
        </div>
    </section>

    <!-- References Section -->
    <section id="references" class="references">
        <div class="container">
            <h2 class="section-title"><?php echo $t['references_title']; ?></h2>
            <p class="references-intro"><?php echo $t['references_text']; ?></p>
            <div class="references-scroll-container">
                <div class="references-scroll">
                    <?php
                    $references = [
                        'Dücker Fördertechnik GmbH - Papier und Wellpappenindustrie',
                        'Dambach Lagersysteme',
                        'Dürkopp Fördertechnik GmbH - Bekleidungsindustrie',
                        'SMB International GmbH - Materialfluss',
                        'Lödige Fördertechnik GmbH - Auto- und Flugzeugindustrie',
                        'RIPPERT Anlagentechnik GmbH',
                        'Egemin',
                        'KRONES AG',
                        'MFI - Prozessautomation GmbH',
                        'TRAPO AG - Materialfluss',
                        'THIMM - Verpackung',
                        'Wepoba GmbH - Wellpappenfabrik',
                        'Dürmeier GmbH - Anlagenbau und Verfahrenstechnik',
                        'Voith Paper GmbH - Papierindustrie',
                        'KSS Krahn - Service',
                        'Smurfit Kappa GmbH',
                        'Systraplan GmbH - Möbelindustrie',
                        'Core Link AB - Papierindustrie',
                        'Dörfel KG - Lebensmittelindustrie',
                        'Theis Maschinenbau GmbH',
                        'Sandt Logistik GmbH - Materialfluss',
                        'AWILA Agra- und Industrieanlagen GmbH - Agratechnik',
                        'BSS Bohnenberg GmbH - Versandfördertechnik',
                        'Axmann Fördersysteme GmbH - Versandfördertechnik',
                        'Westfalia WST Systemtechnik GmbH - Materialfluss',
                        'Dücker Corrpal AB - Wellpappenindustrie',
                        'cfc Stotz GmbH - Automobilindustrie',
                        'SRK Baggage Handling Systems GmbH - Flughafenfördertechnik',
                        'Transnorm GmbH - Materialfluss'
                    ];

                    // Mische die Referenzen zufällig
                    shuffle($references);

                    // Dupliziere die gemischte Liste für nahtloses Scrolling
                    $all_references = array_merge($references, $references);

                    foreach($all_references as $reference): ?>
                        <div class="reference-box">
                            <?php echo htmlspecialchars($reference); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Jobs Section -->
    <section id="jobs" class="jobs">
        <div class="container">
            <h2 class="section-title"><?php echo $t['jobs_title']; ?></h2>
            <div class="jobs-content">
                <p><?php echo $t['jobs_text']; ?></p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <h2 class="section-title"><?php echo $t['contact_title']; ?></h2>
            <div class="contact-content">
                <div class="contact-info">
                    <div class="contact-image">
                        <img src="images/used/dia_lageplan.jpg" alt="Lageplan" class="contact-img">
                    </div>
                    <div class="contact-details">
                        <h4><?php echo $t['contact_company']; ?></h4>
                        <p><?php echo $t['contact_address']; ?></p>
                        <p><?php echo $t['impressum_manager']; ?></p>
                        <p><?php echo $t['impressum_phone']; ?><br><?php echo $t['impressum_fax']; ?></p>
                        <p><?php echo $t['contact_web']; ?><br><?php echo $t['impressum_email']; ?></p>
                        <p><?php echo $t['impressum_register']; ?></p>
                        <p><?php echo $t['impressum_tax']; ?></p>
                    </div>
                </div>
                <div class="contact-right">
                    <form class="contact-form" id="contact-form">
                        <!-- CSRF Token -->
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">

                        <!-- Honeypot field (hidden from users) -->
                        <input type="text" name="website" style="display:none !important;" tabindex="-1" autocomplete="off">

                        <input type="text" name="name" placeholder="Name" required maxlength="100">
                        <input type="email" name="email" placeholder="E-Mail" required maxlength="254">
                        <textarea name="message" placeholder="Nachricht" rows="3" required maxlength="2000"></textarea>
                        <button type="submit">Senden</button>
                    </form>
                    <div class="contact-management">
                        <h5><?php echo $t['contact_management_title']; ?></h5>
                        <p><strong><?php echo $t['contact_manager_title']; ?></strong> <?php echo $t['contact_manager_name']; ?></p>
                        <p><strong><?php echo $t['contact_software_title']; ?></strong> <?php echo $t['contact_software_name']; ?></p>
                        <p><strong><?php echo $t['contact_secretary_title']; ?></strong> <?php echo $t['contact_secretary_name']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-impressum">
                <div class="impressum-content">
                    <div class="impressum-liability">
                        <h5><?php echo $t['impressum_liability_title']; ?></h5>
                        <p><?php echo $t['impressum_liability_text']; ?></p>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <p><?php echo $t['footer_text']; ?></p>
                <p><a href="agb.php"><?php echo $t['nav_agb']; ?></a></p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
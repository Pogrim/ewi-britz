<?php
session_start();

// Simple language handling
$lang = isset($_GET['lang']) ? $_GET['lang'] : (isset($_SESSION['lang']) ? $_SESSION['lang'] : 'de');
$_SESSION['lang'] = $lang;

// Language arrays
$texts = [
    'de' => [
        'title' => 'EWI Britz - Ihr Partner für innovative Lösungen',
        'nav_home' => 'Startseite',
        'nav_profile' => 'Profil',
        'nav_services' => 'Leistungen',
        'nav_references' => 'Referenzen',
        'nav_projects' => 'Projekte',
        'nav_contact' => 'Kontakt',
        'hero_title' => 'Willkommen bei EWI Britz',
        'hero_subtitle' => 'Innovative Lösungen für Ihr Unternehmen',
        'about_title' => 'Über uns',
        'about_text' => 'EWI Britz ist Ihr verlässlicher Partner für innovative Technologielösungen. Mit langjähriger Erfahrung und einem kompetenten Team bieten wir maßgeschneiderte Lösungen für Ihre Anforderungen.',
        'services_title' => 'Unsere Leistungen',
        'contact_title' => 'Kontakt',
        'footer_text' => '© 2024 EWI Britz. Alle Rechte vorbehalten.'
    ],
    'en' => [
        'title' => 'EWI Britz - Your Partner for Innovative Solutions',
        'nav_home' => 'Home',
        'nav_profile' => 'Profile',
        'nav_services' => 'Services',
        'nav_references' => 'References',
        'nav_projects' => 'Projects',
        'nav_contact' => 'Contact',
        'hero_title' => 'Welcome to EWI Britz',
        'hero_subtitle' => 'Innovative Solutions for Your Business',
        'about_title' => 'About Us',
        'about_text' => 'EWI Britz is your reliable partner for innovative technology solutions. With years of experience and a competent team, we offer tailored solutions for your requirements.',
        'services_title' => 'Our Services',
        'contact_title' => 'Contact',
        'footer_text' => '© 2024 EWI Britz. All rights reserved.'
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
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="navbar">
            <div class="nav-container">
                <div class="nav-logo">
                    <img src="images/logo.png" alt="EWI Britz Logo" class="logo">
                </div>
                
                <div class="nav-menu" id="nav-menu">
                    <a href="#home" class="nav-link"><?php echo $t['nav_home']; ?></a>
                    <a href="#profile" class="nav-link"><?php echo $t['nav_profile']; ?></a>
                    <a href="#services" class="nav-link"><?php echo $t['nav_services']; ?></a>
                    <a href="#references" class="nav-link"><?php echo $t['nav_references']; ?></a>
                    <a href="#projects" class="nav-link"><?php echo $t['nav_projects']; ?></a>
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
                <p><?php echo $t['about_text']; ?></p>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <div class="container">
            <h2 class="section-title"><?php echo $t['services_title']; ?></h2>
            <div class="services-grid">
                <div class="service-card">
                    <h3>Service 1</h3>
                    <p>Beschreibung des ersten Services.</p>
                </div>
                <div class="service-card">
                    <h3>Service 2</h3>
                    <p>Beschreibung des zweiten Services.</p>
                </div>
                <div class="service-card">
                    <h3>Service 3</h3>
                    <p>Beschreibung des dritten Services.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- References Section -->
    <section id="references" class="references">
        <div class="container">
            <h2 class="section-title"><?php echo $t['nav_references']; ?></h2>
            <div class="references-grid">
                <div class="reference-item">
                    <h4>Referenz 1</h4>
                    <p>Beschreibung der ersten Referenz.</p>
                </div>
                <div class="reference-item">
                    <h4>Referenz 2</h4>
                    <p>Beschreibung der zweiten Referenz.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="projects">
        <div class="container">
            <h2 class="section-title"><?php echo $t['nav_projects']; ?></h2>
            <div class="projects-grid">
                <div class="project-card">
                    <h4>Projekt 1</h4>
                    <p>Beschreibung des ersten Projekts.</p>
                </div>
                <div class="project-card">
                    <h4>Projekt 2</h4>
                    <p>Beschreibung des zweiten Projekts.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <h2 class="section-title"><?php echo $t['contact_title']; ?></h2>
            <div class="contact-content">
                <div class="contact-info">
                    <h4>EWI Britz</h4>
                    <p>Musterstraße 123<br>12345 Berlin</p>
                    <p>Tel: +49 30 123456789<br>E-Mail: info@ewi-britz.de</p>
                </div>
                <form class="contact-form" id="contact-form">
                    <input type="text" name="name" placeholder="Name" required>
                    <input type="email" name="email" placeholder="E-Mail" required>
                    <textarea name="message" placeholder="Nachricht" rows="5" required></textarea>
                    <button type="submit">Senden</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p><?php echo $t['footer_text']; ?></p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
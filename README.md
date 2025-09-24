# EWI Britz Website Redesign

Ein modernes, responsives Redesign der EWI Britz Webseite mit HTML, PHP und JavaScript.

## Features

- **Responsive Design**: Funktioniert auf allen Geräten
- **Mehrsprachigkeit**: Deutsch und Englisch
- **Moderne UI**: Sauberes, professionelles Design
- **Kontaktformular**: Mit PHP-Backend und E-Mail-Versand
- **Performance**: Optimiert für schnelle Ladezeiten
- **SEO-freundlich**: Gute Suchmaschinenoptimierung

## Technologien

- **Frontend**: HTML5, CSS3, JavaScript (ES6+)
- **Backend**: PHP 7.4+
- **Styling**: Custom CSS mit Flexbox/Grid
- **Fonts**: Google Fonts (Inter)
- **Icons**: Custom SVG Icons

## Deployment auf Coolify

### Voraussetzungen

1. Git Repository auf GitHub
2. Coolify Server konfiguriert
3. Domain für die Webseite

### Deployment Schritte

1. **Repository pushen**:
   ```bash
   git init
   git add .
   git commit -m "Initial commit - EWI Britz redesign"
   git branch -M main
   git remote add origin https://github.com/username/ewi-britz.git
   git push -u origin main
   ```

2. **Coolify Setup**:
   - Neues Projekt in Coolify erstellen
   - GitHub Repository verbinden
   - Build-Einstellungen: Static Site oder PHP App
   - Environment Variables setzen (falls nötig)

3. **Domain konfigurieren**:
   - Domain in Coolify hinzufügen
   - SSL-Zertifikat automatisch generieren lassen

## Lokale Entwicklung

### PHP Server starten

```bash
php -S localhost:8000
```

### Oder mit Apache/Nginx

1. Dateien in Webroot kopieren (z.B. `/var/www/html/`)
2. Apache/Nginx konfigurieren
3. PHP aktivieren

## Konfiguration

### E-Mail Setup

In `contact.php` die E-Mail-Adresse anpassen:

```php
$to = 'info@ewi-britz.de'; // Ihre E-Mail-Adresse
```

### SSL/HTTPS

In `.htaccess` HTTPS-Redirect aktivieren:

```apache
# Uncomment these lines when SSL is configured:
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

## Dateien Übersicht

```
ewibritz/
├── index.php          # Hauptseite mit PHP-Logic
├── styles.css         # CSS-Styling
├── script.js          # JavaScript-Funktionalität  
├── contact.php        # Kontaktformular Backend
├── .htaccess          # Apache-Konfiguration
├── README.md          # Diese Datei
└── images/            # Bilder und Assets (zu erstellen)
    └── logo.png
```

## Browser Support

- Chrome 60+
- Firefox 55+
- Safari 12+
- Edge 79+

## Performance Features

- CSS/JS Minification bereit
- Image Lazy Loading
- Browser Caching via .htaccess
- GZIP Compression
- Preload kritischer Ressourcen

## Sicherheit

- XSS Protection
- CSRF Protection für Formulare
- Content Security Policy Headers
- Input Sanitization
- File Upload Protection

## Anpassungen

### Logo austauschen

Logo-Datei in `images/logo.png` ersetzen und Größe in CSS anpassen.

### Farben ändern

Hauptfarben in `styles.css` anpassen:

```css
:root {
  --primary-color: #007bff;
  --secondary-color: #6c757d;
}
```

### Inhalte ändern

Texte in den `$texts` Arrays in `index.php` bearbeiten.

## Support

Bei Fragen oder Problemen:

- GitHub Issues erstellen
- Dokumentation prüfen
- Code-Kommentare beachten
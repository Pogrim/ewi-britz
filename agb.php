<?php
session_start();

// Generate CSRF token
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Simple language handling
$lang = isset($_GET['lang']) ? $_GET['lang'] : (isset($_SESSION['lang']) ? $_SESSION['lang'] : 'de');
$_SESSION['lang'] = $lang;

// Language arrays for AGB
$texts = [
    'de' => [
        'title' => 'AGB - EWI - Waagenbau und Industrieelektronik GmbH',
        'nav_home' => 'Startseite',
        'nav_profile' => 'Profil',
        'nav_services' => 'Leistungen',
        'nav_references' => 'Referenzen',
        'nav_jobs' => 'Jobs',
        'nav_contact' => 'Kontakt',
        'nav_impressum' => 'Impressum',
        'nav_agb' => 'AGB',
        'agb_title' => 'Allgemeine Geschäftsbedingungen',
        'agb_content' => '
            <h3>I. Rechtsverbindlichkeit der AGB</h3>
            <p>1. Unsere AGB sind Bestandteil aller Angebote und Verträge über unsere Lieferungen und Leistungen, auch in laufender und künftiger Geschäftsverbindung.</p>
            <p>2. Abweichende Vereinbarungen sind nur verbindlich, wenn sie von uns schriftlich bestätigt sind.</p>

            <h3>II. Angebote</h3>
            <p>1. Angebote sind, soweit sie nicht ausdrücklich als verbindlich gekennzeichnet sind frei-bleibend. Verbindliche Angebote müssen seitens des Auftraggebers binnen angemessener Frist angenommen werden. Mündliche oder schriftliche Aufträge gelten als angenommen mit Erteilung der schriftlichen Auftrags-bestätigung oder innerhalb angemessener Frist.</p>
            <p>2. Die zum Angebot gehörenden Unterlagen wie Abbildungen, Zeichnungen, Gewichts- und Maßangaben, Leistungs- und sonstige Eigenschaftsbeschreibungen sind nur annähernd, soweit sie nicht schriftlich spezifiziert in den Vertrag eingeschlossen werden. Eine Zusicherung bestimmter Eigenschaften liegen nur vor bei ausdrücklicher, schriftlicher Kennzeichnung als solcher.</p>
            <p>3. Vom Auftraggeber gewünschte, über den üblichen Rahmen hinausgehende Empfehlungen, Zeichnungen, Skizzen oder sonstige Nebenleistungen, die sämtlich durchgeführt werden, erfolgen im Fall eines Auftrages kostenlos. In anderen Fällen werden sie dem Interessenten zu Selbstkosten in Rechnung gestellt.</p>
            <p>4. An Zeichnungen und sämtlichen anderen von uns überlassenen Unterlagen behalten wir uns das Eigentums- und Urheberrecht vor. Diese Unterlagen dürfen ohne unser schriftliches Einverständnis weder vervielfältigt, noch verwertet oder Dritten zugänglich gemacht werden. Die Unterlagen sind auf Verlangen zurückzugeben.</p>

            <h3>III. Umfang und Spezifikation der Leistung</h3>
            <p>1. Für den Umfang der Leistung ist unsere schriftliche Auftragsbestätigung maßgebend, Änderungen bedürfen unserer schriftlichen Bestätigung.</p>
            <p>2. Angaben, Pläne und sonstige Informationen des Auftraggebers können im vollen Umfang der Lieferung und Leistung zugrunde gelegt werden; sie werden jedoch nur bei ausdrücklicher schriftlicher Vereinbarung Vertragsinhalt. Eine Zusicherung besonderer Leistungen oder Eigenschaften folgt hieraus nicht. Der Auftraggeber übernimmt die Gewähr für Richtigkeit und Rechtmäßigkeit der Benutzung. Wir speichern Daten gemäß Datenschutzgesetz.</p>

            <h3>IV. Preise</h3>
            <p>1. Preislisten und sonstige allgemeine Preisangaben sind freibleibend. Hinsichtlich der Preisstellung verweisen wir auf die jeweils gültigen Stundenverrechnungssätze, sofern keine Sondervereinbarungen abgemacht wurden.</p>
            <p>2. Erfolgt die Lieferung oder Leistung später als 4 Monate nach Auftragsbestätigung, sind wir bei zwischenzeitlicher Änderung unserer Material-, Lohn- oder sonstigen Kosten berechtigt, neue Preise zu berechnen.</p>
            <p>3. Entsprechen die uns vom Auftraggeber mündlich oder schriftlich gegebenen Informationen nicht den tatsächlichen Verhältnissen oder wurde uns von Umständen, die ein anderes Material oder eine andere Ausführungsart bedingt hätten, verspätet oder keine Kenntnis gegeben, so sind wir in jedem Fall berechtigt, dem Auftraggeber die Kosten für notwendige Änderungen zu berechnen.</p>

            <h3>V. Zahlungsbedingungen</h3>
            <p>1. Rechnungen sind, wenn nicht anders vereinbart innerhalb von 14 Tagen ab Rechnungsdatum zu begleichen.</p>
            <p>2. Bei Überschreitung der Zahlungsfrist kommt der Auftraggeber nach fruchtloser einmaliger Zahlungsaufforderung in Verzug. Tritt Zahlungsverzug ein, sind sämtliche offenen Forderungen, auch soweit sie noch nicht fällig sind, zahlbar. Dies gilt auch dann, wenn für vorausgegangene Fälle Stundung gewährt worden ist. Wir sind berechtigt für die gesamten Forderungen Zinsen in Höhe von 5% über dem Bundesbank-Diskontsatz ab Fälligkeit zu verlangen.</p>
            <p>3. In gleicher Weise sind bei Zahlungseinstellung, Eröffnung des Vergleichs- oder Konkursverfahrens über das Vermögen des Auftraggebers sämtliche Forderungen sofort fällig.</p>
            <p>4. Beanstandungen, die nicht ausdrücklich schriftlich anerkannt sind, entbinden den Auftraggeber nicht von der Zahlungspflicht. Entsprechendes gilt für die Ausübung des Zurückbehaltungsrechtes oder der Aufrechnung bezüglich Ansprüchen, deren sich der Auftraggeber rühmt. Darüber hinaus kann eine Aufrechnung nur mit rechtskräftig festgestellten Forderungen vorgenommen werden. Erklären wir uns zur Mängelbeseitigung gemäß diesen Liefer- und Leistungsbedingungen bereit, muß der Auftraggeber die fälligen Zahlungen leisten, ausgenommen den in Ziffer IX.8. vorgesehenen Einbehalt.</p>
            <p>5. Unsere Kontoauszüge zur Kontokorrentabstimmung gelten als anerkannt, wenn ihnen nicht binnen 2 Wochen nach Erhalt widersprochen wird.</p>

            <h3>VI. Fristen für Lieferungen und Leistungen</h3>
            <p>1. Fristen und Termine sind nur verbindlich, wenn sie von uns ausdrücklich als solche bestätigt sind. Sie beginnen aber erst mit Eingang sämtlicher vom Auftraggeber zu erbringenden Angaben. Der Auftraggeber sichert zu sämtliche von ihm zu liefernden Angaben, Pläne, Material und Daten termingerecht und in ausreichender Menge vorzulegen.</p>
            <p>2. Die Frist gilt als eingehalten:<br>
            a) bei Lieferung ohne Montage, wenn die Ware innerhalb der vereinbarten Liefer- oder Leistungsfrist zum Versand gebracht oder abgeholt worden ist. Falls die Ablieferung sich aus Gründen, die der Auftraggeber zu vertreten hat, verzögert, so gilt die Frist als eingehalten bei Meldung der Versandbereitschaft innerhalb der vereinbarten Frist.<br>
            b) Bei Lieferung und Montage, sobald diese innerhalb der vereinbarten Frist erfolgt ist.</p>
            <p>3. Ist die Nichteinhaltung der Frist für Lieferung und Leistung nachweislich auf Mobilmachung, Krieg, Aufruhr, Streik oder Aussperrung bei uns oder einem unserer Zulieferer oder auf den Eintritt anderer, unvorhergesehener Hindernisse, die sich unserer zumutbaren Kontrolle entziehen, zurückzuführen, wird die Frist angemessen verlängert.</p>
            <p>4. Bei Liefer- und Leistungsverzug, der infolge unseres Verschuldens entstanden ist, kann der Auftraggeber – sofern er glaubhaft macht, dass ihm aus der Verspätung Schaden erwachsen ist – eine Verzugsentschädigung für jede vollendete Woche der Verspätung von 0,5 v.H. bis zu Höhe von insgesamt 5,0 v.H. vom Wert desjenigen Teiles unserer Lieferungen und Leistungen verlangen, der wegen nicht rechtzeitiger Fertigstellung einzelner dazugehöriger Gegenstände nicht in zweckdienlichen Betrieb genommen werden konnte. Anderweitige Entschädigungsansprüche des Auftraggebers sind in allen Fällen verspäteter Lieferung und Leistung, auch nach Ablauf einer uns etwa gesetzten Nachfrist, ausgeschlossen. Dies gilt nicht, soweit in Fällen des Vorsatzes oder der groben Fahrlässigkeit zwingend gehaftet wird. Das Recht des Auftraggebers zum Rücktritt nach fruchtlosem Ablauf einer schriftlich gesetzten Nachfrist bleibt unberührt.</p>
            <p>5. Wird der Versand oder die Zustellung sowie die Leistung auf Wunsch des Auftraggebers oder in anderer, vom Auftraggeber zu vertretenden Weise verzögert, so kann, beginnend 1 Monat nach Anzeige der Versand- und/ oder Leistungsbereitschaft, dem Auftraggeber die Kosten in Höhe von 0,5 v.H. des Rechnungsbetrages für jeden angefangenen Monat berechnet werden. Wir sind jedoch berechtigt, nach Setzung und fruchtlosem Ablauf einer angemessenen Frist anderweitig über den Liefergegenstand und Arbeitskräfte zu verfügen und den Auftraggeber mit angemessen verlängerter Frist zu beliefern und die Leistung zu erbringen.</p>

            <h3>VII. Gefahrübergang und Entgegennahme</h3>
            <p>1. Die Gefahr geht spätestens mit der Absendung der Lieferteile auf den Auftraggeber über, und zwar auch dann, wenn Teillieferungen erfolgen oder wir noch andere Leistungen, z.B. die Versandkosten oder Anfuhr, übernommen haben.</p>
            <p>2. Verzögert sich der Versand infolge von Umständen, die der Auftraggeber zu vertreten hat, so geht die Gefahr vom Tage der Versandbereitschaft an auf den Auftraggeber über.</p>
            <p>3. Angelieferte Gegenstände sind, auch wenn sie unwesentliche Mängel aufweisen, vom Auftraggeber unbeschadet der Rechte aus Abschnitt IX. entgegenzunehmen.</p>
            <p>4. Teillieferungen sind zulässig.</p>
            <p>5. Die vorstehenden Bestimmungen über Gefahrübergang gelten auch dann, wenn im Werk des Auftraggebers noch Arbeiten am Liefergegenstand, insbesondere Montage oder vereinbarungsgemäß die Abnahme oder Inbetriebnahme erfolgen soll. Unberührt hiervon bleibt unsere Verpflichtung zu bedingungsgemäßer Fertigstellung des Liefergegenstandes.</p>

            <h3>VIII. Aufstellung oder Montage</h3>
            <p>Aufstellung und Montage von Anlagen erfolgt nur auf speziellen Auftrag.</p>

            <h3>IX. Mängelrügen, Gewährleistung und Umfang der Eigenschaftspflicht</h3>
            <p>Für Mängel der Lieferung und Leistung, zu denen auch das Fehlen ausdrücklich zugesicherter Eigenschaften gehört, haften wir unter Ausschluß weiterer Ansprüche wie folgt:</p>
            <p>1. Der Auftraggeber muß, sofern keine Abnahme in unserem Haus erfolgt, die Lieferung und Leistung sofort nach Erhalt auf vertragsmäßige Beschaffenheit und einwandfreie Funktion überprüfen. Offensichtliche und erkennbare Mängel sind innerhalb von 7 Tagen nach Erhalt, verdeckte Mängel umgehend nach Offenkundigkeit schriftlich zu rügen.</p>
            <p>2. Die Mängelhaftung bezieht sich nicht auf natürliche Abnutzung, ferner nicht auf Schäden, die nach dem Gefahrübergang zufolge fehlerhafter Montage und/oder Inbetriebnahme, ungeeigneter und unsachgemäßer Anwendung, fehlerhafter oder</p>
            <p>3. nachlässiger Behandlung, übermäßiger Beanspruchung, ungeeigneter Betriebsmittel, mangelhafter Bauarbeiten, ungeeigneten Baugruppen und solcher chemischer, elektro-chemischer oder elektrischer Einflüsse Ihrerseits entstehen, die nach dem Vertrag nicht vorausgesetzt sind.</p>
            <p>4. Durch etwa seitens des Auftraggebers oder Dritter ohne unsere schriftliche Zustimmung oder unsachgemäß vorgenommene Änderungen und Instandsetzungsarbeiten wird die Haftung für die daraus entstehenden Folgen aufgehoben.</p>
            <p>5. Zur Überprüfung des Mangels und zur Mängelbeseitigung muß der Auftraggeber uns die nach unserem billigen Ermessen erforderliche Zeit und Gelegenheit gewähren. Wird uns diese verweigert sind wir von der Mängelhaftung befreit, ist die Durchführung der Mängelprüfung oder der Mängelbeseitigung in unserem Haus erforderlich oder möglich, sind wir berechtigt, die Übersendung des mängelbehafteten Teiles auf Kosten des Auftraggebers zu verlangen.</p>
            <p>6. Im Gewährleistungsfall werden wir diejenigen Teile unserer Lieferung nach unserer Wahl unentgeltlich nachbessern bzw. ersetzen, die nachweisbar infolge eines vor dem Gefahrübergang liegenden Mangels insbesondere infolge fehlerhafter Konstruktion, schlechten Materials oder mangelhafter Ausführung unbrauchbar oder in der Brauchbarkeit erheblich beeinträchtigt werden.</p>
            <p>7. Wenn die Mängelbeseitigung durch Nachbesserung oder Ersatzlieferung unmöglich ist oder verweigert werden sollte, oder wenn wir eine uns gestellte angemessene Nachfrist verstreichen lassen, ohne den Mangel zu beheben, kann der Auftraggeber eine angemessene Minderung verlangen, wenn wir nicht eine Rückgängigmachung des Vertrages vorziehen.</p>
            <p>8. Fehlen ausdrücklich schriftlich zugesicherte Eigenschaften des gelieferten Gegenstandes, so sind wir zur Nachbesserung innerhalb angemessener Frist berechtigt. Wenn wir eine gestellte angemessene Nachfrist verstreichen lassen, ohne den Mangel zu beheben, oder wenn die Nachbesserung unmöglich ist oder verweigert werden sollte, ist der Auftraggeber unter Ausschluß weiterer Ansprüche zum Rücktritt berechtigt.</p>
            <p>9. Der Auftraggeber hat die ihm obliegenden Vertragsverpflichtungen insbesondere die vereinbarten Zahlungsbedingungen einzuhalten. Wenn eine Mängelrüge geltend gemacht wird, dürfen Zahlungen des Auftraggebers in einem Umfang zurückgehalten werden, die in einem angemessenen Verhältnis zu den angezeigten und von uns – ggf. vorläufig – anerkannten Mängel stehen. Gehört jedoch der Vertrag zum Betrieb des Handelsgewerbes des Auftraggebers, so kann er Zahlungen nur zurückhalten, wenn eine Mängelrüge geltendgemacht wird, über deren Berechtigung kein Zweifel bestehen kann.</p>
            <p>10. Weitere Ansprüche des Auftraggebers gegen uns und unsere Erfüllungsgehilfen sind ausgeschlossen, insbesondere ein Anspruch auf Ersatz von Schäden, die nicht an dem Liefer- oder Leistungsgegenstand selbst entstanden sind.</p>
            <p>11. Die vorstehenden Bestimmungen gelten entsprechend für solche Ansprüche des Auftraggebers auf Nachbesserung, Ersatzlieferung oder Schadensersatz, die durch vor oder nach Vertragsabschluß liegende Vorschläge oder Beratung oder durch Verletzung vertraglicher Nebenpflichten entstanden sind.</p>

            <h3>X. Unmöglichkeit, Vertragsanpassung</h3>
            <p>1. Sollte es uns aus von uns zu vertretenden Gründen unmöglich sein, die vertraglich vereinbarten Leistungen oder Lieferungen zu erbringen, so ist der Auftraggeber berechtigt, Schadensersatz zu verlangen. Der Anspruch beschränkt sich jedoch auf 10 v.H. des Wertes desjenigen Teiles der Lieferung oder Leistung, welcher wegen der Unmöglichkeit nicht in zweckdienlichen Betrieb genommen werden kann. Das Recht des Auftraggebers zum Rücktritt vom Vertrag bleibt unberührt.</p>
            <p>2. Sofern unvorhergesehene Ereignisse im Sinne von VI.3. die wirtschaftliche Bedeutung oder den Inhalt der Lieferung oder Leistung erheblich verändern oder auf unser Unternehmen erheblich einwirken, wird der Vertrag angemessen angepasst. Soweit dies wirtschaftlich nicht vertretbar ist, steht uns das Recht zu, vom Vertrag zurückzutreten. Sofern wir beabsichtigen, von diesem Rücktrittsrecht Gebrauch zu machen, werden wir dies nach Erkenntnis der Tragweite des Ereignisses unverzüglich dem Auftraggeber mitteilen und zwar auch dann, wenn zunächst mit dem Auftraggeber eine Verlängerung der Liefer- und Leistungszeit vereinbart war.</p>

            <h3>XI. Sonstige Schadensersatzansprüche</h3>
            <p>Anderweitige Schadensersatzansprüche des Auftraggebers gegen uns, unsere Erfüllungs- und Verrichtungsgehilfen, gleich aus welchem Rechtsgrund, sind ausgeschlossen. Ziffer IX.9. gilt entsprechend.</p>

            <h3>XII. Eigentumsvorbehalt</h3>
            <p>1. Die gelieferte Ware bleibt bis zur Bezahlung des Kaufpreises und Tilgung aller aus der Geschäftsverbindung bestehenden Forderungen und der im Zusammenhang mit dem Kaufgegenstand noch entstehenden Forderungen sowie aller zukünftig entstehenden Forderungen als Vorbehaltsware unser Eigentum. Die Einstellung einzelner Forderungen in eine laufende Rechnung oder die Saldo-Ziehung und deren Anerkennung heben den Eigentumsvorbehalt nicht auf.</p>
            <p>2. Bei Zahlungsverzug des Auftraggebers (Ziffer V.2.) sind wir zur Rücknahme der Vorbehaltsware berechtigt und der Auftraggeber zur Herausgabe verpflichtet.</p>
            <p>3. Wird Vorbehaltsware vom Auftraggeber, allein oder zusammen mit fremder Ware, veräußert, tritt der Auftraggeber schon jetzt die aus der Weiterveräußerung entstehenden Forderungen in Höhe des Wertes der Vorbehaltsware mit allen Nebenrechten und Rang vor dem Rest ab; wir nahmen die Abtretung an.</p>
            <p>4. Der Auftraggeber ist zur Weiterveräußerung, zur Verwendung oder zum Einbau der Vorbehaltsware nur im üblichen ordnungsgemäßen Geschäftsgang und nur mit der Maßgabe berechtigt, dass die Forderungen im Sinne von Ziffer 3. auf uns tatsächlich übergehen. Zu anderen Verfügungen über die Vorbehaltsware, insbesondere Verpfändung oder Sicherungsübereignung, ist der Auftraggeber nicht berechtigt.</p>
            <p>5. Über Zwangsvollstreckungsmaßnahmen Dritter in der Vorbehaltsware oder in die abgetretenen Forderungen muß uns der Auftraggeber unverzüglich unter Übergabe der für den Widerspruch notwendigen Unterlagen unterrichten, Interventionskosten gehen zu Lasten des Auftraggebers.</p>
            <p>6. Mit Zahlungseinstellung, Beantragung oder Eröffnung des Konkurses, des gerichtlichen oder außergerichtlichen Vergleichsverfahrens erlöschen das Recht zur Weiterveräußerung, zur Verwendung oder zum Einbau der Vorbehaltsware.</p>
            <p>7. Übersteigt der Wert der eingeräumten Sicherheiten die Forderungen um mehr als 20 v.H., sind wir insoweit zur Rückübertragung oder Freigabe von Sicherheiten nach unserer Wahl verpflichtet. Mit Tilgung aller Forderungen aus der Geschäftsverbindung gehen das Eigentum an der Vorbehaltsware und die abgetretenen Forderungen an den Auftraggeber über.</p>

            <h3>XIII. Nebenbestimmungen</h3>
            <p>1. Das Vertragsverhältnis unterliegt deutschem Recht, unter Ausschluß des Haager Einheitlichen Kaufsrechts. Ergänzend gelten in jedem Fall die Bestimmungen des Handelsgesetzbuches für Handelsgeschäfte unter Vollkaufleuten und subsidiär die Vorschriften des Bürgerlichen Gesetzbuches. Dies gilt auch, wenn der Auftraggeber Ausländer ist oder seinen Sitz im Ausland hat.</p>
            <p>2. Die etwaige Unwirksamkeit einzelner der vorstehenden Geschäftsbedingungen berührt nicht die Wirksamkeit der übrigen Bestimmungen.</p>
            <p>3. In jedem Fall ist die Zuständigkeit der ordentlichen Gerichte in Frankfurt Oder für die Geltendmachung von Ansprüchen im Mahnverfahren und bei unbekanntem Wohnsitz oder gewöhnlichem Aufenthalt des Auftraggebers zum Zeitpunkt der Klageerhebung ausdrücklich vereinbart. Im übrigen ist der Gerichtsstand Frankfurt Oder, auch wenn der Auftraggeber Vollkaufmann, juristische Person des öffentlichen Rechts oder öffentlichrechtliches Sondervermögen ist, oder er in der Bundesrepublik Deutschland keinen allgemeinen Gerichtsstand hat.</p>
        ',
        'back_to_home' => 'Zurück zur Startseite',
        'footer_text' => '© ' . date('Y') . ' EWI - Waagenbau und Industrieelektronik GmbH. Alle Rechte vorbehalten.'
    ],
    'en' => [
        'title' => 'Terms and Conditions - EWI - Weighing Technology and Industrial Electronics GmbH',
        'nav_home' => 'Home',
        'nav_profile' => 'Profile',
        'nav_services' => 'Services',
        'nav_references' => 'References',
        'nav_jobs' => 'Jobs',
        'nav_contact' => 'Contact',
        'nav_impressum' => 'Imprint',
        'nav_agb' => 'Terms',
        'agb_title' => 'General Terms and Conditions',
        'agb_content' => '
            <h3>I. Rechtsverbindlichkeit der AGB</h3>
            <p>1. Unsere AGB sind Bestandteil aller Angebote und Verträge über unsere Lieferungen und Leistungen, auch in laufender und künftiger Geschäftsverbindung.</p>
            <p>2. Abweichende Vereinbarungen sind nur verbindlich, wenn sie von uns schriftlich bestätigt sind.</p>

            <h3>II. Angebote</h3>
            <p>1. Angebote sind, soweit sie nicht ausdrücklich als verbindlich gekennzeichnet sind frei-bleibend. Verbindliche Angebote müssen seitens des Auftraggebers binnen angemessener Frist angenommen werden. Mündliche oder schriftliche Aufträge gelten als angenommen mit Erteilung der schriftlichen Auftrags-bestätigung oder innerhalb angemessener Frist.</p>
            <p>2. Die zum Angebot gehörenden Unterlagen wie Abbildungen, Zeichnungen, Gewichts- und Maßangaben, Leistungs- und sonstige Eigenschaftsbeschreibungen sind nur annähernd, soweit sie nicht schriftlich spezifiziert in den Vertrag eingeschlossen werden. Eine Zusicherung bestimmter Eigenschaften liegen nur vor bei ausdrücklicher, schriftlicher Kennzeichnung als solcher.</p>
            <p>3. Vom Auftraggeber gewünschte, über den üblichen Rahmen hinausgehende Empfehlungen, Zeichnungen, Skizzen oder sonstige Nebenleistungen, die sämtlich durchgeführt werden, erfolgen im Fall eines Auftrages kostenlos. In anderen Fällen werden sie dem Interessenten zu Selbstkosten in Rechnung gestellt.</p>
            <p>4. An Zeichnungen und sämtlichen anderen von uns überlassenen Unterlagen behalten wir uns das Eigentums- und Urheberrecht vor. Diese Unterlagen dürfen ohne unser schriftliches Einverständnis weder vervielfältigt, noch verwertet oder Dritten zugänglich gemacht werden. Die Unterlagen sind auf Verlangen zurückzugeben.</p>

            <h3>III. Umfang und Spezifikation der Leistung</h3>
            <p>1. Für den Umfang der Leistung ist unsere schriftliche Auftragsbestätigung maßgebend, Änderungen bedürfen unserer schriftlichen Bestätigung.</p>
            <p>2. Angaben, Pläne und sonstige Informationen des Auftraggebers können im vollen Umfang der Lieferung und Leistung zugrunde gelegt werden; sie werden jedoch nur bei ausdrücklicher schriftlicher Vereinbarung Vertragsinhalt. Eine Zusicherung besonderer Leistungen oder Eigenschaften folgt hieraus nicht. Der Auftraggeber übernimmt die Gewähr für Richtigkeit und Rechtmäßigkeit der Benutzung. Wir speichern Daten gemäß Datenschutzgesetz.</p>

            <h3>IV. Preise</h3>
            <p>1. Preislisten und sonstige allgemeine Preisangaben sind freibleibend. Hinsichtlich der Preisstellung verweisen wir auf die jeweils gültigen Stundenverrechnungssätze, sofern keine Sondervereinbarungen abgemacht wurden.</p>
            <p>2. Erfolgt die Lieferung oder Leistung später als 4 Monate nach Auftragsbestätigung, sind wir bei zwischenzeitlicher Änderung unserer Material-, Lohn- oder sonstigen Kosten berechtigt, neue Preise zu berechnen.</p>
            <p>3. Entsprechen die uns vom Auftraggeber mündlich oder schriftlich gegebenen Informationen nicht den tatsächlichen Verhältnissen oder wurde uns von Umständen, die ein anderes Material oder eine andere Ausführungsart bedingt hätten, verspätet oder keine Kenntnis gegeben, so sind wir in jedem Fall berechtigt, dem Auftraggeber die Kosten für notwendige Änderungen zu berechnen.</p>

            <h3>V. Zahlungsbedingungen</h3>
            <p>1. Rechnungen sind, wenn nicht anders vereinbart innerhalb von 14 Tagen ab Rechnungsdatum zu begleichen.</p>
            <p>2. Bei Überschreitung der Zahlungsfrist kommt der Auftraggeber nach fruchtloser einmaliger Zahlungsaufforderung in Verzug. Tritt Zahlungsverzug ein, sind sämtliche offenen Forderungen, auch soweit sie noch nicht fällig sind, zahlbar. Dies gilt auch dann, wenn für vorausgegangene Fälle Stundung gewährt worden ist. Wir sind berechtigt für die gesamten Forderungen Zinsen in Höhe von 5% über dem Bundesbank-Diskontsatz ab Fälligkeit zu verlangen.</p>
            <p>3. In gleicher Weise sind bei Zahlungseinstellung, Eröffnung des Vergleichs- oder Konkursverfahrens über das Vermögen des Auftraggebers sämtliche Forderungen sofort fällig.</p>
            <p>4. Beanstandungen, die nicht ausdrücklich schriftlich anerkannt sind, entbinden den Auftraggeber nicht von der Zahlungspflicht. Entsprechendes gilt für die Ausübung des Zurückbehaltungsrechtes oder der Aufrechnung bezüglich Ansprüchen, deren sich der Auftraggeber rühmt. Darüber hinaus kann eine Aufrechnung nur mit rechtskräftig festgestellten Forderungen vorgenommen werden. Erklären wir uns zur Mängelbeseitigung gemäß diesen Liefer- und Leistungsbedingungen bereit, muß der Auftraggeber die fälligen Zahlungen leisten, ausgenommen den in Ziffer IX.8. vorgesehenen Einbehalt.</p>
            <p>5. Unsere Kontoauszüge zur Kontokorrentabstimmung gelten als anerkannt, wenn ihnen nicht binnen 2 Wochen nach Erhalt widersprochen wird.</p>

            <h3>VI. Fristen für Lieferungen und Leistungen</h3>
            <p>1. Fristen und Termine sind nur verbindlich, wenn sie von uns ausdrücklich als solche bestätigt sind. Sie beginnen aber erst mit Eingang sämtlicher vom Auftraggeber zu erbringenden Angaben. Der Auftraggeber sichert zu sämtliche von ihm zu liefernden Angaben, Pläne, Material und Daten termingerecht und in ausreichender Menge vorzulegen.</p>
            <p>2. Die Frist gilt als eingehalten:<br>
            a) bei Lieferung ohne Montage, wenn die Ware innerhalb der vereinbarten Liefer- oder Leistungsfrist zum Versand gebracht oder abgeholt worden ist. Falls die Ablieferung sich aus Gründen, die der Auftraggeber zu vertreten hat, verzögert, so gilt die Frist als eingehalten bei Meldung der Versandbereitschaft innerhalb der vereinbarten Frist.<br>
            b) Bei Lieferung und Montage, sobald diese innerhalb der vereinbarten Frist erfolgt ist.</p>
            <p>3. Ist die Nichteinhaltung der Frist für Lieferung und Leistung nachweislich auf Mobilmachung, Krieg, Aufruhr, Streik oder Aussperrung bei uns oder einem unserer Zulieferer oder auf den Eintritt anderer, unvorhergesehener Hindernisse, die sich unserer zumutbaren Kontrolle entziehen, zurückzuführen, wird die Frist angemessen verlängert.</p>
            <p>4. Bei Liefer- und Leistungsverzug, der infolge unseres Verschuldens entstanden ist, kann der Auftraggeber – sofern er glaubhaft macht, dass ihm aus der Verspätung Schaden erwachsen ist – eine Verzugsentschädigung für jede vollendete Woche der Verspätung von 0,5 v.H. bis zu Höhe von insgesamt 5,0 v.H. vom Wert desjenigen Teiles unserer Lieferungen und Leistungen verlangen, der wegen nicht rechtzeitiger Fertigstellung einzelner dazugehöriger Gegenstände nicht in zweckdienlichen Betrieb genommen werden konnte. Anderweitige Entschädigungsansprüche des Auftraggebers sind in allen Fällen verspäteter Lieferung und Leistung, auch nach Ablauf einer uns etwa gesetzten Nachfrist, ausgeschlossen. Dies gilt nicht, soweit in Fällen des Vorsatzes oder der groben Fahrlässigkeit zwingend gehaftet wird. Das Recht des Auftraggebers zum Rücktritt nach fruchtlosem Ablauf einer schriftlich gesetzten Nachfrist bleibt unberührt.</p>
            <p>5. Wird der Versand oder die Zustellung sowie die Leistung auf Wunsch des Auftraggebers oder in anderer, vom Auftraggeber zu vertretenden Weise verzögert, so kann, beginnend 1 Monat nach Anzeige der Versand- und/ oder Leistungsbereitschaft, dem Auftraggeber die Kosten in Höhe von 0,5 v.H. des Rechnungsbetrages für jeden angefangenen Monat berechnet werden. Wir sind jedoch berechtigt, nach Setzung und fruchtlosem Ablauf einer angemessenen Frist anderweitig über den Liefergegenstand und Arbeitskräfte zu verfügen und den Auftraggeber mit angemessen verlängerter Frist zu beliefern und die Leistung zu erbringen.</p>

            <h3>VII. Gefahrübergang und Entgegennahme</h3>
            <p>1. Die Gefahr geht spätestens mit der Absendung der Lieferteile auf den Auftraggeber über, und zwar auch dann, wenn Teillieferungen erfolgen oder wir noch andere Leistungen, z.B. die Versandkosten oder Anfuhr, übernommen haben.</p>
            <p>2. Verzögert sich der Versand infolge von Umständen, die der Auftraggeber zu vertreten hat, so geht die Gefahr vom Tage der Versandbereitschaft an auf den Auftraggeber über.</p>
            <p>3. Angelieferte Gegenstände sind, auch wenn sie unwesentliche Mängel aufweisen, vom Auftraggeber unbeschadet der Rechte aus Abschnitt IX. entgegenzunehmen.</p>
            <p>4. Teillieferungen sind zulässig.</p>
            <p>5. Die vorstehenden Bestimmungen über Gefahrübergang gelten auch dann, wenn im Werk des Auftraggebers noch Arbeiten am Liefergegenstand, insbesondere Montage oder vereinbarungsgemäß die Abnahme oder Inbetriebnahme erfolgen soll. Unberührt hiervon bleibt unsere Verpflichtung zu bedingungsgemäßer Fertigstellung des Liefergegenstandes.</p>

            <h3>VIII. Aufstellung oder Montage</h3>
            <p>Aufstellung und Montage von Anlagen erfolgt nur auf speziellen Auftrag.</p>

            <h3>IX. Mängelrügen, Gewährleistung und Umfang der Eigenschaftspflicht</h3>
            <p>Für Mängel der Lieferung und Leistung, zu denen auch das Fehlen ausdrücklich zugesicherter Eigenschaften gehört, haften wir unter Ausschluß weiterer Ansprüche wie folgt:</p>
            <p>1. Der Auftraggeber muß, sofern keine Abnahme in unserem Haus erfolgt, die Lieferung und Leistung sofort nach Erhalt auf vertragsmäßige Beschaffenheit und einwandfreie Funktion überprüfen. Offensichtliche und erkennbare Mängel sind innerhalb von 7 Tagen nach Erhalt, verdeckte Mängel umgehend nach Offenkundigkeit schriftlich zu rügen.</p>
            <p>2. Die Mängelhaftung bezieht sich nicht auf natürliche Abnutzung, ferner nicht auf Schäden, die nach dem Gefahrübergang zufolge fehlerhafter Montage und/oder Inbetriebnahme, ungeeigneter und unsachgemäßer Anwendung, fehlerhafter oder</p>
            <p>3. nachlässiger Behandlung, übermäßiger Beanspruchung, ungeeigneter Betriebsmittel, mangelhafter Bauarbeiten, ungeeigneten Baugruppen und solcher chemischer, elektro-chemischer oder elektrischer Einflüsse Ihrerseits entstehen, die nach dem Vertrag nicht vorausgesetzt sind.</p>
            <p>4. Durch etwa seitens des Auftraggebers oder Dritter ohne unsere schriftliche Zustimmung oder unsachgemäß vorgenommene Änderungen und Instandsetzungsarbeiten wird die Haftung für die daraus entstehenden Folgen aufgehoben.</p>
            <p>5. Zur Überprüfung des Mangels und zur Mängelbeseitigung muß der Auftraggeber uns die nach unserem billigen Ermessen erforderliche Zeit und Gelegenheit gewähren. Wird uns diese verweigert sind wir von der Mängelhaftung befreit, ist die Durchführung der Mängelprüfung oder der Mängelbeseitigung in unserem Haus erforderlich oder möglich, sind wir berechtigt, die Übersendung des mängelbehafteten Teiles auf Kosten des Auftraggebers zu verlangen.</p>
            <p>6. Im Gewährleistungsfall werden wir diejenigen Teile unserer Lieferung nach unserer Wahl unentgeltlich nachbessern bzw. ersetzen, die nachweisbar infolge eines vor dem Gefahrübergang liegenden Mangels insbesondere infolge fehlerhafter Konstruktion, schlechten Materials oder mangelhafter Ausführung unbrauchbar oder in der Brauchbarkeit erheblich beeinträchtigt werden.</p>
            <p>7. Wenn die Mängelbeseitigung durch Nachbesserung oder Ersatzlieferung unmöglich ist oder verweigert werden sollte, oder wenn wir eine uns gestellte angemessene Nachfrist verstreichen lassen, ohne den Mangel zu beheben, kann der Auftraggeber eine angemessene Minderung verlangen, wenn wir nicht eine Rückgängigmachung des Vertrages vorziehen.</p>
            <p>8. Fehlen ausdrücklich schriftlich zugesicherte Eigenschaften des gelieferten Gegenstandes, so sind wir zur Nachbesserung innerhalb angemessener Frist berechtigt. Wenn wir eine gestellte angemessene Nachfrist verstreichen lassen, ohne den Mangel zu beheben, oder wenn die Nachbesserung unmöglich ist oder verweigert werden sollte, ist der Auftraggeber unter Ausschluß weiterer Ansprüche zum Rücktritt berechtigt.</p>
            <p>9. Der Auftraggeber hat die ihm obliegenden Vertragsverpflichtungen insbesondere die vereinbarten Zahlungsbedingungen einzuhalten. Wenn eine Mängelrüge geltend gemacht wird, dürfen Zahlungen des Auftraggebers in einem Umfang zurückgehalten werden, die in einem angemessenen Verhältnis zu den angezeigten und von uns – ggf. vorläufig – anerkannten Mängel stehen. Gehört jedoch der Vertrag zum Betrieb des Handelsgewerbes des Auftraggebers, so kann er Zahlungen nur zurückhalten, wenn eine Mängelrüge geltendgemacht wird, über deren Berechtigung kein Zweifel bestehen kann.</p>
            <p>10. Weitere Ansprüche des Auftraggebers gegen uns und unsere Erfüllungsgehilfen sind ausgeschlossen, insbesondere ein Anspruch auf Ersatz von Schäden, die nicht an dem Liefer- oder Leistungsgegenstand selbst entstanden sind.</p>
            <p>11. Die vorstehenden Bestimmungen gelten entsprechend für solche Ansprüche des Auftraggebers auf Nachbesserung, Ersatzlieferung oder Schadensersatz, die durch vor oder nach Vertragsabschluß liegende Vorschläge oder Beratung oder durch Verletzung vertraglicher Nebenpflichten entstanden sind.</p>

            <h3>X. Unmöglichkeit, Vertragsanpassung</h3>
            <p>1. Sollte es uns aus von uns zu vertretenden Gründen unmöglich sein, die vertraglich vereinbarten Leistungen oder Lieferungen zu erbringen, so ist der Auftraggeber berechtigt, Schadensersatz zu verlangen. Der Anspruch beschränkt sich jedoch auf 10 v.H. des Wertes desjenigen Teiles der Lieferung oder Leistung, welcher wegen der Unmöglichkeit nicht in zweckdienlichen Betrieb genommen werden kann. Das Recht des Auftraggebers zum Rücktritt vom Vertrag bleibt unberührt.</p>
            <p>2. Sofern unvorhergesehene Ereignisse im Sinne von VI.3. die wirtschaftliche Bedeutung oder den Inhalt der Lieferung oder Leistung erheblich verändern oder auf unser Unternehmen erheblich einwirken, wird der Vertrag angemessen angepasst. Soweit dies wirtschaftlich nicht vertretbar ist, steht uns das Recht zu, vom Vertrag zurückzutreten. Sofern wir beabsichtigen, von diesem Rücktrittsrecht Gebrauch zu machen, werden wir dies nach Erkenntnis der Tragweite des Ereignisses unverzüglich dem Auftraggeber mitteilen und zwar auch dann, wenn zunächst mit dem Auftraggeber eine Verlängerung der Liefer- und Leistungszeit vereinbart war.</p>

            <h3>XI. Sonstige Schadensersatzansprüche</h3>
            <p>Anderweitige Schadersersatzansprüche des Auftraggebers gegen uns, unsere Erfüllungs- und Verrichtungsgehilfen, gleich aus welchem Rechtsgrund, sind ausgeschlossen. Ziffer IX.9. gilt entsprechend.</p>

            <h3>XII. Eigentumsvorbehalt</h3>
            <p>1. Die gelieferte Ware bleibt bis zur Bezahlung des Kaufpreises und Tilgung aller aus der Geschäftsverbindung bestehenden Forderungen und der im Zusammenhang mit dem Kaufgegenstand noch entstehenden Forderungen sowie aller zukünftig entstehenden Forderungen als Vorbehaltsware unser Eigentum. Die Einstellung einzelner Forderungen in eine laufende Rechnung oder die Saldo-Ziehung und deren Anerkennung heben den Eigentumsvorbehalt nicht auf.</p>
            <p>2. Bei Zahlungsverzug des Auftraggebers (Ziffer V.2.) sind wir zur Rücknahme der Vorbehaltsware berechtigt und der Auftraggeber zur Herausgabe verpflichtet.</p>
            <p>3. Wird Vorbehaltsware vom Auftraggeber, allein oder zusammen mit fremder Ware, veräußert, tritt der Auftraggeber schon jetzt die aus der Weiterveräußerung entstehenden Forderungen in Höhe des Wertes der Vorbehaltsware mit allen Nebenrechten und Rang vor dem Rest ab; wir nahmen die Abtretung an.</p>
            <p>4. Der Auftraggeber ist zur Weiterveräußerung, zur Verwendung oder zum Einbau der Vorbehaltsware nur im üblichen ordnungsgemäßen Geschäftsgang und nur mit der Maßgabe berechtigt, dass die Forderungen im Sinne von Ziffer 3. auf uns tatsächlich übergehen. Zu anderen Verfügungen über die Vorbehaltsware, insbesondere Verpfändung oder Sicherungsübereignung, ist der Auftraggeber nicht berechtigt.</p>
            <p>5. Über Zwangsvollstreckungsmaßnahmen Dritter in der Vorbehaltsware oder in die abgetretenen Forderungen muß uns der Auftraggeber unverzüglich unter Übergabe der für den Widerspruch notwendigen Unterlagen unterrichten, Interventionskosten gehen zu Lasten des Auftraggebers.</p>
            <p>6. Mit Zahlungseinstellung, Beantragung oder Eröffnung des Konkurses, des gerichtlichen oder außergerichtlichen Vergleichsverfahrens erlöschen das Recht zur Weiterveräußerung, zur Verwendung oder zum Einbau der Vorbehaltsware.</p>
            <p>7. Übersteigt der Wert der eingeräumten Sicherheiten die Forderungen um mehr als 20 v.H., sind wir insoweit zur Rückübertragung oder Freigabe von Sicherheiten nach unserer Wahl verpflichtet. Mit Tilgung aller Forderungen aus der Geschäftsverbindung gehen das Eigentum an der Vorbehaltsware und die abgetretenen Forderungen an den Auftraggeber über.</p>

            <h3>XIII. Nebenbestimmungen</h3>
            <p>1. Das Vertragsverhältnis unterliegt deutschem Recht, unter Ausschluß des Haager Einheitlichen Kaufsrechts. Ergänzend gelten in jedem Fall die Bestimmungen des Handelsgesetzbuches für Handelsgeschäfte unter Vollkaufleuten und subsidiär die Vorschriften des Bürgerlichen Gesetzbuches. Dies gilt auch, wenn der Auftraggeber Ausländer ist oder seinen Sitz im Ausland hat.</p>
            <p>2. Die etwaige Unwirksamkeit einzelner der vorstehenden Geschäftsbedingungen berührt nicht die Wirksamkeit der übrigen Bestimmungen.</p>
            <p>3. In jedem Fall ist die Zuständigkeit der ordentlichen Gerichte in Frankfurt Oder für die Geltendmachung von Ansprüchen im Mahnverfahren und bei unbekanntem Wohnsitz oder gewöhnlichem Aufenthalt des Auftraggebers zum Zeitpunkt der Klageerhebung ausdrücklich vereinbart. Im übrigen ist der Gerichtsstand Frankfurt Oder, auch wenn der Auftraggeber Vollkaufmann, juristische Person des öffentlichen Rechts oder öffentlichrechtliches Sondervermögen ist, oder er in der Bundesrepublik Deutschland keinen allgemeinen Gerichtsstand hat.</p>
        ',
        'back_to_home' => 'Back to Home',
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
    <link rel="stylesheet" href="styles.css">
    <meta name="description" content="Allgemeine Geschäftsbedingungen der EWI - Waagenbau und Industrieelektronik GmbH">
    <meta name="keywords" content="AGB, Geschäftsbedingungen, EWI, Waagenbau, Industrieelektronik">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-brand">
                <a href="index.php">
                    <img src="images/used/logo.jpg" alt="EWI Logo" class="logo">
                </a>
            </div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="index.php#home" class="nav-link"><?php echo $t['nav_home']; ?></a>
                </li>
                <li class="nav-item">
                    <a href="index.php#about" class="nav-link"><?php echo $t['nav_profile']; ?></a>
                </li>
                <li class="nav-item">
                    <a href="index.php#services" class="nav-link"><?php echo $t['nav_services']; ?></a>
                </li>
                <li class="nav-item">
                    <a href="index.php#references" class="nav-link"><?php echo $t['nav_references']; ?></a>
                </li>
                <li class="nav-item">
                    <a href="index.php#jobs" class="nav-link"><?php echo $t['nav_jobs']; ?></a>
                </li>
                <li class="nav-item">
                    <a href="index.php#contact" class="nav-link"><?php echo $t['nav_contact']; ?></a>
                </li>
                <li class="nav-item">
                    <a href="agb.php" class="nav-link active"><?php echo $t['nav_agb']; ?></a>
                </li>
            </ul>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav>

    <!-- AGB Content -->
    <main class="agb-page">
        <div class="container">
            <div class="agb-header">
                <h1><?php echo $t['agb_title']; ?></h1>
                <a href="index.php" class="back-link"><?php echo $t['back_to_home']; ?></a>
            </div>
            <div class="agb-content">
                <?php echo $t['agb_content']; ?>
            </div>
            <div class="agb-footer">
                <p><strong>Stand:</strong> <?php echo date('d.m.Y'); ?></p>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-copyright">
                <p><?php echo $t['footer_text']; ?></p>
                <p><a href="index.php">Startseite</a> | <a href="agb.php">AGB</a></p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
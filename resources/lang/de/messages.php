<?php

declare(strict_types=1);

return [
    'form' => [
        'label' => 'Adresse der Website',
        'button' => 'Prüfen',
        'hint' => 'Kostenlos · ohne Anmeldung · bis zu :count Prüfungen pro Stunde',
    ],
    'loading' => [
        'certificate' => 'Lese das SSL-Zertifikat',
        'headers' => 'Lade die Header der Seite',
        'checks' => 'Prüfe die Sicherheitseinstellungen',
    ],
    'verdicts' => [
        'ready' => 'Die Website ist gut geschützt',
        'almost' => 'Die Website ist fast gut geschützt',
        'partly' => 'Der Schutz der Website muss verbessert werden',
        'not_ready' => 'Die Website ist schlecht geschützt',
    ],
    'certificate' => [
        'title' => 'SSL-Zertifikat',
        'issuer' => 'Ausgestellt von',
        'valid_to' => 'Gültig bis',
        'days_left' => 'noch :days Tage',
        'protocol' => 'Verbindung',
        'names' => 'Domains',
        'none' => 'Die Website öffnet sich nicht über https: Auf Port 443 gibt es kein Zertifikat.',
    ],
    'groups' => [
        'C' => ['title' => 'Zertifikat und https', 'text' => 'Ob die Verbindung zur Website verschlüsselt und vertrauenswürdig ist'],
        'H' => ['title' => 'Sicherheits-Header', 'text' => 'Server-Header, die dem Browser sagen, wie er Besucher schützt'],
        'L' => ['title' => 'Lecks und Cookies', 'text' => 'Was der Server über sich verrät und wie er Cookies setzt'],
    ],
    'checks' => [
        'C1' => [
            'title' => 'Vertrauen Browser dem Zertifikat?',
            'text' => 'Ein gültiges Zertifikat für diese Domain',
            'fix' => 'Installieren Sie ein Zertifikat für diese Domain von einer bekannten Zertifizierungsstelle. Let\'s Encrypt stellt es kostenlos aus und verlängert es automatisch. Die meisten Hosting-Panels haben eine Schaltfläche „kostenloses SSL“.',
            'notes' => [
                'ok' => 'Das Zertifikat ist vertrauenswürdig, ausgestellt von :issuer.',
                'none' => 'Die Website öffnet sich nicht über https. Browser markieren sie als „Nicht sicher“, und Daten gehen unverschlüsselt.',
                'expired' => 'Das Zertifikat ist am :date abgelaufen. Browser zeigen eine ganzseitige Warnung.',
                'name_mismatch' => 'Das Zertifikat ist für andere Domains ausgestellt, nicht für :host. Browser zeigen eine Warnung.',
                'untrusted' => 'Browser vertrauen dem Zertifikat nicht (:issuer): Es ist selbstsigniert, oder die Zwischenzertifikate fehlen.',
            ],
        ],
        'C2' => [
            'title' => 'Läuft das Zertifikat bald ab?',
            'text' => 'Mindestens 30 Tage übrig',
            'fix' => 'Verlängern Sie das Zertifikat und stellen Sie sicher, dass die Verlängerung automatisch läuft: Let\'s-Encrypt-Zertifikate gelten 90 Tage, und die automatische Verlängerung bricht oft unbemerkt ab.',
            'notes' => [
                'ok' => 'Gültig bis :date, noch :days Tage.',
                'soon' => 'Nur noch :days Tage, bis :date. Stellen Sie sicher, dass es automatisch verlängert wird.',
                'urgent' => 'Nur noch :days Tage, bis :date. Verlängern Sie es jetzt.',
                'expired' => 'Das Zertifikat ist am :date abgelaufen.',
                'none' => 'Es gibt kein Zertifikat zu prüfen.',
            ],
        ],
        'C3' => [
            'title' => 'Führt http:// zu https://?',
            'text' => 'Eine Weiterleitung von http auf https',
            'fix' => 'Richten Sie eine dauerhafte (301) Weiterleitung von jeder http://-Adresse auf dieselbe https://-Adresse ein.',
            'notes' => [
                'ok' => 'Die http://-Adresse führt zu https://.',
                'none' => 'Die http://-Adresse öffnet sich unverschlüsselt: Wer die Adresse von Hand eingibt, bleibt auf der unsicheren Version.',
                'no_http' => 'Die Website antwortet nicht über http://, es gibt also nichts weiterzuleiten.',
            ],
        ],
        'C4' => [
            'title' => 'Ist die Verbindung modern?',
            'text' => 'TLS 1.2 oder 1.3',
            'fix' => 'Schalten Sie TLS 1.2 und 1.3 in den Servereinstellungen ein und die alten Versionen aus: Browser öffnen Websites mit TLS 1.0 und 1.1 nicht mehr.',
            'notes' => [
                'ok' => 'Die Verbindung nutzt :protocol.',
                'old' => 'Die Verbindung nutzt :protocol, eine veraltete Version.',
                'none' => 'Es gibt keine https-Verbindung zu prüfen.',
            ],
        ],
        'H1' => [
            'title' => 'Nutzt der Browser immer https?',
            'text' => 'Strict-Transport-Security für mindestens 6 Monate',
            'fix' => 'Fügen Sie den Header Strict-Transport-Security mit einem max-age von mindestens einem halben Jahr (besser einem Jahr) und includeSubDomains hinzu. Dann öffnet der Browser die Website nur über https, auch über einen alten http://-Link.',
            'notes' => [
                'ok' => 'HSTS ist für :days Tage aktiv, Subdomains eingeschlossen.',
                'none' => 'Es gibt keinen HSTS-Header: Der erste Besuch über http:// kann abgefangen werden.',
                'short' => 'HSTS ist nur für :days Tage aktiv. Setzen Sie mindestens 180 Tage.',
                'no_subdomains' => 'HSTS gilt nicht für Subdomains: Fügen Sie includeSubDomains hinzu.',
                'no_https' => 'Die Website öffnet sich nicht über https, daher kann HSTS nicht wirken.',
            ],
        ],
        'H2' => [
            'title' => 'Sind Skripte eingeschränkt?',
            'text' => 'Content-Security-Policy',
            'fix' => 'Fügen Sie eine Content-Security-Policy mit der Liste der Quellen hinzu, aus denen Skripte, Styles und Bilder kommen dürfen. Beginnen Sie mit Content-Security-Policy-Report-Only, um zu sehen, was brechen würde, und schalten Sie sie dann ein.',
            'notes' => [
                'ok' => 'Es gibt eine Richtlinie ohne unsafe-inline und unsafe-eval für Skripte.',
                'none' => 'Es gibt keine Content-Security-Policy: Ein eingeschleustes Skript (XSS) kann ohne Grenzen laufen.',
                'report_only' => 'Die Richtlinie ist im Berichtsmodus: Sie meldet Verstöße, blockiert aber nichts.',
                'unsafe' => 'Die Richtlinie erlaubt :keywords für Skripte und verliert damit den größten Teil ihres Schutzes gegen XSS.',
            ],
        ],
        'H3' => [
            'title' => 'Können andere Websites die Seite in einem Frame zeigen?',
            'text' => 'X-Frame-Options oder frame-ancestors',
            'fix' => 'Fügen Sie X-Frame-Options: SAMEORIGIN oder frame-ancestors \'self\' in der Content-Security-Policy hinzu, damit andere Websites die Seite nicht unter einen falschen Button legen können (Clickjacking).',
            'notes' => [
                'ok' => 'X-Frame-Options verbietet Frames auf anderen Websites.',
                'csp' => 'frame-ancestors in der Content-Security-Policy steuert die Frames.',
                'none' => 'Jede Website kann die Seite in einem Frame zeigen.',
                'invalid' => 'Ein veralteter oder unbekannter Wert von X-Frame-Options: Browser ignorieren ihn.',
            ],
        ],
        'H4' => [
            'title' => 'Errät der Browser Dateitypen?',
            'text' => 'X-Content-Type-Options: nosniff',
            'fix' => 'Fügen Sie X-Content-Type-Options: nosniff hinzu, damit der Browser eine Datei nicht als Skript ausführt, wenn der Server sagt, dass sie etwas anderes ist.',
            'notes' => [
                'ok' => 'nosniff ist aktiv.',
                'none' => 'Es gibt keinen X-Content-Type-Options-Header.',
                'invalid' => 'Ein unbekannter Wert: Gültig ist nur nosniff.',
            ],
        ],
        'H5' => [
            'title' => 'Gelangen Seitenadressen zu anderen Websites?',
            'text' => 'Referrer-Policy',
            'fix' => 'Fügen Sie Referrer-Policy: strict-origin-when-cross-origin hinzu: Andere Websites erhalten nur die Domain, ohne die Adresse der Seite und ihre Parameter.',
            'notes' => [
                'ok' => 'Die Richtlinie ist gesetzt.',
                'none' => 'Es gibt keinen Referrer-Policy-Header; der Browser nutzt seinen Standard.',
                'leaky' => 'Die Richtlinie sendet vollständige Seitenadressen an andere Websites, samt Parametern und Tokens.',
            ],
        ],
        'H6' => [
            'title' => 'Sind ungenutzte Browserfunktionen aus?',
            'text' => 'Permissions-Policy',
            'fix' => 'Fügen Sie eine Permissions-Policy hinzu und schalten Sie aus, was die Website nicht nutzt: Kamera, Mikrofon, Standort, Zahlungen. Dann kann selbst ein eingeschleustes Skript nicht danach fragen.',
            'notes' => [
                'ok' => 'Die Richtlinie ist gesetzt.',
                'none' => 'Es gibt keinen Permissions-Policy-Header.',
                'legacy' => 'Es gibt nur den alten Header Feature-Policy: Browser haben ihn durch Permissions-Policy ersetzt.',
            ],
        ],
        'L1' => [
            'title' => 'Verrät der Server seine Version?',
            'text' => 'Server und X-Powered-By ohne Versionen',
            'fix' => 'Verbergen Sie die Versionen von Server, PHP und Plattform in den Headern: Damit finden Bots Websites mit bekannten Lücken in Sekunden.',
            'notes' => [
                'ok' => 'Die Header verraten keine Versionen.',
                'leaks' => 'Die Header verraten die Versionen der Software.',
            ],
        ],
        'L2' => [
            'title' => 'Sind die Cookies geschützt?',
            'text' => 'Die Flags Secure, HttpOnly und SameSite',
            'fix' => 'Setzen Sie bei jedem Cookie Secure, damit es nur über https geht, HttpOnly, damit Skripte es nicht lesen können, und SameSite=Lax, damit andere Websites es nicht senden.',
            'notes' => [
                'ok' => 'Alle :count Cookies haben die Schutz-Flags.',
                'insecure' => 'Einige der :count Cookies haben kein Secure-Flag und können über eine unverschlüsselte Verbindung gehen.',
                'partial' => 'Einigen der :count Cookies fehlt HttpOnly oder SameSite.',
                'none' => 'Die Seite setzt keine Cookies.',
            ],
        ],
    ],
];

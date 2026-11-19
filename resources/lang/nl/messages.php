<?php

return [
    'form' => [
        'label' => 'Adres van de website',
        'button' => 'Controleren',
        'hint' => 'Gratis · zonder registratie · tot :count controles per uur',
    ],
    'loading' => [
        'certificate' => 'Het SSL-certificaat lezen',
        'headers' => 'De headers van de pagina laden',
        'checks' => 'De beveiligingsinstellingen controleren',
    ],
    'verdicts' => [
        'ready' => 'De website is goed beveiligd',
        'almost' => 'De website is bijna goed beveiligd',
        'partly' => 'De beveiliging van de website moet beter',
        'not_ready' => 'De website is slecht beveiligd',
    ],
    'certificate' => [
        'title' => 'SSL-certificaat',
        'issuer' => 'Uitgegeven door',
        'valid_to' => 'Geldig tot',
        'days_left' => 'nog :days dagen',
        'protocol' => 'Verbinding',
        'names' => 'Domeinen',
        'none' => 'De website opent niet via https: op poort 443 is er geen certificaat.',
    ],
    'groups' => [
        'C' => ['title' => 'Certificaat en https', 'text' => 'Of de verbinding met de website versleuteld en betrouwbaar is'],
        'H' => ['title' => 'Beveiligingsheaders', 'text' => 'Serverheaders die de browser vertellen hoe bezoekers te beschermen'],
        'L' => ['title' => 'Lekken en cookies', 'text' => 'Wat de server over zichzelf vertelt en hoe hij cookies zet'],
    ],
    'checks' => [
        'C1' => [
            'title' => 'Vertrouwen browsers het certificaat?',
            'text' => 'Een geldig certificaat voor dit domein',
            'fix' => 'Installeer een certificaat voor dit domein van een bekende certificaatautoriteit. Let\'s Encrypt geeft het gratis en verlengt het automatisch. De meeste hostingpanelen hebben een knop „gratis SSL”.',
            'notes' => [
                'ok' => 'Het certificaat wordt vertrouwd, uitgegeven door :issuer.',
                'none' => 'De website opent niet via https. Browsers markeren hem als „Niet veilig” en gegevens gaan onversleuteld.',
                'expired' => 'Het certificaat is verlopen op :date. Browsers tonen een waarschuwing over de hele pagina.',
                'name_mismatch' => 'Het certificaat is uitgegeven voor andere domeinen, niet voor :host. Browsers tonen een waarschuwing.',
                'untrusted' => 'Browsers vertrouwen het certificaat niet (:issuer): het is zelfondertekend of de tussencertificaten ontbreken.',
            ],
        ],
        'C2' => [
            'title' => 'Verloopt het certificaat binnenkort?',
            'text' => 'Nog minstens 30 dagen',
            'fix' => 'Verleng het certificaat en zorg dat verlengen automatisch gaat: certificaten van Let\'s Encrypt gelden 90 dagen, en automatisch verlengen gaat vaak ongemerkt stuk.',
            'notes' => [
                'ok' => 'Geldig tot :date, nog :days dagen.',
                'soon' => 'Nog maar :days dagen, tot :date. Zorg dat het automatisch wordt verlengd.',
                'urgent' => 'Nog maar :days dagen, tot :date. Verleng het nu.',
                'expired' => 'Het certificaat is verlopen op :date.',
                'none' => 'Er is geen certificaat om te controleren.',
            ],
        ],
        'C3' => [
            'title' => 'Leidt http:// naar https://?',
            'text' => 'Een doorverwijzing van http naar https',
            'fix' => 'Stel een permanente (301) doorverwijzing in van elk http://-adres naar hetzelfde https://-adres.',
            'notes' => [
                'ok' => 'Het http://-adres leidt naar https://.',
                'none' => 'Het http://-adres opent zonder versleuteling: wie het adres met de hand typt, blijft op de onveilige versie.',
                'no_http' => 'De website antwoordt niet via http://, dus er is niets door te verwijzen.',
            ],
        ],
        'C4' => [
            'title' => 'Is de verbinding modern?',
            'text' => 'TLS 1.2 of 1.3',
            'fix' => 'Zet TLS 1.2 en 1.3 aan in de serverinstellingen en de oude versies uit: browsers openen geen websites meer met TLS 1.0 en 1.1.',
            'notes' => [
                'ok' => 'De verbinding gebruikt :protocol.',
                'old' => 'De verbinding gebruikt :protocol, een verouderde versie.',
                'none' => 'Er is geen https-verbinding om te controleren.',
            ],
        ],
        'H1' => [
            'title' => 'Gebruikt de browser altijd https?',
            'text' => 'Strict-Transport-Security voor minstens 6 maanden',
            'fix' => 'Voeg de header Strict-Transport-Security toe met een max-age van minstens een half jaar (beter een jaar) en includeSubDomains. Dan opent de browser de website alleen via https, ook vanaf een oude http://-link.',
            'notes' => [
                'ok' => 'HSTS staat aan voor :days dagen, subdomeinen inbegrepen.',
                'none' => 'Er is geen HSTS-header: het eerste bezoek via http:// kan worden onderschept.',
                'short' => 'HSTS staat maar :days dagen aan. Stel minstens 180 dagen in.',
                'no_subdomains' => 'HSTS geldt niet voor subdomeinen: voeg includeSubDomains toe.',
                'no_https' => 'De website opent niet via https, dus HSTS kan niet werken.',
            ],
        ],
        'H2' => [
            'title' => 'Zijn scripts beperkt?',
            'text' => 'Content-Security-Policy',
            'fix' => 'Voeg een Content-Security-Policy toe met de lijst van bronnen waar scripts, stijlen en afbeeldingen vandaan mogen komen. Begin met Content-Security-Policy-Report-Only om te zien wat zou breken, en zet hem daarna aan.',
            'notes' => [
                'ok' => 'Er is een beleid zonder unsafe-inline en unsafe-eval voor scripts.',
                'none' => 'Er is geen Content-Security-Policy: een geïnjecteerd script (XSS) kan zonder grenzen draaien.',
                'report_only' => 'Het beleid staat in rapportagemodus: het meldt overtredingen, maar blokkeert niets.',
                'unsafe' => 'Het beleid staat :keywords toe voor scripts, waardoor het de meeste bescherming tegen XSS verliest.',
            ],
        ],
        'H3' => [
            'title' => 'Kunnen andere websites de pagina in een frame tonen?',
            'text' => 'X-Frame-Options of frame-ancestors',
            'fix' => 'Voeg X-Frame-Options: SAMEORIGIN toe, of frame-ancestors \'self\' in de Content-Security-Policy, zodat andere websites de pagina niet onder een nepknop kunnen leggen (clickjacking).',
            'notes' => [
                'ok' => 'X-Frame-Options verbiedt frames op andere websites.',
                'csp' => 'frame-ancestors in de Content-Security-Policy regelt de frames.',
                'none' => 'Elke website kan de pagina in een frame tonen.',
                'invalid' => 'Een verouderde of onbekende waarde van X-Frame-Options: browsers negeren hem.',
            ],
        ],
        'H4' => [
            'title' => 'Raadt de browser bestandstypen?',
            'text' => 'X-Content-Type-Options: nosniff',
            'fix' => 'Voeg X-Content-Type-Options: nosniff toe, zodat de browser een bestand niet als script uitvoert wanneer de server zegt dat het iets anders is.',
            'notes' => [
                'ok' => 'nosniff staat aan.',
                'none' => 'Er is geen X-Content-Type-Options-header.',
                'invalid' => 'Een onbekende waarde: alleen nosniff is geldig.',
            ],
        ],
        'H5' => [
            'title' => 'Lekken paginaadressen naar andere websites?',
            'text' => 'Referrer-Policy',
            'fix' => 'Voeg Referrer-Policy: strict-origin-when-cross-origin toe: andere websites krijgen alleen het domein, zonder het adres van de pagina en de parameters.',
            'notes' => [
                'ok' => 'Het beleid is ingesteld.',
                'none' => 'Er is geen Referrer-Policy-header; de browser gebruikt zijn standaard.',
                'leaky' => 'Het beleid stuurt volledige paginaadressen naar andere websites, met parameters en tokens.',
            ],
        ],
        'H6' => [
            'title' => 'Staan ongebruikte browserfuncties uit?',
            'text' => 'Permissions-Policy',
            'fix' => 'Voeg een Permissions-Policy toe en zet uit wat de website niet gebruikt: camera, microfoon, locatie, betalingen. Dan kan zelfs een geïnjecteerd script er niet om vragen.',
            'notes' => [
                'ok' => 'Het beleid is ingesteld.',
                'none' => 'Er is geen Permissions-Policy-header.',
                'legacy' => 'Er is alleen de oude header Feature-Policy: browsers hebben die vervangen door Permissions-Policy.',
            ],
        ],
        'L1' => [
            'title' => 'Vertelt de server zijn versie?',
            'text' => 'Server en X-Powered-By zonder versies',
            'fix' => 'Verberg de versies van de server, PHP en het platform in de headers: daarmee vinden bots in seconden websites met bekende lekken.',
            'notes' => [
                'ok' => 'De headers vertellen geen versies.',
                'leaks' => 'De headers vertellen de versies van de software.',
            ],
        ],
        'L2' => [
            'title' => 'Zijn de cookies beschermd?',
            'text' => 'De vlaggen Secure, HttpOnly en SameSite',
            'fix' => 'Zet Secure op elke cookie zodat hij alleen via https gaat, HttpOnly zodat scripts hem niet kunnen lezen, en SameSite=Lax zodat andere websites hem niet meesturen.',
            'notes' => [
                'ok' => 'Alle :count cookies hebben de beschermende vlaggen.',
                'insecure' => 'Sommige van de :count cookies hebben geen Secure-vlag en kunnen over een onversleutelde verbinding gaan.',
                'partial' => 'Sommige van de :count cookies missen HttpOnly of SameSite.',
                'none' => 'De pagina zet geen cookies.',
            ],
        ],
    ],
];

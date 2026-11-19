<?php

declare(strict_types=1);

return [
    'form' => [
        'label' => 'Indirizzo del sito',
        'button' => 'Verifica',
        'hint' => 'Gratis · senza registrazione · fino a :count verifiche all\'ora',
    ],
    'loading' => [
        'certificate' => 'Leggo il certificato SSL',
        'headers' => 'Carico le intestazioni della pagina',
        'checks' => 'Verifico le impostazioni di sicurezza',
    ],
    'verdicts' => [
        'ready' => 'Il sito è ben protetto',
        'almost' => 'Il sito è quasi ben protetto',
        'partly' => 'La protezione del sito va migliorata',
        'not_ready' => 'Il sito è protetto male',
    ],
    'certificate' => [
        'title' => 'Certificato SSL',
        'issuer' => 'Rilasciato da',
        'valid_to' => 'Valido fino al',
        'days_left' => 'mancano :days giorni',
        'protocol' => 'Connessione',
        'names' => 'Domini',
        'none' => 'Il sito non si apre in https: sulla porta 443 non c\'è un certificato.',
    ],
    'groups' => [
        'C' => ['title' => 'Certificato e https', 'text' => 'Se la connessione al sito è cifrata e affidabile'],
        'H' => ['title' => 'Intestazioni di sicurezza', 'text' => 'Intestazioni del server che dicono al browser come proteggere i visitatori'],
        'L' => ['title' => 'Fughe e cookie', 'text' => 'Cosa dice di sé il server e come imposta i cookie'],
    ],
    'checks' => [
        'C1' => [
            'title' => 'I browser si fidano del certificato?',
            'text' => 'Un certificato valido per questo dominio',
            'fix' => 'Installate un certificato per questo dominio da un\'autorità nota. Let\'s Encrypt lo rilascia gratis e lo rinnova automaticamente. La maggior parte dei pannelli di hosting ha un pulsante «SSL gratuito».',
            'notes' => [
                'ok' => 'Il certificato è affidabile, rilasciato da :issuer.',
                'none' => 'Il sito non si apre in https. I browser lo segnano come «Non sicuro» e i dati viaggiano senza cifratura.',
                'expired' => 'Il certificato è scaduto il :date. I browser mostrano un avviso a tutta pagina.',
                'name_mismatch' => 'Il certificato è rilasciato per altri domini, non per :host. I browser mostrano un avviso.',
                'untrusted' => 'I browser non si fidano del certificato (:issuer): è autofirmato o mancano i certificati intermedi.',
            ],
        ],
        'C2' => [
            'title' => 'Il certificato scade presto?',
            'text' => 'Almeno 30 giorni rimasti',
            'fix' => 'Rinnovate il certificato e controllate che il rinnovo sia automatico: i certificati Let\'s Encrypt durano 90 giorni e il rinnovo automatico spesso si guasta in silenzio.',
            'notes' => [
                'ok' => 'Valido fino al :date, mancano :days giorni.',
                'soon' => 'Mancano solo :days giorni, fino al :date. Controllate che si rinnovi automaticamente.',
                'urgent' => 'Mancano solo :days giorni, fino al :date. Rinnovatelo adesso.',
                'expired' => 'Il certificato è scaduto il :date.',
                'none' => 'Non c\'è un certificato da verificare.',
            ],
        ],
        'C3' => [
            'title' => 'http:// porta a https://?',
            'text' => 'Un reindirizzamento da http a https',
            'fix' => 'Impostate un reindirizzamento permanente (301) da ogni indirizzo http:// allo stesso indirizzo https://.',
            'notes' => [
                'ok' => 'L\'indirizzo http:// porta a https://.',
                'none' => 'L\'indirizzo http:// si apre senza cifratura: chi digita l\'indirizzo a mano resta sulla versione non sicura.',
                'no_http' => 'Il sito non risponde in http://, quindi non c\'è nulla da reindirizzare.',
            ],
        ],
        'C4' => [
            'title' => 'La connessione è moderna?',
            'text' => 'TLS 1.2 o 1.3',
            'fix' => 'Attivate TLS 1.2 e 1.3 nelle impostazioni del server e disattivate le versioni vecchie: i browser non aprono più i siti con TLS 1.0 e 1.1.',
            'notes' => [
                'ok' => 'La connessione usa :protocol.',
                'old' => 'La connessione usa :protocol, una versione superata.',
                'none' => 'Non c\'è una connessione https da verificare.',
            ],
        ],
        'H1' => [
            'title' => 'Il browser usa sempre https?',
            'text' => 'Strict-Transport-Security per almeno 6 mesi',
            'fix' => 'Aggiungete l\'intestazione Strict-Transport-Security con max-age di almeno sei mesi (meglio un anno) e includeSubDomains. Così il browser apre il sito solo in https, anche da un vecchio link http://.',
            'notes' => [
                'ok' => 'HSTS è attivo per :days giorni, sottodomini compresi.',
                'none' => 'Non c\'è l\'intestazione HSTS: la prima visita in http:// può essere intercettata.',
                'short' => 'HSTS è attivo solo per :days giorni. Impostate almeno 180.',
                'no_subdomains' => 'HSTS non copre i sottodomini: aggiungete includeSubDomains.',
                'no_https' => 'Il sito non si apre in https, quindi HSTS non può funzionare.',
            ],
        ],
        'H2' => [
            'title' => 'Gli script sono limitati?',
            'text' => 'Content-Security-Policy',
            'fix' => 'Aggiungete una Content-Security-Policy con l\'elenco delle origini da cui possono arrivare script, stili e immagini. Iniziate con Content-Security-Policy-Report-Only per vedere cosa si romperebbe, poi attivatela.',
            'notes' => [
                'ok' => 'C\'è una policy senza unsafe-inline e unsafe-eval per gli script.',
                'none' => 'Non c\'è una Content-Security-Policy: uno script iniettato (XSS) può girare senza limiti.',
                'report_only' => 'La policy è in modalità report: segnala le violazioni ma non blocca nulla.',
                'unsafe' => 'La policy consente :keywords per gli script, e questo le toglie gran parte della protezione contro gli XSS.',
            ],
        ],
        'H3' => [
            'title' => 'Altri siti possono mostrare la pagina in un frame?',
            'text' => 'X-Frame-Options o frame-ancestors',
            'fix' => 'Aggiungete X-Frame-Options: SAMEORIGIN, oppure frame-ancestors \'self\' nella Content-Security-Policy, così altri siti non possono mettere la pagina sotto un falso pulsante (clickjacking).',
            'notes' => [
                'ok' => 'X-Frame-Options vieta i frame su altri siti.',
                'csp' => 'I frame sono controllati da frame-ancestors nella Content-Security-Policy.',
                'none' => 'Qualsiasi sito può mostrare la pagina in un frame.',
                'invalid' => 'Un valore di X-Frame-Options superato o sconosciuto: i browser lo ignorano.',
            ],
        ],
        'H4' => [
            'title' => 'Il browser indovina i tipi di file?',
            'text' => 'X-Content-Type-Options: nosniff',
            'fix' => 'Aggiungete X-Content-Type-Options: nosniff così il browser non esegue un file come script quando il server dice che è altro.',
            'notes' => [
                'ok' => 'nosniff è attivo.',
                'none' => 'Non c\'è l\'intestazione X-Content-Type-Options.',
                'invalid' => 'Un valore sconosciuto: l\'unico valido è nosniff.',
            ],
        ],
        'H5' => [
            'title' => 'Gli indirizzi delle pagine finiscono ad altri siti?',
            'text' => 'Referrer-Policy',
            'fix' => 'Aggiungete Referrer-Policy: strict-origin-when-cross-origin: gli altri siti ricevono solo il dominio, senza l\'indirizzo della pagina e i suoi parametri.',
            'notes' => [
                'ok' => 'La policy è impostata.',
                'none' => 'Non c\'è l\'intestazione Referrer-Policy; il browser usa il suo valore predefinito.',
                'leaky' => 'La policy invia ad altri siti gli indirizzi completi delle pagine, parametri e token compresi.',
            ],
        ],
        'H6' => [
            'title' => 'Le funzioni del browser non usate sono spente?',
            'text' => 'Permissions-Policy',
            'fix' => 'Aggiungete una Permissions-Policy e spegnete ciò che il sito non usa: fotocamera, microfono, posizione, pagamenti. Così nemmeno uno script iniettato potrà chiederli.',
            'notes' => [
                'ok' => 'La policy è impostata.',
                'none' => 'Non c\'è l\'intestazione Permissions-Policy.',
                'legacy' => 'C\'è solo la vecchia intestazione Feature-Policy: i browser l\'hanno sostituita con Permissions-Policy.',
            ],
        ],
        'L1' => [
            'title' => 'Il server rivela la sua versione?',
            'text' => 'Server e X-Powered-By senza versioni',
            'fix' => 'Nascondete le versioni del server, di PHP e della piattaforma nelle intestazioni: con esse i bot trovano in pochi secondi i siti con falle note.',
            'notes' => [
                'ok' => 'Le intestazioni non rivelano versioni.',
                'leaks' => 'Le intestazioni rivelano le versioni del software.',
            ],
        ],
        'L2' => [
            'title' => 'I cookie sono protetti?',
            'text' => 'Gli attributi Secure, HttpOnly e SameSite',
            'fix' => 'Mettete Secure su ogni cookie perché viaggi solo in https, HttpOnly perché gli script non possano leggerlo e SameSite=Lax perché altri siti non lo inviino.',
            'notes' => [
                'ok' => 'Tutti i :count cookie hanno gli attributi di protezione.',
                'insecure' => 'Alcuni dei :count cookie non hanno l\'attributo Secure e possono viaggiare su una connessione non cifrata.',
                'partial' => 'Ad alcuni dei :count cookie mancano HttpOnly o SameSite.',
                'none' => 'La pagina non imposta cookie.',
            ],
        ],
    ],
];

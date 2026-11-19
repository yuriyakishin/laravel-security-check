<?php

return [
    'form' => [
        'label' => 'Adresa webu',
        'button' => 'Zkontrolovat',
        'hint' => 'Zdarma · bez registrace · až :count kontrol za hodinu',
    ],
    'loading' => [
        'certificate' => 'Čtu certifikát SSL',
        'headers' => 'Načítám hlavičky stránky',
        'checks' => 'Kontroluji nastavení zabezpečení',
    ],
    'verdicts' => [
        'ready' => 'Web je dobře chráněný',
        'almost' => 'Web je téměř dobře chráněný',
        'partly' => 'Ochranu webu je třeba zlepšit',
        'not_ready' => 'Web je špatně chráněný',
    ],
    'certificate' => [
        'title' => 'Certifikát SSL',
        'issuer' => 'Vydal',
        'valid_to' => 'Platí do',
        'days_left' => 'zbývá dní: :days',
        'protocol' => 'Spojení',
        'names' => 'Domény',
        'none' => 'Web se neotevírá přes https: na portu 443 není certifikát.',
    ],
    'groups' => [
        'C' => ['title' => 'Certifikát a https', 'text' => 'Zda je spojení s webem šifrované a důvěryhodné'],
        'H' => ['title' => 'Bezpečnostní hlavičky', 'text' => 'Hlavičky serveru, které prohlížeči říkají, jak chránit návštěvníky'],
        'L' => ['title' => 'Úniky a cookies', 'text' => 'Co server prozrazuje o sobě a jak nastavuje cookies'],
    ],
    'checks' => [
        'C1' => [
            'title' => 'Důvěřují prohlížeče certifikátu?',
            'text' => 'Platný certifikát pro tuto doménu',
            'fix' => 'Nainstalujte certifikát pro tuto doménu od známé certifikační autority. Let\'s Encrypt ho vydává zdarma a obnovuje automaticky. Většina panelů hostingu má tlačítko „SSL zdarma“.',
            'notes' => [
                'ok' => 'Certifikát je důvěryhodný, vydal ho :issuer.',
                'none' => 'Web se neotevírá přes https. Prohlížeče ho označují „Nezabezpečeno“ a data jdou bez šifrování.',
                'expired' => 'Platnost certifikátu skončila :date. Prohlížeče ukazují varování přes celou stránku.',
                'name_mismatch' => 'Certifikát je vydaný pro jiné domény, ne pro :host. Prohlížeče ukazují varování.',
                'untrusted' => 'Prohlížeče certifikátu nedůvěřují (:issuer): je podepsaný sám sebou, nebo chybí mezilehlé certifikáty.',
            ],
        ],
        'C2' => [
            'title' => 'Vyprší certifikát brzy?',
            'text' => 'Zbývá alespoň 30 dní',
            'fix' => 'Obnovte certifikát a ověřte, že obnova je automatická: certifikáty Let\'s Encrypt platí 90 dní a automatická obnova se často potichu rozbije.',
            'notes' => [
                'ok' => 'Platí do :date, zbývá dní: :days.',
                'soon' => 'Zbývá jen dní: :days, do :date. Ověřte, že se obnoví automaticky.',
                'urgent' => 'Zbývá jen dní: :days, do :date. Obnovte ho hned.',
                'expired' => 'Platnost certifikátu skončila :date.',
                'none' => 'Není co kontrolovat: certifikát chybí.',
            ],
        ],
        'C3' => [
            'title' => 'Vede http:// na https://?',
            'text' => 'Přesměrování z http na https',
            'fix' => 'Nastavte trvalé (301) přesměrování z každé adresy http:// na stejnou adresu https://.',
            'notes' => [
                'ok' => 'Adresa http:// vede na https://.',
                'none' => 'Adresa http:// se otevírá bez šifrování: kdo píše adresu ručně, zůstane na nezabezpečené verzi.',
                'no_http' => 'Web neodpovídá přes http://, takže není co přesměrovat.',
            ],
        ],
        'C4' => [
            'title' => 'Je spojení moderní?',
            'text' => 'TLS 1.2 nebo 1.3',
            'fix' => 'Zapněte v nastavení serveru TLS 1.2 a 1.3 a vypněte staré verze: prohlížeče už weby s TLS 1.0 a 1.1 neotevírají.',
            'notes' => [
                'ok' => 'Spojení používá :protocol.',
                'old' => 'Spojení používá :protocol, zastaralou verzi.',
                'none' => 'Není https spojení ke kontrole.',
            ],
        ],
        'H1' => [
            'title' => 'Používá prohlížeč vždy https?',
            'text' => 'Strict-Transport-Security alespoň na 6 měsíců',
            'fix' => 'Přidejte hlavičku Strict-Transport-Security s max-age alespoň půl roku (lépe rok) a includeSubDomains. Pak prohlížeč otevírá web jen přes https, i ze starého odkazu http://.',
            'notes' => [
                'ok' => 'HSTS je zapnuté na :days dní, včetně subdomén.',
                'none' => 'Hlavička HSTS chybí: první návštěvu přes http:// lze zachytit.',
                'short' => 'HSTS je zapnuté jen na :days dní. Nastavte alespoň 180.',
                'no_subdomains' => 'HSTS nepokrývá subdomény: přidejte includeSubDomains.',
                'no_https' => 'Web se neotevírá přes https, takže HSTS nemůže fungovat.',
            ],
        ],
        'H2' => [
            'title' => 'Jsou skripty omezené?',
            'text' => 'Content-Security-Policy',
            'fix' => 'Přidejte Content-Security-Policy se seznamem zdrojů, odkud smějí pocházet skripty, styly a obrázky. Začněte s Content-Security-Policy-Report-Only, abyste viděli, co by se rozbilo, a pak ji zapněte.',
            'notes' => [
                'ok' => 'Je tu zásada bez unsafe-inline a unsafe-eval pro skripty.',
                'none' => 'Content-Security-Policy chybí: vložený skript (XSS) může běžet bez omezení.',
                'report_only' => 'Zásada je v režimu hlášení: hlásí porušení, ale nic neblokuje.',
                'unsafe' => 'Zásada povoluje :keywords pro skripty, a tím ztrácí většinu ochrany proti XSS.',
            ],
        ],
        'H3' => [
            'title' => 'Mohou jiné weby zobrazit stránku v rámu?',
            'text' => 'X-Frame-Options nebo frame-ancestors',
            'fix' => 'Přidejte X-Frame-Options: SAMEORIGIN nebo frame-ancestors \'self\' v Content-Security-Policy, aby jiné weby nemohly stránku podsunout pod falešné tlačítko (clickjacking).',
            'notes' => [
                'ok' => 'X-Frame-Options zakazuje rámy na jiných webech.',
                'csp' => 'Rámy řídí frame-ancestors v Content-Security-Policy.',
                'none' => 'Jakýkoli web může stránku zobrazit v rámu.',
                'invalid' => 'Zastaralá nebo neznámá hodnota X-Frame-Options: prohlížeče ji ignorují.',
            ],
        ],
        'H4' => [
            'title' => 'Hádá prohlížeč typy souborů?',
            'text' => 'X-Content-Type-Options: nosniff',
            'fix' => 'Přidejte X-Content-Type-Options: nosniff, aby prohlížeč nespustil soubor jako skript, když server říká, že je to něco jiného.',
            'notes' => [
                'ok' => 'nosniff je zapnuté.',
                'none' => 'Hlavička X-Content-Type-Options chybí.',
                'invalid' => 'Neznámá hodnota: platná je jen nosniff.',
            ],
        ],
        'H5' => [
            'title' => 'Unikají adresy stránek na jiné weby?',
            'text' => 'Referrer-Policy',
            'fix' => 'Přidejte Referrer-Policy: strict-origin-when-cross-origin: jiné weby dostanou jen doménu, bez adresy stránky a jejích parametrů.',
            'notes' => [
                'ok' => 'Zásada je nastavená.',
                'none' => 'Hlavička Referrer-Policy chybí; prohlížeč použije svou výchozí hodnotu.',
                'leaky' => 'Zásada posílá jiným webům celé adresy stránek, včetně parametrů a tokenů.',
            ],
        ],
        'H6' => [
            'title' => 'Jsou nepoužívané funkce prohlížeče vypnuté?',
            'text' => 'Permissions-Policy',
            'fix' => 'Přidejte Permissions-Policy a vypněte, co web nepoužívá: kameru, mikrofon, polohu, platby. Pak o ně nepožádá ani vložený skript.',
            'notes' => [
                'ok' => 'Zásada je nastavená.',
                'none' => 'Hlavička Permissions-Policy chybí.',
                'legacy' => 'Je tu jen stará hlavička Feature-Policy: prohlížeče ji nahradily hlavičkou Permissions-Policy.',
            ],
        ],
        'L1' => [
            'title' => 'Prozrazuje server svou verzi?',
            'text' => 'Server a X-Powered-By bez verzí',
            'fix' => 'Skryjte v hlavičkách verze serveru, PHP a platformy: podle nich boti během sekund najdou weby se známými chybami.',
            'notes' => [
                'ok' => 'Hlavičky neprozrazují žádné verze.',
                'leaks' => 'Hlavičky prozrazují verze softwaru.',
            ],
        ],
        'L2' => [
            'title' => 'Jsou cookies chráněné?',
            'text' => 'Příznaky Secure, HttpOnly a SameSite',
            'fix' => 'Dejte každé cookie Secure, aby šla jen přes https, HttpOnly, aby ji skripty nemohly číst, a SameSite=Lax, aby ji neposílaly jiné weby.',
            'notes' => [
                'ok' => 'Všechny cookies (:count) mají ochranné příznaky.',
                'insecure' => 'Některé z :count cookies nemají příznak Secure a mohou jít nešifrovaným spojením.',
                'partial' => 'Některým z :count cookies chybí HttpOnly nebo SameSite.',
                'none' => 'Stránka nenastavuje žádné cookies.',
            ],
        ],
    ],
];

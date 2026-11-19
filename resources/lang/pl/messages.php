<?php

declare(strict_types=1);

return [
    'form' => [
        'label' => 'Adres strony',
        'button' => 'Sprawdź',
        'hint' => 'Za darmo · bez rejestracji · do :count sprawdzeń na godzinę',
    ],
    'loading' => [
        'certificate' => 'Odczytuję certyfikat SSL',
        'headers' => 'Pobieram nagłówki strony',
        'checks' => 'Sprawdzam ustawienia bezpieczeństwa',
    ],
    'verdicts' => [
        'ready' => 'Strona jest dobrze chroniona',
        'almost' => 'Strona jest prawie dobrze chroniona',
        'partly' => 'Ochronę strony trzeba poprawić',
        'not_ready' => 'Strona jest słabo chroniona',
    ],
    'certificate' => [
        'title' => 'Certyfikat SSL',
        'issuer' => 'Wydany przez',
        'valid_to' => 'Ważny do',
        'days_left' => 'zostało dni: :days',
        'protocol' => 'Połączenie',
        'names' => 'Domeny',
        'none' => 'Strona nie otwiera się przez https: na porcie 443 nie ma certyfikatu.',
    ],
    'groups' => [
        'C' => ['title' => 'Certyfikat i https', 'text' => 'Czy połączenie ze stroną jest szyfrowane i zaufane'],
        'H' => ['title' => 'Nagłówki bezpieczeństwa', 'text' => 'Nagłówki serwera, które mówią przeglądarce, jak chronić odwiedzających'],
        'L' => ['title' => 'Wycieki i ciasteczka', 'text' => 'Co serwer mówi o sobie i jak ustawia ciasteczka'],
    ],
    'checks' => [
        'C1' => [
            'title' => 'Czy przeglądarki ufają certyfikatowi?',
            'text' => 'Ważny certyfikat dla tej domeny',
            'fix' => 'Zainstaluj certyfikat dla tej domeny od znanego urzędu certyfikacji. Let\'s Encrypt wydaje go za darmo i odnawia automatycznie. Większość paneli hostingu ma przycisk „darmowy SSL”.',
            'notes' => [
                'ok' => 'Certyfikat jest zaufany, wydał go :issuer.',
                'none' => 'Strona nie otwiera się przez https. Przeglądarki oznaczają ją jako „Niezabezpieczona”, a dane idą bez szyfrowania.',
                'expired' => 'Certyfikat wygasł :date. Przeglądarki pokazują ostrzeżenie na całą stronę.',
                'name_mismatch' => 'Certyfikat jest wydany dla innych domen, nie dla :host. Przeglądarki pokazują ostrzeżenie.',
                'untrusted' => 'Przeglądarki nie ufają certyfikatowi (:issuer): jest samopodpisany albo brakuje certyfikatów pośrednich.',
            ],
        ],
        'C2' => [
            'title' => 'Czy certyfikat wkrótce wygaśnie?',
            'text' => 'Zostało co najmniej 30 dni',
            'fix' => 'Odnów certyfikat i upewnij się, że odnawianie jest automatyczne: certyfikaty Let\'s Encrypt są ważne 90 dni, a automatyczne odnawianie często po cichu przestaje działać.',
            'notes' => [
                'ok' => 'Ważny do :date, zostało dni: :days.',
                'soon' => 'Zostało tylko dni: :days, do :date. Upewnij się, że odnowi się automatycznie.',
                'urgent' => 'Zostało tylko dni: :days, do :date. Odnów go teraz.',
                'expired' => 'Certyfikat wygasł :date.',
                'none' => 'Nie ma certyfikatu do sprawdzenia.',
            ],
        ],
        'C3' => [
            'title' => 'Czy http:// prowadzi na https://?',
            'text' => 'Przekierowanie z http na https',
            'fix' => 'Ustaw stałe (301) przekierowanie z każdego adresu http:// na ten sam adres https://.',
            'notes' => [
                'ok' => 'Adres http:// prowadzi na https://.',
                'none' => 'Adres http:// otwiera się bez szyfrowania: kto wpisuje adres ręcznie, zostaje na niezabezpieczonej wersji.',
                'no_http' => 'Strona nie odpowiada przez http://, więc nie ma czego przekierowywać.',
            ],
        ],
        'C4' => [
            'title' => 'Czy połączenie jest nowoczesne?',
            'text' => 'TLS 1.2 lub 1.3',
            'fix' => 'Włącz TLS 1.2 i 1.3 w ustawieniach serwera i wyłącz stare wersje: przeglądarki nie otwierają już stron na TLS 1.0 i 1.1.',
            'notes' => [
                'ok' => 'Połączenie używa :protocol.',
                'old' => 'Połączenie używa :protocol, przestarzałej wersji.',
                'none' => 'Nie ma połączenia https do sprawdzenia.',
            ],
        ],
        'H1' => [
            'title' => 'Czy przeglądarka zawsze używa https?',
            'text' => 'Strict-Transport-Security na co najmniej 6 miesięcy',
            'fix' => 'Dodaj nagłówek Strict-Transport-Security z max-age co najmniej pół roku (lepiej rok) i includeSubDomains. Wtedy przeglądarka otwiera stronę tylko przez https, nawet ze starego linku http://.',
            'notes' => [
                'ok' => 'HSTS jest włączony na :days dni, razem z subdomenami.',
                'none' => 'Nie ma nagłówka HSTS: pierwszą wizytę przez http:// można przechwycić.',
                'short' => 'HSTS jest włączony tylko na :days dni. Ustaw co najmniej 180.',
                'no_subdomains' => 'HSTS nie obejmuje subdomen: dodaj includeSubDomains.',
                'no_https' => 'Strona nie otwiera się przez https, więc HSTS nie może działać.',
            ],
        ],
        'H2' => [
            'title' => 'Czy skrypty są ograniczone?',
            'text' => 'Content-Security-Policy',
            'fix' => 'Dodaj Content-Security-Policy z listą źródeł, z których mogą pochodzić skrypty, style i obrazy. Zacznij od Content-Security-Policy-Report-Only, żeby zobaczyć, co by się zepsuło, a potem ją włącz.',
            'notes' => [
                'ok' => 'Jest polityka bez unsafe-inline i unsafe-eval dla skryptów.',
                'none' => 'Nie ma Content-Security-Policy: wstrzyknięty skrypt (XSS) może działać bez ograniczeń.',
                'report_only' => 'Polityka jest w trybie raportów: zgłasza naruszenia, ale niczego nie blokuje.',
                'unsafe' => 'Polityka zezwala na :keywords dla skryptów, co odbiera jej większość ochrony przed XSS.',
            ],
        ],
        'H3' => [
            'title' => 'Czy inne strony mogą pokazać stronę w ramce?',
            'text' => 'X-Frame-Options lub frame-ancestors',
            'fix' => 'Dodaj X-Frame-Options: SAMEORIGIN albo frame-ancestors \'self\' w Content-Security-Policy, żeby inne strony nie mogły podłożyć strony pod fałszywy przycisk (clickjacking).',
            'notes' => [
                'ok' => 'X-Frame-Options zabrania ramek na innych stronach.',
                'csp' => 'Ramki kontroluje frame-ancestors w Content-Security-Policy.',
                'none' => 'Każda strona może pokazać tę stronę w ramce.',
                'invalid' => 'Przestarzała lub nieznana wartość X-Frame-Options: przeglądarki ją ignorują.',
            ],
        ],
        'H4' => [
            'title' => 'Czy przeglądarka zgaduje typy plików?',
            'text' => 'X-Content-Type-Options: nosniff',
            'fix' => 'Dodaj X-Content-Type-Options: nosniff, żeby przeglądarka nie uruchamiała pliku jako skryptu, gdy serwer mówi, że to coś innego.',
            'notes' => [
                'ok' => 'nosniff jest włączony.',
                'none' => 'Nie ma nagłówka X-Content-Type-Options.',
                'invalid' => 'Nieznana wartość: poprawna jest tylko nosniff.',
            ],
        ],
        'H5' => [
            'title' => 'Czy adresy stron wyciekają do innych serwisów?',
            'text' => 'Referrer-Policy',
            'fix' => 'Dodaj Referrer-Policy: strict-origin-when-cross-origin: inne serwisy dostaną tylko domenę, bez adresu strony i jej parametrów.',
            'notes' => [
                'ok' => 'Polityka jest ustawiona.',
                'none' => 'Nie ma nagłówka Referrer-Policy; przeglądarka używa swojej domyślnej wartości.',
                'leaky' => 'Polityka wysyła innym serwisom pełne adresy stron, razem z parametrami i tokenami.',
            ],
        ],
        'H6' => [
            'title' => 'Czy nieużywane funkcje przeglądarki są wyłączone?',
            'text' => 'Permissions-Policy',
            'fix' => 'Dodaj Permissions-Policy i wyłącz to, czego strona nie używa: kamerę, mikrofon, lokalizację, płatności. Wtedy nawet wstrzyknięty skrypt nie będzie mógł o nie poprosić.',
            'notes' => [
                'ok' => 'Polityka jest ustawiona.',
                'none' => 'Nie ma nagłówka Permissions-Policy.',
                'legacy' => 'Jest tylko stary nagłówek Feature-Policy: przeglądarki zastąpiły go przez Permissions-Policy.',
            ],
        ],
        'L1' => [
            'title' => 'Czy serwer zdradza swoją wersję?',
            'text' => 'Server i X-Powered-By bez wersji',
            'fix' => 'Ukryj wersje serwera, PHP i platformy w nagłówkach: dzięki nim boty w kilka sekund znajdują strony ze znanymi lukami.',
            'notes' => [
                'ok' => 'Nagłówki nie zdradzają wersji.',
                'leaks' => 'Nagłówki zdradzają wersje oprogramowania.',
            ],
        ],
        'L2' => [
            'title' => 'Czy ciasteczka są chronione?',
            'text' => 'Flagi Secure, HttpOnly i SameSite',
            'fix' => 'Ustaw każdemu ciasteczku Secure, żeby szło tylko przez https, HttpOnly, żeby skrypty nie mogły go odczytać, i SameSite=Lax, żeby inne strony go nie wysyłały.',
            'notes' => [
                'ok' => 'Wszystkie ciasteczka (:count) mają flagi ochronne.',
                'insecure' => 'Część z :count ciasteczek nie ma flagi Secure i może iść niezaszyfrowanym połączeniem.',
                'partial' => 'Części z :count ciasteczek brakuje HttpOnly lub SameSite.',
                'none' => 'Strona nie ustawia ciasteczek.',
            ],
        ],
    ],
];

<?php

return [
    'form' => [
        'label' => 'Dirección del sitio',
        'button' => 'Comprobar',
        'hint' => 'Gratis · sin registro · hasta :count comprobaciones por hora',
    ],
    'loading' => [
        'certificate' => 'Leyendo el certificado SSL',
        'headers' => 'Cargando las cabeceras de la página',
        'checks' => 'Comprobando la configuración de seguridad',
    ],
    'verdicts' => [
        'ready' => 'El sitio está bien protegido',
        'almost' => 'El sitio está casi bien protegido',
        'partly' => 'La protección del sitio necesita mejoras',
        'not_ready' => 'El sitio está mal protegido',
    ],
    'certificate' => [
        'title' => 'Certificado SSL',
        'issuer' => 'Emitido por',
        'valid_to' => 'Válido hasta',
        'days_left' => 'quedan :days días',
        'protocol' => 'Conexión',
        'names' => 'Dominios',
        'none' => 'El sitio no se abre por https: no hay certificado en el puerto 443.',
    ],
    'groups' => [
        'C' => ['title' => 'Certificado y https', 'text' => 'Si la conexión con el sitio está cifrada y es de confianza'],
        'H' => ['title' => 'Cabeceras de seguridad', 'text' => 'Cabeceras del servidor que le dicen al navegador cómo proteger a los visitantes'],
        'L' => ['title' => 'Fugas y cookies', 'text' => 'Lo que el servidor cuenta de sí mismo y cómo guarda las cookies'],
    ],
    'checks' => [
        'C1' => [
            'title' => '¿Confían los navegadores en el certificado?',
            'text' => 'Un certificado válido para este dominio',
            'fix' => 'Instale un certificado para este dominio de una autoridad conocida. Let\'s Encrypt lo emite gratis y lo renueva automáticamente. La mayoría de los paneles de hosting tienen un botón «SSL gratuito».',
            'notes' => [
                'ok' => 'El certificado es de confianza, emitido por :issuer.',
                'none' => 'El sitio no se abre por https. Los navegadores lo marcan como «No seguro» y los datos viajan sin cifrar.',
                'expired' => 'El certificado caducó el :date. Los navegadores muestran un aviso a página completa.',
                'name_mismatch' => 'El certificado está emitido para otros dominios, no para :host. Los navegadores muestran un aviso.',
                'untrusted' => 'Los navegadores no confían en el certificado (:issuer): es autofirmado o faltan los certificados intermedios.',
            ],
        ],
        'C2' => [
            'title' => '¿Caduca pronto el certificado?',
            'text' => 'Quedan al menos 30 días',
            'fix' => 'Renueve el certificado y asegúrese de que la renovación es automática: los certificados de Let\'s Encrypt duran 90 días y la renovación automática a menudo se rompe sin avisar.',
            'notes' => [
                'ok' => 'Válido hasta el :date, quedan :days días.',
                'soon' => 'Solo quedan :days días, hasta el :date. Asegúrese de que se renueva automáticamente.',
                'urgent' => 'Solo quedan :days días, hasta el :date. Renuévelo ahora.',
                'expired' => 'El certificado caducó el :date.',
                'none' => 'No hay certificado que comprobar.',
            ],
        ],
        'C3' => [
            'title' => '¿Lleva http:// a https://?',
            'text' => 'Una redirección de http a https',
            'fix' => 'Configure una redirección permanente (301) de cada dirección http:// a la misma dirección https://.',
            'notes' => [
                'ok' => 'La dirección http:// lleva a https://.',
                'none' => 'La dirección http:// se abre sin cifrado: quien escribe la dirección a mano se queda en la versión insegura.',
                'no_http' => 'El sitio no responde por http://, así que no hay nada que redirigir.',
            ],
        ],
        'C4' => [
            'title' => '¿Es moderna la conexión?',
            'text' => 'TLS 1.2 o 1.3',
            'fix' => 'Active TLS 1.2 y 1.3 en la configuración del servidor y desactive las versiones antiguas: los navegadores ya no abren sitios con TLS 1.0 y 1.1.',
            'notes' => [
                'ok' => 'La conexión usa :protocol.',
                'old' => 'La conexión usa :protocol, una versión obsoleta.',
                'none' => 'No hay conexión https que comprobar.',
            ],
        ],
        'H1' => [
            'title' => '¿Usa siempre el navegador https?',
            'text' => 'Strict-Transport-Security durante al menos 6 meses',
            'fix' => 'Añada la cabecera Strict-Transport-Security con un max-age de al menos medio año (mejor un año) e includeSubDomains. Así el navegador abre el sitio solo por https, incluso desde un enlace http:// antiguo.',
            'notes' => [
                'ok' => 'HSTS está activo durante :days días, subdominios incluidos.',
                'none' => 'No hay cabecera HSTS: la primera visita por http:// puede ser interceptada.',
                'short' => 'HSTS está activo solo :days días. Ponga al menos 180.',
                'no_subdomains' => 'HSTS no cubre los subdominios: añada includeSubDomains.',
                'no_https' => 'El sitio no se abre por https, así que HSTS no puede funcionar.',
            ],
        ],
        'H2' => [
            'title' => '¿Están limitados los scripts?',
            'text' => 'Content-Security-Policy',
            'fix' => 'Añada una Content-Security-Policy con la lista de orígenes de los que pueden venir scripts, estilos e imágenes. Empiece con Content-Security-Policy-Report-Only para ver qué se rompería y después actívela.',
            'notes' => [
                'ok' => 'Hay una política sin unsafe-inline ni unsafe-eval para los scripts.',
                'none' => 'No hay Content-Security-Policy: un script inyectado (XSS) puede ejecutarse sin límites.',
                'report_only' => 'La política está en modo informe: avisa de las infracciones, pero no bloquea nada.',
                'unsafe' => 'La política permite :keywords para los scripts, lo que le quita la mayor parte de su protección contra XSS.',
            ],
        ],
        'H3' => [
            'title' => '¿Pueden otros sitios mostrar la página en un marco?',
            'text' => 'X-Frame-Options o frame-ancestors',
            'fix' => 'Añada X-Frame-Options: SAMEORIGIN, o frame-ancestors \'self\' en la Content-Security-Policy, para que otros sitios no puedan poner la página bajo un botón falso (clickjacking).',
            'notes' => [
                'ok' => 'X-Frame-Options prohíbe los marcos en otros sitios.',
                'csp' => 'frame-ancestors en la Content-Security-Policy controla los marcos.',
                'none' => 'Cualquier sitio puede mostrar la página en un marco.',
                'invalid' => 'Un valor de X-Frame-Options obsoleto o desconocido: los navegadores lo ignoran.',
            ],
        ],
        'H4' => [
            'title' => '¿Adivina el navegador los tipos de archivo?',
            'text' => 'X-Content-Type-Options: nosniff',
            'fix' => 'Añada X-Content-Type-Options: nosniff para que el navegador no ejecute un archivo como script cuando el servidor dice que es otra cosa.',
            'notes' => [
                'ok' => 'nosniff está activo.',
                'none' => 'No hay cabecera X-Content-Type-Options.',
                'invalid' => 'Un valor desconocido: el único válido es nosniff.',
            ],
        ],
        'H5' => [
            'title' => '¿Se filtran las direcciones de las páginas a otros sitios?',
            'text' => 'Referrer-Policy',
            'fix' => 'Añada Referrer-Policy: strict-origin-when-cross-origin: los demás sitios reciben solo el dominio, sin la dirección de la página ni sus parámetros.',
            'notes' => [
                'ok' => 'La política está definida.',
                'none' => 'No hay cabecera Referrer-Policy; el navegador usa su valor por defecto.',
                'leaky' => 'La política envía las direcciones completas de las páginas a otros sitios, con parámetros y tokens.',
            ],
        ],
        'H6' => [
            'title' => '¿Están desactivadas las funciones del navegador que no se usan?',
            'text' => 'Permissions-Policy',
            'fix' => 'Añada una Permissions-Policy y desactive lo que el sitio no usa: cámara, micrófono, ubicación, pagos. Así ni siquiera un script inyectado podrá pedirlos.',
            'notes' => [
                'ok' => 'La política está definida.',
                'none' => 'No hay cabecera Permissions-Policy.',
                'legacy' => 'Solo está la antigua cabecera Feature-Policy: los navegadores la han sustituido por Permissions-Policy.',
            ],
        ],
        'L1' => [
            'title' => '¿Revela el servidor su versión?',
            'text' => 'Server y X-Powered-By sin versiones',
            'fix' => 'Oculte las versiones del servidor, de PHP y de la plataforma en las cabeceras: con ellas los bots encuentran en segundos sitios con fallos conocidos.',
            'notes' => [
                'ok' => 'Las cabeceras no revelan ninguna versión.',
                'leaks' => 'Las cabeceras revelan las versiones del software.',
            ],
        ],
        'L2' => [
            'title' => '¿Están protegidas las cookies?',
            'text' => 'Los atributos Secure, HttpOnly y SameSite',
            'fix' => 'Ponga Secure en cada cookie para que solo viaje por https, HttpOnly para que los scripts no puedan leerla y SameSite=Lax para que otros sitios no la envíen.',
            'notes' => [
                'ok' => 'Las :count cookies tienen los atributos de protección.',
                'insecure' => 'Algunas de las :count cookies no tienen el atributo Secure y pueden viajar por una conexión sin cifrar.',
                'partial' => 'A algunas de las :count cookies les falta HttpOnly o SameSite.',
                'none' => 'La página no guarda cookies.',
            ],
        ],
    ],
];

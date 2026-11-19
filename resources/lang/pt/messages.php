<?php

declare(strict_types=1);

return [
    'form' => [
        'label' => 'Endereço do site',
        'button' => 'Verificar',
        'hint' => 'Grátis · sem registo · até :count verificações por hora',
    ],
    'loading' => [
        'certificate' => 'A ler o certificado SSL',
        'headers' => 'A carregar os cabeçalhos da página',
        'checks' => 'A verificar as definições de segurança',
    ],
    'verdicts' => [
        'ready' => 'O site está bem protegido',
        'almost' => 'O site está quase bem protegido',
        'partly' => 'A proteção do site precisa de melhorias',
        'not_ready' => 'O site está mal protegido',
    ],
    'certificate' => [
        'title' => 'Certificado SSL',
        'issuer' => 'Emitido por',
        'valid_to' => 'Válido até',
        'days_left' => 'faltam :days dias',
        'protocol' => 'Ligação',
        'names' => 'Domínios',
        'none' => 'O site não abre por https: não há certificado na porta 443.',
    ],
    'groups' => [
        'C' => ['title' => 'Certificado e https', 'text' => 'Se a ligação ao site é cifrada e de confiança'],
        'H' => ['title' => 'Cabeçalhos de segurança', 'text' => 'Cabeçalhos do servidor que dizem ao navegador como proteger os visitantes'],
        'L' => ['title' => 'Fugas e cookies', 'text' => 'O que o servidor revela sobre si e como define os cookies'],
    ],
    'checks' => [
        'C1' => [
            'title' => 'Os navegadores confiam no certificado?',
            'text' => 'Um certificado válido para este domínio',
            'fix' => 'Instale um certificado para este domínio de uma autoridade conhecida. A Let\'s Encrypt emite-o gratuitamente e renova-o automaticamente. A maioria dos painéis de alojamento tem um botão «SSL grátis».',
            'notes' => [
                'ok' => 'O certificado é de confiança, emitido por :issuer.',
                'none' => 'O site não abre por https. Os navegadores marcam-no como «Não seguro» e os dados seguem sem cifra.',
                'expired' => 'O certificado expirou a :date. Os navegadores mostram um aviso em página inteira.',
                'name_mismatch' => 'O certificado foi emitido para outros domínios, não para :host. Os navegadores mostram um aviso.',
                'untrusted' => 'Os navegadores não confiam no certificado (:issuer): é autoassinado ou faltam os certificados intermédios.',
            ],
        ],
        'C2' => [
            'title' => 'O certificado expira em breve?',
            'text' => 'Faltam pelo menos 30 dias',
            'fix' => 'Renove o certificado e confirme que a renovação é automática: os certificados da Let\'s Encrypt duram 90 dias e a renovação automática falha muitas vezes sem aviso.',
            'notes' => [
                'ok' => 'Válido até :date, faltam :days dias.',
                'soon' => 'Faltam só :days dias, até :date. Confirme que se renova automaticamente.',
                'urgent' => 'Faltam só :days dias, até :date. Renove-o agora.',
                'expired' => 'O certificado expirou a :date.',
                'none' => 'Não há certificado para verificar.',
            ],
        ],
        'C3' => [
            'title' => 'O http:// leva ao https://?',
            'text' => 'Um redirecionamento de http para https',
            'fix' => 'Configure um redirecionamento permanente (301) de cada endereço http:// para o mesmo endereço https://.',
            'notes' => [
                'ok' => 'O endereço http:// leva ao https://.',
                'none' => 'O endereço http:// abre sem cifra: quem escreve o endereço à mão fica na versão insegura.',
                'no_http' => 'O site não responde por http://, por isso não há nada para redirecionar.',
            ],
        ],
        'C4' => [
            'title' => 'A ligação é moderna?',
            'text' => 'TLS 1.2 ou 1.3',
            'fix' => 'Ative o TLS 1.2 e 1.3 nas definições do servidor e desative as versões antigas: os navegadores já não abrem sites com TLS 1.0 e 1.1.',
            'notes' => [
                'ok' => 'A ligação usa :protocol.',
                'old' => 'A ligação usa :protocol, uma versão desatualizada.',
                'none' => 'Não há ligação https para verificar.',
            ],
        ],
        'H1' => [
            'title' => 'O navegador usa sempre https?',
            'text' => 'Strict-Transport-Security durante pelo menos 6 meses',
            'fix' => 'Adicione o cabeçalho Strict-Transport-Security com max-age de pelo menos meio ano (melhor um ano) e includeSubDomains. Assim o navegador abre o site só por https, mesmo a partir de um link http:// antigo.',
            'notes' => [
                'ok' => 'O HSTS está ativo durante :days dias, incluindo subdomínios.',
                'none' => 'Não há cabeçalho HSTS: a primeira visita por http:// pode ser intercetada.',
                'short' => 'O HSTS está ativo só durante :days dias. Defina pelo menos 180.',
                'no_subdomains' => 'O HSTS não abrange os subdomínios: adicione includeSubDomains.',
                'no_https' => 'O site não abre por https, por isso o HSTS não pode funcionar.',
            ],
        ],
        'H2' => [
            'title' => 'Os scripts estão limitados?',
            'text' => 'Content-Security-Policy',
            'fix' => 'Adicione uma Content-Security-Policy com a lista de origens de onde podem vir scripts, estilos e imagens. Comece com Content-Security-Policy-Report-Only para ver o que deixaria de funcionar e depois ative-a.',
            'notes' => [
                'ok' => 'Há uma política sem unsafe-inline e unsafe-eval para scripts.',
                'none' => 'Não há Content-Security-Policy: um script injetado (XSS) pode correr sem limites.',
                'report_only' => 'A política está em modo de relatório: comunica as violações, mas não bloqueia nada.',
                'unsafe' => 'A política permite :keywords para scripts, o que lhe retira a maior parte da proteção contra XSS.',
            ],
        ],
        'H3' => [
            'title' => 'Outros sites podem mostrar a página numa moldura?',
            'text' => 'X-Frame-Options ou frame-ancestors',
            'fix' => 'Adicione X-Frame-Options: SAMEORIGIN, ou frame-ancestors \'self\' na Content-Security-Policy, para que outros sites não possam pôr a página por baixo de um botão falso (clickjacking).',
            'notes' => [
                'ok' => 'O X-Frame-Options proíbe molduras noutros sites.',
                'csp' => 'As molduras são controladas por frame-ancestors na Content-Security-Policy.',
                'none' => 'Qualquer site pode mostrar a página numa moldura.',
                'invalid' => 'Um valor de X-Frame-Options desatualizado ou desconhecido: os navegadores ignoram-no.',
            ],
        ],
        'H4' => [
            'title' => 'O navegador adivinha os tipos de ficheiro?',
            'text' => 'X-Content-Type-Options: nosniff',
            'fix' => 'Adicione X-Content-Type-Options: nosniff para que o navegador não execute um ficheiro como script quando o servidor diz que é outra coisa.',
            'notes' => [
                'ok' => 'O nosniff está ativo.',
                'none' => 'Não há cabeçalho X-Content-Type-Options.',
                'invalid' => 'Um valor desconhecido: o único válido é nosniff.',
            ],
        ],
        'H5' => [
            'title' => 'Os endereços das páginas passam para outros sites?',
            'text' => 'Referrer-Policy',
            'fix' => 'Adicione Referrer-Policy: strict-origin-when-cross-origin: os outros sites recebem só o domínio, sem o endereço da página e os seus parâmetros.',
            'notes' => [
                'ok' => 'A política está definida.',
                'none' => 'Não há cabeçalho Referrer-Policy; o navegador usa o seu valor predefinido.',
                'leaky' => 'A política envia os endereços completos das páginas para outros sites, com parâmetros e tokens.',
            ],
        ],
        'H6' => [
            'title' => 'As funções do navegador não usadas estão desligadas?',
            'text' => 'Permissions-Policy',
            'fix' => 'Adicione uma Permissions-Policy e desligue o que o site não usa: câmara, microfone, localização, pagamentos. Assim nem um script injetado os poderá pedir.',
            'notes' => [
                'ok' => 'A política está definida.',
                'none' => 'Não há cabeçalho Permissions-Policy.',
                'legacy' => 'Só existe o antigo cabeçalho Feature-Policy: os navegadores substituíram-no por Permissions-Policy.',
            ],
        ],
        'L1' => [
            'title' => 'O servidor revela a sua versão?',
            'text' => 'Server e X-Powered-By sem versões',
            'fix' => 'Esconda as versões do servidor, do PHP e da plataforma nos cabeçalhos: com elas, os bots encontram em segundos sites com falhas conhecidas.',
            'notes' => [
                'ok' => 'Os cabeçalhos não revelam versões.',
                'leaks' => 'Os cabeçalhos revelam as versões do software.',
            ],
        ],
        'L2' => [
            'title' => 'Os cookies estão protegidos?',
            'text' => 'Os atributos Secure, HttpOnly e SameSite',
            'fix' => 'Defina Secure em cada cookie para que só passe por https, HttpOnly para que os scripts não o possam ler e SameSite=Lax para que outros sites não o enviem.',
            'notes' => [
                'ok' => 'Todos os :count cookies têm os atributos de proteção.',
                'insecure' => 'Alguns dos :count cookies não têm o atributo Secure e podem passar por uma ligação não cifrada.',
                'partial' => 'A alguns dos :count cookies falta HttpOnly ou SameSite.',
                'none' => 'A página não define cookies.',
            ],
        ],
    ],
];

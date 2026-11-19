<?php

declare(strict_types=1);

return [
    'form' => [
        'label' => 'Adresse du site',
        'button' => 'Vérifier',
        'hint' => 'Gratuit · sans inscription · jusqu\'à :count vérifications par heure',
    ],
    'loading' => [
        'certificate' => 'Lecture du certificat SSL',
        'headers' => 'Chargement des en-têtes de la page',
        'checks' => 'Vérification des réglages de sécurité',
    ],
    'verdicts' => [
        'ready' => 'Le site est bien protégé',
        'almost' => 'Le site est presque bien protégé',
        'partly' => 'La protection du site est à améliorer',
        'not_ready' => 'Le site est mal protégé',
    ],
    'certificate' => [
        'title' => 'Certificat SSL',
        'issuer' => 'Délivré par',
        'valid_to' => 'Valable jusqu\'au',
        'days_left' => 'encore :days jours',
        'protocol' => 'Connexion',
        'names' => 'Domaines',
        'none' => 'Le site ne s\'ouvre pas en https : il n\'y a pas de certificat sur le port 443.',
    ],
    'groups' => [
        'C' => ['title' => 'Certificat et https', 'text' => 'Si la connexion au site est chiffrée et digne de confiance'],
        'H' => ['title' => 'En-têtes de sécurité', 'text' => 'Les en-têtes du serveur qui indiquent au navigateur comment protéger les visiteurs'],
        'L' => ['title' => 'Fuites et cookies', 'text' => 'Ce que le serveur dit de lui-même et comment il pose les cookies'],
    ],
    'checks' => [
        'C1' => [
            'title' => 'Les navigateurs font-ils confiance au certificat ?',
            'text' => 'Un certificat valide pour ce domaine',
            'fix' => 'Installez un certificat pour ce domaine, délivré par une autorité connue. Let\'s Encrypt le fournit gratuitement et le renouvelle automatiquement. La plupart des panneaux d\'hébergement ont un bouton « SSL gratuit ».',
            'notes' => [
                'ok' => 'Le certificat est reconnu, délivré par :issuer.',
                'none' => 'Le site ne s\'ouvre pas en https. Les navigateurs l\'affichent « Non sécurisé » et les données circulent sans chiffrement.',
                'expired' => 'Le certificat a expiré le :date. Les navigateurs affichent un avertissement sur toute la page.',
                'name_mismatch' => 'Le certificat est délivré pour d\'autres domaines, pas pour :host. Les navigateurs affichent un avertissement.',
                'untrusted' => 'Les navigateurs ne font pas confiance au certificat (:issuer) : il est auto-signé ou les certificats intermédiaires manquent.',
            ],
        ],
        'C2' => [
            'title' => 'Le certificat expire-t-il bientôt ?',
            'text' => 'Au moins 30 jours restants',
            'fix' => 'Renouvelez le certificat et vérifiez que le renouvellement est automatique : les certificats Let\'s Encrypt durent 90 jours et le renouvellement automatique tombe souvent en panne sans bruit.',
            'notes' => [
                'ok' => 'Valable jusqu\'au :date, encore :days jours.',
                'soon' => 'Plus que :days jours, jusqu\'au :date. Vérifiez qu\'il se renouvelle automatiquement.',
                'urgent' => 'Plus que :days jours, jusqu\'au :date. Renouvelez-le maintenant.',
                'expired' => 'Le certificat a expiré le :date.',
                'none' => 'Il n\'y a pas de certificat à vérifier.',
            ],
        ],
        'C3' => [
            'title' => 'http:// mène-t-il à https:// ?',
            'text' => 'Une redirection de http vers https',
            'fix' => 'Mettez en place une redirection permanente (301) de chaque adresse http:// vers la même adresse https://.',
            'notes' => [
                'ok' => 'L\'adresse http:// mène à https://.',
                'none' => 'L\'adresse http:// s\'ouvre sans chiffrement : les visiteurs qui tapent l\'adresse à la main restent sur la version non sécurisée.',
                'no_http' => 'Le site ne répond pas en http://, il n\'y a donc rien à rediriger.',
            ],
        ],
        'C4' => [
            'title' => 'La connexion est-elle moderne ?',
            'text' => 'TLS 1.2 ou 1.3',
            'fix' => 'Activez TLS 1.2 et 1.3 dans les réglages du serveur et désactivez les anciennes versions : les navigateurs n\'ouvrent plus les sites en TLS 1.0 et 1.1.',
            'notes' => [
                'ok' => 'La connexion utilise :protocol.',
                'old' => 'La connexion utilise :protocol, une version obsolète.',
                'none' => 'Il n\'y a pas de connexion https à vérifier.',
            ],
        ],
        'H1' => [
            'title' => 'Le navigateur utilise-t-il toujours https ?',
            'text' => 'Strict-Transport-Security pour au moins 6 mois',
            'fix' => 'Ajoutez l\'en-tête Strict-Transport-Security avec un max-age d\'au moins six mois (un an, c\'est mieux) et includeSubDomains. Le navigateur n\'ouvrira alors le site qu\'en https, même depuis un ancien lien http://.',
            'notes' => [
                'ok' => 'HSTS est actif pour :days jours, sous-domaines compris.',
                'none' => 'Il n\'y a pas d\'en-tête HSTS : la première visite en http:// peut être interceptée.',
                'short' => 'HSTS n\'est actif que pour :days jours. Mettez au moins 180 jours.',
                'no_subdomains' => 'HSTS ne couvre pas les sous-domaines : ajoutez includeSubDomains.',
                'no_https' => 'Le site ne s\'ouvre pas en https, HSTS ne peut donc pas fonctionner.',
            ],
        ],
        'H2' => [
            'title' => 'Les scripts sont-ils limités ?',
            'text' => 'Content-Security-Policy',
            'fix' => 'Ajoutez une Content-Security-Policy avec la liste des sources autorisées pour les scripts, les styles et les images. Commencez par Content-Security-Policy-Report-Only pour voir ce qui casserait, puis activez-la.',
            'notes' => [
                'ok' => 'Il y a une politique sans unsafe-inline ni unsafe-eval pour les scripts.',
                'none' => 'Il n\'y a pas de Content-Security-Policy : un script injecté (XSS) peut s\'exécuter sans limite.',
                'report_only' => 'La politique est en mode rapport : elle signale les violations mais ne bloque rien.',
                'unsafe' => 'La politique autorise :keywords pour les scripts, ce qui lui retire l\'essentiel de sa protection contre le XSS.',
            ],
        ],
        'H3' => [
            'title' => 'D\'autres sites peuvent-ils afficher la page dans un cadre ?',
            'text' => 'X-Frame-Options ou frame-ancestors',
            'fix' => 'Ajoutez X-Frame-Options: SAMEORIGIN, ou frame-ancestors \'self\' dans la Content-Security-Policy, pour que d\'autres sites ne puissent pas placer la page sous un faux bouton (clickjacking).',
            'notes' => [
                'ok' => 'X-Frame-Options interdit les cadres sur d\'autres sites.',
                'csp' => 'frame-ancestors dans la Content-Security-Policy contrôle les cadres.',
                'none' => 'N\'importe quel site peut afficher la page dans un cadre.',
                'invalid' => 'Une valeur de X-Frame-Options obsolète ou inconnue : les navigateurs l\'ignorent.',
            ],
        ],
        'H4' => [
            'title' => 'Le navigateur devine-t-il les types de fichiers ?',
            'text' => 'X-Content-Type-Options: nosniff',
            'fix' => 'Ajoutez X-Content-Type-Options: nosniff pour que le navigateur n\'exécute pas un fichier comme un script quand le serveur dit que c\'est autre chose.',
            'notes' => [
                'ok' => 'nosniff est actif.',
                'none' => 'Il n\'y a pas d\'en-tête X-Content-Type-Options.',
                'invalid' => 'Une valeur inconnue : la seule valide est nosniff.',
            ],
        ],
        'H5' => [
            'title' => 'Les adresses des pages fuient-elles vers d\'autres sites ?',
            'text' => 'Referrer-Policy',
            'fix' => 'Ajoutez Referrer-Policy: strict-origin-when-cross-origin : les autres sites ne reçoivent que le domaine, sans l\'adresse de la page ni ses paramètres.',
            'notes' => [
                'ok' => 'La politique est définie.',
                'none' => 'Il n\'y a pas d\'en-tête Referrer-Policy ; le navigateur applique sa valeur par défaut.',
                'leaky' => 'La politique envoie les adresses complètes des pages aux autres sites, paramètres et jetons compris.',
            ],
        ],
        'H6' => [
            'title' => 'Les fonctions inutiles du navigateur sont-elles désactivées ?',
            'text' => 'Permissions-Policy',
            'fix' => 'Ajoutez une Permissions-Policy et désactivez ce que le site n\'utilise pas : caméra, micro, localisation, paiements. Même un script injecté ne pourra alors pas les demander.',
            'notes' => [
                'ok' => 'La politique est définie.',
                'none' => 'Il n\'y a pas d\'en-tête Permissions-Policy.',
                'legacy' => 'Il n\'y a que l\'ancien en-tête Feature-Policy : les navigateurs l\'ont remplacé par Permissions-Policy.',
            ],
        ],
        'L1' => [
            'title' => 'Le serveur révèle-t-il sa version ?',
            'text' => 'Server et X-Powered-By sans versions',
            'fix' => 'Masquez les versions du serveur, de PHP et de la plateforme dans les en-têtes : grâce à elles, les robots trouvent en quelques secondes les sites aux failles connues.',
            'notes' => [
                'ok' => 'Les en-têtes ne révèlent aucune version.',
                'leaks' => 'Les en-têtes révèlent les versions des logiciels.',
            ],
        ],
        'L2' => [
            'title' => 'Les cookies sont-ils protégés ?',
            'text' => 'Les attributs Secure, HttpOnly et SameSite',
            'fix' => 'Mettez Secure sur chaque cookie pour qu\'il ne passe qu\'en https, HttpOnly pour que les scripts ne puissent pas le lire, et SameSite=Lax pour que d\'autres sites ne l\'envoient pas.',
            'notes' => [
                'ok' => 'Les :count cookies ont tous les attributs de protection.',
                'insecure' => 'Certains des :count cookies n\'ont pas l\'attribut Secure et peuvent passer par une connexion non chiffrée.',
                'partial' => 'Il manque HttpOnly ou SameSite à certains des :count cookies.',
                'none' => 'La page ne pose aucun cookie.',
            ],
        ],
    ],
];

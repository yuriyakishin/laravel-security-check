<?php

return [
    'form' => [
        'label' => 'Site adresi',
        'button' => 'Kontrol et',
        'hint' => 'Ücretsiz · kayıt yok · saatte en fazla :count kontrol',
    ],
    'loading' => [
        'certificate' => 'SSL sertifikası okunuyor',
        'headers' => 'Sayfa başlıkları yükleniyor',
        'checks' => 'Güvenlik ayarları kontrol ediliyor',
    ],
    'verdicts' => [
        'ready' => 'Site iyi korunuyor',
        'almost' => 'Site neredeyse iyi korunuyor',
        'partly' => 'Sitenin korumasının iyileştirilmesi gerekiyor',
        'not_ready' => 'Site zayıf korunuyor',
    ],
    'certificate' => [
        'title' => 'SSL sertifikası',
        'issuer' => 'Veren',
        'valid_to' => 'Geçerlilik sonu',
        'days_left' => ':days gün kaldı',
        'protocol' => 'Bağlantı',
        'names' => 'Alan adları',
        'none' => 'Site https ile açılmıyor: 443 numaralı bağlantı noktasında sertifika yok.',
    ],
    'groups' => [
        'C' => ['title' => 'Sertifika ve https', 'text' => 'Siteyle bağlantının şifreli ve güvenilir olup olmadığı'],
        'H' => ['title' => 'Güvenlik başlıkları', 'text' => 'Tarayıcıya ziyaretçileri nasıl koruyacağını söyleyen sunucu başlıkları'],
        'L' => ['title' => 'Sızıntılar ve çerezler', 'text' => 'Sunucunun kendisi hakkında ne söylediği ve çerezleri nasıl ayarladığı'],
    ],
    'checks' => [
        'C1' => [
            'title' => 'Tarayıcılar sertifikaya güveniyor mu?',
            'text' => 'Bu alan adı için geçerli bir sertifika',
            'fix' => 'Bu alan adı için bilinen bir sertifika otoritesinden sertifika kurun. Let\'s Encrypt ücretsiz verir ve otomatik yeniler. Çoğu hosting panelinde «ücretsiz SSL» düğmesi vardır.',
            'notes' => [
                'ok' => 'Sertifika güvenilir, veren: :issuer.',
                'none' => 'Site https ile açılmıyor. Tarayıcılar onu «Güvenli değil» olarak işaretler ve veriler şifresiz gider.',
                'expired' => 'Sertifikanın süresi :date tarihinde doldu. Tarayıcılar tam sayfa uyarı gösterir.',
                'name_mismatch' => 'Sertifika :host için değil, başka alan adları için verilmiş. Tarayıcılar uyarı gösterir.',
                'untrusted' => 'Tarayıcılar sertifikaya güvenmiyor (:issuer): kendinden imzalı ya da ara sertifikalar eksik.',
            ],
        ],
        'C2' => [
            'title' => 'Sertifikanın süresi yakında doluyor mu?',
            'text' => 'En az 30 gün kaldı',
            'fix' => 'Sertifikayı yenileyin ve yenilemenin otomatik olduğundan emin olun: Let\'s Encrypt sertifikaları 90 gün geçerlidir ve otomatik yenileme çoğu zaman sessizce bozulur.',
            'notes' => [
                'ok' => ':date tarihine kadar geçerli, :days gün kaldı.',
                'soon' => 'Yalnızca :days gün kaldı, :date tarihine kadar. Otomatik yenilendiğinden emin olun.',
                'urgent' => 'Yalnızca :days gün kaldı, :date tarihine kadar. Hemen yenileyin.',
                'expired' => 'Sertifikanın süresi :date tarihinde doldu.',
                'none' => 'Kontrol edilecek sertifika yok.',
            ],
        ],
        'C3' => [
            'title' => 'http:// adresi https:// adresine götürüyor mu?',
            'text' => 'http adresinden https adresine yönlendirme',
            'fix' => 'Her http:// adresinden aynı https:// adresine kalıcı (301) bir yönlendirme kurun.',
            'notes' => [
                'ok' => 'http:// adresi https:// adresine götürüyor.',
                'none' => 'http:// adresi şifresiz açılıyor: adresi elle yazan ziyaretçiler güvensiz sürümde kalır.',
                'no_http' => 'Site http:// üzerinden yanıt vermiyor, yani yönlendirilecek bir şey yok.',
            ],
        ],
        'C4' => [
            'title' => 'Bağlantı modern mi?',
            'text' => 'TLS 1.2 veya 1.3',
            'fix' => 'Sunucu ayarlarında TLS 1.2 ve 1.3 sürümlerini açın, eski sürümleri kapatın: tarayıcılar artık TLS 1.0 ve 1.1 kullanan siteleri açmıyor.',
            'notes' => [
                'ok' => 'Bağlantı :protocol kullanıyor.',
                'old' => 'Bağlantı eski bir sürüm olan :protocol kullanıyor.',
                'none' => 'Kontrol edilecek https bağlantısı yok.',
            ],
        ],
        'H1' => [
            'title' => 'Tarayıcı her zaman https kullanıyor mu?',
            'text' => 'En az 6 ay için Strict-Transport-Security',
            'fix' => 'En az altı ay (bir yıl daha iyi) max-age değeri ve includeSubDomains ile Strict-Transport-Security başlığını ekleyin. Böylece tarayıcı siteyi eski bir http:// bağlantısından bile yalnızca https ile açar.',
            'notes' => [
                'ok' => 'HSTS alt alan adları dahil :days gün için açık.',
                'none' => 'HSTS başlığı yok: http:// üzerinden ilk ziyaret ele geçirilebilir.',
                'short' => 'HSTS yalnızca :days gün için açık. En az 180 gün ayarlayın.',
                'no_subdomains' => 'HSTS alt alan adlarını kapsamıyor: includeSubDomains ekleyin.',
                'no_https' => 'Site https ile açılmıyor, bu yüzden HSTS çalışamaz.',
            ],
        ],
        'H2' => [
            'title' => 'Betikler sınırlı mı?',
            'text' => 'Content-Security-Policy',
            'fix' => 'Betiklerin, stillerin ve görsellerin gelebileceği kaynakların listesiyle bir Content-Security-Policy ekleyin. Neyin bozulacağını görmek için Content-Security-Policy-Report-Only ile başlayın, sonra açın.',
            'notes' => [
                'ok' => 'Betikler için unsafe-inline ve unsafe-eval içermeyen bir politika var.',
                'none' => 'Content-Security-Policy yok: enjekte edilmiş bir betik (XSS) sınırsız çalışabilir.',
                'report_only' => 'Politika rapor modunda: ihlalleri bildiriyor ama hiçbir şeyi engellemiyor.',
                'unsafe' => 'Politika betikler için :keywords değerlerine izin veriyor ve bu, XSS korumasının çoğunu ortadan kaldırıyor.',
            ],
        ],
        'H3' => [
            'title' => 'Başka siteler sayfayı bir çerçevede gösterebilir mi?',
            'text' => 'X-Frame-Options veya frame-ancestors',
            'fix' => 'Başka sitelerin sayfayı sahte bir düğmenin altına koyamaması için (clickjacking) X-Frame-Options: SAMEORIGIN ya da Content-Security-Policy içinde frame-ancestors \'self\' ekleyin.',
            'notes' => [
                'ok' => 'X-Frame-Options başka sitelerde çerçeveyi yasaklıyor.',
                'csp' => 'Çerçeveleri Content-Security-Policy içindeki frame-ancestors yönetiyor.',
                'none' => 'Herhangi bir site sayfayı bir çerçevede gösterebilir.',
                'invalid' => 'Eski ya da bilinmeyen bir X-Frame-Options değeri: tarayıcılar onu yok sayar.',
            ],
        ],
        'H4' => [
            'title' => 'Tarayıcı dosya türlerini tahmin ediyor mu?',
            'text' => 'X-Content-Type-Options: nosniff',
            'fix' => 'Sunucu bir dosyanın başka bir şey olduğunu söylediğinde tarayıcının onu betik olarak çalıştırmaması için X-Content-Type-Options: nosniff ekleyin.',
            'notes' => [
                'ok' => 'nosniff açık.',
                'none' => 'X-Content-Type-Options başlığı yok.',
                'invalid' => 'Bilinmeyen bir değer: geçerli olan yalnızca nosniff.',
            ],
        ],
        'H5' => [
            'title' => 'Sayfa adresleri başka sitelere sızıyor mu?',
            'text' => 'Referrer-Policy',
            'fix' => 'Referrer-Policy: strict-origin-when-cross-origin ekleyin: başka siteler sayfa adresi ve parametreleri olmadan yalnızca alan adını alır.',
            'notes' => [
                'ok' => 'Politika ayarlanmış.',
                'none' => 'Referrer-Policy başlığı yok; tarayıcı varsayılan değerini kullanıyor.',
                'leaky' => 'Politika, parametreler ve tokenlar dahil tam sayfa adreslerini başka sitelere gönderiyor.',
            ],
        ],
        'H6' => [
            'title' => 'Kullanılmayan tarayıcı özellikleri kapalı mı?',
            'text' => 'Permissions-Policy',
            'fix' => 'Bir Permissions-Policy ekleyin ve sitenin kullanmadığı şeyleri kapatın: kamera, mikrofon, konum, ödemeler. Böylece enjekte edilmiş bir betik bile bunları isteyemez.',
            'notes' => [
                'ok' => 'Politika ayarlanmış.',
                'none' => 'Permissions-Policy başlığı yok.',
                'legacy' => 'Yalnızca eski Feature-Policy başlığı var: tarayıcılar onun yerine Permissions-Policy kullanıyor.',
            ],
        ],
        'L1' => [
            'title' => 'Sunucu sürümünü söylüyor mu?',
            'text' => 'Sürümsüz Server ve X-Powered-By',
            'fix' => 'Başlıklarda sunucu, PHP ve platform sürümlerini gizleyin: botlar bunlarla bilinen açıkları olan siteleri saniyeler içinde bulur.',
            'notes' => [
                'ok' => 'Başlıklar hiçbir sürüm söylemiyor.',
                'leaks' => 'Başlıklar yazılım sürümlerini söylüyor.',
            ],
        ],
        'L2' => [
            'title' => 'Çerezler korunuyor mu?',
            'text' => 'Secure, HttpOnly ve SameSite işaretleri',
            'fix' => 'Her çereze yalnızca https ile gitmesi için Secure, betiklerin okuyamaması için HttpOnly ve başka sitelerin göndermemesi için SameSite=Lax ekleyin.',
            'notes' => [
                'ok' => ':count çerezin tümünde koruma işaretleri var.',
                'insecure' => ':count çerezin bir kısmında Secure işareti yok ve şifresiz bağlantıdan gidebilir.',
                'partial' => ':count çerezin bir kısmında HttpOnly veya SameSite eksik.',
                'none' => 'Sayfa çerez ayarlamıyor.',
            ],
        ],
    ],
];

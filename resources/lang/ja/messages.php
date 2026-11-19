<?php

declare(strict_types=1);

return [
    'form' => [
        'label' => 'サイトのアドレス',
        'button' => 'チェック',
        'hint' => '無料 · 登録不要 · 1時間に最大 :count 回',
    ],
    'loading' => [
        'certificate' => 'SSL証明書を読み取り中',
        'headers' => 'ページのヘッダーを取得中',
        'checks' => 'セキュリティ設定をチェック中',
    ],
    'verdicts' => [
        'ready' => 'サイトはしっかり保護されています',
        'almost' => 'サイトはほぼ保護されています',
        'partly' => 'サイトの保護には改善が必要です',
        'not_ready' => 'サイトの保護が不十分です',
    ],
    'certificate' => [
        'title' => 'SSL証明書',
        'issuer' => '発行者',
        'valid_to' => '有効期限',
        'days_left' => '残り :days 日',
        'protocol' => '接続',
        'names' => 'ドメイン',
        'none' => 'サイトは https で開けません。ポート 443 に証明書がありません。',
    ],
    'groups' => [
        'C' => ['title' => '証明書と https', 'text' => 'サイトとの接続が暗号化され、信頼できるか'],
        'H' => ['title' => 'セキュリティヘッダー', 'text' => '訪問者の守り方をブラウザに伝えるサーバーのヘッダー'],
        'L' => ['title' => '情報漏れと Cookie', 'text' => 'サーバーが自分について何を明かし、Cookie をどう設定しているか'],
    ],
    'checks' => [
        'C1' => [
            'title' => 'ブラウザは証明書を信頼していますか?',
            'text' => 'このドメイン用の有効な証明書',
            'fix' => '信頼された認証局から、このドメイン用の証明書をインストールしてください。Let\'s Encrypt なら無料で発行され、自動で更新されます。多くのホスティングの管理画面には「無料SSL」のボタンがあります。',
            'notes' => [
                'ok' => '証明書は信頼されています。発行者は :issuer です。',
                'none' => 'サイトは https で開けません。ブラウザは「保護されていない通信」と表示し、データは暗号化されずに送られます。',
                'expired' => '証明書は :date に期限切れになりました。ブラウザはページ全体に警告を表示します。',
                'name_mismatch' => '証明書は :host ではなく、別のドメイン用に発行されています。ブラウザは警告を表示します。',
                'untrusted' => 'ブラウザは証明書（:issuer）を信頼していません。自己署名か、中間証明書が足りません。',
            ],
        ],
        'C2' => [
            'title' => '証明書の期限はもうすぐですか?',
            'text' => '残り30日以上',
            'fix' => '証明書を更新し、更新が自動で行われることを確かめてください。Let\'s Encrypt の証明書は90日間有効で、自動更新は気づかないうちに止まることがよくあります。',
            'notes' => [
                'ok' => ':date まで有効、残り :days 日です。',
                'soon' => '残りわずか :days 日（:date まで）です。自動で更新されるか確かめてください。',
                'urgent' => '残りわずか :days 日（:date まで）です。今すぐ更新してください。',
                'expired' => '証明書は :date に期限切れになりました。',
                'none' => 'チェックする証明書がありません。',
            ],
        ],
        'C3' => [
            'title' => 'http:// は https:// に移動しますか?',
            'text' => 'http から https へのリダイレクト',
            'fix' => 'すべての http:// アドレスから同じ https:// アドレスへの恒久的な（301）リダイレクトを設定してください。',
            'notes' => [
                'ok' => 'http:// のアドレスは https:// に移動します。',
                'none' => 'http:// のアドレスは暗号化なしで開きます。アドレスを手入力した訪問者は安全でない版に留まります。',
                'no_http' => 'サイトは http:// で応答しないため、リダイレクトするものはありません。',
            ],
        ],
        'C4' => [
            'title' => '接続は最新ですか?',
            'text' => 'TLS 1.2 または 1.3',
            'fix' => 'サーバーの設定で TLS 1.2 と 1.3 を有効にし、古いバージョンを無効にしてください。ブラウザはもう TLS 1.0 と 1.1 のサイトを開きません。',
            'notes' => [
                'ok' => '接続は :protocol を使っています。',
                'old' => '接続は古いバージョンの :protocol を使っています。',
                'none' => 'チェックする https 接続がありません。',
            ],
        ],
        'H1' => [
            'title' => 'ブラウザは常に https を使いますか?',
            'text' => '6か月以上の Strict-Transport-Security',
            'fix' => 'max-age を半年以上（1年がおすすめ）にし、includeSubDomains を付けた Strict-Transport-Security ヘッダーを追加してください。古い http:// リンクからでも、ブラウザは https でしかサイトを開かなくなります。',
            'notes' => [
                'ok' => 'HSTS はサブドメインを含め :days 日間有効です。',
                'none' => 'HSTS ヘッダーがありません。http:// での最初のアクセスが傍受されるおそれがあります。',
                'short' => 'HSTS は :days 日間しか有効ではありません。180日以上にしてください。',
                'no_subdomains' => 'HSTS がサブドメインを含んでいません。includeSubDomains を追加してください。',
                'no_https' => 'サイトが https で開けないため、HSTS は機能しません。',
            ],
        ],
        'H2' => [
            'title' => 'スクリプトは制限されていますか?',
            'text' => 'Content-Security-Policy',
            'fix' => 'スクリプト、スタイル、画像の読み込みを許可する提供元を並べた Content-Security-Policy を追加してください。まず Content-Security-Policy-Report-Only で何が壊れるかを確認してから有効にしましょう。',
            'notes' => [
                'ok' => 'スクリプトに unsafe-inline と unsafe-eval を含まないポリシーがあります。',
                'none' => 'Content-Security-Policy がありません。埋め込まれたスクリプト（XSS）が制限なく動作できます。',
                'report_only' => 'ポリシーはレポート専用モードです。違反を報告するだけで、何もブロックしません。',
                'unsafe' => 'ポリシーがスクリプトに :keywords を許可しているため、XSS に対する保護の大半が失われています。',
            ],
        ],
        'H3' => [
            'title' => '他のサイトがページをフレームで表示できますか?',
            'text' => 'X-Frame-Options または frame-ancestors',
            'fix' => '他のサイトがページを偽のボタンの下に重ねられないように（クリックジャッキング）、X-Frame-Options: SAMEORIGIN か、Content-Security-Policy の frame-ancestors \'self\' を追加してください。',
            'notes' => [
                'ok' => 'X-Frame-Options が他サイトでのフレーム表示を禁止しています。',
                'csp' => 'Content-Security-Policy の frame-ancestors がフレームを管理しています。',
                'none' => 'どのサイトでもページをフレームで表示できます。',
                'invalid' => 'X-Frame-Options の値が古いか不明です。ブラウザはこれを無視します。',
            ],
        ],
        'H4' => [
            'title' => 'ブラウザはファイルの種類を推測しますか?',
            'text' => 'X-Content-Type-Options: nosniff',
            'fix' => 'サーバーが別の種類だと伝えたファイルをブラウザがスクリプトとして実行しないように、X-Content-Type-Options: nosniff を追加してください。',
            'notes' => [
                'ok' => 'nosniff が有効です。',
                'none' => 'X-Content-Type-Options ヘッダーがありません。',
                'invalid' => '不明な値です。有効なのは nosniff だけです。',
            ],
        ],
        'H5' => [
            'title' => 'ページのアドレスが他サイトに漏れていますか?',
            'text' => 'Referrer-Policy',
            'fix' => 'Referrer-Policy: strict-origin-when-cross-origin を追加してください。他のサイトにはページのアドレスやパラメーターを含まず、ドメインだけが渡ります。',
            'notes' => [
                'ok' => 'ポリシーが設定されています。',
                'none' => 'Referrer-Policy ヘッダーがありません。ブラウザの既定値が使われます。',
                'leaky' => 'ポリシーがパラメーターやトークンを含むページの完全なアドレスを他サイトに送っています。',
            ],
        ],
        'H6' => [
            'title' => '使わないブラウザ機能はオフですか?',
            'text' => 'Permissions-Policy',
            'fix' => 'Permissions-Policy を追加し、サイトで使わないカメラ、マイク、位置情報、決済などをオフにしてください。そうすれば埋め込まれたスクリプトでもそれらを要求できません。',
            'notes' => [
                'ok' => 'ポリシーが設定されています。',
                'none' => 'Permissions-Policy ヘッダーがありません。',
                'legacy' => '古い Feature-Policy ヘッダーだけがあります。ブラウザはこれを Permissions-Policy に置き換えました。',
            ],
        ],
        'L1' => [
            'title' => 'サーバーはバージョンを明かしていますか?',
            'text' => 'バージョンなしの Server と X-Powered-By',
            'fix' => 'ヘッダーからサーバー、PHP、プラットフォームのバージョンを隠してください。ボットはそれを手がかりに、既知の脆弱性があるサイトを数秒で見つけます。',
            'notes' => [
                'ok' => 'ヘッダーはバージョンを明かしていません。',
                'leaks' => 'ヘッダーがソフトウェアのバージョンを明かしています。',
            ],
        ],
        'L2' => [
            'title' => 'Cookie は保護されていますか?',
            'text' => 'Secure、HttpOnly、SameSite 属性',
            'fix' => 'すべての Cookie に、https だけで送られるよう Secure を、スクリプトから読めないよう HttpOnly を、他サイトから送られないよう SameSite=Lax を付けてください。',
            'notes' => [
                'ok' => ':count 個の Cookie すべてに保護属性があります。',
                'insecure' => ':count 個の Cookie の一部に Secure 属性がなく、暗号化されていない接続で送られる可能性があります。',
                'partial' => ':count 個の Cookie の一部に HttpOnly または SameSite がありません。',
                'none' => 'ページは Cookie を設定していません。',
            ],
        ],
    ],
];

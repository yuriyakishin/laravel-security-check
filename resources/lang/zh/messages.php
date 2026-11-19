<?php

declare(strict_types=1);

return [
    'form' => [
        'label' => '网站地址',
        'button' => '检查',
        'hint' => '免费 · 无需注册 · 每小时最多 :count 次',
    ],
    'loading' => [
        'certificate' => '正在读取 SSL 证书',
        'headers' => '正在获取页面响应头',
        'checks' => '正在检查安全设置',
    ],
    'verdicts' => [
        'ready' => '网站防护良好',
        'almost' => '网站防护基本良好',
        'partly' => '网站防护需要改进',
        'not_ready' => '网站防护薄弱',
    ],
    'certificate' => [
        'title' => 'SSL 证书',
        'issuer' => '颁发者',
        'valid_to' => '有效期至',
        'days_left' => '还剩 :days 天',
        'protocol' => '连接',
        'names' => '域名',
        'none' => '网站无法通过 https 打开：443 端口上没有证书。',
    ],
    'groups' => [
        'C' => ['title' => '证书与 https', 'text' => '与网站的连接是否加密且可信'],
        'H' => ['title' => '安全响应头', 'text' => '告诉浏览器如何保护访客的服务器响应头'],
        'L' => ['title' => '信息泄露与 Cookie', 'text' => '服务器透露了哪些自身信息，以及如何设置 Cookie'],
    ],
    'checks' => [
        'C1' => [
            'title' => '浏览器信任这个证书吗？',
            'text' => '本域名的有效证书',
            'fix' => '从知名证书颁发机构为本域名安装证书。Let\'s Encrypt 可免费签发并自动续期。大多数主机控制面板都有“免费 SSL”按钮。',
            'notes' => [
                'ok' => '证书受信任，由 :issuer 颁发。',
                'none' => '网站无法通过 https 打开。浏览器会标记为“不安全”，数据以明文传输。',
                'expired' => '证书已于 :date 过期。浏览器会显示整页警告。',
                'name_mismatch' => '证书是为其他域名颁发的，而不是 :host。浏览器会显示警告。',
                'untrusted' => '浏览器不信任该证书（:issuer）：它是自签名的，或缺少中间证书。',
            ],
        ],
        'C2' => [
            'title' => '证书快到期了吗？',
            'text' => '至少还剩 30 天',
            'fix' => '续期证书，并确认续期是自动进行的：Let\'s Encrypt 证书有效期为 90 天，而自动续期经常在不知不觉中失效。',
            'notes' => [
                'ok' => '有效期至 :date，还剩 :days 天。',
                'soon' => '只剩 :days 天，到 :date 为止。请确认它会自动续期。',
                'urgent' => '只剩 :days 天，到 :date 为止。请立即续期。',
                'expired' => '证书已于 :date 过期。',
                'none' => '没有可检查的证书。',
            ],
        ],
        'C3' => [
            'title' => 'http:// 会跳转到 https:// 吗？',
            'text' => '从 http 重定向到 https',
            'fix' => '为每个 http:// 地址设置到相同 https:// 地址的永久（301）重定向。',
            'notes' => [
                'ok' => 'http:// 地址会跳转到 https://。',
                'none' => 'http:// 地址以未加密方式打开：手动输入地址的访客会停留在不安全的版本上。',
                'no_http' => '网站不响应 http://，因此无需重定向。',
            ],
        ],
        'C4' => [
            'title' => '连接是否足够新？',
            'text' => 'TLS 1.2 或 1.3',
            'fix' => '在服务器设置中启用 TLS 1.2 和 1.3，并关闭旧版本：浏览器已不再打开使用 TLS 1.0 和 1.1 的网站。',
            'notes' => [
                'ok' => '连接使用 :protocol。',
                'old' => '连接使用过时的版本 :protocol。',
                'none' => '没有可检查的 https 连接。',
            ],
        ],
        'H1' => [
            'title' => '浏览器是否总是使用 https？',
            'text' => 'Strict-Transport-Security 至少 6 个月',
            'fix' => '添加 Strict-Transport-Security 响应头，max-age 至少半年（最好一年），并带上 includeSubDomains。这样即使从旧的 http:// 链接进入，浏览器也只会通过 https 打开网站。',
            'notes' => [
                'ok' => 'HSTS 已启用 :days 天，包含子域名。',
                'none' => '没有 HSTS 响应头：通过 http:// 的首次访问可能被拦截。',
                'short' => 'HSTS 只启用了 :days 天。请至少设置 180 天。',
                'no_subdomains' => 'HSTS 未覆盖子域名：请添加 includeSubDomains。',
                'no_https' => '网站无法通过 https 打开，因此 HSTS 无法生效。',
            ],
        ],
        'H2' => [
            'title' => '脚本是否受到限制？',
            'text' => 'Content-Security-Policy',
            'fix' => '添加 Content-Security-Policy，列出允许加载脚本、样式和图片的来源。先使用 Content-Security-Policy-Report-Only 查看哪些内容会失效，然后再正式启用。',
            'notes' => [
                'ok' => '存在对脚本不含 unsafe-inline 和 unsafe-eval 的策略。',
                'none' => '没有 Content-Security-Policy：注入的脚本（XSS）可以不受限制地运行。',
                'report_only' => '策略处于仅报告模式：只报告违规，不拦截任何内容。',
                'unsafe' => '策略允许脚本使用 :keywords，这使它失去了大部分 XSS 防护作用。',
            ],
        ],
        'H3' => [
            'title' => '其他网站能在框架中显示此页面吗？',
            'text' => 'X-Frame-Options 或 frame-ancestors',
            'fix' => '添加 X-Frame-Options: SAMEORIGIN，或在 Content-Security-Policy 中添加 frame-ancestors \'self\'，防止其他网站把页面叠在虚假按钮下面（点击劫持）。',
            'notes' => [
                'ok' => 'X-Frame-Options 禁止在其他网站的框架中显示。',
                'csp' => '框架由 Content-Security-Policy 中的 frame-ancestors 控制。',
                'none' => '任何网站都可以在框架中显示此页面。',
                'invalid' => 'X-Frame-Options 的值已过时或无法识别：浏览器会忽略它。',
            ],
        ],
        'H4' => [
            'title' => '浏览器会猜测文件类型吗？',
            'text' => 'X-Content-Type-Options: nosniff',
            'fix' => '添加 X-Content-Type-Options: nosniff，这样当服务器声明文件是其他类型时，浏览器不会把它当作脚本执行。',
            'notes' => [
                'ok' => 'nosniff 已启用。',
                'none' => '没有 X-Content-Type-Options 响应头。',
                'invalid' => '无法识别的值：唯一有效的值是 nosniff。',
            ],
        ],
        'H5' => [
            'title' => '页面地址会泄露给其他网站吗？',
            'text' => 'Referrer-Policy',
            'fix' => '添加 Referrer-Policy: strict-origin-when-cross-origin：其他网站只会收到域名，不含页面地址及其参数。',
            'notes' => [
                'ok' => '已设置策略。',
                'none' => '没有 Referrer-Policy 响应头；浏览器使用其默认值。',
                'leaky' => '该策略会把完整的页面地址（包括参数和令牌）发送给其他网站。',
            ],
        ],
        'H6' => [
            'title' => '未使用的浏览器功能是否已关闭？',
            'text' => 'Permissions-Policy',
            'fix' => '添加 Permissions-Policy，关闭网站用不到的功能：摄像头、麦克风、定位、支付。这样即使是注入的脚本也无法请求它们。',
            'notes' => [
                'ok' => '已设置策略。',
                'none' => '没有 Permissions-Policy 响应头。',
                'legacy' => '只有旧的 Feature-Policy 响应头：浏览器已用 Permissions-Policy 取代它。',
            ],
        ],
        'L1' => [
            'title' => '服务器会透露版本号吗？',
            'text' => '不带版本号的 Server 和 X-Powered-By',
            'fix' => '在响应头中隐藏服务器、PHP 和平台的版本号：机器人会借此在几秒内找到存在已知漏洞的网站。',
            'notes' => [
                'ok' => '响应头没有透露任何版本号。',
                'leaks' => '响应头透露了软件的版本号。',
            ],
        ],
        'L2' => [
            'title' => 'Cookie 是否受到保护？',
            'text' => 'Secure、HttpOnly 和 SameSite 标志',
            'fix' => '为每个 Cookie 设置 Secure，使其只通过 https 传输；设置 HttpOnly，使脚本无法读取；设置 SameSite=Lax，使其他网站不会发送它。',
            'notes' => [
                'ok' => '全部 :count 个 Cookie 都带有保护标志。',
                'insecure' => ':count 个 Cookie 中有些没有 Secure 标志，可能通过未加密的连接传输。',
                'partial' => ':count 个 Cookie 中有些缺少 HttpOnly 或 SameSite。',
                'none' => '页面没有设置 Cookie。',
            ],
        ],
    ],
];

@php($whatsappNumber = preg_replace('/\D+/', '', (string) env('WHATSAPP_NUMBER', '')))
        <main id="home" class="hero">
            <section class="hero-inner" aria-labelledby="hero-title">
                <div class="hero-copy">
                    <p class="hero-eyebrow"><span aria-hidden="true"></span> Undangan digital, penuh makna</p>
                    <h1 id="hero-title">Hari istimewamu, <em>layak dikenang</em> dengan indah.</h1>
                    <p class="hero-description">Bagikan kisah dan momen bahagiamu lewat undangan digital yang personal, elegan, dan mudah dibagikan kepada orang tersayang.</p>
                    <div class="hero-actions">
                        <a class="hero-button hero-button-primary" href="#templates">Jelajahi Template <span aria-hidden="true">?</span></a>
                        <a class="hero-button hero-button-whatsapp" href="{{ $whatsappNumber ? 'https://wa.me/' . $whatsappNumber . '?text=' . rawurlencode('Halo, saya ingin bertanya tentang undangan digital.') : '#kontak' }}" @if ($whatsappNumber) target="_blank" rel="noopener noreferrer" @endif>
                            <svg aria-hidden="true" viewBox="0 0 24 24" fill="currentColor"><path d="M20.52 3.48A11.82 11.82 0 0 0 12.1 0C5.54 0 .2 5.34.2 11.9c0 2.1.55 4.15 1.6 5.96L.1 24l6.3-1.65a11.9 11.9 0 0 0 5.7 1.45h.01C18.67 23.8 24 18.46 24 11.9c0-3.18-1.24-6.17-3.48-8.42ZM12.1 21.78h-.01a9.9 9.9 0 0 1-5.04-1.38l-.36-.21-3.74.98 1-3.65-.24-.37a9.85 9.85 0 0 1-1.51-5.25c0-5.46 4.45-9.9 9.91-9.9 2.65 0 5.13 1.03 7 2.9a9.84 9.84 0 0 1 2.9 7c0 5.46-4.45 9.9-9.91 9.9Zm5.44-7.42c-.3-.15-1.77-.87-2.05-.97-.28-.1-.48-.15-.68.15-.2.3-.77.97-.95 1.17-.17.2-.35.22-.65.07-.3-.15-1.26-.46-2.4-1.48-.88-.78-1.48-1.75-1.65-2.05-.18-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.18.2-.3.3-.5.1-.2.05-.38-.03-.53-.08-.15-.68-1.63-.93-2.23-.24-.58-.49-.5-.68-.51h-.58c-.2 0-.53.08-.8.38-.28.3-1.06 1.03-1.06 2.5 0 1.48 1.09 2.9 1.24 3.1.15.2 2.14 3.27 5.19 4.59.72.31 1.28.5 1.72.64.72.23 1.37.2 1.89.12.58-.09 1.77-.72 2.02-1.42.25-.7.25-1.3.18-1.42-.08-.13-.28-.2-.58-.35Z"/></svg>
                            Tanya via WhatsApp
                        </a>
                    </div>
                </div>

                <div class="hero-art">
                    <svg class="invitation-art" viewBox="0 0 520 560" role="img" aria-labelledby="invitation-art-title invitation-art-description" xmlns="http://www.w3.org/2000/svg">
                        <title id="invitation-art-title">Pratinjau undangan pernikahan digital</title>
                        <desc id="invitation-art-description">Kartu undangan berwarna krem dengan hiasan bunga dan inisial pasangan.</desc>
                        <defs>
                            <linearGradient id="art-bg" x1="0" y1="0" x2="1" y2="1"><stop stop-color="#efe4d6"/><stop offset="1" stop-color="#dfcbb3"/></linearGradient>
                            <linearGradient id="card-bg" x1="0" y1="0" x2="0.9" y2="1"><stop stop-color="#fffefa"/><stop offset="1" stop-color="#f8f2e8"/></linearGradient>
                            <filter id="card-shadow" x="-30%" y="-20%" width="160%" height="160%"><feDropShadow dx="0" dy="18" stdDeviation="18" flood-color="#604b38" flood-opacity=".17"/></filter>
                        </defs>
                        <rect x="20" y="18" width="480" height="524" rx="40" fill="url(#art-bg)"/>
                        <circle cx="440" cy="95" r="72" fill="#fff" opacity=".18"/>
                        <circle cx="76" cy="463" r="92" fill="#fff" opacity=".16"/>
                        <g filter="url(#card-shadow)" transform="rotate(-3 260 280)">
                            <rect x="104" y="55" width="310" height="448" rx="8" fill="url(#card-bg)"/>
                            <rect x="119" y="70" width="280" height="418" rx="3" fill="none" stroke="#d8c3a8" stroke-width="1.2"/>
                            <path d="M259 71v44m-8-8 8 8 8-8" stroke="#b8946c" stroke-width="1.4" fill="none"/>
                            <text x="259" y="144" text-anchor="middle" fill="#8a735d" font-family="sans-serif" font-size="9" letter-spacing="3">THE WEDDING OF</text>
                            <text x="259" y="207" text-anchor="middle" fill="#513c2e" font-family="Georgia,serif" font-size="39" font-style="italic">Alya</text>
                            <text x="259" y="237" text-anchor="middle" fill="#bd9a70" font-family="Georgia,serif" font-size="20">&amp;</text>
                            <text x="259" y="280" text-anchor="middle" fill="#513c2e" font-family="Georgia,serif" font-size="39" font-style="italic">Raka</text>
                            <path d="M210 302h98" stroke="#d8c3a8"/>
                            <text x="259" y="333" text-anchor="middle" fill="#766656" font-family="sans-serif" font-size="9" letter-spacing="2">SABTU, 24 OKTOBER 2026</text>
                            <text x="259" y="359" text-anchor="middle" fill="#8a7968" font-family="Georgia,serif" font-size="12" font-style="italic">Dengan penuh cinta, kami mengundang</text>
                            <text x="259" y="377" text-anchor="middle" fill="#8a7968" font-family="Georgia,serif" font-size="12" font-style="italic">Anda untuk merayakan hari bahagia kami.</text>
                            <g fill="none" stroke="#b59b7e" stroke-width="1.2" opacity=".82">
                                <path d="M138 450c28-26 27-48 11-61m11 24c-1-12 4-21 15-26m-21 36c-10-7-20-7-31-2m30-5c-1-12 4-20 13-26"/>
                                <path d="M380 450c-28-26-27-48-11-61m-11 24c1-12-4-21-15-26m21 36c10-7 20-7 31-2m-30-5c1-12-4-20-13-26"/>
                            </g>
                            <g fill="#d9c7ae" opacity=".95"><ellipse cx="155" cy="412" rx="5" ry="10" transform="rotate(-35 155 412)"/><ellipse cx="143" cy="425" rx="5" ry="10" transform="rotate(-68 143 425)"/><ellipse cx="366" cy="412" rx="5" ry="10" transform="rotate(35 366 412)"/><ellipse cx="378" cy="425" rx="5" ry="10" transform="rotate(68 378 425)"/></g>
                        </g>
                        <g transform="translate(42 84)"><rect width="74" height="74" rx="22" fill="#fffdfa"/><path d="M37 19v36M19 37h36" stroke="#c19c72" stroke-width="1.5"/><circle cx="37" cy="37" r="13" fill="none" stroke="#c19c72"/></g>
                        <g transform="translate(390 406)"><rect width="82" height="82" rx="24" fill="#6b4e3d"/><path d="M23 42c8-15 28-15 36 0-8 15-28 15-36 0Z" fill="none" stroke="#f7ead8" stroke-width="1.4"/><circle cx="41" cy="42" r="6" fill="#d4a574"/></g>
                    </svg>
                    <div class="hero-art-caption"><span class="hero-caption-mark">?</span><span><strong>Dirancang dengan hati</strong><small>Untuk momen yang berarti</small></span></div>
                </div>
            </section>
        </main>

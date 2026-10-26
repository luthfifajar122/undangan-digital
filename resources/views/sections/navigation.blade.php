@php($whatsappNumber = preg_replace('/\D+/', '', (string) env('WHATSAPP_NUMBER', '')))
        <header class="site-header">
            <nav class="site-nav" aria-label="Navigasi utama">
                <a class="site-brand" href="#home" aria-label="Ruang Undang, beranda">Ruang <span>Undang</span></a>

                <details class="site-menu">
                    <summary class="site-menu-toggle" aria-label="Buka menu navigasi">
                        <span></span><span></span><span></span>
                    </summary>
                    <div class="site-menu-panel">
                        <a class="site-nav-link" href="#home">Beranda</a>
                        <a class="site-nav-link" href="#templates">Template</a>
                        <a class="site-nav-link" href="#cara-kerja">Cara Kerja</a>
                        <a class="site-nav-link" href="#kontak">Kontak</a>
                        <a class="site-order-link" href="{{ $whatsappNumber ? 'https://wa.me/' . $whatsappNumber : '#kontak' }}" @if ($whatsappNumber) target="_blank" rel="noopener noreferrer" @endif>
                            Pesan via WhatsApp
                        </a>
                    </div>
                </details>

                <div class="site-nav-desktop">
                    <a class="site-nav-link" href="#home">Beranda</a>
                    <a class="site-nav-link" href="#templates">Template</a>
                    <a class="site-nav-link" href="#cara-kerja">Cara Kerja</a>
                    <a class="site-nav-link" href="#kontak">Kontak</a>
                </div>
                <a class="site-order-link site-order-desktop" href="{{ $whatsappNumber ? 'https://wa.me/' . $whatsappNumber : '#kontak' }}" @if ($whatsappNumber) target="_blank" rel="noopener noreferrer" @endif>
                    Pesan via WhatsApp
                </a>
            </nav>
        </header>

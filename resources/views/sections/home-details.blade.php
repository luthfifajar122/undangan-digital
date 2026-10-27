@php($whatsappNumber = preg_replace('/\D+/', '', (string) env('WHATSAPP_NUMBER', '')))

<section class="home-benefits" aria-label="Keunggulan undangan digital">
    <div class="home-benefits-inner">
        <div><span class="benefit-icon">↗</span><p><strong>Mudah dibagikan</strong><small>Satu tautan untuk keluarga dan teman</small></p></div>
        <div><span class="benefit-icon">♡</span><p><strong>Terasa personal</strong><small>Nama dan detail hari bahagiamu</small></p></div>
        <div><span class="benefit-icon">✓</span><p><strong>RSVP lebih praktis</strong><small>Catat konfirmasi kehadiran tamu</small></p></div>
    </div>
</section>

<section class="how-section" id="cara-kerja" aria-labelledby="how-title">
    <div class="how-inner">
        <div class="how-heading">
            <p class="templates-eyebrow">Mudah dimulai</p>
            <h2 id="how-title">Dari pilih desain sampai <em>siap dibagikan</em></h2>
            <p>Siapkan undanganmu dalam beberapa langkah sederhana.</p>
        </div>
        <div class="how-steps">
            <article><span>01</span><h3>Pilih tema</h3><p>Temukan desain yang paling cocok dengan suasana acaramu.</p></article>
            <article><span>02</span><h3>Kirim detail acara</h3><p>Siapkan nama, waktu, lokasi, dan foto yang ingin ditampilkan.</p></article>
            <article><span>03</span><h3>Bagikan undangan</h3><p>Terima tautan undangan dan kirimkan kepada orang tersayang.</p></article>
        </div>
    </div>
</section>

<section class="contact-section" id="kontak" aria-labelledby="contact-title">
    <div class="contact-inner">
        <div><p class="templates-eyebrow">Ada yang ingin ditanyakan?</p><h2 id="contact-title">Mari siapkan hari istimewamu.</h2><p>Kami siap membantu memilih desain dan menyiapkan undangan digitalmu.</p></div>
        <a class="hero-button hero-button-primary" href="{{ $whatsappNumber ? 'https://wa.me/' . $whatsappNumber . '?text=' . rawurlencode('Halo, saya ingin bertanya tentang undangan digital.') : '#templates' }}" @if ($whatsappNumber) target="_blank" rel="noopener noreferrer" @endif>Hubungi kami <span aria-hidden="true">→</span></a>
    </div>
</section>
<footer class="home-footer"><a class="site-brand" href="#home">Ruang <span>Undang</span></a><p>Undangan digital untuk cerita yang istimewa.</p></footer>

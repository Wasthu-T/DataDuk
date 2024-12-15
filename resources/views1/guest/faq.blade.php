@extends('guest.index')

@section('content')

<!-- FAQ Section -->
<div class="container faq-section">
    <h1 class="text-center mb-4">Frequently Asked Questions (FAQ)</h1>
    <div class="accordion" id="faqAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <span class="faq-question">Apa itu DataDuk?</span>
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    <p class="faq-answer">DataDuk adalah platform yang dirancang untuk pengelolaan dan analisis data penduduk secara efisien dan akurat. Platform ini membantu dalam proses verifikasi dan pengolahan data penduduk dengan menggunakan teknologi terkini.</p>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <span class="faq-question">Bagaimana cara menggunakan DataDuk?</span>
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    <p class="faq-answer">Untuk menggunakan DataDuk, Anda cukup mendaftar akun, kemudian mengunggah dokumen data penduduk yang ingin dianalisis. Platform ini akan memproses data tersebut secara otomatis dengan menggunakan teknologi OCR untuk memastikan akurasi data.</p>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <span class="faq-question">Apakah DataDuk gratis untuk digunakan?</span>
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    <p class="faq-answer">DataDuk menyediakan pilihan paket gratis dan berbayar. Paket gratis menawarkan fungsi dasar, sementara paket berbayar memberikan fitur tambahan seperti kapasitas pemrosesan data yang lebih besar dan analisis lebih mendalam.</p>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    <span class="faq-question">Bagaimana cara menghubungi dukungan pelanggan?</span>
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    <p class="faq-answer">Anda dapat menghubungi dukungan pelanggan DataDuk dengan mengirimkan email ke <strong>support@dataduk.com</strong> atau menggunakan formulir kontak yang tersedia di situs web kami. Tim dukungan kami siap membantu Anda kapan saja.</p>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    <span class="faq-question">Apa manfaat menggunakan DataDuk?</span>
                </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    <p class="faq-answer">DataDuk membantu Anda dalam pengelolaan dan verifikasi data penduduk secara otomatis dan efisien. Dengan menggunakan teknologi OCR dan analisis data, Anda dapat memastikan akurasi data dan menghemat waktu dalam proses pengolahan data penduduk.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
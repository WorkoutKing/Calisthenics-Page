@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6 sm:mt-10 space-y-6 sm:space-y-10">

    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-gray-900 to-gray-800 p-6 sm:p-12 rounded-lg shadow-lg text-white text-center overflow-hidden">
        <div class="absolute inset-0 bg-[url('/images/hero-bg.svg')] bg-cover opacity-20"></div>
        <h1 class="text-3xl sm:text-5xl font-extrabold mb-3 sm:mb-4 relative z-10">1,2% GPM Parama</h1>
        <p class="text-base sm:text-lg text-gray-300 relative z-10">Prisidėkite prie aktyvios visuomenės kūrimo – jūsų parama padės skatinti sveiką gyvenseną!</p>
        <a href="#kaip-skirti" class="mt-4 sm:mt-6 inline-block bg-blue-500 hover:bg-blue-600 text-white text-sm sm:text-lg font-semibold px-4 sm:px-6 py-2 sm:py-3 rounded-lg shadow-md transition relative z-10">Skirti Paramą</a>
    </div>

    <!-- Kam skiriama parama? -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8 items-center bg-gray-900 p-6 sm:p-8 rounded-lg shadow-lg">
        <div>
            <h2 class="text-2xl sm:text-3xl font-bold text-white mb-3 sm:mb-4">Kur bus panaudota jūsų parama?</h2>
            <ul class="space-y-3 sm:space-y-4 text-gray-300 text-sm sm:text-base">
                <li class="flex items-center">
                    <i class="fa-solid fa-dumbbell text-blue-500 mr-2 sm:mr-3 text-lg sm:text-xl"></i> Jaunimo ir senjorų sporto programoms remti.
                </li>
                <li class="flex items-center">
                    <i class="fa-solid fa-calendar-check text-blue-500 mr-2 sm:mr-3 text-lg sm:text-xl"></i> Nemokamoms treniruotėms ir renginiams organizuoti.
                </li>
                <li class="flex items-center">
                    <i class="fa-solid fa-building text-blue-500 mr-2 sm:mr-3 text-lg sm:text-xl"></i> Lauko sporto aikštelių įrengimui ir priežiūrai.
                </li>
                <li class="flex items-center">
                    <i class="fa-solid fa-heartbeat text-blue-500 mr-2 sm:mr-3 text-lg sm:text-xl"></i> Sveikos gyvensenos skatinimui visuomenėje.
                </li>
            </ul>
        </div>
        <div>
            <img src="{{ asset('storage/pagePictures/gpm.JPG') }}" alt="Gatvės gimnastikos treniruotė" class="rounded-lg shadow-lg w-full">
        </div>
    </div>

    <!-- Kaip skirti paramą? -->
    <div id="kaip-skirti" class="bg-gray-800 p-6 sm:p-10 rounded-lg shadow-lg">
        <h2 class="text-2xl sm:text-3xl font-bold text-white mb-3 sm:mb-4">Kaip skirti 1,2% GPM?</h2>
        <ol class="space-y-3 sm:space-y-4 text-gray-300 text-sm sm:text-base">
            <li><span class="font-bold text-blue-400">1.</span> Prisijunkite prie <a href="https://deklaravimas.vmi.lt" class="text-blue-400 underline">Elektroninės deklaravimo sistemos (EDS)</a></li>
            <li><span class="font-bold text-blue-400">2. </span> „Deklaravimas“ suraskite ir spauskite „Pildyti formą“. Prašymą skirti paramą rasite „Dažniausiai pildomų formų” sąraše.</li>
            <li><span class="font-bold text-blue-400">3.</span> Gavėjo laukelyje įrašykite:<br><br>
                <span class="text-lg text-white">Paramos gavėjas: Kalistenika, VšĮ<br> arba <br> Įmonės kodas: 306995388</span><br><br>
                spauskite „Tęsti”. Kitame lange užpildykite būtiną prašymo informaciją: kokią dalį mokesčio ir iki kokio mokestinio laikotarpio skiriate.Taip pat galite nurodyti ir mokesčio dalies paskirtį. Suvedę duomenis spauskite „Išsaugoti”
            </li>
            <li><span class="font-bold text-blue-400">4.</span> Nurodykite paramos dydį – <span class="text-white font-bold">1,2%</span></li>
            <li><span class="font-bold text-blue-400">5.</span> Jei baigėte redagavimą, peržiūrėkite, ar duomenys teisingi, ir spauskite „Taip, teisingi”.</li>
            <li><span class="font-bold text-blue-400">6.</span> Atsidariusiame lange spauskite „Formuoti prašymą”.</li>
            <li><span class="font-bold text-blue-400">7.</span> Norėdami pateikti prašymą, spauskite „Pateikti”</li>
        </ol>
    </div>

    <!-- DUK -->
    <div class="bg-gray-900 p-6 sm:p-10 rounded-lg shadow-lg">
        <h2 class="text-2xl sm:text-3xl font-bold text-white mb-3 sm:mb-4">DUK</h2>
        <div class="space-y-3 sm:space-y-4">
            <div class="faq-item border-b border-gray-700 pb-3 sm:pb-4">
                <button class="faq-question w-full text-left text-base sm:text-lg text-blue-400 font-semibold flex justify-between items-center" onclick="toggleFAQ(1)">
                    Kas yra 1,2% GPM parama? <i class="fa-solid fa-chevron-down transition-transform duration-300" id="faq-icon-1"></i>
                </button>
                <p id="faq-answer-1" class="faq-answer hidden text-gray-300 mt-2 text-sm sm:text-base"> Kiekvienas Lietuvos gyventojas moka 15 proc. gyventojų pajamų mokestį (GPM). Surinkti pinigai keliauja į bendrą valstybės biudžetą.</p>
            </div>
            <div class="faq-item border-b border-gray-700 pb-3 sm:pb-4">
                <button class="faq-question w-full text-left text-base sm:text-lg text-blue-400 font-semibold flex justify-between items-center" onclick="toggleFAQ(2)">
                    Ar tai man kainuoja papildomai? <i class="fa-solid fa-chevron-down transition-transform duration-300" id="faq-icon-2"></i>
                </button>
                <p id="faq-answer-2" class="faq-answer hidden text-gray-300 mt-2 text-sm sm:text-base">GPM paramos skyrimas ją skiriančiam žmogui nieko nekainuoja. Jei 1,2 % GPM dalis nepaskiriama jokiai organizacijai ar institucijai, pinigai keliauja į bendrą valstybės biudžetą, kaip ir buvo numatyta.</p>
            </div>
            <div class="faq-item border-b border-gray-700 pb-3 sm:pb-4">
                <button class="faq-question w-full text-left text-base sm:text-lg text-blue-400 font-semibold flex justify-between items-center" onclick="toggleFAQ(3)">
                    Kada ir kaip kaip galiu skirti 1,2 % GPM paramą? <i class="fa-solid fa-chevron-down transition-transform duration-300" id="faq-icon-3"></i>
                </button>
                <p id="faq-answer-3" class="faq-answer hidden text-gray-300 mt-2 text-sm sm:text-base">Skirti paramą galima nuo einamųjų metų sausio 1 d. iki einamųjų metų gegužės 2 d. Prašymus galima pateikti per Elektroninę deklaravimo sistemą www.eds.lt. Popierinės prašymo formos nėra teikiamos. Kviečiame susipažinti su pildymo instrukcijomis.</p>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleFAQ(id) {
        let answer = document.getElementById("faq-answer-" + id);
        let icon = document.getElementById("faq-icon-" + id);
        answer.classList.toggle("hidden");
        icon.classList.toggle("rotate-180");
    }
</script>
@endsection

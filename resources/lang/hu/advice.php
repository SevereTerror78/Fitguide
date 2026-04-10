<?php

return [

    'page_title' => 'Tanácsadás',

    'hero_title' => 'Fitness tanácsadás',
    'hero_sub'   => 'Számold ki a Testtömegindexedet (BMI), és értsd meg jobban az egészséged.',

    'bmi_title' => 'BMI kalkulátor',

    'weight_label' => 'Testsúly (kg):',
    'height_label' => 'Magasság (cm):',

    'calculate_btn' => 'BMI kiszámítása',

    'bmi_illustration_alt' => 'BMI illusztráció',

    // BMI kategóriák
    'categories' => [
        'underweight' => 'Sovány',
        'normal'      => 'Normál',
        'overweight'  => 'Túlsúlyos',
        'obese'       => 'Elhízott',
    ],

    // BMI skála
    'scale' => [
        'underweight' => 'Sovány',
        'normal'      => 'Normál',
        'overweight'  => 'Túlsúlyos',
        'obese'       => 'Elhízott',
    ],

    // Tanács szövegek (KEYS MUST MATCH category_key!)
   'advices' => [
    'underweight' => 'Az alultáplált személyeknek szénhidrátban és egészséges zsírokban gazdag étrendet ajánlott követniük. A nők számára napi 2000–2200 kalória bevitele javasolt, valamint könnyű testmozgás végzése. A férfiak esetében napi 2200–2400 kalória ajánlott, és érdemes kis súlyokkal elkezdeni az edzést. Magvak, például granola és különféle diófélék fogyasztása is ajánlott.',
    'normal' => 'Az ilyen BMI-vel rendelkező személyek egészségesnek tekinthetők, és érdemes fenntartaniuk jelenlegi életmódjukat. A BMI megtartásához a nők számára napi 1700–1900 kalória, a férfiak számára pedig körülbelül 1800–2000 kalória bevitele javasolt. Az izomtömeg növelése érdekében súlyzós edzések ajánlottak. Az étrend ne tartalmazzon túl sok szénhidrátot és zsírt, hogy elkerülhető legyen a túlsúly kialakulása.',
    'overweight' => 'Az ebbe a BMI-kategóriába tartozó személyek az átlagnál kissé magasabb testsúllyal rendelkeznek. Ajánlott csökkenteni a szénhidrátban gazdag ételek fogyasztását, és előnyben részesíteni a kiegyensúlyozott, zöldségekben gazdag étrendet. A rendszeres testmozgás szintén javasolt. Az aktív mozgásformák, például a kerékpározás és a kocogás hatékony módjai lehetnek a fogyásnak. Általánosságban elmondható, hogy a nők napi 1500–1600 kalória, a férfiak pedig 1600–1700 kalória bevitele mellett fogynak. Egy új, aktív hobbi bevezetése szintén hozzájárulhat az egészséges életmódhoz.',
    'obese' => 'Az elhízással küzdő személyek számára jelentős életmódbeli változtatások szükségesek a fogyás érdekében. Az időszakos böjt egyesek számára hatékony módszer lehet, azonban alkalmazása előtt érdemes szakemberrel konzultálni. A mozgásformák megválasztásakor figyelembe kell venni az ízületek terhelhetőségét. Az alacsonyabb terhelésű mozgásformák, például a séta vagy a könnyű tempójú gyaloglás, kíméletes és hatékony megoldást jelenthetnek. A kiegyensúlyozott, tápanyagokban gazdag étrend kulcsfontosságú. A késő esti étkezések kerülése szintén segíthet az egészséges testsúly elérésében és megtartásában.',
    ],

];
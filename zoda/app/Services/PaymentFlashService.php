<?php

namespace App\Services;

class PaymentFlashService
{
    /**
     * Payment ranges per country.
     * [min, max, step] — step keeps numbers looking human (not random)
     */
    private const RANGES = [
        'GH' => ['min' => 30,     'max' => 7000,   'step' => 5,     'symbol' => 'GH₵', 'decimals' => 0],
        'NG' => ['min' => 5000,   'max' => 600000, 'step' => 500,   'symbol' => '₦',   'decimals' => 0],
        'KE' => ['min' => 100,    'max' => 60000,  'step' => 50,    'symbol' => 'Ksh', 'decimals' => 0],
        'ZA' => ['min' => 30,     'max' => 8000,   'step' => 10,    'symbol' => 'R',   'decimals' => 0],
    ];

    /**
     * Names pool — supply your own here.
     * I've added a starter set; replace/extend as you like.
     */
    private const NAMES = [
        // Ghana
                'GH' => [
            'Kwabena O.', 'Yeboah J.', 'Ama B.', 'Kofi M.', 'Akosua A.',
            'Yaw T.', 'Abena S.', 'Kojo Q.', 'Efua L.', 'Kwesi C.',

            'Esi D.', 'Nana F.', 'Afia R.', 'Kwaku P.', 'Adwoa G.',
            'Michael N.', 'Daniel K.', 'Grace E.', 'Samuel W.', 'Mavis Y.',

            'Joseph V.', 'Linda H.', 'Emmanuel Z.', 'Priscilla I.', 'Isaac U.',
            'Victoria X.', 'Richard J.', 'Esther O.', 'Bright B.', 'Sandra T.',

            'Francis A.', 'Janet M.', 'David S.', 'Rita C.', 'Stephen Q.',
            'Gloria L.', 'Philip D.', 'Beatrice F.', 'Thomas P.', 'Comfort G.',

            'Charles N.', 'Dorothy K.', 'George E.', 'Irene W.', 'Felix Y.',
            'Agnes R.', 'Martin H.', 'Elizabeth V.', 'Anthony J.', 'Florence O.',

            'Patrick B.', 'Monica A.', 'Andrew T.', 'Cynthia M.', 'Kenneth S.',
            'Juliet Q.', 'Nicholas L.', 'Rebecca C.', 'Christopher D.', 'Eunice F.',

            'Gabriel P.', 'Sophia G.', 'Alexander N.', 'Caroline K.', 'Matthew E.',
            'Doreen W.', 'Kwadwo Y.', 'Yaa R.', 'Kwaku H.', 'Akua V.',

            'Ama J.', 'Kwame O.', 'Kofi B.', 'Abena A.', 'Yaw T.',
            'Adwoa M.', 'Kojo S.', 'Esi Q.', 'Kwesi L.', 'Efua C.',

            'Nana D.', 'Afia F.', 'Kwabena P.', 'Akosua G.', 'Kwadwo N.',
            'Yaa K.', 'Kwaku E.', 'Akua W.', 'Ama Y.', 'Kwame R.',

            'Kofi H.', 'Abena V.', 'Yaw J.', 'Adwoa O.', 'Kojo B.',
            'Esi A.', 'Kwesi T.', 'Efua M.', 'Nana S.', 'Afia Q.',

            'Kwabena L.', 'Akosua C.', 'Kwadwo D.', 'Yaa F.', 'Kwaku P.',
            'Akua G.', 'Ama N.', 'Kwame K.', 'Kofi E.', 'Abena W.',

            'Yaw Y.', 'Adwoa R.', 'Kojo H.', 'Esi V.', 'Kwesi J.',
            'Efua O.', 'Nana B.', 'Afia A.', 'Kwabena T.', 'Akosua M.',

            'Kwadwo S.', 'Yaa Q.', 'Kwaku L.', 'Akua C.', 'Ama D.',
            'Kwame F.', 'Kofi P.', 'Abena G.', 'Yaw N.', 'Adwoa K.',

            'Kojo E.', 'Esi W.', 'Kwesi Y.', 'Efua R.', 'Nana H.',
            'Afia V.', 'Kwabena J.', 'Akosua O.', 'Kwadwo B.', 'Yaa A.',

            'Kwaku T.', 'Akua M.', 'Ama S.', 'Kwame Q.', 'Kofi L.',
            'Abena C.', 'Yaw D.', 'Adwoa F.', 'Kojo P.', 'Esi G.',

            'Kwesi N.', 'Efua K.', 'Nana E.', 'Afia W.', 'Kwabena Y.',
            'Akosua R.', 'Kwadwo H.', 'Yaa V.', 'Kwaku J.', 'Akua O.',

            'Ama B.', 'Kwame A.', 'Kofi T.', 'Abena M.', 'Yaw S.',
            'Adwoa Q.', 'Kojo L.', 'Esi C.', 'Kwesi D.', 'Efua F.',

            'Nana P.', 'Afia G.', 'Kwabena N.', 'Akosua K.', 'Kwadwo E.',
            'Yaa W.', 'Kwaku Y.', 'Akua R.', 'Ama H.', 'Kwame V.',

            'Kofi J.', 'Abena O.', 'Yaw B.', 'Adwoa A.', 'Kojo T.',
            'Esi M.', 'Kwesi S.', 'Efua Q.', 'Nana L.', 'Afia C.',

            'Kwabena D.', 'Akosua F.', 'Kwadwo P.', 'Yaa G.', 'Kwaku N.',
            'Akua K.', 'Ama E.', 'Kwame W.', 'Kofi Y.', 'Abena R.',

            'Yaw H.', 'Adwoa V.', 'Kojo J.', 'Esi O.', 'Kwesi B.',
            'Efua A.', 'Nana T.', 'Afia M.', 'Kwabena S.', 'Akosua Q.',

            'Kwadwo L.', 'Yaa C.', 'Kwaku D.', 'Akua F.', 'Ama P.',
            'Kwame G.', 'Kofi N.', 'Abena K.', 'Yaw E.', 'Adwoa W.',

            'Kojo Y.', 'Esi R.', 'Kwesi H.', 'Efua V.', 'Nana J.',
            'Afia O.', 'Kwabena B.', 'Akosua T.', 'Kwadwo M.', 'Yaa S.',

            'Kwaku Q.', 'Akua L.', 'Ama C.', 'Kwame D.', 'Kofi F.',
            'Abena P.', 'Yaw G.', 'Adwoa N.', 'Kojo K.', 'Esi E.',

            'Kwesi W.', 'Efua Y.', 'Nana R.', 'Afia H.', 'Kwabena V.',
            'Akosua J.', 'Kwadwo O.', 'Yaa B.', 'Kwaku A.', 'Akua T.',

            'Ama M.', 'Kwame S.', 'Kofi Q.', 'Abena L.', 'Yaw C.',
            'Adwoa D.', 'Kojo F.', 'Esi P.', 'Kwesi G.', 'Efua N.',
        ],







        // Nigeria
        'NG' => [
    'Chinedu O.', 'Adebayo A.', 'Ngozi C.', 'Emeka N.', 'Blessing E.',
    'Tunde A.', 'Chioma O.', 'Ibrahim M.', 'Chisom U.', 'Yusuf B.',

    'Adaeze I.', 'Oluwaseun K.', 'Obinna E.', 'Fatima S.', 'Uche N.',
    'Mariam A.', 'Kelechi O.', 'Babajide T.', 'Amaka C.', 'Sani M.',

    'Ifeanyi E.', 'Yetunde A.', 'Nnamdi O.', 'Aisha B.', 'Somtochukwu N.',
    'Ayomide A.', 'Chiamaka E.', 'Mubarak S.', 'Tochukwu I.', 'Funmi O.',

    'Olumide A.', 'Nneka C.', 'Ikenna M.', 'Zainab Y.', 'Femi O.',
    'Precious E.', 'Oghenetega A.', 'Abdulrahman K.', 'Ezinne N.', 'Damilola S.',

    'Kingsley O.', 'Temitope A.', 'Onyeka E.', 'Hauwa M.', 'Chukwudi N.',
    'Bukola O.', 'Ifeoma C.', 'Abdullahi S.', 'Ogechi A.', 'Seun B.',

    'Chukwuemeka I.', 'Ronke O.', 'Ebuka N.', 'Halima A.', 'Nkem E.',
    'Adekunle O.', 'Chinonso M.', 'Usman B.', 'Adaora C.', 'Taiwo A.',

    'Efe O.', 'Babatunde K.', 'Chidinma N.', 'Maryam S.', 'Kenechukwu E.',
    'Opeyemi A.', 'Ihuoma O.', 'Musa B.', 'Chibuzor M.', 'Yetunde C.',

    'Daniel O.', 'Olamide A.', 'Ijeoma N.', 'Abubakar S.', 'Godwin E.',
    'Tosin O.', 'Ugochukwu M.', 'Amina B.', 'Chidera A.', 'Akinwale K.',

    'David E.', 'Folake O.', 'Nwabueze N.', 'Safiya A.', 'Ibrahim S.',
    'Esther M.', 'Oluwatobi A.', 'Chukwuma O.', 'Hajara B.', 'Benedict C.',

    'Samuel O.', 'Eniola A.', 'Ngozichukwu N.', 'Yusuf S.', 'Khadijah M.',
    'Michael E.', 'Adebisi O.', 'Kosi N.', 'Mariam A.', 'Franklin B.',

    'Victor O.', 'Modupe A.', 'Chukwuemeka N.', 'Fatimah S.', 'Olajide K.',
    'Grace E.', 'Nkiruka O.', 'Kabiru M.', 'Favour A.', 'Ayodeji B.',

    'Stephen C.', 'Omotola O.', 'Nwachukwu A.', 'Zainab N.', 'Oluwafemi E.',
    'Joy O.', 'Ibrahim K.', 'Chiamaka S.', 'Moses A.', 'Aisha M.',

    'Anthony O.', 'Folashade A.', 'Emmanuel N.', 'Maryam E.', 'Kelechi S.',
    'Adeola O.', 'Chisom A.', 'Suleiman B.', 'Ebere C.', 'Tayo M.',

    'Joseph E.', 'Titilayo O.', 'Nnamdi A.', 'Hauwa N.', 'Oghenekaro S.',
    'Peace M.', 'Ademola O.', 'Uchechi K.', 'Haruna B.', 'Miracle E.',

    'Christopher O.', 'Bimpe A.', 'Chinedum N.', 'Aminu S.', 'Nneoma M.',
    'Oluwaseyi E.', 'Chukwuebuka O.', 'Rukayat A.', 'Ikechukwu B.', 'Seyi C.',

    'Benjamin N.', 'Bukola O.', 'Obinna A.', 'Khadija S.', 'Nwankwo E.',
    'Tolu O.', 'Amarachi M.', 'Abdulaziz B.', 'Eucharia A.', 'Kayode K.',

    'Patrick O.', 'Funmilayo A.', 'Chibueze N.', 'Zara E.', 'Olalekan S.',
    'Victoria M.', 'Nneka O.', 'Muktar B.', 'Chinaza A.', 'Dapo C.',

    'Gabriel E.', 'Ronke O.', 'Ifeanyi A.', 'Aisha N.', 'Oluwatoyin S.',
    'Charles M.', 'Chigozie O.', 'Yakubu B.', 'Ada N.', 'Kunle A.',

    'Richard O.', 'Yetunde C.', 'Emeka N.', 'Safiya M.', 'Oluwatosin E.',
    'Mercy O.', 'Chinedu A.', 'Bashir S.', 'Ijeoma B.', 'Folarin K.',

    'Martin N.', 'Adesewa O.', 'Kelechi A.', 'Maimuna E.', 'Chukwudi S.',
    'Blessing M.', 'Olamilekan O.', 'Fatima B.', 'Nnamdi C.', 'Ayo A.',

    'Henry E.', 'Temilade O.', 'Uche N.', 'Hajara A.', 'Okechukwu S.',
    'Janet M.', 'Adebayo O.', 'Chisom K.', 'Mubarak B.', 'Tosin E.',

    'George O.', 'Bukky A.', 'Ikenna N.', 'Maryam S.', 'Olumide E.',
    'Patience O.', 'Chukwuemeka M.', 'Amina B.', 'Efe A.', 'Adeyemi K.',

    'Francis N.', 'Oluwakemi O.', 'Chukwuma A.', 'Rashida S.', 'Ifeoma E.',
    'Samuel M.', 'Abiola O.', 'Sani B.', 'Chiamaka N.', 'Femi A.',

    'Matthew E.', 'Yewande O.', 'Ebuka A.', 'Zainab M.', 'Oluwaseun S.',
    'Faith N.', 'Nwachukwu O.', 'Halima B.', 'Ifeanyi A.', 'Tunde K.',

    'Andrew O.', 'Adetola A.', 'Nnamdi E.', 'Aisha S.', 'Chidera M.',
    'Deborah O.', 'Abdulrahman B.', 'Ngozi A.', 'Opeyemi N.', 'Chinedu K.',

    'David E.', 'Olamide O.', 'Ezinne A.', 'Mariam S.', 'Kelechi M.',
    'Rasheed O.', 'Amaka B.', 'Chukwuemeka N.', 'Bola A.', 'Suleiman K.',

    'Daniel O.', 'Yetunde A.', 'Ikenna E.', 'Fatima N.', 'Oghenetega S.',
    'Praise M.', 'Adekunle O.', 'Chioma B.', 'Yusuf A.', 'Temitope K.',

    'Michael E.', 'Folake O.', 'Chibuzor A.', 'Hauwa N.', 'Olajide S.',
    'Grace M.', 'Ugochukwu O.', 'Aisha B.', 'Ayomide A.', 'Nwachukwu K.',

    'Joseph N.', 'Funmi O.', 'Chisom A.', 'Abdullahi S.', 'Nneka E.',
    'Emmanuel M.', 'Oluwatobi O.', 'Khadijah B.', 'Obinna A.', 'Damilola K.',

    'Stephen E.', 'Ronke O.', 'Chukwudi A.', 'Zainab N.', 'Ifeoma S.',
    'Joy M.', 'Babajide O.', 'Amina B.', 'Kenechukwu A.', 'Seun K.',

    'Anthony O.', 'Titilayo A.', 'Nnamdi N.', 'Mariam E.', 'Oluwafemi S.',
    'Peace M.', 'Ibrahim O.', 'Chinonso B.', 'Adaeze A.', 'Kayode K.',

    'Patrick E.', 'Modupe O.', 'Emeka A.', 'Hauwa N.', 'Olamide S.',
    'Esther M.', 'Chukwuma O.', 'Safiya B.', 'Ijeoma A.', 'Akinwale K.',

    'Christopher N.', 'Bimpe O.', 'Ifeanyi A.', 'Fatimah S.', 'Kelechi E.',
    'Victoria M.', 'Oluwaseyi O.', 'Musa B.', 'Chiamaka A.', 'Folarin K.',

    'Benjamin E.', 'Folashade O.', 'Obinna A.', 'Rukayat N.', 'Chinedum S.',
    'Mercy M.', 'Adeola O.', 'Usman B.', 'Chidera A.', 'Taiwo K.',

    'Gabriel N.', 'Ogechi O.', 'Chukwuemeka A.', 'Zara S.', 'Opeyemi E.',
    'Janet M.', 'Nwabueze O.', 'Kabiru B.', 'Amarachi A.', 'Tayo K.',

    'Richard E.', 'Yewande O.', 'Uche A.', 'Maimuna N.', 'Oghenekaro S.',
    'Blessing M.', 'Ademola O.', 'Bashir B.', 'Nneoma A.', 'Seyi K.',

    'Martin N.', 'Eniola O.', 'Chukwuebuka A.', 'Khadija S.', 'Olalekan E.',
    'Patience M.', 'Nkem O.', 'Haruna B.', 'Precious A.', 'Ayo K.',

    'Henry E.', 'Omotola O.', 'Nnamdi A.', 'Aisha N.', 'Ikenna S.',
    'Faith M.', 'Adebisi O.', 'Muktar B.', 'Chinaza A.', 'Dapo K.',
],




        // Kenya
        'KE' => [
    'Wanjiku K.', 'Otieno O.', 'Kamau M.', 'Achieng A.', 'Mwangi N.',
    'Atieno O.', 'Kiptoo K.', 'Njeri W.', 'Omondi A.', 'Wambui M.',

    'Maina K.', 'Akinyi O.', 'Mutua M.', 'Nyambura W.', 'Kipchoge T.',
    'Odhiambo O.', 'Wanjiru N.', 'Koech K.', 'Muthoni A.', 'Ochieng M.',

    'Njoki K.', 'Ouma O.', 'Wambua M.', 'Adhiambo A.', 'Kiprotich K.',
    'Mumbi W.', 'Njoroge N.', 'Awuor O.', 'Musyoka M.', 'Chebet K.',

    'Nyawira A.', 'Otieno M.', 'Kariuki K.', 'Akoth O.', 'Mutiso N.',
    'Jepchirchir W.', 'Wairimu A.', 'Okello M.', 'Kilonzo K.', 'Akinyi N.',

    'Waithera O.', 'Omondi K.', 'Kipkoech M.', 'Moraa A.', 'Ndiritu W.',
    'Atieno K.', 'Kamau O.', 'Wanjiku N.', 'Mutua M.', 'Chepkoech A.',

    'Wambui K.', 'Odhiambo O.', 'Mwangi A.', 'Achieng M.', 'Kiptoo N.',
    'Njeri W.', 'Ouma K.', 'Nyambura O.', 'Koech A.', 'Muthoni M.',

    'Ochieng K.', 'Wanjiru O.', 'Maina N.', 'Awuor M.', 'Kipchoge A.',
    'Mumbi K.', 'Mutiso O.', 'Adhiambo W.', 'Njoroge M.', 'Chebet N.',

    'Kamau A.', 'Akinyi K.', 'Musyoka O.', 'Wairimu M.', 'Otieno N.',
    'Nyawira K.', 'Kariuki O.', 'Akoth A.', 'Kilonzo M.', 'Jepchirchir W.',

    'Moraa K.', 'Omondi O.', 'Wambua N.', 'Atieno M.', 'Kiprotich A.',
    'Waithera K.', 'Odhiambo W.', 'Njoki O.', 'Mwangi M.', 'Chepkoech N.',

    'Njeri A.', 'Ouma K.', 'Wanjiku O.', 'Mutua W.', 'Achieng M.',
    'Koech N.', 'Wambui K.', 'Njoroge A.', 'Awuor O.', 'Kiptoo M.',

    'Muthoni W.', 'Ochieng K.', 'Wanjiru A.', 'Maina O.', 'Adhiambo M.',
    'Kariuki N.', 'Mumbi K.', 'Okello W.', 'Chebet A.', 'Musyoka O.',

    'Nyambura M.', 'Kamau K.', 'Akinyi O.', 'Kipchoge N.', 'Wairimu A.',
    'Mutiso M.', 'Atieno K.', 'Omondi W.', 'Jepchirchir O.', 'Waithera N.',

    'Kilonzo K.', 'Nyawira A.', 'Otieno M.', 'Njeri O.', 'Kipkoech W.',
    'Wambua K.', 'Achieng N.', 'Mwangi A.', 'Moraa M.', 'Ouma K.',

    'Wanjiku O.', 'Odhiambo N.', 'Koech A.', 'Muthoni K.', 'Njoroge M.',
    'Adhiambo W.', 'Mutua O.', 'Chepkoech K.', 'Wanjiru A.', 'Musyoka N.',

    'Kamau M.', 'Akinyi K.', 'Kiptoo O.', 'Nyambura A.', 'Ochieng W.',
    'Wairimu M.', 'Maina N.', 'Awuor K.', 'Kariuki O.', 'Chebet M.',

    'Mumbi A.', 'Omondi K.', 'Njoki O.', 'Kiprotich N.', 'Wambui M.',
    'Atieno A.', 'Mutiso K.', 'Wanjiku O.', 'Okello N.', 'Waithera M.',

    'Njeri K.', 'Odhiambo A.', 'Mwangi O.', 'Jepchirchir M.', 'Akinyi N.',
    'Ouma W.', 'Muthoni K.', 'Kilonzo A.', 'Achieng O.', 'Koech M.',

    'Wanjiru K.', 'Kamau N.', 'Nyawira O.', 'Kipchoge A.', 'Moraa W.',
    'Musyoka M.', 'Adhiambo K.', 'Njoroge O.', 'Chepkoech A.', 'Wambua N.',

    'Awuor K.', 'Mutua M.', 'Ochieng O.', 'Wairimu A.', 'Kiptoo W.',
    'Mumbi N.', 'Maina K.', 'Omondi M.', 'Njeri O.', 'Kariuki A.',

    'Nyambura K.', 'Otieno N.', 'Wanjiku M.', 'Atieno O.', 'Koech W.',
    'Muthoni A.', 'Odhiambo K.', 'Chebet M.', 'Wanjiru N.', 'Mutiso O.',

    'Kamau A.', 'Akinyi M.', 'Njoroge K.', 'Achieng W.', 'Kiprotich O.',
    'Wambui N.', 'Ouma K.', 'Waithera M.', 'Mwangi A.', 'Jepchirchir O.',

    'Moraa K.', 'Musyoka N.', 'Adhiambo A.', 'Kilonzo M.', 'Wairimu O.',
    'Kipkoech K.', 'Nyawira N.', 'Ochieng M.', 'Mumbi A.', 'Njeri W.',

    'Wanjiku K.', 'Otieno O.', 'Kariuki M.', 'Akinyi N.', 'Mutua A.',
    'Chepkoech W.', 'Maina K.', 'Wambua O.', 'Nyambura M.', 'Koech N.',

    'Muthoni A.', 'Odhiambo K.', 'Wanjiru O.', 'Kiptoo M.', 'Awuor N.',
    'Kamau W.', 'Chebet K.', 'Omondi A.', 'Wairimu M.', 'Njoroge O.',

    'Achieng K.', 'Kipchoge N.', 'Mumbi W.', 'Musyoka A.', 'Njoki M.',
    'Atieno O.', 'Mwangi K.', 'Waithera N.', 'Mutiso A.', 'Ouma M.',

    'Wanjiku O.', 'Ochieng K.', 'Njeri A.', 'Kiprotich M.', 'Nyawira W.',
    'Kariuki N.', 'Adhiambo O.', 'Koech K.', 'Wambui M.', 'Odhiambo A.',

    'Muthoni O.', 'Kamau K.', 'Akinyi M.', 'Chebet N.', 'Wanjiru A.',
    'Mutua W.', 'Omondi K.', 'Maina O.', 'Awuor M.', 'Kilonzo N.',

    'Njoroge K.', 'Atieno A.', 'Kiptoo O.', 'Wairimu M.', 'Moraa N.',
    'Musyoka K.', 'Achieng O.', 'Wambua M.', 'Jepchirchir A.', 'Otieno W.',

    'Nyambura K.', 'Mwangi O.', 'Njoki M.', 'Ouma N.', 'Kariuki A.',
    'Wanjiku W.', 'Koech M.', 'Muthoni K.', 'Ochieng O.', 'Waithera A.',

    'Wanjiru M.', 'Kamau N.', 'Akinyi K.', 'Kipchoge O.', 'Chepkoech W.',
    'Mumbi A.', 'Adhiambo M.', 'Mutiso K.', 'Njeri O.', 'Omondi N.',

    'Wairimu K.', 'Njoroge M.', 'Atieno A.', 'Kiprotich O.', 'Nyawira W.',
    'Musyoka N.', 'Achieng K.', 'Wambui O.', 'Maina M.', 'Kilonzo A.',

    'Moraa K.', 'Odhiambo N.', 'Wanjiku O.', 'Koech M.', 'Otieno A.',
    'Chebet W.', 'Mwangi K.', 'Awuor O.', 'Wairimu N.', 'Mutua M.',

    'Njeri K.', 'Ouma A.', 'Kiptoo O.', 'Wanjiru M.', 'Kamau N.',
    'Muthoni K.', 'Akinyi W.', 'Njoroge O.', 'Wambua A.', 'Nyambura M.',

    'Ochieng K.', 'Jepchirchir N.', 'Adhiambo O.', 'Kariuki M.', 'Wanjiku A.',
    'Musyoka K.', 'Atieno W.', 'Koech O.', 'Mumbi N.', 'Waithera M.',

    'Maina K.', 'Achieng O.', 'Mutiso N.', 'Chepkoech A.', 'Wairimu M.',
    'Odhiambo K.', 'Njeri W.', 'Kipchoge O.', 'Ouma A.', 'Nyawira M.',

    'Kamau N.', 'Omondi K.', 'Wanjiru O.', 'Muthoni A.', 'Kiprotich M.',
    'Awuor W.', 'Mwangi K.', 'Chebet O.', 'Wambui N.', 'Kilonzo A.',

    'Otieno M.', 'Akinyi K.', 'Njoroge O.', 'Moraa N.', 'Musyoka A.',
    'Wanjiku M.', 'Koech W.', 'Adhiambo K.', 'Mutua O.', 'Atieno N.',

    'Wairimu A.', 'Ochieng M.', 'Kariuki K.', 'Nyambura O.', 'Kiptoo N.',
    'Njoki W.', 'Kamau A.', 'Wambua M.', 'Chepkoech K.', 'Ouma O.',
],






        // South Africa
        'ZA' => [
    'Thabo M.', 'Lerato N.', 'Sipho D.', 'Nomsa M.', 'Sibusiso K.',
    'Ayanda N.', 'Lungile M.', 'Zanele S.', 'Bongani N.', 'Nokuthula M.',

    'Themba D.', 'Busisiwe N.', 'Mandla M.', 'Precious S.', 'Nkosinathi Z.',
    'Amahle N.', 'Lethabo M.', 'Nosipho D.', 'Mpho K.', 'Kagiso N.',

    'Tumelo M.', 'Naledi S.', 'Tshepo N.', 'Palesa M.', 'Karabo D.',
    'Boitumelo K.', 'Refilwe N.', 'Masego M.', 'Kabelo S.', 'Katlego N.',

    'Ofentse M.', 'Keabetswe N.', 'Neo D.', 'Tebogo M.', 'Lesego K.',
    'Bontle N.', 'Kefilwe S.', 'Onalenna M.', 'Goitse D.', 'Lorato N.',

    'Mpho S.', 'Dineo M.', 'Keneilwe N.', 'Tshegofatso D.', 'Olebogeng M.',
    'Amogelang K.', 'Phenyo N.', 'Boipelo S.', 'Kitso M.', 'Kgotso D.',

    'Zinhle N.', 'Lindokuhle M.', 'Siyabonga K.', 'Nandi D.', 'Luyanda N.',
    'Khanyisile M.', 'Siyanda S.', 'Asanda N.', 'Lwazi K.', 'Noluthando M.',

    'Anele D.', 'Buhle N.', 'Lwandile M.', 'Ayabonga S.', 'Yamkela K.',
    'Nolwazi N.', 'Lukhanyo M.', 'Aphiwe D.', 'Sive N.', 'Olwethu K.',

    'Sandile M.', 'Ncedo N.', 'Vuyokazi D.', 'Yandisa M.', 'Noxolo K.',
    'Thembeka N.', 'Sanelisiwe M.', 'Lusanda S.', 'Nobuhle D.', 'Khwezi N.',

    'Kamohelo M.', 'Mokgadi N.', 'Molefi D.', 'Mpho K.', 'Tsholofelo S.',
    'Lorato N.', 'Boitumelo M.', 'Kagiso D.', 'Tshepiso K.', 'Neo N.',

    'Masego S.', 'Katlego M.', 'Lesedi N.', 'Tlotlo D.', 'Kelebogile M.',
    'Odirile K.', 'Masego N.', 'Gaone S.', 'Kabelo M.', 'Phenyo D.',

    'Andile M.', 'Banele N.', 'Lihle D.', 'Noluthando S.', 'Anele K.',
    'Lwazi N.', 'Siyabulela M.', 'Ntsika D.', 'Zuko K.', 'Khaya N.',

    'Lerato M.', 'Thabo N.', 'Sipho S.', 'Nomsa K.', 'Bongani D.',
    'Ayanda M.', 'Zanele N.', 'Mandla S.', 'Busisiwe K.', 'Nkosinathi M.',

    'Lethabo D.', 'Mpho N.', 'Tumelo K.', 'Naledi M.', 'Tshepo S.',
    'Palesa N.', 'Karabo D.', 'Kabelo M.', 'Katlego K.', 'Refilwe N.',

    'Thandeka M.', 'Sibongile N.', 'Siyabonga D.', 'Nokuthula K.', 'Lungile M.',
    'Nosipho S.', 'Zimasa N.', 'Nolwazi D.', 'Asanda K.', 'Buhle M.',

    'Kudzai N.', 'Tinashe M.', 'Farai D.', 'Rutendo K.', 'Tendai N.',
    'Nyasha M.', 'Tatenda S.', 'Blessing N.', 'Shingai D.', 'Anesu K.',

    'Mandla N.', 'Thabiso M.', 'Sello D.', 'Mosa K.', 'Kgomotso N.',
    'Mothusi M.', 'Tebogo S.', 'Otsile N.', 'Tumisang D.', 'Boitumelo K.',

    'Thabang M.', 'Lehlohonolo N.', 'Mpho D.', 'Tshepo K.', 'Kagiso M.',
    'Lesego S.', 'Ofentse N.', 'Neo D.', 'Kabelo K.', 'Tlotlo M.',

    'Aphiwe N.', 'Luyanda M.', 'Sive D.', 'Lwandile K.', 'Olwethu N.',
    'Lusanda M.', 'Anele S.', 'Zuko N.', 'Khaya D.', 'Yamkela K.',

    'Nandi M.', 'Zinhle N.', 'Buhle K.', 'Asanda D.', 'Lwazi M.',
    'Siyanda N.', 'Lukhanyo S.', 'Noluthando K.', 'Anele M.', 'Sanelisiwe D.',

    'Themba K.', 'Nomvula N.', 'Thulani M.', 'Siyabonga S.', 'Bongani K.',
    'Lindokuhle D.', 'Mthokozisi N.', 'Nkosinathi M.', 'Sibusiso K.', 'Mandla N.',

    'Ayanda S.', 'Zanele M.', 'Lerato K.', 'Sipho N.', 'Thabo D.',
    'Busisiwe M.', 'Nomsa K.', 'Kagiso N.', 'Mpho S.', 'Naledi M.',

    'Tshepo D.', 'Palesa K.', 'Karabo N.', 'Tumelo M.', 'Refilwe S.',
    'Kabelo D.', 'Katlego N.', 'Masego M.', 'Lesedi K.', 'Tebogo N.',

    'Ofentse M.', 'Bontle D.', 'Keabetswe N.', 'Neo K.', 'Gaone M.',
    'Phenyo S.', 'Olebogeng N.', 'Amogelang D.', 'Boipelo K.', 'Kgotso M.',

    'Thandeka N.', 'Nokuthula M.', 'Nosipho D.', 'Lungile K.', 'Zimasa N.',
    'Nolwazi M.', 'Asanda S.', 'Buhle N.', 'Luyanda D.', 'Aphiwe K.',

    'Siyabonga M.', 'Siyanda N.', 'Nandi K.', 'Zinhle D.', 'Lwazi M.',
    'Lukhanyo N.', 'Lwandile S.', 'Olwethu K.', 'Sive M.', 'Yamkela N.',

    'Mokgadi D.', 'Molefi M.', 'Kamohelo N.', 'Tsholofelo K.', 'Kelebogile S.',
    'Mothusi N.', 'Kgomotso M.', 'Mosa D.', 'Sello K.', 'Thabiso N.',

    'Lerato M.', 'Thabo S.', 'Sipho N.', 'Nomsa D.', 'Ayanda K.',
    'Zanele M.', 'Bongani N.', 'Nokuthula S.', 'Mandla K.', 'Busisiwe D.',

    'Sibusiso M.', 'Nkosinathi N.', 'Lethabo K.', 'Mpho D.', 'Tumelo M.',
    'Naledi S.', 'Tshepo N.', 'Palesa K.', 'Karabo M.', 'Kabelo D.',

    'Katlego N.', 'Refilwe M.', 'Masego S.', 'Lesego K.', 'Ofentse N.',
    'Neo M.', 'Tebogo D.', 'Bontle K.', 'Keabetswe N.', 'Gaone M.',

    'Anele N.', 'Buhle M.', 'Lwandile K.', 'Luyanda D.', 'Sive N.',
    'Aphiwe M.', 'Olwethu K.', 'Lwazi N.', 'Asanda M.', 'Zuko D.',

    'Khaya K.', 'Yamkela N.', 'Nolwazi M.', 'Sanelisiwe D.', 'Noluthando K.',
    'Zinhle N.', 'Lindokuhle M.', 'Siyabonga D.', 'Nandi K.', 'Lungile N.',

    'Thulani M.', 'Mthokozisi N.', 'Nomvula D.', 'Themba K.', 'Thabiso M.',
    'Siyabulela N.', 'Ntsika D.', 'Vuyokazi M.', 'Ncedo K.', 'Yandisa N.',

    'Kudzai M.', 'Tinashe N.', 'Farai K.', 'Rutendo D.', 'Tendai M.',
    'Nyasha S.', 'Tatenda N.', 'Shingai K.', 'Anesu M.', 'Blessing D.',

    'Kagiso M.', 'Mpho N.', 'Tshepo K.', 'Tumelo D.', 'Lethabo M.',
    'Karabo N.', 'Palesa S.', 'Naledi K.', 'Kabelo M.', 'Katlego D.',

    'Ofentse N.', 'Tebogo M.', 'Neo K.', 'Masego D.', 'Lesedi N.',
    'Bontle M.', 'Phenyo K.', 'Gaone N.', 'Kelebogile D.', 'Boipelo M.',

    'Zanele N.', 'Ayanda M.', 'Lerato K.', 'Thabo D.', 'Sipho N.',
    'Nomsa M.', 'Bongani K.', 'Busisiwe D.', 'Sibusiso N.', 'Mandla M.',

    'Nokuthula K.', 'Nkosinathi D.', 'Lungile M.', 'Nosipho N.', 'Siyanda K.',
    'Zinhle M.', 'Asanda D.', 'Lwazi N.', 'Buhle K.', 'Luyanda M.',

    'Aphiwe N.', 'Lwandile K.', 'Sive M.', 'Olwethu D.', 'Khaya N.',
    'Yamkela M.', 'Zuko K.', 'Nolwazi D.', 'Noluthando M.', 'Sanelisiwe N.',
],
    ];

    /**
     * Generate a random payment flash message for a given country.
     */
    public static function generate(?string $country): ?array
    {
        $country = strtoupper($country ?? '');

        if (!isset(self::RANGES[$country])) {
            return null; // country not supported
        }

        $range  = self::RANGES[$country];
        $names  = self::NAMES[$country] ?? ['Someone'];

        $name   = $names[array_rand($names)];
        $amount = self::randomAmount($range['min'], $range['max'], $range['step']);
        $symbol = $range['symbol'];
        $dec    = $range['decimals'];

        $formatted = number_format($amount, $dec);

        // "just received" wording — swap out if you prefer
        $message = "{$name} just received {$symbol}{$formatted}";

        return [
            'name'      => $name,
            'amount'    => $amount,
            'formatted' => $formatted,
            'symbol'    => $symbol,
            'message'   => $message,
            'country'   => $country,
        ];
    }

    /**
     * Generate N messages (useful for a rotating carousel).
     */
    public static function generateMany(?string $country, int $count = 5): array
    {
        $messages = [];
        for ($i = 0; $i < $count; $i++) {
            $msg = self::generate($country);
            if ($msg) $messages[] = $msg;
        }
        return $messages;
    }

    /**
     * Random amount snapped to a step (so it doesn't look like raw random).
     * e.g. step=500 → 5000, 5500, 6000... not 5237
     */
    private static function randomAmount(int $min, int $max, int $step): int
    {
        $steps = (int) floor(($max - $min) / $step);
        return $min + (random_int(0, $steps) * $step);
    }
}
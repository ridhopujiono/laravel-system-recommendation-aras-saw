<?php

namespace Database\Seeders;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenilaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data sumber Anda (bisa dipanjangkan sesuai kebutuhan)
        $sumberPenilaian = [
            [
                "nama" => "ABID AQILA PRATAMA",
                "C1" => "82",
                "C2" => "90",
                "C3" => "91",
                "C4" => "6",
            ],
            [
                "nama" => "ABRAHAM RAYYAN EFENDI",
                "C1" => "89",
                "C2" => "82",
                "C3" => "97",
                "C4" => "5",
            ],
            [
                "nama" => "ACHMAD FAHRI HERMANSYAH",
                "C1" => "88",
                "C2" => "88",
                "C3" => "84",
                "C4" => "3",
            ],
            [
                "nama" => "ACHMAD RAFFA SANTOSO",
                "C1" => "93",
                "C2" => "80",
                "C3" => "90",
                "C4" => "6",
            ],
            [
                "nama" => "ACHMAD RAFFI SANTOSO",
                "C1" => "97",
                "C2" => "84",
                "C3" => "82",
                "C4" => "6",
            ],
            [
                "nama" => "ADAM RADITIA SANTUSO",
                "C1" => "77",
                "C2" => "86",
                "C3" => "97",
                "C4" => "6",
            ],
            [
                "nama" => "ADEVA EKA NUR FEBRIANA",
                "C1" => "87",
                "C2" => "85",
                "C3" => "92",
                "C4" => "4",
            ],
            [
                "nama" => "ADINDA NUR FADILLA",
                "C1" => "88",
                "C2" => "88",
                "C3" => "85",
                "C4" => "5",
            ],
            [
                "nama" => "ADIVA AFSEEN MYESHA",
                "C1" => "75",
                "C2" => "89",
                "C3" => "79",
                "C4" => "5",
            ],
            [
                "nama" => "AFIKA AINUR FA'IZAH",
                "C1" => "80",
                "C2" => "80",
                "C3" => "87",
                "C4" => "6",
            ],
            [
                "nama" => "AHMAD BUERHANDIKA DWI TIRTA",
                "C1" => "78",
                "C2" => "82",
                "C3" => "81",
                "C4" => "6",
            ],
            [
                "nama" => "AHMAD ILHAM SETIAWAN",
                "C1" => "90",
                "C2" => "81",
                "C3" => "95",
                "C4" => "6",
            ],
            [
                "nama" => "AHMAD JULIYANTO RAMADANI",
                "C1" => "76",
                "C2" => "86",
                "C3" => "94",
                "C4" => "5",
            ],
            [
                "nama" => "AHMAD LUTFI HASAN",
                "C1" => "92",
                "C2" => "81",
                "C3" => "94",
                "C4" => "5",
            ],
            [
                "nama" => "AHMAD NOVAL DWIYANTO",
                "C1" => "77",
                "C2" => "88",
                "C3" => "85",
                "C4" => "2",
            ],
            [
                "nama" => "AHMAD RAVIEL HITO PUTRA",
                "C1" => "82",
                "C2" => "83",
                "C3" => "99",
                "C4" => "6",
            ],
            [
                "nama" => "AHMAD ROFIQULA'LA SIROJUDIN",
                "C1" => "96",
                "C2" => "89",
                "C3" => "93",
                "C4" => "5",
            ],
            [
                "nama" => "AKIFA DURAIYA AFSANY",
                "C1" => "89",
                "C2" => "84",
                "C3" => "96",
                "C4" => "6",
            ],
            [
                "nama" => "AKILA APRILIA ZULFITASARI",
                "C1" => "97",
                "C2" => "90",
                "C3" => "91",
                "C4" => "4",
            ],
            [
                "nama" => "AKMAL FARZANAGHANI",
                "C1" => "77",
                "C2" => "89",
                "C3" => "99",
                "C4" => "3",
            ],
            [
                "nama" => "AKMAL WAFA AL ASY'ARI",
                "C1" => "86",
                "C2" => "81",
                "C3" => "82",
                "C4" => "4",
            ],
            [
                "nama" => "ALIFAH ARDHINA",
                "C1" => "75",
                "C2" => "89",
                "C3" => "96",
                "C4" => "6",
            ],
            [
                "nama" => "ALZENA ELEANOR AQEELA",
                "C1" => "81",
                "C2" => "86",
                "C3" => "91",
                "C4" => "3",
            ],
            [
                "nama" => "ANDIKA FADHILA ARDIANTO",
                "C1" => "81",
                "C2" => "83",
                "C3" => "82",
                "C4" => "5",
            ],
            [
                "nama" => "ANGELINA RAMADHANISSA'IDAH",
                "C1" => "89",
                "C2" => "88",
                "C3" => "78",
                "C4" => "4",
            ],
            [
                "nama" => "ANINDITA KEISA ZAHRA",
                "C1" => "91",
                "C2" => "84",
                "C3" => "83",
                "C4" => "2",
            ],
            [
                "nama" => "AQILLA FATIYYATURRAHMA",
                "C1" => "94",
                "C2" => "90",
                "C3" => "79",
                "C4" => "3",
            ],
            [
                "nama" => "ASILLAH MUNICA PUTRI",
                "C1" => "86",
                "C2" => "83",
                "C3" => "89",
                "C4" => "6",
            ],
            [
                "nama" => "ASKHABUL KHAFI",
                "C1" => "93",
                "C2" => "89",
                "C3" => "78",
                "C4" => "3",
            ],
            [
                "nama" => "AVINEZ AURELYDA SETIAWAN",
                "C1" => "94",
                "C2" => "85",
                "C3" => "81",
                "C4" => "3",
            ],
            [
                "nama" => "AWANDA NAUFAL",
                "C1" => "92",
                "C2" => "85",
                "C3" => "96",
                "C4" => "2",
            ],
            [
                "nama" => "AZRIL HAIKAL FARIQ",
                "C1" => "88",
                "C2" => "86",
                "C3" => "92",
                "C4" => "4",
            ],
            [
                "nama" => "BA'DYA MUHAMMAD YUSUF HARTOYO",
                "C1" => "81",
                "C2" => "83",
                "C3" => "93",
                "C4" => "4",
            ],
            [
                "nama" => "BASTIAN ABID ATHARIZ",
                "C1" => "98",
                "C2" => "89",
                "C3" => "99",
                "C4" => "2",
            ],
            [
                "nama" => "BIMA CANDRA WIGUNA",
                "C1" => "95",
                "C2" => "86",
                "C3" => "89",
                "C4" => "5",
            ],
            [
                "nama" => "BRIAN JULIO ALFARO",
                "C1" => "83",
                "C2" => "89",
                "C3" => "79",
                "C4" => "5",
            ],
            [
                "nama" => "BRILLIANT NARENDRA UTOMO",
                "C1" => "94",
                "C2" => "85",
                "C3" => "94",
                "C4" => "2",
            ],
            [
                "nama" => "DANA PANGESTU",
                "C1" => "83",
                "C2" => "90",
                "C3" => "82",
                "C4" => "5",
            ],
            [
                "nama" => "DANILO ADIASTA FEBRIAN",
                "C1" => "85",
                "C2" => "85",
                "C3" => "78",
                "C4" => "5",
            ],
            [
                "nama" => "DANU PRATAMA",
                "C1" => "98",
                "C2" => "80",
                "C3" => "91",
                "C4" => "5",
            ],
            [
                "nama" => "DEVANYA JULITA RIZKY HARIANTO",
                "C1" => "77",
                "C2" => "83",
                "C3" => "91",
                "C4" => "6",
            ],
            [
                "nama" => "DEVARANI AQILAH PUTRI",
                "C1" => "82",
                "C2" => "88",
                "C3" => "94",
                "C4" => "5",
            ],
            [
                "nama" => "DIANDRA TRIUTOMO",
                "C1" => "88",
                "C2" => "86",
                "C3" => "98",
                "C4" => "3",
            ],
            [
                "nama" => "DINDA RACHEL FATMALA",
                "C1" => "94",
                "C2" => "90",
                "C3" => "95",
                "C4" => "5",
            ],
            [
                "nama" => "DISKHA PUTRI ANGGRAENI",
                "C1" => "92",
                "C2" => "81",
                "C3" => "90",
                "C4" => "4",
            ],
            [
                "nama" => "DITA ELEN NAFIZAH",
                "C1" => "92",
                "C2" => "84",
                "C3" => "79",
                "C4" => "4",
            ],
            [
                "nama" => "DWI SAPUTRA",
                "C1" => "97",
                "C2" => "84",
                "C3" => "91",
                "C4" => "6",
            ],
            [
                "nama" => "ELOK ROZITA NAIRA",
                "C1" => "79",
                "C2" => "84",
                "C3" => "95",
                "C4" => "3",
            ],
            [
                "nama" => "ERLINDA AMELIA SEPTIANA PUTRI",
                "C1" => "79",
                "C2" => "90",
                "C3" => "97",
                "C4" => "3",
            ],
            [
                "nama" => "ESHAL PUTRI NURIN NAJWA",
                "C1" => "84",
                "C2" => "87",
                "C3" => "89",
                "C4" => "5",
            ],
            [
                "nama" => "FATHAN AL - FAHREZA",
                "C1" => "90",
                "C2" => "80",
                "C3" => "90",
                "C4" => "3",
            ],
            [
                "nama" => "FATIMATUL ZAHRO",
                "C1" => "96",
                "C2" => "81",
                "C3" => "94",
                "C4" => "4",
            ],
            [
                "nama" => "FELINDA PUTRI WAHYUDI",
                "C1" => "75",
                "C2" => "81",
                "C3" => "95",
                "C4" => "4",
            ],
            [
                "nama" => "FERO SHOLAHUDIN",
                "C1" => "93",
                "C2" => "89",
                "C3" => "86",
                "C4" => "4",
            ],
            [
                "nama" => "GILDA MAURA OKTAVIA",
                "C1" => "76",
                "C2" => "86",
                "C3" => "81",
                "C4" => "5",
            ],
            [
                "nama" => "HAFIDHOH ZAHRANI ARRUM SEPTIYA PUTRI",
                "C1" => "89",
                "C2" => "90",
                "C3" => "97",
                "C4" => "5",
            ],
            [
                "nama" => "HAFIZA KAIRA LUBNA",
                "C1" => "79",
                "C2" => "80",
                "C3" => "85",
                "C4" => "6",
            ],
            [
                "nama" => "HAFIZH ALVARO AA NUR AGFI",
                "C1" => "78",
                "C2" => "83",
                "C3" => "89",
                "C4" => "3",
            ],
            [
                "nama" => "HAZIQ AHZA",
                "C1" => "89",
                "C2" => "83",
                "C3" => "86",
                "C4" => "2",
            ],
            [
                "nama" => "IRSYAD AL GHIFARI MULYA",
                "C1" => "96",
                "C2" => "90",
                "C3" => "93",
                "C4" => "3",
            ],
            [
                "nama" => "IRSYAD SARFRAZ ABQARY",
                "C1" => "81",
                "C2" => "87",
                "C3" => "86",
                "C4" => "6",
            ],
            [
                "nama" => "JOVANKA KEYRA NUR MAULIDYA",
                "C1" => "98",
                "C2" => "85",
                "C3" => "86",
                "C4" => "5",
            ],
            [
                "nama" => "JUNI ADITYA PRATAMA",
                "C1" => "89",
                "C2" => "90",
                "C3" => "80",
                "C4" => "2",
            ],
            [
                "nama" => "LAYLI ROSYIDA",
                "C1" => "98",
                "C2" => "88",
                "C3" => "79",
                "C4" => "5",
            ],
            [
                "nama" => "LEO KUSNAJAR",
                "C1" => "98",
                "C2" => "85",
                "C3" => "98",
                "C4" => "5",
            ],
            [
                "nama" => "M. ILHAM SABILAL MUTTAQIN",
                "C1" => "84",
                "C2" => "81",
                "C3" => "94",
                "C4" => "6",
            ],
            [
                "nama" => "M. NAUFAL VIRENDRA SHAFWAN",
                "C1" => "87",
                "C2" => "87",
                "C3" => "84",
                "C4" => "3",
            ],
            [
                "nama" => "M. SHAKA ARKA WIRATAMA",
                "C1" => "84",
                "C2" => "90",
                "C3" => "78",
                "C4" => "6",
            ],
            [
                "nama" => "M. TRYVANDA RAFKA SAPUTRA",
                "C1" => "89",
                "C2" => "80",
                "C3" => "87",
                "C4" => "2",
            ],
            [
                "nama" => "MAHARANI SHEILA ANINDITA",
                "C1" => "77",
                "C2" => "87",
                "C3" => "88",
                "C4" => "2",
            ],
            [
                "nama" => "MARITZA CHAYRA NADHIFA",
                "C1" => "96",
                "C2" => "89",
                "C3" => "90",
                "C4" => "4",
            ],
            [
                "nama" => "MIKHAYLA ALYSAHADI",
                "C1" => "93",
                "C2" => "81",
                "C3" => "84",
                "C4" => "6",
            ],
            [
                "nama" => "MOCH FITRAUL FAHRY",
                "C1" => "89",
                "C2" => "80",
                "C3" => "79",
                "C4" => "4",
            ],
            [
                "nama" => "MOH ADAM ALBAR ALHAKIM",
                "C1" => "97",
                "C2" => "85",
                "C3" => "93",
                "C4" => "5",
            ],
            [
                "nama" => "MOH. FAISAL FIRMANSAH",
                "C1" => "85",
                "C2" => "80",
                "C3" => "97",
                "C4" => "2",
            ],
            [
                "nama" => "MOHAMAD AGUNG LAKSONO",
                "C1" => "94",
                "C2" => "88",
                "C3" => "79",
                "C4" => "3",
            ],
            [
                "nama" => "MOHAMAD DESTRA SURYA PRANATA",
                "C1" => "85",
                "C2" => "82",
                "C3" => "91",
                "C4" => "3",
            ],
            [
                "nama" => "MOHAMAD ULIL ABSOR",
                "C1" => "94",
                "C2" => "80",
                "C3" => "85",
                "C4" => "4",
            ],
            [
                "nama" => "MOHAMMAD GINO WIRA SAPUTRA",
                "C1" => "96",
                "C2" => "85",
                "C3" => "98",
                "C4" => "4",
            ],
            [
                "nama" => "MOHAMMAD NIZAM FERDIANSYAH",
                "C1" => "96",
                "C2" => "82",
                "C3" => "81",
                "C4" => "6",
            ],
            [
                "nama" => "MOHAMMAD RENDYANSAH",
                "C1" => "89",
                "C2" => "88",
                "C3" => "95",
                "C4" => "6",
            ],
            [
                "nama" => "MUFIKA MAYDHITA MUSTONO",
                "C1" => "88",
                "C2" => "82",
                "C3" => "92",
                "C4" => "2",
            ],
            [
                "nama" => "MUHAMMAD ABI HANAFI",
                "C1" => "95",
                "C2" => "87",
                "C3" => "88",
                "C4" => "3",
            ],
            [
                "nama" => "MUHAMMAD AGUS SETIA",
                "C1" => "98",
                "C2" => "83",
                "C3" => "88",
                "C4" => "5",
            ],
            [
                "nama" => "MUHAMMAD ARVINO NAZRIL RASHAAD",
                "C1" => "94",
                "C2" => "80",
                "C3" => "86",
                "C4" => "6",
            ],
            [
                "nama" => "MUHAMMAD ASYAM RAZIQ DERYA RAMADHAN",
                "C1" => "85",
                "C2" => "88",
                "C3" => "92",
                "C4" => "6",
            ],
            [
                "nama" => "MUHAMMAD RAFASYA ADITYA SAPUTRA",
                "C1" => "85",
                "C2" => "81",
                "C3" => "82",
                "C4" => "6",
            ],
            [
                "nama" => "MUHAMMAD RAFIF PRADANA",
                "C1" => "85",
                "C2" => "80",
                "C3" => "89",
                "C4" => "2",
            ],
            [
                "nama" => "MUHAMMAD RIZKI ANGGARA",
                "C1" => "93",
                "C2" => "88",
                "C3" => "90",
                "C4" => "3",
            ],
            [
                "nama" => "MUHAMMAD SAHAL MAHFUDH",
                "C1" => "89",
                "C2" => "88",
                "C3" => "81",
                "C4" => "4",
            ],
            [
                "nama" => "MUHAMMAD SEPTYAN DAVID MAULANA",
                "C1" => "81",
                "C2" => "80",
                "C3" => "82",
                "C4" => "5",
            ],
            [
                "nama" => "MUHAMMAD ZIDAN CALLEN RAFIANDRA SAPUTRA",
                "C1" => "78",
                "C2" => "90",
                "C3" => "83",
                "C4" => "3",
            ],
            [
                "nama" => "MYESHA RAHMA ADEEVA",
                "C1" => "89",
                "C2" => "89",
                "C3" => "78",
                "C4" => "6",
            ],
            [
                "nama" => "NABILAH AMIN NATA",
                "C1" => "87",
                "C2" => "89",
                "C3" => "84",
                "C4" => "2",
            ],
            [
                "nama" => "NADYA APRILIA SARI",
                "C1" => "98",
                "C2" => "85",
                "C3" => "98",
                "C4" => "4",
            ],
            [
                "nama" => "NAJWA KHAIRA WILDA",
                "C1" => "96",
                "C2" => "87",
                "C3" => "95",
                "C4" => "6",
            ],
            [
                "nama" => "NAJWA KHOIRUNNISA",
                "C1" => "88",
                "C2" => "89",
                "C3" => "86",
                "C4" => "3",
            ],
            [
                "nama" => "NAKESHA ADILIA QUENARA",
                "C1" => "93",
                "C2" => "90",
                "C3" => "83",
                "C4" => "5",
            ],
            [
                "nama" => "NASYILA PUTRI NUR KHADIJAH",
                "C1" => "96",
                "C2" => "82",
                "C3" => "82",
                "C4" => "6",
            ],
            [
                "nama" => "NAURA HASNA ANNIDA",
                "C1" => "75",
                "C2" => "83",
                "C3" => "91",
                "C4" => "4",
            ],
            [
                "nama" => "NAVISHA OKTHAVIA AROSYID",
                "C1" => "96",
                "C2" => "89",
                "C3" => "80",
                "C4" => "6",
            ],
            [
                "nama" => "NENA VIRNANDA",
                "C1" => "77",
                "C2" => "88",
                "C3" => "95",
                "C4" => "3",
            ],
            [
                "nama" => "NIHAYATUL KHUSNAH",
                "C1" => "84",
                "C2" => "82",
                "C3" => "99",
                "C4" => "6",
            ],
            [
                "nama" => "NUR ALIF RAMADHAN",
                "C1" => "90",
                "C2" => "81",
                "C3" => "83",
                "C4" => "2",
            ],
            [
                "nama" => "NUR ROHMAN",
                "C1" => "83",
                "C2" => "87",
                "C3" => "92",
                "C4" => "3",
            ],
            [
                "nama" => "NURNAYLA SALSABILA",
                "C1" => "91",
                "C2" => "88",
                "C3" => "91",
                "C4" => "4",
            ],
            [
                "nama" => "QAMIRA OKTA NUR ASYIFA",
                "C1" => "94",
                "C2" => "88",
                "C3" => "89",
                "C4" => "6",
            ],
            [
                "nama" => "QURROHTA'AYUN ARDIANSYAH",
                "C1" => "97",
                "C2" => "84",
                "C3" => "81",
                "C4" => "5",
            ],
            [
                "nama" => "RACHEL CALLISTA PRAYOGI",
                "C1" => "93",
                "C2" => "84",
                "C3" => "87",
                "C4" => "3",
            ],
            [
                "nama" => "ROBERT FADHIL RABBANI",
                "C1" => "80",
                "C2" => "83",
                "C3" => "85",
                "C4" => "3",
            ],
            [
                "nama" => "ROBI YUDA AGUNG PRASTIYO",
                "C1" => "94",
                "C2" => "80",
                "C3" => "95",
                "C4" => "6",
            ],
            [
                "nama" => "SALMA",
                "C1" => "98",
                "C2" => "80",
                "C3" => "98",
                "C4" => "5",
            ],
            [
                "nama" => "SATRIA YUDHISTIRA",
                "C1" => "94",
                "C2" => "84",
                "C3" => "88",
                "C4" => "6",
            ],
            [
                "nama" => "SELYA JULI KHAIFAH RAMADHANI",
                "C1" => "75",
                "C2" => "89",
                "C3" => "93",
                "C4" => "5",
            ],
            [
                "nama" => "SHAFIQA QIANA ALMAHYRA",
                "C1" => "98",
                "C2" => "80",
                "C3" => "78",
                "C4" => "2",
            ],
            [
                "nama" => "SHELA SHEPTRIASA VALEVI",
                "C1" => "94",
                "C2" => "90",
                "C3" => "81",
                "C4" => "6",
            ],
            [
                "nama" => "SITI NUR AULIA RAMADHANI",
                "C1" => "91",
                "C2" => "88",
                "C3" => "86",
                "C4" => "5",
            ],
            [
                "nama" => "SITI NUR KHALISA",
                "C1" => "92",
                "C2" => "81",
                "C3" => "97",
                "C4" => "6",
            ],
            [
                "nama" => "SYABANA GISSEL DWI ZAHRA PAMBUDI",
                "C1" => "87",
                "C2" => "87",
                "C3" => "96",
                "C4" => "2",
            ],
            [
                "nama" => "TAZKIYA NAJWA WAFA",
                "C1" => "86",
                "C2" => "82",
                "C3" => "92",
                "C4" => "2",
            ],
            [
                "nama" => "THALITA NUR FADHILA",
                "C1" => "81",
                "C2" => "82",
                "C3" => "92",
                "C4" => "3",
            ],
            [
                "nama" => "UMAIRAH NUR AZZARAH",
                "C1" => "78",
                "C2" => "83",
                "C3" => "95",
                "C4" => "2",
            ],
            [
                "nama" => "WULANDARI",
                "C1" => "81",
                "C2" => "84",
                "C3" => "93",
                "C4" => "6",
            ],
            [
                "nama" => "ZAHRA MEILA PRATIWI",
                "C1" => "82",
                "C2" => "84",
                "C3" => "87",
                "C4" => "3",
            ],
        ];


        $this->command->info('Memulai proses seeding Penilaian...');

        // Hapus data lama untuk menghindari duplikasi
        Penilaian::truncate();

        // Ambil semua data alternatif dan kriteria sekali saja untuk efisiensi
        // Buat map [nama => id] dan [kode_kriteria => id]
        $alternatifMap = Alternatif::pluck('id', 'nama')->all();
        $kriteriaMap = Kriteria::pluck('id', 'kode_kriteria')->all();

        $penilaianToInsert = [];
        $now = now();

        // Loop melalui data sumber
        foreach ($sumberPenilaian as $data) {
            $namaAlternatif = $data['nama'];

            // Cek apakah alternatif ada di database
            if (isset($alternatifMap[$namaAlternatif])) {
                $id_alternatif = $alternatifMap[$namaAlternatif];

                // Loop melalui setiap kriteria (C1, C2, dst.)
                foreach ($data as $key => $nilai) {
                    // Hanya proses kolom kriteria (yang diawali 'C')
                    if (str_starts_with($key, 'C')) {

                        // Cek apakah kriteria ada di database
                        if (isset($kriteriaMap[$key])) {
                            $id_kriteria = $kriteriaMap[$key];

                            // Kumpulkan data untuk di-insert
                            $penilaianToInsert[] = [
                                'id_alternatif' => $id_alternatif,
                                'id_kriteria' => $id_kriteria,
                                'nilai' => $nilai,
                                'created_at' => $now,
                                'updated_at' => $now,
                            ];
                        }
                    }
                }
            } else {
                // Beri peringatan jika ada nama alternatif di array yang tidak ada di database
                $this->command->warn("Peringatan: Alternatif dengan nama '{$namaAlternatif}' tidak ditemukan. Data dilewati.");
            }
        }

        // Insert semua data sekaligus dalam satu query untuk performa maksimal
        if (!empty($penilaianToInsert)) {
            Penilaian::insert($penilaianToInsert);
        }

        $this->command->info('Seeding Penilaian selesai. Total ' . count($penilaianToInsert) / count($kriteriaMap) . ' alternatif diproses.');
    }
}
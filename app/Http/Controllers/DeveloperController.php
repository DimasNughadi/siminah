<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeveloperController extends Controller
{
    public function index()
    {
        $dev = [
            [
                "roles" => "lecture",
                "nama" => "Jan Alif Kreshna, S.S.T., M.Sc.",
                "gambar" => "lectures/JAK.jpeg",
                "role" => "Head of Team & Web Development Team"
            ],
            [
                "roles" => "lecture",
                "nama" => "Khairul Umam Syaliman, S.T., M.Kom.",
                "gambar" => "lectures/KUS.jpeg",
                "role" => "Web Development Team"
            ],
            [
                "roles" => "lecture",
                "nama" => "Kartina Diah Kusuma Wardhani, S.T., M.T.",
                "gambar" => "lectures/DIAH.jpg",
                "role" => "Web Development Team"
            ],
            [
                "roles" => "lecture",
                "nama" => "Erzi Hidayat, S.T., M.Kom.",
                "gambar" => "lectures/ERH.jpeg",
                "role" => "Web Development Team"
            ],
            [
                "roles" => "lecture",
                "nama" => "Shumaya Resty Ramadhani, S.S.T., M.Sc.",
                "gambar" => "lectures/SSR.jpeg",
                "role" => "Mobile Development Team"
            ],
            [
                "roles" => "lecture",
                "nama" => "Puja Hanifah, S.S.T., M.MSI.",
                "gambar" => "lectures/PJH.jpeg",
                "role" => "Mobile Development Team"
            ],
            [
                "roles" => "lecture",
                "nama" => "Yuliska, S.T., M.Eng.",
                "gambar" => "lectures/YLK.jpg",
                "role" => "Mobile Development Team"
            ],
            [
                "roles" => "lecture",
                "nama" => "Silvana Rasio Henim, S.S.T., M.T.",
                "gambar" => "lectures/SRH.jpeg",
                "role" => "Mobile Development Team"
            ],
            [
                "roles" => "mobile",
                "nama" => "Bobby",
                "gambar" => "mobile/bobby.png",
                "role" => "Head of Mobile Development Team"
            ],
            [
                "roles" => "mobile",
                "nama" => "Goh Chok Tong",
                "gambar" => "mobile/bobby.png",
                "role" => "Head of Mobile Development Team"
            ],
            [
                "roles" => "mobile",
                "nama" => "Bobby",
                "gambar" => "mobile/bobby.png",
                "role" => "Head of Mobile Development Team"
            ],
            [
                "roles" => "mobile",
                "nama" => "Kelly Chan",
                "gambar" => "mobile/bobby.png",
                "role" => "Head of Mobile Development Team"
            ],
            [
                "roles" => "mobile",
                "nama" => "Chintya Ang",
                "gambar" => "mobile/bobby.png",
                "role" => "Head of Mobile Development Team"
            ],
            [
                "roles" => "web",
                "nama" => "Dimas Nugroho",
                "gambar" => "web/dimas.jpg",
                "role" => "Head of Mobile Development Team"
            ],
            [
                "roles" => "web",
                "nama" => "Josep Ronaldo Francis Siregar",
                "gambar" => "web/JRFS.png",
                "role" => "Frontend Developer"
            ],
            [
                "roles" => "web",
                "nama" => "Camelin",
                "gambar" => "web/camelin.jpg",
                "role" => "Backend Developer"
            ],
            [
                "roles" => "web",
                "nama" => "Muhammad Raihan Khairullah",
                "gambar" => "web/raihan.jpg",
                "role" => "Head of Mobile Development Team"
            ],
        ];

        // dd($dev);
        return view("developer", ["developer" => $dev]);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: Hiệp Nguyễn
 * Date: 31/08/2021
 * Time: 14:17
 */

require_once "Complete_words.php";

const TESTS = [
    4338  => [
        "C. CHA M Ẹ CHA M Ẹ RU Ộ T CHA M Ẹ V Ợ CH Ồ NG CHA M Ẹ K Ế",
        "H Ồ S Ơ CH Ứ NG MINH NG ƯỜ I PH Ụ THU Ộ C",
        "Thu ế su ấ t đố i v ớ i các kho ả n thu nh ậ p khác",
        "Hoàn thu ế",
    ],
    5226  => [
        "Ki ế n trúc Vi ệ t Nam t ừ n ă m 1975 đế n",
        "M ụ c tiêu"
    ],
    5618  => [
        "IV.4. Máy bi ế n dòng ph ụ cho b ả o v ệ so l ệ ch",
        "V. B Ả O V Ệ SO L Ệ CH KHI CÓ DÒNG T Ừ HOÁ NH Ả Y V Ọ T HI Ệ N T ƯỢ NG QUÁ KÍCH T Ừ MBA",
        "VI. MỘT SỐ SƠ ĐỒ BẢO VỆ TIÊU BIỂU CHO MBA Các ký hi ệ u trên s ơ đồ",
    ],
    6753  => [
        "i3. Các hình th ứ c t ồ n t ạ i c ủ a ch ủ th ể th ẩ m m ỹ",
        "2. Đặ c tr ư ng th ẩ m m ỹ c ủ a ngh ệ thu ậ t",
        "3. Các lo ạ i hình ngh ệ thu ậ t và cách th ưở ng th ứ c ngh ệ thu ậ t",
        "VI. GIÁO D Ụ C TH Ẩ M M Ỹ",
    ],
    9760  => [
        "Capture m ộ t t ệ p audio dùng Capture Wizard 1 Vào menu Tools ch ọ n Capture",
        "L ư u và xu ấ t b ả n b ả n trình di ễ n 1 Vào menu File ch ọ n Pack and Go",
        "đố i T ượ ng Có th ể ch ọ n nhi ề u câu tr ả l ờ i",

    ],
    10336 => [
        "Đ I Ề U Đ Ó TÙY THU Ộ C VÀO B Ạ N",
        "BI Ế N N ƯỚ C THÀNH R ƯỢ U",
        "B Ạ N PH Ả I LÀ CHÍNH MÌNH",
        "ĐẶ T CHÂN LÊN N ƯỚ C M Ỹ",
        "S Ự LÊN NGÔI C Ủ A DOANH NHÂN",
        "H Ọ C KINH DOANH",
        "BI Ế N ĐỔ I TH Ế GI Ớ I R ƯỢ U",
    ],
    10784 => [
        "1. Chu k ỳ s ố ng c ủ a s ả n ph ẩ m",
        "3. Các chi ế n l ượ c marketing theo chu k ỳ s ố ng c ủ a s ả n ph ẩ m",
        "M Ụ C TIÊU MARKETING",
    ],
    18426 => [
        "TR Ậ N Đ ÔNG B Ộ ĐẦ U 28 2911258",
        "TR Ậ N NH Ư NGUY Ệ T V Ạ N KI Ế P V Ĩ NH BÌNH 671285",
        "TR Ậ N VÂN ĐỒ N 11288",
        "TR Ậ N B Ạ CH ĐẰ NG N Ă M",
        "TR Ậ N THÀNH Đ A BANG 11407",
        "TR Ậ N THÀNH Đ A BANG",
        "TR Ậ N T Ố T ĐỘ NG CHÚC ĐỘ NG 7111426",
    ]
];

foreach (TESTS as $id => $cases) {
    $dictionary = __DIR__ . "/test/{$id}_text.txt";
    $helper     = new Complete_words($dictionary);
    foreach ($cases as $case) {
        echo($helper->completeWords($case) . "\n");
    }
}


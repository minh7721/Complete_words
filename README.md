# Complete_words

Complete words was wrong space for example:

**Wrong:**

```
"C. CHA M Ẹ CHA M Ẹ RU Ộ T CHA M Ẹ V Ợ CH Ồ NG CHA M Ẹ K Ế",
"H Ồ S Ơ CH Ứ NG MINH NG ƯỜ I PH Ụ THU Ộ C",
"Thu ế su ấ t đố i v ớ i các kho ả n thu nh ậ p khác",
"Hoàn thu ế",
```

**Right:**

```
C. CHA MẸ CHA MẸ RUỘT CHA MẸ VỢ CHỒNG CHA MẸ KẾ
HỒ SƠ CHỨNG MINH NGƯỜI PHỤ THUỘC
Thuế suất đối với các khoản thu nhập khác
Hoàn thuế
```

You can add your text file as dictionary or using `dictionary.txt`

# Installation:

```shell
composer install nguyenhiep/complete_vietnames_words:dev-master
```

# Usage:

```phpt
$helper           = new Nguyenhiep\CompleteWords\CompleteWords($dictionary);
echo($helper->completeWords($case));
```

# Testing:

Clone project and run :

```shell
composer install
```

```shell
php test.php
```

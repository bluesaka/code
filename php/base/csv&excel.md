# CSV读取

```php
$fp = fopen('xxx.csv', 'r'); //文件名最好不要有中文，不然要额外处理
if (!$fp) return false;

$data = [];
while ($item = fgetcsv($fp, 10000)) {
    $data[] = [
        'name' => iconv('utf-8', 'gbk', $item[2]), //中文转码
        'age' => $item[3],
    ];
}
fclose($fp);
```

# CSV保存

```php
$fp = fopen('xxx.csv', 'w');
$data = [
  ['a', 1],
  ['b', 2],
];

foreach ($data as $item) {
    foreach ($item as &$v) $v = iconv('utf-8', 'gbk', $v); //中文转码
    fputcsv($fp, $item);
}

fclose($fp);
```

# excel - PhpSpreadsheet

```php
// phpexcel已不再维护，使用phpspreadsheet
// composer require phpoffice/phpspreadsheet

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'hello world');

$writer = new Xlsx($spreadsheet);
// $writer->save('1.xlsx');

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="2.xlsx"');
header('Cache-Control: max-age=0');
$writer->save('php://output');
```

# excel转csv，身份证信息编程科学计数法解决
```
csv文件用文本打开，在身份证后面加上空格(\t，正则替换\r\n -> \t\r\n)，然后打开就正常了
```

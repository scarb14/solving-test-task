<?php

require_once 'Glossary.php';
require_once 'Strings.php';

$text = "Пятая версия PHP была выпущена разработчиками 13 июля 2004 года. Изменения включают обновление ядра Zend (Zend Engine 2), что существенно увеличило эффективность интерпретатора. Введена поддержка языка разметки XML. Полностью переработаны функции ООП, которые стали во многом схожи с моделью, используемой в Java. В частности, введён деструктор, открытые, закрытые и защищённые члены и методы, окончательные члены и методы, интерфейсы и клонирование объектов. Нововведения, однако, были сделаны с расчётом сохранить наибольшую совместимость с кодом на предыдущих версиях языка. На данный момент последней стабильной веткой является PHP 5.3, которая содержит ряд изменений и дополнений";
$expectedResult = "Пятая версия {{PHP}} была выпущена разработчиками 13 июля 2004 года. Изменения включают обновление ядра {{Zend}} (Zend Engine 2), что существенно увеличило эффективность интерпретатора. Введена поддержка языка разметки {{XML}}. Полностью переработаны функции {{ООП}}, которые стали во многом схожи с моделью, используемой в Java. В частности, введён деструктор, открытые, закрытые и защищённые члены и методы, окончательные члены и методы, интерфейсы и клонирование объектов. Нововведения, однако, были сделаны с расчётом сохранить наибольшую совместимость с кодом на предыдущих версиях языка. На данный момент последней стабильной веткой является PHP 5.3, которая содержит ряд изменений и дополнений";


$Strings = new Strings(Glossary::STRING_CONFIG);
$result = $Strings->highlightKeywords($text, Glossary::KEY_WORDS);

if ($result === $expectedResult) {
    echo "Полученный результат совпал с ожидаемым<br><br>";
} else {
    echo "Полученный результат не совпал с ожидаемым<br><br>";
}

echo "<b>Полученные результат:</b><br>" . $result . "<br><br>";

echo "<b>Ожидаемый результат:</b><br>" . $expectedResult . "<br><br>";
exit;
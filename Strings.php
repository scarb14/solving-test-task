<?php

Class Strings
{

    private $selectorBefore = "<";

    private $selectorAfter = ">";

    private $firstEntryOnly = false;

    private $multibyteCharacterSet = false;

    private $delimiterCharacters = "[\s!.,?:;-{}()\[\]]";

    public function __construct($config = [])
    {
        if (isset($config['selectorBefore'])) {
            $this->selectorBefore = $config['selectorBefore'];
        }
        if (isset($config['selectorAfter'])) {
            $this->selectorAfter = $config['selectorAfter'];
        }
        if (isset($config['firstEntryOnly'])) {
            $this->firstEntryOnly = $config['firstEntryOnly'];
        }
        if (isset($config['multibyteCharacterSet'])) {
            $this->multibyteCharacterSet = $config['multibyteCharacterSet'];
        }
        if (isset($config['delimiterCharacters'])) {
            $this->delimiterCharacters = $config['delimiterCharacters'];
        }
    }

    public function highlightKeywords(string $text, array $arrayOfWords): string
    {
        foreach ($arrayOfWords as $word) {
            $text = $this->replaceWordInText($word, $text);
        }
        return $text;
    }

    private function replaceWordInText(string $search, string $text): string
    {
        $pattern = $this->getPattern($search);
        $replacement = $this->getReplacement();
        if ($this->firstEntryOnly) {
            preg_match($pattern, $text, $matches);
            return preg_replace($pattern, $replacement, $text, 1);
        }
        return preg_replace($pattern, $replacement, $text);
    }

    private function getPattern($word): string
    {
        $сharactersForward = "(?=" . $this->delimiterCharacters . ")";
        $сharactersBackward = "(?<=" . $this->delimiterCharacters . ")";

        $beginStr = "(^" . $word . ")" . $сharactersForward;
        $endStr = $сharactersBackward . "(" . $word . "$)";
        $middleStr = $сharactersBackward . "(" . $word . ")" . $сharactersForward;

        $pattern = $beginStr . "|" . $middleStr . "|" .  $endStr;

        if ($this->multibyteCharacterSet) {
            return "/" . $pattern . "/ui";
        }
        return "/[" . $pattern . ")/i";
    }

    private function getReplacement(): string
    {
        return $this->selectorBefore . '$2' . $this->selectorAfter;
    }
}
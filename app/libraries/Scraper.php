<?php


use DiDom\Document;
use Faker\Factory;

class Scraper
{
    public string $url;
    public Document $dom;

    public function __construct(string $url)
    {
        $this->url = $url;
        $this->parse();
    }

    /**
     * Scrapes a page with the url passed in __construct
     *
     */
    private function parse(): void
    {
        $paramString = $this->getParamString();
        $curl = curl_init($this->url . "?$paramString");
        $userAgent = $this->createFaker();
        curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $result = curl_exec($curl);
        curl_close($curl);
        if (!$result) {
            echo "Ошибка CURL: " . curl_error($curl);
        }
        $this->dom = new Document($result);
    }

    /**
     * Generates Fake User Agent
     * @return string
     */
    private function createFaker(): string
    {
        $faker = Faker\Factory::create();
        return $faker->userAgent();
    }

    /**
     * Replaces var names like varName to var_name
     * @return string
     */
    private function getParamString(): string
    {
        $paramString = '';
        if (!empty($_GET)) {
            foreach ($_GET as $paramKey => $paramValue) {
                $paramString .= "$paramKey=$paramValue&";
            }
        }
        return substr(mb_strtolower(preg_replace('/[A-Z]/', '${1}_${0}$3', $paramString)), 0, -1);
    }

    /**
     * Returns first result of preg_match
     * @param string $expression
     * @param $target
     * @return string
     */
    public function regex(string $expression, string $target = ''): string
    {
        if ($target !== '') {
            preg_match($expression, $target, $matches);
        } else {
            preg_match($expression, $this->dom, $matches);
        }
        return $matches[0];
    }

    /**
     * Allows to use DiDom methods
     * @return Document
     */
    public function getDom(): Document
    {
        return $this->dom;
    }

}
<?php

namespace app\Builder;


use app\Model\Article;
use app\Model\Header;
use app\Model\Image;
use app\Model\Line;
use app\Model\ListItem;
use app\Model\Paragraph;
use app\Model\Youtube;

class ArticleBuilder
{
    /**
     * @var
     */
    private $paragraph;

    /**
     * @var
     */
    private $header;

    /**
     * @var
     */
    private $image;

    /**
     * @var
     */
    private $line;

    /**
     * @var
     */
    private $listItem;

    /**
     * @var
     */
    private $youtubeVideo;


    /**
     * @param Header $header
     * @return $this
     */
    public function addHeader(Header $header)
    {
        if ($this->header){
            throw new \RuntimeException('Header already set');
        }

        $this->header = $header;
        return $this;
    }

    /**
     * @param Image $image
     * @return $this
     */
    public function addImage(Image $image)
    {
        if ($this->image){
            throw new \RuntimeException('Image already set');
        }

        $this->image = $image;
        return $this;
    }

    /**
     * @param Line $lines
     * @return $this
     */
    public function addLine(Line $lines)
    {
        if ($this->line){
            throw new \RuntimeException('Line already set');
        }

        $this->line = $lines;
        return $this;
    }

    /**
     * @param ListItem $listItem
     * @return $this
     */
    public function addListItem(ListItem $listItem)
    {
        if ($this->listItem){
            throw new \RuntimeException('ListItem already set');
        }

        $this->listItem = $listItem;
        return $this;
    }

    /**
     * @param Paragraph $paragraph
     * @return $this
     */
    public function addParagraph(Paragraph $paragraph)
    {
        if ($this->paragraph){
            throw new \RuntimeException('Paragraph already set');
        }

        $this->paragraph = $paragraph;
        return $this;
    }

    /**
     * @param Youtube $youtubeVideo
     * @return $this
     */
    public function addYoutubeVideo(Youtube $youtubeVideo)
    {
        if ($this->youtubeVideo){
            throw new \RuntimeException('YoutubeVideo already set');
        }

        $this->youtubeVideo = $youtubeVideo;
        return $this;
    }

    /**
     * @return Article
     */
    public function createArticle()
    {
        if (!$this->paragraph){
            throw new \RuntimeException('Paragraph quantity should be set first');
        }

        if (!$this->line){
            throw new \RuntimeException('Lines should be set');
        }

        if (!$this->paragraph->setParagraphSpecificAmount()){
            throw new \RuntimeException('Paragraph quantity setting faild');
        }

        $html = $this->createMainTemplate();

        if ($this->header){
            $headers = $this->header->getHeadersSpecificAmount();
            $html = $this->insertHeadersIntoHtml($html);
        }

        if ($this->image){
            $html = $this->insertImagesIntoHtml($html);
        }

        if ($this->listItem){
            $html = $this->insertListsIntoHtml($html);
        }

        if ($this->youtubeVideo){
            $html = $this->insertYoutubeIntoHtml($html);
        }

        return new Article($html);
    }

    private function createMainTemplate()
    {
        $html = '';
        $amount = $this->paragraph->getParagraphSpecificAmount();
        for ($i=0; $i < $amount; $i++) {
                $html .= '<p>';
                $html .= implode($this->line->getLinesSpecificAmount(), ' ');
                $html .= '</p>'.PHP_EOL;
        }

        return $html;
    }

    private function insertHeadersIntoHtml($html)
    {
        $headers = $this->header->getHeadersSpecificAmount($this->paragraph);

        if($headers) {
            $count = count($headers);
            for($i=0; $i<$count; $i++){
                $html = $this->replacment(
                    '</p>'.PHP_EOL.'<p>',
                    '</p>'.PHP_EOL.'<h2>'.$headers[$i].'</h2>'.PHP_EOL.'<p>',
                    $html,
                    rand(1,substr_count($html, '</p>'.PHP_EOL.'<p>')));
            }
        }
        return $html;
    }

    private function insertImagesIntoHtml($html)
    {
        $images = $this->image->getImagesSpecificAmount();

        if($images) {
            $count = count($images);
            for($i=0; $i<$count; $i++){
                $html = $this->replacment(
                    '</h2>'.PHP_EOL.'<p>',
                    '</h2>'.PHP_EOL.'<img src="'.$images[$i].'">'.PHP_EOL.'<p>',
                    $html,
                    rand(1,substr_count($html, '</h2>'.PHP_EOL.'<p>')));
            }
        }
        return $html;
    }

    private function insertListsIntoHtml($html)
    {
        $lists = $this->listItem->getListsSpecificAmount();

        if($lists) {
            $count = count($lists);
            for($i=0; $i<$count; $i++){
                $html = $this->replacment(
                    '</p>'.PHP_EOL.'<h2>',
                    '</p>'.PHP_EOL.'<ul><li>'.implode($lists[$i], '</li><li>').'</li></ul>'.PHP_EOL.'<h2>',
                    $html,
                    rand(1,substr_count($html, '</p>'.PHP_EOL.'<h2>')));
            }
        }
        return $html;
    }

    private function insertYoutubeIntoHtml($html)
    {
        $youtube = $this->youtubeVideo->getYoutubeSpecificAmount();

        if($youtube) {
            $count = count($youtube);
            for($i=0; $i<$count; $i++){
                $html = $this->replacment(
                    '</p>'.PHP_EOL,
                    '</p><iframe width="560" height="315" src="'.$youtube[$i].'" frameborder="0" allowfullscreen></iframe>'.PHP_EOL,
                    $html,
                    rand(1,substr_count($html, '</p>'.PHP_EOL)));
            }
        }
        return $html;
    }


    private function replacment($search, $replace, $text, $c)
    {
        if($c > substr_count($text, $search)){
            return $text;
        }
        else{
            $arr = explode($search, $text);
            $result = '';
            $k = 1;
            foreach($arr as $value){
                $k == $c ? $result .= $value.$replace : $result .= $value.$search;
                $k++;
            }
            $pos = strripos($result,$search);
            $result = substr_replace($result,'', $pos, $pos + 3);
            return $result;
        };
    }
}
<?php

require __DIR__.'/app/bootstrap.php';

use \app\Model\Paragraph;
use \app\Model\Line;
use \app\Model\Header;
use \app\Model\Image;
use \app\Model\ListItem;
use \app\Model\Youtube;

/**
 * get article builder
 */
$articleBuilder = \app\Helper\Registry::getServiceOrParam('article_builder');

/**
 * get needed quantity of articles to generate
 */
$quantity = \app\Helper\Registry::getServiceOrParam('quantity');


/**
 * make structure of article
 */
$articleBuilder->addParagraph(Paragraph::getParagraph())
                ->addLine(Line::getLine())
                ->addHeader(Header::getHeader())
                ->addImage(Image::getImage())
                ->addListItem(ListItem::getList())
                ->addYoutubeVideo(Youtube::getYoutube());

/**
 * article generating
 */
for ($i=0; $i<$quantity; $i++){
    $articleBuilder->createArticle()->saveArticle();
}
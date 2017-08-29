<?php

use app\Helper\Registry;

require __DIR__.'/../autoloader.php';

$params = require __DIR__.'/Config/config.php';

Registry::setServiceOrParam('files', $params['files']);
Registry::setServiceOrParam('path_to_save', $params['path_to_save']);
Registry::setServiceOrParam('youtube_urls', $params['youtube_urls_range']);
Registry::setServiceOrParam('images', $params['images_range']);
Registry::setServiceOrParam('paragraph_lines', $params['paragraph_lines_range']);
Registry::setServiceOrParam('paragraphs', $params['paragraphs_range']);
Registry::setServiceOrParam('lists', $params['lists_range']);
Registry::setServiceOrParam('headers', $params['headers_range']);
Registry::setServiceOrParam('list_items', $params['items_list_range']);

Registry::setServiceOrParam('quantity', 5);

Registry::setServiceOrParam('article_builder', new \app\Builder\ArticleBuilder());

Registry::forReadOnly();
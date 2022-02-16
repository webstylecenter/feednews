<?php

namespace App\Services;

use App\Models\Meta;
use DOMDocument;

class MetaService
{
    private Meta $meta;

    public function __construct(Meta $meta)
    {
        $this->meta = $meta;
    }

    public function getMetaByUrl(string $url): Meta
    {
        $url = strpos($url, 'http') === 0 ? $url : 'http://' . $url;
        $doc = $this->loadContent($url);
        $this->meta->url = $url;
        $this->meta->title = $this->findTitle($doc) ?: $url;
        $this->meta->description = $this->findMetaDescription($doc);

        return $this->meta;
    }

    protected function loadContent(string $url): DOMDocument
    {
        $options = [
            'http' => [
                'method' => 'GET',
                'header' => 'User-Agent: facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)' . PHP_EOL
            ]
        ];

        $html = @file_get_contents($url, false, stream_context_create($options));


        $libxml_previous_state = libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        $dom->loadHTML((string) $html);
        libxml_clear_errors();
        libxml_use_internal_errors($libxml_previous_state);

        return $dom;
    }

    protected function findTitle(DOMDocument $doc): ?string
    {
        $titleNode = $doc->getElementsByTagName('title');
        return $titleNode->item(0) ? trim($titleNode->item(0)->nodeValue) : null;
    }

    protected function findMetaDescription(DOMDocument $doc): string
    {
        $descriptionMap = [
            'description' => null,
            'og-description' => null,
            'og:description' => null
        ];

        $metas = $doc->getElementsByTagName('meta');
        for ($i = 0; $i < $metas->length; $i++) {
            $meta = $metas->item($i);
            $descriptionMap['description'] = $this->getMetaContent($descriptionMap, $meta, 'name', 'description');
            $descriptionMap['og-description'] = $this->getMetaContent($descriptionMap, $meta, 'property', 'og-description');
            $descriptionMap['og:description'] = $this->getMetaContent($descriptionMap, $meta, 'property', 'og:description');
        }

        return trim($descriptionMap['og-description'] ?: $descriptionMap['description'] ?: $descriptionMap['og:description']);
    }

    protected function getMetaContent(array $currentMeta, \DOMNode $meta, string $attribute, string $name): string
    {
        if (!empty($currentMeta[$name])) {
            return $currentMeta[$name];
        }

        if ($meta->getAttribute($attribute) === $name) {
            $currentMeta[$name] = $meta->getAttribute('content');
        }

        return str_replace('null', '', $currentMeta[$name]);
    }
}

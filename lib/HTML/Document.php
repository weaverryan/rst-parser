<?php

declare(strict_types=1);

namespace Doctrine\RST\HTML;

use Doctrine\RST\Document as Base;
use Doctrine\RST\Nodes\RawNode;
use Exception;
use function htmlspecialchars;
use function sprintf;

class Document extends Base
{
    public function render() : string
    {
        $document = '';
        foreach ($this->nodes as $node) {
            $document .= $node->render() . "\n";
        }

        return $document;
    }

    public function renderDocument() : string
    {
        $document  = "<!DOCTYPE html>\n";
        $document .= "<html>\n";

        $document .= "<head>\n";
        $document .= "<meta charset=\"utf-8\" />\n";

        foreach ($this->headerNodes as $node) {
            $document .= $node->render() . "\n";
        }

        $document .= "</head>\n";

        $document .= "<body>\n";
        $document .= $this->render();
        $document .= "</body>\n";

        $document .= "</html>\n";

        return $document;
    }

    public function addCss(string $css) : void
    {
        $environment = $this->getEnvironment();

        $css = $environment->relativeUrl($css);

        if ($css === null) {
            throw new Exception(sprintf('Could not get relative url for css %s', $css));
        }

        $this->addHeaderNode(new RawNode('<link rel="stylesheet" type="text/css" href="' . htmlspecialchars($css) . '" />'));
    }

    public function addJs(string $js) : void
    {
        $environment = $this->getEnvironment();

        $js = $environment->relativeUrl($js);

        if ($js === null) {
            throw new Exception(sprintf('Could not get relative url for js %s', $js));
        }

        $this->addHeaderNode(new RawNode('<script type="text/javascript" src="' . htmlspecialchars($js) . '"></script>'));
    }

    public function addFavicon(string $url = '/favicon.ico') : void
    {
        $environment = $this->getEnvironment();

        $url = $environment->relativeUrl($url);

        if ($url === null) {
            throw new Exception(sprintf('Could not get relative url for favicon %s', $url));
        }

        $this->addHeaderNode(new RawNode('<link rel="icon" type="image/x-icon" href="' . htmlspecialchars($url) . '" />'));
    }
}

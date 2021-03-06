<?php

declare(strict_types=1);

namespace Doctrine\RST\HTML\Nodes;

use Doctrine\RST\Nodes\MetaNode as Base;
use function htmlspecialchars;

class MetaNode extends Base
{
    public function render() : string
    {
        return '<meta name="' . htmlspecialchars($this->key) . '" content="' . htmlspecialchars($this->value) . '" />';
    }
}

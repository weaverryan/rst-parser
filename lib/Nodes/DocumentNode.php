<?php

declare(strict_types=1);

namespace Doctrine\RST\Nodes;

use Doctrine\RST\Nodes\Node as Base;

class DocumentNode extends Base
{
    public function render() : string
    {
        return '';
    }
}

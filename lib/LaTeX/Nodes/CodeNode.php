<?php

declare(strict_types=1);

namespace Doctrine\RST\LaTeX\Nodes;

use Doctrine\RST\Nodes\CodeNode as Base;

class CodeNode extends Base
{
    public function render() : string
    {
        $tex  = '\\lstset{language=' . $this->language . "}\n";
        $tex .= "\\begin{lstlisting}\n";
        $tex .= $this->value . "\n";
        $tex .= "\\end{lstlisting}\n";

        return $tex;
    }
}

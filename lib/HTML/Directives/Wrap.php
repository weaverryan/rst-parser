<?php

declare(strict_types=1);

namespace Doctrine\RST\HTML\Directives;

use Doctrine\RST\Nodes\Node;
use Doctrine\RST\Nodes\WrapperNode;
use Doctrine\RST\Parser;
use Doctrine\RST\SubDirective;
use function uniqid;

/**
 * Wraps a sub document in a div with a given class
 */
class Wrap extends SubDirective
{
    /** @var string */
    protected $class;

    /** @var bool */
    protected $uniqid;

    public function __construct(string $class, bool $uniqid = false)
    {
        $this->class  = $class;
        $this->uniqid = $uniqid;
    }

    public function getName() : string
    {
        return $this->class;
    }

    /**
     * @param string[] $options
     */
    public function processSub(
        Parser $parser,
        ?Node $document,
        string $variable,
        string $data,
        array $options
    ) : ?Node {
        $class = $this->class;

        if ($this->uniqid) {
            $id = ' id="' . uniqid($this->class) . '"';
        } else {
            $id = '';
        }

        return new WrapperNode($document, '<div class="' . $class . '"' . $id . '>', '</div>');
    }
}

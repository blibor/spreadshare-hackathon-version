<?php

namespace DS\Controller\Api\v2\Curators;

use DS\Controller\Api\ActionHandler;
use DS\Controller\Api\MethodInterface;

class Post extends ActionHandler implements MethodInterface
{
    use CuratorModifier;

    /**
     * @return bool
     */
    public function needsLogin()
    {
        return true;
    }

    /**
     * @return \DS\Controller\Api\Meta\Record
     */
    public function process()
    {
        return $this->setCurator(true);
    }
}

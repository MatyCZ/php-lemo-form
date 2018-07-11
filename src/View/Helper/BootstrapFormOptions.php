<?php

namespace Lemo\Form\View\Helper;

use Lemo\Form\BootstrapFormOptions as Options;

class BootstrapFormOptions extends AbstractHelper
{
    /**
     * @var Options
     */
    protected $bootstrapFormOptions;

    /**
     * Konstruktor
     *
     * @param Options $bootstrapFormOptions
     */
    public function __construct(
        Options $bootstrapFormOptions
    ) {
        $this->bootstrapFormOptions = $bootstrapFormOptions;
    }

    /**
     * @return Options
     */
    public function __invoke()
    {
        return $this->bootstrapFormOptions;
    }
}

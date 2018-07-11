<?php

namespace Lemo\Form;

use Zend\Stdlib\AbstractOptions;

class BootstrapFormOptions extends AbstractOptions
{
    /**
     * @var string
     */
    protected $labelAlign = BootstrapFormConstant::LABEL_ALIGN_RIGHT;

    /**
     * @var string
     */
    protected $layout = BootstrapFormConstant::LAYOUT_HORIZONTAL;

    /**
     * @var bool
     */
    protected $renderErrors = true;

    /**
     * @var string
     */
    protected $sizeClassLabel = 'col-lg-6';

    /**
     * @var string
     */
    protected $sizeClassElement = 'col-lg-6';

    /**
     * @return string
     */
    public function getLabelAlign() : string
    {
        return $this->labelAlign;
    }

    /**
     * @param  string $labelAlign
     * @return self
     */
    public function setLabelAlign(string $labelAlign) : self
    {
        $this->labelAlign = $labelAlign;
        return $this;
    }

    /**
     * @return string
     */
    public function getLayout() : string
    {
        return $this->layout;
    }

    /**
     * @param  string $layout
     * @return self
     */
    public function setLayout(string $layout) : self
    {
        $this->layout = $layout;

        return $this;
    }

    /**
     * @return bool
     */
    public function getRenderErrors() : bool
    {
        return $this->renderErrors;
    }

    /**
     * @param  bool $renderErrors
     * @return self
     */
    public function setRenderErrors(bool $renderErrors) : self
    {
        $this->renderErrors = $renderErrors;

        return $this;
    }

    /**
     * @return string
     */
    public function getSizeClassLabel(): string
    {
        return $this->sizeClassLabel;
    }

    /**
     * @param  string $sizeClassLabel
     * @return self
     */
    public function setSizeClassLabel(string $sizeClassLabel) : self
    {
        $this->sizeClassLabel = $sizeClassLabel;
        return $this;
    }

    /**
     * @return string
     */
    public function getSizeClassElement(): string
    {
        return $this->sizeClassElement;
    }

    /**
     * @param  string $sizeClassElement
     * @return self
     */
    public function setSizeClassElement(string $sizeClassElement) : self
    {
        $this->sizeClassElement = $sizeClassElement;
        return $this;
    }

}

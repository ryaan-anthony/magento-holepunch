<?php

class Ryaan_Holepunch_Model_Container extends Enterprise_PageCache_Model_Container_Abstract
{
    /**
     * Override this method and return false to prevent block from being cached
     * @param string
     * @return bool
     */
    public function applyWithoutApp(&$content)
    {
        return false;
    }

    public function applyInApp(&$content)
    {
        $blockClass = $this->_placeholder->getAttribute('block');
        $template = $this->_placeholder->getAttribute('template');
        $blockContent = $this->getBlockContent(new $blockClass, $template);

        $this->_applyToContent($content, $blockContent);

        return true;
    }

    /**
     * @param Mage_Core_Block_Template
     * @param string
     * @return string
     */
    protected function getBlockContent(Mage_Core_Block_Template $block, $template)
    {
        $block->setLayout(Mage::app()->getLayout());
        return $block->setTemplate($template)->toHtml();
    }
}

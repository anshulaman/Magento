<?php
/**
 * @package Custom_UpdateStatus
 */
namespace Custom\UpdateStatus\Controller\Adminhtml\Order;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
    * @var Magento\Framework\View\Result\PageFactory
    */
    protected $_pageFactory;
   
    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $pageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {   
        // load Page
        return $this->_pageFactory->create();
    }
}
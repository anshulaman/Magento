<?php
/**
 * @package Custom_UpdateStatus
 */
namespace Custom\UpdateStatus\Block\Tab;

use Magento\Sales\Model\ResourceModel\Order\Status\CollectionFactory;


class UpdateStatus extends \Magento\Backend\Block\Template implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * Template
     *
     * @var string
     */
    protected $_template = 'order/view/tab/updatestatus.phtml';
    
     /**
     * @var CollectionFactory $statusCollectionFactory
     */
    protected $orderStatusCollectionFactory;

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry = null;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param CollectionFactory $orderStatusCollectionFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        CollectionFactory $orderStatusCollectionFactory,
        array $data = []
    ) {
        $this->coreRegistry = $registry;
        $this->orderStatusCollectionFactory = $orderStatusCollectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * Retrieve order model instance
     *
     * @return \Magento\Sales\Model\Order
     */
    public function getOrder()
    {
        return $this->coreRegistry->registry('current_order');
    }

    public function getOrderId()
    {
        return $this->getOrder()->getEntityId();
    }

    public function getOrderIncrementId()
    {
        return $this->getOrder()->getIncrementId();
    }

    /**
     * {@inheritdoc}
     */
    public function getTabLabel()
    {
        return __('Update Status');
    }

    /**
     * {@inheritdoc}
     */
    public function getTabTitle()
    {
        return __('Update Status');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        // For me, I wanted this tab to always show
        // You can play around with the ACL settings 
        // to selectively show later if you want
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        // For me, I wanted this tab to always show
        // You can play around with conditions to
        // show the tab later
        return false;
    }

    /**
     * Get Tab Class
     *
     * @return string
     */
    public function getTabClass()
    {
        // I wanted mine to load via AJAX when it's selected
        // That's what this does
        return 'ajax only';
    }

    /**
     * Get Class
     *
     * @return string
     */
    public function getClass()
    {
        return $this->getTabClass();
    }

    /**
     * Get Tab Url
     *
     * @return string
     */
    public function getTabUrl()
    {
        // customtab is a adminhtml router we're about to define
        // the full route can really be whatever you want
        return $this->getUrl('updatestatus/*/payload', ['_current' => true]);
    }


    /**
     * Get Updated Status
     *
     * @return array
     */
    public function getUpdatedStatus()
    {
        $options = $this->orderStatusCollectionFactory->create()->toOptionArray();
        return $options;
    }
}
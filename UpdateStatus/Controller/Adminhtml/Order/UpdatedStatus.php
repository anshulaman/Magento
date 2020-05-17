<?php
/**
 * @package Custom_UpdateStatus
 */
namespace Custom\UpdateStatus\Controller\Adminhtml\Order;

use Magento\Backend\App\Action;
use Magento\Sales\Api\OrderManagementInterface;
use Magento\Sales\Api\Data\OrderInterface;
use Psr\Log\LoggerInterface;

class UpdatedStatus extends \Magento\Backend\App\Action
{  
    /**
     * Pending Order Status
     */
    const Pending = 'pending';
    
    /**
     * Processing Order Status
     */
    const Processing = 'processing';
    
    /**
     * SuspectedFraud Order Status
     */
    const SuspectedFraud = 'fraud';
    
    /**
     * PendingPayment Order Status
     */
    const PendingPayment = 'pending_payment';

    /**
     * PaymentReview Order Status
     */
    const PaymentReview = 'payment_review';
    
    /**
     * OnHold Order Status
     */
    const OnHold = 'holded';

    /**
     * Open Order Status
     */
    const Open = 'STATE_OPEN';
    
    /**
     * Complete Order Status
     */
    const Complete = 'complete';
    
    /**
     * Closed Order Status
     */
    const Closed = 'closed';
    
    /**
     * Canceled Order Status
     */
    const Canceled = 'canceled';
    
    /**
     * PayPalCanceledReversal Order Status
     */
    const PayPalCanceledReversal = 'paypay_canceled_reversal';
    
    /**
     * PendingPayPal Order Status
     */
    const PendingPayPal = 'pending_paypal';
    
    /**
     * PayPalReversed Order Status
     */
    const PayPalReversed = 'paypal_reversed';

    /**
     * @var \Magento\Framework\View\LayoutFactory
     */
    protected $layoutFactory;
    
    /**
     * @var \Magento\Sales\Api\Data\OrderInterface
     */
    protected $orderInterface;
    /**
     * @param Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\LayoutFactory $layoutFactory
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
     */
    public function __construct(
        OrderInterface $OrderInterface,
        Action\Context $context,
        \Magento\Sales\Model\Order $orderItem
    ) {
        $this->orderInterface = $OrderInterface;
        $this->orderItem = $orderItem;
        parent::__construct($context);
    }

    /**
     * Generate order history for ajax request
     *
     * @return \Magento\Framework\Controller\Result\Raw
     */
    public function execute()
    {
        
        $data = $this->getRequest()->getPostValue();
        if(isset($data['status'])&& isset($data['incrementid']) && is_numeric($data['incrementid']) &&
        $data['status']!="Please select a status" && $data['incrementid']!="Please select a increment id" && isset($data['order_id']))
        {
            $order = $this->orderItem->load($data['order_id']);

            if ($order->getAllitems()) {
                foreach ($order->getAllitems() as $item) {
                    # set quantity canceled null
                    $item->setQtyCanceled(null);
                }
            }
               
            $orderState = $data['status'];
            
            //update pending status
            if($orderState=="Pending")
            {
                 $order->setState($orderState)->setStatus(UpdatedStatus::Pending);
                 $order->save();
            }
            
            //update processing status
            if($orderState=="Processing")
            {
                 $order->setState($orderState)->setStatus(UpdatedStatus::Processing);
                 $order->save();
            }
            
            //update suspected fraud status
            if($orderState=="Suspected Fraud")
            {
                 $order->setState($orderState)->setStatus(UpdatedStatus::SuspectedFraud);
                 $order->save();
            }
            
            //update payment review status
            if($orderState=="Payment Review")
            {
                 $order->setState($orderState)->setStatus(UpdatedStatus::PaymentReview);
                 $order->save();
            }

            //update on hold status
            if($orderState=="On Hold")
            {
                 $order->setState($orderState)->setStatus(UpdatedStatus::OnHold);
                 $order->save();
            }

            //update open status
            if($orderState=="Open")
            {
                 $order->setState($orderState)->setStatus(UpdatedStatus::Open);
                 $order->save();
            }

            //update complete status
            if($orderState=="Complete")
            {
                 $order->setState($orderState)->setStatus(UpdatedStatus::Complete);
                 $order->save();
            }

            //update closed status
            if($orderState=="Closed")
            {
                 $order->setState($orderState)->setStatus(UpdatedStatus::Closed);
                 $order->save();
            }
            
            //update paypal canceled Reversal status
            if($orderState=="PayPal Canceled Reversal")
            {
                 $order->setState($orderState)->setStatus(UpdatedStatus::PayPalCanceledReversal);
                 $order->save();
            }
            
            //update pending PayPal status
            if($orderState=="Pending PayPal")
            {
                 $order->setState($orderState)->setStatus(UpdatedStatus::PendingPayPal);
                 $order->save();
            }
            
            //update Paypal Reverserd status
            if($orderState=="PayPal Reversed")
            {
                 $order->setState($orderState)->setStatus(UpdatedStatus::PayPalReversed);
                 $order->save();
            }
            
            //update pending payment status
            if($orderState=="Pending Payment")
            {
                 $order->setState($orderState)->setStatus(UpdatedStatus::PendingPayment);
                 $order->save();
            }
            
            //update canceled status
            if($orderState=="Canceled")
            {
                 $order->setState($orderState)->setStatus(UpdatedStatus::Canceled);
                 $order->save();
            }

            //show updated increment id 
            echo ('<p>You have changed the order status of IncrementId : <b>'.$data['incrementid'].'</b></p>');
        }
        else{
          //if not found any status and increment id
          echo ('<p>Please enter Both the status and increment id </p>');
        }
    }
}
<?php

namespace Paytrail\PaymentService\Gateway\Config;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Payment\Gateway\ConfigInterface;
use Magento\Framework\Encryption\EncryptorInterface;
use Magento\Store\Model\ScopeInterface;

class Config extends \Magento\Payment\Gateway\Config\Config
{
    const DEFAULT_PATH_PATTERN = 'payment/%s/%s';
    const KEY_TITLE = 'title';
    const CODE = 'paytrail';
    const CC_VAULT_CODE = 'paytrail_cc_vault';
    const SAVE_CARD_URL = 'tokenization/savecard';
    const KEY_CHECKOUT_ALGORITHM = 'checkout_algorithm';
    const KEY_MERCHANT_SECRET = 'merchant_secret';
    const KEY_MERCHANT_ID = 'merchant_id';
    const KEY_ACTIVE = 'active';
    const KEY_SKIP_BANK_SELECTION = 'skip_bank_selection';
    const BYPASS_PATH = 'Paytrail_PaymentService/payment/checkout-bypass';
    const CHECKOUT_PATH = 'Paytrail_PaymentService/payment/checkout';
    const KEY_GENERATE_REFERENCE = 'generate_reference';
    const KEY_RECOMMENDED_TAX_ALGORITHM = 'recommended_tax_algorithm';
    const KEY_PAYMENTGROUP_BG_COLOR = 'paytrail_personalization/payment_group_bg';
    const KEY_PAYMENTGROUP_HIGHLIGHT_BG_COLOR = 'paytrail_personalization/payment_group_highlight_bg';
    const KEY_PAYMENTGROUP_TEXT_COLOR = 'paytrail_personalization/payment_group_text';
    const KEY_PAYMENTGROUP_HIGHLIGHT_TEXT_COLOR = 'paytrail_personalization/payment_group_highlight_text';
    const KEY_PAYMENTGROUP_HOVER_COLOR = 'paytrail_personalization/payment_group_hover';
    const KEY_PAYMENTMETHOD_HIGHLIGHT_COLOR = 'paytrail_personalization/payment_method_highlight';
    const KEY_PAYMENTMETHOD_HIGHLIGHT_HOVER = 'paytrail_personalization/payment_method_hover';
    const KEY_PAYMENTMETHOD_ADDITIONAL = 'paytrail_personalization/advanced_paytrail_personalization/additional_css';
    const KEY_RESPONSE_LOG = 'response_log';
    const KEY_REQUEST_LOG = 'request_log';
    const KEY_DEFAULT_ORDER_STATUS = 'order_status';
    const KEY_NOTIFICATION_EMAIL = 'recipient_email';
    const KEY_CANCEL_ORDER_ON_FAILED_PAYMENT = 'failed_payment_cancel';

    /**
     * @var EncryptorInterface
     */
    private $encryptor;

    /**
     * Config constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     * @param EncryptorInterface $encryptor
     * @param string $methodCode
     * @param string $pathPattern
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        EncryptorInterface $encryptor,
        $methodCode = self::CODE,
        $pathPattern = self::DEFAULT_PATH_PATTERN
    ) {
        $this->encryptor = $encryptor;
        parent::__construct($scopeConfig, $methodCode, $pathPattern);
    }

    /**
     * Gets Merchant Id.
     *
     * @param int|null $storeId
     * @return bool
     */
    public function getMerchantId($storeId = null)
    {
        return $this->getValue(self::KEY_MERCHANT_ID, $storeId);
    }

    /**
     * Gets Merchant secret.
     *
     * @param int|null $storeId
     * @return bool
     */
    public function getMerchantSecret($storeId = null)
    {
        $merchantSecret = $this->getValue(self::KEY_MERCHANT_SECRET, $storeId);
        return $this->encryptor->decrypt($merchantSecret);
    }

    /**
     * Gets Payment configuration status.
     *
     * @param int|null $storeId
     * @return bool
     */
    public function isActive($storeId = null)
    {
        return (bool) $this->getValue(self::KEY_ACTIVE, $storeId);
    }

    /**
     * Get payment method title
     *
     * @param int|null $storeId
     * @return mixed
     */
    public function getTitle($storeId = null)
    {
        return $this->getValue(self::KEY_TITLE, $storeId);
    }

    /**
     * @param null $storeId
     * @return bool
     */
    public function getSkipBankSelection($storeId = null)
    {
        return $this->getValue(self::KEY_SKIP_BANK_SELECTION, $storeId);
    }

    /**
     * @param int|null $storeId
     * @return mixed
     */
    public function getPaymentGroupBgColor($storeId = null)
    {
        return $this->getValue(self::KEY_PAYMENTGROUP_BG_COLOR, $storeId);
    }

    /**
     * @param int|null $storeId
     * @return mixed
     */
    public function getPaymentGroupHighlightBgColor($storeId = null)
    {
        return $this->getValue(self::KEY_PAYMENTGROUP_HIGHLIGHT_BG_COLOR, $storeId);
    }

    /**
     * @param int|null $storeId
     * @return mixed
     */
    public function getPaymentGroupTextColor($storeId = null)
    {
        return $this->getValue(self::KEY_PAYMENTGROUP_TEXT_COLOR, $storeId);
    }

    /**
     * @param int|null $storeId
     * @return mixed
     */
    public function getPaymentGroupHighlightTextColor($storeId = null)
    {
        return $this->getValue(self::KEY_PAYMENTGROUP_HIGHLIGHT_TEXT_COLOR, $storeId);
    }

    /**
     * @param int|null $storeId
     * @return mixed
     */
    public function getPaymentGroupHoverColor($storeId = null)
    {
        return $this->getValue(self::KEY_PAYMENTGROUP_HOVER_COLOR, $storeId);
    }

    /**
     * @param int|null $storeId
     * @return mixed
     */
    public function getPaymentMethodHighlightColor($storeId = null)
    {
        return $this->getValue(self::KEY_PAYMENTMETHOD_HIGHLIGHT_COLOR, $storeId);
    }

    /**
     * @param int|null $storeId
     * @return mixed
     */
    public function getPaymentMethodHoverHighlight($storeId = null)
    {
        return $this->getValue(self::KEY_PAYMENTMETHOD_HIGHLIGHT_HOVER, $storeId);
    }

    /**
     * @param int|null $storeId
     * @return mixed
     */
    public function getAdditionalCss($storeId = null)
    {
        return $this->getValue(self::KEY_PAYMENTMETHOD_ADDITIONAL, $storeId);
    }

    /**
     * @param int|null $storeId
     * @return bool
     */
    public function getGenerateReferenceForOrder($storeId = null)
    {
        return $this->getValue(self::KEY_GENERATE_REFERENCE, $storeId);
    }

    /**
     * @param int|null $storeId
     * @return bool
     */
    public function getUseRecommendedTaxAlgorithm($storeId = null)
    {
        return $this->getValue(self::KEY_RECOMMENDED_TAX_ALGORITHM, $storeId);
    }

    /**
     * @return null|string
     */
    public function getInstructions()
    {
        if ($this->getSkipBankSelection()) {
            return __("You will be redirected to Paytrail payment service.");
        }
        return null;
    }

    /**
     * @param int|null $storeId
     * @return string
     */
    public function getPaymentTemplate($storeId = null)
    {
        if ($this->getSkipBankSelection($storeId)) {
            return self::CHECKOUT_PATH;
        }
        return self::BYPASS_PATH;
    }

    /**
     * @return mixed
     */
    public function getResponseLog($storeId = null)
    {
        return $this->getValue(self::KEY_RESPONSE_LOG, $storeId);
    }

    /**
     * @return mixed
     */
    public function getRequestLog($storeId = null)
    {
        return $this->getValue(self::KEY_REQUEST_LOG, $storeId);
    }

    /**
     * @return mixed
     */
    public function getDefaultOrderStatus($storeId = null)
    {
        return $this->getValue(self::KEY_DEFAULT_ORDER_STATUS, $storeId);
    }

    /**
     * @return mixed
     */
    public function getNotificationEmail($storeId = null)
    {
        return $this->getValue(self::KEY_NOTIFICATION_EMAIL, $storeId);
    }

    /**
     * @return string
     */
    public function getCcVaultCode()
    {
        return self::CC_VAULT_CODE;
    }

    /**
     * @param null $storeId
     * @return mixed|null
     */
    public function getCheckoutAlgorithm($storeId = null)
    {
        return $this->getValue(self::KEY_CHECKOUT_ALGORITHM, $storeId);
    }

    /**
     * @return string
     */
    public function getSaveCardUrl()
    {
        return self::SAVE_CARD_URL;
    }

    /**
     * @param int|null $storeId
     * @return int
     */
    public function getCancelOrderOnFailedPayment($storeId = null)
    {
        return $this->getValue(self::KEY_CANCEL_ORDER_ON_FAILED_PAYMENT, $storeId);
    }
}

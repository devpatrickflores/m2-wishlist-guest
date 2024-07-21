<?php
namespace PF\WishlistGuest\Block\Customer\Wishlist;

use PF\WishlistGuest\Controller\Product\Shared;
use PF\WishlistGuest\Helper\Data;
use Magento\Framework\View\Element\Template\Context;
use Magento\Wishlist\Block\Customer\Wishlist\Button as WishlistButton;
use Magento\Wishlist\Helper\Data as WishlistHelper;
use Magento\Wishlist\Model\Config;

/**
 * Customer Wishlist Button block.
 */
class Button extends WishlistButton
{
    /**
     * @var Data
     */
    protected $helper;

    /**
     * Block constructor.
     *
     * @param Context $context
     * @param WishlistHelper $wishlistData
     * @param Config $wishlistConfig
     * @param Data $helper
     * @param array $data
     */
    public function __construct(
        Context $context,
        WishlistHelper $wishlistData,
        Config $wishlistConfig,
        Data $helper,
        array $data = []
    ) {
        parent::__construct($context, $wishlistData, $wishlistConfig, $data);

        $this->helper = $helper;
    }

    /**
     * Get shared URL.
     *
     * @return string
     */
    public function getSharedUrl(): string
    {
        if (!$this->helper->isShareUrlEnabled() || !$this->getWishlist()->getItemsCount()) {
            return '';
        }

        return $this->getUrl(Shared::URL_ROUTE, [
            Shared::CODE_PARAM_KEY => $this->getWishlist()->getSharingCode(),
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function _toHtml()
    {
        if (!$this->helper->isModuleEnabled()) {
            return '';
        }

        return parent::_toHtml();
    }
}

<?php

namespace Darvishani\FaqGraphQl\Model;

use GraphQL\Type\Definition\ResolveInfo;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;
use Mageprince\Faq\Model\ResourceModel\FaqGroup\Collection ;

class FaqGroupResolver  implements ResolverInterface
{
    private $_collection;

    private $storeManager;

    public function __construct(
        Collection            $collection,
        StoreManagerInterface $storeManager
    ) {
        $this->_collection=$collection;
        $this->storeManager=$storeManager;

    }
    /**
    * @param \Magento\Framework\GraphQl\Config\Element\Field $field
    * @param ContextInterface $context
    * @param ResolveInfo $info
    * @param array|null $value
    * @param array|null $args
    * @throws \Exception
    * @return mixed|Value
    */
    public function resolve(
        Field $field,
              $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        $result=[];
        $faqGroupCollection=$this->_collection;
        $faqGroupCollection->addFieldToFilter('status', 1);
        if(isset($args['currentPage'])){
            $faqGroupCollection->setCurPage($args['currentPage']);
        }
        if(isset($args['pageSize'])){
            $faqGroupCollection->setPageSize($args['pageSize']);
        }
        foreach ($faqGroupCollection as $item){
            $icon=strlen($item->getIcon())>1?$this->getMediaUrl().$item->getIcon():null;
            $item->setData('icon',$icon);
            $result[]=$item->getData();
        }
        return $result;
    }
    /**
     * Get media url
     *
     * @return string
     * @throws NoSuchEntityException
     */
    public function getMediaUrl()
    {
        $mediaUrl = $this->storeManager->getStore()
                ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) . 'faq/tmp/icon/';
        return $mediaUrl;
    }
}
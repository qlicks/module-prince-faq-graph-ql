<?php
namespace Darvishani\FaqGraphQl\Model;

use GraphQL\Type\Definition\ResolveInfo;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Mageprince\Faq\Model\ResourceModel\Faq\Collection ;
use Darvishani\FaqGraphQl\Model\Filter;
use Darvishani\FaqGraphQl\Model\Sort;
use Magento\Cms\Model\Template\FilterProvider;

class FaqResolver  implements \Magento\Framework\GraphQl\Query\ResolverInterface
{
    private $_collection;

    private $_filter;

    private $_sort;

    /**
     * @var FilterProvider
     */
    private $filterProvider;

    public function __construct(
        Collection $collection,
        Filter $filter,
        Sort $sort,
        FilterProvider $filterProvider
    ) {
        $this->_collection=$collection;
        $this->_filter=$filter;
        $this->_sort=$sort;
        $this->filterProvider = $filterProvider;
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
    ){
        $result=[];
        $faqCollection=$this->_collection;
        $faqCollection->addFieldToFilter('status', 1);

        if(isset($args['currentPage'])){
            $faqCollection->setCurPage($args['currentPage']);
        }
        if(isset($args['pageSize'])){
            $faqCollection->setPageSize($args['pageSize']);
        }
        if(isset($args['filter'])){
            $faqCollection=$this->_filter->applyFilter($faqCollection,$args['filter']);
        }

        if(isset($args['sort'])){
            $faqCollection=$this->_sort->applySort($faqCollection,$args['sort']);
        }

        foreach ($faqCollection as $item){
           $data = $item->getData();
           $data['content'] = $this->filterProvider->getPageFilter()->filter($data['content']);
           $result[] = $data;
        }

        return $result;
    }
}
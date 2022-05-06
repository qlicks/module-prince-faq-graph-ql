
## Faq Graph QL  (magento 2 module)

# **About This Project** :
 
This module will add Graph Ql to`prince faq`

# Installation
 

`composer require darvishani/module-faq-graph-ql:"dev-master"`


# Request (sample)
<pre>
query
{
Faqs(pageSize:1,
    currentPage:2 ,
    filter:{faq_id:{in:["1","2"]},
    status:{eq:"1"}},
    sort: { faq_id: DESC }){
        faq_id
        title
        content
        group
        storeview
        customer_group
        sortorder
        status
        created_at
        updated_at
    }
    FaqGroups{
    faqgroup_id
    groupname
    icon
    storeview
    customer_group
    sortorder
    created_at
    updated_at
    }
}
</pre>

# Response (sample)
<pre>
{
    "data": {
        "Faqs": [
            {
                "faq_id": 1,
                "title": "This is a test FAQ question",
                "content": "This is a test FAQ answer",
                "group": "1",
                "storeview": "1",
                "customer_group": "0,1,2,3,4",
                "sortorder": 0,
                "status": 1,
                "created_at": "2022-05-06 04:06:03",
                "updated_at": "2022-05-06 04:06:03"
            }
        ],
        "FaqGroups": [
            {
                "faqgroup_id": 1,
                "groupname": "General",
                "icon": null,
                "storeview": "1",
                "customer_group": "0,1,2,3,4",
                "sortorder": 1,
                "created_at": "2022-05-06 04:06:03",
                "updated_at": "2022-05-06 04:06:03"
            },
            {
                "faqgroup_id": 2,
                "groupname": "Base knowledge",
                "icon": "http://127.0.0.1:11200/media/faq/tmp/icon/Screenshot_from_2022-03-25_09-00-42.png",
                "storeview": "0,1,2,3,4",
                "customer_group": "0,1,2,3,4",
                "sortorder": 2,
                "created_at": "2022-05-06 04:11:09",
                "updated_at": "2022-05-06 04:11:09"
            }
        ]
    }
}
</pre>
# Contact

[gh-darvishani.com](https://gh-darvishani.com/) 
|| [gh.darvishani@live.com](mailto:gh.darvishani@live.com)

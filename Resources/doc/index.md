Getting Started With GrossumNewsBundle
==================================

### Create your News class

##### yaml

If you use yml to configure Doctrine you must add two files. The Entity and the orm.yml:

```php
<?php
// src/Application/Grossum/NewsBundle/Entity/News.php

namespace Application\Grossum\NewsBundle\Entity;

use Grossum\NewsBundle\Entity\News as BaseNews;

/**
 * News
 */
class News extends BaseNews
{
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}
```
```yaml
# src/Application/Grossum/NewsBundle/Resources/config/doctrine/News.orm.yml
Application\Grossum\NewsBundle\News:
    type:  entity
    table: contact
    id:
        id:
            type: integer
            generator:
                strategy: AUTO
```



### Create your Tag class

##### yaml

If you use yml to configure Doctrine you must add two files. The Entity and the orm.yml:

```php
<?php
// src/Application/Grossum/NewsBundle/Entity/Tag.php

namespace Application\Grossum\NewsBundle\Entity;

use Grossum\NewsBundle\Entity\Tag as BaseTag;

/**
 * Tag
 */
class Tag extends BaseTag
{
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}
```
```yaml
# src/Application/Grossum/NewsBundle/Resources/config/doctrine/Tag.orm.yml
Application\Grossum\NewsBundle\Tag:
    type:  entity
    table: contact
    id:
        id:
            type: integer
            generator:
                strategy: AUTO
```
<?php
$arUrlRewrite=array (
  4 => 
  array (
    'CONDITION' => '#^/bitrix/services/ymarket/([\\w\\d\\-]+)?(/)?(([\\w\\d\\-]+)(/)?)?#',
    'RULE' => 'REQUEST_OBJECT=$1&METHOD=$4',
    'ID' => '',
    'PATH' => '/bitrix/services/ymarket/index.php',
    'SORT' => 100,
  ),
  32 => 
  array (
    'CONDITION' => '#^/online/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)#',
    'RULE' => 'alias=$1',
    'ID' => NULL,
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  43 => 
  array (
    'CONDITION' => '#^/personal/history-of-orders/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.order',
    'PATH' => '/personal/history-of-orders/index.php',
    'SORT' => 100,
  ),
  0 => 
  array (
    'CONDITION' => '#^/s1/bitrix/services/ymarket/#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/s1/bitrix/services/ymarket/index.php',
    'SORT' => 100,
  ),
  46 => 
  array (
    'CONDITION' => '#^/acrit.exportproplus/(.*)#',
    'RULE' => 'path=$1',
    'ID' => NULL,
    'PATH' => '/acrit.exportproplus/index.php',
    'SORT' => 100,
  ),
  33 => 
  array (
    'CONDITION' => '#^/online/(/?)([^/]*)#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/desktop_app/router.php',
    'SORT' => 100,
  ),
  31 => 
  array (
    'CONDITION' => '#^/stssync/calendar/#',
    'RULE' => '',
    'ID' => 'bitrix:stssync.server',
    'PATH' => '/bitrix/services/stssync/calendar/index.php',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^/contacts/stores/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog.store',
    'PATH' => '/contacts/stores/index.php',
    'SORT' => 100,
  ),
  12 => 
  array (
    'CONDITION' => '#^/company/vacancy/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/vacancy/index.php',
    'SORT' => 100,
  ),
  7 => 
  array (
    'CONDITION' => '#^/personal/order/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.order',
    'PATH' => '/personal/order/index.php',
    'SORT' => 100,
  ),
  35 => 
  array (
    'CONDITION' => '#^/services/idea/#',
    'RULE' => '',
    'ID' => 'bitrix:idea',
    'PATH' => '/services/idea/index.php',
    'SORT' => 100,
  ),
  13 => 
  array (
    'CONDITION' => '#^/company/staff/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/staff/index.php',
    'SORT' => 100,
  ),
  10 => 
  array (
    'CONDITION' => '#^/company/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/company/news/index.php',
    'SORT' => 100,
  ),
  14 => 
  array (
    'CONDITION' => '#^/info/brands/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/info/brands/index.php',
    'SORT' => 100,
  ),
  25 => 
  array (
    'CONDITION' => '#^/about/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/about/news/index.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/s1/catalog/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/s1/catalog/index.php',
    'SORT' => 100,
  ),
  21 => 
  array (
    'CONDITION' => '#^/services/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/services/index.php',
    'SORT' => 100,
  ),
  3 => 
  array (
    'CONDITION' => '#^/s1/stock/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/s1/stock/index.php',
    'SORT' => 100,
  ),
  23 => 
  array (
    'CONDITION' => '#^/projects/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/projects/index.php',
    'SORT' => 100,
  ),
  39 => 
  array (
    'CONDITION' => '#^/personal/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.section',
    'PATH' => '/personal/index.php',
    'SORT' => 100,
  ),
  17 => 
  array (
    'CONDITION' => '#^/landings/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/landings/index.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^/s1/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/s1/news/index.php',
    'SORT' => 100,
  ),
  47 => 
  array (
    'CONDITION' => '#^/catalog/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/catalog/index.php',
    'SORT' => 100,
  ),
  20 => 
  array (
    'CONDITION' => '#^/sale/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/sale/index.php',
    'SORT' => 100,
  ),
  22 => 
  array (
    'CONDITION' => '#^/blog/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/blog/index.php',
    'SORT' => 100,
  ),
  27 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
  36 => 
  array (
    'CONDITION' => '#^/club/#',
    'RULE' => '',
    'ID' => 'bitrix:socialnetwork',
    'PATH' => '/club/index.php',
    'SORT' => 100,
  ),
  44 => 
  array (
    'CONDITION' => '#^/auth/#',
    'RULE' => '',
    'ID' => 'aspro:auth.next',
    'PATH' => '/auth/index.php',
    'SORT' => 100,
  ),
  48 => 
  array (
    'CONDITION' => '#^/lp/#',
    'RULE' => NULL,
    'ID' => 'bitrix:landing.pub',
    'PATH' => '/lp/index.php',
    'SORT' => 100,
  ),
);

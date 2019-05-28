<?

    namespace PixelPlus;

    class SeoTools
    {
        public static function addCanonical()
        {
            $arAllowedKeys = array(
                //'PAGEN_1' по сео аудиту у всех страниц с пагинацией каноникалом должен быть основной раздел. Пока в коммент
            );

            if($strCanonical = self::getCanonical($arAllowedKeys))
            {
                \Bitrix\Main\Page\Asset::getInstance()->addString($strCanonical);
            }
        }

        /**
         * Return canonical tag if found unknown GET-parameters
         *
         * @param array  $allowedKeys
         * @param string $protocol
         *
         * @return string|bool
         */
        private static function getCanonical($allowedKeys = array(), $protocol = 'https')
        {
            if(empty($_GET))
            {
                return false;
            }

            $curUrl    = $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $parsedUrl = parse_url($curUrl);

            parse_str($parsedUrl['query'], $query);

            foreach($query as $param => $value)
            {
                if(!in_array($param, $allowedKeys))
                {
                    unset($query[$param]);
                }
            }

            $canonUrl = $parsedUrl['scheme'] . "://" . $parsedUrl['host'] . $parsedUrl['path'];

            if(!empty($query) && is_array($query) && !empty($allowedKeys))
            {
                $canonUrl .= "?" . http_build_query($query);
            }

            if($curUrl !== $canonUrl)
            {
                return "<link rel='canonical' href='$canonUrl' />";
            }

            return false;
        }
    }


<?php
    if ( ! function_exists('lang'))
    {
        function lang($line, $id = '')
        {
            $temp = $line;
            
            $CI =& get_instance();
            $line = $CI->lang->line($line);

            if (!$line) {
                $line = $temp;
            }

            if ($id != '')
            {
                $line = '<label for="'.$id.'">'.$line."</label>";
            }

            return $line;
        }
    }
?>

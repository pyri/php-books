<?php 
    function active($uri_string)
    {		
		foreach($uri_string as $item){
			if(uri_string() == $item) {
				$active='active';
			}
			else{ $active=''; }		
			
			echo $active;			
		}
    }

    function out($array) {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }

    function notEmpty($var) {
        if(!empty($var)){
            return $var;
        }
    }

    function notEmptyTwoArg($var, $sentence) {
        if(!empty($var)){
            return $sentence;
        }
    }

	function translit($string = NULL)
	{		
		$converter = array(
			'а' => 'a',   'б' => 'b',   'в' => 'v',
			'г' => 'g',   'д' => 'd',   'е' => 'e',
			'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
			'и' => 'i',   'й' => 'y',   'к' => 'k',
			'л' => 'l',   'м' => 'm',   'н' => 'n',
			'о' => 'o',   'п' => 'p',   'р' => 'r',
			'с' => 's',   'т' => 't',   'у' => 'u',
			'ф' => 'f',   'х' => 'h',   'ц' => 'c',
			'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
			'ь' => "_",  'ы' => 'y',   'ъ' => "_",
			'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
			
			' ' => '_',
			'@' => '_',
	 
			'А' => 'A',   'Б' => 'B',   'В' => 'V',
			'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
			'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
			'И' => 'I',   'Й' => 'Y',   'К' => 'K',
			'Л' => 'L',   'М' => 'M',   'Н' => 'N',
			'О' => 'O',   'П' => 'P',   'Р' => 'R',
			'С' => 'S',   'Т' => 'T',   'У' => 'U',
			'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
			'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
			'Ь' => "_",  'Ы' => 'Y',   'Ъ' => "_",
			'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
		);
		return strtr($string, $converter);
	}
	
	function form_ckeditor($data)
	{
		$size    = isset($data['width']) ? 'width: "'.$data['width'].'", ' : '';
		$size  .= isset($data['height']) ? 'height: "'.$data['height'].'", ' : '';
				
		$options = '{
			
		}';
		
		return '<script>window.onload = function(){CKEDITOR.replace("'.$data['id'].'", ' . $options . ');}</script>';	
	} 
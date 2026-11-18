<?php
//href="javascript:
//style="....expression
//style="....behavior
//<script
//on*="


function stripteaser($str, $StripHTMLTags = true, $AllowableTags = NULL) {
    $str = explode('<code>', $str);
    $codes = array();
    if (count($str) > 1) {
        foreach ($str as $idx => $val) {
            $val = explode('</code>', $val);
            if (count($val) > 1) {
                $uid = md5(uniqid(mt_rand(), true));
                $codes[$uid] = htmlentities(array_shift($val), ENT_QUOTES, 'UTF-8');
                $str[$idx] = "##$uid##" . implode('', $val);
            }
        }
    }
    $str = implode('', $str);
    
    while (stripos($str, '<script') !== false || stripos($str, '</script') !== false) {
        $str = str_ireplace('<script', '&lt;script', $str);
        $str = str_ireplace('</script', '&lt;/script', $str);
        
    }
    
   $rptjob = function(&$str, $regexp) {
                while (preg_match($regexp, $str, $matches)) {
                    $str = str_ireplace($matches[0], htmlentities($matches[0], ENT_QUOTES, 'UTF-8'), $str);
                }
            };
    $rptjob($str, '/href[\s\n\t]*=[\s\n\t]*[\"\'][\s\n\t]*(javascript:|data:)/i'); //href = "javascript:
    $rptjob($str, '/style[\s\n\t]*=[\s\n\t]*[\"][^\"]*expression/i'); //style = "...expression
    $rptjob($str, '/style[\s\n\t]*=[\s\n\t]*[\'][^\']*expression/i'); //style = '...expression
    $rptjob($str, '/style[\s\n\t]*=[\s\n\t]*[\"][^\"]*behavior/i'); //style = "...behavior
    $rptjob($str, '/style[\s\n\t]*=[\s\n\t]*[\'][^\']*behavior/i'); //style = '...behavior
    $rptjob($str, '/on\w+[\s\n\t]*=[\s\n\t]*[\"\']/i'); //onasd = "
    if ($StripHTMLTags)
        $str = strip_tags($str, $AllowableTags);
    foreach ($codes as $idx => $code) {
        $str = str_replace("##$idx##", $code, $str);
    }
    return $str;
}
?>
<section class="general-page">
    <div class="container text-center">
        <!--blockquote-->
            <h4><?php 
            echo stripteaser($page['Page']['title'],true);?></h4>
        <!--/blockquote-->
    </div>
    <div class="container">
        <?php echo stripteaser($page['Page']['content'],false);?>
    </div>
</section>
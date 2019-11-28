<?php


namespace  App\Service\Tools;

class GiveSvgName{

	static public function svgNameGenerator(){

	$allCharToPick=['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','0','1','2','3','4','5','6','7','8','9'];

	$svgName="piloux";
  
    for($i = 0 ; $i < 12 ; $i++){
        $svgName .= $allCharToPick[rand(0, count($allCharToPick) - 1)];
    }

    return $svgName;
	}
}
<?php

namespace  App\Service\Avatar;

Use App\Service\Tools\ColorTools;

class SvgAvatarFactory {

    private $template;
    CONST AVATAR_DIR = 'avatar/';

    public function __construct($template){
        $this->template=$template;
    }



    public function getAvatar(int $nbColors, int $size)
    {
      $colors = ColorTools::getRandomColors($nbColors);

      $matrix = new AvatarMatrix;
      $matrix->setSize($size);
      $matrix->setColors($colors);

      $svgRenderer = new SvgAvatarRenderer($this->template);

      return $svgRenderer->render($matrix);
    }
}

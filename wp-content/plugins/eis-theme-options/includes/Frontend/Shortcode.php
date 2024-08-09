<?php

namespace Eis\ThemeOption\Frontend;

class Shortcode
{
    public function __construct(){
        add_shortcode( 'dp-theme-options', [ $this, 'render_shortcode' ] );
    }

    public function render_shortcode( $atts, $content = '' ) {}
}
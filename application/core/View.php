<?php
namespace Core;
    class View
    {
        public function render($content_view, $template_view, $data = null, $form = null, $error = null)
        {
            include 'application/views/'.$template_view;
        }

    }
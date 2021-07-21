<?php
namespace Core;
    class View
    {
        function render($content_view, $template_view, $data = null)
        {
            include 'application/views/'.$template_view;
        }
    }
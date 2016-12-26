<?php

class strupt_docs {    
    
    private $active;
    
    public function load() {
        if (!file_exists('config.json')) {
            throw new Exception("Unable to generate documentation. Missing 'config.json' file");
        }
        
        $config = json_decode(file_get_contents('config.json'));
        $name = $config->{'application'};
        $color = $config->{'color'};
        $color_light = $config->{'colorLight'};
        $year = $config->{'year'};
        $content = $config->{'content'};
        
        $section_title = "";
        $sections = "";
        $activeSections = "";
        $main_content = "";
        $i = 0;
        
        foreach ($content as $key => $value) {
            $section_title = ucfirst($key);
            $id = str_replace(' ', '-', strtolower($key)) . '-';
            $class = $i === 0 ? " sidebar-item-active" : "";
            $sections .= "<li id='main-conent-$section_title' class='list-group-item sidebar-item nav-link$class' onclick='nav(\"main-conent-$section_title\", \"" . substr($id, 0, strlen($id) - 1) . "\")'><a style='text-decoration: none !important; color: inherit; font-weight: inherit'>$section_title</a></li>";
            
            $display = $i === 0 ? "display: block" : "display: none";
            $activeSections .= "<div id='" . substr($id, 0, strlen($id) - 1) . "' class='panel panel-default sidebar-parent' style='$display'>
                <div class='panel-body'>
                    <h3><strong>$section_title</strong></h3><hr/>
                    <ul class='list-group' style='margin: 0; box-shadow: none !important; border: none !important; border-radius: 0 !important;'>";
            
            foreach ($value as $key => $inner_value) {
                $temp_id = $id . str_replace(' ', '-', strtolower($key));
                $activeSections .= "<li class='list-group-item sidebar-item' onclick='scroll(\"$temp_id\")'><a style='text-decoration: none !important; color: inherit; font-weight: inherit''>" . ucfirst($key) . "</a></li>";
            }
            
            foreach ($value as $key => $inner_value) {
                $main_content .= self::generateContent($id, ucfirst($key), $inner_value, $i === 0);
            }
            
            $activeSections .= "<br/></ul></div></div>";
            
            $i++;
        }
        
        $display = $i === 1 ? "none" : "block";        
        echo "<html style='overflow-x: hidden'>
                <head>
                    <title>$name API Documentation</title>
                    <link rel='stylesheet' type='text/css' href='lib/assets/css/bootstrap.min.css'/>
                    <link rel='stylesheet' type='text/css' href='lib/assets/css/bootstrap-theme.min.css'/>
                    <link rel='stylesheet' type='text/css' href='lib/assets/css/style.css'/>
                    <link rel='shortcut icon' href='lib/assets/favicon.ico' />
                    <style>
                        .header {
                            background-color: $color;
                            background-image: url('lib/assets/bg.png');
                            background-size: 96px;
                        }
                        .sidebar-item:hover {
                            background-color: $color_light;
                        }
                        .sidebar-item-active {
                            background-color: $color !important;
                        }
                    </style>
                </head>
                <body style='background-color: #fcfcfc'>
                    <div class='header'>
                        <center><img src='lib/assets/logo.png' style='height: 192px; margin-bottom: 30px' /></center>
                        <p style='font-size: 250%; text-align: center'><strong>$name API Documentation</strong></p>
                    </div>
                    <br/><br/>
                    <div class='row' style='margin-left: 3%; margin-right: 3%'>                    
                        <div id='sidebar' class='col-lg-3 col-md-4 col-sm-12 col-xs-12'>
                            <div class='panel panel-default' style='display:$display'>
                                <div class='panel-body'>
                                    <h3><strong>Contents</strong></h3><hr/>
                                    <ul class='list-group' style='margin: 0; box-shadow: none !important; border: none !important; border-radius: 0 !important;'>
                                        $sections
                                        <br/>
                                    </ul>
                                </div>
                            </div>
                            $activeSections
                        </div>
                        <div class='col-lg-9 col-md-8 col-sm-12 col-xs-12' style='padding-left: 3%'>$main_content</div>
                    </div>";
        
        $year = empty($year) ? date('Y') : $year;
        $link = "<a class='white-link' href='https://github.com/StruptOfficial/docs' target='_blank'><i>Powered by Strupt Docs</i></a>";
        echo "<div class='footer'><br/><p style='text-align: center;'>$link<br/><strong>" . 
                "© " . ((string)$year === date('Y') ? $year : ($year . '-' . date('Y'))) . " $name. All rights reserved</div></strong></div>";
        echo "<script src='https://code.jquery.com/jquery-1.12.4.min.js' integrity='sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=' crossorigin='anonymous'></script>";
        echo "<script src='lib/assets/js/main.js'></script>";
        echo "</body></html>";
    }
    
    private static function generateContent($parent_id, $title, $parent, $is_visible) {
        $content = "";
        $id = $parent_id . str_replace(' ', '-', strtolower($title));
        $class = substr($parent_id, 0, strlen($parent_id) - 1);
        $display = $is_visible ? "display: block" : "display: none";
        $content .= "<div id='$id' class='panel panel-default sidebar-parent $class' style='$display'>" .
            "<div class='panel-body'><h3><strong>$title</strong></h3><hr/>";

        if (isset($parent->{'description'})) {
            $content .= "<p>" . ucfirst($parent->{'description'}) . "</p>";
        }
        
        if (isset($parent->{'type'})) {            
            $content .= "<p><strong>HTTP Method Type: </strong>" . strtoupper($parent->{'type'}) . "</p>";
        }

        if (isset($parent->{'endpoint'})) {
            $content .= "<h4 style='margin-top: 25px'><u>API Endpoint:</u></h4><pre><a href='" . $parent->{'endpoint'} . "'>" . $parent->{'endpoint'} . "</a></pre>";
        }

        if (isset($parent->{'success'})) {
            $content .= "<h4 style='margin-top: 25px'><u>Successful Response:</u></h4><pre>" . $parent->{'success'} . "</pre>";
        }
        
        if (isset($parent->{'error'})) {
            $content .= "<h4 style='margin-top: 25px'><u>Failed Response:</u></h4><pre>" . $parent->{'error'} . "</pre>";
        }
        
        if (isset($parent->{'params'})) {
            $params = "";
            foreach ($parent->{'params'} as $key => $value) {
                $params .= "<strong>" . ucfirst($key) . ": </strong>" . ucfirst($value) . "<br/>";
            }
            
            $params = substr($params, 0, strlen($params) - 5);
            $content .= "<h4 style='margin-top: 25px'><u>Parameters:</u></h4><p>$params</p>";
        }
        
        if (isset($parent->{'codes'})) {
            $codes = "";
            foreach ($parent->{'codes'} as $key => $value) {
                $codes .= "<strong>" . ucfirst($key) . ": </strong>" . ucfirst($value) . "<br/>";
            }
            
            $codes = substr($codes, 0, strlen($codes) - 5);
            $content .= "<h4 style='margin-top: 25px'><u>Error Codes:</u></h4><p>$codes</p>";
        }

        $content .= "</div></div>";
        return $content;
    }
}